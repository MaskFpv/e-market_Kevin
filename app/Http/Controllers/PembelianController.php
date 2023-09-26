<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Pemasok;
use App\Models\Pembelian;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Requests\PembelianStoreRequest;
use App\Http\Requests\PembelianUpdateRequest;
use App\Models\DetailPembelian;
use Illuminate\Support\Facades\Auth;

class PembelianController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Pembelian::class);

        $lastId = Pembelian::select('kode_masuk')->latest()->first();
        $data['kode'] = ($lastId == null ? 'P00000001' : sprintf('P%08d', substr($lastId->kode_masuk, 1) + 1));
        $data['pemasok'] = Pemasok::get();
        $data['barang'] = Barang::get();

        return view('app.pembelians.index')->with($data);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Pembelian::class);

        $pemasoks = Pemasok::pluck('nama_pemasok', 'id');
        $users = User::pluck('name', 'id');

        return view('app.pembelians.create', compact('pemasoks', 'users'));
    }

    /**
     * @param \App\Http\Requests\PembelianStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembelianStoreRequest $request)
    {
        $user = Auth::user();
        // input pembelian
        $data['kode_masuk'] = $request['kode_masuk'];
        $data['tanggal_masuk'] = $request['tanggal_masuk'];
        $data['total'] = $request['total'];
        $data['pemasok_id'] = $request['pemasok_id'];
        $data['user_id'] = $user->id;

        $input_pembelian = Pembelian::create($data);

        // input detail pembelian
        $barang_id = $request->barang_id;
        $harga_beli = $request->harga_beli;
        $jumlah = $request->jumlah;
        $sub_total = $request->sub_total;
        // dd($barang_id);
        $data4 = [];

        foreach ($barang_id as $i => $v) {
            $data2['pembelian_id'] = $input_pembelian->id;
            $data2['barang_id'] = $barang_id[$i];
            $data2['harga_beli'] = $harga_beli[$i];
            $data2['jumlah'] = $jumlah[$i];
            $data2['sub_total'] = $sub_total[$i];
            $input_detail_pembelian = DetailPembelian::create($data2);
            $data4[] = $data2;
        }

        return $this->invoiceCreate($data, $data4);
    }

    public function invoiceCreate($data)
    {

        $dataId = $data['kode_masuk'];

        $pembelian = Pembelian::with('pemasok', 'detailPembelians')->where('kode_masuk', $dataId)->first();

        return view('app.pembelians.invoice', compact('pembelian'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembelian $pembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pembelian $pembelian)
    {
        $this->authorize('update', $pembelian);

        $pemasoks = Pemasok::pluck('nama_pemasok', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.pembelians.edit',
            compact('pembelian', 'pemasoks', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\PembelianUpdateRequest $request
     * @param \App\Models\Pembelian $pembelian
     * @return \Illuminate\Http\Response
     */
    public function update(
        PembelianUpdateRequest $request,
        Pembelian $pembelian
    ) {
        $this->authorize('update', $pembelian);

        $validated = $request->validated();

        $pembelian->update($validated);

        return redirect()
            ->route('pembelians.edit', $pembelian)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembelian $pembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pembelian $pembelian)
    {
        $this->authorize('delete', $pembelian);

        $pembelian->delete();

        return redirect()
            ->route('pembelians.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
