<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Proposal_m', 'proposal');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->library('Pdf');
	}

	function index()
	{
		$text = "Data Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();

		$this->template->load('template', 'proposal/proposal', $data);
	}

	function data()
	{
		$text = "Data Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_proposal']          = $this->proposal->get($tahun_akademik_id)->result_array();

		$this->template->load('template', 'proposal/proposal_data', $data);
	}

	function detail()
	{
		$text = "Detail Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);
		// post data
		$proposal_id       = $this->input->post('proposal_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_bbg_id']            = $this->proposal->bimbingan($proposal_id)->row_array();

		$query = $this->proposal->get_id($proposal_id);
		if ($query->num_rows() > 0) {
			$data['g_dosen']       = $this->dsn->get()->result_array();
			$data['g_proposal_id'] = $query->row_array();
			$this->template->load('template', 'proposal/proposal_detail', $data);
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('proposal/data', 'refresh');
		}
	}

	function revisi()
	{
		$proposal_id       = $this->input->post('proposal_id');

		$this->proposal->revisi($proposal_id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil direvisi.</center></div>');
			$this->data();
		}
	}

	function delete()
	{
		$proposal_id       = $this->input->post('proposal_id');
		$user              = $this->proposal->get_id($proposal_id)->row_array();

		if ($user['proposal'] != null) {
			$target_file = './../assets/dokumen/proposal/' . $user['proposal'];
			unlink($target_file);
		}
		$this->proposal->delete($proposal_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			// redirect('proposal','refresh');
			$this->data();
		}
	}

	function laporan()
	{
		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_proposal']  = $this->proposal->laporan($tahun_akademik_id)->result_array();
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

		$html = $this->load->view('cetak/proposal', $data, TRUE);

		$title_page = 'LAPORAN_PROPOSAL_SKRIPSI' . $smt;
		$this->pdf->pdf_create($html, $title_page, 'A4', 'landscape');
	}
}/* /.class */
