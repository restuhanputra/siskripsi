<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-sm-8">

			<div class="box" style="border-radius: none; border-top: none;">

				<div class='box-header with-border'>
					<h3 class='box-title'>
						<b><?= $title ?></b>
					</h3>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('proposal') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> <b>KEMBALI</b></a>
					</h3>

					<?php
					if (!empty($g_proposal_id)) {
						if ($g_proposal_id['revisi'] == 1) {
					?>
							<br><br>
							<h3 class='box-title'>
								<form action="<?= site_url('proposal/revisi') ?>" method="post">
									<input type="hidden" name="revisi_proposal">

									<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-edit"></i> <b>REVISI</b></button>
								</form>
							</h3>
					<?php
						}
					}
					?>
				</div><!-- /.box-header -->

				<div class="box-body">
					<?php
					if (!empty($g_proposal_id)) {
						if (!empty($g_proposal_id['revisi'])) {
							if (($g_proposal_id['revisi']) == 1) {
					?>
								<div class="callout callout-warning">
									<b><i class="fa fa-thumb-tack"></i> PEMBERITAHUAN</b>
									<br>
									<b>DATA PROPOSAL SKRIPSI SUDAH BISA DIREVISI.</b>
								</div>
						<?php
							}
						}
						?>
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
									<td class="text-bold">E-mail</td>
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
					<?php
					}
					?>
				</div> <!-- /. box-body -->

			</div> <!-- /.box -->
		</div> <!-- /.col-sm-8 -->

		<!-- load rightbar -->
		<?php $this->load->view('template/rightbar'); ?>
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
