<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProposalRequest extends FormRequest
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
            'organisasi'    => 'required|string',
            'kegiatan'      => 'required|string',
            'tanggal'       => 'required',
            'tempat'        => 'required|string',
            'anggaran_a'    => 'required',
            'file'          => 'required|mimes:pdf',
        ];
    }
}