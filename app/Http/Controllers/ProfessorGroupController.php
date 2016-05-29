<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Request;
use App\Group;
use Auth;
use App\Course;
use App\GroupToStudent;
use DB;
use App\MaterialType;
use Storage;
use Input;
use App\ProfessorMaterial;
use App\AssignmentToStudent;
use Carbon\Carbon;
use Session;
use App\Lecture;
use App\Assignment;
use App\Exercise;
use App\ExerciseToStudent;

class ProfessorGroupController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('prof');
    }

    public function createGroup() {
        $users = User::where('account_type', 3)->join('additional_data_students', 'users.id', '=', 'additional_data_students.user_id')->get();
        $locale = Session::get('locale');
        $nameLoc = 'name_' . $locale;
        $coursesOfStudies = DB::table('course_of_studies')->lists($nameLoc, 'id');
        $years = DB::table('additional_data_students')->distinct()->lists('year', 'year');
        $disciplines = Course::all()->lists('name', 'id');
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
                    'course_id' => $request->input('discipline'),
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
        return redirect()->action('ProfessorGroupController@showGroup', [$group->id]);
    }

    public function showGroup($id) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            $discipline = Course::where('id', $group->course_id)->first();
            $lectures = DB::table('lectures')->where('group_id', $id)->get();
            $exercises = DB::table('exercises')->where('group_id', $id)->get();
            $assignments = DB::table('assignments')->where('group_id', $id)->get();
            $studentsToExercise = [];
            $studentsToAssignment = [];
            foreach ($exercises as $exercise) {
                $studentsToExercise[$exercise->id] = ExerciseToStudent::where('exercise_id', $exercise->id)
                        ->join('additional_data_students', 'additional_data_students.user_id', '=', 'exercise_to_student.student_id')
                        ->select('faculty_number', 'user_id')->get();
            }

            foreach ($assignments as $assignment) {
                $studentsToAssignment[$assignment->id] = AssignmentToStudent::where('assignment_id', $assignment->id)
                        ->join('additional_data_students', 'additional_data_students.user_id', '=', 'assignment_to_student.student_id')
                        ->select('faculty_number', 'user_id')->get();
            }
            $others = DB::table('professor_materials')->where('group_id', $id)->get();
            $students = DB::table('group_to_student')->where('group_id', $id)
                            ->join('additional_data_students', 'group_to_student.student_id', '=', 'additional_data_students.user_id')->get();
            $locale = Session::get('locale');
            $nameLoc = 'name_' . $locale;
            $materialTypes = MaterialType::lists($nameLoc, 'id');
            $today = Carbon::today()->format('Y/m/d');
            return view('groups.showGroup', compact('group', 'lectures', 'exercises', 'discipline', 'materialTypes', 'assignments', 'students', 'today', 'others', 'studentsToExercise', 'studentsToAssignment'));
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function showAssignment($id) {

        $assignment = DB::table('assignments')->where('id', $id)->first();
        if ($assignment->author_id == Auth::id()) {
            $authors = [];
            $uploadsToAssignment = DB::table('assignment_solutions')
                            ->where('assignment_id', $assignment->id)->get();
            foreach ($uploadsToAssignment as $u) {
                $authors[$u->id] = DB::table('additional_data_students')->where('user_id', $u->author_id)->first();
            }
            $assignedTo = DB::table('assignment_to_student')->where('assignment_id', $assignment->id)
                            ->join('additional_data_students', 'additional_data_students.user_id', '=', 'assignment_to_student.student_id')->get();
            return view('groups.showAssignment', compact('assignment', 'assignedTo', 'authors', 'uploadsToAssignment'));
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function storeAssignmentFeedback($id, Requests\StoreFeedbackRequest $request) {
        $solution = \App\AssignmentSolution::where('id', $id)->first();
        $task = Assignment::where('id', $solution->assignment_id)->first();
        if ($task->author_id == Auth::id()) {
            $solution->feedback = $request->input('feedback');
            $solution->save();
            return redirect()->back();
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function showExercise($id) {

        $exercise = DB::table('exercises')->where('id', $id)->first();
        if ($exercise->author_id == Auth::id()) {
            $authors = [];
            $uploadsToExercise = DB::table('exercise_solutions')
                            ->where('exercise_id', $exercise->id)->get();
            foreach ($uploadsToExercise as $u) {
                $authors[$u->id] = DB::table('additional_data_students')->where('user_id', $u->author_id)->first();
            }
            $assignedTo = DB::table('exercise_to_student')->where('exercise_id', $exercise->id)
                            ->join('additional_data_students', 'additional_data_students.user_id', '=', 'exercise_to_student.student_id')->get();
            return view('groups.showExercise', compact('exercise', 'assignedTo', 'authors', 'uploadsToExercise'));
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function storeExerciseFeedback($id, Requests\StoreFeedbackRequest $request) {
        $solution = \App\ExerciseSolution::where('id', $id)->first();
        $task = Assignment::where('id', $solution->exercise_id)->first();
        if ($task->author_id == Auth::id()) {
            $solution->feedback = $request->input('feedback');
            $solution->save();
            return redirect()->back();
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function uploadFile($id, Requests\UploadFileProfessorRequest $request) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            $type = $request->input('type');
            if ($type == 1) {
                $this->storeLecture($request, $group);
            } else if ($type == 2) {
                $this->storeExercise($request, $group);
            } else if ($type == 3) {
                $this->storeAssignment($request, $group);
            } else {
                $this->storeOtherMaterial($request, $group);
            }


            return redirect()->action('ProfessorGroupController@showGroup', [$group->id]);
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    private function storeLecture($request, $group) {
        $name = $request->input('name');
        $extension = Input::file('file')->getClientOriginalExtension();
        $path = '/storage/app/fileStorage/group_' . $group->id . '_dir/';
        $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
        Request::file('file')->move(base_path() . $path, $fileName);
        Lecture::create([
            'name' => $name,
            'author_id' => Auth::id(),
            'group_id' => $group->id,
            'file_name' => $path . $fileName,
        ]);
    }

    private function storeOtherMaterial($request, $group) {
        $name = $request->input('name');
        $extension = Input::file('file')->getClientOriginalExtension();
        $path = '/storage/app/fileStorage/group_' . $group->id . '_dir/';
        $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
        Request::file('file')->move(base_path() . $path, $fileName);
        ProfessorMaterial::create([
            'name' => $name,
            'author_id' => Auth::id(),
            'group_id' => $group->id,
            'file_name' => $path . $fileName,
        ]);
    }

    private function storeAssignment($request, $group) {
        $name = $request->input('name');
        $extension = Input::file('file')->getClientOriginalExtension();
        $path = '/storage/app/fileStorage/group_' . $group->id . '_dir/';
        $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
        Request::file('file')->move(base_path() . $path, $fileName);
        $material = Assignment::create([
                    'name' => $name,
                    'author_id' => Auth::id(),
                    'group_id' => $group->id,
                    'file_name' => $path . $fileName,
                    'end_date' => $request->input('end_date'),
        ]);
        $this->storeIndividualAssignments($request->input('students'), $material->id);
    }

    private function storeIndividualAssignments($students, $assignmentId) {
        foreach ($students as $student) {
            AssignmentToStudent::create([
                'assignment_id' => $assignmentId,
                'student_id' => $student,
            ]);
        }
    }

    private function storeExercise($request, $group) {
        $name = $request->input('name');
        $extension = Input::file('file')->getClientOriginalExtension();
        $path = '/storage/app/fileStorage/group_' . $group->id . '_dir/';
        $fileName = $name . "-" . date('Y-m-d_hi') . '.' . $extension;
        Request::file('file')->move(base_path() . $path, $fileName);
        $material = Exercise::create([
                    'name' => $name,
                    'author_id' => Auth::id(),
                    'group_id' => $group->id,
                    'file_name' => $path . $fileName,
                    'end_date' => $request->input('end_date'),
        ]);
        $this->storeIndividualExercises($request->input('students'), $material->id);
    }

    private function storeIndividualExercises($students, $exerciseId) {
        foreach ($students as $student) {
            ExerciseToStudent::create([
                'exercise_id' => $exerciseId,
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
            return redirect()->action('ProfessorGroupController@getGroups');
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function deleteLecture($id) {
        $file = Lecture::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->back();
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function deleteOther($id) {
        $file = ProfessorMaterial::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->back();
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function deleteExercise($id) {
        $file = Exercise::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->back();
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function deleteAssignment($id) {
        $file = Assignment::where('id', $id)->first();
        if ($file->author_id == Auth::id()) {
            unlink(base_path() . $file->file_name);
            $file->delete();
            return redirect()->back();
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

    public function editGroup($id) {
        $group = Group::where('id', $id)->first();
        if ($group->professor_id == Auth::id()) {
            Session::put('groupId', $id);
            $students = DB::table('group_to_student')->where('group_id', $id)
                            ->join('additional_data_students', 'group_to_student.student_id', '=', 'additional_data_students.user_id')->get();
            $users = User::where('account_type', 3)->join('additional_data_students', 'users.id', '=', 'additional_data_students.user_id')->get();
            $locale = Session::get('locale');
            $nameLoc = 'name_' . $locale;
            $coursesOfStudies = DB::table('course_of_studies')->lists($nameLoc, 'id');
            $years = DB::table('additional_data_students')->distinct()->lists('year', 'year');
            $disciplines = Course::all()->lists('name', 'id');

            return view('groups.editGroup', compact('group', 'students', 'users', 'years', 'disciplines', 'coursesOfStudies'));
        }
        return redirect()->back();
    }

    public function storeEdited($id, Requests\CreateGroupRequest $request) {

        if (Group::where('id', $id)->pluck('professor_id') == Auth::id() && Session::get('groupId') == $id) {
            Group::where('id', $id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'course_id' => $request->input('discipline'),
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
            return redirect()->action('ProfessorGroupController@showGroup', [$id]);
        }
        Session::flash('flash_message_error', trans('translations.notAllowed'));
        return redirect()->back();
    }

}
