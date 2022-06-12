<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">

			<div class="box" style="border-radius: none; border-top: none;">

				<div class='box-header with-border'>
					<div class="text-center">
						<h3 class='box-title text-bold'><?= $title ?></h3>
					</div>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center" style="width:1%;">No</th>
									<th class="text-center">NPM</th>
									<th class="text-center">Nama Mahasiswa</th>
									<th class="text-center">No. Telp</th>
									<th class="text-center">Judul Skripsi</th>
									<th class="text-center">Dosen Penguji I</th>
									<th class="text-center">Dosen Penguji II</th>
									<th class="text-center">Dosen Penguji III</th>
									<th class="text-center">Tanggal Sidang</th>
									<th class="text-center">Waktu</th>
									<th class="text-center">Ruangan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_jdw_sdg_skripsi)) {
									$no = 1;
									foreach ($g_jdw_sdg_skripsi as $data) :
										$npm            = $data['npm'];
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$no_telp        = $data['no_telp'];
										$judul_skripsi  = $data['judul_skripsi'];
										$waktu          = $data['waktu_id'];
										$dpj_satu       = $data['dpj_satu'];
										$dpj_dua        = $data['dpj_dua'];
										$dpj_tiga       = $data['dpj_tiga'];
										$tanggal_sdg    = $data['tanggal_sdg'];
										$ruangan        = $data['ruangan'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td class="text-center"><?= $no_telp ?></td>
											<td class="text-center"><?= $judul_skripsi ?></td>
											<td class="text-center">
												<?php
												if (!empty($dpj_satu)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = strtoupper($data['nama_lkp']);

														if ($dpj_satu == $nidn) {
												?>
															<?= $nama_dsn ?>
													<?php
														}
													endforeach;
												} else {
													?>
													<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td class="text-center">
												<?php
												if (!empty($dpj_dua)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = strtoupper($data['nama_lkp']);

														if ($dpj_dua == $nidn) {
												?>
															<?= $nama_dsn ?>
													<?php
														}
													endforeach;
												} else {
													?>
													<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td class="text-center">
												<?php
												if (!empty($dpj_tiga)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = strtoupper($data['nama_lkp']);

														if ($dpj_tiga == $nidn) {
												?>
															<?= $nama_dsn ?>
													<?php
														}
													endforeach;
												} else {
													?>
													<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td class="text-center"><?= $tanggal_sdg != null ?  $tanggal_sdg : '<b> <span class="label label-danger">BELUM DITENTUKKAN</span></b>' ?></td>
											<td class="text-center">
												<?php
												if (!empty($waktu)) {
													foreach ($g_waktu as $data) :
														$waktu_id = $data['waktu_id'];
														$jam      = strtoupper($data['jam']);

														if ($waktu == $waktu_id) {
															echo $jam;
														}
													endforeach;
												} else {
												?>
													<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td class="text-center"><?= $ruangan != null ?  $ruangan : '<b> <span class="label label-danger">BELUM DITENTUKKAN</span></b>' ?></td>
										</tr>
										<!-- /. Isi Tabel -->
								<?php
									endforeach;
								} else {
									NULL;
								}
								?>

							</tbody>
						</table>
					</div>
				</div> <!-- /. box-body -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->

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
