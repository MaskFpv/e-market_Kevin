<?php

namespace App\Http\Controllers;

use App\Exports\Produksexport;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\ProdukStoreRequest;
use App\Http\Requests\ProdukUpdateRequest;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class ProdukController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Produk::class);

        $produks = Produk::latest()->get();

        return view('app.produks.index', compact('produks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Produk::class);

        return view('app.produks.create');
    }

    /**
     * @param \App\Http\Requests\ProdukStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukStoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $validated = $request->validated();

        $produk = Produk::create($validated);

        return redirect()
            ->route('produks.index', $produk)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Produk $produk)
    {
        $this->authorize('view', $produk);

        return view('app.produks.show', compact('produk'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        return view('app.produks.edit', compact('produk'));
    }

    /**
     * @param \App\Http\Requests\ProdukUpdateRequest $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukUpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $validated = $request->validated();

        $produk->update($validated);

        return redirect()
            ->route('produks.index', $produk)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Produk $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Produk $produk)
    {
        $this->authorize('delete', $produk);

        $produk->delete();

        return redirect()
            ->route('produks.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function download()
    {
        $data['produks'] = Produk::get();

        $pdf = PDF::loadView('app/produks/table', $data);

        // donload pdf file with donwload method
        $date = date('YMd');
        return $pdf->stream();
        // return $pdf->download($date . '_test.pdf');
    }

    public function exportData()
    {
        $date = date('Y-m-d');
        return Excel::download(new Produksexport, $date . '_produk.xlsx');
    }
}
