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

			<div class="box" style="border-radius: none; border-top: none;">

				<div class='box-header with-border'>
					<div class="text-center">
						<h3 class='box-title text-bold'><?= $title ?></h3>
					</div>
					<br>

					<h3 class='box-title'>
						<form action="<?= site_url('pembimbing/add') ?>" method="post">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button class="btn btn-sm btn-flat btn-primary"> <i class="fa fa-plus"></i> TAMBAH DATA</button>
						</form>
					</h3>
					&nbsp;
					<h3 class='box-title'>
						<form action="<?= site_url('pembimbing/laporan') ?>" method="post" target="_blank">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button onclick="return confirm('Print data, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-success"> <i class="fa fa-print"></i> PRINT</button>
						</form>
					</h3>

					<h3 class='box-title pull-right'>
						<a href="<?= site_url('pembimbing') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> KEMBALI</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center" style="width:1%;">No</th>
									<th class="text-center">NPM</th>
									<th class="text-center">Nama Lengkap</th>
									<th class="text-center">Judul</th>
									<th class="text-center">Dosen Pembimbing I</th>
									<th class="text-center">Dosen Pembimbing II</th>
									<th class="text-center">Edit</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_pembimbing)) {
									$no = 1;
									foreach ($g_pembimbing as $data) :
										$bimbingan_id   = $data['bimbingan_id'];
										$npm            = $data['npm'];
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$judul_proposal = $data['judul_proposal'];
										$pbb_satu       = $data['pbb_satu'];
										$pbb_dua        = $data['pbb_dua'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td><?= $judul_proposal ?></td>
											<td>
												<?php
												if (isset($pbb_satu)) {
													foreach ($g_dosen as $data) {
														$nidn     = $data['nidn'];
														$nama_dsn = $data['nama_lkp'];

														if ($pbb_satu == $nidn) {
															echo $nama_dsn;
														}
													}
												} else {
													echo "404 not found";
												}
												?>
											</td>
											<td>
												<?php
												if (isset($pbb_dua)) {
													foreach ($g_dosen as $data) {
														$nidn     = $data['nidn'];
														$nama_dsn = $data['nama_lkp'];

														if ($pbb_dua == $nidn) {
															echo $nama_dsn;
														}
													}
												} else {
													echo "404 not found";
												}
												?>
											</td>
											<td class="text-center">
												<form action="<?= site_url('pembimbing/edit') ?>" method="post">
													<input type="hidden" name="bimbingan_id" value="<?= $bimbingan_id ?>">
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
