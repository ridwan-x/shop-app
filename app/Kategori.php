<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
	protected $table = 'kategori';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
    ];

    /**
	 * Get the post that owns the comment.
	 */
	public function produk()
	{
	    return $this->belongsTo('App\produk', 'id','kategori_id');
	}
}
