<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;

use App\Produk;
use App\ProdukImage;
use App\Kategori;

class ProdukController extends Controller
{   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produk.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = Kategori::select('id','nama')->get();

        return view('admin.produk.create',['kategori' => $kategori]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required',
            'harga'         => 'required|numeric',
            'keterangan'    => 'required',
            'foto.*'        => 'file|image|mimes:jpeg,png'
        ]);

        $last = empty($no = Produk::all()->last()) ?: $no->sku ;

        $produk = Produk::create([
            'nama'          => $request->nama,
            'harga'         => $request->harga,
            'keterangan'    => $request->keterangan,
            'kategori_id'   => $request->kategori_id,
            'sku'           => $this->increment($last),
            'is_active'     => $request->is_active,
        ]);

        if ($request->hasFile('foto')) {
            $file = $this->uploadFile($produk->id, $request->file('foto'));
            $produk->image()->createMany($file);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = Produk::with('image')->where('id',$id)->first();
        return $produk;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(empty(Produk::find($id))):
            return redirect()->route('produk.index');
        endif;

        $kategori = Kategori::select('id','nama')->get();

        return view('admin.produk.edit',['id' => $id, 'kategori' => $kategori]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $request->validate([
            'nama'          => 'required',
            'harga'         => 'required|numeric',
            'keterangan'    => 'required',
            'foto.*'        => 'file|image|mimes:jpeg,png'
        ]);

        $produk = Produk::find($id);

        $produk->update([
            'nama'          => $request->nama,
            'harga'         => $request->harga,
            'keterangan'    => $request->keterangan,
            'kategori_id'   => $request->kategori_id,
            'is_active'     => $request->is_active,
        ]);

        if ($request->hasFile('foto')) {
            $file = $this->uploadFile($produk->id, $request->file('foto'));
            $produk->image()->createMany($file);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Produk::find($id);
        $image->delete();
    }

    public function getData(){

        $produk = Produk::query();

        return Datatables::of($produk)
                ->order(function ($query) {
                    if (request()->has('created_at')) {
                        $query->orderBy('created_at', 'asc');
                    }
                })->make();

    }

    public function deleteImage(Request $request){
        $image = ProdukImage::find($request->id);
        $image->delete();
    }

    public function uploadFile($produkId, $files){

        $folder = [];

        if (!empty($files)) {

            foreach ($files as $key => $file) {

                $filename = \Carbon\Carbon::now()->format('YmdHis') . $key .'.' . $file->getClientOriginalExtension();

                \Image::make($file)->fit(800, 800)->save(storage_path("app\public\images\produk\produk-" . $filename));
                \Image::make($file)->fit(200, 200)->save(storage_path("app\public\images\shop\shop-" . $filename));

                $folder[] = [
                    'produk' => '/storage/images/produk/produk-'.$filename,
                    'shop'   => '/storage/images/shop/shop-'.$filename
                ];
            };

            return $folder;
        }

        return $folder;
    }

    public function increment($number = ''){
        $number++; // Next number
        return str_pad($number,7,'AAA0000', STR_PAD_LEFT);
    }
}
