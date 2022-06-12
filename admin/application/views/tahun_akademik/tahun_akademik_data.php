<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">
			<!--Alert  -->
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box">
				<div class='box-header with-border'>
					<h3 class='box-title'>
						<a href="<?= site_url('tahun_akademik/add') ?>" class="btn btn-sm btn-flat btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Tahun</th>
									<th class="text-center">Semester</th>
									<th class="text-center">Status</th>
									<th class="text-center">Created</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($thn_akdmk)) {
									$no = 1;
									foreach ($thn_akdmk as $data) :
										$tahun_akademik_id = $data['tahun_akademik_id'];
										$tahun             = $data['tahun'];
										$aktifkah          = $data['aktifkah'];
										$semester          = $data['semester'];
										$created           = date('d-m-Y', strtotime($data['created']));

								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td><?= $tahun ?></td>
											<td><?= $semester != 1 ? 'GENAP' : 'GANJIL' ?></td>
											<td><?= $aktifkah != 2 ? 'TIDAK AKTIF' : 'AKTTIF' ?></td>
											<td><?= $created ?></td>
											<td class="text-center">
												<form action="<?= site_url('tahun_akademik/edit') ?>" method="post">
													<input type="hidden" name="tahun_akademik_id" value="<?= $tahun_akademik_id ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('tahun_akademik/delete') ?>" method="post">
													<input type="hidden" name="tahun_akademik_id" value="<?= $tahun_akademik_id ?>">

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
