<?php
/* Login*/
function checkAlreadyLogin()
{
	$ci = get_instance();
	if ($ci->session->userdata('npm')) {
		redirect('dashboard');
		exit();
	}
}

function checkNotLogin()
{
	$ci = get_instance();
	if (!$ci->session->userdata('npm')) {
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
	return stripslashes(strip_tags(trim(htmlspecialchars($string, ENT_QUOTES))));
}

/* XSS Filtering */
function xss($string)
{
	return strip_tags(htmlspecialchars($string, ENT_QUOTES));
}


//Method to sanitize input data
function __sanitizeString($str)
{
	// return filter_var($this->__sanitizeString($str),FILTER_SANITIZE_STRING);
	// return $this->db->escape($this->__sanitizeString($str));
	// return $this->db->escape(filter_var($str,FILTER_SANITIZE_STRING));
	return html_purify($str);
}
