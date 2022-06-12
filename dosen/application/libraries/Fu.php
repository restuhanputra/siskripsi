<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fu
{
	// dsn
	function userLogin()
	{
		$CI = &get_instance();
		$CI->load->model('User_m', 'user');
		$user_nidn = $CI->session->userdata('nidn');
		$user_data = $CI->user->get($user_nidn)->row_array();

		return $user_data;
	}
} /* /.class */
