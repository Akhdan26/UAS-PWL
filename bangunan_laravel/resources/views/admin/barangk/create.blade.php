@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.barang.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.barangk.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('id') ? 'has-error' : '' }}">
                <label for="id">{{ trans('cruds.barang.fields.id') }}*</label>
                <input readonly type="text" id="id" name="id" class="form-control" value="{{ 'T-BK-20040'.rand(500001,5900001) }}" required>
                @if($errors->has('id'))
                    <p class="help-block">
                        {{ $errors->first('id') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barang.fields.id_helper') }}
                </p>
            </div>

            <div class="form-group {{ $errors->has('tanggal_keluar') ? 'has-error' : '' }}">
                <label for="tanggal_keluar">{{ trans('cruds.barangk.fields.tanggal_keluar') }}</label>
                <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="form-control" value="{{ old('tanggal_keluar', isset($barang) ? $barang->tanggal_keluar : '') }}" required>
                @if($errors->has('tanggal_keluar'))
                    <p class="help-block">
                        {{ $errors->first('tanggal_keluar') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barangk.fields.tanggal_keluar_helper') }}
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

            <div class="form-group {{ $errors->has('jumlah_keluar') ? 'has-error' : '' }}">
                <label for="jumlah_keluar">{{ trans('cruds.barangk.fields.jumlah_keluar') }}*</label>
                <input type="text" id="jumlah_keluar" name="jumlah_keluar" class="form-control" value="" required>
                @if($errors->has('jumlah_keluar'))
                    <p class="help-block">
                        {{ $errors->first('jumlah_keluar') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barangk.fields.id_helper') }}
                </p>
            </div>
            
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

