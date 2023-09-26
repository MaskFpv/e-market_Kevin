<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BarangStoreRequest extends FormRequest
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
            'kode_barang' => ['required', 'max:255', 'string'],
            'nama_barang' => ['required', 'max:255', 'string'],
            'satuan' => ['required', 'max:255', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stock' => ['required', 'max:255', 'string'],
            'produk_id' => ['required', 'exists:produks,id'],
        ];
    }
}
