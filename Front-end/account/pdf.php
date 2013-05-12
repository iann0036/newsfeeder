<?php
	if (!defined('ROOT'))
	    define('ROOT',realpath($_SERVER['DOCUMENT_ROOT']));
	require_once ROOT.'/misc/init.php';
	require_once ROOT.'/classes/ArticleCollection.php';
	require_once ROOT.'/classes/SheetCollection.php';
	require_once ROOT.'/classes/CPHCollection.php';
	require_once ROOT.'/classes/User.php';
	require_once ROOT.'/misc/misc.php';
	require_once ROOT.'/classes/thirdparty/fpdf/fpdf.php';
	
	if (!User::validUser())
	    header('Location: http://'.HOST.'/members/login/');
	
	$sheets = new SheetCollection();
	$sheet = $sheets->getElementById($_GET['sheetid']);
	
	$cph_data = array();
	$cphs = new CPHCollection($_GET['sheetid']);
	while ($cphs->more()) {
	    $cph = $cphs->next();
	    $cph_data[] = $cph;
	}
	
	/* Sort the CPH's */
	function cphsort($a, $b) {
	    if ($a['column']!=$b['column'])
		return ($a['column'] > $b['column']);
	    return ($a['order'] > $b['order']);
	}
	for ($i=0; $i<count($cph_data); $i++)
	    uksort($cph_data[$i],"cphsort");
	
	
    class PDF extends FPDF {
	// Page header
	function Header()
	{
	    // Logo
	    $this->Image('../images/logo.jpg',10,6,30);
	    // Arial bold 15
	    $this->SetTextColor(0,0,0);
	    $this->SetFont('Arial','B',15);
	    // Move to the right
	    $this->Cell(80);
	    // Line break
	    $this->Ln(10);
	}

	// Page footer
	function Footer() {
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetTextColor(0,0,0);
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    foreach ($cph_data as $cph) {
	foreach ($cph['feeds'] as $item) {
	    $pdf->SetFont('Arial','B',9);
	    $pdf->SetTextColor(50,108,166);
	    $pdf->MultiCell(0,9,$item['title'],0,1);

	    $pdf->SetFont('Arial','',5);
	    $pdf->SetTextColor(106,106,106);
	    $pdf->MultiCell(0,5,$item['feedname'].', '.convert_datetime($item['time']),0,1);

	    $pdf->SetFont('Arial','',7);
	    $pdf->SetTextColor(0,0,0);
	    $pdf->MultiCell(0,7,$item['content'],0,1);
	}
    }
    $pdf->Output();
?>