@extends('admin.produk.index')

@section('title-header-small', 'list')

@section('form')
	<!-- /.content -->
	<div class="row">
	    <div class="col-xs-12">
	    	<div class="box">
	            <div class="box-header">
	              <h3 class="box-title">Produk List</h3>
	              <a class="btn btn-default btn-sm pull-right" href="{{route('produk.create')}}">
	                <i class="fa fa-user-plus"></i> Create
	              </a>
	            </div>
	            <!-- /.box-header -->
	            <div class="box-body table-responsive">
	              <table id="produk-table" class="table table-bordered table-striped" style="width:100%; min-width:500px;">
	                <thead>
		                <tr>
		                  <th>Nama</th>
		                  <th>SKU</th>
		                  <th>Harga</th>
		                  <th>Status</th>
		                  <th>Action</th>
		                </tr>
	                </thead>
	              </table>
	            </div>
	            <!-- /.box-body -->
	      	</div>
	      	<!-- /.box -->
	    </div>	
	</div>
@endsection

@push('style')
    
@endpush

@push('scripts')
	<!-- page produk script -->
  	<!-- DataTables -->
	<script src="{{asset('admin-lte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('admin-lte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
	<script>
	    var table = $('#produk-table').DataTable({
	      	'processing'  	: true,
        	'serverSide'	: true,
	        'ajax'			: {
	        	'url' 	: '{!! route('admin.produk.data') !!}',
	        	'type'	: 'POST',
	        	'data'	: {
	        		"_token": "{{ csrf_token() }}"
	        	}
	        },
	        columns: [
	        	{ data: 'nama', name: 'nama', visible: true},
	        	{ data: 'sku', name: 'sku', visible: true},
	        	{ data: 'harga', 
	        	  name: 'harga', 
	        	  visible: true,
	        	  render: $.fn.dataTable.render.number( ',', '.' )
	        	},
	        	{ data: 'is_active', name: 'is_active', visible: true},
	        	{
			      data: null,
			      bSearchable: false,
			      responsivePriority: 3,
			      width:'110px',
			      render: function(data, type) {
			      	return `<a class="btn btn-primary btn-sm" href="{!!url('/admin/produk')!!}/`+data.id+`/edit" style="margin-right:5px;"><span class="fa fa-edit"></span> Edit</a>`+
			      		   `<button class="btn btn-danger btn-sm" onclick="deleted(`+data.id+`)"><span class="fa fa-trash"></span> Delete</button>`;
			      }
			    }
	        ]
	    })

	  	function deleted(user_id){
		  	axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
		  	axios.post("{!! url('/admin/produk') !!}/" + user_id, {'_method':'DELETE'}).then(response => {
				toastr["success"]('Berhasill!!');
				table.ajax.reload();
			}).catch((err) => {
				toastr["error"](err)
			})
		}

	</script>
@endpush