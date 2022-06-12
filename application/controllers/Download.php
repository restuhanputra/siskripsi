<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Download extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		checkNotLogin();
		$this->load->helper('download');
	}

	function penulisan_ta()
	{
		$file = 'Pedoman_Teknis_Penulisan_TA_Ubhara_Jaya_2017.pdf';
		$path = './assets/dokumen/' . $file;
		$data = file_get_contents($path);
		$name = $file;
		force_download($name, $data);
	}
}/* /. class */
