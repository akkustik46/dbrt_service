<?php 

//session_start();
//include('top2.php');
require_once('config.php');
mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
mysql_select_db('sbeval_test');
mysql_query("SET NAMES 'utf8'");
$sb_lst_query=mysql_query("SELECT * FROM sblist WHERE sblist.id='".$_GET['id']."'");
$sb_lst=mysql_fetch_array($sb_lst_query);
$aff_lst_query=mysql_query("SELECT * FROM affected WHERE affected.id='".$sb_lst['affected']."'");
$aff_lst=mysql_fetch_array($aff_lst_query);
$ven_lst_query=mysql_query("SELECT * FROM vendor WHERE vendor.id='".$sb_lst['vendor']."'");
$ven_lst=mysql_fetch_array($ven_lst_query);
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
//create a FPDF object
$pdf=new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//set document properties
$pdf->SetAuthor('KharkivAirlines');
$pdf->SetTitle('Service Bulletin Evaluation');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
//set font for the entire document
$pdf->SetFont('dejavusans','',18);
$pdf->SetTextColor(0,0,0);
//set up a page
$pdf->AddPage('P');
$pdf->SetDisplayMode('real','default');
//insert an image and make it a link
//$pdf->Image('logo.png',10,20,33,0,' ','http://www.fpdf.org/');
//display the title with a border around it
$pdf->Image('images/sblogo.jpg','15','9','70','15');
//$pdf->Image('images/sblogo.jpg', '', '', 332, 80, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
$pdf->SetXY(90,7);
$pdf->SetDrawColor(0,0,0);
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
//$str = utf8_decode($str);
//$str = iconv('UTF-8','cp1251',$str);
//$pdf->Cell(50,10,$str,1,0,'C',0);
$str='SERVICE BULLETIN EVALUATION';
//$str2=$sb_lst['sbno'];
//cell description
//$pdf->Cell(Width,Height,'TEXT',BORDER,0,'',0);
$pdf->Write('1',$str);
$pdf->SetFont('dejavusans','',12);
$pdf->SetXY (90,18.5);
$pdf->Write('1','№:');
$pdf->SetXY (100,18);
$pdf->Cell(50,5,$sb_lst['sbno'],1,0,'',0);
$pdf->SetFontSize(10);
//Set x and y position for the main text, reduce font size and write content
$pdf->SetXY (23.5,28);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;SB No&nbsp;&nbsp;&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetXY (41,28);
$pdf->Cell(45,4,$sb_lst['sbno'],1,0,'',0);

$pdf->SetXY (15,35);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;ATA System&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetXY (41,35);
$pdf->Cell(10,4,$sb_lst['atasys'],1,0,'C',0);

$pdf->SetFontSize(10);
$pdf->SetXY (90,28);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;TITLE&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetXY (103,28);
//$html = '<texarea>'.$sb_lst['title'].'</textarea>';
//$pdf->writeHTML($html, true, false, true, false, '');
$pdf->SetFontSize(8);
$pdf->MultiCell(100,12,$sb_lst['title'],1,'',0,1,'','', true);

$pdf->SetFontSize(10);
$pdf->SetLineWidth(0.8);
$pdf->SetXY (15,42);
$pdf->MultiCell(188,20,'',1,'',0,1,'','', true);

$pdf->SetXY (17,43);
$html = '<span style="background-color:#afafaf;color:black;">&nbsp;EFFECTIVITY&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetLineWidth(0.3);
$pdf->SetXY (18,53);
$pdf->Cell(20,3,$aff_lst['name'],1,0,'',0);

$pdf->SetXY (45,43);
$pdf->MultiCell(156,14.7,$sb_lst['effectivity'],1,'',0,1,'','', true);

$pdf->SetXY (22,68);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;Vendor&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY (39,68);
$pdf->Cell(37,3,$ven_lst['name'],1,0,'',0);

$pdf->SetXY (22,75);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;Release Date of SB&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');

if($sb_lst['release_date']=='0000-00-00') { $rel_date='';
    } else {
$rel_date=date("d.m.Y", strtotime($sb_lst['release_date']));
}
$pdf->SetXY (60,75);
$pdf->Cell(23,3,$rel_date,1,0,'',0);


$pdf->SetXY (22,82);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;Revision&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY (41,82);
$pdf->Cell(10,3,$sb_lst['rev'],1,0,'C',0);

$pdf->SetXY (22,89);
$html = '<span style="background-color:#cacaca;color:black;">&nbsp;AD Note&nbsp;</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY (41,89);
$pdf->Cell(35,3,$sb_lst['ad_note'],1,0,'',0);

$pdf->SetLineWidth(0.8);
$pdf->SetXY (85,64);
$pdf->Cell(60,50,'',1,0,'',0);

$pdf->SetXY (87,66);
$pdf->SetFontSize(10.5);
$html = '<span style="background-color:#afafaf;color:black;">ACCOMPLISHMENT CATEGORY</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFontSize(10);
$acc1='off';
$acc2='off';
$acc3='off';
$acc4='off';
switch($sb_lst['acc_category']) {
case '1':
    $acc1='on';
break;
case '2':
     $acc2='on';
break;
case '3':
     $acc3='on';
break;
case '4':
     $acc4='on';
break;
default:
    $acc1='off';
    $acc2='off';
    $acc3='off';
    $acc4='off';
break;
}
    $html = '<span style="background-color:#cacaca;color:black;">AD Related</span>';
    $pdf->SetXY (106,73);
    $pdf->writeHTML($html, true, false, true, false, '');
    // $pdf->SetXY (127,73);
   $pdf->Image('images/radio_'.$acc1.'.png','127','73','4.3','4','PNG');
    $html = '<span style="background-color:#cacaca;color:black;">Reliability mandatory</span>';
    $pdf->SetXY (88,81);
    $pdf->writeHTML($html, true, false, true, false, '');
//     $pdf->SetXY (127,81);
    $pdf->Image('images/radio_'.$acc2.'.png','127','81','4.3','4','PNG');
//    $pdf->RadioButton('acc_cat', 5, array('readonly' => 'true'), array(), 'Reliabilitymandatory', $acc2);
    $html = '<span style="background-color:#cacaca;color:black;">Recommended</span>';
    $pdf->SetXY (99,89);
    $pdf->writeHTML($html, true, false, true, false, '');
//     $pdf->SetXY (127,89);
$pdf->Image('images/radio_'.$acc3.'.png','127','89','4.3','4','PNG');
//    $pdf->RadioButton('acc_cat', 5, array('readonly' => 'true'), array(), 'Recommended', $acc3);
    $html = '<span style="background-color:#cacaca;color:black;">Optional</span>';
    $pdf->SetXY (111,97);
    $pdf->writeHTML($html, true, false, true, false, '');
//     $pdf->SetXY (127,97);
$pdf->Image('images/radio_'.$acc4.'.png','127','97','4.3','4','PNG');
//    $pdf->RadioButton('acc_cat', 5, array('readonly' => 'true'), array(), 'Optional',$acc4);


$pdf->SetLineWidth(0.8);
$pdf->SetXY (148,64);
$pdf->Cell(55,50,'',1,0,'',0);

$pdf->SetXY (154,66);
$pdf->SetFontSize(10.5);
$html = '<span style="background-color:#afafaf;color:black;">SCHEDULING PRIORITY</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$prior1='off';
$prior2='off';
$prior3='off';
switch($sb_lst['priority']) {
case 1:
    $prior1='on';
break;
case 2:
     $prior2='on';
break;
case 3:
     $prior3='on';
break;
default:
    $prior1='off';
    $prior2='off';
    $prior3='off';
break;
}

    $html = '<span style="background-color:#cacaca;color:black;">Next check/stop visit</span>';
    $pdf->SetXY (153,73);
    $pdf->writeHTML($html, true, false, true, false, '');
//     $pdf->SetXY (194,73);
//    $pdf->RadioButton('prior', 5, array('readonly' => 'true'), array(), 'check/stop',$prior1);
    $pdf->Image('images/radio_'.$prior1.'.png','194','73','4.3','4','PNG');
    $html = '<span style="background-color:#cacaca;color:black;">Next heavy maint visit</span>';
    $pdf->SetXY (150,81);
    $pdf->writeHTML($html, true, false, true, false, '');
//     $pdf->SetXY (194,81);
//    $pdf->RadioButton('prior', 5, array('readonly' => 'true'), array(), 'maintvisit',$prior2);
    $pdf->Image('images/radio_'.$prior2.'.png','194','81','4.3','4','PNG');
    $html = '<span style="background-color:#cacaca;color:black;">As scheduled by PPC</span>';
    $pdf->SetXY (153,89);
    $pdf->writeHTML($html, true, false, true, false, '');
//     $pdf->SetXY (194,89);
//    $pdf->RadioButton('prior', 5, array('readonly' => 'true'), array(), 'PPC',$prior3);
    $pdf->Image('images/radio_'.$prior3.'.png','194','89','4.3','4','PNG');

 $pdf->SetXY(154,99);
    $pdf->Write('1','Prior to:');
    $pdf->SetLineWidth(0.3);
    if ($sb_lst['prior_to']=='0000-00-00') {$prior_date='';
    } else {
    $prior_date=date("d.m.Y", strtotime($sb_lst['prior_to']));    
    }
    $pdf->SetXY(173,99);
    $pdf->Cell(25,5, $prior_date,1,0,'',0);


$pdf->SetLineWidth(0.8);
$pdf->SetXY(15,120);
$pdf->Cell(188,15,'',1,0,'',0);

$pdf->SetFontSize(12);
$pdf->SetXY(85,121);
$html = '<span style="background-color:#afafaf;color:black;">MANUALS AFFECTED</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFontSize(10);
$pdf->SetXY(25,127);
$html = '<span style="background-color:#cacaca;color:black;">MM     </span>';
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->SetXY(35,127);
//$pdf->CheckBox('man_aff', 5, $sb_lst['man_aff_mm'], array(), array());
$pdf->Image('images/check'.$sb_lst['man_aff_mm'].'.png','35','127','4.3','4','PNG');

$pdf->SetXY(50,127);
$html = '<span style="background-color:#cacaca;color:black;">IPC     </span>';
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->SetXY(60,127);
//$pdf->CheckBox('man_aff', 5, $sb_lst['man_aff_ipc'], array(), array());
$pdf->Image('images/check'.$sb_lst['man_aff_ipc'].'.png','60','127','4.3','4','PNG');

$pdf->SetXY(75,127);
$html = '<span style="background-color:#cacaca;color:black;">OVHM   </span>';
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->SetXY(90,127);
//$pdf->CheckBox('man_aff', 5, $sb_lst['man_aff_ovhm'], array(), array());
$pdf->Image('images/check'.$sb_lst['man_aff_ovhm'].'.png','90','127','4.3','4','PNG');

$pdf->SetXY(105,127);
$html = '<span style="background-color:#cacaca;color:black;">WDM  </span>';
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->SetXY(118,127);
//$pdf->CheckBox('man_aff', 5, $sb_lst['man_aff_wdm'], array(), array());
$pdf->Image('images/check'.$sb_lst['man_aff_wdm'].'.png','118','127','4.3','4','PNG');

$pdf->SetXY(128,127);
$html = '<span style="background-color:#cacaca;color:black;">Other </span>';
$pdf->writeHTML($html, true, false, true, false, '');
//$pdf->SetXY(141,127);
//$pdf->CheckBox('man_aff', 5, $sb_lst['man_aff_other'], array(), array());
$pdf->Image('images/check'.$sb_lst['man_aff_other'].'.png','141','127','4.3','4','PNG');

$pdf->SetXY(151,127);
$pdf->SetLineWidth(0.3);
$pdf->Cell(50,5,$sb_lst['man_aff'],1,0,'',0);

$pdf->SetLineWidth(0.8);
$pdf->SetXY(15,137);
$pdf->Cell(188,30,'',1,0,'',0);

$pdf->SetFontSize(12);
$pdf->SetXY(85,138);
$html = '<span style="background-color:#afafaf;color:black;">WEIGHT AND BALANCE</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFontSize(10);
$pdf->SetXY(18,148);
$html = '<span style="background-color:#cacaca;color:black;">Wt Change (+/-lbs)</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetLineWidth(0.3);
$pdf->SetXY(53,148);
$pdf->MultiCell(50,15,$sb_lst['wt_change'],1,'',0,1,'','', true);

$pdf->SetXY(108,148);
$html = '<span style="background-color:#cacaca;color:black;">Mom Change (+/-lbs-inch)</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY(156,148);
$pdf->MultiCell(45,15,$sb_lst['mom_change'],1,'',0,1,'','', true);

$pdf->SetLineWidth(0.8);
$pdf->SetXY(15,170);
$pdf->Cell(188,20,'',1,0,'',0);

$pdf->SetFontSize(12);
$pdf->SetXY(75,171);
$html = '<span style="background-color:#afafaf;color:black;">MANHOUR REQUIREMENT PER UNIT</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFontSize(10);
$pdf->SetXY(18,177);
$html = '<span style="background-color:#cacaca;color:black;">SB Mhr</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetLineWidth(0.3);
$pdf->SetXY(32,177);
$pdf->MultiCell(21,10,$sb_lst['sb_mhr'],1,'',0,1,'','', true);

$pdf->SetXY(56,177);
$html = '<span style="background-color:#cacaca;color:black;">Actual Mhrs</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY(79,177);
$pdf->MultiCell(21,10,$sb_lst['actual_mhr'],1,'',0,1,'','', true);

$pdf->SetXY(105,177);
$html = '<span style="background-color:#cacaca;color:black;">Labor Rate($)</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY(131,177);
$pdf->MultiCell(21,10,$sb_lst['labor_rate'],1,'',0,1,'','', true);

$pdf->SetXY(156,177);
$html = '<span style="background-color:#cacaca;color:black;">Mhr Cost($)</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY(178,177);
$pdf->MultiCell(21,10,$sb_lst['mhr_cost'],1,'',0,1,'','', true);

$pdf->SetLineWidth(0.8);
$pdf->SetXY(15,193);
$pdf->Cell(188,18,'',1,0,'',0);

$pdf->SetXY(18,195);
$pdf->SetFillColor(197, 197, 197);
$html = 'Kit, spares and material required';
$pdf->MultiCell(33,10,$html,0,'',1,1,'','', true);

$pdf->SetLineWidth(0.3);
$pdf->SetXY(52,195);
$pdf->SetFontSize(8);
$pdf->MultiCell(70,15,$sb_lst['req_kit_material_spares'],1,'',0,1,'','', true);

$pdf->SetXY(126,195);
$pdf->SetFontSize(10);
$html = '<span style="background-color:#cacaca;color:black;">Kit price per unit($)</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetXY(163,195);
$pdf->MultiCell(30,5,$sb_lst['kit_price'],1,'',0,1,'','', true);

$pdf->SetFontSize(12);
$pdf->SetXY(130,203);
$html = '<span style="background-color:#afafaf;color:black;">MATERIAL REQUIRED PER UNIT</span>';
$pdf->writeHTML($html, true, false, true, false, '');

$pdf->SetFontSize(10);
$pdf->SetXY(15,217);
$html = 'Engineering Support Group Engineer';
$pdf->MultiCell(42,10,$html,0,'',1,1,'','', true);
$pdf->SetXY(59,217);
$pdf->MultiCell(144,15,$sb_lst['esg_eng'],1,'',0,1,'','', true);

$pdf->SetXY(15,235);
$html = 'ESG Leading Engineer';
$pdf->MultiCell(42,10,$html,0,'',1,1,'','', true);
$pdf->SetXY(59,235);
$pdf->SetFontSize(8);
$pdf->MultiCell(42,13,$sb_lst['esg_lead_eng'],1,'',0,1,'','', true);

$pdf->SetXY(103,235);
$html = 'MCG Leading Engineer';
$pdf->MultiCell(30,10,$html,0,'',1,1,'','', true);

$pdf->SetFontSize(8);
$pdf->SetXY(134,235);
$pdf->MultiCell(69,15,$sb_lst['mcg_lead_eng'],1,'',0,1,'','', true);

$pdf->SetFontSize(10);
$pdf->SetXY(15,250);
$html = 'Engineering Support Department Manager';
$pdf->MultiCell(42,10,$html,0,'',1,1,'','', true);
$pdf->SetFontSize(8);
$pdf->SetXY(59,250);
$pdf->MultiCell(42,13,$sb_lst['esd_manager'],1,'',0,1,'','', true);

$pdf->SetFontSize(10);
$pdf->SetXY(120,254);
$html = 'EO/JO №';
$pdf->MultiCell(20,5,$html,0,'',1,1,'','', true);
$pdf->SetXY(142,254);
$pdf->MultiCell(32,5,$sb_lst['eojo_no'],1,'',0,1,'','', true);

$pdf->SetXY(105,263);
$html = 'REVIEW SB before';
$pdf->MultiCell(35,5,$html,0,'',1,1,'','', true);
$pdf->SetXY(142,263);
if ($sb_lst['rev_sb_before']=='0000-00-00') {$sb_before='';
    } else {
$sb_before=date("d.m.Y", strtotime($sb_lst['rev_sb_before']));
}
$pdf->MultiCell(42,5,$sb_before,1,'',0,1,'','', true);

$pdf->SetXY(15,270);
$html = 'Evaluation issued';
$pdf->MultiCell(50,5,$html,0,'',1,1,'','', true);
$pdf->SetXY(72,270);
if ($sb_lst['eval_issued']=='0000-00-00') {$eval_issue='';
    } else {
$eval_issue=date("d.m.Y", strtotime($sb_lst['eval_issued']));
}
$pdf->MultiCell(35,5,$eval_issue,1,'R',0,1,'','', true);

$pdf->SetFontSize(6);
$pdf->SetXY(185,271);
$html = 'Form M-21 27.03.14 Rev.01';
$pdf->MultiCell(20,5,$html,0,'',0,1,'','', true);
//$pdf->Write(5,'Congratulations! You have generated a PDF.');
//Output the document
$pdf->Output($sb_lst['sbno'].'_'.date('Y-m-d_H-i-s').'.pdf','I');
?>