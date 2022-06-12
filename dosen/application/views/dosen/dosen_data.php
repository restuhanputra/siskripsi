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
									<th class="text-center" style="width:6%;">Foto</th>
									<th class="text-center">NIDN</th>
									<th class="text-center">Nama Lengkap</th>
									<th class="text-center">JK</th>
									<th class="text-center">Agama</th>
									<th class="text-center">Role</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_dosen)) {
									$no = 1;
									foreach ($g_dosen as $data) :
										$nidn       = $data['nidn'];
										$nama_lkp   = $data['nama_lkp'];
										$agama_nama = $data['agama_nama'];
										$jk         = $data['jk'];
										$role       = $data['role'];
										$foto       = $data['foto'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td>
												<?php
												if (!empty($foto)) {
													$foto = './../dosen/upload/' . $foto;
												} else {
													$foto = './../dosen/upload/profile.jpg';
												}
												?>
												<img src="<?= $foto ?>" class="img-circle" alt="User Image" style="height:53px; width:53px;">
											</td>
											<td><?= $nidn ?></td>
											<td><?= $nama_lkp ?></td>
											<td class="text-center"><?= $jk ?></td>
											<td class="text-center"><?= $agama_nama ?></td>
											<td class="text-center"><?= $role == 2 ? "KAPRODI" : "DOSEN" ?></td>
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
