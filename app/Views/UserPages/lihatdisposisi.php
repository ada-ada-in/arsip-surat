<?= $this->extend('layouth/user_layout') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Lihat Disposisi</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= base_url('user/dashboard') ?>">Disposisi</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Lihat Disposisi
                            </li>
                        </ol>   
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12  d-flex justify-content-end align-items-start"">
                <div id="cetak"></div>
                <button class="btn btn-primary" id="btnSimpan" type="submit">Simpan</button>
                </div>
            </div>
        </div>

        <div class="card-box mb-30 border border-dark border-2">
            <div class="pb-20 table-responsive" id="generatePdf">
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
                        <p >Disposisi Kepada :</p>
                        <div  id="disposisikepada">
                            <!-- checkbox disposisi kepada -->
                        </div>
                    </div>
                    <div class="col-6 p-4">
                        <p>Petunjuk Disposisi :</p>
                        <div id="disposisipetunjuk">
                           <!-- checkbox disposisi petunjuk -->
                        </div>
                    </div>

                    <div class="col-8"></div>

                    <!-- Tanda Tangan -->
                    <div class="col-4 mt-5">
                        <div class="float-end text-end pe-5">
                            <p id="ttd-tanggal">Muaro Jambi, ____________</p>
                            <p id="ttd-nama">______________________</p>
                            <br><br><br>
                            <p class="fw-bold"  id="ttd-kordinator">__________________________</p>
                            <hr style="width: 300px; border-color: #000;">
                            <p id="ttd-nip">NIP: ______________________</p>
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
            url: `/api/v1/surat/${id}`,
            type: 'GET',
            dataType: 'json',
            success: function(response){
                const data = response.data
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
                const tglterima = data.tanggal_diterima
                const tglTerimaObj = new Date(tglterima)
                const formattedTerima = tglTerimaObj.toLocaleDateString('id-ID', options);
                const disposisiKepada = data.id_disposisi_kepada
                const disposisiPetunjuk = data.id_disposisi_petunjuk

                $('#noSurat').html(`No. Surat :   ${noSurat}`);
                $('#tglSurat').html(`Tgl Surat :  ${formattedTanggal}`);
                $('#lampiran').html(`Lampiran :  ${lampiran}`);
                $('#status').html(`Status :  ${status}`);
                $('#sifat').html(`Sifat :  ${sifat}`);
                $('#jenis').html(`Jenis :  ${jenis}`);
                $('#noAgenda').html(`No. Agenda :  ${noAgenda}`);
                $('#dari').html(`Dari       :  ${dari}`);
                $('#perihal').html(`Perihal :  ${perihal}`);
                $('#diterima').val(formattedTerima);

                let cetak = ``

                cetak = 
                `
                <a class="btn btn-primary mx-4" href="/user/disposisi/print?id=${id}" target="_blank">Cetak</a>
                `

                $('#cetak').html(cetak);

                
                
                let completeData = ``
                
                complete = `
                    <button id="btnComplete" class="btn btn-success">Complete</button>
                `

                $('#complete').html(complete)



                if (tglterima) {
                    const tglTerimaObj = new Date(tglterima);
                    const yyyy = tglTerimaObj.getFullYear();
                    const mm = String(tglTerimaObj.getMonth() + 1).padStart(2, '0'); // bulan 0-based
                    const dd = String(tglTerimaObj.getDate()).padStart(2, '0');
                    const formattedInputDate = `${yyyy}-${mm}-${dd}`;
                    $('#diterima').val(formattedInputDate);
                } else {
                    $('#diterima').val('');
                }

                $.ajax({
                    url: '/api/v1/disposisi-kepada',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const data = response.data;
                        let div = `<div class="row">`;

                        data.forEach((item, index) => {
                            if (index % 8 === 0) {
                                div += `<div class="col-md-6">`;
                            }

                            const isChecked = disposisiKepada === item.id ? 'checked' : '';

                            div += `
                                <p>
                                    <input type="radio" name="disposisi_kepada"
                                        value="${item.id}"
                                        data-nama="${item.nama_disposisi_kepada}"
                                        data-kordinator="${item.nama_kordinator}"
                                        data-nip="${item.nip}"
                                        data-created_at="${item.created_at}" ${isChecked}>
                                    ${item.nama_disposisi_kepada}
                                </p>
                            `;

                            if ((index % 8 === 7) || (index === data.length - 1)) {
                                div += `</div>`;
                            }
                        });

                        div += `</div>`;
                        $('#disposisikepada').html(div);

                        // Fungsi update isi ttd
                        function updateTTD(elem) {
                            const nama = elem.data('nama');
                            const nip = elem.data('nip');
                            const kordinator = elem.data('kordinator');

                            const today = new Date();
                            const options = { year: 'numeric', month: 'long', day: 'numeric' };
                            const formattedDate = today.toLocaleDateString('id-ID', options);

                            $('#ttd-nama').text(nama);
                            $('#ttd-nip').text('NIP: ' + nip);
                            $('#ttd-tanggal').text('Muaro Jambi, ' + formattedDate);
                            $('#ttd-kordinator').text(kordinator);
                        }

                        // Set default dari radio yang sudah checked
                        const checkedRadio = $('input[name="disposisi_kepada"]:checked');
                        if (checkedRadio.length) {
                            updateTTD(checkedRadio);
                        }

                        // Event handler untuk perubahan radio
                        $('input[name="disposisi_kepada"]').on('change', function () {
                            updateTTD($(this));
                        });
                    },
                    error: function(error) {
                        console.error('Gagal mengambil data jenis laporan: ', error);
                    }
                });

                $('#btnComplete').on('click', function () {
                 
                    $.ajax({
                        url: `/api/v1/surat/${id}`,
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            is_completed: "1",
                        }),
                        success: function (res) { 
                            alert('Data berhasil disimpan!');
                            window.location.href = '/admin/disposisi'
                        },
                        error: function (err) {
                            alert('Gagal menyimpan data!');
                            console.error(err);
                        }
                    });
                });

                $.ajax({
                    url: '/api/v1/disposisi-petunjuk',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const data = response.data;
                        let div = `<div class="row">`;
                        data.forEach((item, index) => {
                            if (index % 8 === 0) {
                                div += `<div class="col-md-6">`;
                            }
                            
                            const isChecked = disposisiPetunjuk === item.id ? 'checked' : '';


                            div += `
                                <p>
                                    <input type="radio" name="disposisi_petunjuk" value="${item.id}" ${isChecked}>
                                    ${item.nama_disposisi_petunjuk}
                                </p>
                            `;

                            if ((index % 8 === 7) || (index === data.length - 1)) {
                                div += `</div>`;
                            }
                        });
                        div += `</div>`;
                        $('#disposisipetunjuk').html(div);

                        $('input[name="disposisi_petunjuk"]').on('change', function () {
                            const id = $(this).val();
                            localStorage.setItem('id_disposisi_petunjuk', id);
                        });

                    },
                    error: function(error) {
                        console.error('Gagal mengambil data jenis laporan: ', error);
                    }
            });


                $.ajax({
                    url: '/api/v1/jenis-laporan',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const data = response.data.data;
                        let div = ``;

                        data.forEach(item => {
                            const isChecked = item.nama_jenis_laporan === jenis ? 'checked' : '';
                             const isDisabled = 'disabled';
                            div += `
                                <div class="col-md-3 col-sm-6">
                                    <p>
                                        <input type="checkbox" name="jenis_laporan" value="${item.nama_jenis_laporan}" ${isChecked} ${isDisabled}>
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

            }
        })

    $('#btnSimpan').on('click', function () {
        const disposisiKepada = $('input[name="disposisi_kepada"]:checked').val();
        const disposisiPetunjuk = $('input[name="disposisi_petunjuk"]:checked').val();
        const diterima = $('#diterima').val();

        console.log(disposisiKepada)
        console.log(disposisiPetunjuk)

        if (!disposisiKepada || !disposisiPetunjuk) {
            alert('Mohon lengkapi pilihan disposisi kepada dan petunjuk!');
            return;
        }

        if(diterima == '') {
            alert('Mohon lengkapi tanggal diterima!');
            return;
        }

        $.ajax({
            url: `/api/v1/surat/${id}`,
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                id_disposisi_kepada: disposisiKepada,
                id_disposisi_petunjuk: disposisiPetunjuk,
                tanggal_diterima: diterima
            }),
            success: function (res) { 
                alert('Data berhasil disimpan!');
                location.reload();
            },
            error: function (err) {
                alert('Gagal menyimpan data!');
                console.error(err);
            }
        });
    });
});

function generatePDF() {
    const element = document.getElementById('generatePdf');

    const opt = {
      margin:       [10, 10, 10, 10],
      filename:     'arsip.pdf',
      image:        { type: 'jpeg', quality: 0.98 },
      html2canvas:  { scale: 2 },
      jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
  }
</script>




<?= $this->endSection() ?>

