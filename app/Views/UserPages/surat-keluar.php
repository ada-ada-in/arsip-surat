<?= $this->extend('layouth/user_layout') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row d-flex justify-content-between">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Data Surat Keluar</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= url_to('admin') ?>">Surat</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Surat Keluar
                            </li>
                        </ol>   
                    </nav>
                </div>
                <div class="col-md-3 col-sm-4 text-right">
                    <div class="form-group">
                        <input class="form-control" id="searchinput" placeholder="Cari....." type="text" />
                    </div>
										<button class="btn btn-primary " data-toggle="modal" data-target="#addmodal" >+</button>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 table-responsive">
                <table class="data-table table stripe hover data-table-export nowrap">
                    <thead>
                        <tr>
                            <th class="table-plus datatable-nosort">No.</th>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Nomor Agenda</th>
                            <th>File Surat</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal Dibuat</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody id="data-disposisi">
                        <!-- dynamic rows go here -->
                    </tbody>
                </table>
                <div id="pageInfo" class="mt-2 text-center text-muted"></div>
            </div>
        </div>
    </div>
</div>

<?= view('userPages/modals/surat-keluar/add-modal') ?>
<?= view('userPages/modals/surat-keluar/edit-modal') ?>

<script>
    $(function () {
        let currentPage = 1;
        const rowsPerPage = 10;
        let filteredData = [];

        function displayTable(data) {
            const start = (currentPage - 1) * rowsPerPage;
            const end = start + rowsPerPage;
            const paginatedItems = data.slice(start, end);

            let row = '';
            paginatedItems.forEach((item, i) => {
            row += `
                    <tr>
                        <td class="table-plus">${start + i + 1}</td>
                        <td>${item.nomor_surat}</td>
                        <td>${item.perihal}</td>
                        <td>${item.nomor_agenda}</td>
                        <td>
                            <a href="/${item.link_surat}"
                                target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                <i class="dw dw-download"></i> Lihat
                            </a>
                        </td>
                        <td>${item.nama_jenis_laporan}</td>
                        <td>${item.created_at}</td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <button type="button" class="dropdown-item btn-edit" data-toggle="modal" data-target="#editmodal"
                                        data-id="${item.id}"
                                        data-user="${item.id_user}"
                                        data-jenis="${item.id_jenis}"
                                        data-sifat="${item.id_sifat}"
                                        data-status="${item.id_status}"
                                        data-perihal="${item.perihal}"
                                        data-nomorsurat="${item.nomor_surat}"
                                        data-nomoragenda="${item.nomor_agenda}"
                                        data-lampiran="${item.lampiran}"
                                        data-dari="${item.dari}">
                                        <i class="dw dw-edit2"></i> Edit
                                    </button>
                                    <!-- <button class="dropdown-item btn-delete" data-id="${item.id}">
                                        <i class="dw dw-delete-3"></i> Delete
                                    </button> -->
                                </div>
                            </div>
                        </td>
                    </tr>
                `;
            });

            $('#data-disposisi').html(row);
            $('#pageInfo').text(`Page ${currentPage} of ${Math.ceil(data.length / rowsPerPage)}`);
        }

        // Paginasi

        function displayPagination(totalItems) {
            const totalPages = Math.ceil(totalItems / rowsPerPage);
            let paginationButtons = '';

            for (let i = 1; i <= totalPages; i++) {
                paginationButtons += `
                    <button class="btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-secondary'}" data-page="${i}">
                        ${i}
                    </button>
                `;
            }

            $('#pagination').html(paginationButtons);
        }

        $(document).on('click', '#pagination button', function () {
            currentPage = parseInt($(this).data('page'));
            displayTable(filteredData);
            displayPagination(filteredData.length);
        });

        // Fetch Data

        function loadData() {
            const id = localStorage.getItem('id'); 
            $.ajax({
                url: '/api/v1/surat/keluar/user/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                        let data = response.data;

                        if (!Array.isArray(data)) {
                            data = [data]; 
                        }

                    filteredData = data;
                    displayTable(filteredData);
                    displayPagination(filteredData.length);
                },
                error: function (error) {
                    console.error('Error fetching data:', error);
                }
            });
        }

        loadData();



        // Delete

        $(document).on('click', '.btn-delete', function () {
            const id = $(this).data('id');
            if (confirm('Apakah kamu yakin ingin menghapus suratini?')) {
                $.ajax({
                    url: `/api/v1/surat/${id}`,
                    type: 'DELETE',
                    success: function () {
                        alert('Surat berhasil dihapus!');
                        loadData(); 
                    },
                    error: function (xhr, status, error) {
                        try {
                            const response = JSON.parse(xhr.responseText);
                            let errorMessage = '';
                            if (response.messages) {
                                for (const key in response.messages) {
                                    if (response.messages.hasOwnProperty(key)) {
                                        errorMessage += `${response.messages[key]}\n`;
                                    }
                                }
                            } else if (response.message) {
                                errorMessage = response.message;
                            } else {
                                errorMessage = 'Terjadi kesalahan yang tidak diketahui.';
                            }
                            alert(errorMessage); 
                        } catch (e) {
                            console.error('Gagal parse response error:', e);
                            alert('Terjadi kesalahan saat memproses respons error.');
                        }
                    }
                });
            }
        });


        $(document).on('click', '.btn-edit', function () {
            const button = $(this);
            $('#editmodal input[name="id"]').val(button.data('id'));
            $('#editmodal input[name="perihal"]').val(button.data('perihal'));
            $('#editmodal input[name="nomor_surat"]').val(button.data('nomorsurat'));
            $('#editmodal input[name="nomor_agenda"]').val(button.data('nomoragenda'));
            $('#editmodal input[name="lampiran"]').val(button.data('lampiran'));
            $('#editmodal input[name="dari"]').val(button.data('dari'));
            $('#editmodal select[name="id_user"]').val(button.data('user'));
            $('#editmodal select[name="id_jenis"]').val(button.data('jenis'));
            $('#editmodal select[name="is_completed"]').val(button.data('iscompleted'));
            $('#editmodal select[name="id_sifat"]').val(button.data('sifat'));
            $('#editmodal select[name="id_status"]').val(button.data('status'));
            $('#editmodal').modal('show');
        });

        $('#form-edit').on('submit', function (e) {
            e.preventDefault();

            const form = this;
            const id = $(form).find('input[name="id"]').val();
            const formData = {
                id_user: $(form).find('select[name="id_user"]').val(),
                id_jenis: $(form).find('select[name="id_jenis"]').val(),
                id_sifat: $(form).find('select[name="id_sifat"]').val(),
                id_status: $(form).find('select[name="id_status"]').val(),
                nomor_surat: $(form).find('input[name="nomor_surat"]').val(),
                lampiran: $(form).find('input[name="lampiran"]').val(),
                nomor_agenda: $(form).find('input[name="nomor_agenda"]').val(),
                perihal: $(form).find('input[name="perihal"]').val(),
                dari: $(form).find('input[name="dari"]').val(),
                is_completed: $(form).find('select[name="is_completed"]').val(),
                tipe_surat: $(form).find('input[name="tipe_surat"]').val()
            };

            $.ajax({
                url: `/api/v1/surat/${id}`,
                type: 'POST',
                dataType: 'json',
                data: JSON.stringify(formData),
                processData: false,
                contentType: 'application/json',
                success: function (response) {
                    alert(response.message);
                    $('#editmodal').modal('hide');
                    loadData();
                },
                error: function (xhr) {
                    try {
                        const response = JSON.parse(xhr.responseText);
                        let errorMessage = '';
                        if (response.messages) {
                            for (const key in response.messages) {
                                errorMessage += `${response.messages[key]}\n`;
                            }
                        } else if (response.message) {
                            errorMessage = response.message;
                        } else {
                            errorMessage = 'Terjadi kesalahan saat update.';
                        }
                        alert(errorMessage);
                    } catch (e) {
                        alert('Gagal memproses respons error.');
                    }
                }
            });
        });



    $('#searchinput').on('input', function () {
        const keyword = $(this).val().toLowerCase();
        const filtered = filteredData.filter(item =>
            item.nomor_surat.toLowerCase().includes(keyword) ||
            item.user_name.toLowerCase().includes(keyword) ||
            item.tipe_surat.toLowerCase().includes(keyword) ||
            item.created_at.toLowerCase().includes(keyword) 
        );

        currentPage = 1; // reset to first page
        displayTable(filtered);
        displayPagination(filtered.length);
    });



            

    });
</script>


<div id="pagination" class="mt-3 text-center"></div>

<?= $this->endSection() ?>
