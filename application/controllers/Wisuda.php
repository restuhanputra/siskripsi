<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Wisuda extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('User_m', 'user');
		$this->load->model('Sdg_skripsi_m', 'sdg_skripsi');
		$this->load->model('Wisuda_m', 'wisuda');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Jadwal_reg_m', 'jdw_reg');
	}

	public function index()
	{
		$text = "Data Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                      = $this->session->userdata('npm');
		$data['g_sdg_skripsi_id'] = $this->sdg_skripsi->get($npm)->row_array();
		$data['g_wisuda']         = $this->wisuda->get($npm)->result_array();
		$data['g_dosen']          = $this->dsn->get()->result_array();
		$data['g_waktu']          = $this->waktu->get()->result_array();

		$data['g_jdw_reg_wisuda'] = $this->jdw_reg->get_jdw_wisuda()->row_array();

		$this->template->load('template', 'wisuda/wisuda_data', $data);
	}

	// function index()
	function daftar()
	{
		$text = "Pendaftaran Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                      = $this->session->userdata('npm');
		$data['g_sdg_skripsi_id'] = $this->sdg_skripsi->get($npm)->row_array();
		$data['g_thn_akdmk']      = $this->thn_akdmk->now()->row_array();
		$data['g_waktu']          = $this->waktu->get()->result_array(); //utk tgl_sdg

		//cek data
		$query = $this->wisuda->get($npm);
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Maaf, Anda sudah terdaftar !</center></div>');
			redirect('wisuda', 'refresh');
		} else {
			if (isset($_POST["daftar"])) {
				$this->rules();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'wisuda/wisuda_daftar', $data);
				} else {
					$post   = $this->input->post(null, true);
					$this->wisuda->add($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Form berhasil didaftarkan.</center></div>');
						redirect('wisuda', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'wisuda/wisuda_daftar', $data);
			}
		}
	}

	function detail()
	{
		$text = "Detail Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$wisuda_id = $this->input->post('wisuda_id');

		// get data
		$query = $this->wisuda->get_id($wisuda_id);
		if ($query->num_rows() > 0) {
			$g_wisuda_id         = $query->row_array();
			$proposal_id         = $g_wisuda_id['proposal_id'];
			$data['g_wisuda_id'] = $g_wisuda_id;
			$data['g_dosen']     = $this->dsn->get()->result_array();
			$data['g_bbg_id']    = $this->wisuda->bimbingan($proposal_id)->row_array();
			$data['g_waktu']     = $this->waktu->get()->result_array();

			$this->template->load('template', 'wisuda/wisuda_detail', $data);
		} else {
			redirect('e404', 'refresh');
		}
	}

	function revisi()
	{
		$text = "Revisi Data Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                      = $this->session->userdata('npm');
		$data['g_sdg_skripsi_id'] = $this->sdg_skripsi->get($npm)->row_array();
		$g_wisuda_id              = $this->wisuda->get($npm)->row_array();
		$data['g_dosen']          = $this->dsn->get()->result_array();
		$data['g_waktu']          = $this->waktu->get()->result_array();

		if (isset($g_wisuda_id)) {
			$proposal_id          = $g_wisuda_id['proposal_id'];
			$wisuda_id           = $g_wisuda_id['wisuda_id'];
			$data['g_wisuda_id'] = $this->wisuda->get_id($wisuda_id)->row_array();
			$data['g_bbg_id']    = $this->sdg_skripsi->bimbingan($proposal_id)->row_array();
		}

		$data['g_thn_akdmk']     = $this->thn_akdmk->now()->row_array();

		if (!isset($_POST["revisi_wisuda"])) {
			redirect('dashboard', 'refresh');
		} else {
			if (isset($_POST["revisi"])) {
				$this->rules();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'wisuda/wisuda_revisi', $data);
				} else {
					$post      = $this->input->post(null, true);
					$wisuda_id = $post['wisuda_id'];
					$this->wisuda->revisi($post, $wisuda_id);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Data berhasil direvisi.</center></div>');
						redirect('wisuda', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'wisuda/wisuda_revisi', $data);
			}
		}
	}

	private function rules()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		$this->form_validation->set_rules('sma_smk', 'Asal SMA/SMK', 'required');
		$this->form_validation->set_rules('lulus_sma_smk', 'Tahun Lulus SMA/SMK', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat Lengkap', 'required');
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required|numeric');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		$this->form_validation->set_rules('judul_skripsi_ina', 'Judul Skripsi (B. Indonesia)', 'required');
		$this->form_validation->set_rules('judul_skripsi_eng', 'Judul Skripsi (B. Inggris)', 'required');

		$this->form_validation->set_message('numeric', '{field} harus berupa angka !');
		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
}  /* /. class */
