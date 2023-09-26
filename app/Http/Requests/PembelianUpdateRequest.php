<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembelianUpdateRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
