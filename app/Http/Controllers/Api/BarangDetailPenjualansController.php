<?php

namespace App\Http\Controllers\Api;

use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPenjualanResource;
use App\Http\Resources\DetailPenjualanCollection;

class BarangDetailPenjualansController extends Controller
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

        $detailPenjualans = $barang
            ->detailPenjualans()
            ->search($search)
            ->latest()
            ->paginate();

        return new DetailPenjualanCollection($detailPenjualans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Barang $barang)
    {
        $this->authorize('create', DetailPenjualan::class);

        $validated = $request->validate([
            'penjualan_id' => ['required', 'exists:penjualans,id'],
            'harga_jual' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
        ]);

        $detailPenjualan = $barang->detailPenjualans()->create($validated);

        return new DetailPenjualanResource($detailPenjualan);
    }
}
