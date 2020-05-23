@extends('admin.produk.index')

@section('title-header-small', 'edit')

@section('breadcrumb')
	@parent
    <li><a href="#"></i> Edit</a></li>
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
		  	created: function () {
			    this.getData();
		  	},
		  	methods: {
			  processFile(event) {
			    Array.from(event.target.files).forEach((v,i) => {
			    	this.foto_new.push(v);
			    })
			  },
			  deleteFileOld(index, id){
			  	axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
			  	axios.post('{!!route('admin.produk.deleteImage')!!}', {id: id}).then(response => {
			  		this.foto_old.splice(index,1);
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
			  deleteFileNew(index){
			  	this.foto_new.splice(index,1);
			  },
			  save(){
				let form = new FormData();
			  	form.append('_method','PUT');
			  	form.append('nama',this.nama);
			  	form.append('harga',this.harga);
			  	form.append('keterangan',this.keterangan);
			  	form.append('is_active',this.is_active);
			  	form.append('kategori_id',this.kategori_id);

			  	this.foto_new.forEach((v,i) => {
			    	form.append('foto[]',v);
			    })

			  	axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
			  	axios.post('{!!route('produk.update', $id)!!}', form).then(response => {
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
			  getData(){
			  	axios.get('{!!route('produk.show',$id)!!}').then(r => {
			  		let data = r.data;
			  		this.nama = data.nama;
			  		this.harga = data.harga;
			  		this.keterangan = data.keterangan;
			  		this.kategori_id = data.kategori_id;
			  		this.foto_old = data.image;
				}).catch((err) => {
					toastr["error"](err.data.message)
				})
			  }
			}
		})
	</script>
@endpush