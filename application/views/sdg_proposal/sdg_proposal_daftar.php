<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-8">
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box" style="border-radius: none; border-top: none;">

				<div class='box-header with-border'>
					<h3 class='box-title'>
						<b><?= $title ?></b>
					</h3>

					<h3 class='box-title pull-right'>
						<a href="<?= site_url('sdg_proposal') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> KEMBALI</a>
						<h3>
				</div><!-- /.box-header -->

				<form class="form" enctype="multipart/form-data" action="" method="post">
					<div class="box-body">
						<input type="hidden" name="proposal_id" value="<?= $g_ppsal_id['proposal_id'] ?>">

						<input type="hidden" name="thn_akdmk_id" value="<?= $g_thn_akdmk['tahun_akademik_id'] ?>">

						<div class="form-group row <?= form_error('tahun') ? 'has-error' : null ?>">
							<label for="tahun" class="col-sm-4 control-label">Tahun Akademik</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="tahun" placeholder="Tahun Akademik" value="<?= $g_thn_akdmk['tahun'] ?> <?= $g_thn_akdmk['semester'] != '1' ? 'GENAP' : 'GANJIL' ?>" readonly>
								<?= form_error('tahun') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('nama_lkp') ? 'has-error' : null ?>">
							<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_ppsal_id['nama_lkp'] ?>" readonly>
								<?= form_error('nama_lkp') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('npm') ? 'has-error' : null ?>">
							<label for="npm" class="col-sm-4 control-label">NPM</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="npm" placeholder="NPM" value="<?= $g_ppsal_id['npm'] ?>" readonly>
								<?= form_error('npm') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('prodi') ? 'has-error' : null ?>">
							<label for="prodi" class="col-sm-4 control-label">Program Studi</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="prodi" placeholder="Program Studi" value="<?= $g_ppsal_id['prodi_nama'] ?>" readonly>
								<?= form_error('prodi') ?>

								<input type="hidden" name="prodi_id" value="<?= $g_ppsal_id['prodi_id'] ?>">
							</div>
						</div>
						<div class="form-group row <?= form_error('no_telp') ? 'has-error' : null ?>">
							<label for="no_telp" class="col-sm-4 control-label">No. Telp *</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="no_telp" placeholder="No. Telp" value="<?= $g_ppsal_id['no_telp'] ?>">
								<?= form_error('no_telp') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('email') ? 'has-error' : null ?>">
							<label for="email" class="col-sm-4 control-label">E-mail *</label>

							<div class="col-sm-8">
								<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $g_ppsal_id['email'] ?>">
								<?= form_error('email') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('judul_proposal') ? 'has-error' : null ?>">
							<label for="judul_proposal" class="col-sm-4 control-label">Judul Proposal Skripsi *</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_proposal" placeholder="Judul Proposal Skripsi"><?= $g_ppsal_id['judul_proposal'] ?></textarea>
								<?= form_error('judul_proposal') ?>
							</div>
						</div>

					</div> <!-- /.box-body -->

					<div class="box-footer text-center">
						<button type="reset" class="btn btn-flat btn-default">Reset</button>
						&nbsp;
						<button type="submit" name="daftar" class="btn btn-flat btn-success"><i class='fa fa-paper-plane'></i> Daftar</button>
					</div> <!-- /.box-footer -->
				</form> <!-- /.form -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-8 -->

		<div class="col-xs-4">

			<div class="box" style="border-radius: none; border-top: none;">
				<div class="box-header with-border">
					<i class="fa fa-bullhorn"></i>
					<h3 class="box-title text-bold">CATATAN</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<ol style="padding-inline-start: 20px !important;">
						<li>Setiap field yang bertanda <b>*</b> wajib diisi.</li>
					</ol>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-xs-4 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
