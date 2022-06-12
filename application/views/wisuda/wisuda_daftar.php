<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-8">
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg'); // First normal call
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box" style="border-radius: none; border-top: none;">

				<div class='box-header with-border'>
					<h3 class='box-title'>
						<b><?= $title ?></b>
					</h3>

					<h3 class='box-title pull-right'>
						<a href="<?= site_url('wisuda') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> KEMBALI</a>
				</div><!-- /.box-header -->

				<form class="form" enctype="multipart/form-data" action="" method="post">
					<div class="box-body">
						<input type="hidden" name="proposal_id" value="<?= $g_sdg_skripsi_id['proposal_id']  ?>">
						<input type="hidden" name="sdg_skripsi_id" value="<?= $g_sdg_skripsi_id['sdg_skripsi_id']  ?>">
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
								<input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_sdg_skripsi_id['nama_lkp'] ?>" readonly>
								<?= form_error('nama_lkp') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('npm') ? 'has-error' : null ?>">
							<label for="npm" class="col-sm-4 control-label">NPM</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="npm" placeholder="NPM" value="<?= $g_sdg_skripsi_id['npm'] ?>" readonly>
								<?= form_error('npm') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('prodi') ? 'has-error' : null ?>">
							<label for="prodi" class="col-sm-4 control-label">Program Studi</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="prodi" placeholder="Program Studi" value="<?= $g_sdg_skripsi_id['prodi_nama'] ?>" readonly>
								<?= form_error('prodi') ?>

								<input type="hidden" name="prodi_id" value="<?= $g_sdg_skripsi_id['prodi_id'] ?>">
							</div>
						</div>
						<div class="form-group row <?= form_error('nik') ? 'has-error' : null ?>">
							<label for="nik" class="col-sm-4 control-label">NIK *</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="nik" placeholder="Nomor Induk Kependudukan">
								<?= form_error('nik') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('sma_smk') ? 'has-error' : null ?>">
							<label for="sma_smk" class="col-sm-4 control-label">Asal SMA/SMK *</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="sma_smk" placeholder="Asal SMA/SMK">
								<?= form_error('sma_smk') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('lulus_sma_smk') ? 'has-error' : null ?>">
							<label for="lulus_sma_smk" class="col-sm-4 control-label">Tahun Lulus SMA/SMK *</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="lulus_sma_smk" placeholder="Tahun Lulus SMA/SMK">
								<?= form_error('lulus_sma_smk') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('tgl_lahir') ? 'has-error' : null ?>">
							<label for="tgl_lahir" class="col-sm-4 control-label">Tanggal Lahir *</label>

							<div class="col-sm-8">
								<input type="text" class="form-control pull-right" name="tgl_lahir" placeholder="Tanggal Lahir" id="datepicker" autocomplete="off" value="<?= $g_sdg_skripsi_id['tgl_lahir'] ?>">
								<?= form_error('tgl_lahir') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('alamat') ? 'has-error' : null ?>">
							<label for="alamat" class="col-sm-4 control-label">Alamat Lengkap *</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="alamat" placeholder="Alamat Lengkap"></textarea>
								<?= form_error('alamat') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('no_telp') ? 'has-error' : null ?>">
							<label for="no_telp" class="col-sm-4 control-label">No. Telp *</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="no_telp" placeholder="No. Telp" value="<?= $g_sdg_skripsi_id['no_telp'] ?>">
								<?= form_error('no_telp') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('email') ? 'has-error' : null ?>">
							<label for="email" class="col-sm-4 control-label">E-mail *</label>

							<div class="col-sm-8">
								<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $g_sdg_skripsi_id['email'] ?>">
								<?= form_error('email') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('nama_ayah') ? 'has-error' : null ?>">
							<label for="nama_ayah" class="col-sm-4 control-label">Nama Ayah *</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_ayah" placeholder="Nama Ayah" value="<?= $g_sdg_skripsi_id['nama_ayah'] ?>">
								<?= form_error('nama_ayah') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('nama_ibu') ? 'has-error' : null ?>">
							<label for="nama_ibu" class="col-sm-4 control-label">Nama Ibu *</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_ibu" placeholder="Nama Ibu" value="<?= $g_sdg_skripsi_id['nama_ibu'] ?>">
								<?= form_error('nama_ibu') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('tanggal_sdg') ? 'has-error' : null ?>">
							<label for="tanggal_sdg" class="col-sm-4 control-label">Tanggal Sidang</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="tanggal_sdg" placeholder="Tanggal Sidang" value="<?= $g_sdg_skripsi_id['tanggal_sdg'] ?>" readonly>
								<?= form_error('tanggal_sdg') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('judul_skripsi_ina') ? 'has-error' : null ?>">
							<label for="judul_skripsi" class="col-sm-4 control-label">Judul Skripsi (B. Indonesia) *</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_skripsi_ina" placeholder="Judul Skripsi (B. Indonesia)"><?= $g_sdg_skripsi_id['judul_skripsi'] ?></textarea>
								<?= form_error('judul_skripsi_ina') ?>
							</div>
						</div>
						<div class="form-group row <?= form_error('judul_skripsi_eng') ? 'has-error' : null ?>">
							<label for="judul_skripsi_eng" class="col-sm-4 control-label">Judul Skripsi (B. Inggris) *</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_skripsi_eng" placeholder="Judul Skripsi (B. Inggris)"></textarea>
								<?= form_error('judul_skripsi_eng') ?>
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

<script>
	//Date picker
	$('#datepicker').datepicker({
		// merubah format tanggal datepicker ke dd-mm-yyyy
		format: "dd-mm-yyyy",
		autoclose: true
	})
</script>
