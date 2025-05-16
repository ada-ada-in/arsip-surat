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
                <div class="col-md-3 col-sm-4 text-right">
                    <div class="form-group">
                        <input class="form-control" id="searchinput" placeholder="Cari....." type="text" />
                    </div>
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
                            <p>No. Surat    :</p>
                            <p>Tgl Surat    :</p>
                            <p>Lampiran     :</p>
                        </div>
                    </div>
                    <div class="col border border-dark border-2">
                        <div class="m-2">
                            <p>Status       :</p>
                            <p>Sifat        :</p>
                            <p>Jenis        :</p>
                        </div>
                    </div>
                    <div class="col border border-dark border-2">
                        <div class="m-2">
                            <p>Di Terima    :</p>
                            <p>No. Agenda   :</p>
                        </div>
                    </div>
                </div>

                <!-- Dari dan Perihal -->
                <div class="row border border-dark border-2">
                    <div class="mx-4 py-2">
                        <p>Dari     :</p>
                        <p>Perihal     :</p>
                    </div>
                </div>

                <!-- Urgensi -->
                <div class="row d-flex justify-content-center align-items-center border border-dark border-2 p-2">
                    <div class="col">
                        <p><input type="checkbox"> Sangat Segera</p>
                    </div>
                    <div class="col">
                        <p><input type="checkbox"> Segera</p>
                    </div>
                    <div class="col">
                        <p><input type="checkbox"> Penting</p>
                    </div>
                    <div class="col">
                        <p><input type="checkbox"> Biasa</p>
                    </div>
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

<?= $this->endSection() ?>
