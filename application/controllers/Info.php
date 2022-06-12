<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Info extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Info_m', 'info');
	}

	public function index()
	{
		$text = "Info";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$data['info']   = $this->info->get()->result_array();

		$this->template->load('template', 'info', $data);
	}
}/* /. class */
