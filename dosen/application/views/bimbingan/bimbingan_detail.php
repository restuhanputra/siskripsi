<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-sm-8">

			<div class="box" style="border-radius: none; border-top: none;">
				<div class='box-header with-border'>
					<h3 class='box-title text-bold'><?= $title ?></h3>
					<div class="pull-right">
						<a href="<?= site_url('bimbingan') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> Kembali</a>
					</div>
				</div><!-- /.box-header -->

				<div class="box-body">
					<form class="form">
						<!-- <div class="col-sm-8"> -->

						<div class="form-group row">
							<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_bbg_id['nama_lkp'] ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="npm" class="col-sm-4 control-label">NPM</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="npm" placeholder="NPM" value="<?= $g_bbg_id['npm']  ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="kelas" class="col-sm-4 control-label">Kelas</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="kelas" placeholder="Kelas" value="<?= $g_bbg_id['kelas']  ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="kelas" class="col-sm-4 control-label">No. Telp</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="no_telp" placeholder="No. Telp" value="<?= $g_bbg_id['no_telp']  ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="judul_skripsi" class="col-sm-4 control-label">Judul Skripsi</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_skripsi" placeholder="Judul Skripsi" readonly><?= $g_bbg_id['judul_proposal']  ?></textarea>
							</div>
						</div>

						<div class="form-group row">
							<label for="status" class="col-sm-4 control-label">Hasil Sidang Proposal</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_bbg_sdg_ppsal_id['status_sdg_proposal'])) {
									if ($g_bbg_sdg_ppsal_id['status_sdg_proposal'] == 1) {
										$status_sdg_proposal = "TIDAK LAYAK";
									} elseif ($g_bbg_sdg_ppsal_id['status_sdg_proposal'] == 2) {
										$status_sdg_proposal = "LAYAK";
									} else {
										$status_sdg_proposal = "BELUM DITENTUKKAN";
									}
								} else {
									$status_sdg_proposal = NULL;
								}
								?>
								<input type="text" class="form-control" name="status" placeholder="Hasil Sidang Proposal" value="<?= $status_sdg_proposal ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="status" class="col-sm-4 control-label">Hasil Sidang Skripsi</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_bbg_sdg_skripsi_id['status_sdg_skripsi'])) {
									if ($g_bbg_sdg_skripsi_id['status_sdg_skripsi'] == 1) {
										$status_sdg_skripsi = "TIDAK LULUS SIDANG SKRIPSI";
									} elseif ($g_bbg_sdg_skripsi_id['status_sdg_skripsi'] == 2) {
										$status_sdg_skripsi = "REVISI LAPORAN SKRIPSI";
									} elseif ($g_bbg_sdg_skripsi_id['status_sdg_skripsi'] == 3) {
										$status_sdg_skripsi = "LULUS SIDANG SKRIPSI";
									} else {
										$status_sdg_skripsi = 'BELUM DITENTUKKAN';
									}
								} else {
									$status_sdg_skripsi = NULL;
								}
								?>
								<input type="text" class="form-control" name="status" placeholder="Hasil Sidang Skripsi" value="<?= $status_sdg_skripsi ?>" readonly>
							</div>
						</div>

					</form>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-sm-8 -->

		<div class="col-sm-4">
			<div class="box" style="border-radius: none; border-top: none;">
				<div class="box-header with-border">
					<i class="fa fa-bullhorn"></i>
					<h3 class="box-title text-bold">CATATAN</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<ul class="info news-items" style="padding-inline-start: 5px;">
						<div class="news-item-detail">
							<p class="news-item-preview">Jika Hasil dari Sidang Proposal ditolak atau Sidang Skripsi tidak lulus Dosen berhak melakukan selesai bimbingan. </p>
						</div>
					</ul>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->
		</div> <!-- /.col-sm-4 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
