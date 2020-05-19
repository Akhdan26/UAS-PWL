<?php

namespace App\Http\Requests;

use App\Satuan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySatuanRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('satuan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:satuan,id',
        ];
    }
}
