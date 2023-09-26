<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PembelianResource;
use App\Http\Resources\PembelianCollection;

class UserPembeliansController extends Controller
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

        $pembelians = $user
            ->pembelians()
            ->search($search)
            ->latest()
            ->paginate();

        return new PembelianCollection($pembelians);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Pembelian::class);

        $validated = $request->validate([
            'kode_masuk' => ['required', 'max:255', 'string'],
            'tanggal_masuk' => ['required', 'date'],
            'total' => ['required', 'numeric'],
            'pemasok_id' => ['required', 'exists:pemasoks,id'],
        ]);

        $pembelian = $user->pembelians()->create($validated);

        return new PembelianResource($pembelian);
    }
}
