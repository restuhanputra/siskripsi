<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_proposal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Sdg_proposal_m', 'sdg_ppsal');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->library('Pdf');
	}

	function index()
	{
		$text = "Data Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();

		$this->template->load('template', 'sdg_proposal/sdg_proposal', $data);
	}

	function data()
	{
		$text = "Data Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_sdg_ppsal']         = $this->sdg_ppsal->get($tahun_akademik_id)->result_array();

		$this->template->load('template', 'sdg_proposal/sdg_proposal_data', $data);
	}

	function detail()
	{
		$text = "Detail Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);
		// post data
		$sdg_proposal_id   = $this->input->post('sdg_proposal_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');


		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_waktu']             = $this->waktu->get()->result_array();

		$query = $this->sdg_ppsal->get_id($sdg_proposal_id);
		if ($query->num_rows() > 0) {
			$g_sdg_ppsal_id         = $query->row_array();
			$proposal_id            = $g_sdg_ppsal_id['proposal_id'];
			$data['g_sdg_ppsal_id'] = $g_sdg_ppsal_id;
			$data['g_bbg_id']       = $this->sdg_ppsal->bimbingan($proposal_id)->row_array();
			$data['g_dosen']        = $this->dsn->get()->result_array();
			$this->template->load('template', 'sdg_proposal/sdg_proposal_detail', $data);
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('sdg_proposal/data', 'refresh');
		}
	}

	function revisi()
	{
		$sdg_proposal_id = $this->input->post('sdg_proposal_id');

		$this->sdg_ppsal->revisi($sdg_proposal_id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil direvisi.</center></div>');
			$this->data();
		}
	}

	function status()
	{
		$text = "Status Sidang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);
		// post data
		$sdg_proposal_id   = $this->input->post('sdg_proposal_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');


		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_waktu']             = $this->waktu->get()->result_array();

		$query = $this->sdg_ppsal->get_id($sdg_proposal_id);
		if ($query->num_rows() > 0) {
			$data['g_sdg_ppsal_id'] = $query->row_array();
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();
			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'sdg_proposal/sdg_proposal_status', $data);
			} else {
				$post            = $this->input->post(null, true);
				$sdg_proposal_id = $post['sdg_proposal_id'];

				$this->sdg_ppsal->edit($post, $sdg_proposal_id);
				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Status berhasil diedit.</center></div>');
					$this->data();
				}
			}
		} else {
			$this->template->load('template', 'sdg_proposal/sdg_proposal_status', $data);
		}
	}

	function delete()
	{
		$sdg_proposal_id = $this->input->post('sdg_proposal_id');
		$this->sdg_ppsal->delete($sdg_proposal_id);

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
		$data['g_sdg_ppsal'] = $this->sdg_ppsal->laporan($tahun_akademik_id)->result_array();
		$data['g_dosen']     = $this->dsn->get()->result_array();
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();

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

		$html = $this->load->view('cetak/sdg_proposal', $data, TRUE);

		$title_page = 'LAPORAN_SIDANG_PROPOSAL_SKRIPSI' . $smt;
		$this->pdf->pdf_create($html, $title_page, 'A4', 'landscape');
	}

	private function rules_edit()
	{
		$this->form_validation->set_rules('status', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
}/* /.class */
