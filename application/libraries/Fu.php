<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fu
{
	// mhs
	function userLogin()
	{
		$CI = &get_instance();
		$CI->load->model('User_m', 'user');
		$user_npm  = $CI->session->userdata('npm');
		$user_data = $CI->user->get($user_npm)->row_array();

		return $user_data;
	}
} /* /.class */
