@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-2 col-md-3 col-lg-2" id="kategori">
            <div class="sticky-top" style="margin-bottom: -17px;">
                <div class="list-group">
                    <a href="#" class="list-group-item list-group-item-action disabled"><b><span class="fa  fa-shopping-cart"></span> Kategori</b></a>
                    <a href="/" class="list-group-item list-group-item-action {{empty(Request::query('k')) ? 'active' : ''}}">Semua Produk</a>
                    @foreach($kategori as $data)
                        <a href="?k={{$data->id}}" class="list-group-item list-group-item-action {{Request::query('k') == $data->id ? 'active' : ''}}">{{$data->nama}}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-sm-10 col-md-9 col-lg-10">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 sticky-top" style="box-shadow: 0 11px 10px -17px #212529;margin-bottom:30px; margin-top:-1px">
                    <div class="row">
                        <div class="col-md-9 nav-fillter">
                            <form method="get">
                                <div class="input-group" style="margin-bottom: 17px">
                                    @if(Request::query('k'))
                                        <input name="k" type="text" value="{{ Request::query('k') }}" hidden>
                                    @endif
                                    @if(Request::query('u'))
                                        <input name="u" type="text" value="{{ Request::query('u') }}" hidden>
                                    @endif
                                    <input name="c" type="text" value="{{ Request::query('c') }}" class="form-control" aria-label="Text input with dropdown button" placeholder="Cari..." style="border-radius:2px;">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit"><svg width="16" height="16" viewBox="0 0 16 16" fill="currentColor"><path fill-rule="evenodd" d="M15.7 13.3l-3.81-3.83A5.93 5.93 0 0013 6c0-3.31-2.69-6-6-6S1 2.69 1 6s2.69 6 6 6c1.3 0 2.48-.41 3.47-1.11l3.83 3.81c.19.2.45.3.7.3.25 0 .52-.09.7-.3a.996.996 0 000-1.41v.01zM7 10.7c-2.59 0-4.7-2.11-4.7-4.7 0-2.59 2.11-4.7 4.7-4.7 2.59 0 4.7 2.11 4.7 4.7 0 2.59-2.11 4.7-4.7 4.7z"></path></svg></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3 nav-fillter">
                            <form method="get">
                                @if(Request::query('k'))
                                    <input name="k" type="text" value="{{ Request::query('k') }}" hidden>
                                @endif
                                @if(Request::query('c'))
                                    <input name="c" type="text" value="{{ Request::query('c') }}" hidden>
                                @endif
                                <select name="u" class="custom-select" onChange="this.form.submit()">
                                    <option value="0" {{ Request::query('u') == 0 ? 'selected' : '' }}>Urutkan</option>
                                    <option value="1" {{ Request::query('u') == 1 ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="2" {{ Request::query('u') == 2 ? 'selected' : '' }}>Harga Terendah</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <h2 class="header-product"> {{App\Kategori::find(Request::query('k'))->nama ?? 'Semua Produk'}} <small class="text-muted">{{$produk->total()}} produk</small></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <div id="posts" class="row" style="margin-right: -7px;margin-left: -7px; margin-bottom:10px">
                        @foreach($produk as $data)
                            <div class="col-md-3 col-lg-2 col-6" style="padding:5px" id="produk-list">
                                <div class="card cart-produk" style="width: 100%;">
                                    <a href="{{url('/product', [$data->id])}}" style="text-decoration: none;">
                                      <img class="card-img-top img-produk" src="{{$data->image()->first()->shop ?? 'data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mN0DwioBwADNQFoLWXALgAAAABJRU5ErkJggg=='}}" alt="Card image cap">
                                      <div class="card-body" style="padding: 10px;">
                                        <h5 class="card-title cart-title-product" style="margin-bottom:0px;">{{$data->nama}}</h5>
                                        <p class="card-text" style="color:#ff7518;font-size: 14px;font-weight: bold;margin-bottom:0px;">Rp @currency($data->harga)</p>
                                      </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if($produk->hasMorePages())
                    <div class="col-md-12 navigation-shop">
                        <div style="margin:70px; text-align:center">
                            <button class="btn btn-default btn-lg see-more" data-page="{{action('ShopController@index', $nexPage)}}" style="border: 1px solid #dee2e6;"><span class="fa fa-repeat"></span> MUAT LAINNYA</button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
