<?php

namespace App\Http\Requests;

use App\Jenis;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreJenisRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('jenis_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
