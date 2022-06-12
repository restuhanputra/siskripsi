<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">
			<!-- Alert -->
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title'>
						<form action="<?= site_url('jadwal_skripsi/laporan') ?>" method="post" target="_blank">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button onclick="return confirm('Print data, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-success"> <i class="fa fa-print"></i> PRINT</button>
						</form>
					</h3>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('jadwal_skripsi') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> KEMBALI</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center" style="width:1%;">No</th>
									<th class="text-center">Semester</th>
									<th class="text-center">NPM</th>
									<th class="text-center">Nama Lengkap</th>
									<th class="text-center">Judul</th>
									<th class="text-center">Dosen Penguji I</th>
									<th class="text-center">Dosen Penguji II</th>
									<th class="text-center">Dosen Penguji III</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">Waktu</th>
									<th class="text-center">Ruangan</th>
									<th class="text-center">Edit</th>
									<!-- <th class="text-center">Delete</th> -->
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_jdw_skripsi)) {
									$no = 1;
									foreach ($g_jdw_skripsi as $data) :
										$sdg_skripsi_id = $data['sdg_skripsi_id'];
										$thn_akdmk_id   = $data['tahun_akademik_id'];
										$waktu_id       = $data['waktu_id'];
										$semester       = $data['semester'];
										$tahun          = $data['tahun'];
										$npm            = $data['npm'];
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$dpj_satu       = $data['dpj_satu'];
										$dpj_dua        = $data['dpj_dua'];
										$dpj_tiga       = $data['dpj_tiga'];
										$judul_skripsi  = $data['judul_skripsi'];
										$tanggal_sdg    = $data['tanggal_sdg'];
										$ruangan        = $data['ruangan'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<?php $smt = $semester == 1 ? "GANJIL" : "GENAP"  ?>
											<td>
												<?= $tahun . ' ' . $smt ?>
											</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td><?= $judul_skripsi ?></td>
											<td>
												<?php
												if (!empty($dpj_satu)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = $data['nama_lkp'];

														if ($dpj_satu == $nidn) {
															echo $nama_dsn;
														}
													endforeach;
												} else {
												?>
													<b><span class="label label-danger">BLM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td>
												<?php
												if (!empty($dpj_dua)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = $data['nama_lkp'];

														if ($dpj_dua == $nidn) {
															echo $nama_dsn;
														}
													endforeach;
												} else {
												?>
													<b><span class="label label-danger">BLM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td>
												<?php
												if (!empty($dpj_tiga)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = $data['nama_lkp'];

														if ($dpj_tiga == $nidn) {
															echo $nama_dsn;
														}
													endforeach;
												} else {
												?>
													<b><span class="label label-danger">BLM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td><?= $tanggal_sdg != null ? $tanggal_sdg : '<b><span class="label label-danger">BLM DITENTUKKAN</span></b>' ?></td>
											<td>
												<?php
												if (!empty($waktu_id)) {
													foreach ($g_waktu as $data) :
														$id_waktu = $data['waktu_id'];
														$jam      = $data['jam'];

														if ($waktu_id == $id_waktu) {
															echo $jam;
														}
													endforeach;
												} else {
												?>
													<b><span class="label label-danger">BLM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td><?= $ruangan != null ? $ruangan : '<b><span class="label label-danger">BLM DITENTUKKAN</span></b>' ?></td>
											<td class="text-center">
												<form action="<?= site_url('jadwal_skripsi/edit') ?>" method="post">
													<input type="hidden" name="sdg_skripsi_id" value="<?= $sdg_skripsi_id ?>">
													<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i></button>
												</form>
											</td>
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
