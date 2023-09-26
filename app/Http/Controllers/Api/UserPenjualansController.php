<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PenjualanResource;
use App\Http\Resources\PenjualanCollection;

class UserPenjualansController extends Controller
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

        $penjualans = $user
            ->penjualans()
            ->search($search)
            ->latest()
            ->paginate();

        return new PenjualanCollection($penjualans);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Penjualan::class);

        $validated = $request->validate([
            'no_faktur' => ['required', 'max:255', 'string'],
            'tgl_faktur' => ['required', 'date'],
            'total_bayar' => ['required', 'numeric'],
            'pelanggan_id' => ['required', 'exists:pelanggans,id'],
        ]);

        $penjualan = $user->penjualans()->create($validated);

        return new PenjualanResource($penjualan);
    }
}
