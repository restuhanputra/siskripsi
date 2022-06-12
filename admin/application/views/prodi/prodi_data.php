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
						<a href="<?= site_url('prodi/add') ?>" class="btn btn-sm btn-flat btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Prodi</th>
									<th class="text-center">Created</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($prodi)) {
									$no = 1;
									foreach ($prodi as $data) :
										$prodi_id   = $data['prodi_id'];
										$nama_prodi = $data['nama'];
										$created    = date('d-m-Y', strtotime($data['created']));

								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $nama_prodi ?></td>
											<td><?= $created ?></td>
											<td class="text-center">
												<form action="<?= site_url('prodi/edit') ?>" method="post">
													<input type="hidden" name="prodi_id" value="<?= $prodi_id ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('prodi/delete') ?>" method="post">
													<input type="hidden" name="prodi_id" value="<?= $prodi_id ?>">

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
