@extends('layouts.admin')
@section('content')
@can('barang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.barangs.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.barang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.barang.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Plane">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.barang.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.barang.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.barang.fields.photos') }}
                        </th>
                        <th>
                            {{ trans('cruds.barang.fields.stok') }}
                        </th>
                        <th>
                            {{ trans('cruds.barang.fields.satuan') }}
                        </th>
                        <th>
                            {{ trans('cruds.barang.fields.jenis') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangs as $key => $barang)
                        <tr data-entry-id="{{ $barang->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $barang->id ?? '' }}
                            </td>
                            <td>
                                {{ $barang->name ?? '' }}
                            </td>
                            <td>
                                @if($barang->photos)
                                    <a href="{{ $barang->photos->getUrl() }}" target="_blank">
                                        <img src="{{ $barang->photos->getUrl('thumb') }}" width="50px" height="50px">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $barang->stok ?? '' }}
                            </td>
                            <td>
                                {{ $barang->satuan->name ?? '' }}
                            </td>
                            <td>
                                @foreach ($jenises as $jen)
                                    @if($barang['jenis_id']==$jen['id_jenis'])
                                        {{ $jen['nama_jenis'] ?? '' }}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @can('barang_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.barangs.show', $barang->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('barang_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.barangs.edit', $barang->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('barang_delete')
                                    <form action="{{ route('admin.barangs.destroy', $barang->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('barang_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.barangs.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  $('.datatable-Plane:not(.ajaxTable)').DataTable({ buttons: dtButtons })
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
        $($.fn.dataTable.tables(true)).DataTable()
            .columns.adjust();
    });
})

</script>
@endsection