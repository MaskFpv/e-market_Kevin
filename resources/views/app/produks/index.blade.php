@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>List Produk</h1>
                </div>
                <div class="col-md-6 text-right">
                    <button type="button" class="btn btn-success">
                        <a href="{{ route('export_produks') }}" style="text-decoration: none; color:azure;">Export XLS</a>
                    </button>
                    @can('create', App\Models\Produk::class)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-tambah"
                            data-mode="tambah">
                            <i class="icon ion-md-add"></i> Tambah
                        </button>
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
                                    @lang('crud.produk.inputs.nama_produk')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks as $produk)
                                <tr>
                                    <td>{{ $produk->nama_produk ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $produk)
                                                <div>
                                                    <button type="button" class="btn btn-light" data-mode="edit"
                                                        data-bs-toggle="modal" data-bs-target="#modal-tambah"
                                                        data-id="{{ $produk->id }}" data-name="{{ $produk->nama_produk }}">
                                                        <i class="icon ion-md-create"></i>
                                                    </button>

                                                </div>
                                                @endcan @can('delete', $produk)
                                                <form action="{{ route('produks.destroy', $produk) }}" method="POST">
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
                                    <td colspan="2">
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
    @include('app.produks.form-inputs')
@endsection
@push('scripts')
    <script>
        $('#modal-tambah').on('show.bs.modal', function(e) {
            const btn = $(e.relatedTarget)
            const mode = btn.data('mode')
            const nama_produk = btn.data('name')
            const id = btn.data('id')
            const modal = $(this)
            console.log(mode)
            if (mode === 'edit') {
                modal.find('.modal-title').text('Edit Data Produk')
                modal.find('#produkId').val(nama_produk)
                modal.find('.modal-body form').attr('action', '{{ url('produks') }}/' + id)
                modal.find('#method').html('@method('PATCH')')
            } else {
                modal.find('.modal-title').text('Input Data Produk')
                modal.find('#produkId').val()
                modal.find('.modal-body form').attr('action', '{{ url('produks') }}/')
                modal.find('#method').html('')
            }
        })

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
