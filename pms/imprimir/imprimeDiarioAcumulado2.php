<?php

$horaini = time();

echo $horaini.'Incio <br>'; 

$anio = substr(FECHA_PMS, 0, 4);
$mes = substr(FECHA_PMS, 5, 2);
$hora2 = time();

$query = "SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoDia,
	COALESCE(sum( cargos_pms.impuesto ),0) AS imptoDia 
FROM
	codigos_vta
	LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
	AND cargos_pms.fecha_cargo = '20240820' AND cargos_pms.cargo_anulado = 0
WHERE
	codigos_vta.tipo_codigo = 1 
GROUP BY
	codigos_vta.descripcion_cargo 
ORDER BY
	codigos_vta.descripcion_cargo ASC";

$query2 = "SELECT
codigos_vta.id_cargo,
codigos_vta.descripcion_cargo,
COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoMes,
COALESCE(sum( cargos_pms.impuesto ),0) AS imptoMes
FROM
codigos_vta
LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
AND month(cargos_pms.fecha_cargo) = 8 AND year(cargos_pms.fecha_cargo) = 2024 AND cargos_pms.cargo_anulado = 0
WHERE
codigos_vta.tipo_codigo = 1 
GROUP BY
codigos_vta.descripcion_cargo 
ORDER BY
codigos_vta.descripcion_cargo ASC";

$query3 = "SELECT
codigos_vta.id_cargo,
codigos_vta.descripcion_cargo,
COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoAnio,
COALESCE(sum( cargos_pms.impuesto ),0) AS imptoAnio
FROM
codigos_vta
LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
AND year(cargos_pms.fecha_cargo) = 2024 AND cargos_pms.cargo_anulado = 0
WHERE
codigos_vta.tipo_codigo = 1 
GROUP BY
codigos_vta.descripcion_cargo 
ORDER BY
codigos_vta.descripcion_cargo ASC";

$query4 = "SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisDia,
	COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisDia 
FROM
	codigos_vta
	LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
	AND historico_cargos_pms.fecha_cargo = '20240820' AND historico_cargos_pms.cargo_anulado = 0
WHERE
	codigos_vta.tipo_codigo = 1 
GROUP BY
	codigos_vta.descripcion_cargo 
ORDER BY
	codigos_vta.descripcion_cargo ASC";

$query5 = "SELECT
codigos_vta.id_cargo,
codigos_vta.descripcion_cargo,
COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisMes,
COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisMes
FROM
codigos_vta
LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
AND month(historico_cargos_pms.fecha_cargo) = 8 AND year(historico_cargos_pms.fecha_cargo) = 2024 AND historico_cargos_pms.cargo_anulado = 0
WHERE
codigos_vta.tipo_codigo = 1 
GROUP BY
codigos_vta.descripcion_cargo 
ORDER BY
codigos_vta.descripcion_cargo ASC";

$query6 = "SELECT
codigos_vta.id_cargo,
codigos_vta.descripcion_cargo,
COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisAnio,
COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisAnio
FROM
codigos_vta
LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
AND year(historico_cargos_pms.fecha_cargo) = 2024 AND historico_cargos_pms.cargo_anulado = 0
WHERE
codigos_vta.tipo_codigo = 1 
GROUP BY
codigos_vta.descripcion_cargo 
ORDER BY
codigos_vta.descripcion_cargo ASC";

$query7 = "SELECT a.*, b.*, c.* from 
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoDia,
	COALESCE(sum( cargos_pms.impuesto ),0) AS improDia 
FROM
	codigos_vta
	LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
	AND cargos_pms.fecha_cargo = 20240820 
WHERE
	codigos_vta.tipo_codigo = 1 
GROUP BY
	codigos_vta.id_cargo 
ORDER BY
	codigos_vta.id_cargo) AS a,
	(SELECT
codigos_vta.id_cargo,
codigos_vta.descripcion_cargo,
COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoMes,
COALESCE(sum( cargos_pms.impuesto ),0) AS imptoMes
FROM
codigos_vta
LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
AND month(cargos_pms.fecha_cargo) = 8 AND year(cargos_pms.fecha_cargo) = 2024 AND cargos_pms.cargo_anulado = 0
WHERE
codigos_vta.tipo_codigo = 1 
GROUP BY
codigos_vta.descripcion_cargo 
ORDER BY
codigos_vta.descripcion_cargo ASC) as b,
(SELECT
codigos_vta.id_cargo,
codigos_vta.descripcion_cargo,
COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoAnio,
COALESCE(sum( cargos_pms.impuesto ),0) AS imptoAnio
FROM
codigos_vta
LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
AND year(cargos_pms.fecha_cargo) = 2024 AND cargos_pms.cargo_anulado = 0
WHERE
codigos_vta.tipo_codigo = 1 
GROUP BY
codigos_vta.descripcion_cargo 
ORDER BY
codigos_vta.descripcion_cargo ASC) as c
WHERE a.id_cargo = b.id_cargo AND b.id_cargo = c.id_cargo ORDER BY a.descripcion_cargo";

$query8 = "SELECT d.*, e.*, f.* from 
	(SELECT
		codigos_vta.id_cargo,
		codigos_vta.descripcion_cargo,
		COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisDia,
		COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisDia 
		FROM
			codigos_vta
			LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
			AND historico_cargos_pms.fecha_cargo = 20240820 
		WHERE
			codigos_vta.tipo_codigo = 1 
		GROUP BY
			codigos_vta.id_cargo 
		ORDER BY
			codigos_vta.id_cargo) AS d,
	(SELECT
		codigos_vta.id_cargo,
		codigos_vta.descripcion_cargo,
		COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisMes,
		COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisMes
		FROM
		codigos_vta
		LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
		AND month(historico_cargos_pms.fecha_cargo) = 8 AND year(historico_cargos_pms.fecha_cargo) = 2024 AND historico_cargos_pms.cargo_anulado = 0
		WHERE
		codigos_vta.tipo_codigo = 1 
		GROUP BY
		codigos_vta.descripcion_cargo 
		ORDER BY
		codigos_vta.descripcion_cargo ASC) as e,
	(SELECT
		codigos_vta.id_cargo,
		codigos_vta.descripcion_cargo,
		COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisAnio,
		COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisAnio
		FROM
		codigos_vta
		LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
		AND year(historico_cargos_pms.fecha_cargo) = 2024 AND historico_cargos_pms.cargo_anulado = 0
		WHERE
		codigos_vta.tipo_codigo = 1 
		GROUP BY
		codigos_vta.descripcion_cargo 
		ORDER BY
		codigos_vta.descripcion_cargo ASC) as f
		WHERE d.id_cargo = e.id_cargo AND e.id_cargo = f.id_cargo ORDER BY d.descripcion_cargo";

$query9 = "SELECT a.*, b.*, c.*, d.*, e.*, f.* from 
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoDia,
	COALESCE(sum( cargos_pms.impuesto ),0) AS improDia 
	FROM
		codigos_vta
		LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
		AND cargos_pms.fecha_cargo = 20240820 
	WHERE
		codigos_vta.tipo_codigo = 1 
	GROUP BY
		codigos_vta.id_cargo 
	ORDER BY
		codigos_vta.id_cargo) AS a,
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoMes,
	COALESCE(sum( cargos_pms.impuesto ),0) AS imptoMes
	FROM
	codigos_vta
	LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
	AND month(cargos_pms.fecha_cargo) = 8 AND year(cargos_pms.fecha_cargo) = 2024 AND cargos_pms.cargo_anulado = 0
	WHERE
	codigos_vta.tipo_codigo = 1 
	GROUP BY
	codigos_vta.descripcion_cargo 
	ORDER BY
	codigos_vta.descripcion_cargo ASC) as b,
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoAnio,
	COALESCE(sum( cargos_pms.impuesto ),0) AS imptoAnio
	FROM
	codigos_vta
	LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
	AND year(cargos_pms.fecha_cargo) = 2024 AND cargos_pms.cargo_anulado = 0
	WHERE
	codigos_vta.tipo_codigo = 1 
	GROUP BY
	codigos_vta.descripcion_cargo 
	ORDER BY
	codigos_vta.descripcion_cargo ASC) as c,
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisDia,
	COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisDia 
	FROM
		codigos_vta
		LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
		AND historico_cargos_pms.fecha_cargo = 20240820 
	WHERE
		codigos_vta.tipo_codigo = 1 
	GROUP BY
		codigos_vta.id_cargo 
	ORDER BY
		codigos_vta.id_cargo) AS d,
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisMes,
	COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisMes
	FROM
	codigos_vta
	LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
	AND month(historico_cargos_pms.fecha_cargo) = 8 AND year(historico_cargos_pms.fecha_cargo) = 2024 AND historico_cargos_pms.cargo_anulado = 0
	WHERE
	codigos_vta.tipo_codigo = 1 
	GROUP BY
	codigos_vta.descripcion_cargo 
	ORDER BY
	codigos_vta.descripcion_cargo ASC) as e,
(SELECT
	codigos_vta.id_cargo,
	codigos_vta.descripcion_cargo,
	COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisAnio,
	COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisAnio
	FROM
	codigos_vta
	LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
	AND year(historico_cargos_pms.fecha_cargo) = 2024 AND historico_cargos_pms.cargo_anulado = 0
	WHERE
	codigos_vta.tipo_codigo = 1 
	GROUP BY
	codigos_vta.descripcion_cargo 
	ORDER BY
	codigos_vta.descripcion_cargo ASC) as f
WHERE a.id_cargo = b.id_cargo AND b.id_cargo = c.id_cargo and c.id_cargo = d.id_cargo AND d.id_cargo = e.id_cargo AND e.id_cargo = f.id_cargo ORDER BY a.descripcion_cargo";

$cargos9 = $hotel->creaConsulta($query9);

/* echo print_r($cargos1);
echo print_r($cargos2);
echo print_r($cargos3);
echo print_r($cargos4);
echo print_r($cargos5);
echo print_r($cargos6); */
// echo print_r($cargos7);
echo print_r($cargos9);


echo $hora2 - $horaini.'COnsulta <br>';



$horafin = time();
$duracion = $horafin - $horaini ;
echo $horafin.'HOta fin<br> '; 
echo $duracion.'Dura <br> ';
echo time(); 

$pdf->Output($file, 'F');
