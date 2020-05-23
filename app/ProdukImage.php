<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukImage extends Model
{
	protected $table = 'produk_image';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'produk', 
        'shop', 
        'produk_id',
    ];
}
