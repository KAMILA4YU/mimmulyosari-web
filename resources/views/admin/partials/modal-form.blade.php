<div class="modal fade" id="modalInformasi" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form id="formInformasi" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="methodField" value="POST">
            <input type="hidden" name="kategori" id="kategoriField">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modalTitle">Tambah Informasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Isi Informasi</label>
                        <textarea name="isi" id="isi" class="form-control" rows="4" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Gambar</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
function setKategori(kategori) {
    document.getElementById("modalTitle").innerText = "Tambah " + kategori;
    document.getElementById("formInformasi").reset();
    document.getElementById("kategoriField").value = kategori;
    document.getElementById("methodField").value = "POST";
    document.getElementById("formInformasi").action = "{{ route('admin.informasi.store') }}";
}

function editInformasi(data) {
    document.getElementById("modalTitle").innerText = "Edit Informasi";
    document.getElementById("kategoriField").value = data.kategori;
    document.getElementById("judul").value = data.judul;
    document.getElementById("tanggal").value = data.tanggal;
    document.getElementById("isi").value = data.isi;

    document.getElementById("methodField").value = "PUT";
    document.getElementById("formInformasi").action = "/admin/informasi/" + data.id;
}
</script>
