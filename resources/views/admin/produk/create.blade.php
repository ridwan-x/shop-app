@extends('admin.produk.index')

@section('title-header-small', 'create')

@section('breadcrumb')
	@parent
    <li><a href="#"></i> Create</a></li>
@endsection

@section('form')
    <!-- /.content -->
	<div class="row">
	    <div class="col-xs-12">
      		<!-- Horizontal Form -->
	      	<div class="box box-info">
		        <div class="box-header with-border">
		          <h3 class="box-title">Produk Form</h3>
		        </div>
		        <!-- /.box-header -->
		        <!-- form start -->
				<form>
		        	@csrf
		        	<div class="box-body">
						@include('admin.produk._form')
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<a type="submit" class="btn btn-primary" @click="save()">Simpan</a>
						<a class="btn btn-default" onclick="history.go(-1)">Cancel</a>
					</div>
		        </form>
		    </div>
		    <!-- /.box -->
	    </div>	
	</div>
@endsection

@push('style')

@endpush

@push('scripts')
	<script type="text/javascript">
		var app = new Vue({
		  	el: '#app',
		  	data: {
		  		nama:'',
		  		harga:'',
		  		keterangan:'',
		  		kategori_id: 0,
		    	foto_old: [],
		    	foto_new: [],
		    	is_active:true,
		  	},
		  	methods: {
			  processFile(event) {
			    Array.from(event.target.files).forEach((v,i) => {
			    	this.foto_new.push(v);
			    })
			  },
			  deleteFileNew(index){
			  	this.foto_new.splice(index,1);
			  },
			  save(){
			  	var form = new FormData();
			  	form.append('nama',this.nama);
			  	form.append('harga',this.harga);
			  	form.append('keterangan',this.keterangan);
			  	form.append('is_active',this.is_active);
			  	form.append('kategori_id',this.kategori_id);

			  	this.foto_new.forEach((v,i) => {
			    	form.append('foto[]',v);
			    })

			  	axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
			  	axios.post('{!!route('produk.store')!!}', form).then(response => {
			  		this.clear();
					toastr["success"]('Berhasill!!')
				}).catch((err) => {
					if(err.data.errors){
						return Object.values(err.data.errors).map(v => {
							toastr["error"](v)
						});
					}

					toastr["error"](err.data.message)

				})
			  },
			  clear(){
				this.nama = '';
				this.harga = '';
				this.keterangan = '';
				this.kategori_id = 0;
				this.foto_new = [];
				this.is_active = true;
			  }
			}
		})
	</script>
@endpush