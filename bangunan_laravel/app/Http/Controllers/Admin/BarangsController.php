<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBarangRequest;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Barang;
use App\Satuan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BarangsController extends Controller
{
    use MediaUploadingTrait;

    public function __construct()
    {
        $this->urls = 'http://localhost/bangunan_codeigniter/api/jenis';
    }

    public function index()
    {
        $client = new Client();

        abort_if(Gate::denies('barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barangs = Barang::all();

        $request = $client->get($this->urls);
        $response = $request->getBody()->getContents();
        $jenises = collect(json_decode($response, true))->collapse()->all();

        return view('admin.barangs.index', compact('barangs'), ['jenises'=>$jenises]);
    }

    public function create()
    {
        $client = new Client();

        abort_if(Gate::denies('barang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satuans = Satuan::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

		$request = $client->get($this->urls);
        $response = $request->getBody()->getContents();

        $jenises = collect(json_decode($response, true))->collapse()->all();

        $barangs = DB::table('barang')->max('id');
        
        ++$barangs;

        return view('admin.barangs.create', compact('barangs','satuans'),['jenises'=>$jenises]);
    }

    public function store(StoreBarangRequest $request)
    {
        $barang = Barang::create($request->all());

        if ($request->input('photos', false)) {
            $barang->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
        }

        return redirect()->route('admin.barangs.index');
    }

    public function edit(Barang $barang)
    {
        $client = new Client();

        abort_if(Gate::denies('barang_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $satuans = Satuan::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $request = $client->get($this->urls);
        $response = $request->getBody()->getContents();
        $jenises = collect(json_decode($response, true))->collapse()->all();

        $barang->load('satuan');

        return view('admin.barangs.edit', compact('satuans', 'barang'), ['jenises'=>$jenises]);
    }

    public function update(UpdateBarangRequest $request, Barang $barang)
    {
        $barang->update($request->all());

        if ($request->input('photos', false)) {
            if (!$barang->photos || $request->input('photos') !== $barang->photos->file_name) {
                $barang->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
            }
        } elseif ($barang->photos) {
            $barang->photos->delete();
        }
        
        return redirect()->route('admin.barangs.index');
    }

    public function show(Barang $barang)
    {
        $client = new Client();

        abort_if(Gate::denies('barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barang->load('satuan');
        
        $request = $client->get($this->urls);
        $response = $request->getBody()->getContents();
        $jenises = collect(json_decode($response, true))->collapse()->all();

        return view('admin.barangs.show', compact('barang'), ['jenises'=>$jenises]);
    }

    public function destroy(Barang $barang)
    {
        abort_if(Gate::denies('barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barang->delete();

        return back();
    }

    public function massDestroy(MassDestroyBarangRequest $request)
    {
        Barang::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
