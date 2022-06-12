<?php
defined('BASEPATH') or exit('No direct script access allowed');

//load phpspreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class Wisuda extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->library('form_validation');
		$this->load->model('Wisuda_m', 'wisuda');
		$this->load->model('Dosen_m', 'dsn');
		$this->load->model('Waktu_m', 'waktu');
		$this->load->model('Tahun_akademik_m', 'thn_akdmk');
		$this->load->model('Prodi_m', 'prodi');
	}

	function index()
	{
		$text = "Data Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// get data
		$data['g_thn_akdmk'] = $this->thn_akdmk->get()->result_array();

		$this->template->load('template', 'wisuda/wisuda', $data);
	}

	function data()
	{
		$text = "Data Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);

		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;
		$data['g_wisuda']            = $this->wisuda->get($tahun_akademik_id)->result_array();

		$this->template->load('template', 'wisuda/wisuda_data', $data);
	}

	function detail()
	{
		$text = "Detail Data Wisuda";
		$data = array(
			'h_title' => strtoupper($text),
			'title'   => ucfirst($text)
		);
		// post data
		$wisuda_id         = $this->input->post('wisuda_id');
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$data['g_tahun_akademik_id'] = $tahun_akademik_id;

		$query = $this->wisuda->get_id($wisuda_id);
		if ($query->num_rows() > 0) {
			$g_wisuda_id         = $query->row_array();
			$proposal_id         = $g_wisuda_id['proposal_id'];
			$data['g_wisuda_id'] = $g_wisuda_id;
			$data['g_bbg_id']    = $this->wisuda->bimbingan($proposal_id)->row_array();
			$data['g_dosen']     = $this->dsn->get()->result_array();

			$this->template->load('template', 'wisuda/wisuda_detail', $data);
		} else {
			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-warning"> </i>Data tidak ditemukan !</center></div>');
			redirect('wisuda/data', 'refresh');
		}
	}

	function revisi()
	{
		$wisuda_id = $this->input->post('wisuda_id');

		$this->wisuda->revisi($wisuda_id);
		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil direvisi.</center></div>');
			$this->data();
		}
	}

	function delete()
	{
		$wisuda_id = $this->input->post('wisuda_id');
		$this->wisuda->delete($wisuda_id);

		if ($this->db->affected_rows() > 0) {
			$this->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><center><i class="icon fa fa-check"> </i>Data berhasil dihapus.</center></div>');
			$this->data();
		}
	}

	function excel()
	{
		// post data
		$tahun_akademik_id = $this->input->post('tahun_akademik_id');

		// get data
		$wisuda      = $this->wisuda->laporan($tahun_akademik_id)->result_array();
		$dosen       = $this->dsn->get()->result_array();
		$g_thn_akdmk = $this->thn_akdmk->get()->result_array();

		$tahun_akademik = $tahun_akademik_id;
		$dsn            = $this->dsn->kaprodi()->row_array();
		$kaprodi        = $dsn['nama_lkp'];

		// semester
		$semester_id = $this->thn_akdmk->get($tahun_akademik_id)->row_array();
		$semester    = $semester_id['semester'];
		if ($semester == 1) {
			$smt = "(GANJIL)";
		} else {
			$mst = "(GENAP)";
		}

		// Tahun akademik
		foreach ($g_thn_akdmk as $data) {
			$tahun_akademikk   = $data['tahun_akademik_id'];
			$nama              = strtoupper($data['tahun']);
			$semester          = $data['semester'];

			if ($tahun_akademik == $tahun_akademikk) {
				$thun_akademik = $nama;
				if ($semester == 1) {
					$smt = "(GANJIL)";
				} else {
					$smt = "(GENAP)";
				}
			}
		}

		$spreadsheet = new Spreadsheet;

		$spreadsheet->getActiveSheet()->mergeCells('A1:Q1');

		// Judul
		$spreadsheet->getActiveSheet()->setCellValue('A1', 'LAPORAN WISUDA ' . $thun_akademik . ' ' . $smt . '');

		// header
		$spreadsheet->setActiveSheetIndex(0)
			->setCellValue('A3', 'No')
			->setCellValue('B3', 'Nama Lengkap')
			->setCellValue('C3', 'NPM')
			->setCellValue('D3', 'Prodi')
			->setCellValue('E3', 'NIK')
			->setCellValue('F3', 'Email')
			->setCellValue('G3', 'Alamat')
			->setCellValue('H3', 'Asal SMA/SMK')
			->setCellValue('I3', 'Tahun Lulus')
			->setCellValue('J3', 'Nama Ayah')
			->setCellValue('K3', 'Nama Ibu')
			->setCellValue('L3', 'No Telp')
			->setCellValue('M3', 'Dosen Pembimbing I')
			->setCellValue('N3', 'Dosen Pembimbing II')
			->setCellValue('O3', 'Tanggal Sidang')
			->setCellValue('P3', 'Judul Skripsi (B. Indonesia)')
			->setCellValue('Q3', 'Judul Skripsi (B. Inggris)');
		$kolom = 4;
		$nomor = 1;

		foreach ($wisuda as $data) {
			foreach ($dosen as $dsn) {
				$nidn     = $dsn['nidn'];
				$nama_dsn = strtoupper($dsn['nama_lkp']);

				if ($data['pbb_satu'] == $nidn) {
					$pbb_satuu = $nama_dsn;
				}
			}
			foreach ($dosen as $dsn) {
				$nidn     = $dsn['nidn'];
				$nama_dsn = strtoupper($dsn['nama_lkp']);

				if ($data['pbb_dua'] == $nidn) {
					$pbb_duaa = $nama_dsn;
				}
			}

			$spreadsheet->setActiveSheetIndex(0)
				->setCellValue('A' . $kolom, $nomor)
				->setCellValue('B' . $kolom, $data['nama_lkp'])
				->setCellValue('C' . $kolom, $data['npm'], NumberFormat::FORMAT_NUMBER)
				->setCellValue('D' . $kolom, $data['prodi_nama'])
				->setCellValue('E' . $kolom, $data['nik'], NumberFormat::FORMAT_NUMBER)
				->setCellValue('F' . $kolom, $data['email'])
				->setCellValue('G' . $kolom, $data['alamat_lkp'])
				->setCellValue('H' . $kolom, $data['sma_smk'])
				->setCellValue('I' . $kolom, $data['lulus_sma_smk'])
				->setCellValue('J' . $kolom, $data['nama_ayah'])
				->setCellValue('K' . $kolom, $data['nama_ibu'])
				->setCellValue('L' . $kolom, $data['no_telp'], NumberFormat::FORMAT_NUMBER)
				->setCellValue('M' . $kolom, $pbb_satuu)
				->setCellValue('N' . $kolom, $pbb_duaa)
				->setCellValue('O' . $kolom, $data['tanggal_sdg'])
				->setCellValue('P' . $kolom, $data['judul_skripsi_ina'])
				->setCellValue('Q' . $kolom, $data['judul_skripsi_eng']);

			$kolom++;
			$nomor++;
		}

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="LAPORAN_WISUDA' . $smt . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}
}/* /.class */
