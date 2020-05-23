<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin-lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">


    <script
      src="https://code.jquery.com/jquery-2.2.4.min.js"
      integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
      crossorigin="anonymous"></script>

    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <script type="text/javascript">
        $( document ).ready(function() {
            $(".see-more").click(function() {
              $page = $(this).attr('data-page');
              $.get($page, function(response) { //append data
                $html = $(response).find("#posts").html(); 
                $page = $(response).find(".see-more").attr('data-page');
                $('#posts').append($html);
                if ($page) {
                    $(".see-more").attr('data-page', $page);
                }else{
                   $(".see-more").hide(); 
                }
              });
            });
        });
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item nav-kategori">Pilih Kategori</li>
                        <li class="nav-item nav-kategori"><a class="nav-link" href="/">Semua Produk</a></li>
                        @foreach($kategori as $data)
                            <li class="nav-item nav-kategori"><a class="nav-link" href="{{action('ShopController@index', ['k' => $data->id])}}">{{$data->nama}}</a></li>
                        @endforeach
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" target="_blank" href="https://wa.me/6285659001148?text=Hello%21%21%21"><img src="{{asset('icon/whatsapp.svg')}}" width="32" style="margin-top: -5px" /> 085659001148</a>
                            </li>
                         @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="z-index:10000">
                                    <a class="dropdown-item" href="/admin">Admin</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest

                        <li class="nav-item nav-kategori">
                            <form method="get" action="{{asset('/')}}">
                                <div class="input-group" style="margin-top: 10px">
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
                        </li>
                        <li class="nav-item nav-kategori">
                            <form method="get" action="{{asset('/')}}">
                                @if(Request::query('k'))
                                    <input name="k" type="text" value="{{ Request::query('k') }}" hidden>
                                @endif
                                @if(Request::query('c'))
                                    <input name="c" type="text" value="{{ Request::query('c') }}" hidden>
                                @endif
                                <select name="u" class="custom-select" onChange="this.form.submit()" style="margin-bottom: 17px;margin-top:10px">
                                    <option value="0" {{ Request::query('u') == 0 ? 'selected' : '' }}>Urutkan</option>
                                    <option value="1" {{ Request::query('u') == 1 ? 'selected' : '' }}>Harga Tertinggi</option>
                                    <option value="2" {{ Request::query('u') == 2 ? 'selected' : '' }}>Harga Terendah</option>
                                </select>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
