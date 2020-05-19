@extends('layouts.admin')
@section('content')
@can('barang_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.barangk.create") }}">
                {{ trans('global.add') }} {{ trans('cruds.barang.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.barangk.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Plane">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.barangk.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.barangk.fields.user_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.barangk.fields.barang_id') }}
                        </th>
                        <th>
                            {{ trans('cruds.barangk.fields.jumlah_keluar') }}
                        </th>
                        <th>
                            {{ trans('cruds.barangk.fields.tanggal_keluar') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($barangk as $key => $bgk)
                        <tr data-entry-id="{{ $bgk['id_barang_keluar']  }}">
                            <td>

                            </td>
                            <td>
                                {{ $bgk['id_barang_keluar'] ?? '' }}
                            </td>
                            <td>
                                {{ $bgk['user_id'] ?? '' }}
                            </td>
                            <td>
                                {{ $bgk['barang_id'] ?? '' }}
                            </td>
                            <td>
                                {{ $bgk['jumlah_keluar'] ?? '' }}
                            </td>
                            <td>
                                {{ $bgk['tanggal_keluar'] ?? '' }}
                            </td>
                            <td>
                                {{-- @can('barang_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.barangs.edit', $bgk->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan --}}

                                @can('barang_delete')
                                    <form action="{{ route('admin.barangk.destroy', $bgk['id_barang_keluar']) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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