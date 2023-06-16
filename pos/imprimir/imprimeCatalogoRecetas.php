<?php

  require_once '../../res/php/app_topPos.php';
  require_once '../../res/fpdf/fpdf.php';

  $idamb  = $_POST['id'];
  $nomamb = $_POST['amb'];
  $user   = $_POST['user'];
  $iduser = $_POST['iduser'];
  $impto  = $_POST['impto'];
  $prop   = $_POST['prop'];
  $logo   = $_POST['logo'];
  $key    = $_POST['file'];
  $fecha  = $_POST['fecha'];
  $tipo   = $_POST['tipo'];

  clearstatcache();

  if($tipo==''){
    $recetas        = $pos->getDetalleReceta();
  }else{
    $recetas        = $pos->getDetalleRecetaTipo($tipo);
  }

  $pdf = new FPDF();
  $pdf->AddPage('P','letter');
  $pdf->Image('../../img/'.$logo,10,10,15);
  $pdf->SetFont('Arial','B',13);
  $pdf->Cell(190,7,utf8_decode(NAME_EMPRESA),0,1,'C');
  $pdf->SetFont('Arial','',10);
  $pdf->Cell(190,5,'NIT: '.NIT_EMPRESA,0,1,'C');

  $pdf->SetFont('Arial','B',12);
  $pdf->Cell(190,6,$nomamb,0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(190,6,'CATALOGO RECETAS ESTANDAR',0,1,'C');
  $pdf->Ln(5);
  $pdf->SetFont('Arial','B',9);
  $pdf->Cell(60,6,'Nombre Receta',1,0,'C');
  $pdf->Cell(40,6,'Tipo Receta . ',1,0,'C');
  $pdf->Cell(20,6,'Porciones ',1,1,'C');
  /* $pdf->Cell(25,6,'Valor Costo ',1,0,'C');
  $pdf->Cell(25,6,'Precio Venta ',1,0,'C');
  $pdf->Cell(25,6,'% Costo ',1,1,'C'); */

  $pdf->SetFont('Arial','',9);

  foreach ($recetas as $detalle) {
    $pdf->Cell(60,5,utf8_decode($detalle['nombre_receta']),1,0,'L');
    $pdf->Cell(40,5,utf8_decode($detalle['nombre_seccion']),1,0,'l');
    $pdf->Cell(20,5,$detalle['cantidad'],1,1,'R');

    $productos = $pos->getProductosRecetas($detalle['id_receta']);
    $pdf->Ln(2);
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(20,6,' ',0,0,'C');
    $pdf->Cell(60,6,'Producto',1,0,'C');
    $pdf->Cell(20,6,'Cantidad . ',1,0,'C');
    $pdf->Cell(20,6,'Unidad ',1,0,'C');
    $pdf->Cell(20,6,'Valor ',1,1,'C');
    $pdf->SetFont('Arial','',7);
    $total = 0;
    foreach ($productos as $producto) {
      $pdf->Cell(20,4,' ',0,0,'C');
      $pdf->Cell(60,4,utf8_decode($producto["nombre_producto"]),1,0,'L');
      $pdf->Cell(20,4,number_format($producto["cantidad"],2),1,0,'R');
      $pdf->Cell(20,4,utf8_decode($producto["descripcion_unidad"]),1,0,'L');
      // $pdf->Cell(60,5,number_format($producto["valor_unitario_promedio"],2),1,0,'L');
      $pdf->Cell(20,4,number_format($producto["valor_promedio"],2),1,1,'R');
      $total += $producto["valor_promedio"];
    }
    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(20,5,' ',0,0,'C');
    $pdf->Cell(100,6,'Valor Receta',1,0,'C');
    $pdf->Cell(20,6,number_format($total,2),1,1,'R');
    $pdf->SetFont('Arial','',8);

    $pdf->Ln(2);



    /* $pdf->Cell(25,5,number_format($detalle['valor_costo'],2),1,0,'R');
    $pdf->Cell(25,5,number_format($detalle['valor_venta'],2),1,0,'R');
    $pdf->Cell(25,5,number_format($detalle['por_costo'],0),1,1,'R'); */
  }

  $file = 'informes/'.$key.'.pdf';
  $pdf->Output($file,'F');
  // $pdf->Output($file,'T');
  echo $file;
?>
