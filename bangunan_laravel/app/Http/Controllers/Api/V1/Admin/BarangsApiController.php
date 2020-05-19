<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Barang;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Http\Resources\Admin\BarangResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BarangsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        return new BarangResource(Barang::all());
    }

    public function store(StoreBarangRequest $request)
    {
        $barang = Barang::create($request->all());

        if ($request->input('photos', false)) {
            $barang->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return (new BarangResource($barang))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Barang $barang)
    {
        return new BarangResource($barang);
    }

    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());

        if ($request->input('photos', false)) {
            if (!$barang->photo || $request->input('photos') !== $barang->photo->file_name) {
                $barang->addMedia(storage_path('tmp/uploads/' . $request->input('photo')))->toMediaCollection('photo');
            }
        } elseif ($barang->photo) {
            $barang->photo->delete();
        }

        return (new BarangResource($barang))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }
}
