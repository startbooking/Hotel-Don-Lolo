<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('L', 'legal');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(320, 6, $nomamb, 0, 1, 'C');
$pdf->Cell(320, 5, 'ACUMULADO DE PRODUCTOS POR MES ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(320, 6, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(60, 5, 'PRODUCTO ', 1, 0, 'C');
$pdf->Cell(30, 5, 'PRECIO ', 1, 0, 'C');
$pdf->Cell(18, 5, 'ENERO ', 1, 0, 'C');
$pdf->Cell(18, 5, 'FEBRE ', 1, 0, 'C');
$pdf->Cell(18, 5, 'MARZO ', 1, 0, 'C');
$pdf->Cell(18, 5, 'ABRIL ', 1, 0, 'C');
$pdf->Cell(18, 5, 'MAYO ', 1, 0, 'C');
$pdf->Cell(18, 5, 'JUNIO ', 1, 0, 'C');
$pdf->Cell(18, 5, 'JULIO ', 1, 0, 'C');
$pdf->Cell(18, 5, 'AGOST ', 1, 0, 'C');
$pdf->Cell(18, 5, 'SEPTI ', 1, 0, 'C');
$pdf->Cell(18, 5, 'OCTUB ', 1, 0, 'C');
$pdf->Cell(18, 5, 'NOVIE ', 1, 0, 'C');
$pdf->Cell(18, 5, 'DICIE ', 1, 0, 'C');
$pdf->Cell(18, 5, 'TOTAL ', 1, 1, 'C');
/* $pdf->Cell(20, 5, 'CANT MES', 1, 0, 'C');
$pdf->Cell(20, 5, ('CANT AÑO'), 1, 1, 'C'); */
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(1);

$totproanio = 0;
$totingene = 0;
$totingfeb = 0;
$totingmar = 0;
$totingabr = 0;
$totingmay = 0;
$totingjun = 0;
$totingjul = 0;
$totingago = 0;
$totingsep = 0;
$totingoct = 0;
$totingnov = 0;
$totingdic = 0;
// $totingani = 0;

// $diavta = $pos->acumuladoDiarioProductosVendidos($idamb, $fecha);
$enevta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '01');
$febvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '02');
$marvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '03');
$abrvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '04');
$mayvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '05');
$junvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '06');
$julvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '07');
$agovta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '08');
$sepvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '09');
$octvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '10');
$novvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '11');
$dicvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, '12');

$productos = $pos->productoPOS($idamb);

foreach ($productos as $producto) {
    $idprod = $producto['producto_id'];
    $nomene = array_search($idprod, array_column($enevta, 'producto_id'));
    $nomfeb = array_search($idprod, array_column($febvta, 'producto_id'));
    $nommar = array_search($idprod, array_column($marvta, 'producto_id'));
    $nomabr = array_search($idprod, array_column($abrvta, 'producto_id'));
    $nommay = array_search($idprod, array_column($mayvta, 'producto_id'));
    $nomjun = array_search($idprod, array_column($junvta, 'producto_id'));
    $nomjul = array_search($idprod, array_column($julvta, 'producto_id'));
    $nomago = array_search($idprod, array_column($agovta, 'producto_id'));
    $nomsep = array_search($idprod, array_column($sepvta, 'producto_id'));
    $nomoct = array_search($idprod, array_column($octvta, 'producto_id'));
    $nomnov = array_search($idprod, array_column($novvta, 'producto_id'));
    $nomdic = array_search($idprod, array_column($dicvta, 'producto_id'));

    $pdf->Cell(60, 4, (substr($producto['nom'], 0, 28)), 0, 0, 'L');
    $pdf->Cell(25, 4, number_format($producto['venta'], 2), 0, 0, 'R');

    $prdene = 0;
    $prdfeb = 0;
    $prdmar = 0;
    $prdabr = 0;
    $prdmay = 0;
    $prdjun = 0;
    $prdjul = 0;
    $prdago = 0;
    $prdsep = 0;
    $prdoct = 0;
    $prdnov = 0;
    $prddic = 0;
    $totpro = 0;

    if ($nomene != '') {
        $prdene = $enevta[$nomene]['cantmes'];
    }
    if ($nomfeb != '') {
        $prdfeb = $febvta[$nomfeb]['cantmes'];
    }
    if ($nommar != '') {
        $prdmar = $marvta[$nommar]['cantmes'];
    }
    if ($nomabr != '') {
        $prdabr = $abrvta[$nomabr]['cantmes'];
    }
    if ($nommay != '') {
        $prdmay = $mayvta[$nommay]['cantmes'];
    }
    if ($nomjun != '') {
        $prdjun = $junvta[$nomjun]['cantmes'];
    }
    if ($nomjul != '') {
        $prdjul = $julvta[$nomjul]['cantmes'];
    }
    if ($nomago != '') {
        $prdago = $agovta[$nomago]['cantmes'];
    }
    if ($nomsep != '') {
        $prdsep = $sepvta[$nomsep]['cantmes'];
    }
    if ($nomoct != '') {
        $prdoct = $octvta[$nomoct]['cantmes'];
    }
    if ($nomnov != '') {
        $prdnov = $novvta[$nomnov]['cantmes'];
    }
    if ($nomdic != '') {
        $prddic = $dicvta[$nomdic]['cantmes'];
    }

    $totprd = $prdene + $prdfeb + $prdmar + $prdabr + $prdmay + $prdjun + $prdjul + $prdago + $prdsep + $prdoct + $prdnov + $prddic;

    $pdf->Cell(18, 4, number_format($prdene, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdfeb, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdmar, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdabr, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdmay, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdjun, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdjul, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdago, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdsep, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdoct, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prdnov, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($prddic, 0), 0, 0, 'R');
    $pdf->Cell(18, 4, number_format($totprd, 0), 0, 1, 'R');
}

$pdf->Ln(3);

$file = '../imprimir/auditorias/acumuladoMensualProductos_'.$pref.'_'.$fecha.'.pdf';
$pdf->Output($file, 'F');
