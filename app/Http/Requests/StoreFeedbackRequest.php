<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreFeedbackRequest extends Request {

    public function authorize() {
        return true;
    }

    public function rules() {
        return [            
            'feedback' => 'required|min:1|max:30000',       
        ];
    }

}
