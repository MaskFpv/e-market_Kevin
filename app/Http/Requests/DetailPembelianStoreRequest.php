<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailPembelianStoreRequest extends FormRequest
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
            'barang_id' => ['required', 'exists:barangs,id'],
            'pembelian_id' => ['required', 'exists:pembelians,id'],
            'harga_beli' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ];
    }
}
