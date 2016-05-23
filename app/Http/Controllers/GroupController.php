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

class GroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('prof');
    }

    public function createGroup() {
        $users = User::where('account_type', 3)->join('additional_data_students', 'users.id', '=', 'additional_data_students.user_id')->get();
        $disciplines = Discipline::all()->lists('name', 'id');
        return view('groups.addGroup', compact('users', 'disciplines'));
    }

    public function getGroups() {
        $id = Auth::id();
        $professorsGroups = Group::where('professor_id', $id)->get();
        return view('group.showGroups', compact('professorsGroups'));
    }

    public function storeGroup(Requests\CreateGroupRequest $request) {
        $group = Group::create([
                    'name' => $request->input('name'),
                    'description' =>  $request->input('description'),
                    'professor_id' => Auth::id(),
                    'discipline_id' =>  $request->input('discipline'),
        ]);
        $path = '/fileStorage/group_' . $group->id . '_dir';
        Storage::disk('local')->makeDirectory($path);
        $students =  $request->input('students');
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
        $discipline = Discipline::where('id', $group->discipline_id)->first();
        $lectures = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 1)->get();
        $exercises = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 2)->get();
        $assignments = DB::table('professor_materials')->where('group_id', $id)->where('type_id', 3)->get();
        $students = DB::table('group_to_student')->where('group_id', $id)
                        ->join('additional_data_students', 'group_to_student.student_id', '=', 'additional_data_students.user_id')->get();
        $materialTypes = MaterialType::lists('name_bg', 'id');
        return view('groups.showGroup', compact('group', 'lectures', 'exercises', 'discipline', 'materialTypes', 'assignments', 'students'));
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

    public function uploadFile($id) {
        $group = Group::where('id', $id)->first();
        $name = Request::input('name');
        $extension = Input::file('file')->getClientOriginalExtension();
        $path = '/storage/app/fileStorage/group_' . $group->id . '_dir/';
        $fileName = $name . date('Y-m-d_hi') . '.' . $extension;
        Request::file('file')->move(base_path() . $path, $fileName);
        $type = Request::input('type');
        ProfessorMaterial::create([
            'name'=>$name,
            'author_id'=>Auth::id(),
            'group_id'=>$group->id,
            'file_name'=>$fileName,
            'type_id'=>$type,
            'is_public'=>Request::input('is_public')
        ]);
         return redirect()->action('GroupController@showGroup', [$group->id]);
    }

}
