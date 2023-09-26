<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPembelianResource;
use App\Http\Resources\DetailPembelianCollection;
use App\Http\Requests\DetailPembelianStoreRequest;
use App\Http\Requests\DetailPembelianUpdateRequest;

class DetailPembelianController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', DetailPembelian::class);

        $search = $request->get('search', '');

        $detailPembelians = DetailPembelian::search($search)
            ->latest()
            ->paginate();

        return new DetailPembelianCollection($detailPembelians);
    }

    /**
     * @param \App\Http\Requests\DetailPembelianStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailPembelianStoreRequest $request)
    {
        $this->authorize('create', DetailPembelian::class);

        $validated = $request->validated();

        $detailPembelian = DetailPembelian::create($validated);

        return new DetailPembelianResource($detailPembelian);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DetailPembelian $detailPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, DetailPembelian $detailPembelian)
    {
        $this->authorize('view', $detailPembelian);

        return new DetailPembelianResource($detailPembelian);
    }

    /**
     * @param \App\Http\Requests\DetailPembelianUpdateRequest $request
     * @param \App\Models\DetailPembelian $detailPembelian
     * @return \Illuminate\Http\Response
     */
    public function update(
        DetailPembelianUpdateRequest $request,
        DetailPembelian $detailPembelian
    ) {
        $this->authorize('update', $detailPembelian);

        $validated = $request->validated();

        $detailPembelian->update($validated);

        return new DetailPembelianResource($detailPembelian);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DetailPembelian $detailPembelian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, DetailPembelian $detailPembelian)
    {
        $this->authorize('delete', $detailPembelian);

        $detailPembelian->delete();

        return response()->noContent();
    }
}
