@extends('admin.app')

@section('content')
	<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kategori
        <small>list</small>
      </h1>
      <ol class="breadcrumb">
	      <li><a href="#"><i class="fa fa-folder-o"></i> Kategori</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
      @if(session()->has('alert'))

      @endif
  	 <!-- /.content -->
      <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Kategori list</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <table class="table table-condensed">
                  <tr>
                    <th style="width: 40px;text-align:center;">#</th>
                    <th>Kategori</th>
                    <th style="width: 100px;text-align:center;">Total</th>
                    <th style="width: 100px;text-align:center;">Action</th>
                  </tr>
                  <tr v-for="(value, index) in kategori_old">
                    <td style="padding-top:10px;text-align:center;">@{{index+ 1}}</td>
                    <td><input type="text" name="" class="form-control" v-model="value.nama" :key="index"></td>
                    <td style="text-align:center;padding-top:10px;"><span class="badge">@{{value.produk_count}} Produk</span></td>
                    <td style="text-align:center;padding-top:10px;"><button class="btn btn-danger btn-xs" @click="deletedOld(value.id)"><span class="fa fa-trash"></span> Hapus</button></td>
                  </tr>
                  <tr v-for="(value, index) in kategori_new">
                    <td style="padding-top:10px;text-align:center;">@{{index+ 1 + kategori_old.length}}</td>
                    <td><input type="text" name="" class="form-control" v-model="value.nama" :key="index"></td>
                    <td style="text-align:center;padding-top:10px;"><span class="badge">0 Produk</span></td>
                    <td style="text-align:center;padding-top:10px;"><button class="btn btn-danger btn-xs" @click="deletedNew(index)"><span class="fa fa-trash"></span> Hapus</button></td>
                  </tr>
                  <tr v-if="(kategori_old.length + kategori_new) == 0" style="background:#f9f9f9;">
                    <td colspan="4" style="padding:30px;text-align:center;">Tidak ada kategori</td>
                  </tr>
                </table>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a type="submit" class="btn btn-primary mr-5" @click="save()">Simpan</a>
                <a type="submit" class="btn btn-default" @click="add()">Tambah</a>
              </div>
            </div>
            <!-- /.box -->
          </div>  
      </div>
    </section>
@endsection

@push('style')
  <style type="text/css">
    
  </style>
@endpush

@push('scripts')
  <script>
    var app = new Vue({
      el: '#app',
      data: {
        kategori_new:[],
        kategori_old:[]
      },
      created: function () {
        this.getData();
      },
      methods: {
        getData(){
          axios.post('{!!route('admin.kategori.data')!!}').then(r => {
              this.kategori_old = r.data;
          }).catch((err) => {
            toastr["error"](err.data.message)
          })
        },
        save(){
          var form = new FormData();
          this.kategori_new.forEach((v,i) => {
            form.append('kategori['+v.nama+']',v.nama);
          })
          this.kategori_old.forEach((v,i) => {
            form.append('kategori['+v.id+']',v.nama);
          })

          axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
          axios.post('{!!route('kategori.store')!!}', form).then(r => {
            this.kategori_old = r.data;
            this.kategori_new = [];
            toastr["success"]('Berhasill!!')
          }).catch((err) => {
            toastr["error"](err.data.message)
          })
        },
        add(){
          this.kategori_new.push({nama: ''});
        },
        deletedNew(index){
          this.kategori_new.splice(index, 1);
        },
        deletedOld(id){
          axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
          axios.post("{!! url('/admin/kategori') !!}/" + id, {'_method':'DELETE'}).then(r => {
            toastr["success"]('Berhasill!!');
            this.kategori_old = this.kategori_old.filter(obj=>obj.id != id);
          }).catch((err) => {
            toastr["error"](err)
          })
        }
      }
    })
  </script>
@endpush