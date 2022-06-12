<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->helper('download');
		$this->load->library('form_validation');
		$this->load->model('Bimbingan_m', 'bbg');
		$this->load->model('Dosen_m', 'dsn');
	}

	public function index()
	{
		$text = "Bimbingan Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$nidn          = $this->fu->userLogin()['nidn'];
		$data['g_bbg'] = $this->bbg->get($nidn)->result_array();

		$this->template->load('template', 'bimbingan/bimbingan_data', $data);
	}

	function detail()
	{
		$text = "Detail Bimbingan Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$proposal_id = $this->input->post('proposal_id');

		// get data
		$data['g_bbg_id']             = $this->bbg->get_id($proposal_id)->row_array();
		$data['g_bbg_sdg_ppsal_id']   = $this->bbg->get_sdg_proposal($proposal_id)->row_array();
		$data['g_bbg_sdg_skripsi_id'] = $this->bbg->get_sdg_skripsi($proposal_id)->row_array();

		$this->template->load('template', 'bimbingan/bimbingan_detail', $data);
	}

	function riwayat()
	{
		$text = "Riwayat Bimbingan Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$nidn                  = $this->fu->userLogin()['nidn'];
		$data['g_bbg_riwayat'] = $this->bbg->get_riwayat($nidn)->result_array();
		$data['g_dosen']       = $this->dsn->get()->result_array();

		$this->template->load('template', 'bimbingan/bimbingan_riwayat', $data);
	}

	function selesai()
	{
		$bimbingan_id = $this->input->post('bimbingan_id');
		$proposal_id  = $this->input->post('proposal_id');

		//get data 
		$g_bbg_sdg_ppsal_id   = $this->bbg->get_sdg_proposal($proposal_id)->row_array();
		$g_bbg_sdg_skripsi_id = $this->bbg->get_sdg_skripsi($proposal_id)->row_array();

		$status_sdg_proposal = $g_bbg_sdg_ppsal_id['status_sdg_proposal'];
		$status_sdg_skripsi  = $g_bbg_sdg_skripsi_id['status_sdg_skripsi'];

		if ($status_sdg_proposal == 1) {
			$this->bbg->selesai($bimbingan_id);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Selesai Bimbingan Berhasil!</center></div>');
				$this->index();
			}
		} elseif ($status_sdg_skripsi == 1 || $status_sdg_skripsi == 3) {
			$this->bbg->selesai($bimbingan_id);

			if ($this->db->affected_rows() > 0) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Selesai Bimbingan Berhasil!</center></div>');
				$this->index();
			}
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Maaf Tidak Bisa!</center></div>');
			$this->index();
		}
	}

	function file_proposal()
	{
		$file_proposal = $this->input->post('file_proposal');

		$path = './../assets/dokumen/proposal/' . $file_proposal;
		$data = file_get_contents($path);
		$name = $file_proposal;
		force_download($name, $data);
	}
} /* /.class */
