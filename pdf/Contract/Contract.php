<?php
session_start();
include "../../include/securitytest.php";

if(isset($_SESSION['userid']) && isset($_SESSION['userType']) && isset($_GET['c']))
{

include "../../include/dbConnect.php";


$uid = $_SESSION['userid'];
$ut = $_SESSION['userType'];
$cid = $_GET['c'];


//permissions 
$result = mysql_query("SELECT drafter, participant FROM tblcontract WHERE contractId = '$cid'");
$row = mysql_fetch_assoc($result);
if ($row['drafter'] == $uid || $row['participant'] == $uid)
{
// label specifics
$lresult = mysql_query("SELECT * FROM tblcontract c, tbluser u, tbllabel l WHERE c.drafter = u.userid and u.userid = l.labelId and c.contractid = '$cid'");
$lrow = mysql_fetch_assoc($lresult);

// artist specifics
$aresult = mysql_query("SELECT * FROM tblcontract c, tbluser u WHERE c.participant = u.userid and c.contractid = '$cid'");
$arow = mysql_fetch_assoc($aresult);

require('../fpdf.php');

class PDF extends FPDF
{
	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}
$lname =  strtoupper ( $lrow['companyName'] );
$aname =  strtoupper ( $arow['firstName']." ". $arow['lastName'] );
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,5,$lname,0,1);
$pdf->Ln();
$pdf->Cell(0,5,$lrow['address'],0,1);
$pdf->Ln();
$pdf->Cell(0,5,$lrow['dateConfirmed'],0,1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(0,5,$lname,0,1);
$pdf->Ln();
$pdf->Cell(0,5,'Re: Exclusive Recording Agreement between '.$aname.' and '.$lname,0,1);
$pdf->Cell(0,5,'______________________________________________________________________',0,1);
$pdf->Ln();
$pdf->Cell(0,5,'Dear '.$arow['firstName'],0,1);
$pdf->Ln();
$pdf->MultiCell(0,5,'The following shall confirm the material terms of the exclusive recording agreement reached between you the individuals jointly and severally p/k/a " " (hereinafter " ", "you" or "Artist") and us,'.$lname.' ("Company"), as follows:',0,1);
$pdf->Ln();
$pdf->Ln();
$result = mysql_query("SELECT clause, title FROM tblcustomclause WHERE contract = '$cid'");
$count = mysql_num_rows($result);
for($i=1;$i<=$count;$i++) {
	$row = mysql_fetch_array($result);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(0,5,$row['title'],0,1);
	$pdf->Ln();
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(0,5,$row['clause']);
	$pdf->Ln();
	}
$pdf->AddPage();
$pdf->Cell(0,5,'By:',0,1);
if($lrow['dSigniture'] != "")
{
$pdf->Image($lrow['dSigniture'], 10,null, 30);
}
$pdf->Cell(0,5,'__________________________',0,1);
$pdf->Cell(0,5,$lname,0,1);
$pdf->Ln();
$pdf->Cell(0,5,'Agreed:',0,1);
if($arow['dSigniture'] != "")
{
$pdf->Image( $arow['dSigniture'] , 10,null, 30);
}
$pdf->Cell(0,5,'__________________________',0,1);
$pdf->Cell(0,5,$aname,0,1);
$pdf->Output();
}else {
		$_SESSION['error'] = 'Invalid Url';
		header("Location: ../../home.php");
		}

}else {
		$_SESSION['error'] = 'Invalid Url';
		header("Location: ../../home.php");
		}
?>
