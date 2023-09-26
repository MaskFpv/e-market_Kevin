<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Http\Resources\BarangCollection;

class UserBarangsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $barangs = $user
            ->barangs()
            ->search($search)
            ->latest()
            ->paginate();

        return new BarangCollection($barangs);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Barang::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:255', 'string'],
            'nama_barang' => ['required', 'max:255', 'string'],
            'satuan' => ['required', 'max:255', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stock' => ['required', 'max:255', 'string'],
            'ditarik' => ['required', 'numeric'],
            'produk_id' => ['required', 'exists:produks,id'],
        ]);

        $barang = $user->barangs()->create($validated);

        return new BarangResource($barang);
    }
}
