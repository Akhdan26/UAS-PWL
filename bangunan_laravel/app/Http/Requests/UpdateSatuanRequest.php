<?php

namespace App\Http\Requests;

use App\Satuan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSatuanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('satuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
