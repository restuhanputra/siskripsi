<!-- Include Head -->
<?php $this->load->view('template/head'); ?>
<!-- Include JS File -->
<?php $this->load->view('template/js'); ?>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<!-- Include Header -->
		<?php $this->load->view('template/header'); ?>
		<!-- Left side column. contains the logo and sidebar -->
		<!-- Include Sidebar -->
		<?php $this->load->view('template/sidebar'); ?>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Include Heder Content -->
			<?php $this->load->view('template/header_content'); ?>

			<!-- Include Content -->
			<?= !empty($contents) ? $contents : "404 not found" ?>

		</div>
		<!-- /.content-wrapper -->

		<!-- Include Footer File -->
		<?php $this->load->view('template/footer'); ?>
	</div>


</body>

</html>
