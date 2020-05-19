@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.barang.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.barangs.update", [$barang->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.barang.fields.name') }}*</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($barang) ? $barang->name : '') }}" required>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barang.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('stok') ? 'has-error' : '' }}">
                <label for="stok">{{ trans('cruds.barang.fields.stok') }}*</label>
                <input type="text" id="stok" name="stok" class="form-control" value="{{ old('stok', isset($barang) ? $barang->stok : '') }}" required>
                @if($errors->has('stok'))
                    <p class="help-block">
                        {{ $errors->first('stok') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barang.fields.stok_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('photos') ? 'has-error' : '' }}">
                <label for="photos">{{ trans('cruds.barang.fields.photos') }}</label>
                <div class="needsclick dropzone" id="photos-dropzone">
                </div>
                @if($errors->has('photos'))
                    <p class="help-block">
                        {{ $errors->first('photos') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.barang.fields.photos_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('satuan_id') ? 'has-error' : '' }}">
                <label for="satuan">{{ trans('cruds.barang.fields.satuan') }}</label>
                <select name="satuan_id" id="satuan" class="form-control select">
                    @foreach($satuans as $id => $satuan)
                        <option value="{{ $id }}" {{ (isset($barang) && $barang->satuan ? $barang->satuan->id : old('satuan_id')) == $id ? 'selected' : '' }}>{{ $satuan }}</option>
                    @endforeach
                </select>
                @if($errors->has('satuan_id'))
                    <p class="help-block">
                        {{ $errors->first('satuan_id') }}
                    </p>
                @endif
            </div>
            <div class="form-group {{ $errors->has('jenis_id') ? 'has-error' : '' }}">
                <label for="jenis">{{ trans('cruds.barang.fields.jenis') }}</label>
                <select name="jenis_id" id="jenis_id" class="form-control select">
                    @foreach($jenises as $jen)
                        <option value="{{ strtolower($jen['id_jenis']) }}" >{{ $jen['nama_jenis'] }}</option>
                    @endforeach
                </select>
                @if($errors->has('jenis_id'))
                    <p class="help-block">
                        {{ $errors->first('jenis_id') }}
                    </p>
                @endif
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    Dropzone.options.photosDropzone = {
    url: '{{ route('admin.barangs.storeMedia') }}',
    maxFilesize: 2, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="photos"]').remove()
      $('form').append('<input type="hidden" name="photos" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="photos"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($barang) && $barang->photos)
      var file = {!! json_encode($barang->photos) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="photos" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
    error: function (file, response) {
        if ($.type(response) === 'string') {
            var message = response //dropzone sends it's own error messages in string
        } else {
            var message = response.errors.file
        }
        file.previewElement.classList.add('dz-error')
        _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
        _results = []
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i]
            _results.push(node.textContent = message)
        }

        return _results
    }
}
</script>
@stop