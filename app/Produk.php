<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
	protected $table = 'produk';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 
        'sku', 
        'harga',
        'keterangan',
        'is_active',
        'kategori_id'
    ];

    public function image()
    {
        return $this->hasMany('App\ProdukImage','produk_id');
    }

    public function kategori()
    {
        return $this->hasOne('App\kategori','id', 'kategori_id');
    }
}
