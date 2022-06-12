<!-- Main content -->
<section class="content">

	<div class="row">
		<div class="col-sm-8">

			<div class="box" style="border-radius: none; border-top: none;">
				<div class='box-header with-border'>
					<div class="text-center">
						<h3 class='box-title text-bold'>
							<b><?= $title ?></b>
						</h3>
					</div>
				</div>

				<br>
				<div class="row">
					<div class="col-sm-2">
						<?php
						if (!empty($g_bbg_id['pbb_satu'])) {
							foreach ($g_dosen as $data) :
								$nidn     = $data['nidn'];
								$foto_dsn = $data['foto'];

								if ($g_bbg_id['pbb_satu'] == $nidn) {
									if (!empty($foto_dsn)) {
										$foto = './dosen/upload/' . $foto_dsn;
						?>
										<img class="img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px; margin-left:20%;">
									<?php
									} else {
										$foto = './dosen/upload/profile.jpg';
									?>
										<img class="img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px; margin-left:20%;">
							<?php
									}
								}
							endforeach;
						} else {
							$foto = './dosen/upload/profile.jpg';
							?>
							<img class="img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px; margin-left:20%;">
						<?php
						}
						?>
					</div> <!-- /.col-sm-3 -->

					<div class="col-sm-10">
						<table class="table table-responsive table-hover">
							<tr>
								<td class="text-bold" width="200">Dosen Pembimbing I</td>
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
								<td class="text-bold" width="200">No. Telp Pembimbing I</td>
								<?php
								if (!empty($g_bbg_id['pbb_satu'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$no_telp  = $data['no_telp'];

										if ($g_bbg_id['pbb_satu'] == $nidn) {
								?>
											<td> <b>:</b> <?= $no_telp ?> </td>
									<?php
										}
									endforeach;
								} else {
									?>
									<td> : - </td>
								<?php
								}
								?>
							</tr>
						</table>
					</div>
				</div><!-- /.row -->
				<br>
				<div class="row">
					<div class="col-sm-2">
						<?php
						if (!empty($g_bbg_id['pbb_dua'])) {
							foreach ($g_dosen as $data) :
								$nidn     = $data['nidn'];
								$foto_dsn = $data['foto'];

								if ($g_bbg_id['pbb_dua'] == $nidn) {
									if (!empty($foto_dsn)) {
										$foto = './dosen/upload/' . $foto_dsn;
						?>
										<img class="img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px; margin-left:20%;">
									<?php
									} else {
										$foto = './dosen/upload/profile.jpg';
									?>
										<img class="img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px; margin-left:20%;">
							<?php
									}
								}
							endforeach;
						} else {
							$foto = './dosen/upload/profile.jpg';
							?>
							<img class="img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px; margin-left:20%;">
						<?php
						}
						?>
					</div> <!-- /.col-sm-3 -->

					<div class="col-sm-10">
						<table class="table table-responsive table-hover">
							<tr>
								<td class="text-bold" width="200">Dosen Pembimbing II</td>
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
								<td class="text-bold" width="200">No. Telp Pembimbing II</td>
								<?php
								if (!empty($g_bbg_id['pbb_dua'])) {
									foreach ($g_dosen as $data) :
										$nidn     = $data['nidn'];
										$no_telp  = $data['no_telp'];

										if ($g_bbg_id['pbb_dua'] == $nidn) {
								?>
											<td> <b>:</b> <?= $no_telp ?> </td>
									<?php
										}
									endforeach;
								} else {
									?>
									<td> : - </td>
								<?php
								}
								?>
							</tr>
						</table>
					</div>
				</div><!-- /.row -->
				<br>

			</div> <!-- /.box -->
		</div> <!-- /.col-sm-8 -->

		<!-- load rightbar -->
		<?php $this->load->view('template/rightbar'); ?>
	</div><!-- /.row -->

</section>
<!-- /.content -->
