<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">

		<div class="col-sm-8">
			<?php
			if ($this->session->flashdata('msg')) :
				echo $this->session->flashdata('msg');
				unset($_SESSION['msg']);
			endif;
			?>

			<div class="box" style="border-radius: none; border-top: none;">
				<div class="box-body box-profile">
					<?php
					if (!empty($mhs_id['foto'])) {
						$foto = base_url('upload/' . $mhs_id['foto']);
					} else {
						$foto = base_url('upload/profile.jpg');
					}
					?>
					<img class="profile-user-img img-responsive img-circle" src="<?= $foto ?>" alt="User profile picture" style="height:100px; width:100px;">

					<h3 class="profile-username text-center"><?= $mhs_id['nama_lkp'] ?></h3>

					<p class="text-muted text-center"><?= $mhs_id['prodi_nama'] ?></p>

					<hr style="margin-bottom: 0;">

					<strong>Agama</strong>
					<p class="text-muted">
						<?= $mhs_id['agama_nama'] ?>
					</p>

					<hr style="margin-top: 0; margin-bottom: 0;">

					<strong>Jenis Kelamin</strong>
					<p class="text-muted">
						<?= $mhs_id['jk'] == "L" ? "Laki-Laki" : "Perempuan" ?>
					</p>

					<hr style="margin-top: 0; margin-bottom: 0;">

					<strong>No. Telp</strong>
					<p class="text-muted">
						<?= $mhs_id['no_telp'] != "" ? $mhs_id['no_telp'] : "" ?>
					</p>

					<hr style="margin-top: 0; margin-bottom: 0;">

					<strong>Alamat</strong>

					<p class="text-muted">
						<?= $mhs_id['alamat_lkp'] != "" ? $mhs_id['alamat_lkp'] : "<br>" ?>
					</p>

					<hr style="margin-top: 0; margin-bottom: 0;">

					<br>

					<a href="<?= site_url('profile/edit') ?>" class="btn btn-primary btn-flat btn-block"><b>Edit</b></a>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-sm-6 -->

		<!-- load rightbar -->
		<?php $this->load->view('template/rightbar'); ?>

		<div class="col-sm-4">
			<div class="box" style="border-radius: none; border-top: none;">
				<div class="box-header with-border">
					<i class="fa fa-heart"></i>
					<h3 class="box-title text-bold">Tips !</h3>
				</div>
				<div class="box-body">
					<div class="news-item-detail">
						<p class="news-item-preview"> <i class="fa fa-lock color-primary"></i> &nbsp;Gunakan password yang unik dan kuat </p>
					</div>
					<div class="news-item-detail">
						<p class="news-item-preview"> <i class="fa fa-trash  color-primary"></i> &nbsp;Hapus aplikasi & ekstensi browser yang tidak diperlukan </p>
					</div>
					<div class="news-item-detail">
						<p class="news-item-preview"> <i class="fa fa-gear color-primary"></i> &nbsp;Update browser dan sistem operasi</p>
					</div>
				</div> <!-- /.box-body -->
			</div>
		</div>
	</div> <!-- /.row -->

</section> <!-- /.section -->
