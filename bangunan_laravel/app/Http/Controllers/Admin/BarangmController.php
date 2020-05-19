<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use App\Barang;
use App\Satuan;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BarangmController extends Controller
{
    use MediaUploadingTrait;

    public function __construct()
    {
        $this->urls = 'http://localhost/bangunan_codeigniter/api/jenis';
        $this->urls1 = 'http://localhost/bangunan_codeigniter/api/barangm';
        $this->urls2 = 'http://localhost/bangunan_codeigniter/api/supplier';

    }

    public function getSupplier(){
        $client = new Client();

        $request = $client->get($this->urls2);
        $response = $request->getBody()->getContents();
        $supplier = collect(json_decode($response, true))->collapse()->all();

        return $supplier;
    }

    public function getBarangm(){
        $client = new Client();

        $request = $client->get($this->urls1);
        $response = $request->getBody()->getContents();
        $barangm = collect(json_decode($response, true))->collapse()->all();

        return $barangm;
    }

    public function index()
    {
        $client = new Client();

        abort_if(Gate::denies('barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barangs = Barang::all();
        $barangm = $this->getBarangm();
        $supplier = $this->getSupplier();

        return view('admin.barangm.index', compact('barangs'), ['barangm'=>$barangm, 'supplier'=>$supplier]);
    }

    public function create()
    {
        $client = new Client();

        abort_if(Gate::denies('barang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barangs = Barang::all();
        $barangm = $this->getBarangm();
        $supplier = $this->getSupplier();
        return view('admin.barangm.create', compact('barangs'), ['barangm'=>$barangm, 'supplier'=>$supplier]);
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST',$this->urls1, [
            'form_params' => [
                'id_barang_masuk' => $request->input('id'),
                'user_id' => "1",
                'supplier_id' => $request->input('supplier_id'),
                'barang_id' => $request->input('barang_id'),
                'jumlah_masuk' => $request->input('jumlah_masuk'),
                'tanggal_masuk' => $request->input('tanggal_masuk'),
            ]
        ]);

        $a = Barang::find($request->input('barang_id'));
        $stok = $a['stok'] + $request->input('jumlah_masuk');
        $id = $request->input('barang_id');
        // Barang::where('id', ($request->input('id'))->update(array('stok' => $stok)));
        DB::table('barang')
            ->where('id', $id)
            ->update(['stok' => $stok]);

        return redirect()->route('admin.barangm.index');
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

    public function destroy($barang)
    {
        abort_if(Gate::denies('barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = new Client();
        
        $options = ['debug' => false, 'form_params' => ['id_barang_masuk' => $barang]];
        $client->delete($this->urls1, $options);

        return back();
    }
}
