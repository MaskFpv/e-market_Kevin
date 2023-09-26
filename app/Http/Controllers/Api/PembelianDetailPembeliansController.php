<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPembelianResource;
use App\Http\Resources\DetailPembelianCollection;

class PembelianDetailPembeliansController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembelian $pembelian
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pembelian $pembelian)
    {
        $this->authorize('view', $pembelian);

        $search = $request->get('search', '');

        $detailPembelians = $pembelian
            ->detailPembelians()
            ->search($search)
            ->latest()
            ->paginate();

        return new DetailPembelianCollection($detailPembelians);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembelian $pembelian
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pembelian $pembelian)
    {
        $this->authorize('create', DetailPembelian::class);

        $validated = $request->validate([
            'barang_id' => ['required', 'exists:barangs,id'],
            'harga_beli' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ]);

        $detailPembelian = $pembelian->detailPembelians()->create($validated);

        return new DetailPembelianResource($detailPembelian);
    }
}
