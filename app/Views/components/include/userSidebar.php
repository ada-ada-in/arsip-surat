<div class="left-side-bar">
			<div class="brand-logo">
				<a href="<?= base_url('user/dashboard') ?>">
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
							<a href="<?= base_url('user/dashboard') ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
					<li class="dropdown">
							<a href="<?= base_url('user/arsip') ?>" class="dropdown-toggle no-arrow">
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
								<li><a href="<?= base_url('user/surat-masuk') ?>">Surat Masuk</a></li>
								<li><a href="<?= base_url('user/surat-keluar') ?>">Surat Keluar</a></li>
							</ul>
						</li>

						<li class="dropdown">
							<a href="<?= base_url('user/disposisi') ?>" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-table"></span
								><span class="mtext">Disposisi</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>