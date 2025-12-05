<form id="deleteProductForm" method="POST" action="{{ route('admin.drugs.delete', '__ID__') }}">
  @csrf
  @method('DELETE')

  <p>Apakah Anda yakin ingin menghapus produk <strong>__NAME__</strong>?</p>

  <button type="submit" class="btn btn-danger">Hapus</button>
</form>
