<!-- Include Head -->
<?php $this->load->view('template/head'); ?>
<!-- Include JS File -->
<?php $this->load->view('template/js'); ?>

<!-- <body class="hold-transition skin-blue sidebar-mini"> -->

<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">

		<!-- Include topbar -->
		<?php $this->load->view('template/topbar'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<div class="container-fluid">
				<div style="margin-top: 1%">
					<!-- Include Content -->
					<?= !empty($contents) ? $contents : "404 not found" ?>
				</div>
			</div>
		</div>
		<!-- /.content-wrapper -->

		<!-- Include Footer File -->
		<?php $this->load->view('template/footer'); ?>
	</div>

</body>

</html>
