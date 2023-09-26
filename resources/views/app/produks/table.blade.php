<table class="table table-borderless table-hover" id="myTable">
    <thead>
        <tr>
            <th class="text-left">
                @lang('crud.produk.inputs.nama_produk')
            </th>
            <th class="text-center">
                @lang('crud.common.actions')
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($produks as $produk)
            <tr>
                <td>{{ $produk->nama_produk ?? '-' }}</td>
                <td class="text-center" style="width: 134px;">
                    <div role="group" aria-label="Row Actions" class="btn-group">
                        @can('update', $produk)
                            <div>
                                <button type="button" class="btn btn-light" data-mode="edit" data-bs-toggle="modal"
                                    data-bs-target="#modal-tambah" data-id="{{ $produk->id }}"
                                    data-name="{{ $produk->nama_produk }}">
                                    <i class="icon ion-md-create"></i>
                                </button>

                            </div>
                            @endcan @can('delete', $produk)
                            <form action="{{ route('produks.destroy', $produk) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-light text-danger btn-delete">
                                    <i class="icon ion-md-trash"></i>
                                </button>
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2">
                    @lang('crud.common.no_items_found')
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
