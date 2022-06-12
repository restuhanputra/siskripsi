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
						<form action="<?= site_url('sdg_skripsi/laporan') ?>" method="post" target="_blank">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button onclick="return confirm('Print data, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-success"> <i class="fa fa-print"></i> PRINT</button>
						</form>
					</h3>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('sdg_skripsi') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> KEMBALI</a>
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
									<th class="text-center">No. Telp</th>
									<th class="text-center">E-mail</th>
									<th class="text-center">Judul Skripsi</th>
									<th class="text-center">Created</th>
									<th class="text-center">Detail</th>
									<th class="text-center">Revisi</th>
									<th class="text-center">Status</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_sdg_skripsi)) {
									$no = 1;
									foreach ($g_sdg_skripsi as $data) :
										$sdg_skripsi_id = $data['sdg_skripsi_id'];
										$npm            = $data['npm'];
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$no_telp        = $data['no_telp'];
										$email          = $data['email'];
										$judul_skripsi  = $data['judul_skripsi'];
										$status         = $data['status'];
										$revisi         = $data['revisi'];
										$created        = date('d-m-Y', strtotime($data['created']));
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td><?= $no_telp ?></td>
											<td><?= $email ?></td>
											<td><?= $judul_skripsi ?></td>
											<td><?= $created ?></td>
											<td class="text-center">
												<form action="<?= site_url('sdg_skripsi/detail') ?>" method="post">
													<input type="hidden" name="sdg_skripsi_id" value="<?= $sdg_skripsi_id ?>">
													<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></button>
												</form>
											</td>
											<td class="text-center">
												<?php
												if ($revisi == 2) {
												?>
													<form action="<?= site_url('sdg_skripsi/revisi') ?>" method="post">
														<input type="hidden" name="sdg_skripsi_id" value="<?= $sdg_skripsi_id ?>">

														<button onclick="return confirm('Revisi Data, Apakah anda yakin ?')" href="<?= site_url('sdg_skripsi/revisi') ?>" class="btn btn-sm btn-flat btn-warning"><i class="fa fa-edit"></i></button>
													</form>
												<?php
												} else {
												?>
													<button onclick="return confirm('Data sudah di revisi')" href="#" class="btn btn-sm btn-flat btn-success"> <i class="fa fa-check"></i></button>
												<?php
												}
												?>
											</td>
											<td class="text-center">
												<form action="<?= site_url('sdg_skripsi/status') ?>" method="post">
													<input type="hidden" name="sdg_skripsi_id" value="<?= $sdg_skripsi_id ?>">

													<?php
													if ($status == 0) {
													?>
														<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-pencil"></i></button>
													<?php
													} elseif ($status == 1) {
													?>
														<button class="btn btn-sm btn-flat btn-danger"><b>TIDAK LULUS </b></button>
													<?php
													} elseif ($status == 2) {
													?>
														<button class="btn btn-sm btn-flat btn-warning"><b>REVISI LAPORAN</b></button>
													<?php
													} elseif ($status == 3) {
													?>
														<button class="btn btn-sm btn-flat btn-success"><b>LULUS</b></button>
													<?php
													}
													?>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('sdg_skripsi/delete') ?>" method="post">
													<input type="hidden" name="sdg_skripsi_id" value="<?= $sdg_skripsi_id ?>">

													<button onclick="return confirm('Delete data, Apakah anda yakin ?')" href="<?= site_url('proposal/delete') ?>" class="btn btn-sm btn-flat btn-danger"> <i class="fa fa-trash"></i></button>
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
