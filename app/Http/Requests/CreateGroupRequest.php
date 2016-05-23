<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateGroupRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => 'required|min:2|max:255',
            'description' => 'required|min:2|max:300000',
            'students' => 'required',
            'discipline' => 'required',
        ];
    }

}
