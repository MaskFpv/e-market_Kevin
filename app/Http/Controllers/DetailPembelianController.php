<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\DetailPembelian;
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
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.detail_pembelians.index',
            compact('detailPembelians', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', DetailPembelian::class);

        $barangs = Barang::pluck('kode_barang', 'id');
        $pembelians = Pembelian::pluck('kode_masuk', 'id');

        return view(
            'app.detail_pembelians.create',
            compact('barangs', 'pembelians')
        );
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

        return redirect()
            ->route('detail-pembelians.edit', $detailPembelian)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DetailPembelian $detailPembelian
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, DetailPembelian $detailPembelian)
    {
        $this->authorize('view', $detailPembelian);

        return view('app.detail_pembelians.show', compact('detailPembelian'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\DetailPembelian $detailPembelian
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, DetailPembelian $detailPembelian)
    {
        $this->authorize('update', $detailPembelian);

        $barangs = Barang::pluck('kode_barang', 'id');
        $pembelians = Pembelian::pluck('kode_masuk', 'id');

        return view(
            'app.detail_pembelians.edit',
            compact('detailPembelian', 'barangs', 'pembelians')
        );
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

        return redirect()
            ->route('detail-pembelians.edit', $detailPembelian)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('detail-pembelians.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
