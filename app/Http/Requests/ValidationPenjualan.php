<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationPenjualan extends FormRequest
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
            'name_product' => 'required|string|between:3,255',
            'category'     => 'required|string|between:3,20',
            'jumlah'       => 'required|numeric|min:1',
            'harga_satuan' => 'required|numeric|min:1'
        ];
    }

    public function messages()
    {
        return [
            'name_product.required' => 'Silahkan isi nama produk, Tidak boleh kosong',
            'name_product.string'   => 'Silahkan isi dengan benar nama produk',
            'name_product.between'  => 'Nama produk harus antara 3 huruf sampai 255',
            'category.required'     => 'Silahkan pilih kategori produk, Tidak boleh kosong',
            'category.string'       => 'Pilih dengan benar kategori produk yang sudah tersedia',
            'category.between'      => 'Kategori harus antara 3 huruf sampai 20',
            'jumlah.required'       => 'Silahkan isi jumlah produk, Tidak boleh kosong',
            'jumlah.numeric'        => 'Silahkan isi dengan benar jumlah produk dengan angka',
            'jumlah.min'            => 'Minimal jumlah produk adalah 1',
            'harga_satuan.required' => 'Silahkan isi harga satuan produk, Tidak boleh kosong',
            'harga_satuan.numeric'  => 'Silahkan isi harga satuan produk, dengan angka',
            'harga_satuan.min'      => 'Minimal Harga satuan adalah 1'
        ];
    }

    public function response(array $msg)
    {
        return response()->json(['errors' => $msg]);
    }
}
