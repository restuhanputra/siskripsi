<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li><a href="<?= base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> <span>DASHBOARD</span></a></li>
			<li><a href="<?= site_url('info') ?>"><i class="fa fa-bullhorn"></i> <span>INFO</span></a></li>
			<li><a href="<?= site_url('tahun_akademik') ?>"><i class="fa fa-calendar-check-o"></i> <span>TAHUN AKADEMIK</span></a></li>
			<li><a href="<?= site_url('prodi') ?>"><i class="fa fa-list-alt"></i> <span>PROGRAM STUDI</span></a></li>
			<li><a href="<?= site_url('jadwal_reg') ?>"><i class="fa fa-calendar-plus-o"></i> <span>JADWAL REGISTRASI</span></a></li>
			<li class="header">MANAGEMENT BIMBINGAN</li>
			<li><a href="<?= site_url('bimbingan') ?>"><i class="fa fa-wechat"></i> <span>BIMBINGAN SKRIPSI</span></a></li>
			<li class="header">MENU</li>
			<li><a href="<?= site_url('proposal') ?>"><i class="fa fa-files-o"></i> <span>DATA PROPOSAL</span></a></li>
			<li><a href="<?= site_url('sdg_proposal') ?>"><i class="fa fa-files-o"></i> <span>DATA S. PROPOSAL</span></a></li>
			<li><a href="<?= site_url('sdg_skripsi') ?>"><i class="fa fa-files-o"></i> <span>DATA S. SKRIPSI</span></a></li>
			<li><a href="<?= site_url('wisuda') ?>"><i class="fa fa-files-o"></i> <span>DATA WISUDA</span></a></li>
			<li class="header">JADWAL</li>
			<li><a href="<?= site_url('jadwal_proposal') ?>"><i class="fa fa-calendar-plus-o"></i> <span>JADWAL S.PROPOSAL</span></a></li>
			<li><a href="<?= site_url('jadwal_skripsi') ?>"><i class="fa fa-calendar-plus-o"></i> <span>JADWAL S.SKRIPSI</span></a></li>
			<li class="header">MANAGEMENT USER</li>
			<li><a href="<?= site_url('mahasiswa') ?>"><i class="fa fa-user"></i> <span>MAHASISWA</span></a></li>
			<li><a href="<?= site_url('dosen') ?>"><i class="fa fa-mortar-board"></i> <span>DOSEN</span></a></li>
			<?php if ($this->session->userdata('role') == 2) {
			?>
				<li><a href="<?= site_url('admin') ?>"><i class="fa fa-user-secret"></i> <span>ADMIN</span></a></li>

				<!-- <li><a href="<? //= site_url('konfigurasi') 
													?>"><i class=fa-user-secret"></i> <span>KONFIGURASI</span></a></li> -->
			<?php
			}
			?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>
