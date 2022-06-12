<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Proposal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('User_m', 'user');
		$this->load->model('Proposal_m', 'proposal');
		$this->load->model('Sdg_proposal_m', 'sdg_ppsal');
		$this->load->model('Sdg_skripsi_m', 'sdg_skripsi');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Jadwal_reg_m', 'jdw_reg');
	}

	function index()
	{
		$text = "Data Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                           = $this->session->userdata('npm');
		$data['g_proposal']            = $this->proposal->get($npm)->result_array();
		$data['g_sdg_ppsal_id']        = $this->sdg_ppsal->get($npm)->row_array();
		$data['g_sdg_skripsi_id']      = $this->sdg_skripsi->get($npm)->row_array();
		$data['g_dosen']               = $this->dsn->get()->result_array();

		$data['g_jdw_reg_proposal'] = $this->jdw_reg->get_jdw_proposal()->row_array();

		$this->template->load('template', 'proposal/proposal_data', $data);
	}

	function daftar()
	{
		$text = "Pendaftaran Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                 = $this->session->userdata('npm');
		$data['g_mhs_id']    = $this->user->get($npm)->row_array();
		$data['g_thn_akdmk'] = $this->thn_akdmk->now()->row_array();

		//cek data
		$query = $this->proposal->get($npm);
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Maaf, Anda sudah terdaftar !</center></div>');
			redirect('proposal', 'refresh');
		} else {
			if (isset($_POST["daftar"])) {
				$this->rules_add();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'proposal/proposal_daftar', $data);
				} else {
					$post   = $this->input->post(null, true);
					$id_mhs = $post['npm'];

					// $nm = @$_FILES['file_proposal']['name'];
					// @chmod(dirname('./assets/dokumen/proposal/'),0777);
					$config['upload_path']   = './assets/dokumen/proposal/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']      = 10240; /* 1024*10 = 10240KB */
					$config['file_name']     = $id_mhs . '_Proposal_' . date('d-m-y');

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (@$_FILES['file_proposal']['name'] != null) {
						if ($this->upload->do_upload('file_proposal')) {
							$post['proposal'] = $this->upload->data('file_name');
							$this->proposal->add($post);

							if ($this->db->affected_rows() > 0) {
								$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Form berhasil didaftarkan.</center></div>');
								redirect('proposal', 'refresh');
							}
						} else {
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"></i> ' . $error . '</center></div>');
							redirect('proposal/daftar', 'refresh');
						}
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"></i> File Proposal Skripsi belum dipilih, file harus di upload!</center></div>');
						redirect('proposal/daftar', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'proposal/proposal_daftar', $data);
			}
		}
	}

	function daftar_ulang()
	{
		$text = "Pendaftaran Ulang Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// Get data
		$npm                 = $this->session->userdata('npm');
		$data['g_mhs_id']    = $this->user->get($npm)->row_array();
		$data['g_thn_akdmk'] = $this->thn_akdmk->now()->row_array();
		$g_sdg_ppsal_id      = $this->sdg_ppsal->get($npm)->row_array();
		$g_sdg_skripsi_id    = $this->sdg_skripsi->get($npm)->row_array();

		//cek data
		$query = $this->proposal->get($npm)->num_rows();
		if ($query < 1) {
			redirect('E404', 'refresh');
		} else {
			if (isset($_POST["daftar"])) {
				$this->rules_add();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'proposal/proposal_daftar', $data);
				} else {
					$post   = $this->input->post(null, true);
					$id_mhs = $post['npm'];

					$config['upload_path']   = './assets/dokumen/proposal/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']      = 10240; /* 1024*10 = 10240KB */
					$config['file_name']     = $id_mhs . '_Proposal_' . date('d-m-y');

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (@$_FILES['file_proposal']['name'] != null) {
						if ($this->upload->do_upload('file_proposal')) {
							// daftar ulang
							$sdg_ppsal_id                = $g_sdg_ppsal_id['sdg_proposal_id'];
							$daftar_ulang_sdg_ppsal_id   = $g_sdg_ppsal_id['daftar_ulang'];
							$sdg_skripsi_id              = $g_sdg_skripsi_id['sdg_skripsi_id'];
							$daftar_ulang_sdg_skripsi_id = $g_sdg_skripsi_id['daftar_ulang'];

							// sdg_proposal
							if ($daftar_ulang_sdg_ppsal_id == 1) {
								$post['daftar_ulang_sdg_proposal'] = 2;
								$this->sdg_ppsal->daftar_ulang($sdg_ppsal_id, $post);
							}
							// sdg_skripsi
							elseif ($daftar_ulang_sdg_skripsi_id == 1) {
								$post['daftar_ulang_sdg_proposal'] = 2;
								$post['daftar_ulang_sdg_skripsi'] = 2;
								$this->sdg_ppsal->daftar_ulang($sdg_ppsal_id, $post);
								$this->sdg_skripsi->daftar_ulang($sdg_skripsi_id, $post);
							}

							$post['proposal'] = $this->upload->data('file_name');
							$this->proposal->add($post);

							if ($this->db->affected_rows() > 0) {
								$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Form berhasil didaftarkan.</center></div>');
								redirect('proposal', 'refresh');
							}
						} else {
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"></i> ' . $error . '</center></div>');
							redirect('proposal/daftar_ulang', 'refresh');
						}
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"></i> File Proposal Skripsi belum dipilih, file harus di upload!</center></div>');
						redirect('proposal/daftar_ulang', 'refresh');
					}
				}
			} else {
				$this->template->load('template', 'proposal/proposal_daftar', $data);
			}
		}
	}

	function detail()
	{
		$text = "Detail Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$proposal_id = $this->input->post('proposal_id');

		// get data
		$query = $this->proposal->get_id($proposal_id);
		if ($query->num_rows() > 0) {
			$data['g_proposal_id'] = $query->row_array();
			$data['g_dosen']       = $this->dsn->get()->result_array();
			$data['g_bbg_id']      = $this->proposal->bimbingan($proposal_id)->row_array();

			$this->template->load('template', 'proposal/proposal_detail', $data);
		} else {
			redirect('E404', 'refresh');
		}
	}

	function revisi()
	{
		$text = "Revisi Data Proposal Skripsi";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		if (!isset($_POST["revisi_proposal"])) {
			redirect('dashboard', 'refresh');
		} else {

			$npm                   = $this->session->userdata('npm');
			$g_proposal_id         = $this->proposal->get($npm)->row_array();
			$data['g_dosen']       = $this->dsn->get()->result_array();
			if (isset($g_proposal_id)) {
				$proposal_id           = $g_proposal_id['proposal_id'];
				$data['g_proposal_id'] = $this->proposal->get_id($proposal_id)->row_array();
				$data['g_bbg_id']      = $this->proposal->bimbingan($proposal_id)->row_array();
			}
			$data['g_mhs_id']    = $this->user->get($npm)->row_array();
			$data['g_thn_akdmk'] = $this->thn_akdmk->now()->row_array();

			if (isset($_POST["revisi"])) {
				$this->rules_revisi();

				if ($this->form_validation->run() == FALSE) {
					$this->template->load('template', 'proposal/proposal_revisi', $data);
				} else {
					$post        = $this->input->post(null, true);
					$proposal_id = $post['proposal_id'];

					$config['upload_path']   = './assets/dokumen/proposal/';
					$config['allowed_types'] = 'pdf';
					$config['max_size']      = 10240; /* 1024*10 = 10240KB */
					$config['file_name']     = $post['npm'] . '_Proposal_' . date('d-m-y');

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if (@$_FILES['file_proposal']['name'] != null) {
						if ($this->upload->do_upload('file_proposal')) {
							$user = $this->user->get($proposal_id)->row_array();

							if ($user['proposal'] != null) {
								$target_file = './assets/dokumen/proposal/' . $user['proposal'];
								unlink($target_file);
							}

							$post['proposal'] = $this->upload->data('file_name');
							$this->proposal->revisi($post, $proposal_id);

							if ($this->db->affected_rows() > 0) {
								$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Data berhasil direvisi.</center></div>');
								redirect('proposal', 'refresh');
							}
						} else {
							$error = $this->upload->display_errors();
							$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"></i> ' . $error . '</center></div>');
							redirect('proposal/revisi', 'refresh');
						}
					} else {
						$this->proposal->revisi($post, $proposal_id);
						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"></i> Data berhasil direvisi.</center></div>');
							redirect('proposal', 'refresh');
						}
					}
				}
			} else {
				$this->template->load('template', 'proposal/proposal_revisi', $data);
			}
		}
	}

	private function rules_add()
	{
		$this->form_validation->set_rules('kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required|numeric');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('judul_proposal', 'Judul Proposal Skripsi', 'required');

		$this->form_validation->set_message('numeric', '{field} harus berupa angka !');
		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	private function rules_revisi()
	{
		$this->form_validation->set_rules('kelas', 'Kelas', 'required');
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required|numeric');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('judul_proposal', 'Judul Proposal Skripsi', 'required');

		$this->form_validation->set_message('numeric', '{field} harus berupa angka !');
		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /. class */
