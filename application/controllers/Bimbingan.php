<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Proposal_m', 'proposal');
		$this->load->model('Bimbingan_m', 'bbg');
	}

	public function index()
	{
		$text = "Bimbingan Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm          	   = $this->session->userdata('npm');
		$g_proposal_id    = $this->proposal->get($npm)->row_array();
		if (!empty($g_proposal_id)) {
			$proposal_id      = $g_proposal_id['proposal_id'];
			$data['g_bbg_id'] = $this->bbg->get_id($proposal_id)->row_array();
		}
		$data['g_dosen'] = $this->dsn->get()->result_array();

		$this->template->load('template', 'bimbingan', $data);
	}
}/* /. class */
