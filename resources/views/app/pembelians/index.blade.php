@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">
                <h5>Pembelian Barang / Stock Opname</h5>
            </div>
            <div class="card-body">
                <form class="" id="formTransaksi" method="post" action="pembelians">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="kode-pembelian" class="control-label col-md-6 col-sm-6 col-xs-12">Kode
                                Pembelian</label>
                            <div class="col-8">
                                <input type="text" class="form-control form-control-sm" id="kode-pembelian"
                                    placeholder="" readonly value="{{ $kode }}" name="kode_masuk">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12">Tanggal Pembelian</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input class="date-picker form-control col-md-7 col-xs-12" required="required"
                                    type="date" value="{{ date('Y-m-d') }}" name="tanggal_masuk">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group"> <label
                                class="control-label col-md-3 col-sm-3 col-xs-12">&nbsp;
                            </label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <button type="button" class="btn btn-primary" id="tambahBarangBtn" data-toggle="modal"
                                    data-target="#tblBarangModal">Tambah Barang</button>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                            <label class="control-label col-md-6 col-sm-6 col-xs-12">
                                Distributor
                            </label>
                            <div class="col-md-6 col-sm-9 col-xs-12">
                                <select class="form-control col-md-6 col-xs-12" required="required" name="pemasok_id">
                                    @foreach ($pemasok as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_pemasok }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h3>Barang</h3>
                            <table id="tblTransaksi" class="table table-striped table-bordered bulk_action mt-3">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="6" style="text-align:center; font-style:italic">Belum ada data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end" style="text-align: right;">
                        <label class="control-label col-md-2 col-sm-2 offset-md-7">Total Harga</label>
                        <div class="col-md-3 mr-md-auto" style="padding-right: 10px;align-content: right;">
                            <input class="form-control col-md-8 col-xs-12" style="margin-left: auto;" required="required"
                                type="text" readonly id="totalHarga" name="total">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-6 col-xs-12"
                            style="text-align: right; margin-right:0; padding-right:1rem; margin-top:20px">
                            <div class="col-md-12 col-sm-9 col-xs-12">
                                <button type="submit" class="btn btn-success simpanTransaksi">Simpan Transaksi</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    @include('app.pembelians.form-inputs')
    @if ($errors->any())
        <script>
            console.log(`{{ $errors->first() }}`)
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        $(function() {
            $('#tblBarang2').DataTable()
            // Pemilihan Barang
            $('#tblBarangModal').on('click', '.pilihBarangBtn', function() {
                tambahBarang(this);
            })
            //Change qty event
            $('#tblTransaksi').on('change', '.qty', function() {
                calcSubtotal(this);
            });

            $('.simpanTransaksi').on("click", () => {
                $("#formTransaksi").submit();
            })
            // remove barang
            $('#tblTransaksi').on('click', '.btn-delete', function() {
                console.log(true)
                let subTotalAwal = parseFloat($(this).closest('tr').find('.subTotal').val());
                totalHarga -= subTotalAwal;

                $currentRow = $(this).closest('tr').remove();
                $('#totalHarga').val(totalHarga);

                let tbody = Number($('#tblTransaksi tbody').text());
                if (tbody == 0)
                    $('#tblTransaksi tbody').append(
                        '<tr><td colspan="6" style="text-align: center; font-style: italic">Belum Ada Data</td></tr>'
                    )
            });
        })

        let totalHarga = 0;

        function tambahBarang(a) {
            let d = $(a).closest('tr');
            let kodeBarang = d.find('td:eq(1)').text();
            let namaBarang = d.find('td:eq(2)').text();
            let hargaBarang = d.find('td:eq(3)').text();
            let idBarang = d.find('.idBarang').val();
            let data = '';
            let tbody = $('#tblTransaksi tbody tr td').text();
            totalHarga += parseFloat(hargaBarang);
            data += '<tr>';
            data += '<td>' + kodeBarang + '</td>';
            data += '<td>' + namaBarang + '</td>';
            data += '<td>' + hargaBarang + '</td>';
            data += '<input type="hidden" name="barang_id[]" value="' + idBarang + '">';
            data += '<input type="hidden" name="harga_beli[]" value="' + hargaBarang + '">';
            data += '<input type="hidden" name="total" value="' + totalHarga + '">';
            data += '<td><input type="number" value="1" min="1" class="qty" name="jumlah[]"></td>';
            data += '<td><input type="text" readonly name="sub_total[]" class="subTotal" value="' + hargaBarang + '"></td>';
            data +=
                '<td><button type="button" class="btn btn-light text-danger btn-delete"><span class="icon ion-md-trash"></span></button></td>';
            data += '</tr>';

            if (tbody == 'Belum ada data') $('#tblTransaksi tbody tr').remove();

            $('#tblTransaksi tbody').append(data);

            $('#totalHarga').val(totalHarga);
            $('#tblBarangModal').modal('hide');
        }

        function calcSubtotal(a) {
            let qty = parseInt($(a).closest('tr').find('.qty').val());
            let hargaBarang = parseFloat($(a).closest('tr').find('td:eq(2)').text());
            let subTotalAwal = parseFloat($(a).closest('tr').find('.subTotal').val());
            let subTotal = qty * hargaBarang;
            totalHarga += subTotal - subTotalAwal;
            $(a).closest('tr').find('.subTotal').val(subTotal);
            $('#totalHarga').val(totalHarga);
        }


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
