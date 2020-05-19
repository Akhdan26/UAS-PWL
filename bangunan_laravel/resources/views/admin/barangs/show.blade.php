@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.barang.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.barang.fields.id') }}
                        </th>
                        <td>
                            {{ $barang->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.barang.fields.name') }}
                        </th>
                        <td>
                            {{ $barang->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.barang.fields.stok') }}
                        </th>
                        <td>
                            {{ $barang->stok }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.barang.fields.photos') }}
                        </th>
                        <td>
                            @if($barang->photos)
                                <a href="{{ $barang->photos->getUrl() }}" target="_blank">
                                    <img src="{{ $barang->photos->getUrl('thumb') }}" width="50px" height="50px">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.barang.fields.satuan') }}
                        </th>
                        <td>
                            {{ $barang->satuan->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.barang.fields.jenis') }}
                        </th>
                        <td>
                            @foreach ($jenises as $jen)
                                @if($barang['jenis_id']==$jen['id_jenis'])
                                    {{ $jen['nama_jenis'] ?? '' }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>


    </div>
</div>
@endsection