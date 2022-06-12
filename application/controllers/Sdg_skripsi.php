<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdg_skripsi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('User_m', 'user');
		$this->load->model('Sdg_proposal_m', 'sdg_ppsal');
		$this->load->model('Sdg_skripsi_m', 'sdg_skripsi');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Jadwal_reg_m', 'jdw_reg');
	}

	public function index()
	{
		$text = "Data Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                      = $this->session->userdata('npm');
		$data['g_sdg_ppsal_id']   = $this->sdg_ppsal->get($npm)->row_array();
		$data['g_sdg_skripsi']    = $this->sdg_skripsi->get($npm)->result_array();
		$data['g_sdg_skripsi_id'] = $this->sdg_skripsi->get($npm)->row_array();
		$data['g_dosen']          = $this->dsn->get()->result_array();
		$data['g_waktu']          = $this->waktu->get()->result_array();

		$data['g_jdw_reg_sdg_skripsi'] = $this->jdw_reg->get_jdw_sdg_skripsi()->row_array();

		$this->template->load('template', 'sdg_skripsi/sdg_skripsi_data', $data);
	}

	public function daftar()
	{
		$text = "Pendaftaran Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                    = $this->session->userdata('npm');
		$data['g_sdg_ppsal_id'] = $this->sdg_ppsal->get($npm)->row_array();
		$data['g_thn_akdmk']    = $this->thn_akdmk->now()->row_array();

		//cek data
		$query = $this->sdg_skripsi->get($npm);
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Maaf, Anda sudah terdaftar !</center></div>');
			redirect('sdg_skripsi', 'refresh');
		} else {
			if (isset($_POST["daftar"])) {
				$this->rules();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'sdg_skripsi/sdg_skripsi_daftar', $data);
				} else {
					$post   = $this->input->post(null, true);
					$this->sdg_skripsi->add($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Form berhasil didaftarkan.</center></div>');
						redirect('sdg_skripsi', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'sdg_skripsi/sdg_skripsi_daftar', $data);
			}
		}
	}

	function daftar_ulang()
	{
		$text = "Pendaftaran Ulang Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                    = $this->session->userdata('npm');
		$data['g_sdg_ppsal_id'] = $this->sdg_ppsal->get($npm)->row_array();
		$data['g_thn_akdmk']    = $this->thn_akdmk->now()->row_array();
		$g_sdg_skripsi_id       = $this->sdg_skripsi->get($npm)->row_array();

		//cek data
		$query = $this->sdg_skripsi->get($npm)->row_array();
		if ($query['daftar_ulang'] == 3) {
			redirect('E404', 'refresh');
		} else {
			if (isset($_POST["daftar"])) {
				$this->rules();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'sdg_skripsi/sdg_skripsi_daftar', $data);
				} else {
					// daftar ulang
					$sdg_skripsi_id              = $g_sdg_skripsi_id['sdg_skripsi_id'];
					$daftar_ulang_sdg_skripsi_id = $g_sdg_skripsi_id['daftar_ulang'];
					// sdg_skripsi
					if ($daftar_ulang_sdg_skripsi_id == 2) {
						$post['daftar_ulang_sdg_skripsi'] = 3;
						$this->sdg_skripsi->daftar_ulang($sdg_skripsi_id, $post);
					}

					$post   = $this->input->post(null, true);
					$this->sdg_skripsi->add($post);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Form berhasil didaftarkan.</center></div>');
						redirect('sdg_skripsi', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'sdg_skripsi/sdg_skripsi_daftar', $data);
			}
		}
	}

	function detail()
	{
		$text = "Detail Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$sdg_skripsi_id = $this->input->post('sdg_skripsi_id');

		// get data
		$query = $this->sdg_skripsi->get_id($sdg_skripsi_id);
		if ($query->num_rows() > 0) {
			$g_sdg_skripsi_id         = $query->row_array();
			$proposal_id              = $g_sdg_skripsi_id['proposal_id'];
			$data['g_sdg_skripsi_id'] = $g_sdg_skripsi_id;
			$data['g_dosen']          = $this->dsn->get()->result_array();
			$data['g_bbg_id']         = $this->sdg_skripsi->bimbingan($proposal_id)->row_array();
			$data['g_waktu']          = $this->waktu->get()->result_array();

			$this->template->load('template', 'sdg_skripsi/sdg_skripsi_detail', $data);
		} else {
			redirect('e404', 'refresh');
		}
	}

	function revisi()
	{
		$text = "Revisi Data Sidang Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		if (!isset($_POST["revisi_sdg_skripsi"])) {
			redirect('dashboard', 'refresh');
		} else {
			// Get data
			$npm                      = $this->session->userdata('npm');
			$data['g_sdg_ppsal_id']   = $this->sdg_ppsal->get($npm)->row_array();
			$g_sdg_skripsi_id         = $this->sdg_skripsi->get($npm)->row_array();
			$data['g_dosen']          = $this->dsn->get()->result_array();
			$data['g_waktu']          = $this->waktu->get()->result_array();

			if (isset($g_sdg_skripsi_id)) {
				$proposal_id              = $g_sdg_skripsi_id['proposal_id'];
				$sdg_skripsi_id           = $g_sdg_skripsi_id['sdg_skripsi_id'];
				$data['g_sdg_skripsi_id'] = $this->sdg_skripsi->get_id($sdg_skripsi_id)->row_array();
				$data['g_bbg_id']         = $this->sdg_skripsi->bimbingan($proposal_id)->row_array();
			}

			$data['g_thn_akdmk']    = $this->thn_akdmk->now()->row_array();

			if (isset($_POST["revisi"])) {
				$this->rules();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'sdg_skripsi/sdg_skripsi_revisi', $data);
				} else {
					$post           = $this->input->post(null, true);
					$sdg_skripsi_id = $post['sdg_skripsi_id'];
					$this->sdg_skripsi->revisi($post, $sdg_skripsi_id);

					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Data berhasil direvisi.</center></div>');
						redirect('sdg_skripsi', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'sdg_skripsi/sdg_skripsi_revisi', $data);
			}
		}
	}

	private function rules()
	{
		$this->form_validation->set_rules('tmpt_lahir', 'Tempat Lahir', 'required');
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal lahir', 'required');
		$this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'required');
		$this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'required');
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required|numeric');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('judul_skripsi', 'Judul Skripsi', 'required');
		$this->form_validation->set_message('numeric', '{field} harus berupa angka !');
		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /. class */
