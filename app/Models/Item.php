<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_barang',
        'product_id',
        'nama_barang',
        'satuan',
        'harga_jual',
        'stock',
        'ditarik',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function detailPurchases()
    {
        return $this->hasMany(DetailPurchase::class);
    }
}
