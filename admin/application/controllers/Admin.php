<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->model('Admin_m', 'adm');
		$this->load->model('Agama_m', 'agama');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$text = "Admin";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_admin'] = $this->adm->get()->result_array();

		$this->template->load('template', 'admin/admin_data', $data);
	}

	function add()
	{
		$text = "Tambah Data Admin";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_agama'] = $this->agama->get()->result_array();


		if (isset($_POST["tambah"])) {
			$this->rules_add();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'admin/admin_form_add', $data);
			} else {
				$post = $this->input->post(null, true);

				$config['upload_path']   = './upload/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 2048;
				$config['file_name']     = 'adm' . '_' . date('ymd') . '_' . substr(md5(rand()), 0, 10);

				$this->load->library('upload', $config);

				if (@$_FILES['foto']['name'] != null) {
					if ($this->upload->do_upload('foto')) {
						$post['foto'] = $this->upload->data('file_name');
						$this->adm->add($post);

						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
							redirect('admin', 'refresh');
						}
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center>' . $error . '</center></div>');
						redirect('admin/add', 'refresh');
					}
				} else {
					$this->adm->add($post);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil ditambah.</center></div>');
						redirect('admin', 'refresh');
					}
				}
			}
		} else {
			$this->template->load('template', 'admin/admin_form_add', $data);
		}
	}

	function detail()
	{
		$text = "Detail Data admin";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_agama'] = $this->agama->get()->result_array();

		// post data
		$nip = $this->input->post('nip');

		$query = $this->adm->get($nip);
		if ($query->num_rows() > 0) {
			$data['admin_id'] = $query->row_array();
			$this->template->load('template', 'admin/admin_form_detail', $data);
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('admin', 'refresh');
		}
	}

	function edit()
	{
		$text = "Edit Data admin";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['agama'] = $this->agama->get()->result_array();

		// post data
		$nip   = $this->input->post('nip');

		$query = $this->adm->get($nip);
		if ($query->num_rows() > 0) {
			$data['admin_id'] = $query->row_array();
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('admin', 'refresh');
		}


		if (isset($_POST["edit"])) {
			$this->rules_edit();

			if ($this->form_validation->run() == FALSE) {
				$this->template->load('template', 'admin/admin_form_edit', $data);
			} else {
				$post = $this->input->post(null, true);

				$config['upload_path']   = './upload/';
				$config['allowed_types'] = 'jpg|jpeg|png';
				$config['max_size']      = 2048;
				$config['file_name']     = 'adm' . '_' . date('ymd') . '_' . substr(md5(rand()), 0, 10);

				$this->load->library('upload', $config);

				if (@$_FILES['foto']['name'] != null) {
					if ($this->upload->do_upload('foto')) {
						$user = $this->adm->get($nip)->row_array();
						if ($user['foto'] != null) {
							$target_file = './upload/' . $user['foto'];
							unlink($target_file);
						}

						$post['foto'] = $this->upload->data('file_name');
						$this->adm->edit($post, $nip);

						if ($this->db->affected_rows() > 0) {
							$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
							redirect('admin', 'refresh');
						}
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center>' . $error . '</center></div>');
						redirect('admin', 'refresh');
					}
				} else {
					$this->adm->edit($post, $nip);
					if ($this->db->affected_rows() > 0) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil diedit.</center></div>');
						redirect('admin', 'refresh');
					}
				}
			}
		} else {
			$this->template->load('template', 'admin/admin_form_edit', $data);
		}
	}

	function delete()
	{
		$nip  = $this->input->post('nip');
		$user = $this->adm->get($nip)->row_array();
		if ($user['foto'] != null) {
			$target_file = './upload/' . $user['foto'];
			unlink($target_file);
		}

		$this->adm->delete($nip);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			redirect('admin', 'refresh');
		}
	}

	private function rules_add()
	{
		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|numeric|min_length[7]|max_length[10]|is_unique[admin.nip]', array('min_length' => '%s minimal 7 digit angka !', 'max_length' => '%s maximal 10 digit angka !'));
		$this->form_validation->set_rules('nama_lkp', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('agama', 'Agama', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'numeric');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]', array('min_length' => '%s minimal 6 karakter!', 'max_length' => '%s maximal 16 karakter !'));
		$this->form_validation->set_rules('password_konf', 'Password Konfirmasi', 'trim|required|matches[password]|min_length[6]|max_length[16]', array('matches' => '%s tidak sesuai dengan Password', 'min_length' => '%s minimal 6 karakter!', 'max_length' => '%s maximal 16 karakter !'));
		$this->form_validation->set_rules('role', 'Role', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('status', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar !!!');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}

	private function rules_edit()
	{
		$this->form_validation->set_rules('nama_lkp', 'Nama Lengkap', 'required');
		$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('agama', 'Agama', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('no_telp', 'No. Telp', 'numeric');
		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email', array('valid_email' => '%s tidak valid !'));
		if ($this->input->post('password')) {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]|max_length[16]', array('min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		}
		if ($this->input->post('password_konf')) {
			$this->form_validation->set_rules('password_konf', 'Password Konfirmasi', 'trim|required|matches[password]|min_length[6]|max_length[16]', array('matches' => '%s tidak sesuai dengan Password', 'min_length' => '%s minimal 6 karakter !', 'max_length' => '%s maximal 16 karakter !'));
		}
		$this->form_validation->set_rules('role', 'Role', 'required', array('required' => '%s harus dipilih !'));
		$this->form_validation->set_rules('status', 'Status', 'required', array('required' => '%s harus dipilih !'));

		$this->form_validation->set_message('required', '{field} masih kosong, silahkan diisi !');
		$this->form_validation->set_message('is_unique', '{field} sudah terdaftar !!!');

		$this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');
	}
} /* /.class */
