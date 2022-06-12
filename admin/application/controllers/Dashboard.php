<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Mahasiswa_m', 'mhs');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Proposal_m', 'ppsal');
		$this->load->model('Sdg_proposal_m', 'sdg_ppsal');
		$this->load->model('Sdg_skripsi_m', 'sdg_skripsi');
		$this->load->model('Wisuda_m', 'wisuda');
		$this->load->model('Bimbingan_m', 'bbg');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
	}

	public function index()
	{
		$text = "Dashboard";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data count
		$data['count_mhs']         = $this->mhs->count()->num_rows();
		$data['count_dsn']         = $this->dsn->count()->num_rows();
		$data['count_ppsal']       = $this->ppsal->count()->num_rows();
		$data['count_sdg_ppsal']   = $this->sdg_ppsal->count()->num_rows();
		$data['count_sdg_skripsi'] = $this->sdg_skripsi->count()->num_rows();
		$data['count_wisuda']      = $this->wisuda->count()->num_rows();
		$data['count_bimbingan']   = $this->bbg->count()->num_rows();

		// Donut chart
		$tahun_akademik            = $this->thn_akdmk->now()->row_array();
		$tahun_akademik_id         = $tahun_akademik['tahun_akademik_id'];
		$data['selesai_bbg']       = $this->bbg->count_bbg($tahun_akademik_id, 2)->num_rows();
		$data['bbg']               = $this->bbg->count_bbg($tahun_akademik_id, 1)->num_rows();
		$data['layak']             = $this->sdg_ppsal->count_sdg_proposal($tahun_akademik_id, 2)->num_rows();
		$data['tdk_layak']         = $this->sdg_ppsal->count_sdg_proposal($tahun_akademik_id, 1)->num_rows();
		$data['lulus_skripsi']     = $this->sdg_skripsi->count_sdg_skripsi($tahun_akademik_id, 3)->num_rows();
		$data['revisi_skripsi']    = $this->sdg_skripsi->count_sdg_skripsi($tahun_akademik_id, 2)->num_rows();
		$data['tdk_lulus_skripsi'] = $this->sdg_skripsi->count_sdg_skripsi($tahun_akademik_id, 1)->num_rows();

		$data['g_thn_akdmk']       = $tahun_akademik;

		$this->template->load('template', 'dashboard', $data);
	}
} /* /.class */
