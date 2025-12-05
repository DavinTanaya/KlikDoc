<form id="editProductForm" method="POST" action="{{ route('admin.drugs.update', '__ID__') }}"
  enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="row g-3">

    <div class="col-md-6">
      <label class="form-label">Nama Produk *</label>
      <input type="text" class="form-control" name="name" value="__NAME__" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Kategori *</label>
      <select class="form-select" name="category" required>
        <option value="Analgesik" __CAT_ANALGESIK__>Analgesik</option>
        <option value="Antibiotik" __CAT_ANTIBIOTIK__>Antibiotik</option>
        <option value="Vitamin & Suplemen" __CAT_VITAMIN__>Vitamin & Suplemen</option>
        <option value="Antasida" __CAT_ANTASIDA__>Antasida</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Tipe Obat *</label>
      <select class="form-select" name="type" required>
        <option value="Tablet" __TYPE_TABLET__>Tablet</option>
        <option value="Kapsul" __TYPE_KAPSUL__>Kapsul</option>
        <option value="Sirup" __TYPE_SIRUP__>Sirup</option>
        <option value="Salep" __TYPE_SALEP__>Salep</option>
        <option value="Injeksi" __TYPE_INJEKSI__>Injeksi</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Harga *</label>
      <input type="number" class="form-control" name="price" value="__PRICE__" min="0" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Stok *</label>
      <input type="number" class="form-control" name="stock" value="__STOCK__" min="0" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Dosis</label>
      <input type="text" class="form-control" name="dosis" value="__DOSIS__">
    </div>

    <div class="col-12">
      <label class="form-label">Short Description</label>
      <input type="text" class="form-control" name="short_description" value="__SHORT__">
    </div>

    <div class="col-12">
      <label class="form-label">Deskripsi</label>
      <textarea class="form-control" name="description">__DESC__</textarea>
    </div>

    <div class="col-12">
      <label class="form-label">Gambar Produk</label>
      <input type="file" class="form-control" name="image">
    </div>

  </div>
</form>
