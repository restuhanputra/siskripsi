<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-8">

			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<form action="<?= site_url('sdg_proposal/data') ?>" method="post">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button class="btn btn-sm btn-flat btn-warning"> <i class="fa fa-undo"></i> KEMBALI</button>
						</form>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<form class="form" enctype="multipart/form-data" action="" method="post">
						<div class="box-body">
							<input type="hidden" name="sdg_proposal_id" value="<?= $g_sdg_ppsal_id['sdg_proposal_id'] ?>">

							<div class="form-group row <?= form_error('tahun') ? 'has-error' : null ?>">
								<label for="tahun" class="col-sm-4 control-label">Tahun Akademik</label>

								<div class="col-sm-8">
									<input type="text" class="form-control" name="tahun" placeholder="Tahun Akademik" value="<?= $g_sdg_ppsal_id['tahun'] ?> <?= $g_sdg_ppsal_id['semester'] != '1' ? 'GENAP' : 'GANJIL' ?>" readonly>
									<?= form_error('tahun') ?>
								</div>
							</div>

							<div class="form-group row <?= form_error('nama_lkp') ? 'has-error' : null ?>">
								<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

								<div class="col-sm-8">
									<input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_sdg_ppsal_id['nama_lkp'] ?>" readonly>
									<?= form_error('nama_lkp') ?>
								</div>
							</div>
							<div class="form-group row <?= form_error('npm') ? 'has-error' : null ?>">
								<label for="npm" class="col-sm-4 control-label">NPM</label>

								<div class="col-sm-8">
									<input type="number" class="form-control" name="npm" placeholder="NPM" value="<?= $g_sdg_ppsal_id['npm'] ?>" readonly>
									<?= form_error('npm') ?>
								</div>
							</div>
							<div class="form-group row <?= form_error('prodi') ? 'has-error' : null ?>">
								<label for="prodi" class="col-sm-4 control-label">Program Studi</label>

								<div class="col-sm-8">
									<input type="text" class="form-control" name="prodi" placeholder="Program Studi" value="<?= $g_sdg_ppsal_id['prodi_nama'] ?>" readonly>
									<?= form_error('prodi') ?>
								</div>
							</div>
							<div class="form-group row <?= form_error('no_telp') ? 'has-error' : null ?>">
								<label for="no_telp" class="col-sm-4 control-label">No. Telp</label>

								<div class="col-sm-8">
									<input type="number" class="form-control" name="no_telp" placeholder="No. Telp" value="<?= $g_sdg_ppsal_id['no_telp'] ?>" readonly>
									<?= form_error('no_telp') ?>
								</div>
							</div>
							<div class="form-group row <?= form_error('email') ? 'has-error' : null ?>">
								<label for="email" class="col-sm-4 control-label">E-mail</label>

								<div class="col-sm-8">
									<input type="email" class="form-control" name="email" placeholder="E-mail" value="<?= $g_sdg_ppsal_id['email'] ?>" readonly>
									<?= form_error('email') ?>
								</div>
							</div>
							<div class="form-group row <?= form_error('judul_proposal') ? 'has-error' : null ?>">
								<label for="judul_proposal" class="col-sm-4 control-label">Judul Proposal Skripsi</label>

								<div class="col-sm-8">
									<textarea class="form-control" rows="5" name="judul_proposal" placeholder="Judul Proposal Skripsi" readonly><?= $g_sdg_ppsal_id['judul_proposal'] ?></textarea>
									<?= form_error('judul_proposal') ?>
								</div>
							</div>

							<div class="form-group row <?= form_error('status') ? 'has-error' : null ?>">
								<label for="status" class="col-sm-4 control-label">Status *</label>

								<div class="col-sm-8">
									<select class="form-control" name="status">
										<?php
										if (($g_sdg_ppsal_id['status'] == 1)) {
										?>
											<option value="<?= $g_sdg_ppsal_id['status'] ?>" selected>TIDAK LAYAK</option>
											<option value="2">LAYAK</option>
										<?php
										} elseif (($g_sdg_ppsal_id['status'] == 2)) {
										?>
											<option value="1">TIDAK LAYAK</option>
											<option value="<?= $g_sdg_ppsal_id['status'] ?>" selected>LAYAK</option>
										<?php
										} else {
										?>
											<option value=""> -- PILIH --</option>
											<option value="1">TIDAK LAYAK</option>
											<option value="2">LAYAK</option>
										<?php
										}
										?>
									</select>
									<?= form_error('status') ?>
								</div>
							</div>

						</div> <!-- /.box-body -->

						<div class="box-footer text-center">
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
							&nbsp;
							<button type="submit" name="edit" class="btn btn-flat btn-success"><i class='fa fa-paper-plane'></i> EDIT</button>
						</div> <!-- /.box-footer -->
					</form> <!-- /.form -->
				</div> <!-- /. box-body -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-8 -->

		<div class="col-xs-4">

			<div class="box">
				<div class="box-header with-border">
					<i class="fa fa-bullhorn"></i>
					<h3 class="box-title text-bold">CATATAN</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<ol style="padding-inline-start: 20px !important;">
						<li>Setiap field yang bertanda <b>*</b> wajib diisi.</li>
						<li>Data bedasarkan form sidang proposal skripsi yang sudah diinput oleh mahasiswa</li>
						<li>Jika ada kesalahan tekan button revisi.</li>
					</ol>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-xs-4 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->

<script>
	$(function() {
		$('#mytable').DataTable({
			"paging": true,
			"lengthChange": true,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": true
		});
	});
</script>
