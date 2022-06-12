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
									<th class="text-center">NPM</th>
									<th class="text-center">Nama Lengkap</th>
									<th class="text-center">Kelas</th>
									<th class="text-center">No. Telp</th>
									<th class="text-center">Judul Skripsi</th>
									<th class="text-center">Dosen Pembimbing I</th>
									<th class="text-center">Dosen Pembimbing II</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_bbg_riwayat)) {
									$no = 1;
									foreach ($g_bbg_riwayat as $data) :
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$npm            = $data['npm'];
										$foto_mhs       = $data['foto'];
										$kelas          = $data['kelas'];
										$pbb_satu       = $data['pbb_satu'];
										$pbb_dua        = $data['pbb_dua'];
										$no_telp        = $data['no_telp'];
										$judul_proposal = $data['judul_proposal'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<td>
												<?php
												if (!empty($foto_mhs)) {
													$foto = './../upload/' . $foto_mhs;
												} else {
													$foto = './../upload/profile.jpg';
												}
												?>
												<img src="<?= $foto ?>" class="img-circle" alt="User Image" style="height:53px; width:53px;">
											</td>
											<td><?= $npm ?></td>
											<td><?= $nama_lkp ?></td>
											<td><?= $kelas ?></td>
											<td><?= $no_telp ?></td>
											<td class="text-center"><?= $judul_proposal ?></td>
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
													<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>
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
													<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>
												<?php
												}
												?>
											</td>
										</tr>
										<!-- /. Isi Tabel -->
								<?php
									endforeach;
								} else {
									NULL;
								} ?>

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
