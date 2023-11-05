<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class BookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => 'required|string',
           
            'fname'=> 'required|max:100|string',
            'lname'=> 'required|max:100|string',
            'email'=> 'required|max:100|regex:/^[\w\.-]+@[\w\.-]+\.\w+$/|min:10|max:30',
            'phone'=> 'required|max:100|string',
            'time'=> 'required|max:100|string',
            // 'amount' => 'required',
            // 'car_id' => 'required',

        ];
    }

    // public function failedValidation(Validator $validator)
    // {

    //     throw new HttpResponseException(response()->json([
    //         'success' => false,
    //         'message' => 'Ops! Some errors occurred',
    //         'errors' => $validator->errors()
    //     ],400));

    // }
}
