<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">

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
					<!-- Custom Tabs -->
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active text-bold"><a href="#tab_1" data-toggle="tab">DATA SIDANG PROPOSAL SKRIPSI</a></li>
							<li class="text-bold"><a href="#tab_2" data-toggle="tab">JADWAL & HASIL SIDANG PROPOSAL SKRIPSI</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">

								<div class="col-xs-12">
									<table class="table table-responsive table-striped table-hover">
										<tr>
											<td class="text-bold" width="200">Tahun Akademik</td>
											<td><b>:</b> <?= $g_sdg_ppsal_id['tahun'] ?> (<?= $g_sdg_ppsal_id['semester'] != 1 ? 'GENAP' : 'GANJIL' ?>)</td>
										</tr>
										<tr>
											<td class="text-bold">Nama Lengkap</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['nama_lkp'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">NPM</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['npm'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">Prodi</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['prodi_nama'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">No. Telepon</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['no_telp'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">Email</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['email'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">Dosen Pembimbing</td>
											<?php
											if (!empty($g_bbg_id['pbb_satu'])) {
												foreach ($g_dosen as $data) :
													$nidn     = $data['nidn'];
													$nama_dsn = strtoupper($data['nama_lkp']);

													if ($g_bbg_id['pbb_satu'] == $nidn) {
											?>
														<td> <b>:</b> <?= $nama_dsn ?> </td>
												<?php
													}
												endforeach;
											} else {
												?>
												<td> <b>: <span class="label label-danger">BELUM DITENTUKKAN</span></b> </td>
											<?php
											}
											?>
										</tr>
										<tr>
											<td class="text-bold">Judul Proposal Skripsi</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['judul_proposal'] ?></td>
										</tr>
									</table>
								</div><!-- /.col-xs-12-->
							</div><!-- /.tab-pane -->
							<div class="tab-pane" id="tab_2">

								<div class="col-xs-12">
									<table class="table table-responsive table-striped table-hover">
										<tr>
											<td class="text-bold" width="200">Tahun Akademik</td>
											<td><b>:</b> <?= $g_sdg_ppsal_id['tahun'] ?> (<?= $g_sdg_ppsal_id['semester'] != 1 ? 'GENAP' : 'GANJIL' ?>)</td>
										</tr>
										<tr>
											<td class="text-bold">Nama Lengkap</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['nama_lkp'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">NPM</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['npm'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">Prodi</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['prodi_nama'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">Judul Proposal Skripsi</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['judul_proposal'] ?></td>
										</tr>
										<tr>
											<td class="text-bold">Penguji I</td>
											<?php
											if (!empty($g_sdg_ppsal_id['dpj_satu'])) {
												foreach ($g_dosen as $data) :
													$nidn     = $data['nidn'];
													$nama_dsn = strtoupper($data['nama_lkp']);

													if ($g_sdg_ppsal_id['dpj_satu'] == $nidn) {
											?>
														<td> <b>:</b> <?= $nama_dsn ?> </td>
												<?php
													}
												endforeach;
											} else {
												?>
												<td> <b>: <span class="label label-danger">BELUM DITENTUKKAN</span></b> </td>
											<?php
											}
											?>
										</tr>
										<tr>
											<td class="text-bold">Penguji II</td>
											<?php
											if (!empty($g_sdg_ppsal_id['dpj_dua'])) {
												foreach ($g_dosen as $data) :
													$nidn     = $data['nidn'];
													$nama_dsn = strtoupper($data['nama_lkp']);

													if ($g_sdg_ppsal_id['dpj_dua'] == $nidn) {
											?>
														<td> <b>:</b> <?= $nama_dsn ?> </td>
												<?php
													}
												endforeach;
											} else {
												?>
												<td> <b>: <span class="label label-danger">BELUM DITENTUKKAN</span></b> </td>
											<?php
											}
											?>
										</tr>
										<tr>
											<td class="text-bold">Tanggal</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['tanggal_sdg'] != null ? $g_sdg_ppsal_id['tanggal_sdg'] : '<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>' ?></td>
										</tr>
										<tr>
											<td class="text-bold">Waktu</td>
											<?php
											if (!empty($g_sdg_ppsal_id['waktu_id'])) {
												foreach ($g_waktu as $data) :
													$waktu_id = $data['waktu_id'];
													$jam      = strtoupper($data['jam']);

													if ($g_sdg_ppsal_id['waktu_id'] == $waktu_id) {
											?>
														<td> <b>:</b> <?= $jam ?> </td>
												<?php
													}
												endforeach;
											} else {
												?>
												<td> <b>: <span class="label label-danger">BELUM DITENTUKKAN</span></b> </td>
											<?php
											}
											?>
										</tr>
										<tr>
											<td class="text-bold">Ruangan</td>
											<td> <b>:</b> <?= $g_sdg_ppsal_id['ruangan'] != null ? $g_sdg_ppsal_id['ruangan'] : '<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>' ?></td>
										</tr>
										<tr>
											<td class="text-bold">Hasil</td>
											<td> <b>:</b>
												<?php
												if ($g_sdg_ppsal_id['status'] == 1) {
													echo '<b><span class="label label-danger">TIDAK LAYAK</span></b>';
												} elseif ($g_sdg_ppsal_id['status'] == 2) {
													echo '<b><span class="label label-success">LAYAK</span></b>';
												} else {
													echo '<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>';
												}
												?>
											</td>
										</tr>
									</table>
								</div><!-- /.col-xs-12-->
							</div><!-- /.tab-pane -->
						</div><!-- /.tab-content -->
					</div><!-- nav-tabs-custom -->

				</div> <!-- /. box-body -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
