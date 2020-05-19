<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSatuanRequest;
use App\Http\Requests\UpdateSatuanRequest;
use App\Http\Resources\Admin\SatuanResource;
use App\Satuan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SatuansApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('satuan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SatuanResource(Satuan::all());
    }

    public function store(StoreSatuanRequest $request)
    {
        $satuan = Satuan::create($request->all());

        return (new SatuanResource($satuan))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Satuan $satuan)
    {
        abort_if(Gate::denies('satuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SatuanResource($satuan);
    }

    public function update(UpdateSatuanRequest $request, Satuan $satuan)
    {
        $satuan->update($request->all());

        return (new SatuanResource($satuan))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Satuan $satuan)
    {
        abort_if(Gate::denies('satuan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satuan->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
