<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{


  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|min:3',
      'email' => 'required|email',
      'phone' => 'required',
    ];
  }

  /**
   * Custom message for validation
   *
   * @return array
   */
  public function messages()
  {
    return [
      'name.required' => 'Name is required.',
      'email.required' => 'Email is required.',
      'phone.required' => 'Mobile No is required.',
    ];
  }
}
