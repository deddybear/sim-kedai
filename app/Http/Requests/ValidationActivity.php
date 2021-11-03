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
            'day'   => 'required|numeric|min:1|max:32',
            'month' => 'required|numeric|min:1|max:12',
            'year'  => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'day.required'     => 'Hari Tidak Boleh Kosong',
            'day.min'          => 'Silahkan isi Tanggal dengan benar',
            'day.max'          => 'Silahkan isi Tanggal dengan benar',
            'month.required'   => 'Bulan Tidak Boleh Kosong',
            'month.min'        => 'Silahkan isi Bulan dengan benar',
            'month.max'        => 'Silahkan isi Bulan dengan benar',
            'year.required'    => 'Tahun Tidak Boleh Kosong',
            'year.numeric'     => 'Silahkan isi Tahun dengan benar'
        ];
    }

    public function response(array $errors)
    {
        return response()->json(['message' => $errors]);
    }
}
