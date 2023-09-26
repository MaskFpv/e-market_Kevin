<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaction extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'transaction_id',
        'jumlah_bayar',
        'transaction_type_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'detail_transactions';

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
