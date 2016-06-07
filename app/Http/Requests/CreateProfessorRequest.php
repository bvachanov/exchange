<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateProfessorRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'name' => 'required|min:6|max:255',
            'email' => 'required|max:255|email|unique:users',        
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'academic_title' => 'required|max:255',                       
        ];
	}

}
