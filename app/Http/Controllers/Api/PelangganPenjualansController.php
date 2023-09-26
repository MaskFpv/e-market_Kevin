<?php

namespace App\Http\Controllers\Api;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PenjualanResource;
use App\Http\Resources\PenjualanCollection;

class PelangganPenjualansController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pelanggan $pelanggan)
    {
        $this->authorize('view', $pelanggan);

        $search = $request->get('search', '');

        $penjualans = $pelanggan
            ->penjualans()
            ->search($search)
            ->latest()
            ->paginate();

        return new PenjualanCollection($penjualans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pelanggan $pelanggan)
    {
        $this->authorize('create', Penjualan::class);

        $validated = $request->validate([
            'no_faktur' => ['required', 'max:255', 'string'],
            'tgl_faktur' => ['required', 'date'],
            'total_bayar' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $penjualan = $pelanggan->penjualans()->create($validated);

        return new PenjualanResource($penjualan);
    }
}
