<form id="productForm" method="POST" action="{{ route('admin.drugs.create') }}" enctype="multipart/form-data">
  @csrf

  <div class="row g-3">
    <div class="col-md-6">
      <label class="form-label">Nama Produk *</label>
      <input type="text" class="form-control" name="name" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Kategori *</label>
      <select class="form-select" name="category" required>
        <option value="">Pilih...</option>
        <option value="Analgesik">Analgesik</option>
        <option value="Antibiotik">Antibiotik</option>
        <option value="Vitamin & Suplemen">Vitamin & Suplemen</option>
        <option value="Antasida">Antasida</option>
        <option value="Anti Inflamasi">Anti Inflamasi</option>
        <option value="Antipiretik">Antipiretik</option>
        <option value="Obat Batuk & Flu">Obat Batuk & Flu</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Tipe Obat *</label>
      <select class="form-select" name="type" required>
        <option value="">Pilih...</option>
        <option value="Tablet">Tablet</option>
        <option value="Kapsul">Kapsul</option>
        <option value="Sirup">Sirup</option>
        <option value="Salep">Salep</option>
        <option value="Injeksi">Injeksi</option>
      </select>
    </div>

    <div class="col-md-6">
      <label class="form-label">Harga *</label>
      <input type="number" class="form-control" name="price" min="0" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Stok *</label>
      <input type="number" class="form-control" name="stock" min="0" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Dosis (opsional)</label>
      <input type="text" class="form-control" name="dosis" placeholder="contoh: 3× sehari">
    </div>

    <div class="col-12">
      <label class="form-label">Short Description (opsional)</label>
      <input type="text" class="form-control" name="short_description" maxlength="500">
    </div>

    <div class="col-12">
      <label class="form-label">Deskripsi (opsional)</label>
      <textarea class="form-control" name="description" rows="3"></textarea>
    </div>

    <div class="col-12">
      <label class="form-label">Gambar Produk (opsional)</label>
      <input type="file" class="form-control" name="image" accept="image/*">
    </div>

  </div>
</form>
