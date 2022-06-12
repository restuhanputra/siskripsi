<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fu
{
	function userLogin()
	{
		$CI = &get_instance();
		$CI->load->model('User_m', 'user');
		$user_nip  = $CI->session->userdata('nip');
		$user_data = $CI->user->get($user_nip)->row_array();

		// return $user_nip;
		return $user_data;
	}
} /* /.class */
