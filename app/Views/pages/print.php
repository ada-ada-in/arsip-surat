<?= view('/components/include/head') ?>

<div class="pd-ltr-20 xs-pd-20-10">
        <div class="card-box mb-30 border border-dark border-2 p-3">
            <div class="pb-20" id="generatePdf">
                <!-- Header Logo dan Judul -->
                <div class="row mx-auto d-flex align-items-center text-center">
                    <img src="/images/logo-bawaslu.png" class="img-fluid my-3 mx-auto d-block" style="max-width: 300px;">
                    <div class="mx-5">
                        <h3>Badan Pengawas Pemilihan Umum <br> Kabupaten Muaro Jambi</h3>
                    </div>
                </div>

                <!-- Peringatan -->
                <div class="row d-flex justify-content-center border border-dark border-2 py-3">
                    <h6>PERHATIAN: DILARANG MEMISAHKAN SEHELAI SURAT APAPUN YANG DIGABUNG DALAM BERKAS INI</h6>
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
                <div class="row">
                    <div class="col-6 p-4" id="disposisikepada">
                        <!-- checkbox disposisi kepada -->
                    </div>
                    <div class="col-6 p-4" id="disposisipetunjuk">
                       <!-- checkbox disposisi petunjuk -->
                    </div>

                    <div class="col-8"></div>

                    <!-- Tanda Tangan -->
                    <div class="col-4 mt-5">
                        <div class="float-end text-end pe-5">
                            <p id="ttd-tanggal">Muaro Jambi, ____________</p>
                            <p id="ttd-nama">______________________</p>
                            <br><br><br>
                            <p class="fw-bold"  id="ttd-kordinator">__________________________</p>
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

  setTimeout(() => {
    window.print()
  },1500)

</script>


<?= view('/components/include/footer') ?>
<?= view('/components/include/script') ?>



<style>
@media print {
  @page {
    size: A4;
  }
}
</style>
