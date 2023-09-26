<?php

namespace App\Http\Controllers\Api;

use App\Models\Pemasok;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PemasokResource;
use App\Http\Resources\PemasokCollection;
use App\Http\Requests\PemasokStoreRequest;
use App\Http\Requests\PemasokUpdateRequest;

class PemasokController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Pemasok::class);

        $search = $request->get('search', '');

        $pemasoks = Pemasok::search($search)
            ->latest()
            ->paginate();

        return new PemasokCollection($pemasoks);
    }

    /**
     * @param \App\Http\Requests\PemasokStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PemasokStoreRequest $request)
    {
        $this->authorize('create', Pemasok::class);

        $validated = $request->validated();

        $pemasok = Pemasok::create($validated);

        return new PemasokResource($pemasok);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pemasok $pemasok)
    {
        $this->authorize('view', $pemasok);

        return new PemasokResource($pemasok);
    }

    /**
     * @param \App\Http\Requests\PemasokUpdateRequest $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function update(PemasokUpdateRequest $request, Pemasok $pemasok)
    {
        $this->authorize('update', $pemasok);

        $validated = $request->validated();

        $pemasok->update($validated);

        return new PemasokResource($pemasok);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Pemasok $pemasok)
    {
        $this->authorize('delete', $pemasok);

        $pemasok->delete();

        return response()->noContent();
    }
}
