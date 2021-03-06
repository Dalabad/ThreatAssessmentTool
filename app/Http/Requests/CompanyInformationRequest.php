<?php namespace App\Http\Requests;

class CompanyInformationRequest extends Request {

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
            'companyName' => 'required',
            'companyEmployeeCount' => 'required|integer|min:1',
            'companyWebsite' => 'required|url',
            'attackType' => 'required',
		];
	}

}
