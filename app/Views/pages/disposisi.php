<?= $this->extend('layouth/admin_layout') ?>
<?= $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
					<div class="page-header">
                    <div class="row d-flex justify-content-between ">
                            <div class="col-md-6 col-sm-12">
                                <div class="title">
                                    <h4>Data Disposisi</h4>
                                </div>
                                <nav aria-label="breadcrumb" role="navigation">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="<?= url_to('admin') ?>">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Disposisi
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


					<div class="card-box mb-30">
						<div class="pb-20 table-responsive">
							<table class="data-table table stripe hover data-table-export nowrap">
								<thead>
									<tr>
										 <th class="table-plus datatable-nosort">No.</th>
										<th>Pengirim</th>
										<th>Email Pengirim</th>
										<th>Nomor Surat</th>
										<th>Perihal</th>
										<th>Tipe Surat</th>
										<th>Jenis Surat</th>
										<th>Tanggal Dibuat</th>
									</tr>
								</thead>
								<tbody id="data-disposisi">
									<!-- Data will be populated here by JavaScript -->
								</tbody>
							</table>
							<div id="pageInfo" class="mt-2 text-center text-muted"></div>
							<div id="pagination" class="text-center mt-3"></div>
						</div>
					</div>
				</div>
			</div>


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
						<tr 
						style="cursor: pointer; transition: background-color 0.2s ease;" 
						onmouseover="this.style.backgroundColor='#f2f2f2'" 
						onmouseout="this.style.backgroundColor=''" 
						onclick="window.location.href='/admin/disposisi/isidisposisi?id=${item.id}'">
                        <td class="table-plus">${start + i + 1}</td>
                        <td>${item.user_name}</td>
                        <td>${item.user_email}</td>
                        <td>${item.nomor_surat}</td>
                        <td>${item.perihal}</td>
						<td>
						<span class="badge ${item.tipe_surat == 'masuk' ? 'bg-primary' : 'bg-warning	'} text-white fw-bold">
							${item.tipe_surat}
						</span> 
						</td>                       
						<td>${item.nama_jenis_laporan}</td>
                        <td>${item.created_at}</td>
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

        // Hentikan bubbling khusus pada link di dalam tabel
            $('#data-disposisi').on('click', 'a', function (e) {
                e.stopPropagation();
            });


        // Fetch Data

        function loadData() {
            $.ajax({
                url: '/api/v1/surat',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                        let data = response.data;
						console.log(data);

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


        $('#searchinput').on('input', function () {
            const keyword = $(this).val().toLowerCase();
            const filtered = filteredData.filter(item =>
                item.user_name.toLowerCase().includes(keyword) ||
                item.user_email.toLowerCase().includes(keyword) ||
                item.nomor_surat.toLowerCase().includes(keyword) ||
                item.tipe_surat.toLowerCase().includes(keyword) 
            );

            currentPage = 1; // reset to first page
            displayTable(filtered);
            displayPagination(filtered.length);
        });
    });
</script>


<?= $this->endSection() ?> 