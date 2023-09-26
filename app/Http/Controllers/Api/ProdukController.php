<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use App\Http\Resources\ProdukCollection;
use App\Http\Requests\ProdukStoreRequest;
use App\Http\Requests\ProdukUpdateRequest;

class ProdukController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Produk::class);

        $search = $request->get('search', '');

        $produks = Produk::search($search)
            ->latest()
            ->paginate();

        return new ProdukCollection($produks);
    }

    /**
     * @param \App\Http\Requests\ProdukStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukStoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $validated = $request->validated();

        $produk = Produk::create($validated);

        return new ProdukResource($produk);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Produk $produk)
    {
        $this->authorize('view', $produk);

        return new ProdukResource($produk);
    }

    /**
     * @param \App\Http\Requests\ProdukUpdateRequest $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukUpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $validated = $request->validated();

        $produk->update($validated);

        return new ProdukResource($produk);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Produk $produk)
    {
        $this->authorize('delete', $produk);

        $produk->delete();

        return response()->noContent();
    }
}
