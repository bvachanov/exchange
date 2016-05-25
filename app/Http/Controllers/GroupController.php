<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;
use App\Group;
use Auth;
use App\Discipline;
use App\GroupToStudent;
use DB;
use App\MaterialType;
use Storage;
use Input;
use App\ProfessorMaterial;
use App\AssignmentToStudent;
use Carbon\Carbon;
use Session;

class GroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('prof');
    }

    public function createGroup() {
        $users = User::where('account_type', 3)->join('additional_data_students', 'users.id', '=', 'additional_data_students.user_id')->get();
        $coursesOfStudies = DB::table('course_of_studies')->lists('name_bg', 'id');
        $years = DB::table('additional_data_students')->distinct()->lists('year', 'year');
        $disciplines = Discipline::all()->lists('name', 'id');
        return view('groups.addGroup', compact('users', 'disciplines', 'coursesOfStudies', 'years'));
    }

    public function getGroups() {
        $id = Auth::id();
        $groups = Group::where('professor_id', $id)->get();
        return view('groups.showGroups', compact('groups'));
    }

    public function storeGroup(Requests\CreateGroupRequest $request) {
        $group = Group::create([
                    'name' => $request->input('name'),
                    'description' => $request->input('description'),
                    'professor_id' => Auth::id(),
                    'discipline_id' => $request->input('discipline'),
        ]);
        $path = '/fileStorage/group_' . $group->id . '_dir';
        Storage::disk('local')->makeDirectory($path);
        $students = $request->input('students');
        foreach ($students as $student) {
            GroupToStudent::create([
                'group_id' => $group->id,
                'student_id' => $student,
            ]);
        }
        return redirect()->action('GroupController@showGroup', [$group->id]);
    }

    public function showGroup($id) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            $discipline = Discipline::where('id', $group->discipline_id)->first();
            $lectures = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 1)->get();
            $exercises = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 2)->get();
            $assignments = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 3)->get();
            $others = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 4)->get();
            $students = DB::table('group_to_student')->where('group_id', $id)
                            ->join('additional_data_students', 'group_to_student.student_id', '=', 'additional_data_students.user_id')->get();
            $materialTypes = MaterialType::lists('name_bg', 'id');
            $today = Carbon::today()->format('Y/m/d');
            return view('groups.showGroup', compact('group', 'lectures', 'exercises', 'discipline', 'materialTypes', 'assignments', 'students', 'today', 'others'));
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function showAssignment($id) {
        $assignments = DB::table('professor_materials')->where('id', $id)->get();
        $assignedTo = [];
        $uploadsToAssignemt = [];
        foreach ($assignments as $assignment) {
            $uploadsToAssignemt[$assignment->id] = DB::table('student_materials')
                            ->join('additional_data_students', 'additional_data_students.id', '=', 'student_materials.user_id')
                            ->where('assignment_id', $assignment->id)->get();
            $assignedTo[$assignment->id] = DB::table('assignment_to_student')->where('assignment_id', $assignment->id)->get();
        }

        return view('groups.showAssignment', compact('assignments', 'assignedTo', 'uploadsToAssignemt'));
    }

    public function uploadFile($id, Requests\UploadFileProfessorRequest $request) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            $name = $request->input('name');
            $extension = Input::file('file')->getClientOriginalExtension();
            $path = '/storage/app/fileStorage/group_' . $group->id . '_dir/';
            $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
            Request::file('file')->move(base_path() . $path, $fileName);
            $type = $request->input('type');
            $endDate = NULL;
            if ($request->input('has_end_date') == 1) {
                $endDate = $request->input('end_date');
            }
            $material = ProfessorMaterial::create([
                        'name' => $name,
                        'author_id' => Auth::id(),
                        'group_id' => $group->id,
                        'file_name' => $path . $fileName,
                        'type_id' => $type,
                        'is_public' => $request->input('is_public'),
                        'end_date' => $endDate,
            ]);
            if ($request->input('is_public') == 0) {
                $this->storeIndividualAssignments($request->input('students'), $material->id);
            }

            return redirect()->action('GroupController@showGroup', [$group->id]);
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    private function storeIndividualAssignments($students, $assignmentId) {
        foreach ($students as $student) {
            AssignmentToStudent::create([
                'assignment_id' => $assignmentId,
                'student_id' => $student,
            ]);
        }
    }

    public function deleteGroup($id) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            $path = '/fileStorage/group_' . $group->id . '_dir';
            Storage::disk('local')->deleteDirectory($path);
            Group::where('id', $id)->delete();
            return redirect()->action('GroupController@getGroups');
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function downloadFile($id) {
        $file = ProfessorMaterial::where('id', $id)->first();
        return response()->download(base_path() . $file->file_name);
    }

    public function deleteFile($id) {
        $file = ProfessorMaterial::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->action('GroupController@getGroups');
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

    public function editGroup($id) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            Session::put('groupId', $id);
            $students = DB::table('group_to_student')->where('group_id', $id)
                            ->join('additional_data_students', 'group_to_student.student_id', '=', 'additional_data_students.user_id')->get();
            $users = User::where('account_type', 3)->join('additional_data_students', 'users.id', '=', 'additional_data_students.user_id')->get();
            $coursesOfStudies = DB::table('course_of_studies')->lists('name_bg', 'id');
            $years = DB::table('additional_data_students')->distinct()->lists('year', 'year');
            $disciplines = Discipline::all()->lists('name', 'id');

            return view('groups.editGroup', compact('group', 'students', 'users', 'years', 'disciplines', 'coursesOfStudies'));
        }
        return redirect()->back();
    }

    public function storeEdited($id, Requests\CreateGroupRequest $request) {

        if (Group::where('id', $id)->pluck('professor_id') == Auth::id() && Session::get('groupId') == $id) {
            Group::where('id', $id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'discipline_id' => $request->input('discipline'),
            ]);
            $students = $request->input('students');
            $oldStudents = GroupToStudent::where('group_id', $id)->lists('student_id');
            foreach ($students as $student) {
                if (!in_array($student, $oldStudents)) {
                    GroupToStudent::create([
                        'group_id' => $id,
                        'student_id' => $student,
                    ]);
                }
            }
            foreach ($oldStudents as $old) {
                if (!in_array($old, $students)) {
                    GroupToStudent::where('group_id', $id)->where('student_id', $old)->delete();
                }
            }
            return redirect()->action('GroupController@showGroup', [$id]);
        }
        Session::flash('flash_message_error', "You don't have a permission for this operation.");
        return redirect()->back();
    }

}
