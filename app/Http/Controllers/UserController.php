<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use DB;
use App\AccountType;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function show($id) {
        $user = User::where('id', $id)->first();
        $accountType = AccountType::where('id', $user->account_type)->pluck('name_bg');
        $additionalData = '';
        $courseOfStudies = '';
        if ($user->account_type == 2) {
            $additionalData = DB::table('additional_data_professors')->
                            where('user_id', $id)->first();
        } else if ($user->account_type == 3) {
            $additionalData = DB::table('additional_data_students')->
                            where('user_id', $id)->first();
            $courseOfStudies = DB::table('course_of_studies')->where('id', $additionalData->course_of_studies)
                    ->pluck('name_bg');
        }
        return view('users.show', compact('user', 'additionalData', 'accountType', 'courseOfStudies'));
    }

}
