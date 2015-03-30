<?php namespace App\Http\Requests;

class CreateCreditCardRequest extends Request {

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
			'token'                 =>  'required|exists:quotes,token',
            'customer_profile_id'   =>  'required|exists:member_customer_profiles,customerProfileId',
			'credit_card_number'    =>  'required',
			'expiration_date'       =>  'required|date_format:Y-m',
		];
	}

}
