<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembelian extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'barang_id',
        'pembelian_id',
        'harga_beli',
        'jumlah',
        'sub_total',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'detail_pembelians';

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }
}
