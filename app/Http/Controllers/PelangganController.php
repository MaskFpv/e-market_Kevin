<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Requests\PelangganStoreRequest;
use App\Http\Requests\PelangganUpdateRequest;

class PelangganController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Pelanggan::class);

        $search = $request->get('search', '');

        $pelanggans = Pelanggan::latest()->get();

        return view('app.pelanggans.index', compact('pelanggans'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Pelanggan::class);

        return view('app.pelanggans.create');
    }

    /**
     * @param \App\Http\Requests\PelangganStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PelangganStoreRequest $request)
    {
        $this->authorize('create', Pelanggan::class);

        $validated = $request->validated();

        $pelanggan = Pelanggan::create($validated);

        return redirect()
            ->route('pelanggans.index', $pelanggan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pelanggan $pelanggan)
    {
        $this->authorize('view', $pelanggan);

        return view('app.pelanggans.show', compact('pelanggan'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pelanggan $pelanggan)
    {
        $this->authorize('update', $pelanggan);

        return view('app.pelanggans.edit', compact('pelanggan'));
    }

    /**
     * @param \App\Http\Requests\PelangganUpdateRequest $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(
        PelangganUpdateRequest $request,
        Pelanggan $pelanggan
    ) {
        $this->authorize('update', $pelanggan);

        $validated = $request->validated();

        $pelanggan->update($validated);

        return redirect()
            ->route('pelanggans.edit', $pelanggan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pelanggan $pelanggan)
    {
        $this->authorize('delete', $pelanggan);

        $pelanggan->delete();

        return redirect()
            ->route('pelanggans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
