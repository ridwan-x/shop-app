@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img class="d-block w-100" src="{{$produk->image()->first()->produk ?? 'data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mN0DwioBwADNQFoLWXALgAAAABJRU5ErkJggg=='}}" >
                </div>
                @foreach($produk->image as $key => $image)
                  @if($key != 0)
                    <div class="carousel-item ">
                        <img class="d-block w-100" src="{{$image->produk}}" >
                    </div>
                  @endif
                @endforeach
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
        </div>
        <div class="col-md-5">
            <div class="product-details">
                <h1 class="single-product-name" style="margin-bottom:0px">{{$produk->nama}}</h1>
                <div class="product-sku">SKU: <span class="variant-sku">{{$produk->sku}}</span></div>
                <div class="single-product-price">
                    <div class="product-discount"><span  class="price" id="ProductPrice"><span class=money>Rp @currency($produk->harga)</span></span></div>
                </div>
                <div class="order">
                  <a class="btn btn-outline-dark btn-xs" role="button" aria-pressed="true" target="_blank" href="https://wa.me/6285659001148?text=%2ALorem%20Ipsum%20Is%20Simply%20Dummy%20Text%2A%0ASKU%3A%20YQT71020193%0AHarga%3A%20_Rp%20165.000_"><img width="19" src="{{asset('icon/whatsapp.svg')}}" style="margin-top:-3px;" /> Kirim pesan order</a>
                  <a class="btn btn-outline-dark btn-xs" role="button" aria-pressed="true" href="{{asset('/')}}"><span class="fa fa-shopping-cart"></span> Kembali</a>
                </div>
                <div class="product-info" style="white-space: pre-line">
                  <b>Keterangan:</b>
                  {{$produk->keterangan}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
