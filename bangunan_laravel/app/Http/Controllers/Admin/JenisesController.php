<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Request as GRequest;
use GuzzleHttp\Client;
use App\Paket;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class JenisesController
{
    private $urls;

    public function __construct()
    {
        $this->urls = 'http://localhost/bangunan_codeigniter/api/jenis';
    }
    
    public function index()
    {
        $client = new Client();
		$request = $client->get($this->urls);
        $response = $request->getBody()->getContents();
        $jenis = collect(json_decode($response, true))->collapse()->all();
        
        return view('admin.jenises.index', ['jenis'=>$jenis]);
    }

    public function destroy($jenis)
    {
        $client = new Client();
        abort_if(Gate::denies('jenis_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $options = ['debug' => false, 'form_params' => ['id_jenis' => $jenis]];
        $client->delete($this->urls, $options);
        
        return back();
    }

    public function create()
    {
        abort_if(Gate::denies('jenis_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.jenises.create');
    }

    public function store(Request $request)
    {
        $client = new Client();

        $response = $client->request('POST',$this->urls, [
            'form_params' => [
                'nama_jenis' => $request->input('name'),
            ]
        ]);

        return redirect()->route('admin.jenises.index');
    }

    public function edit($id)
    {
        abort_if(Gate::denies('jenis_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $client = new Client();

        $response = $client->request('GET',$this->urls, [
            'query' => [
                'id_jenis' => $id
            ]
        ]);

        $result = $response->getBody()->getContents();
        $jenis['jenis'] = collect(json_decode($result, true))->collapse()->all();

        return view('admin.jenises.edit', $jenis);
    }

    public function update(Request $request, $jenis)
    {
        $client = new Client();
        $response = $client->request('PUT',$this->urls, [
            'form_params' => [
                'id_jenis' => $jenis, 
                'nama_jenis' => $request->input('nama_jenis')
            ]
        ]);
        return redirect()->route('admin.jenises.index');
    }
}
