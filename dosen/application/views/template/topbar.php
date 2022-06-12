<header class="main-header">
	<nav class="navbar navbar-static-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="<?= site_url() ?>" class="navbar-brand"><b>SISKRIPSI</b></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
					<i class="fa fa-bars"></i>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="<?= site_url('dashboard') ?>">DASHBOARD</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">MENU <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?= site_url('bimbingan') ?>">BIMBINGAN SKRIPSI</a></li>
							<li><a href="<?= site_url('bimbingan/riwayat') ?>">RIWAYAT BIMBINGAN SKRIPSI</a></li>
							<?php if ($this->session->userdata('role') == 2) { ?>
								<li class="divider"></li>
								<li><a href="<?= site_url('dosen') ?>">DAFTAR DOSEN </a></li>
								<li><a href="<?= site_url('pembimbing') ?>">PEMBIMBING SKRIPSI</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('jadwal_proposal') ?>">PENGUJI SIDANG PROPOSAL SKRIPSI</a></li>
								<li><a href="<?= site_url('jadwal_skripsi') ?>">PENGUJI SIDANG SKRIPSI</a></li>
							<?php } ?>
						</ul>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">JADWAL <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?= site_url('jadwal/sdg_proposal') ?>">SIDANG PROPOSAL SKRIPSI</a></li>
							<li><a href="<?= site_url('jadwal/sdg_skripsi') ?>">SIDANG SKRIPSI</a></li>
						</ul>
					</li>
					<li><a href="<?= site_url('info') ?>">INFO</a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">DOWNLOAD <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="<?= site_url('download/penulisan_ta') ?>">PEDOMAN PENULISAN T.A</a></li>
						</ul>
					</li>
					<!-- <li><a href="<?= site_url('pedoman') ?>">PEDOMAN</a></li> -->
				</ul>

				<!-- navbar kanan -->
				<ul class="nav navbar-nav navbar-right">
					<!-- <li><a href="#">Link</a></li> -->

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

				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</header>
