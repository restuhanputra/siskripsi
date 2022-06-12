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
									<th class="text-center" style="width:1%;">No</th>
									<th class="text-center">Tahun Akademik</th>
									<th class="text-center">View</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if (!empty($g_thn_akdmk)) {
									$no = 1;
									foreach ($g_thn_akdmk as $data) :
										$tahun_akademik_id = $data['tahun_akademik_id'];
										$tahun             = $data['tahun'];
										$semester          = $data['semester'];
								?>
										<!-- Isi Tabel -->
										<tr>
											<td><?= $no++ ?>.</td>
											<?php $smt = $semester == 1 ? "GANJIL" : "GENAP"  ?>
											<td>
												<?= $tahun . ' ' . $smt ?>
											</td>
											<td class="text-center">
												<form action="<?= site_url('proposal/data') ?>" method="post">
													<input type="hidden" name="tahun_akademik_id" value="<?= $tahun_akademik_id ?>">

													<button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-eye"></i></button>
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
