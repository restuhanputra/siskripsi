<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Jadwal_m', 'jadwal');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
	}

	function sdg_proposal()
	{
		$text = "Jadwal Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$nidn                       = $this->fu->userLogin()['nidn'];
		$data['g_jdw_sdg_proposal'] = $this->jadwal->get_sdg_proposal($nidn)->result_array();
		$data['g_dosen']            = $this->dsn->get()->result_array();
		$data['g_waktu']            = $this->waktu->get()->result_array();

		$this->template->load('template', 'jadwal/jadwal_sdg_proposal', $data);
	}

	function sdg_skripsi()
	{
		$text = "Jadwal Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$nidn                      = $this->fu->userLogin()['nidn'];
		$data['g_jdw_sdg_skripsi'] = $this->jadwal->get_sdg_skripsi($nidn)->result_array();
		$data['g_dosen']           = $this->dsn->get()->result_array();
		$data['g_waktu']           = $this->waktu->get()->result_array();

		$this->template->load('template', 'jadwal/jadwal_sdg_skripsi', $data);
	}
}/* /. class */
