<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangCollection;

class ProdukBarangsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Produk $produk)
    {
        $this->authorize('view', $produk);

        $search = $request->get('search', '');

        $barangs = $produk
            ->barangs()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangCollection($barangs);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Produk $produk)
    {
        $this->authorize('create', Barang::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:255', 'string'],
            'nama_barang' => ['required', 'max:255', 'string'],
            'satuan' => ['required', 'max:255', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stock' => ['required', 'max:255', 'string'],
            'ditarik' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $barang = $produk->barangs()->create($validated);

        return new BarangResource($barang);
    }
}
