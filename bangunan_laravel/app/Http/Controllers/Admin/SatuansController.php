<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySatuanRequest;
use App\Http\Requests\StoreSatuanRequest;
use App\Http\Requests\UpdateSatuanRequest;
use App\Satuan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SatuansController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('satuan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satuans = Satuan::all();

        return view('admin.satuans.index', compact('satuans'));
    }

    public function create()
    {
        abort_if(Gate::denies('satuan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuans.create');
    }

    public function store(StoreSatuanRequest $request)
    {
        $satuan = Satuan::create($request->all());

        return redirect()->route('admin.satuans.index');
    }

    public function edit(Satuan $satuan)
    {
        abort_if(Gate::denies('satuan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuans.edit', compact('satuan'));
    }

    public function update(UpdateSatuanRequest $request, Satuan $satuan)
    {
        $satuan->update($request->all());

        return redirect()->route('admin.satuans.index');
    }

    public function show(Satuan $satuan)
    {
        abort_if(Gate::denies('satuan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.satuans.show', compact('satuan'));
    }

    public function destroy(Satuan $satuan)
    {
        abort_if(Gate::denies('satuan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satuan->delete();

        return back();
    }

    public function massDestroy(MassDestroySatuanRequest $request)
    {
        Satuan::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
