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

class BarangkController extends Controller
{
    use MediaUploadingTrait;

    public function __construct()
    {
        $this->urls = 'http://localhost/bangunan_codeigniter/api/jenis';
        $this->urls1 = 'http://localhost/bangunan_codeigniter/api/barangk';
        // $this->urls2 = 'http://localhost/bangunan_codeigniter/api/supplier';

    }

    // public function getSupplier(){
    //     $client = new Client();

    //     $request = $client->get($this->urls2);
    //     $response = $request->getBody()->getContents();
    //     $supplier = collect(json_decode($response, true))->collapse()->all();

    //     return $supplier;
    // }

    public function getBarangk(){
        $client = new Client();

        $request = $client->get($this->urls1);
        $response = $request->getBody()->getContents();
        $barangk = collect(json_decode($response, true))->collapse()->all();

        return $barangk;
    }

    // public function getJenis(){
    //     $client = new Client();

    //     $request = $client->get($this->urls);
    //     $response = $request->getBody()->getContents();
    //     $jenises = collect(json_decode($response, true))->collapse()->all();

    //     return $jenises;
    // }

    public function index()
    {
        $client = new Client();

        abort_if(Gate::denies('barang_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barangs = Barang::all();
        $barangk = $this->getBarangk();

        return view('admin.barangk.index', compact('barangs'), ['barangk'=>$barangk]);
    }

    public function create()
    {
        $client = new Client();

        abort_if(Gate::denies('barang_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $barangs = Barang::all();
        $barangk = $this->getBarangk();
        return view('admin.barangk.create', compact('barangs'), ['barangk'=>$barangk]);
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST',$this->urls1, [
            'form_params' => [
                'id_barang_keluar' => $request->input('id'),
                'user_id' => "1",
                'barang_id' => $request->input('barang_id'),
                'jumlah_keluar' => $request->input('jumlah_keluar'),
                'tanggal_keluar' => $request->input('tanggal_keluar'),
            ]
        ]);

        $a = Barang::find($request->input('barang_id'));
        $stok = $a['stok'] - $request->input('jumlah_keluar');
        $id = $request->input('barang_id');
        // Barang::where('id', ($request->input('id'))->update(array('stok' => $stok)));
        DB::table('barang')
            ->where('id', $id)
            ->update(['stok' => $stok]);

        return redirect()->route('admin.barangk.index');
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

    // public function update(UpdateBarangRequest $request, Barang $barang)
    // {
    //     $barang->update($request->all());

    //     if ($request->input('photos', false)) {
    //         if (!$barang->photos || $request->input('photos') !== $barang->photos->file_name) {
    //             $barang->addMedia(storage_path('tmp/uploads/' . $request->input('photos')))->toMediaCollection('photos');
    //         }
    //     } elseif ($barang->photos) {
    //         $barang->photos->delete();
    //     }
        
    //     return redirect()->route('admin.barangs.index');
    // }

    // public function show(Barang $barang)
    // {
    //     $client = new Client();

    //     abort_if(Gate::denies('barang_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     $barang->load('satuan');
        
    //     $request = $client->get($this->urls);
    //     $response = $request->getBody()->getContents();
    //     $jenises = collect(json_decode($response, true))->collapse()->all();

    //     return view('admin.barangs.show', compact('barang'), ['jenises'=>$jenises]);
    // }

    public function destroy($barang)
    {
        abort_if(Gate::denies('barang_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client = new Client();
        
        $options = ['debug' => false, 'form_params' => ['id_barang_keluar' => $barang]];
        $client->delete($this->urls1, $options);

        return back();
    }
}
