<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPembelianResource;
use App\Http\Resources\DetailPembelianCollection;

class BarangDetailPembeliansController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Barang $barang)
    {
        $this->authorize('view', $barang);

        $search = $request->get('search', '');

        $detailPembelians = $barang
            ->detailPembelians()
            ->search($search)
            ->latest()
            ->paginate();

        return new DetailPembelianCollection($detailPembelians);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barang $barang)
    {
        $this->authorize('create', DetailPembelian::class);

        $validated = $request->validate([
            'pembelian_id' => ['required', 'exists:pembelians,id'],
            'harga_beli' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ]);

        $detailPembelian = $barang->detailPembelians()->create($validated);

        return new DetailPembelianResource($detailPembelian);
    }
}
