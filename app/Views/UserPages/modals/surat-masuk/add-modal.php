<div class="modal fade" id="addmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="staticBackdropLabel">Tambah Surat Masuk</h3>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form id="form-add">
                        <div class="row">
                                <input readonly hidden type="number" class="form-control" id="id_user" name="id_user" placeholder="Pengirim" required>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="lampiran" placeholder="Lampiran" required>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="id_jenis" class="custom-select" required>
                                    <option value="" disabled selected>Memuat jenis surat...</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="id_sifat" class="custom-select" required>
                                    <option value="" disabled selected>Memuat sifat surat...</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="id_status" class="custom-select" required>
                                    <option value="" disabled selected>Memuat status surat...</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="nomor_agenda" placeholder="Nomor Agenda" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="perihal" placeholder="Perihal" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="dari" placeholder="Dari" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="file" class="form-control" name="link_surat" placeholder="file" required>
                            </div>
                            <input type="hidden" class="form-control" name="tipe_surat" value="masuk" required>
                        </div>
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

<script>
$(document).ready(function () {

    const localId = localStorage.getItem('id');
    $('#id_user').val(localId);


    // Jenis Surat
    $.ajax({
        url: "/api/v1/jenis-laporan",
        method: "GET",
        dataType: "json",
        success: function (response) {
            const $select = $('select[name="id_jenis"]');
            $select.empty().append('<option value="" disabled selected>Pilih Jenis Surat</option>');
            $.each(response.data.data, function (key, value) {
                $select.append('<option value="' + value.id + '">' + value.nama_jenis_laporan + '</option>');
            });
        },
        error: function () {
            console.error('Gagal memuat jenis surat');
        }
    });

    // Sifat Surat
    $.ajax({
        url: "/api/v1/sifat-laporan",
        method: "GET",
        dataType: "json",
        success: function (response) {
            const $select = $('select[name="id_sifat"]');
            $select.empty().append('<option value="" disabled selected>Pilih Sifat Surat</option>');
            $.each(response.data.data, function (key, value) {
                $select.append('<option value="' + value.id + '">' + value.nama_sifat_laporan + '</option>');
            });
        },
        error: function () {
            console.error('Gagal memuat sifat surat');
        }
    });

    // Status Surat
    $.ajax({
        url: "/api/v1/status-laporan",
        method: "GET",
        dataType: "json",
        success: function (response) {
            const $select = $('select[name="id_status"]');
            $select.empty().append('<option value="" disabled selected>Pilih Status Surat</option>');
            $.each(response.data, function (key, value) {
                $select.append('<option value="' + value.id + '">' + value.nama_status_laporan + '</option>');
            });
        },
        error: function () {
            console.error('Gagal memuat status surat');
        }
    });
});
</script>
