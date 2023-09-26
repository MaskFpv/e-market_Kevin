<?php

namespace App\Http\Controllers\Api;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PembelianResource;
use App\Http\Resources\PembelianCollection;

class PemasokPembeliansController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Pemasok $pemasok)
    {
        $this->authorize('view', $pemasok);

        $search = $request->get('search', '');

        $pembelians = $pemasok
            ->pembelians()
            ->search($search)
            ->latest()
            ->paginate();

        return new PembelianCollection($pembelians);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pemasok $pemasok)
    {
        $this->authorize('create', Pembelian::class);

        $validated = $request->validate([
            'kode_masuk' => ['required', 'max:255', 'string'],
            'tanggal_masuk' => ['required', 'date'],
            'total' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $pembelian = $pemasok->pembelians()->create($validated);

        return new PembelianResource($pembelian);
    }
}
