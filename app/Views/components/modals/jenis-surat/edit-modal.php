<div class="modal fade" id="editmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="staticBackdropLabel">Ubah Jenis</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form id="form-edit">
                        <div class="row">
                            <input type="number" hidden class="form-control" name="id" placeholder="Nama Jenis" required>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="nama_jenis_laporan" placeholder="Nama Jenis" required>
                            </div>
                        </div>
                        <!-- Submit button inside the form now -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary btn-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

