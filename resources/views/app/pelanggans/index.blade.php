@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <h1>List Pelanggan</h1>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Pelanggan::class)
                        <a href="{{ route('pelanggans.create') }}" class="btn btn-primary">
                            <i class="icon ion-md-add"></i> @lang('crud.common.create')
                        </a>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.kode_pelanggan')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.nama')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.alamat')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.no_telp')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.email')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $pelanggan->kode_pelanggan ?? '-' }}</td>
                                    <td>{{ $pelanggan->nama ?? '-' }}</td>
                                    <td>{{ $pelanggan->alamat ?? '-' }}</td>
                                    <td>{{ $pelanggan->no_telp ?? '-' }}</td>
                                    <td>{{ $pelanggan->email ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $pelanggan)
                                                <a href="{{ route('pelanggans.edit', $pelanggan) }}">
                                                    <button type="button" class="btn btn-light">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>
                                                </a>
                                                @endcan @can('delete', $pelanggan)
                                                <form action="{{ route('pelanggans.destroy', $pelanggan) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="button" class="btn btn-light text-danger btn-delete">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Sweet alert
        $('.btn-delete').on('click', function(e) {
            let nama_produk = $(this).closest('tr').find('td:eq(0)').text();
            Swal.fire({
                icon: 'error',
                title: 'Hapus Data',
                html: 'Apakah Yakin data ini akan dihapus?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                denyButtonText: 'Tidak',
                showDenyButon: true,
                focusConfirm: false
            }).then((result) => {
                if (result.isConfirmed) $(e.target).closest('form').submit()
                else swal.close()
            })
        })
    </script>
@endpush
