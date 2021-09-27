<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationActivity extends FormRequest
{
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
            'day'   => 'numeric|min:1|max:32',
            'month' => 'numeric|min:1|max:12',
            'year'  => 'numeric'
        ];
    }

    public function messages()
    {
        return [
            'day.min'       => 'Silahkan isi Tanggal dengan benar',
            'day.max'       => 'Silahkan isi Tanggal dengan benar',
            'month.min'     => 'Silahkan isi Bulan dengan benar',
            'month.max'     => 'Silahkan isi Bulan dengan benar',
            'year.numeric'  => 'Silahkan isi Tahun dengan benar'
        ];
    }

    public function response(array $errors)
    {
        return response()->json(['message' => $errors]);
    }
}
