<?php

namespace App\Http\Requests;

use App\Barang;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateBarangRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('barang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name'   => [
                'required',
            ],
            'stok'   => [
                'required',
            ],
        ];
    }
}
