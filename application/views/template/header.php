<header class="main-header">
	<!-- Logo -->
	<a href="<?= base_url() ?>" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>SIS</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>SISFO. SKRIPSI</b></span>
	</a>
	<!-- Header Navbar: style can be found in header.less -->
	<nav class="navbar navbar-static-top">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>

		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">

				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php
						if (isset($this->fu->userLogin()['foto'])) {
							$foto = base_url('upload/' . $this->fu->userLogin()['foto']);
						} else {
							$foto = base_url('upload/profile.jpg');
						}
						?>
						<img src="<?= $foto ?>" class="user-image" alt="User Image">
						<?php
						$nama       = $this->fu->userLogin()['nama_lkp'];
						$nama_prodi = $this->fu->userLogin()['prodi_nama'];
						?>
						<span class="hidden-xs"><?= strtoupper($nama) ?></span>
					</a>
					<ul class="dropdown-menu">
						<!-- Menu Body -->
						<li class="user-body">
							<div class="row">
								<div class="text-center">
									<p class="text-bold">
										<?= strtoupper($nama) ?>
									</p>
								</div>
								<div class=" text-center">
									<p>
										<?= strtoupper($nama_prodi) ?>
									</p>
								</div>
							</div> <!-- /.row -->
						</li>
						<!-- Menu Footer-->
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?= site_url('profile') ?>" class="btn btn-default btn-flat">Profile</a>
							</div>
							<div class="pull-right">
								<a href="<?= site_url('auth/logout') ?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
