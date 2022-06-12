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
						<form action="<?= site_url('bimbingan/laporan') ?>" method="post" target="_blank">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button onclick="return confirm('Print data, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-success"> <i class="fa fa-print"></i> PRINT</button>
						</form>
					</h3>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('bimbingan') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> KEMBALI</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center" style="width:1%;">No</th>
									<th class="text-center">NPM</th>
									<th class="text-center">Nama Mahasiswa</th>
									<th class="text-center">Pembimbing I</th>
									<th class="text-center">Pembimbing II</th>
									<th class="text-center">Judul Skripsi</th>
									<th class="text-center">Status</th>
									<th class="text-center">Detail</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_bbg)) {
									$no = 1;
									foreach ($g_bbg as $data) {
										$bimbingan_id   = $data['bimbingan_id'];
										$npm            = $data['npm'];
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$pbb_satu       = $data['pbb_satu'];
										$pbb_dua        = $data['pbb_dua'];
										$judul_proposal = $data['judul_proposal'];
										$status         = $data['status'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td>
												<?php
												if (!empty($pbb_satu)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = strtoupper($data['nama_lkp']);

														if ($pbb_satu == $nidn) {
															echo $nama_dsn;
														}
													endforeach;
												} else {
												?>
													<b> <span class="label label-danger">BLM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td>
												<?php
												if (!empty($pbb_dua)) {
													foreach ($g_dosen as $data) :
														$nidn     = $data['nidn'];
														$nama_dsn = strtoupper($data['nama_lkp']);

														if ($pbb_dua == $nidn) {
															echo $nama_dsn;
														}
													endforeach;
												} else {
												?>
													<b> <span class="label label-danger">BLM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
											<td class="text-center"><?= $judul_proposal ?></td>
											<td class="text-center">
												<?php
												if ($status == 2) {
													echo "SELESAI BIMBINGAN";
												} else {
													echo "BIMBINGAN";
												}
												?>
											</td>
											<td class="text-center">
												<form action="<?= site_url('bimbingan/detail') ?>" method="post">
													<input type="hidden" name="bimbingan_id" value="<?= $bimbingan_id ?>">
													<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

													<button class="btn btn-sm btn-flat btn-default"><i class="fa fa-eye"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('bimbingan/delete') ?>" method="post">
													<input type="hidden" name="bimbingan_id" value="<?= $bimbingan_id ?>">

													<button onclick="return confirm('Delete data, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-danger"> <i class="fa fa-trash"></i></button>
												</form>
											</td>
										</tr>
										<!-- /. Isi Tabel -->
								<?php
									}
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
