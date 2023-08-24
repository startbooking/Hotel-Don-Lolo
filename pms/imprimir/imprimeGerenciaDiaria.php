<?php 
  
  $anio          = substr(FECHA_PMS,0,4); 
  $mes           = substr(FECHA_PMS,5,2); 
  $dia           = substr(FECHA_PMS,8,2); 
  $auditoria     = $hotel->getDatosAuditoria(FECHA_PMS); 
  $acumulames    = $hotel->getDatosMesAuditoria($mes,$anio); 
  $acumulaanio   = $hotel->getDatosAnioAuditoria($anio); 
  
  $saldia       = $auditoria[0]['salidas_dia'];
  $lledia       = $auditoria[0]['llegadas_dia'];
  $habdis       = $auditoria[0]['habitaciones_disponibles'];
  $habocu       = $auditoria[0]['habitaciones_ocupadas'];
  $habfor       = $auditoria[0]['habitaciones_fuera_orden'];
  $habfse       = $auditoria[0]['habitaciones_fuera_servicio'];
  $habcor       = $auditoria[0]['habitaciones_cortesia'];
  $habuso       = $auditoria[0]['habitaciones_usocasa'];
  $habdia       = $auditoria[0]['habitaciones_usodia'];
  
  $ingtot       = $auditoria[0]['ingreso_habitaciones'];
  $imptot       = $auditoria[0]['ingreso_impto_habitaciones'];
  $ingprohabdis = $auditoria[0]['ingreso_promedio_habitacion_disponible'];
  $ingprohabocu = $auditoria[0]['ingreso_promedio_habitacion_ocupada'];
  $ingcomp      = $auditoria[0]['ingresos_compania'];
  $ingagen      = $auditoria[0]['ingresos_agencia'];
  $inggrup      = $auditoria[0]['ingresos_grupo'];
  $ingindi      = $auditoria[0]['ingresos_individual'];
  $ingpromhue   = $auditoria[0]['ingreso_promedio_huesped'];
  $ingpot       = $auditoria[0]['ingreso_potencial'];
  $ingtot       = $auditoria[0]['ingreso_habitaciones'];

  $habdisven    = $habdis - $habfor - $habfse;
  
  $camdis       = $auditoria[0]['camas_disponibles'];
  $hom          = $auditoria[0]['hombres'];
  $muj          = $auditoria[0]['mujeres'];
  $nin          = $auditoria[0]['ninos'];
  $huerep       = $auditoria[0]['huespedes_repetitivos'];
  $nuehue       = $auditoria[0]['nuevos_huespedes'];
  $huenal       = $auditoria[0]['huespedes_nacionales'];
  $hueint       = $auditoria[0]['huespedes_extranjeros'];
  $reshoy       = $auditoria[0]['reservas_creadashoy'];
  $resnos       = $auditoria[0]['reservas_noshows'];
  $salant       = $auditoria[0]['salidas_anticipadas'];
  $rescan       = $auditoria[0]['reservas_canceladas'];
  $llesin       = $auditoria[0]['llegadas_sinreserva'];
  
  $messaldia       = $acumulames[0]['msalDia'];
  $meslledia       = $acumulames[0]['mlleDia'];
  $meshabdis       = $acumulames[0]['mhabDis'];
  $meshabocu       = $acumulames[0]['mhabOcu'];
  $meshabfor       = $acumulames[0]['mhabFor'];
  $meshabfse       = $acumulames[0]['mhabFse'];
  $meshabcor       = $acumulames[0]['mhabCor'];
  $meshabuso       = $acumulames[0]['mhabUca'];
  $meshabdia       = $acumulames[0]['mhabUdi'];
  $meshabdisven    = $meshabdis - $meshabfor - $meshabfse;
  
  $mesingtot       = $acumulames[0]['mingHab'];
  $mesimptot       = $acumulames[0]['mingImp'];
  $mesingprohabdis = $acumulames[0]['mingProHabDis'];
  $mesingprohabocu = $acumulames[0]['mingProHabOcu'];
  $mesingcomp      = $acumulames[0]['mingCom'];
  $mesingagen      = $acumulames[0]['mingAge'];
  $mesinggrup      = $acumulames[0]['mingGru'];
  $mesingindi      = $acumulames[0]['mingInd'];
  $mesingpromhue   = $acumulames[0]['mproHue'];
  
  $mescamdis       = $acumulames[0]['mcamDis'];
  $meshom          = $acumulames[0]['mHom'];
  $mesmuj          = $acumulames[0]['mMuj'];
  $mesnin          = $acumulames[0]['mNin'];
  $meshuerep       = $acumulames[0]['mhueRep'];
  $mesnuehue       = $acumulames[0]['mhueNue'];
  $meshuenal       = $acumulames[0]['mhueNal'];
  $meshueint       = $acumulames[0]['mhueInt'];
  $mesreshoy       = $acumulames[0]['mresHoy'];
  $mesresnos       = $acumulames[0]['mresNos'];
  $messalant       = $acumulames[0]['msalAnt'];
  $mesrescan       = $acumulames[0]['mresCan'];
  $mesllesin       = $acumulames[0]['mlleSin'];
  
  $aniosaldia       = $acumulaanio[0]['asalDia'];
  $aniolledia       = $acumulaanio[0]['alleDia'];
  $aniohabdis       = $acumulaanio[0]['ahabDis'];
  $aniohabocu       = $acumulaanio[0]['ahabOcu'];
  $aniohabfor       = $acumulaanio[0]['ahabFor'];
  $aniohabfse       = $acumulaanio[0]['ahabFse'];
  $aniohabcor       = $acumulaanio[0]['ahabCor'];
  $aniohabuso       = $acumulaanio[0]['ahabUca'];
  $aniohabdia       = $acumulaanio[0]['ahabUdi'];
  $aniohabdisven    = $aniohabdis - $aniohabfor - $aniohabfse;
  
  $anioingtot       = $acumulaanio[0]['aingHab'];
  $anioimptot       = $acumulaanio[0]['aingImp'];
  $anioingprohabdis = $acumulaanio[0]['aingProHabDis'];
  $anioingprohabocu = $acumulaanio[0]['aingProHabDis'];
  $anioingcomp      = $acumulaanio[0]['aingCom'];
  $anioingagen      = $acumulaanio[0]['aingAge'];
  $anioinggrup      = $acumulaanio[0]['aingGru'];
  $anioingindi      = $acumulaanio[0]['aingInd'];
  $anioingpromhue   = $acumulaanio[0]['aproHue'];  
  
  $aniocamdis       = $acumulaanio[0]['acamDis'];
  $aniohom          = $acumulaanio[0]['aHom'];
  $aniomuj          = $acumulaanio[0]['aMuj'];
  $anionin          = $acumulaanio[0]['aNin'];
  $aniohuerep       = $acumulaanio[0]['ahueRep'];
  $anionuehue       = $acumulaanio[0]['ahueNue'];
  $aniohuenal       = $acumulaanio[0]['ahueNal'];
  $aniohueint       = $acumulaanio[0]['ahueInt'];
  $anioreshoy       = $acumulaanio[0]['aresHoy'];
  $anioresnos       = $acumulaanio[0]['aresNos'];
  $aniosalant       = $acumulaanio[0]['asalAnt'];
  $aniorescan       = $acumulaanio[0]['aresCan'];
  $aniollesin       = $acumulaanio[0]['alleSin'];
 
  $salidas       = $auditoria[0]['salidas_dia'];
  $llegadas      = $auditoria[0]['llegadas_dia'];  
  $hom           = $auditoria[0]['hombres'];
  $muj           = $auditoria[0]['mujeres'];
  $nin           = $auditoria[0]['ninos'];
  $camas         = $auditoria[0]['camas_disponibles'];

  $pdf = new PDF();
  $pdf->AddPage('P','letter');
  $pdf->SetFont('Arial','B',11);
  $pdf->Cell(190,5,'INFORME DIARIO DE GERENCIA ',0,1,'C');
  $pdf->SetFont('Arial','',11);
  $pdf->Cell(190,5,'Fecha : '.FECHA_PMS,0,1,'C');
  $pdf->Ln(3);

  $pdf->SetFont('Arial','',9);
  $pdf->Cell(45,6,'Habitaciones Ocupadas',1,0,'L');
  $pdf->Cell(25,6,$habocu,1,1,'R');
  $pdf->Cell(45,6,'Ocupacion del Dia',1,0,'L');
  $pdf->Cell(25,6,number_format((($habocu/$habdisven)*100),2).' %',1,1,'R');
  $pdf->Cell(45,6,'Ocupadas Mes',1,0,'L');
  $pdf->Cell(25,6,$meshabocu,1,1,'R');
  $pdf->Cell(45,6,'Ocupacion del Mes',1,0,'L');
  $pdf->Cell(25,6,number_format((($meshabocu/$meshabdisven)*100),2).' %',1,1,'R');

  $pdf->Ln(5);

  $pdf->Cell(45,6,'Descripcion',1,0,'C');
  $pdf->Cell(25,6,'Ingreso Dia',1,0,'C');
  $pdf->Cell(25,6,'Ingreso Mes',1,0,'C');
  $pdf->Cell(25,6,utf8_decode('Ingreso Año'),1,1,'C');
  $pdf->Cell(45,6,'Ingreso Habitaciones',1,0,'L');
  $pdf->Cell(25,6,number_format($ingtot,2),1,0,'R');
  $pdf->Cell(25,6,number_format($mesingtot,2),1,0,'R');
  $pdf->Cell(25,6,number_format($anioingtot,2),1,1,'R');
  $pdf->Cell(45,6,'Tarifa Prom. Habitacion',1,0,'L');
  $pdf->Cell(25,6,number_format($ingprohabdis,2),1,0,'R');
  $pdf->Cell(25,6,number_format(round($mesingtot/ $meshabdis,2),2),1,0,'R');
  $pdf->Cell(25,6,number_format(round($anioingtot/ $aniohabdis,2),2),1,1,'R');
  $pdf->Cell(45,6,'Tarifa Prom. Habi. Ocup.',1,0,'L');
  $pdf->Cell(25,6,number_format($ingprohabocu,2),1,0,'R');
  $pdf->Cell(25,6,number_format(round($mesingtot/ $meshabocu,2),2),1,0,'R');
  $pdf->Cell(25,6,number_format(round($anioingtot/ $aniohabocu,2),2),1,1,'R');

  $pdf->Ln(3);

  $pdf->Cell(45,6,'Descripcion',1,0,'C');
  $pdf->Cell(15,6,'Dia',1,0,'C');  
  $pdf->Cell(15,6,'Mes',1,0,'C');  
  $pdf->Cell(15,6,utf8_decode('Año'),1,0,'C');  
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(90,6,'HUESPEDES',1,1,'C');  

  $pdf->Cell(45,6,'Habitaciones Disponibles',1,0,'L');
  $pdf->Cell(15,6,$habdis,1,0,'R');
  $pdf->Cell(15,6,$meshabdis,1,0,'R');
  $pdf->Cell(15,6,$aniohabdis,1,0,'R');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,'Pernoctaciones Disponibles ',1,0,'L');
  $pdf->Cell(15,6,$camdis,1,0,'R');
  $pdf->Cell(15,6,$mescamdis,1,0,'R');
  $pdf->Cell(15,6,$aniocamdis,1,1,'R');

  $pdf->Cell(45,6,'Habitaciones Fuera de Orden',1,0,'L');
  $pdf->Cell(15,6,$habfor,1,0,'R');
  $pdf->Cell(15,6,$meshabfor,1,0,'R');
  $pdf->Cell(15,6,$aniohabfor,1,0,'R');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,'Huespedes en Casa ',1,0,'L');
  $pdf->Cell(15,6,$hom+$muj+$nin,1,0,'R');
  $pdf->Cell(15,6,$meshom+$mesmuj+$mesnin,1,0,'R');
  $pdf->Cell(15,6,$aniohom+$aniomuj+$anionin,1,1,'R');

  $pdf->Cell(45,6,'Habitaciones Fuera de Servicio',1,0,'L');
  $pdf->Cell(15,6,$habfse,1,0,'R');
  $pdf->Cell(15,6,$meshabfse,1,0,'R');
  $pdf->Cell(15,6,$aniohabfse,1,0,'R');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,'Hombres en Casa ',1,0,'L');
  $pdf->Cell(15,6,$hom,1,0,'R');
  $pdf->Cell(15,6,$meshom,1,0,'R');
  $pdf->Cell(15,6,$aniohom,1,1,'R');

  $pdf->Cell(45,6,'Habitaciones Disponible Venta',1,0,'L');
  $pdf->Cell(15,6,$habdisven,1,0,'R');
  $pdf->Cell(15,6,$meshabdisven,1,0,'R');
  $pdf->Cell(15,6,$aniohabdisven,1,0,'R');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,'Mujeres en Casa ',1,0,'L');
  $pdf->Cell(15,6,$muj,1,0,'R');
  $pdf->Cell(15,6,$mesmuj,1,0,'R');
  $pdf->Cell(15,6,$aniomuj,1,1,'R');

  $pdf->Cell(45,6,'Habitaciones Ocupadas',1,0,'L');
  $pdf->Cell(15,6,$habocu,1,0,'R');
  $pdf->Cell(15,6,$meshabocu,1,0,'R');
  $pdf->Cell(15,6,$aniohabocu,1,0,'R');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Niños en Casa '),1,0,'L');
  $pdf->Cell(15,6,$nin,1,0,'R');
  $pdf->Cell(15,6,$mesnin,1,0,'R');
  $pdf->Cell(15,6,$anionin,1,1,'R');

  $pdf->Cell(45,6,'Habitaciones Vacantes',1,0,'L');
  $pdf->Cell(15,6,$habdisven - $habocu,1,0,'R');
  $pdf->Cell(15,6,$meshabdisven - $meshabocu,1,0,'R');
  $pdf->Cell(15,6,$aniohabdisven - $aniohabocu,1,0,'R');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Huespedes Repetitivos '),1,0,'L');
  $pdf->Cell(15,6,$huerep,1,0,'R');
  $pdf->Cell(15,6,$meshuerep,1,0,'R');
  $pdf->Cell(15,6,$aniohuerep,1,1,'R');

  $pdf->Cell(45,6,'% Ocupacion ',1,0,'L');
  if($habdisven==0){
    $pdf->Cell(15,6,number_format(100,2),1,0,'R');
  }else{
    $pdf->Cell(15,6,number_format($habocu / $habdisven*100,2),1,0,'R');
  }

  if($meshabdisven==0){
    $pdf->Cell(15,6,number_format(100,2),1,0,'R');
  }else{
    $pdf->Cell(15,6,number_format(($meshabocu / $meshabdisven)*100,2),1,0,'R');
  }
  if($aniohabdisven==0){
    $pdf->Cell(15,6,number_format(00,2),1,1,'R');
  }else{
    $pdf->Cell(15,6,number_format(($aniohabocu / $aniohabdisven)*100,2),1,0,'R');
  }
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Huespedes Nuevos '),1,0,'L');
  $pdf->Cell(15,6,$nuehue,1,0,'R');
  $pdf->Cell(15,6,$mesnuehue,1,0,'R');
  $pdf->Cell(15,6,$anionuehue,1,1,'R');


  $pdf->Cell(100,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Huespedes Nacionales '),1,0,'L');
  $pdf->Cell(15,6,$huenal,1,0,'R');
  $pdf->Cell(15,6,$meshuenal,1,0,'R');
  $pdf->Cell(15,6,$aniohuenal,1,1,'R');

  $pdf->Cell(100,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Huespedes Extranjeros '),1,0,'L');
  $pdf->Cell(15,6,$hueint,1,0,'R');
  $pdf->Cell(15,6,$meshueint,1,0,'R');
  $pdf->Cell(15,6,$aniohueint,1,1,'R');

  $pdf->Ln(3);

  $pdf->Cell(45,6,'Reservas ',1,0,'L');
  $pdf->Cell(15,6,$reshoy,1,0,'C');
  $pdf->Cell(15,6,$mesreshoy,1,0,'C');
  $pdf->Cell(15,6,$anioreshoy,1,0,'C');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Salidas del Dia '),1,0,'L');
  $pdf->Cell(15,6,$saldia,1,0,'R');
  $pdf->Cell(15,6,$messaldia,1,0,'R');
  $pdf->Cell(15,6,$aniosaldia,1,1,'R');

  $pdf->Cell(45,6,'Reservas no Show',1,0,'L');
  $pdf->Cell(15,6,$resnos,1,0,'C');
  $pdf->Cell(15,6,$mesresnos,1,0,'C');
  $pdf->Cell(15,6,$anioresnos,1,0,'C');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Salidas Anticipadas '),1,0,'L');
  $pdf->Cell(15,6,$salant,1,0,'R');
  $pdf->Cell(15,6,$messalant,1,0,'R');
  $pdf->Cell(15,6,$aniosalant,1,1,'R');
  
  $pdf->Cell(45,6,'Reservas Canceladas',1,0,'L');
  $pdf->Cell(15,6,$rescan,1,0,'C');
  $pdf->Cell(15,6,$mesrescan,1,0,'C');
  $pdf->Cell(15,6,$aniorescan,1,0,'C');
  $pdf->Cell(10,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Llegadas del Dia'),1,0,'L');
  $pdf->Cell(15,6,$lledia,1,0,'R');
  $pdf->Cell(15,6,$meslledia,1,0,'R');
  $pdf->Cell(15,6,$aniolledia,1,1,'R');

  $pdf->Cell(100,6,'',0,0,'C');  
  $pdf->Cell(45,6,utf8_decode('Llegadas Sin Reserva'),1,0,'L');
  $pdf->Cell(15,6,$llesin,1,0,'R');
  $pdf->Cell(15,6,$mesllesin,1,0,'R');
  $pdf->Cell(15,6,$aniollesin,1,1,'R');

  $file = '../../imprimir/auditorias/Informe_Diario_Gerencia_'.FECHA_PMS.'.pdf';
  $pdf->Output($file,'F');
?>
