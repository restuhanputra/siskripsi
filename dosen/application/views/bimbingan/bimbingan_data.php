<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-8">
			<!-- Alert -->
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

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
									<th class="text-center">Judul Skripsi</th>
									<th class="text-center">Detail</th>
									<th class="text-center">Selesai Bimbingan</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_bbg)) {
									$no = 1;
									foreach ($g_bbg as $data) :
										$bimbingan_id   = $data['bimbingan_id'];
										$proposal_id    = $data['proposal_id'];
										$nama_lkp       = ucfirst($data['nama_lkp']);
										$npm            = $data['npm'];
										$judul_proposal = $data['judul_proposal'];
										$proposal       = $data['proposal'];
										$foto_mhs       = $data['foto'];
										$status         = $data['status'];
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
											<td>
												<form action="<?= site_url('bimbingan/file_proposal') ?>" method="post">
													<input type="hidden" name="file_proposal" value="<?= $proposal ?>">

													<?= $judul_proposal ?> <button class="btn btn-sm btn-flat btn-primary"> <i class="fa fa-download"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('bimbingan/detail') ?>" method="post">
													<input type="hidden" name="proposal_id" value="<?= $proposal_id ?>">

													<button class="btn btn-sm btn-flat btn-default"><i class="fa fa-eye"></i></button>
												</form>
											</td>
											<td class="text-center">
												<form action="<?= site_url('bimbingan/selesai') ?>" method="post">
													<input type="hidden" name="bimbingan_id" value="<?= $bimbingan_id ?>">
													<input type="hidden" name="proposal_id" value="<?= $proposal_id ?>">

													<button onclick="return confirm('Selesai bimbingan, Apakah anda yakin ?')" class="btn btn-sm btn-flat btn-success"> <i class="fa fa-check"></i></button>
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
		</div> <!-- /.col-xs-8 -->

		<!-- load rightbar -->
		<?php $this->load->view('template/rightbar'); ?>

		<div class="col-sm-4">
			<div class="box" style="border-radius: none; border-top: none;">
				<div class="box-header with-border">
					<i class="fa fa-bullhorn"></i>
					<h3 class="box-title text-bold">CATATAN</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<ol style="padding-inline-start: 20px !important;">
						<li>Jangan lupa guys, lihat info dahulu di sini <a class="fa fa-external-link" href="<?= site_url('info') ?>"></a>.</li>
						<li>Jika hasil Sidang Proposal = Tidak Layak, Dosen berhak melakukan selesai bimbingan.</li>
						<li>Jika hasil Sidang Skripsi = Tidak Lulus Sidang Skripsi, Dosen berhak melakukan selesai bimbingan.</li>
						<li>Jika hasil Sidang Skripsi = Lulus Sidang Skripsi, Dosen berhak melakukan selesai bimbingan.</li>
					</ol>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->
		</div> <!-- /.col-sm-4 -->

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
