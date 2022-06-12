	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-sm-8">

				<div class="info-box">
					<!-- <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span> -->
					<?php $image = base_url('assets/logo.png') ?>
					<span class="info-box-icon img-responsive" style="background-color: #ffff;"><img src="<?= $image ?>" alt="logo"></span>

					<div class="info-box-content">
						<h3>Selamat Datang di Sistem Informasi Skripsi Program Studi Teknik Informatika Universitas Bhayangkara Jakarta Raya.</h3>
					</div> <!-- /.info-box-content -->
				</div> <!-- /.info-box -->

				<br>

				<div class="box" style="border-radius: none; border-top: none;">
					<div class="box-body">
						<?php $nama = $this->fu->userLogin()['nama_lkp']; ?>
						<h3><i>Hai</i>, <b><?= ucwords($nama) ?></b>, Sebelum memulai ada baiknya anda melihat info terlebih dahulu di sini <a class="fa fa-external-link" href="<?= site_url('info') ?>"></a>
						</h3>
					</div> <!-- /.box-body -->
				</div> <!-- /.box -->

			</div> <!-- /.col-sm-8 -->

			<!-- load rightbar -->
			<?php $this->load->view('template/rightbar'); ?>

		</div><!-- /.row -->

	</section>
	<!-- /.content -->
