<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'transaksi_id',
        'jumlah_bayar',
        'transaction_type_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'detail_transaksis';

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
