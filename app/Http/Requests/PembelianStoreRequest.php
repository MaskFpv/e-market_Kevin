<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembelianStoreRequest extends FormRequest
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
            'kode_masuk' => ['required', 'max:255', 'string'],
            'tanggal_masuk' => ['required', 'date'],
            'total' => ['required', 'numeric'],
            'pemasok_id' => ['required', 'exists:pemasoks,id'],
            'barang_id' => 'required',
            'harga_beli' => 'required',
            'jumlah' => 'required',
            'sub_total' => 'required',
        ];
    }
}
