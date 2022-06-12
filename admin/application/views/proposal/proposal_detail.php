<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<form action="<?= site_url('proposal/data') ?>" method="post">
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
								<td><b>:</b> <?= $g_proposal_id['tahun'] ?> (<?= $g_proposal_id['semester'] != 1 ? 'GENAP' : 'GANJIL' ?>)</td>
							</tr>
							<tr>
								<td class="text-bold">Nama Lengkap</td>
								<td><b>:</b> <?= $g_proposal_id['nama_lkp'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">NPM</td>
								<td><b>:</b> <?= $g_proposal_id['npm'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Prodi</td>
								<td><b>:</b> <?= $g_proposal_id['prodi_nama'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Kelas</td>
								<td><b>:</b> <?= $g_proposal_id['kelas'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">No. Telepon</td>
								<td><b>:</b> <?= $g_proposal_id['no_telp'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Email</td>
								<td><b>:</b> <?= $g_proposal_id['email'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Judul Proposal Skripsi</td>
								<td><b>:</b> <?= $g_proposal_id['judul_proposal'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">File Proposal Skripsi</td>
								<td><b>:</b> <?= $g_proposal_id['proposal'] ?></td>
							</tr>
							<tr>
								<td class="text-bold">Dosen Pembimbing</td>
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
						</table>
					</div>
				</div> <!-- /. box-body -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
