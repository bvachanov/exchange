<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Assignment;
use App\AssignmentSolution;
use App\Exercise;
use App\ExerciseSolution;
use App\Group;

use Illuminate\Http\Request;

class ProfessorController extends Controller {
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('prof');
    }

    public function showAllTasks()
    {
        $user=Auth::user();
        $assignments=  Assignment::where('author_id', $user->id)->get();
        $aWithoutReview=[];   
        $aGroupName=[];
        foreach ($assignments as $a)
        {
            $aGroupName[$a->id]=Group::where('id', $a->group_id)->pluck('name');
            $aWithoutReview[$a->id]=  AssignmentSolution::where('assignment_id', $a->id)
                    ->where('feedback', '')->count();
        }
        $exercises=  Exercise::where('author_id', $user->id)->get();
        $eWithoutReview=[];
        $eGroupName=[];
        foreach ($exercises as $e)
        {
            $eGroupName[$e->id]=Group::where('id', $e->group_id)->pluck('name');
            $eWithoutReview[$e->id]=  ExerciseSolution::where('exercise_id', $e->id)
                    ->where('feedback', '')->count();
        }
        
        return view('users.allTasks', compact('assignments', 'aWithoutReview','aGroupName', 
                'exercises', 'eWithoutReview', 'eGroupName'));
    }
}
