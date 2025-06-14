<div class="modal fade" id="editmodal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title fs-5" id="staticBackdropLabel">Ubah Arsip Surat</h1>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="basic-form">
                    <form id="form-edit">
                        <div class="row">
                            <input type="text" class="form-control" name="id" hidden required>
                            <div class="col-12 mt-3">
                                <select name="id_user" class="custom-select" required>
                                    <!-- pingirim -->
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="nomor_surat" placeholder="Nomor Surat" required>
                            </div>
                            <div class="col-12 mt-3">
                                <input type="text" class="form-control" name="lampiran" placeholder="lampiran" required>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="is_completed" class="custom-select" required>
                                    <option value="" selected disabled>Pilih Status Complete</option>
                                    <option value="1">Complete</option>
                                    <option value="0">Belum Complete</option>
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="id_jenis" class="custom-select" required>
                                    <!-- jenis surat -->
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="id_sifat" class="custom-select" required>
                                    <!-- sifat surat -->
                                </select>
                            </div>
                            <div class="col-12 mt-3">
                                <select name="id_status" class="custom-select" required>
                                    <!-- status surat -->
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
                                <input type="file" class="form-control" name="link_surat" placeholder="file" >
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


<script>
    $(document).ready(function() {
 $.ajax({
        url: "/api/v1/user",
        method: "GET",
        dataType: "json",
        success: function(response) {
            const $select = $('select[name="id_user"]');
            $select.empty().append('<option value="" disabled selected>Pilih Pengirim </option>');
            $.each(response.data, function(key, value) {
                $select.append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });

    $.ajax({
        url: "/api/v1/jenis-laporan",
        method: "GET",
        dataType: "json",
        success: function(response) {
            const $select = $('select[name="id_jenis"]');
            $select.empty().append('<option value="" disabled selected>Pilih Jenis Surat</option>');
            $.each(response.data.data, function(key, value) {
                $select.append('<option value="' + value.id + '">' + value.nama_jenis_laporan + '</option>');
            });
        }
    });

    $.ajax({
        url: "/api/v1/sifat-laporan",
        method: "GET",
        dataType: "json",
        success: function(response) {
            const $select = $('select[name="id_sifat"]');
            $select.empty().append('<option value="" disabled selected>Pilih Sifat Surat</option>');
            $.each(response.data.data, function(key, value) {
                $select.append('<option value="' + value.id + '">' + value.nama_sifat_laporan + '</option>');
            });
        }
    });

    $.ajax({
        url: "/api/v1/status-laporan",
        method: "GET",
        dataType: "json",
        success: function(response) {
            const $select = $('select[name="id_status"]');
            $select.empty().append('<option value="" disabled selected>Pilih Status Surat</option>');
            $.each(response.data, function(key, value) {
                $select.append('<option value="' + value.id + '">' + value.nama_status_laporan + '</option>');
            });
        }
    });
    });
   
</script>
