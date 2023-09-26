@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-6 text-left">
                    <h1>List Barang</h1>
                </div>
                <div class="col-md-6 text-right">
                    @can('create', App\Models\Barang::class)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal"
                            data-mode="add">
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
                                    No
                                </th>
                                <th class="text-left">
                                    @lang('crud.barang.inputs.kode_barang')
                                </th>
                                <th class="text-left">
                                    @lang('crud.barang.inputs.nama_barang')
                                </th>
                                <th class="text-left">
                                    @lang('crud.barang.inputs.satuan')
                                </th>
                                <th class="text-right">
                                    @lang('crud.barang.inputs.harga_jual')
                                </th>
                                <th class="text-left">
                                    @lang('crud.barang.inputs.stock')
                                </th>
                                <th class="text-right">
                                    @lang('crud.barang.inputs.ditarik')
                                </th>
                                <th class="text-left">
                                    @lang('crud.barang.inputs.user_id')
                                </th>
                                <th class="text-left">
                                    @lang('crud.barang.inputs.produk_id')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangs as $barang)
                                <tr>
                                    <td>{{ $i = !isset($i) ? 1 : ++$i }}<input type="hidden" class="idBarang"
                                            name="barang_id" value="{{ $barang->id }}"></td>
                                    <td>{{ $barang->kode_barang ?? '-' }}</td>
                                    <td>{{ $barang->nama_barang ?? '-' }}</td>
                                    <td>{{ $barang->satuan ?? '-' }}</td>
                                    <td>{{ $barang->harga_jual ?? '-' }}</td>
                                    <td>{{ $barang->stock ?? '-' }}</td>
                                    <td>{{ $barang->ditarik ?? '-' }}</td>
                                    <td>{{ optional($barang->user)->name ?? '-' }}</td>
                                    <td>
                                        {{ optional($barang->produk)->nama_produk ?? '-' }}
                                    </td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $barang)
                                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                    data-bs-target="#form-modal" data-mode="edit"
                                                    data-id="{{ $barang->id }}">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            @endcan
                                            @can('delete', $barang)
                                                <form action="{{ route('barangs.destroy', $barang) }}" method="POST">
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
                                    <td colspan="9">
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
    @include('app.barangs.form-inputs')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#form-modal").on("show.bs.modal", event => {
                const btn = $(event.relatedTarget)
                const modal = $(this)
                let mode = $(btn).data("mode")
                switch (mode) {
                    case "add":
                        modal.find(".modal-title").text("Tambah Data Barang")
                        modal.find("#method").html("")
                        setValue(modal)

                        modal.find("#modal-body form").attr("action", "/barangs")
                        break;
                    case "edit":
                        let idBarang = $(btn).data("id")
                        let object = JSON.stringify(@json($barangs))
                        let allBarang = JSON.parse(object)
                        let barang = allBarang.find(item => item.id === idBarang)

                        setValue(barang.kode_barang, barang.nama_barang, barang.satuan, barang.harga_jual,
                            barang.stock, barang.produk.id)

                        modal.find(".modal-title").text("Edit Data Barang")
                        modal.find('#method').html(`@method('PUT')`)
                        modal.find(".modal-body form").attr("action",
                            `{{ url('barangs') }}/ ${idBarang}`)
                }
            })
        })


        function setValue(kodeBarangs = "", namaBarangs = "", satuan = "", hargaJual = "", stock = "", produk = "") {
            let modal = $("#form-modal")
            modal.find(".kode").val(kodeBarangs)
            modal.find(".nama-barang").val(namaBarangs)
            modal.find(".satuan").val(satuan)
            modal.find(".harga-jual").val(hargaJual)
            modal.find(".stock").val(stock)
            modal.find(".produk").val(produk)

            return true
        }

        // Sweet alert
        $('.btn-delete').on('click', function(e) {
            let nama_barang = $(this).closest('tr').find('td:eq(0)').text();
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
