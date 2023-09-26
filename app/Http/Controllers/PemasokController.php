<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;
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

        $pemasoks = Pemasok::latest()->get();

        return view('app.pemasoks.index', compact('pemasoks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Pemasok::class);

        return view('app.pemasoks.create');
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

        return redirect()
            ->route('pemasoks.index', $pemasok)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Pemasok $pemasok)
    {
        $this->authorize('view', $pemasok);

        return view('app.pemasoks.show', compact('pemasok'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Pemasok $pemasok
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Pemasok $pemasok)
    {
        $this->authorize('update', $pemasok);

        return view('app.pemasoks.edit', compact('pemasok'));
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

        return redirect()
            ->route('pemasoks.edit', $pemasok)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('pemasoks.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
