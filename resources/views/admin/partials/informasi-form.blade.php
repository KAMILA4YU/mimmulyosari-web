<div class="modal fade" id="modalInformasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formInformasi" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="methodField" value="POST">
                <input type="hidden" name="kategori" value="berita">
                <input type="hidden" name="id" id="infoId">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Tambah Informasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" id="judulField" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggalField" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Isi Informasi</label>
                        <textarea name="isi" id="deskripsiField" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar (Opsional)</label>
                        <input type="file" name="gambar" id="gambarField" class="form-control">
                        <small class="text-muted">Format: JPG, PNG, Max 2MB</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function createInformasi(kategori) {
    document.getElementById('modalTitle').innerText = 'Tambah ' + kategori;
    document.getElementById('formInformasi').action = "{{ route('admin.informasi.store') }}";
    document.getElementById('methodField').value = 'POST';

    document.getElementById('kategoriField').value = kategori;
    document.getElementById('judulField').value = '';
    document.getElementById('tanggalField').value = '';
    document.getElementById('deskripsiField').value = '';
    document.getElementById('gambarField').value = '';
}

function editInformasi(info) {
    document.getElementById('modalTitle').innerText = 'Edit Informasi';
    document.getElementById('formInformasi').action = "/admin/informasi/" + info.id;
    document.getElementById('methodField').value = 'PUT';

    document.getElementById('kategoriField').value = info.kategori;
    document.getElementById('judulField').value = info.judul;
    document.getElementById('tanggalField').value = info.tanggal;
    document.getElementById('deskripsiField').value = info.isi;
}
</script>
