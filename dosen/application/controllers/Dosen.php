<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Dosen_m', 'dsn');
	}

	public function index()
	{
		$text = "Data Dosen Teknik Informatika";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$prodi_id        = $this->fu->userLogin()['prodi_id'];
		$data['g_dosen'] = $this->dsn->get($prodi_id)->result_array();

		$this->template->load('template', 'dosen/dosen_data', $data);
	}
}/* /.class */
