<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Proposal_m', 'proposal');
		$this->load->model('Sdg_proposal_m', 'sdg_ppsl');
		$this->load->model('Sdg_skripsi_m', 'sdg_skripsi');
	}

	public function index()
	{
		$text = "Dashboard";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$npm                      = $this->session->userdata('npm');
		$data['g_proposal_id']    = $this->proposal->get($npm)->row_array();
		$data['g_sdg_ppsal_id']   = $this->sdg_ppsl->get($npm)->row_array();
		$data['g_sdg_skripsi_id'] = $this->sdg_skripsi->get($npm)->row_array();

		$this->template->load('template', 'dashboard', $data);
	}
} /* /.class */
