<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PembelianResource;
use App\Http\Resources\PembelianCollection;
use App\Http\Requests\PembelianStoreRequest;
use App\Http\Requests\PembelianUpdateRequest;

class PembelianController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Pembelian::class);

        $search = $request->get('search', '');

        $pembelians = Pembelian::search($search)
            ->latest()
            ->paginate();

        return new PembelianCollection($pembelians);
    }

    /**
     * @param \App\Http\Requests\PembelianStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PembelianStoreRequest $request)
    {
        $this->authorize('create', Pembelian::class);

        $validated = $request->validated();

        $pembelian = Pembelian::create($validated);

        return new PembelianResource($pembelian);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pembelian $pembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pembelian $pembelian)
    {
        $this->authorize('view', $pembelian);

        return new PembelianResource($pembelian);
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

        return new PembelianResource($pembelian);
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

        return response()->noContent();
    }
}
