<?php

namespace App\Http\Controllers\Api;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PelangganResource;
use App\Http\Resources\PelangganCollection;
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

        $pelanggans = Pelanggan::search($search)
            ->latest()
            ->paginate();

        return new PelangganCollection($pelanggans);
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

        return new PelangganResource($pelanggan);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pelanggan $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pelanggan $pelanggan)
    {
        $this->authorize('view', $pelanggan);

        return new PelangganResource($pelanggan);
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

        return new PelangganResource($pelanggan);
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

        return response()->noContent();
    }
}
