<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Produk;
use App\Kategori;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $c = $request->c;
        $k = $request->k;
        $u = $request->u;
        $urutkan = ['updated_at desc','harga desc','harga asc'];

        $produk = Produk::where('nama','like',"%$c%")
            ->Where(function($q) use ($k){
                if (!empty($k)):
                    $q->where('kategori_id', $k);
                endif;
            })
            ->orderByRaw($urutkan[$u] ?? 'updated_at desc')
            ->paginate(10);

        $kategori = Kategori::select('id','nama')->get();
        $nexPage  = $request->merge(['page'=> $produk->currentPage() + 1])->all();

        return view('shop', [
            'produk'        => $produk,
            'kategori'      => $kategori,
            'nexPage'       => $nexPage
        ]);
    }

    public function show($id){
        $produk = Produk::findOrFail($id);
        $kategori = Kategori::select('id','nama')->get();
        return view('product', [
            'produk'    => $produk,
            'kategori'  => $kategori,
        ]);
    }
}
