<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Mahasiswa_m', 'mhs');
		$this->load->model('Agama_m', 'agama');
		$this->load->model('Prodi_m', 'prodi');
	}

	public function index()
	{
		$text = "Mahasiswa";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_mhs'] = $this->mhs->get()->result_array();

		$this->template->load('template', 'mahasiswa/mahasiswa_data', $data);
	}


	function add()
	{
		$text = "Tambah Data Mahasiswa";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_agama'] = $this->agama->get()->result_array();
		$data['g_prodi'] = $this->prodi->get()->result_array();

		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'mahasiswa/mahasiswa_form_add', $data);
			} else {
				$post = $this->input->post(null, true);

				$config['upload_path']   = './../upload/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 2048;
				$config['file_name']     = 'mhs' . '_' . date('ymd') . '_' . substr(md5(rand()), 0, 10);

				$this->load->library('upload', $config);

				if (@$_FILES['foto']['name'] != null) {
					if ($this->upload->do_upload('foto')) {
						$post['foto'] = $this->upload->data('file_name');
						$this->mhs->add($post);

						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
							redirect('mahasiswa', 'refresh');
						}
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center>' . $error . '</center></div>');
						redirect('mahasiswa/add', 'refresh');
					}
				} else {
					$this->mhs->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
						redirect('mahasiswa', 'refresh');
					}
				}
			}
		} else {
			$this->template->load('template', 'mahasiswa/mahasiswa_form_add', $data);
		}
	}

	function detail()
	{
		$text = "Detail Data Mahasiswa";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$npm   = $this->input->post('npm');

		$query = $this->mhs->get($npm);
		if ($query->num_rows() > 0) {
			$data['mhs_id'] = $query->row_array();
			$this->template->load('template', 'mahasiswa/mahasiswa_form_detail', $data);
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('mahasiswa', 'refresh');
		}
	}

	function edit()
	{
		$text = "Edit Data Mahasiswa";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_agama'] = $this->agama->get()->result_array();
		$data['g_prodi'] = $this->prodi->get()->result_array();

		// post data
		$npm   = $this->input->post('npm');

		$query = $this->mhs->get($npm);
		if ($query->num_rows() > 0) {
			$data['mhs_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('mahasiswa', 'refresh');
		}

		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'mahasiswa/mahasiswa_form_edit', $data);
			} else {
				$post = $this->input->post(null, true);

				$config['upload_path']   = './../upload/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 2048;
				$config['file_name']     = 'mhs' . '_' . date('ymd') . '_' . substr(md5(rand()), 0, 10);

				$this->load->library('upload', $config);

				if (@$_FILES['foto']['name'] != null) {
					if ($this->upload->do_upload('foto')) {
						$post['foto'] = $this->upload->data('file_name');
						$this->mhs->edit($post, $npm);

						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
							redirect('mahasiswa', 'refresh');
						}
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center>' . $error . '</center></div>');
						redirect('mahasiswa', 'refresh');
					}
				} else {
					$this->mhs->edit($post, $npm);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
						redirect('mahasiswa', 'refresh');
					}
				}
			}
		} else {
			$this->template->load('template', 'mahasiswa/mahasiswa_form_edit', $data);
		}
	}

	function delete()
	{
		$npm  = $this->input->post('npm');
		$user = $this->mhs->get($npm)->row_array();
		if ($user['foto'] != null) {
			$target_file = './../upload/' . $user['foto'];
			unlink($target_file);
		}

		$this->mhs->delete($npm);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			redirect('mahasiswa', 'refresh');
		}
	}

	private function rules_add()
	{
		$this->form_validation->set_rules('npm', 'NPM', 'required|trim|numeric|is_unique[mahasiswa.npm]|exact_length[12]', array('exact_length' => '%s harus 12 digit angka !', 'is_unique' => '%s sudah terdaftar !'));
		$this->form_validation->set_rules('prodi_id', 'Prodi', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('nama_lkp', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('agama', 'Agama', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[16]', array('min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		$this->form_validation->set_rules('password_konf', 'Password Konfirmasi', 'required|trim|matches[password]|min_length[6]|max_length[16]', array('matches' => '%s tidak sesuai dengan Password', 'min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		$this->form_validation->set_rules('status', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	private function rules_edit()
	{
		$this->form_validation->set_rules('prodi_id', 'Prodi', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('nama_lkp', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('agama', 'Agama', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'required');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', array('valid_email' => '%s tidak valid !'));

		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]|max_length[16]', array('min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		}

		if ($this->input->post('password_konf')) {
			$this->form_validation->set_rules('password_konf', 'Password Konfirmasi', 'required|trim|matches[password]|min_length[6]|max_length[16]', array('matches' => '%s tidak sesuai dengan Password', 'min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		}

		$this->form_validation->set_rules('status', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /.class */
