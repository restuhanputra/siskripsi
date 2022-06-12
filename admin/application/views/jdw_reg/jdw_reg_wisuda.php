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
						<a href="<?= site_url('jadwal_reg/add_wisuda') ?>" class="btn btn-sm btn-flat btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
					</h3>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('jadwal_reg') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> Kembali</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Start Date</th>
									<th class="text-center">Hari (Masa Berlaku)</th>
									<th class="text-center">Aktif</th>
									<th class="text-center">Created</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_jdw_reg_wisuda)) {
									$no = 1;
									foreach ($g_jdw_reg_wisuda as $data) :
										$jdw_wisuda_id = $data['jdw_wisuda_id'];
										$start_date    = $data['start_date'];
										$hari          = $data['hari'];
										$aktifkah      = $data['aktifkah'];
										$created       = date('d-m-Y', strtotime($data['created']));
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $start_date ?></td>
											<td><?= $hari ?></td>
											<td><?= $aktifkah == 2 ? 'AKTIF' : 'TIDAK AKTIF' ?></td>
											<td class="text-center"><?= $created ?></td>
											<td class="text-center">
												<form action="<?= site_url('jadwal_reg/edit_wisuda') ?>" method="post">
													<input type="hidden" name="jdw_wisuda_id" value="<?= $jdw_wisuda_id ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('jadwal_reg/delete_wisuda') ?>" method="post">
													<input type="hidden" name="jdw_wisuda_id" value="<?= $jdw_wisuda_id ?>">

													<button onclick="return confirm('Delete data, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-danger"> <i class="fa fa-trash"></i></button>
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
