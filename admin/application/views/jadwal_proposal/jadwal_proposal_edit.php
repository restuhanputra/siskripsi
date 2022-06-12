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

			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<form action="<?= site_url('jadwal_proposal/detail') ?>" method="post">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button class="btn btn-sm btn-flat btn-warning"> <i class="fa fa-undo"></i> KEMBALI</button>
						</form>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<form class="form" enctype="multipart/form-data" action="" method="post">

						<input type="hidden" name="sdg_proposal_id" value="<?= $g_jdw_ppsal_id['sdg_proposal_id'] ?>">
						<?php
						$smt = $g_jdw_ppsal_id['semester'] == 1 ? "GANJIL" : "GENAP"  ?>
						<div class="form-group row <?= form_error('semester') ? 'has-error' : null ?>">
							<label for="semester" class="col-sm-4 control-label">Semester</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="semester" placeholder="Semester" value="<?= $g_jdw_ppsal_id['tahun'] . ' ' . $smt ?>" readonly>
								<?= form_error('semester') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('npm') ? 'has-error' : null ?>">
							<label for="npm" class="col-sm-4 control-label">NPM</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="npm" placeholder="NPM" value="<?= $g_jdw_ppsal_id['npm'] ?>" readonly>
								<?= form_error('npm') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('nama_lkp') ? 'has-error' : null ?>">
							<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lkp" id="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_jdw_ppsal_id['nama_lkp'] ?>" readonly>
								<?= form_error('nama_lkp') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('judul_proposal') ? 'has-error' : null ?>">
							<label for="judul_proposal" class="col-sm-4 control-label">Judul Proposal</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_proposal" id="judul_proposal" placeholder="Judul Proposal" readonly><?= $g_jdw_ppsal_id['judul_proposal'] ?></textarea>
								<?= form_error('judul_proposal') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('dpj_satu') ? 'has-error' : null ?>">
							<label for="dpj_satu" class="col-sm-4 control-label">Dosen Penguji I</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_jdw_ppsal_id['dpj_satu'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$nama_dsn = strtoupper($data['nama_lkp']);

										if ($g_jdw_ppsal_id['dpj_satu'] == $nidn) {
								?>
											<input type="text" class="form-control" name="dpj_satu" placeholder="Dosen Penguji I" value="<?= $nama_dsn ?>" readonly>
									<?php
										}
									endforeach;
								} else {
									?>
									<input type="text" class="form-control" name="dpj_satu" placeholder="Dosen Penguji I" readonly>
								<?php
								}
								?>
								<?= form_error('dpj_satu') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('dpj_dua') ? 'has-error' : null ?>">
							<label for="dpj_dua" class="col-sm-4 control-label">Dosen Penguji II</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_jdw_ppsal_id['dpj_dua'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$nama_dsn = strtoupper($data['nama_lkp']);

										if ($g_jdw_ppsal_id['dpj_dua'] == $nidn) {
								?>
											<input type="text" class="form-control" name="dpj_dua" placeholder="Dosen Penguji II" value="<?= $nama_dsn ?>" readonly>
									<?php
										}
									endforeach;
								} else {
									?>
									<input type="text" class="form-control" name="dpj_dua" placeholder="Dosen Penguji II" readonly>
								<?php
								}
								?>
								<?= form_error('dpj_dua') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('tanggal_sdg') ? 'has-error' : null ?>">
							<label for="tanggal_sdg" class="col-sm-4 control-label">Tanggal Sidang *</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_jdw_ppsal_id['tanggal_sdg'])) {
								?>
									<input type="text" class="form-control pull-right" name="tanggal_sdg" placeholder="Tanggal Sidang" id="datepicker" value="<?= $g_jdw_ppsal_id['tanggal_sdg'] ?>" autocomplete="off">
								<?php
								} else {
								?>
									<input type="text" class="form-control pull-right" name="tanggal_sdg" placeholder="Tanggal Sidang" id="datepicker" autocomplete="off">
								<?php
								}
								?>
								<?= form_error('tanggal_sdg') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('waktu_id') ? 'has-error' : null ?>">
							<label for="waktu_id" class="col-sm-4 control-label">Waktu *</label>

							<div class="col-sm-8">
								<select class="form-control" name="waktu_id">
									<?php
									if (!empty($g_jdw_ppsal_id['waktu_id'])) {
										foreach ($g_waktu as $data) :
											$waktu_id = $data['waktu_id'];
											$jam      = strtoupper($data['jam']);

											if ($g_jdw_ppsal_id['waktu_id'] == $waktu_id) {
									?>
												<option value="<?= $waktu_id ?>" selected><?= $jam ?></option>
											<?php
											} else {
											?>
												<option value="<?= $waktu_id ?>"><?= $jam ?></option>
											<?php
											}
										endforeach;
									} else {
										echo '<option value=""> -- PILIH --</option>';
										foreach ($g_waktu as $data) :
											$waktu_id = $data['waktu_id'];
											$jam      = strtoupper($data['jam']);
											?>
											<option value="<?= $waktu_id ?>"><?= $jam ?></option>
									<?php
										endforeach;
									}
									?>

								</select>
								<?= form_error('waktu_id') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('ruangan') ? 'has-error' : null ?>">
							<label for="ruangan" class="col-sm-4 control-label">Ruangan *</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_jdw_ppsal_id['ruangan'])) {
								?>
									<input type="text" class="form-control" placeholder="Ruangan" name="ruangan" value="<?= $g_jdw_ppsal_id['ruangan'] ?>">
								<?php
								} else {
								?>
									<input type="text" class="form-control" placeholder="Ruangan" name="ruangan">
								<?php
								}
								?>
								<?= form_error('ruangan') ?>
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
			<div class="box">
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
		// merubah format tanggal datepicker ke dd-mm-yyyy
		format: "dd-mm-yyyy",
		autoclose: true,
	})
</script>
