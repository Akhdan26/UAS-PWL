@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.jenis.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.jenises.update", $jenis['id_jenis']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('nama_jenis') ? 'has-error' : '' }}">
                <label for="nama_jenis">Nama Jenis</label>
                <input id="nama_jenis" name="nama_jenis" class="form-control" value="{{ old('nama_jenis', isset($jenis) ? $jenis['nama_jenis'] : '') }}" >
                @if($errors->has('nama_jenis'))
                    <p class="help-block">
                        {{ $errors->first('nama_jenis') }}
                    </p>
                @endif
                <p class="helper-block">
                    
                </p>
            </div>

            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection
