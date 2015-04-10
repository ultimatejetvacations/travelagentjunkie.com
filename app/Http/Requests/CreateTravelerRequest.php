<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateTravelerRequest extends Request {

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
			'token'         =>  'required|exists:quotes,token',
			'first_name'    =>  'required',
			'last_name'     =>  'required',
//			'date_of_birth' =>  'date_format:m/d/Y',
		];
	}

}
