<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransactionType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama_jenis_pembayaran'];

    protected $searchableFields = ['*'];

    protected $table = 'transaction_types';

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
