<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CarRequest extends FormRequest
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
            'model' => 'required|max:100|string',
            'brand' => 'required|max:100|string',
            'year_of_manufacture' => 'required|max:100|string',
            'fuel_type' => 'required|max:100|string',
            'numberplate' => 'required|max:100|string',
            'gearbox'=>  'required|max:100|string',
            'gps'=>'required|max:100|string',
            'mileage' => 'required|max:100|string',
            'number_place' => 'required|integer',
            'description' => 'required|max:200|string',
            'rental_price_per_day' => 'required|max:100|string',
            'status' => 'required|max:100|string',
            'picture1' => 'required',
            'picture2' => 'required',
            'picture3' => 'required',
            'picture4' => 'required',
        ];
    }

    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Ops! Some errors occurred',
            'errors' => $validator->errors()
        ],400));

    }
}
