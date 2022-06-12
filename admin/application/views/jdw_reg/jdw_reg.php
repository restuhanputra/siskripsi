<section class="content">
	<!-- Small boxes (Stat box) -->
	<div class="row">
		<div class="col-xs-12">

			<div class="box">

				<div class="box-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="mytable">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Jadwal</th>
									<th class="text-center">View</th>
								</tr>
							</thead>
							<tbody>
								<!-- Isi Tabel -->
								<tr>
									<td>1.</td>
									<td>Jadwal Proposal Skripsi</td>
									<td class="text-center">
										<form action="<?= site_url('Jadwal_reg/proposal') ?>" method="post">

											<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></button>
										</form>
									</td>
								</tr>
								<tr>
									<td>2.</td>
									<td>Jadwal Sidang Proposal Skripsi</td>
									<td class="text-center">
										<form action="<?= site_url('Jadwal_reg/sdg_proposal') ?>" method="post">

											<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></button>
										</form>
									</td>
								</tr>
								<tr>
									<td>3.</td>
									<td>Jadwal Sidang Skripsi</td>
									<td class="text-center">
										<form action="<?= site_url('Jadwal_reg/sdg_skripsi') ?>" method="post">

											<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></button>
										</form>
									</td>
								</tr>
								<tr>
									<td>3.</td>
									<td>Jadwal Wisuda</td>
									<td class="text-center">
										<form action="<?= site_url('Jadwal_reg/wisuda') ?>" method="post">

											<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></button>
										</form>
									</td>
								</tr>

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
