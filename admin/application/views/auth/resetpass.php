<!--Header-->
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="icon" href="<?php echo base_url() ?>assets/logo.png" sizes="32x32" type="image/png">
	<title>SISKRIP | <?= $h_title ?></title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/font-awesome/css/font-awesome.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url() ?>template/dist/css/AdminLTE.min.css">

</head>

<body class="hold-transition login-page">

	<div class="login-box">
		<!-- untuk menampilkan pesan error -->
		<?php
		if ($this->session->flashdata('msg')) :
			echo $this->session->flashdata('msg');
			unset($_SESSION['msg']);
		endif;
		?>


		<div class="login-box-body">
			<!--width="320px;"-->
			<p>
			<h4 style="color: black; text-align: center; font-weight:bold;"><?= $title ?></h4>
			<hr />
			</p>
			<form action="<?= site_url('auth/reset') ?>" method="post">

				<div class="form-group has-feedback <?= form_error('username') ? 'has-error' : null ?>">
					<input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
					<?= form_error('username') ?>
				</div>

				<!-- /.row -->
				<button type="submit" name="save" class="btn btn-primary btn-block btn-flat"> Submit</button>
				<br>
				<a href="<?= site_url('auth') ?>">Sign In ?</a>
				<br>
			</form>

			<hr />
			<p>
				<center>Copyright <?php echo date('Y'); ?> Hubungi Fak. Teknik Informatika jika terjadi kendala <br /></center>
			</p> <!--  All Right Reserved -->
		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

</body>

</html>

<!-- jQuery 2.2.3 -->
<script src="<?= base_url('template/plugins/jquery/dist/jquery.min.js') ?>"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url('template/bootstrap/js/bootstrap.min.js') ?>"></script>
