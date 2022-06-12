<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<form action="<?= site_url('wisuda/data') ?>" method="post">
							<input type="hidden" name="tahun_akademik_id" value="<?= $g_tahun_akademik_id ?>">

							<button class="btn btn-sm btn-flat btn-warning"> <i class="fa fa-undo"></i> KEMBALI</button>
						</form>
					</h3>
				</div><!-- /.box-header -->

				<div class="box-body">
					<div class="col-xs-12">
						<table class="table table-responsive table-striped table-hover">
							<tr>
								<td class="text-bold" width="200">Tahun Akademik</td>
								<td><b>:</b> <?= $g_wisuda_id['tahun'] ?> (<?= $g_wisuda_id['semester'] != 1 ? 'GENAP' : 'GANJIL' ?>)</td>
							</tr>
							<tr>
								<td class="text-bold" width="200">Nama Lengkap</td>
								<td> <b>:</b> <?= $g_wisuda_id['nama_lkp'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">NPM</td>
								<td> <b>:</b> <?= $g_wisuda_id['npm'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Prodi</td>
								<td> <b>:</b> <?= $g_wisuda_id['prodi_nama'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">NIK</td>
								<td> <b>:</b> <?= $g_wisuda_id['nik'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Email</td>
								<td> <b>:</b> <?= $g_wisuda_id['email'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Alamat</td>
								<td> <b>:</b> <?= $g_wisuda_id['alamat_lkp'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Asal SMA/SMK</td>
								<td> <b>:</b> <?= $g_wisuda_id['sma_smk'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Tahun Lulus</td>
								<td> <b>:</b> <?= $g_wisuda_id['lulus_sma_smk'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Nama Ayah</td>
								<td> <b>:</b> <?= $g_wisuda_id['nama_ayah'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Nama Ibu</td>
								<td> <b>:</b> <?= $g_wisuda_id['nama_ibu'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">No. Telepon</td>
								<td> <b>:</b> <?= $g_wisuda_id['no_telp'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Dosen Pembimbing I</td>
								<?php
								if (!empty($g_bbg_id['pbb_satu'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$nama_dsn = strtoupper($data['nama_lkp']);

										if ($g_bbg_id['pbb_satu'] == $nidn) {
								?>
											<td> <b>:</b> <?= $nama_dsn ?> </td>
									<?php
										}
									endforeach;
								} else {
									?>
									<td> <b>: <span class="label label-danger">BELUM DITENTUKKAN</span></b> </td>
								<?php
								}
								?>
							</tr>
							<tr>
								<td class="text-bold">Dosen Pembimbing II</td>
								<?php
								if (!empty($g_bbg_id['pbb_dua'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$nama_dsn = strtoupper($data['nama_lkp']);

										if ($g_bbg_id['pbb_dua'] == $nidn) {
								?>
											<td> <b>:</b> <?= $nama_dsn ?> </td>
									<?php
										}
									endforeach;
								} else {
									?>
									<td> <b>: <span class="label label-danger">BELUM DITENTUKKAN</span></b> </td>
								<?php
								}
								?>
							</tr>
							<tr>
								<td class="text-bold">Tanggal Sidang Skripsi</td>
								<td> <b>:</b> <?= $g_wisuda_id['tanggal_sdg'] != null ? $g_wisuda_id['tanggal_sdg'] : '<b><span class="label label-danger">BELUM DITENTUKKAN</span></b>' ?></td>
							</tr>
							<tr>
								<td class="text-bold">Judul Proposal Skripsi (B. Indonesia)</td>
								<td> <b>:</b> <?= $g_wisuda_id['judul_skripsi_ina'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Judul Proposal Skripsi (B. Inggris)</td>
								<td> <b>:</b> <?= $g_wisuda_id['judul_skripsi_eng'] ?></td>
							</tr>
						</table>
					</div>
				</div> <!-- /. box-body -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
