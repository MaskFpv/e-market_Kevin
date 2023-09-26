<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\ItemCollection;

class UserItemsController extends Controller
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

        $items = $user
            ->items()
            ->search($search)
            ->latest()
            ->paginate();

        return new ItemCollection($items);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Item::class);

        $validated = $request->validate([
            'kode_barang' => ['required', 'max:255', 'string'],
            'nama_barang' => ['required', 'max:255', 'string'],
            'satuan' => ['required', 'max:255', 'string'],
            'harga_jual' => ['required', 'numeric'],
            'stock' => ['required', 'max:255', 'string'],
            'ditarik' => ['required', 'numeric'],
            'product_id' => ['required', 'exists:products,id'],
        ]);

        $item = $user->items()->create($validated);

        return new ItemResource($item);
    }
}
