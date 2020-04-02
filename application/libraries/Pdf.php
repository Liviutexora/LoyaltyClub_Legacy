<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pdf{

	function pdf()
	{
		$CI = & get_instance();
		log_message('Debug', 'mPDF class is loaded.');
	}

	function load($param=NULL)
	{
		include_once APPPATH.'/third_party/tcpdf/tcpdf.php';

		if ($param == NULL)
		{
			$param = "PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false";
		}
        // create new PDF document
        return new TCPDF($param);
	}


}
