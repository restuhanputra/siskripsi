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
						<a href="<?= site_url('mahasiswa/add') ?>" class="btn btn-sm btn-flat btn-primary"><i class='fa fa-plus'></i> Tambah Data</a>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center" style="width:1%;">No</th>
									<th class="text-center" style="width:6%;">Foto</th>
									<th class="text-center">NPM</th>
									<th class="text-center">Nama Lengkap</th>
									<th class="text-center">JK</th>
									<th class="text-center">Prodi</th>
									<th class="text-center">Status</th>
									<th class="text-center">Detail</th>
									<th class="text-center">Edit</th>
									<th class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_mhs)) {
									$no = 1;
									foreach ($g_mhs as $data) :
										$prodi    = $data['prodi_nama'];
										$npm      = $data['npm'];
										$nama_lkp = ucfirst($data['nama_lkp']);
										$jk       = $data['jk'];
										$agama    = ucfirst($data['agama_nama']);
										$foto     = $data['foto'];
										$status   = $data['status'];
										$created  = date('d-m-Y', strtotime($data['created']));
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td>
												<?php
												if (!empty($foto)) {
													$foto = './../upload/' . $foto;
												} else {
													$foto = './../upload/profile.jpg';
												}
												?>
												<img src="<?= $foto ?>" class="img-circle" alt="User Image" style="height:53px; width:53px;">
											</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td class="text-center"><?= $jk ?></td>
											<td class="text-center"><?= $prodi ?></td>
											<td class="text-center"><?= $status == 2 ? '<span class="label label-success">AKTIF</span>' : '<span class="label label-danger">TIDAK AKTIF</span>' ?></td>
											<td class="text-center">
												<form action="<?= site_url('mahasiswa/detail') ?>" method="post">
													<input type="hidden" name="npm" value="<?= $npm ?>">

													<button class="btn btn-sm btn-flat btn-default"><i class="fa fa-eye"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('mahasiswa/edit') ?>" method="post">
													<input type="hidden" name="npm" value="<?= $npm ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('mahasiswa/delete') ?>" method="post">
													<input type="hidden" name="npm" value="<?= $npm ?>">

													<button onclick="return confirm('Delete data, Apakah anda yakin ?')" href="<?= site_url('mahasiswa/delete') ?>" class="btn btn-sm btn-flat btn-danger"> <i class="fa fa-trash"></i></button>
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
