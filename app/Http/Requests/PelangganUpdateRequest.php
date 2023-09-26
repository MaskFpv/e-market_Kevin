<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PelangganUpdateRequest extends FormRequest
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
            'kode_pelanggan' => ['required', 'max:255', 'string'],
            'nama' => ['required', 'max:255', 'string'],
            'alamat' => ['required', 'max:255', 'string'],
            'no_telp' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
        ];
    }
}
