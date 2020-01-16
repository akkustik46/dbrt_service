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
$model_name=mysqli_query($db,"select (select mnf_name from mnf where id=(select mnf_id from models where id=(SELECT model FROM bike WHERE id='".$task_lst['bike']."'))) as make, model, capacity from models where id=(SELECT model FROM bike WHERE id='".$task_lst['bike']."')");
$model=mysqli_fetch_array($model_name);
$bike_query=mysqli_query($db,"SELECT vin, owner, license_plate, mi_km FROM bike where id=".$task_lst['bike']);
$bike_info=mysqli_fetch_array($bike_query);


$payment=mysqli_query($db,"select payment,mileage from tasks where id='".$_GET['id']."'");
$payment=mysqli_fetch_array($payment);


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('DBRT Service');
$pdf->SetTitle('');
$pdf->SetSubject('');
$pdf->SetKeywords('');

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


$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->SetXY (20,40);
$pdf->Write('1', 'Клієнт: ');

$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->SetXY (36,40);
$pdf->Write('1', $cl_lst['cl_name'].'  тел.: '.$cl_lst['cl_tel']);

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->SetXY (20,45);
$pdf->Write('1', 'Мотоцикл: ');

$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->SetXY (43,45);
$pdf->Write('1', $model['make'].' '.$model['model'].' '.$model['capacity']);

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->SetXY (90,45);
$pdf->Write('1', 'Пробіг: ');
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->SetXY (107,45);
//$pdf->Write('1', $payment['mileage']);
if ($bike_info['mi_km']==0) {
	$pdf->Write('1', $payment['mileage'].'км');
	} else { 
	$pdf->Write('1', $payment['mileage'].'миль');
	}

$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->SetXY (130,45);
$pdf->Write('1', 'ДНЗ: ');
$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->SetXY (141,45);
$pdf->Write('1', $bike_info['license_plate']);

//$pdf->SetXY (35,40);
//$pdf->Cell(35,3,$cl_lst['cl_name'],1,0,'',0);
//$pdf->Write('1', $cl_lst['cl_name']);
$pdf->SetFont('dejavusans', 'B', 10, '', true);
$pdf->SetXY (20,52);
$pdf->Write('1', 'Виконані роботи: ');

$pdf->SetFont('dejavusans', '', 10, '', true);
$pdf->SetXY (20,57);

$html = '<table cellspacing="1" cellpadding="1" border="1">
	<tr>
	    <td width="20"><b>№</b></td>
	    <td width="200"><b>Найменування робіт</b></td>
	    <td width="80"><b>Ціна</b></td>
	</tr>';


$task_wrk_query=mysqli_query($db,"SELECT * from works WHERE task_id='".$_GET['id']."'");
$wrk_sum=0;
$i=1;
while($task_wrk_lst=mysqli_fetch_array($task_wrk_query)) {
                $task_wrk=array('id'=>$task_wrk_lst['id'],
                                'type_id'=>$task_wrk_lst['type_id'],
                                'price'=>$task_wrk_lst['price'],
                                'status'=>$task_wrk_lst['status']);
$wrk=mysqli_query($db,"select works_groups.name as wgr_name, works_types.name as wrk_name from works_groups,works_types where works_groups.id=(SELECT  group_id FROM `works_types` WHERE id='".$task_wrk['type_id']."') and works_types.id='".$task_wrk['type_id']."'");
$wrk=mysqli_fetch_array($wrk);
$html.='<tr><td width="20">';
$html.=$i;
$html.='</td><td width="200">';
$html.=$wrk['wrk_name'];
$html.='</td><td width="50" align="right">';
$html.=$task_wrk_lst['price'];
$html.='</td></tr>';
$wrk_sum=$wrk_sum+$task_wrk_lst['price'];
$i++;
}

$html.='<tr><td></td><td align="right"><b>Разом</b></td><td align="right">'.$wrk_sum.'</td></tr></table>';


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