    <!-- Main content -->
    <section class="content">
    	<!-- Small boxes (Stat box) -->
    	<div class="row">
    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-aqua">
    				<div class="inner">
    					<h3><?= $count_ppsal != 0 ? $count_ppsal : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Data Proposal Skripsi</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-files-o"></i>
    				</div>
    				<a href="<?= site_url('proposal') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->

    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-aqua">
    				<div class="inner">
    					<h3><?= $count_sdg_ppsal != 0 ? $count_sdg_ppsal : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Data Sidang Proposal Skripsi</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-files-o"></i>
    				</div>
    				<a href="<?= site_url('sdg_proposal') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->

    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-aqua">
    				<div class="inner">
    					<h3><?= $count_sdg_skripsi != 0 ? $count_sdg_skripsi : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Data Sidang Skripsi</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-files-o"></i>
    				</div>
    				<a href="<?= site_url('sdg_skripsi') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->

    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-aqua">
    				<div class="inner">
    					<h3><?= $count_wisuda != 0 ? $count_wisuda : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Data Wisuda</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-files-o"></i>
    				</div>
    				<a href="<?= site_url('wisuda') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->

    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-green">
    				<div class="inner">
    					<h3><?= $count_mhs != 0 ? $count_mhs : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Mahasiswa</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-user"></i>
    				</div>
    				<a href="<?= site_url('mahasiswa') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->
    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-yellow">
    				<div class="inner">
    					<h3><?= $count_dsn != 0 ? $count_dsn : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Dosen</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-mortar-board"></i>
    				</div>
    				<a href="<?= site_url('dosen') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->
    		<div class="col-lg-3 col-xs-6">
    			<!-- small box -->
    			<div class="small-box bg-red">
    				<div class="inner">
    					<h3><?= $count_bimbingan != 0 ? $count_bimbingan : 0 ?><sup style="font-size: 20px"></sup></h3>

    					<p>Bimbingan</p>
    				</div>
    				<div class="icon">
    					<i class="fa fa-wechat"></i>
    				</div>
    				<a href="<?= site_url('bimbingan') ?>" class="small-box-footer">Selengkapnya <i class="fa fa-arrow-circle-right"></i></a>
    			</div>
    		</div>
    		<!-- ./col -->
    	</div>
    	<!-- /.row -->

    	<div class="row">
    		<div class="col-lg-4">
    			<div class="box">
    				<div class="box-header with-border">
    					<center>
    						<h3 class="box-title text-bold">BIMBINGAN SKRIPSI <br><?= $g_thn_akdmk['tahun'] ?> <?= $g_thn_akdmk['semester'] != '1' ? '(GENAP)' : '(GANJIL)' ?></h3>
    					</center>
    				</div>
    				<div class="box-body">
    					<div id="bbg"></div>
    				</div>
    			</div>
    		</div>

    		<div class="col-lg-4">
    			<div class="box">
    				<div class="box-header with-border">
    					<center>
    						<h3 class="box-title text-bold">SIDANG PROPOSAL SKRIPSI <br><?= $g_thn_akdmk['tahun'] ?> <?= $g_thn_akdmk['semester'] != '1' ? '(GENAP)' : '(GANJIL)' ?></h3>
    					</center>
    				</div>
    				<div class="box-body">
    					<div id="sdg_proposal"></div>
    				</div>
    			</div>
    		</div>

    		<div class="col-lg-4">
    			<div class="box">
    				<div class="box-header with-border">
    					<center>
    						<h3 class="box-title text-bold">SIDANG SKRIPSI <br><?= $g_thn_akdmk['tahun'] ?> <?= $g_thn_akdmk['semester'] != '1' ? '(GENAP)' : '(GANJIL)' ?></h3>
    					</center>
    				</div>
    				<div class="box-body">
    					<div id="sdg_skripsi"></div>
    				</div>
    			</div>
    		</div>
    	</div><!-- /.row -->

    </section>
    <!-- /.content -->

    <script>
    	Morris.Donut({
    		element: 'bbg',
    		data: [{
    				label: "SELESAI BIMBINGAN",
    				value: <?= $selesai_bbg != 0 ? $selesai_bbg : 0 ?>
    			},
    			{
    				label: "BIMBINGAN",
    				value: <?= $bbg != 0 ? $bbg : 0 ?>
    			}
    		],
    		backgroundColor: '#ccc',
    		labelColor: '#000000',
    		colors: ['#009ABF', '#DD4B39']
    	});
    </script>
    <script>
    	Morris.Donut({
    		element: 'sdg_proposal',
    		data: [{
    				label: "LAYAK",
    				value: <?= $layak != 0 ? $layak : 0 ?>
    			},
    			{
    				label: "TIDAK LAYAK",
    				value: <?= $tdk_layak != 0 ? $tdk_layak : 0 ?>
    			}
    		],
    		backgroundColor: '#ccc',
    		labelColor: '#000000',
    		colors: ['#009ABF', '#DD4B39']
    	});
    </script>
    <script>
    	Morris.Donut({
    		element: 'sdg_skripsi',
    		data: [{
    				label: "LULUS SIDANG SKRIPSI",
    				value: <?= $lulus_skripsi != 0 ? $lulus_skripsi : 0 ?>
    			},
    			{
    				label: "REVISI LAPORAN SKRIPSI",
    				value: <?= $revisi_skripsi != 0 ? $revisi_skripsi : 0 ?>
    			},
    			{
    				label: "TIDAK LULUS SIDANG SKRIPSI",
    				value: <?= $tdk_lulus_skripsi != 0 ? $tdk_lulus_skripsi : 0 ?>
    			}
    		],
    		backgroundColor: '#ccc',
    		labelColor: '#000000',
    		colors: ['#009ABF', '#C27D0E', '#DD4B39']
    	});
    </script>
