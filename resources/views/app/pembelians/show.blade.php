@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('pembelians.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.pembelian.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.pembelian.inputs.kode_masuk')</h5>
                    <span>{{ $pembelian->kode_masuk ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pembelian.inputs.tanggal_masuk')</h5>
                    <span>{{ $pembelian->tanggal_masuk ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pembelian.inputs.total')</h5>
                    <span>{{ $pembelian->total ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pembelian.inputs.pemasok_id')</h5>
                    <span
                        >{{ optional($pembelian->pemasok)->nama_pemasok ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.pembelian.inputs.user_id')</h5>
                    <span>{{ optional($pembelian->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('pembelians.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Pembelian::class)
                <a
                    href="{{ route('pembelians.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
