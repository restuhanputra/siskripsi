<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-sm-12">
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<form action="<?= site_url('bimbingan/data') ?>" method="post">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button class="btn btn-sm btn-flat btn-warning"> <i class="fa fa-undo"></i> KEMBALI</button>
						</form>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<form class="form" enctype="multipart/form-data" action="" method="post">

						<?php
						$smt = $g_bbg_id['semester'] == 1 ? "GANJIL" : "GENAP"  ?>
						<div class="form-group row">
							<label for="semester" class="col-sm-4 control-label">Semester</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="semester" placeholder="Semester" value="<?= $g_bbg_id['tahun'] . ' ' . $smt ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="npm" class="col-sm-4 control-label">NPM</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="npm" placeholder="NPM" value="<?= $g_bbg_id['npm'] ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lkp" id="nama_lkp" placeholder="Nama Lengkap" value="<?= $g_bbg_id['nama_lkp'] ?>" readonly>
							</div>
						</div>

						<div class="form-group row">
							<label for="judul_proposal" class="col-sm-4 control-label">Judul Proposal</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="judul_proposal" id="judul_proposal" placeholder="Judul Proposal" readonly><?= $g_bbg_id['judul_proposal'] ?></textarea>
							</div>
						</div>

						<div class="form-group row">
							<label for="pbb_satu" class="col-sm-4 control-label">Dosen Pembimbing I</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_bbg_id['pbb_satu'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$nama_dsn = strtoupper($data['nama_lkp']);

										if ($g_bbg_id['pbb_satu'] == $nidn) {
								?>
											<input type="text" class="form-control" name="pbb_satu" placeholder="Dosen Pembimbing I" value="<?= $nama_dsn ?>" readonly>
									<?php
										}
									endforeach;
								} else {
									?>
									<input type="text" class="form-control" name="pbb_satu" placeholder="Dosen Pembimbing I" readonly>
								<?php
								}
								?>
							</div>
						</div>

						<div class="form-group row <?= form_error('pbb_dua') ? 'has-error' : null ?>">
							<label for="pbb_dua" class="col-sm-4 control-label">Dosen Pembimbing II</label>

							<div class="col-sm-8">
								<?php
								if (!empty($g_bbg_id['pbb_dua'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$nama_dsn = strtoupper($data['nama_lkp']);

										if ($g_bbg_id['pbb_dua'] == $nidn) {
								?>
											<input type="text" class="form-control" name="pbb_dua" placeholder="Dosen Pembimbing II" value="<?= $nama_dsn ?>" readonly>
									<?php
										}
									endforeach;
								} else {
									?>
									<input type="text" class="form-control" name="pbb_dua" placeholder="Dosen Pembimbing II" readonly>
								<?php
								}
								?>
								<?= form_error('pbb_dua') ?>
							</div>
						</div>

					</form>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-sm-12 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
