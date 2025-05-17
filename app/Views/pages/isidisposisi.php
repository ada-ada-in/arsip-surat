<?= $this->extend('layouth/admin_layout') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Isi Disposisi</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= url_to('admin') ?>">Disposisi</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Isi Disposisi
                            </li>
                        </ol>   
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12  d-flex justify-content-end align-items-start">
                    <button class="btn btn-primary mx-4">Cetak</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>

        <div class="card-box mb-30 border border-dark border-2">
            <div class="pb-20 table-responsive">
                <!-- Header Logo dan Judul -->
                <div class="row mx-auto d-flex align-items-center text-center">
                    <img src="/images/logo-bawaslu.png" width="300" class="m-5">
                    <div class="mx-5">
                        <h3>Badan Pengawas Pemilihan Umum <br> Kabupaten Muaro Jambi</h3>
                    </div>
                </div>

                <!-- Peringatan -->
                <div class="row d-flex justify-content-center border border-dark border-2 py-3">
                    <h5>PERHATIAN: DILARANG MEMISAHKAN SEHELAI SURAT APAPUN YANG DIGABUNG DALAM BERKAS INI</h5>
                </div>

                <!-- Informasi Surat -->
                <div class="row">
                    <div class="col border border-dark border-2">
                        <div class="m-2">
                            <p id="noSurat">No. Surat    :</p>
                            <p id="tglSurat">Tgl Surat    :</p>
                            <p id="lampiran">Lampiran     :</p>
                        </div>
                    </div>
                    <div class="col border border-dark border-2">
                        <div class="m-2">
                            <p id="status">Status       :</p>
                            <p id="sifat">Sifat        :</p>
                            <p id="jenis">Jenis        :</p>
                        </div>
                    </div>
                    <div class="col border border-dark border-2">
                        <div class="m-2">
                            <div class="d-flex align-items-center mb-2">
                                <label for="diterima" class="me-2 fw-bold" style="min-width: 80px;">Di Terima:</label>
                                <input type="date" id="diterima" name="diterima" class="form-control w-50 mx-3" required>
                            </div>
                            <p id="noAgenda" class="mb-0">No. Agenda :</p>
                        </div>
                    </div>
                </div>

                <!-- Dari dan Perihal -->
                <div class="row border border-dark border-2">
                    <div class="mx-4 py-2">
                        <p id="dari">Dari     :</p>
                        <p id="perihal">Perihal     :</p>
                    </div>
                </div>

                <!-- Urgensi -->
                <div class="row d-flex justify-content-center align-items-center border border-dark border-2 p-2" id="jenislaporan">
                    <!-- Data from AJAX will go here -->
                </div>

                <!-- Disposisi dan Petunjuk -->
                <div class="row border border-dark">
                    <div class="col-6 p-4">
                        <p class="font-weight-bold">Disposisi Kepada:</p>
                        <div class="row">
                            <div class="col-md-12">
                                <p><input type="checkbox"> Ketua / Koord. SDMO dan Diklat</p>
                                <p><input type="checkbox"> Koord. Pengawasan Pelanggaran dan Penyelesaian Sengketa</p>
                                <p><input type="checkbox"> Koord. HPP/HM</p>
                                <p><input type="checkbox"> Koordinator Sekretariat</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-4">
                        <p class="font-weight-bold">Petunjuk Disposisi:</p>
                        <div class="row">
                            <div class="col-md-12">
                                <p><input type="checkbox"> Ketua / Koord. SDMO dan Diklat</p>
                                <p><input type="checkbox"> Koord. Pengawasan Pelanggaran dan Penyelesaian Sengketa</p>
                                <p><input type="checkbox"> Koord. HPP/HM</p>
                                <p><input type="checkbox"> Koordinator Sekretariat</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-8"></div>

                    <!-- Tanda Tangan -->
                    <div class="col-4 mt-5">
                        <div class="float-end text-end pe-5">
                            <p>Muaro Jambi, ____________</p>
                            <p>Koordinator Sekretariat</p>
                            <br><br><br>
                            <p class="fw-bold">__________________________</p>
                            <p>NIP: ______________________</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');


        $.ajax({
            url: '/api/v1/jenis-laporan',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                const data = response.data.data;
                let div = ``;

                data.forEach(item => {
                    div += `
                        <div class="col-md-3 col-sm-6">
                            <p>
                                <input type="checkbox" name="jenis_laporan" value="${item.nama_jenis_laporan}">
                                ${item.nama_jenis_laporan}
                            </p>
                        </div>
                    `;
                });

                $('#jenislaporan').html(div);
            },
            error: function(error) {
                console.error('Gagal mengambil data jenis laporan: ', error);
            }
        });

        $.ajax({
            url: `/api/v1/surat/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                const data = response.data
                console.log(data)
                const noSurat = data.nomor_surat
                const tglSurat = data.created_at
                const tanggalObj = new Date(tglSurat);
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const formattedTanggal = tanggalObj.toLocaleDateString('id-ID', options);
                const lampiran = data.lampiran
                const status = data.nama_status_laporan
                const sifat = data.nama_sifat_laporan
                const jenis = data.nama_jenis_laporan
                const noAgenda = data.nomor_agenda
                const dari = data.dari
                const perihal = data.perihal

                $('#noSurat').html(`No. Surat :   ${noSurat}`);
                $('#tglSurat').html(`Tgl Surat :  ${formattedTanggal}`);
                $('#lampiran').html(`Lampiran :  ${lampiran}`);
                $('#status').html(`Status :  ${status}`);
                $('#sifat').html(`Sifat :  ${sifat}`);
                $('#jenis').html(`Jenis :  ${jenis}`);
                $('#noAgenda').html(`No. Agenda :  ${noAgenda}`);
                $('#dari').html(`Dari       :  ${dari}`);
                $('#perihal').html(`Perihal :  ${perihal}`);
            }
        })

    });
</script>

<?= $this->endSection() ?>
