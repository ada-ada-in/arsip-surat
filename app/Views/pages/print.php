<?= view('/components/include/head') ?>

<style>
/* Tampilan normal di browser (setengah A4) */
@media screen {
  body {
    width: 210mm;
    height: 148mm; /* Half A4 height */
    margin: 0 auto;
    font-size: 12px;
  }
  .card-box {
    width: 100% !important;
    height: 140mm !important;
    overflow: hidden;
  }
}

/* Tampilan saat cetak (A4 penuh) */
@media print {
  @page {
    size: A4; /* Ukuran kertas A4 */
    margin: 10mm;
  }
    header, nav, footer, .no-print {
    display: none !important;
  }
  title::before {
    content: '';
  }
  body {
    width: 100% !important;
    height: auto !important;
    font-size: 12pt;
  }
  
  .card-box {
    height: auto !important;
    page-break-after: always; /* Memastikan konten di halaman baru */
  }
  /* Perbesar elemen yang perlu di A4 */
  img {
    max-width: 200px !important;
  }
  h3 {
    font-size: 14pt !important;
  }
  input {
    font-size: 12pt !important;
  }
}
</style>
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="card-box mb-30 border border-dark border-2 p-3">
        <div class="pb-20" id="generatePdf">
            <!-- Header Logo dan Judul -->
            <div class="row mx-auto d-flex align-items-center text-center">
                <img src="/images/logo-bawaslu.png" class="img-fluid my-2 mx-auto d-block" style="max-width: 200px;">
                <div class="mx-2">
                    <h3>Badan Pengawas Pemilihan Umum <br> Kabupaten Muaro Jambi</h3>
                </div>
            </div>

            <!-- Peringatan -->
            <div class="row d-flex justify-content-center border border-dark border-2 py-2 my-2">
                <h6>PERHATIAN: DILARANG MEMISAHKAN SEHELAI SURAT APAPUN YANG DIGABUNG DALAM BERKAS INI</h6>
            </div>

            <!-- Informasi Surat -->
            <div class="row">
                <div class="col border border-dark border-2 p-1">
                    <div class="m-1">
                        <p id="noSurat">No. Surat    :</p>
                        <p id="tglSurat">Tgl Surat    :</p>
                        <p id="lampiran">Lampiran     :</p>
                    </div>
                </div>
                <div class="col border border-dark border-2 p-1">
                    <div class="m-1">
                        <p id="status">Status       :</p>
                        <p id="sifat">Sifat        :</p>
                        <p id="jenis">Jenis        :</p>
                    </div>
                </div>
                <div class="col border border-dark border-2 p-1">
                    <div class="m-1">
                        <div class="d-flex align-items-center mb-1">
                            <label for="diterima" class="me-1 fw-bold" style="min-width: 60px;">Di Terima:</label>
                            <input type="date" id="diterima" name="diterima" class="form-control w-50 mx-1" style="height: 25px; font-size: 11px;" required>
                        </div>
                        <p id="noAgenda" class="mb-0">No. Agenda :</p>
                    </div>
                </div>
            </div>

            <!-- Dari dan Perihal -->
            <div class="row border border-dark border-2 my-2">
                <div class="mx-2 py-1">
                    <p id="dari">Dari     :</p>
                    <p id="perihal">Perihal     :</p>
                </div>
            </div>

            <!-- Urgensi -->
            <div class="row d-flex justify-content-center align-items-center border border-dark border-2 p-1 my-2" id="jenislaporan">
                <!-- Data from AJAX will go here -->
            </div>

            <!-- Disposisi dan Petunjuk -->
            <div class="row">
                <div class="col-6 p-2">
                    <div class="fw-bold mb-2">Disposisi Kepada:</div>
                    <div  id="disposisikepada">
                        <!-- checkbox disposisi kepada -->
                    </div>
                </div>
                
               <div class="col-6 p-2">
                    <div class="fw-bold mb-2">Petunjuk Disposisi:</div>
                    <!-- Dibagi menjadi 2 sub-kolom -->
                    <div class="row">
                        <div class="col-6" id="disposisipetunjuk1">
                            <!-- Bagian 1 (A-D) -->
                        </div>
                        <div class="col-6" id="disposisipetunjuk2">
                            <!-- Bagian 2 (E-H) -->
                        </div>
                    </div>
                </div>

                <!-- Tanda Tangan -->
                <div class="col-12 mt-3 justify-content-end d-flex my-5" >
                    <div class="float-end text-end pe-3" style="margin-right: 20px;">
                        <p id="ttd-tanggal">Muaro Jambi, ____________</p>
                        <p id="ttd-nama">______________________</p>
                        <br>
                        <br>
                        <br>
                        <p class="fw-bold" id="ttd-kordinator">__________________________</p>
                        <hr style="width: 300px; border-color: #000;">
                        <p style="margin-top: -15px;" id="ttd-nip">NIP: ______________________</p>
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

                $('#noSurat').html(`No. Surat : ${noSurat}`);
                $('#tglSurat').html(`Tgl Surat : ${formattedTanggal}`);
                $('#lampiran').html(`Lampiran : ${lampiran}`);
                $('#status').html(`Status : ${status}`);
                $('#sifat').html(`Sifat : ${sifat}`);
                $('#jenis').html(`Jenis : ${jenis}`);
                $('#noAgenda').html(`No. Agenda : ${noAgenda}`);
                $('#dari').html(`Dari : ${dari}`);
                $('#perihal').html(`Perihal : ${perihal}`);
                $('#diterima').val(formattedTerima);

                if (tglterima) {
                    const tglTerimaObj = new Date(tglterima);
                    const yyyy = tglTerimaObj.getFullYear();
                    const mm = String(tglTerimaObj.getMonth() + 1).padStart(2, '0');
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

                        const checkedRadio = $('input[name="disposisi_kepada"]:checked');
                        if (checkedRadio.length) {
                            updateTTD(checkedRadio);
                        }

                        $('input[name="disposisi_kepada"]').on('change', function () {
                            updateTTD($(this));
                        });
                    },
                    error: function(error) {
                        console.error('Gagal mengambil data jenis laporan: ', error);
                    }
                });

                $.ajax({
                    url: '/api/v1/disposisi-petunjuk',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const data = response.data;
                        const midIndex = Math.ceil(data.length / 2);
                        
                        // Bagian Pertama (Kolom Kiri)
                        let div1 = ``;
                        data.slice(0, midIndex).forEach(item => {
                            const isChecked = disposisiPetunjuk === item.id ? 'checked' : '';
                            div1 += `
                                <p class="mb-2">
                                    <input type="radio" name="disposisi_petunjuk" 
                                        value="${item.id}" ${isChecked}>
                                    ${item.nama_disposisi_petunjuk}
                                </p>
                            `;
                        });
                        $('#disposisipetunjuk1').html(div1);
                        
                        // Bagian Kedua (Kolom Kanan)
                        let div2 = ``;
                        data.slice(midIndex).forEach(item => {
                            const isChecked = disposisiPetunjuk === item.id ? 'checked' : '';
                            div2 += `
                                <p class="mb-2">
                                    <input type="radio" name="disposisi_petunjuk" 
                                        value="${item.id}" ${isChecked}>
                                    ${item.nama_disposisi_petunjuk}
                                </p>
                            `;
                        });
                        $('#disposisipetunjuk2').html(div2);
                        
                        // Event handler tetap sama
                        $('input[name="disposisi_petunjuk"]').on('change', function() {
                            localStorage.setItem('id_disposisi_petunjuk', $(this).val());
                        });
                    },
                    error: function(error) {
                        console.error('Error:', error);
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
        });

        $('#btnSimpan').on('click', function () {
            const disposisiKepada = $('input[name="disposisi_kepada"]:checked').val();
            const disposisiPetunjuk = $('input[name="disposisi_petunjuk"]:checked').val();
            const diterima = $('#diterima').val();

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
                type: 'PUT',
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

   function preparePrint() {
  $('body').addClass('printing');
  setTimeout(() => {
    window.print();
    $('body').removeClass('printing');
  }, 1200);
}

document.addEventListener('keydown', (e) => {
  if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
    e.preventDefault();
    preparePrint();
  }
});

preparePrint();
</script>

<?= view('/components/include/footer') ?>
<?= view('/components/include/script') ?>