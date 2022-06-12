<?php
/* Login*/
function checkAlreadyLogin()
{
	$ci = get_instance();
	if ($ci->session->userdata('nip')) {
		redirect('dashboard');
		exit();
	}
}

function checkNotLogin()
{
	$ci = get_instance();
	if (!$ci->session->userdata('nip')) {
		redirect('auth');
		exit();
	}
}

/* SQL injection */
function blockSQLInjection($string)
{
	// trim untuk hapus spasi
	// xss:  strip_tags utk stripping html & php tags / htmlspecialchars
	// return strip_tags(trim($string));
	// stripslashes utk hapus '\'
	return stripslashes(strip_tags(trim(htmlspecialchars($string, ENT_QUOTES))));
}

/* XSS Filtering */
function xss($string)
{
	return strip_tags(htmlspecialchars($string, ENT_QUOTES));
}

if (!function_exists('bulan')) {
	function bulan_romawi($bln)
	{
		switch ($bln) {
			case 1:
				return "I";
				break;
			case 2:
				return "II";
				break;
			case 3:
				return "III";
				break;
			case 4:
				return "IV";
				break;
			case 5:
				return "V";
				break;
			case 6:
				return "VI";
				break;
			case 7:
				return "VII";
				break;
			case 8:
				return "VIII";
				break;
			case 9:
				return "IX";
				break;
			case 10:
				return "X";
				break;
			case 11:
				return "XI";
				break;
			case 12:
				return "XII";
				break;
		}
	}
}

if (!function_exists('tgl_indo')) {
	function date_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pecah = explode("-", $ubah);
		$tanggal = $pecah[2];
		$bulan = bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . ' ' . $bulan . ' ' . $tahun;
	}
}

if (!function_exists('bulan')) {
	function bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}

//Format Shortdate
if (!function_exists('shortdate_indo')) {
	function shortdate_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pecah = explode("-", $ubah);
		$tanggal = $pecah[2];
		$bulan = short_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . '/' . $bulan . '/' . $tahun;
	}
}

if (!function_exists('short_bulan')) {
	function short_bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "01";
				break;
			case 2:
				return "02";
				break;
			case 3:
				return "03";
				break;
			case 4:
				return "04";
				break;
			case 5:
				return "05";
				break;
			case 6:
				return "06";
				break;
			case 7:
				return "07";
				break;
			case 8:
				return "08";
				break;
			case 9:
				return "09";
				break;
			case 10:
				return "10";
				break;
			case 11:
				return "11";
				break;
			case 12:
				return "12";
				break;
		}
	}
}

//Format Medium date
if (!function_exists('mediumdate_indo')) {
	function mediumdate_indo($tgl)
	{
		$ubah = gmdate($tgl, time() + 60 * 60 * 8);
		$pecah = explode("-", $ubah);
		$tanggal = $pecah[2];
		$bulan = medium_bulan($pecah[1]);
		$tahun = $pecah[0];
		return $tanggal . ' ' . $bulan . ' ' . $tahun;
	}
}

if (!function_exists('medium_bulan')) {
	function medium_bulan($bln)
	{
		switch ($bln) {
			case 1:
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	}
}
