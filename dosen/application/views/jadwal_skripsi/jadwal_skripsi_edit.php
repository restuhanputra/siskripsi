<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-sm-8">
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box" style="border-radius: none; border-top: none;">

				<div class='box-header with-border'>
					<h3 class='box-title text-bold'>
						<?= $title ?>
					</h3>

					<h3 class='box-title pull-right'>
						<form action="<?= site_url('jadwal_skripsi/detail') ?>" method="post">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button class="btn btn-sm btn-flat btn-warning"> <i class="fa fa-undo"></i> KEMBALI</button>
						</form>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<form class="form" enctype="multipart/form-data" action="" method="post">

						<input type="hidden" name="sdg_skripsi_id" value="<?= $g_sdg_skripsi_id['sdg_skripsi_id'] ?>">
						<?php
						$smt = $g_sdg_skripsi_id['semester'] == 1 ? "GANJIL" : "GENAP"  ?>
						<div class="form-group row <?= form_error('semester') ? 'has-error' : null ?>">
							<label for="semester" class="col-sm-4 control-label">Semester</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="semester" placeholder="Semester" value="<?= $g_sdg_skripsi_id['tahun'] . ' ' . $smt ?>" readonly>
								<?= form_error('semester') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('npm') ? 'has-error' : null ?>">
							<label for="npm" class="col-sm-4 control-label">NPM</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="npm" placeholder="NPM" value="<?= $g_sdg_skripsi_id['npm'] ?>" readonly>
								<?= form_error('npm') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('nama_lkp') ? 'has-error' : null ?>">
							<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lkp" id="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_sdg_skripsi_id['nama_lkp'] ?>" readonly>
								<?= form_error('nama_lkp') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('judul_skripsi') ? 'has-error' : null ?>">
							<label for="judul_skripsi" class="col-sm-4 control-label">Judul Skripsi</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_skripsi" id="judul_skripsi" placeholder="Judul Skripsi" readonly><?= $g_sdg_skripsi_id['judul_skripsi'] ?></textarea>
								<?= form_error('judul_skripsi') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('dpj_satu') ? 'has-error' : null ?>">
							<label for="dpj_satu" class="col-sm-4 control-label">Dosen Penguji I *</label>

							<div class="col-sm-8">
								<select class="form-control" name="dpj_satu">
									<?php
									if (!empty($g_sdg_skripsi_id['dpj_satu'])) {
										foreach ($g_dosen as $data) :
											$nidn     = $data['nidn'];
											$nama_dsn = strtoupper($data['nama_lkp']);

											if ($g_sdg_skripsi_id['dpj_satu'] == $nidn) {
									?>
												<option value="<?= $nidn ?>" selected><?= $nama_dsn ?></option>
											<?php
											} else {
											?>
												<option value="<?= $nidn ?>"><?= $nama_dsn ?></option>
											<?php
											}
										endforeach;
									} else {
										echo '<option value=""> -- PILIH --</option>';
										foreach ($g_dosen as $data) :
											$nidn     = $data['nidn'];
											$nama_dsn = strtoupper($data['nama_lkp']);
											?>
											<option value="<?= $nidn ?>"><?= $nama_dsn ?></option>
									<?php
										endforeach;
									}
									?>
								</select>
								<?= form_error('dpj_satu') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('dpj_dua') ? 'has-error' : null ?>">
							<label for="dpj_dua" class="col-sm-4 control-label">Dosen Penguji II *</label>

							<div class="col-sm-8">
								<select class="form-control" name="dpj_dua">
									<?php
									if (!empty($g_sdg_skripsi_id['dpj_dua'])) {
										foreach ($g_dosen as $data) :
											$nidn     = $data['nidn'];
											$nama_dsn = strtoupper($data['nama_lkp']);

											if ($g_sdg_skripsi_id['dpj_dua'] == $nidn) {
									?>
												<option value="<?= $nidn ?>" selected><?= $nama_dsn ?></option>
											<?php
											} else {
											?>
												<option value="<?= $nidn ?>"><?= $nama_dsn ?></option>
											<?php
											}
										endforeach;
									} else {
										echo '<option value=""> -- PILIH --</option>';
										foreach ($g_dosen as $data) :
											$nidn     = $data['nidn'];
											$nama_dsn = strtoupper($data['nama_lkp']);
											?>
											<option value="<?= $nidn ?>"><?= $nama_dsn ?></option>
									<?php
										endforeach;
									}
									?>
								</select>
								<?= form_error('dpj_dua') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('dpj_tiga') ? 'has-error' : null ?>">
							<label for="dpj_tiga" class="col-sm-4 control-label">Dosen Penguji III *</label>

							<div class="col-sm-8">
								<select class="form-control" name="dpj_tiga">
									<?php
									if (!empty($g_sdg_skripsi_id['dpj_tiga'])) {
										foreach ($g_dosen as $data) :
											$nidn     = $data['nidn'];
											$nama_dsn = strtoupper($data['nama_lkp']);

											if ($g_sdg_skripsi_id['dpj_tiga'] == $nidn) {
									?>
												<option value="<?= $nidn ?>" selected><?= $nama_dsn ?></option>
											<?php
											} else {
											?>
												<option value="<?= $nidn ?>"><?= $nama_dsn ?></option>
											<?php
											}
										endforeach;
									} else {
										echo '<option value=""> -- PILIH --</option>';
										foreach ($g_dosen as $data) :
											$nidn     = $data['nidn'];
											$nama_dsn = strtoupper($data['nama_lkp']);
											?>
											<option value="<?= $nidn ?>"><?= $nama_dsn ?></option>
									<?php
										endforeach;
									}
									?>
								</select>
								<?= form_error('dpj_tiga') ?>
							</div>
						</div>

						<div class="box-footer text-center">
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
							&nbsp;
							<button type="submit" name="edit" class="btn btn-flat btn-success"><i class='fa fa-paper-plane'></i> Edit</button>
						</div> <!-- /.box-footer -->
					</form>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-md-3 -->

		<div class="col-sm-4">
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
		</div> <!-- /.col-sm-4 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->

<script>
	//Date picker
	$('#datepicker').datepicker({
		autoclose: true
	})
</script>
