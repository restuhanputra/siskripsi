<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bimbingan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Bimbingan_m', 'bimbingan');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->library('Pdf');
	}

	function index()
	{
		$text = "Bimbingan Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();

		$this->template->load('template', 'bimbingan/bimbingan', $data);
	}

	function data()
	{
		$text = "Data Bimbingan Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_bbg']               = $this->bimbingan->get($tahun_akademik_id)->result_array();
		$data['g_dosen']             = $this->dsn->get()->result_array();
		$data['g_waktu']             = $this->waktu->get()->result_array();

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
		$bimbingan_id      = $this->input->post('bimbingan_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_bbg_id']            = $this->bimbingan->get_id($bimbingan_id)->row_array();
		$data['g_dosen']             = $this->dsn->get()->result_array();
		$data['g_waktu']             = $this->waktu->get()->result_array();

		$this->template->load('template', 'bimbingan/bimbingan_detail', $data);
	}

	function delete()
	{
		$bimbingan_id = $this->input->post('bimbingan_id');
		$this->bimbingan->delete($bimbingan_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->data();
		}
	}

	function laporan()
	{
		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_bbg']       = $this->bimbingan->get($tahun_akademik_id)->result_array();
		$data['g_dosen']     = $this->dsn->get()->result_array();
		$g_thn_akdmk         = $this->thn_akdmk->get()->result_array();
		$data['g_thn_akdmk'] = $g_thn_akdmk;
		$data['g_waktu']     = $this->waktu->get()->result_array();

		$data['tahun_akademik'] = $tahun_akademik_id;
		$dsn                    = $this->dsn->kaprodi()->row_array();
		$data['kaprodi']        = $dsn['nama_lkp'];

		// tanggal
		$date2             = date('Y-m-d');
		$data['d_tanggal'] = mediumdate_indo($date2);

		// semester
		$semester_id = $this->thn_akdmk->get($tahun_akademik_id)->row_array();
		$semester    = $semester_id['semester'];
		if ($semester == 1) {
			$smt = "(GANJIL)";
		} else {
			$mst = "(GENAP)";
		}

		$html = $this->load->view('cetak/bimbingan', $data, TRUE);

		$title_page = 'LAPORAN_BIMBINGAN_SKRIPSI' . $smt;
		$this->pdf->pdf_create($html, $title_page, 'A4', 'landscape');
	}
}/* /.class */
