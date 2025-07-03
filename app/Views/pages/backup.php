<?= $this->extend('layouth/admin_layout') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Backup</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= url_to('admin') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Backup</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-3 col-sm-4 text-right">
                    <div class="form-group">
                        <input class="form-control" id="searchinput" placeholder="Cari....." type="text" />
                    </div>
                </div>
            </div>

            <div class="my-3">
                <button class="btn btn-primary" id="clickbackup">Back Up</button>
            </div>
        </div>

        <div class="card-box mb-30">
            <h4 class="my-4">Log Backup File</h4>
            <div class="pb-20 table-responsive" id="backup">
                <!-- backup -->
            </div>
        </div>
    </div>
</div>

<script>
    function loadBackupList() {
        $.ajax({
            url: '/api/v1/backup',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let div = ``;

                response.log_files.forEach((item, index) => {
                    const folder = item.download_url;

                    div += `
                        <div class="mb-2 border rounded p-3 bg-light backup-item">
                            <strong class="backup-filename">${index + 1}. ${item.folder}</strong><br>
                            Ukuran: ${item.size_kb} KB<br>
                            Dibuat: ${item.created_at}<br>
                            <a href="/api/v1/backup/download/${folder}" class="btn btn-sm btn-success mt-2" target="_blank">
                                Download
                            </a>
                            <button class="btn btn-sm btn-danger mt-2" onclick="deleteBackup('${folder}')">
                                Delete
                            </button>
                        </div>
                    `;
                });

                $('#backup').html(div);
            },
            error: function () {
                $('#backup').html(`<div class="text-danger">Gagal memuat data backup.</div>`);
            }
        });
    }

    function deleteBackup(folderName) {
        if (!confirm('Yakin ingin menghapus backup ini?')) return;

        $.ajax({
            url: `/api/v1/backup/${folderName}`,
            type: 'DELETE',
            success: function () {
                alert('Backup berhasil dihapus');
                loadBackupList();
            },
            error: function (error) {
                alert('Gagal menghapus backup');
                console.error('Gagal menghapus backup:', error);
            }
        });
    }

    // Initial load
    loadBackupList();

    $('#clickbackup').on('click', () => {
        $.ajax({
            url: '/api/v1/backup',
            type: 'POST',
            dataType: 'json',
            success: function () {
                alert('Data berhasil di-backup');
                loadBackupList();
            },
            error: function () {
                alert('Gagal melakukan backup');
            }
        });
    });

    $('#searchinput').on('keyup', function () {
        let keyword = $(this).val().toLowerCase();
        $('.backup-item').each(function () {
            let filename = $(this).find('.backup-filename').text().toLowerCase();
            $(this).toggle(filename.includes(keyword));
        });
    });

    // Refresh setiap 1 minggu
    setInterval(() => {
        $.ajax({
            url: '/api/v1/backup',
            type: 'POST',
            dataType: 'json',
            success: function () {
                loadBackupList();
            },
            error: function (error) {
                console.error('Gagal melakukan refresh backup:', error);
            }
        });
    }, 604800000); // 1 minggu dalam ms

</script>

<?= $this->endSection() ?>
