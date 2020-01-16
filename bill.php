<?php
include('top2.php');
require('config.php');
$db=mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysqli_select_db($db,DB_SERVER_DATABASE);
mysqli_query($db,"SET NAMES 'utf8'");
$task_lst_query=mysqli_query($db,"SELECT * FROM tasks WHERE id='".$_GET['id']."'");
$task_lst=mysqli_fetch_array($task_lst_query);

require_once('tcpdf/config/lang/ukr.php');
require_once('tcpdf/tcpdf.php');

$cl_lst_query=mysqli_query($db,"SELECT id as cl_id, username as cl_name, tel1 as cl_tel FROM clients WHERE id='".$task_lst['client']."'");
$cl_lst=mysqli_fetch_array($cl_lst_query);
//echo ($cl_lst['cl_name']);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DBRT Service');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData($tc=array(0,64,0), $lc=array(0,64,128));
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 10, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
//$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));


$pdf->SetXY (20,40);
$pdf->Write('1', 'Клієнт: '.$cl_lst['cl_name'].'тел.: '.$cl_lst['cl_tel']);

//$pdf->SetXY (35,40);
//$pdf->Cell(35,3,$cl_lst['cl_name'],1,0,'',0);
//$pdf->Write('1', $cl_lst['cl_name']);


// Set some content to print
$html = '<table cellspacing="1" cellpadding="1" border="1">
	<tr>
	    <td>test</td>
	    <td>test2</td>
	</tr>
	<tr>
	    <td>
	    Українська
	    </td>
	    <td>
	    Перевірка
	    </td>
	</tr>
</table>';


$pdf->writeHTML($html, true, false, true, false, '');
// Print text using writeHTMLCell()
//$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
ob_end_clean();
$pdf->Output('bill.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>