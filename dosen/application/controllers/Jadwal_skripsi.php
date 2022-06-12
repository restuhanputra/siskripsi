<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal_skripsi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Sdg_skripsi_m', 'sdg_skripsi');
		$this->load->model('Pembimbing_m', 'pbb');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->library('Pdf');
	}

	public function index()
	{
		$text = "Penguji Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$data['g_sdg_skripsi'] = $this->sdg_skripsi->get()->result_array();
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();


		$this->template->load('template', 'jadwal_skripsi/jadwal_skripsi_data', $data);
	}

	function detail()
	{
		$text = "Data Penguji Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_sdg_skripsi']       = $this->sdg_skripsi->get($tahun_akademik_id)->result_array();
		$data['g_dosen']             = $this->dsn->get()->result_array();
		$data['g_waktu']             = $this->waktu->get()->result_array();

		$this->template->load('template', 'jadwal_skripsi/jadwal_skripsi_detail', $data);
	}

	function edit()
	{
		$text = "Edit Penguji Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$sdg_skripsi_id = $this->input->post('sdg_skripsi_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_sdg_skripsi_id']    = $this->sdg_skripsi->get_id($sdg_skripsi_id)->row_array();
		$data['g_dosen']             = $this->dsn->get()->result_array();
		$data['g_waktu']             = $this->waktu->get()->result_array();

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'jadwal_skripsi/jadwal_skripsi_edit', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->sdg_skripsi->edit($post, $sdg_skripsi_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->detail();
				}
			}
		} else {
			$this->template->load('template', 'jadwal_skripsi/jadwal_skripsi_edit', $data);
		}
	}

	function laporan()
	{
		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_jdw_skripsi'] = $this->sdg_skripsi->get($tahun_akademik_id)->result_array();
		$data['g_dosen']       = $this->dsn->get()->result_array();
		$data['g_thn_akdmk']   = $this->thn_akdmk->get()->result_array();
		$data['g_waktu']       = $this->waktu->get()->result_array();

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

		$html = $this->load->view('cetak/jdw_skripsi', $data, TRUE);

		$title_page = 'LAPORAN_PENGUJI_SIDANG_SKRIPSI' . $smt;
		$this->pdf->pdf_create($html, $title_page, 'A4', 'landscape');
	}

	private function rules_edit()
	{
		$this->form_validation->set_rules('dpj_satu', 'Dosen Penguji I', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('dpj_dua', 'Dosen Penguji II', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('dpj_tiga', 'Dosen Penguji III', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
}/* /. class */
