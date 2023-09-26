<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Barang::class);

        $users = User::pluck('name', 'id');
        $produks = Produk::pluck('nama_produk', 'id');

        $barangs = Barang::latest()->get();

        return view('app.barangs.index', compact('barangs', 'users', 'produks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Barang::class);

        $users = User::pluck('name', 'id');
        $produks = Produk::pluck('nama_produk', 'id');

        return view('app.barangs.index', compact('users', 'produks'));
    }

    /**
     * @param \App\Http\Requests\BarangStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangStoreRequest $request)
    {
        $this->authorize('create', Barang::class);

        $user = Auth::user();

        $validated = $request->validated();
        $validated['ditarik'] = 0;
        $validated['user_id'] = $user->id;

        $barang = Barang::create($validated);

        return redirect()
            ->route('barangs.index')
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Barang $barang)
    {
        $this->authorize('view', $barang);

        return view('app.barangs.show', compact('barang'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        $users = User::pluck('name', 'id');
        $produks = Produk::pluck('nama_produk', 'id');

        return view('app.barangs.edit', compact('barang', 'users', 'produks'));
    }

    /**
     * @param \App\Http\Requests\BarangUpdateRequest $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function update(BarangUpdateRequest $request, Barang $barang)
    {
        $this->authorize('update', $barang);

        $validated = $request->validated();

        $barang->update($validated);

        return redirect()
            ->route('barangs.index', $barang)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Barang $barang)
    {
        $this->authorize('delete', $barang);

        $barang->delete();

        return redirect()
            ->route('barangs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
