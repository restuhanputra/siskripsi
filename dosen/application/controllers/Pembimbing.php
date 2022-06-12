<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembimbing extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Pembimbing_m', 'pbb');
		$this->load->model('Proposal_m', 'ppsal');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->library('Pdf');
	}

	public function index()
	{
		$text = "Dosen Pembimbing Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();

		$this->template->load('template', 'pembimbing/pembimbing', $data);
	}

	function data()
	{
		$text = "Data Dosen Pembimbing Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_pembimbing']        = $this->pbb->get($tahun_akademik_id)->result_array();
		$data['g_dosen']             = $this->dsn->get()->result_array();

		$this->template->load('template', 'pembimbing/pembimbing_data', $data);
	}

	function add()
	{
		$text = "Tambah Dosen Pembimbing Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$g_thn_akdmk                 = $this->thn_akdmk->now()->row_array();
		$data['g_thn_akdmk']         = $g_thn_akdmk;
		$data['g_dosen']             = $this->dsn->get()->result_array();

		if (isset($g_thn_akdmk)) {
			$tahun_akademik_id   = $g_thn_akdmk['tahun_akademik_id'];
			$data['g_proposal']  = $this->ppsal->get_pbb($tahun_akademik_id)->result_array();
		}

		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'pembimbing/pembimbing_add', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->pbb->add($post);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
					$this->data();
				}
			}
		} else {
			$this->template->load('template', 'pembimbing/pembimbing_add', $data);
		}
	}

	function cari()
	{
		$npm    = $_GET['npm'];
		$mhs_id = $this->ppsal->get($npm)->result();
		echo json_encode($mhs_id);
	}

	function edit()
	{
		$text = "Edit Dosen Pembimbing Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$bimbingan_id      = $this->input->post('bimbingan_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_dosen']             = $this->dsn->get()->result_array();

		$query = $this->pbb->get_id($bimbingan_id);
		if ($query->num_rows() > 0) {
			$data['g_pembimbing_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			$this->data();
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'pembimbing/pembimbing_edit', $data);
			} else {
				$post = $this->input->post(null, true);
				$this->pbb->edit($post, $bimbingan_id);

				if ($this->db->affected_rows() > 0) {
					$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
					$this->data();
				}
			}
		} else {
			$this->template->load('template', 'pembimbing/pembimbing_edit', $data);
		}
	}

	function laporan()
	{
		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_bbg']       = $this->pbb->get($tahun_akademik_id)->result_array();
		$data['g_dosen']     = $this->dsn->get()->result_array();
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();
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

		$title_page = 'LAPORAN_PEMBIMBING_SKRIPSI' . $smt;
		$this->pdf->pdf_create($html, $title_page, 'A4', 'landscape');
	}

	private function rules_add()
	{
		$this->form_validation->set_rules('npm', 'NPM', 'required|numeric', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('proposal_idd', 'NPM', 'is_unique[bimbingan.proposal_id]');
		$this->form_validation->set_rules('pbb_satu', 'Dosen Pembimbing I', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('pbb_dua', 'Dosen Pembimbing II', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar !!!');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	private function rules_edit()
	{
		$this->form_validation->set_rules('pbb_satu', 'Dosen Pembimbing I', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('pbb_dua', 'Dosen Pembimbing II', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
}/* /. class */
