@php $editing = isset($pemasok) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text name="nama_pemasok" label="Nama Pemasok" :value="old('nama_pemasok', $editing ? $pemasok->nama_pemasok : '')" maxlength="255" placeholder="Nama Pemasok"
            required></x-inputs.text>
    </x-inputs.group>
</div>
