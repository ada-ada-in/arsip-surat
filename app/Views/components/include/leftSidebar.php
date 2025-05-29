<div class="left-side-bar">
			<div class="brand-logo">
				<a href="<?= url_to('admin') ?>">
					<img src="/images/logo-bawaslu.png" alt="" class="dark-logo" />
					<img
						src="/images/logo-bawaslu.png""
						alt="/"
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
					<li class="dropdown">
							<a href="<?= url_to('admin') ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="<?= url_to('arsip') ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-textarea-resize"></span
								><span class="mtext">Arsip</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Surat</span>
							</a>
							<ul class="submenu">
								<li><a href="<?= url_to('suratMasuk') ?>">Surat Masuk</a></li>
								<li><a href="<?= url_to('suratKeluar') ?>">Surat Keluar</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Filter Surat</span>
							</a>
							<ul class="submenu">
								<li><a href="<?= url_to('jenissurat') ?>">Jenis Surat</a></li>
								<li><a href="<?= url_to('sifatsurat') ?>">Sifat Surat</a></li>
								<li><a href="<?= url_to('statussurat') ?>">Status Surat</a></li>
								<li><a href="<?= url_to('disposisikepada') ?>">Disposisi Kepada</a></li>
								<li><a href="<?= url_to('disposisipetunjuk') ?>">Disposisi Petunjuk</a></li>
							</ul>
						</li>
						<li class="dropdown">
							<a href="<?= url_to('disposisi') ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-table"></span
								><span class="mtext">Disposisi</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="<?= url_to('backup') ?>" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-file"></span
								><span class="mtext">Back Up</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="<?= url_to('pengguna') ?>" class="dropdown-toggle no-arrow">
								<span class="micon dw dw-user1"></span
								><span class="mtext">Pengguna</span>
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>