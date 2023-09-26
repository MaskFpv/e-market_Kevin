@php $editing = isset($pelanggan) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="kode_pelanggan"
            label="Kode Pelanggan"
            :value="old('kode_pelanggan', ($editing ? $pelanggan->kode_pelanggan : ''))"
            maxlength="255"
            placeholder="Kode Pelanggan"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="nama"
            label="Nama"
            :value="old('nama', ($editing ? $pelanggan->nama : ''))"
            maxlength="255"
            placeholder="Nama"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="alamat"
            label="Alamat"
            :value="old('alamat', ($editing ? $pelanggan->alamat : ''))"
            maxlength="255"
            placeholder="Alamat"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="no_telp"
            label="No Telp"
            :value="old('no_telp', ($editing ? $pelanggan->no_telp : ''))"
            maxlength="255"
            placeholder="No Telp"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.email
            name="email"
            label="Email"
            :value="old('email', ($editing ? $pelanggan->email : ''))"
            maxlength="255"
            placeholder="Email"
            required
        ></x-inputs.email>
    </x-inputs.group>
</div>
