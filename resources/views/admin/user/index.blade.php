@extends('admin.app')

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User
        <small>@yield('title-header-small')</small>
      </h1>
      <ol class="breadcrumb">
        @section('breadcrumb')
	        <li><a href="#"><i class="fa fa-user"></i> Level</a></li>
        @show
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    	@yield('form')
    </section>
@endsection