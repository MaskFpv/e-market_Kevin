<!-- Modal -->
<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    @csrf
                    <div id="method">

                    </div>
                    <div class="row">
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="kode_barang" label="Kode Barang" :value="old('kode_barang')" maxlength="255"
                                placeholder="Kode Barang" id="kode-barang" class="kode" required></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="nama_barang" label="Nama Barang" :value="old('nama_barang')" maxlength="255"
                                placeholder="Nama Barang" id="nama-barang" class="nama-barang" required></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="satuan" label="Satuan" :value="old('satuan')" maxlength="255"
                                placeholder="Satuan" id="satuan" class="satuan" required></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.number name="harga_jual" label="Harga Jual" :value="old('harga_jual')" step="0.01"
                                placeholder="Harga Jual" id="harga-jual" class="harga-jual" required></x-inputs.number>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text name="stock" label="Stock" class="stock" :value="old('stock')"
                                placeholder="Stock" id="stock" required></x-inputs.text>
                        </x-inputs.group>

                        <x-inputs.group class="col-sm-12">
                            <x-inputs.select name="produk_id" label="Produk" class="produk" id="produk" required>
                                @php $selected = old('produk_id') @endphp
                                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Produk
                                </option>
                                @foreach ($produks as $value => $label)
                                    <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </x-inputs.select>
                        </x-inputs.group>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
