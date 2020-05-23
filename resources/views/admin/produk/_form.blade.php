<div class="row">
  <div class="form-group col-md-6">
        <label>Nama</label>
        @method('PUT')
        <input name="nama" type="text" class="form-control" placeholder="Samsung A20" v-model='nama'>
  </div>
  <div class="form-group col-md-4">
    <label>Kategori</label>
    <select class="form-control"  v-model="kategori_id">
      <option value="0">Semua Produk</option>
      @foreach($kategori as $v)
        <option value="{{$v->id}}">{{$v->nama}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group col-md-2">
        <label>Harga</label>
        <input name="harga" type="text" class="form-control" placeholder="130000" v-model:number='harga' type="number">
  </div>
</div>
<div class="form-group">
  <label>Keterangan</label>
  <textarea name="keterangan" class="form-control" rows="7" placeholder="Detail produk ..." v-model='keterangan'></textarea>
</div>
<div class="form-group">
  <label class="btn btn-default">
    <span class="fa fa-camera-retro"> Upload Foto</span>
    <input style="display: none;" type="file" name="foto[]" id="foto" multiple @change="processFile($event)">
  </label>
</div>
<div class="row">
  <div class="col-md-12" style="padding: 0px 10px 0px 10px;">
    <div class="container-image" v-for="(image, index) in foto_old">
      <img id="image1" height="140" width="140" :src="image.shop">
      <div class="title-image-right">
        <a class="btn btn-default" style="border-radius: 50%;padding: 0px;" @click="deleteFileOld(index, image.id)"><span class="fa fa-trash" style="width: 20px"></span></a>
      </div>
    </div>
    <div class="container-image" v-for="(image, index) in foto_new">
      <img id="image1" height="140" width="140" :src="URL.createObjectURL(image)">
      <div class="title-image-right">
        <a class="btn btn-default" style="border-radius: 50%;padding: 0px;" @click="deleteFileNew(index)"><span class="fa fa-trash" style="width: 20px"></span></a>
      </div>
    </div>
  </div>
</div>
<div class="checkbox">
  <label>
    <input name="is_active" type="checkbox" v-model="is_active"> Active
  </label>
</div>