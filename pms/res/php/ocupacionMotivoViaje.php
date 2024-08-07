<?php 

  require '../../../res/php/app_topHotel.php'; 

  $query = "SELECT
	sum(historico_reservas_pms.can_hombres + historico_reservas_pms.can_mujeres) AS huespedes, 
  sum(historico_reservas_pms.dias_reservados) as dias,
	grupos_cajas.descripcion_grupo
FROM
	historico_reservas_pms
	LEFT JOIN
	grupos_cajas
	ON
		historico_reservas_pms.motivo_viaje = grupos_cajas.id_grupo
WHERE
	grupos_cajas.caja = 'MVI' AND
	historico_reservas_pms.estado = 'SA' AND
	historico_reservas_pms.tipo_habitacion != '1' AND
  MONTH(historico_reservas_pms.fecha_salida) = 7 AND
	year(historico_reservas_pms.fecha_salida) = 2024
GROUP BY
	grupos_cajas.descripcion_grupo
ORDER BY
	grupos_cajas.descripcion_grupo ASC";
  

  $motivos = $hotel->reservasPorMotivo($query);

  echo print_r($motivos);


  $query2 = "SELECT
	sum(historico_reservas_pms.can_hombres + historico_reservas_pms.can_mujeres) AS huespedes,
	sum(historico_reservas_pms.dias_reservados) AS dias
FROM
	historico_reservas_pms
WHERE
	historico_reservas_pms.estado = 'SA' AND
	historico_reservas_pms.tipo_habitacion != '1' AND
	MONTH(historico_reservas_pms.fecha_salida) = 7 AND
	year(historico_reservas_pms.fecha_salida) = 2024";

$motivos = $hotel->reservasPorMotivo($query2);

echo print_r($motivos);


?>