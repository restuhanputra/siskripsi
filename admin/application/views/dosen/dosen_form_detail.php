<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">

				<div class='box-header with-border'>
					<h3 class='box-title pull-right'>
						<a href="<?= site_url('dosen') ?>" class="btn btn-sm btn-flat btn-warning"><i class='fa fa-undo'></i> Kembali</a>
					</h3>
				</div><!-- /.box-header -->

				<form>
					<div class="box-body">
						<div class="form-group row">
							<label for="nidn" class="col-sm-4 control-label">NIDN</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="nidn" placeholder="NIDN" value="<?= $dsn_id['nidn'] != "" ? $dsn_id['nidn'] : "" ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="nama_lkp" class="col-sm-4 control-label">Nama Lengkap</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lkp" placeholder="Nama Lengkap" value="<?= $dsn_id['nama_lkp'] ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="jk" class="col-sm-4 control-label">Jenis Kelamin</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="jk" placeholder="jk" value="<?= $dsn_id['jk'] == "L" ? "LAKI - LAKI" : "PEREMPUAN" ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="agama" class="col-sm-4 control-label">Agama</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="agama" placeholder="Agama" value="<?= strtoupper($dsn_id['agama_nama']) ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="alamat_lkp" class="col-sm-4 control-label">Alamat Lengkap</label>

							<div class="col-sm-8">
								<textarea class="form-control" rows="5" name="alamat_lkp" placeholder="Alamat Lengkap" readonly><?= $dsn_id['alamat_lkp'] != "" ? $dsn_id['alamat_lkp'] : "" ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<label for="no_telp" class="col-sm-4 control-label">No. Telp</label>

							<div class="col-sm-8">
								<input type="number" class="form-control" name="no_telp" placeholder="No. Telp" value="<?= $dsn_id['no_telp'] ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="email" class="col-sm-4 control-label">Email</label>

							<div class="col-sm-8">
								<input type="email" class="form-control" name="email" placeholder="Email" value="<?= $dsn_id['email'] != "" ? $dsn_id['email'] : "" ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="role" class="col-sm-4 control-label">Role</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="role" placeholder="Role" value="<?= $dsn_id['role'] == 2 ? "KAPRODI" : "DOSEN" ?>" readonly>
							</div>
						</div>
						<div class="form-group row">
							<label for="status" class="col-sm-4 control-label">Status</label>

							<div class="col-sm-8">
								<input type="text" class="form-control" name="status" placeholder="Status" value="<?= $dsn_id['status'] == "2" ? "AKTIF" : "TIDAK AKTIF" ?>" readonly>
							</div>
						</div>

					</div> <!-- /.box-body -->
				</form> <!-- /.form -->

			</div> <!-- /.box -->
		</div> <!-- /.col-xs-12 -->

	</div> <!-- /.row -->

</section> <!-- /.section -->
