<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-8">
			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('jadwal_reg/proposal') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> Kembali</a>
					</h3>
				</div><!-- /.box-header -->

				<form class="form" enctype="multipart/form-data" action="" method="post">
					<div class="box-body">

						<input type="hidden" name="jdw_proposal_id" value="<?= $g_jdw_proposal_id['jdw_proposal_id'] ?>">

						<div class="form-group row <?= form_error('start_date') ? 'has-error' : null ?>">
							<label for="start_date" class="col-sm-3 control-label">Start Date *</label>

							<div class="col-sm-9">
								<input type="text" class="form-control" name="start_date" placeholder="Start Date" id="datepicker1" value="<?= $g_jdw_proposal_id['start_date'] ?>" autocomplete="off">
								<?= form_error('start_date') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('hari') ? 'has-error' : null ?>">
							<label for="hari" class="col-sm-3 control-label">Hari (Masa Berlaku) *</label>

							<div class="col-sm-9">
								<input type="number" class="form-control" name="hari" placeholder="Hari (Masa Berlaku)" autocomplete="off" value="<?= $g_jdw_proposal_id['hari'] ?>">

								<?= form_error('hari') ?>
							</div>
						</div>

						<div class="form-group row <?= form_error('aktifkah') ? 'has-error' : null ?>">
							<label for="aktifkah" class="col-sm-3 control-label">Status *</label>

							<div class="col-sm-9">
								<select class="form-control" name="aktifkah">
									<?php if ($g_jdw_proposal_id['aktifkah'] == 2) {
										echo '<option value="2" selected>AKTIF</option>';
										echo '<option value="1">TIDAK AKTIF</option>';
									} else {
										echo '<option value="2">AKTIF</option>';
										echo '<option value="1"selected>TIDAK AKTIF</option>';
									}
									?>
								</select>
								<?= form_error('aktifkah') ?>
							</div>
						</div>

						<div class="box-footer text-center">
							<button type="reset" class="btn btn-flat btn-default">Reset</button>
							&nbsp;
							<button type="submit" name="edit" class="btn btn-flat btn-success"><i class='fa fa-paper-plane'></i> Edit</button>
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

<script>
	//Date picker
	$('#datepicker1').datepicker({
		// autoclose: true
		// merubah format tanggal datepicker ke dd-mm-yyyy
		format: "dd-mm-yyyy",
		autoclose: true
	})
</script>
