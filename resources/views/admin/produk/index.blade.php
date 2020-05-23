@extends('admin.app')

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Produk
        <small>@yield('title-header-small')</small>
      </h1>
      <ol class="breadcrumb">
        @section('breadcrumb')
	        <li><a href="#"><i class="fa fa-folder-o"></i> Produk</a></li>
        @show
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      @if(count($errors) > 0)
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
          <i class="icon fa fa-ban"></i> {{ $error }} <br/>
          @endforeach
        </div>
        @endif
      @if(session()->has('alert'))
        <div class="alert alert-{{session('alert')[0]}} alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fa fa-check"></i> {{session('alert')[1]}}
        </div>
      @endif
    	@yield('form')
    </section>
@endsection

@push('style')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin-lte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{asset('admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
    <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('admin-lte/bower_components/select2/dist/css/select2.min.css')}}">
@endpush

@push('scripts')
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{asset('admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>

  <script>
    $(function () {
      //bootstrap WYSIHTML5 - text editor
      $('.textarea').wysihtml5()
    })
  </script>
@endpush