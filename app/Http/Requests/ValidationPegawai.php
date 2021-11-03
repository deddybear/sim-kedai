<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationPegawai extends FormRequest
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
            'name_account'  => 'required|between:5,50|string',
            'email'         => 'required|email:rfc,dns|unique:tbl_users,email'
        ];
    }

    public function messages()
    {
        return [
            'name_account.required' => 'Nama Pegawai harus wajib di-isi',
            'name_account.between'  => 'Panjang Nama Pegawai minimal 5 maksimal 50',
            'name_account.string'   => 'Mohon di isi Nama Pegawai dengan benar',
            'email.required'        => 'Email harus wajib di-isi',
            'email.email'           => 'Format Email salah',
            'email.unique'          => 'Email ini sudah terdaftar'
        ];
    }

    public function response(array $errors)
    {
        return response()->json(['message' => $errors]);
    }
}
