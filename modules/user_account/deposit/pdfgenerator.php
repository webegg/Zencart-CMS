<?php
include("classes/fpdf.php");
include("config.inc.php");
include("siteinfo.php");
class PDF extends FPDF
{
	function Deposit($header, $data, $w)
	{
		//colors, etc,...
		$this->SetFillColor(108,108,108);
		$this->SetTextColor(255);
		$this->SetDrawColor(0, 0, 0);
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		//header tables
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],7,$header[$i],1,0,'C',1);
		$this->ln();
		//let's restore the colors
		$this->SetFillColor(224,235,255);
		$this->SetTextColor(0);
		$this->SetFont('');
		$fill=0;
		foreach($data as $row)
		{
			$this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
			$this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
			$this->Ln();
			$fill=!$fill;
		}
	}
}
//hier sql instructie en data
if(isset($_GET['deposit']))
{
	$deposit = mysql_real_escape_string($link, $_GET['deposit']);
	$sql = mysql_query($link, "SELECT * FROM deposit_history WHERE id=".$deposit."");
}
elseif(isset($_GET['user_id']))
{
	$deposit = mysql_real_escape_string($link, $_GET['user_id']);
	$sql = mysql_query($link, "SELECT * FROM deposit_history WHERE ".$userid."=".$deposit."");
}
$nr = 0;
$nr2= 0;
$data = array();
$vragen = array();
while($result = mysqli_fetch_object($sql))
{
	$data[$nr][0] = $result->unique_code;
	$data[$nr][1] = $result->amount;
	$nr++;
}
$result = mysqli_fetch_object(mysqli_query($link, "SELECT ".$username." FROM ".$usertable." WHERE ".$userid."=".$useridentify.""));
$user_name = $result->username;
	$pdf= new PDF('P', 'mm', 'A4');
	$header = array('Unique tax id','Amount');
	$table_width = array(150,30,50);
	$pdf->AddPage();
	$pdf->SetFont('Arial', '', 8);
	$pdf->Cell(40, 10, $companyname);
	$pdf->Ln(3);
	$pdf->Cell(40, 10, $companyadress);
	$pdf->Ln(3);
	$pdf->Cell(40, 10, $companynumber);
	$pdf->Ln(20);
	$pdf->SetFont('Arial', 'B', 14);
	$pdf->Cell(40, 10, 'deposit history details for '.$user_name.'');
	$pdf->Ln(20);
	$pdf->SetFont('Arial', 'B', 12);
	$pdf->Ln(10);
	$pdf->Deposit($header, $data, $table_width);
	$pdf->Ln(10);
	$pdf->SetFont('Arial', '', 10);
	$pdf->Cell(40,40, $documentfooter);
	$pdf->Output();
?>