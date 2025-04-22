<?= $this->extend('layouth/admin_layout') ?>
<?= $this->section('content') ?>

			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="title pb-20">
					<h2 class="h3 mb-0">Dashboard Overview</h2>
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">75</div>
									<div class="font-14 text-secondary weight-500">
										Users
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy dw dw-user1"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">100</div>
									<div class="font-14 text-secondary weight-500">
										Arsip
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<span class="icon-copy bi bi-filetype-doc"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">40</div>
									<div class="font-14 text-secondary weight-500">
										Surat Masuk
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon">
										<i
											class="icon-copy bi bi-filetype-doc"
											aria-hidden="true"
										></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">50</div>
									<div class="font-14 text-secondary weight-500">Surat Keluar</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy bi bi-filetype-doc" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

                <div class="bg-white pd-20 card-box mb-30">
					<h4 class="h4 text-blue">Area Chart</h4>
					<div id="chart2"></div>
				</div>
			</div>

<?= $this->endSection() ?> 