<div class="left-side-bar">
			<div class="brand-logo">
				<a href="<?= url_to('admin') ?>">
					<img src="/assets/deskapp/vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
					<img
						src="/assets/deskapp/vendors/images/deskapp-logo-white.svg"
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
							<a href="javascript:;" class="dropdown-toggle">
								<span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Surat</span>
							</a>
							<ul class="submenu">
								<li><a href="<?= url_to('suratMasuk') ?>">Surat Masuk</a></li>
								<li><a href="<?= url_to('suratKeluar') ?>">Surat Keluar</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>