@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.barang.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.barangm.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                <label for="id">{{ trans('cruds.barang.fields.id') }}*</label>
                <input readonly type="text" id="id" name="id" class="form-control" value="{{ 'T-BM-20040'.rand(500001,5900001) }}" required>
                @if($errors->has('id'))
                    <p class="help-block">
                        {{ $errors->first('id') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barang.fields.id_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('tanggal_masuk') ? 'has-error' : '' }}">
                <label for="tanggal_masuk">{{ trans('cruds.barangm.fields.tanggal_masuk') }}</label>
                <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="{{ old('tanggal_masuk', isset($barang) ? $barang->tanggal_masuk : '') }}" required>
                @if($errors->has('tanggal_masuk'))
                    <p class="help-block">
                        {{ $errors->first('tanggal_masuk') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barangm.fields.tanggal_masuk_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('barang_id') ? 'has-error' : '' }}">
                <label for="barang">Nama Barang*</label>
                <select name="barang_id" id="barang_id" class="form-control select">
                    @foreach($barangs as $brg)
                        <option value="{{ $brg->id }}" >{{ $brg->name }}</option>
                    @endforeach
                </select>
                @if($errors->has('barang'))
                    <p class="help-block">
                        {{ $errors->first('barang') }}
                    </p>
                @endif
                <p class="helper-block">
                    
                </p>
            </div>

            <div class="form-group {{ $errors->has('supplier_id') ? 'has-error' : '' }}">
                <label for="supplier">Nama Barang*</label>
                <select name="supplier_id" id="supplier_id" class="form-control select">
                    @foreach($supplier as $sup)
                        <option value="{{ $sup['id_supplier'] }}" >{{ $sup['nama_supplier'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('supplier'))
                    <p class="help-block">
                        {{ $errors->first('supplier') }}
                    </p>
                @endif
                <p class="helper-block">
                    
                </p>
            </div>

            <div class="form-group {{ $errors->has('jumlah_masuk') ? 'has-error' : '' }}">
                <label for="jumlah_masuk">{{ trans('cruds.barangm.fields.jumlah_masuk') }}*</label>
                <input type="text" id="jumlah_masuk" name="jumlah_masuk" class="form-control" value="" required>
                @if($errors->has('jumlah_masuk'))
                    <p class="help-block">
                        {{ $errors->first('jumlah_masuk') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barangm.fields.id_helper') }}
                </p>
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

