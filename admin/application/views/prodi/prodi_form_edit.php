<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-8">
			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('prodi') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> Kembali</a>
					</h3>
				</div><!-- /.box-header -->

				<form class="form" enctype="multipart/form-data" action="" method="post">
					<div class="box-body">

						<input type="hidden" name="prodi_id" value="<?= $prodi_id['prodi_id'] ?>">

						<div class="form-group row <?= form_error('nama_prodi') ? 'has-error' : null ?>">
							<label for="nama_prodi" class="col-sm-4 control-label">Nama Prodi *</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_prodi" placeholder="Nama Prodi" value="<?= $prodi_id['nama'] ?>">
								<?= form_error('nama_prodi') ?>
							</div>
						</div>


						<div class="box-footer text-center">
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
							&nbsp;
							<button type="submit" name="edit" class="btn btn-flat btn-success"><i class="fa fa-paper-plane"></i> Edit</button>
						</div> <!-- /.box-footer -->

					</div> <!-- /.box-body -->

				</form> <!-- /.form -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-8 -->

		<div class="col-xs-4">

			<div class="box">
				<div class="box-header with-border">
					<i class="fa fa-bullhorn"></i>
					<h3 class="box-title text-bold">CATATAN</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<ol style="padding-inline-start: 20px !important;">
						<li>Setiap field yang bertanda <b>*</b> wajib diisi.</li>
					</ol>
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->

		</div> <!-- /.col-xs-4 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
