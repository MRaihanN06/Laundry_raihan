<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransaksiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'bayar' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'id_paket.required' => 'Belum ada paket yang dipilih',
            'id_member.required' => 'Data pelanggan belum dipilih',
        ];
    }
}
