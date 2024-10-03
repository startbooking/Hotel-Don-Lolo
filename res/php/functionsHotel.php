<?php

require_once 'init.php';
date_default_timezone_set('America/Bogota');

class Hotel_Actions
{

    public function getAjustesCargosDelDia(){
        global $database;

        $data = $database->query("SELECT
            sum(cargos_pms.monto_cargo) AS monto, 
            sum(cargos_pms.impuesto) as imptos, 
            sum(cargos_pms.valor_cargo) as cargos, 
            cargos_pms.tipo_factura, 
            cargos_pms.fecha_factura, 
            cargos_pms.usuario_factura, 
            cargos_pms.factura_numero, 
            cargos_pms.fecha_sistema_cargo,
            reservas_pms.fecha_llegada, 
            reservas_pms.fecha_salida, 
            reservas_pms.num_habitacion, 
            huespedes.nombre_completo,
            huespedes.nombre1,
            huespedes.nombre2,
            huespedes.apellido1,
            huespedes.apellido2
        FROM
            cargos_pms
            INNER JOIN
            reservas_pms
            ON 
                cargos_pms.numero_reserva = reservas_pms.num_reserva
            INNER JOIN
            huespedes
            ON 
                reservas_pms.id_huesped = huespedes.id_huesped
        WHERE
            cargos_pms.tipo_factura = 3
        GROUP BY
        cargos_pms.factura_numero
        ORDER BY 
        cargos_pms.factura_numero")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public function traeNumeroAjuste()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_ajuste_cuenta',
        ]);

        return $data;
    }

    public function traeReservasTotal(){
        global $database;

            $data = $database->query("SELECT a.fecha_llegada, a.reservas, COALESCE(b.salidas,0)  as salidas 
            FROM
                (
                SELECT
                    reservas_pms.fecha_llegada,
                    COALESCE ( count( reservas_pms.num_reserva ), 0 ) AS reservas 
                FROM
                    reservas_pms 
                WHERE
                    estado = 'ES' 
                GROUP BY
                    reservas_pms.fecha_llegada 
                ORDER BY
                    reservas_pms.fecha_llegada ASC 
                ) AS a
                LEFT JOIN (
                SELECT
                    reservas_pms.fecha_salida,
                    COALESCE ( count( reservas_pms.num_reserva ), 0 ) AS salidas 
                FROM
                    reservas_pms 
                WHERE
                    estado = 'CA' 
                GROUP BY
                    reservas_pms.fecha_salida 
                ORDER BY
                    reservas_pms.fecha_salida ASC 
                ) AS b ON a.fecha_llegada = b.fecha_salida 
            ORDER BY
                a.fecha_llegada ASC")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function traeAcumuladoVentas($fecha, $mes, $anio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT a.*, b.*, c.*, d.*, e.*, f.* from 
            (SELECT
                codigos_vta.id_cargo,
                codigos_vta.descripcion_cargo,
                COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoDia,
                COALESCE(sum( cargos_pms.impuesto ),0) AS imptoDia,
                COALESCE(sum( cargos_pms.pagos_cargos ),0) AS pagosDia
                FROM
                    codigos_vta
                    LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
                    AND cargos_pms.fecha_cargo = '$fecha' 
                WHERE
                    codigos_vta.tipo_codigo = $tipo
                GROUP BY
                    codigos_vta.id_cargo 
                ORDER BY
                    codigos_vta.id_cargo) AS a,
            (SELECT
                codigos_vta.id_cargo,
                codigos_vta.descripcion_cargo,
                COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoMes,
                COALESCE(sum( cargos_pms.impuesto ),0) AS imptoMes,
                COALESCE(sum( cargos_pms.pagos_cargos ),0) AS pagosMes
                FROM
                codigos_vta
                LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
                AND month(cargos_pms.fecha_cargo) = $mes AND year(cargos_pms.fecha_cargo) = $anio AND cargos_pms.cargo_anulado = 0
                WHERE
                codigos_vta.tipo_codigo = $tipo
                GROUP BY
                codigos_vta.descripcion_cargo 
                ORDER BY
                codigos_vta.descripcion_cargo ASC) as b,
            (SELECT
                codigos_vta.id_cargo,
                codigos_vta.descripcion_cargo,
                COALESCE(sum( cargos_pms.monto_cargo ),0) AS cargoAnio,
                COALESCE(sum( cargos_pms.impuesto ),0) AS imptoAnio,
                COALESCE(sum( cargos_pms.pagos_cargos ),0) AS pagosAnio
                FROM
                codigos_vta
                LEFT JOIN cargos_pms ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo 
                AND year(cargos_pms.fecha_cargo) = $anio AND cargos_pms.cargo_anulado = 0
                WHERE
                codigos_vta.tipo_codigo = $tipo
                GROUP BY
                codigos_vta.descripcion_cargo 
                ORDER BY
                codigos_vta.descripcion_cargo ASC) as c,
            (SELECT
                codigos_vta.id_cargo,
                codigos_vta.descripcion_cargo,
                COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisDia,
                COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisDia,
                COALESCE(sum( historico_cargos_pms.pagos_cargos ),0) AS pagosHisDia
                FROM
                    codigos_vta
                    LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
                    AND historico_cargos_pms.fecha_cargo = '$fecha' 
                WHERE
                    codigos_vta.tipo_codigo = $tipo
                GROUP BY
                    codigos_vta.id_cargo 
                ORDER BY
                    codigos_vta.id_cargo) AS d,
            (SELECT
                codigos_vta.id_cargo,
                codigos_vta.descripcion_cargo,
                COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisMes,
                COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisMes,
                COALESCE(sum( historico_cargos_pms.pagos_cargos ),0) AS pagosHisMes
                FROM
                codigos_vta
                LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
                AND month(historico_cargos_pms.fecha_cargo) = $mes AND year(historico_cargos_pms.fecha_cargo) = $anio AND historico_cargos_pms.cargo_anulado = 0
                WHERE
                codigos_vta.tipo_codigo = $tipo
                GROUP BY
                codigos_vta.descripcion_cargo 
                ORDER BY
                codigos_vta.descripcion_cargo ASC) as e,
            (SELECT
                codigos_vta.id_cargo,
                codigos_vta.descripcion_cargo,
                COALESCE(sum( historico_cargos_pms.monto_cargo ),0) AS cargoHisAnio,
                COALESCE(sum( historico_cargos_pms.impuesto ),0) AS imptoHisAnio,
                COALESCE(sum( historico_cargos_pms.pagos_cargos ),0) AS pagosHisAnio
                FROM
                codigos_vta
                LEFT JOIN historico_cargos_pms ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo 
                AND year(historico_cargos_pms.fecha_cargo) = $anio AND historico_cargos_pms.cargo_anulado = 0
                WHERE
                codigos_vta.tipo_codigo = $tipo
                GROUP BY
                codigos_vta.descripcion_cargo 
                ORDER BY
                codigos_vta.descripcion_cargo ASC) as f
            WHERE a.id_cargo = b.id_cargo AND b.id_cargo = c.id_cargo and c.id_cargo = d.id_cargo AND d.id_cargo = e.id_cargo AND e.id_cargo = f.id_cargo ORDER BY a.descripcion_cargo")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function traeHabitacionesMmtoDia($tipo)
    {
        global $database;

        $data = $database->select('habitaciones', [
            '[>]tipo_habitaciones' => ['id_tipohabitacion' => 'id'],
        ], [
            'habitaciones.numero_hab',
            'tipo_habitaciones.descripcion_habitacion',
        ], [
            'habitaciones.active_at' => 1,
            'habitaciones.mantenimiento' => 1,
            'tipo_habitaciones.tipo_habitacion' => $tipo,
        ]);

        return $data;
    }

    public function estadoHuespedesHotel()
    {
        global $database;

        $data = $database->query("SELECT
            a.*,
            a.huecas - b.repetidos AS nuehues,
            b.*,
            c.*,
            d.* 
        FROM
            (
            SELECT COALESCE
                ( COUNT( reservas_pms.id ), 0 ) AS habcasa,
                COALESCE ( sum( reservas_pms.can_hombres + reservas_pms.can_mujeres + reservas_pms.can_ninos ), 0 ) AS huecas 
            FROM
                reservas_pms
                INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
            WHERE
                reservas_pms.estado = 'CA' 
                AND tipo_habitaciones.tipo_habitacion = 1 
            ) AS a,
            (
            SELECT
                COUNT( a.id_huesped ) repetidos 
            FROM
                (
                SELECT
                    count( id_huesped ) AS huesped,
                    id_huesped 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    reservas_pms.estado = 'CA' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                GROUP BY
                    reservas_pms.id_huesped 
                ) AS a,
                (
                SELECT
                    count( historico_reservas_pms.id_huesped ) AS huesped,
                    historico_reservas_pms.id_huesped 
                FROM
                    historico_reservas_pms
                    INNER JOIN tipo_habitaciones ON historico_reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    estado = 'SA' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                GROUP BY
                    historico_reservas_pms.id_huesped 
                ) AS b 
            WHERE
                a.id_huesped = b.id_huesped 
            ) AS b,
            (
            SELECT COALESCE
                ( sum( reservas_pms.can_hombres + reservas_pms.can_mujeres + reservas_pms.can_ninos ), 0 ) AS extcas 
            FROM
                reservas_pms
                INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id
                INNER JOIN huespedes ON reservas_pms.id_huesped = huespedes.id_huesped 
            WHERE
                reservas_pms.estado = 'CA' 
                AND tipo_habitaciones.tipo_habitacion = 1 
                AND huespedes.pais <> 46 
            ) AS c,
            (
            SELECT COALESCE
                ( sum( reservas_pms.can_hombres + reservas_pms.can_mujeres + reservas_pms.can_ninos ), 0 ) AS nalcas 
            FROM
                reservas_pms
                INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id
                INNER JOIN huespedes ON reservas_pms.id_huesped = huespedes.id_huesped 
            WHERE
                reservas_pms.estado = 'CA' 
                AND tipo_habitaciones.tipo_habitacion = 1 
            AND huespedes.pais = 46 
            ) AS d")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function ingresoDiarioAgrupacion($fecha, $agrup)
    {
        global $database;

        $data = $database->query("SELECT a.*, b.*, c.* FROM (
            SELECT
            COALESCE
            ( SUM( cargos_pms.monto_cargo ), 0 ) AS cargos, 
            COALESCE ( SUM( cargos_pms.impuesto ), 0 ) AS impto, 
            COALESCE ( SUM( cargos_pms.valor_cargo ), 0 ) AS total
        FROM
            cargos_pms
            INNER JOIN
            codigos_vta
            ON 
                cargos_pms.id_codigo_cargo = codigos_vta.id_cargo
            INNER JOIN
            reservas_pms
            ON 
                cargos_pms.numero_reserva = reservas_pms.num_reserva
        WHERE
            cargos_pms.fecha_cargo = '$fecha' AND
            cargos_pms.cargo_anulado = 0 AND
            codigos_vta.agrupacion = 'HA' ) AS a, 
            (SELECT
            COALESCE
            ( SUM( cargos_pms.monto_cargo ), 0 ) AS carindi, 
            COALESCE ( SUM( cargos_pms.impuesto ), 0 ) AS impindi, 
            COALESCE ( SUM( cargos_pms.valor_cargo ), 0 ) AS totindi
        FROM
            cargos_pms
            INNER JOIN
            codigos_vta
            ON 
                cargos_pms.id_codigo_cargo = codigos_vta.id_cargo
            INNER JOIN
            reservas_pms
            ON 
                cargos_pms.numero_reserva = reservas_pms.num_reserva
        WHERE
            cargos_pms.fecha_cargo = '$fecha' AND
            cargos_pms.cargo_anulado = 0 AND
            codigos_vta.agrupacion = 'HA' AND
            reservas_pms.id_compania = 0 ) as b,
            ( SELECT
            COALESCE
            ( SUM( cargos_pms.monto_cargo ), 0 ) AS carcomp, 
            COALESCE ( SUM( cargos_pms.impuesto ), 0 ) AS impcomp, 
            COALESCE ( SUM( cargos_pms.valor_cargo ), 0 ) AS totcomp
        FROM
            cargos_pms
            INNER JOIN
            codigos_vta
            ON 
                cargos_pms.id_codigo_cargo = codigos_vta.id_cargo
            INNER JOIN
            reservas_pms
            ON 
                cargos_pms.numero_reserva = reservas_pms.num_reserva
        WHERE
            cargos_pms.fecha_cargo = '$fecha' AND
            cargos_pms.cargo_anulado = 0 AND
            codigos_vta.agrupacion = 'HA' AND
            reservas_pms.id_compania > 0 ) as c")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function ocupacionHotel($fecha)
    {
        global $database;

        $data = $database->query("SELECT
                a.*,
                b.*,
                c.*,
                d.*,
                e.*,
                f.*,
                g.*,
                h.*,
                i.*, 
                j.*,
                k.*
            FROM
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS salidas,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homsal,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujsal,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninsal 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    salida_checkout = '$fecha' 
                    AND estado = 'SA' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS a,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS llegadas,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homlle,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujlle,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninlle 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_llegada = '$fecha' 
                    AND estado = 'CA' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS b,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS cancela,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homcan,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujcan,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS nincan 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_llegada = '$fecha' 
                    AND estado = 'CX' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS c,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS noshow,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homnsh,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujnsh,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninnsh 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_llegada = '$fecha' 
                    AND estado = 'NS' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS d,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS creadashoy,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homhoy,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujhoy,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninhoy 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_reserva = '$fecha' 
                    AND estado = 'ES' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS e,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS saleantes,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homant,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujant,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninant 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_salida <> salida_checkout 
                    AND estado = 'SA' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS f,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS sinreserva,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homsin,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujsin,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninsin 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_llegada = '$fecha' 
                    AND estado = 'CA' 
                    AND sinreserva = 1 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS g,
                (
                SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS encasa,
                    COALESCE ( sum( reservas_pms.can_hombres + reservas_pms.can_mujeres + reservas_pms.can_ninos ), 0 ) AS huecas,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homcas,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujcas,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS nincas 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    estado = 'CA' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS h,
                (
                SELECT
                    COUNT( reservas_pms.id ) AS congela 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    estado = 'CO' 
                    AND tipo_habitaciones.tipo_habitacion = 1 
                ) AS i,
                (
                SELECT
                    COUNT( reservas_pms.id ) AS ctamaster
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    estado = 'CA' 
                AND tipo_habitaciones.tipo_habitacion = 5 
                ) AS j,
                (SELECT COALESCE
                    ( COUNT( reservas_pms.id ), 0 ) AS usodia,
                    COALESCE ( sum( reservas_pms.can_hombres ), 0 ) AS homuso,
                    COALESCE ( sum( reservas_pms.can_mujeres ), 0 ) AS mujuso,
                    COALESCE ( sum( reservas_pms.can_ninos ), 0 ) AS ninuso 
                FROM
                    reservas_pms
                    INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
                WHERE
                    fecha_llegada = '$fecha' 
                    AND estado = 'SA' 
                    AND sinreserva = 1 
                    AND tipo_habitaciones.tipo_habitacion = 1 ) as k")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function estadoHabitacionesHotel()
    {
        global $database;

        $data = $database->query("SELECT SUM(a.mmto) as mmto, sum(a.dispo) as dispo, sum(a.camas) as camas  from (
            SELECT
                if(habitaciones.mantenimiento = 1, COUNT(habitaciones.mantenimiento), 0) AS mmto, 
                if(habitaciones.mantenimiento = 0, COUNT(habitaciones.mantenimiento), 0) AS dispo,
                if(habitaciones.mantenimiento = 0, SUM(habitaciones.camas), 0) AS camas
            FROM
                habitaciones
                INNER JOIN
                tipo_habitaciones
                ON 
                    habitaciones.id_tipohabitacion = tipo_habitaciones.id
            WHERE
                habitaciones.active_at = 1 AND
                habitaciones.id_tipohabitacion > 1 AND
                tipo_habitaciones.tipo_habitacion = 1
            GROUP BY
                habitaciones.mantenimiento ) as a")->fetchall(PDO::FETCH_ASSOC);
        return $data;
    }

    public function habitacionesHotel()
    {
        global $database;

        $data = $database->query("SELECT a.nrohab, b.nroctas, nrocab from (
            SELECT
                count(habitaciones.numero_hab) AS nrohab
            FROM
                habitaciones
                INNER JOIN
                tipo_habitaciones
                ON 
                    habitaciones.id_tipohabitacion = tipo_habitaciones.id
            WHERE
                habitaciones.active_at = 1 AND
                tipo_habitaciones.tipo_habitacion = 1) as a, 
                (SELECT
                count(habitaciones.numero_hab) AS nroctas
            FROM
                habitaciones
                INNER JOIN
                tipo_habitaciones
                ON 
                    habitaciones.id_tipohabitacion = tipo_habitaciones.id
            WHERE
                habitaciones.active_at = 1 AND
                tipo_habitaciones.tipo_habitacion = 5) as b,
                (SELECT
                count(habitaciones.numero_hab) AS nrocab
            FROM
                habitaciones
                INNER JOIN
                tipo_habitaciones
                ON 
                    habitaciones.id_tipohabitacion = tipo_habitaciones.id
            WHERE
                habitaciones.active_at = 1 AND
                tipo_habitaciones.tipo_habitacion = 2) as c")->fetchAll();
        return $data;
    }

    public function habitacionesOcupadas()
    {
        global $database;

        $data = $database->query("SELECT
            a.ctas,
            b.rooms,
            b.percas,
            b.homcas,
            b.mujcas,
            b.nincas,
            c.congela 
        FROM
            (
            SELECT
                COUNT( reservas_pms.id ) AS ctas 
            FROM
                reservas_pms
                INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
            WHERE
                estado = 'CA' 
                AND tipo_habitaciones.tipo_habitacion = 5 
            ) AS a,
            (
            SELECT
                COUNT( reservas_pms.id ) AS rooms, 
                SUM(can_hombres+can_mujeres+can_ninos) as percas,
                SUM(reservas_pms.can_hombres) as homcas,
                SUM(reservas_pms.can_mujeres) as mujcas,
                SUM(reservas_pms.can_ninos) as nincas
            FROM
                reservas_pms
                INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
            WHERE
                estado = 'CA' 
                AND tipo_habitaciones.tipo_habitacion = 1 
            ) AS b,
            (
            SELECT
                COUNT( reservas_pms.id ) AS congela 
            FROM
                reservas_pms
                INNER JOIN tipo_habitaciones ON reservas_pms.tipo_habitacion = tipo_habitaciones.id 
            WHERE
                estado = 'CO' 
            AND tipo_habitaciones.tipo_habitacion = 1 
            ) AS c")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function traeHabitacionesTraslado()
    {
        global $database;

        $data = $database->query("SELECT
            traslado_habitaciones.hab_desde, 
            traslado_habitaciones.hab_hasta, 
            traslado_habitaciones.fecha, 
            traslado_habitaciones.observaciones, 
            desdetipo.descripcion_habitacion AS desdetipo, 
            destinotipo.descripcion_habitacion AS destinotipo, 
            huespedes.nombre_completo, 
            usuarios.usuario, 
            motivo_cancelacion.descripcion_motivo
        FROM
            traslado_habitaciones
            INNER JOIN
            tipo_habitaciones AS desdetipo
            ON 
                traslado_habitaciones.tipo_desde = desdetipo.id
            INNER JOIN
            tipo_habitaciones AS destinotipo
            ON 
                traslado_habitaciones.tipo_hasta = destinotipo.id
            INNER JOIN
            reservas_pms
            ON 
                traslado_habitaciones.id_reserva = reservas_pms.num_reserva
            INNER JOIN
            huespedes
            ON 
                reservas_pms.id_huesped = huespedes.id_huesped
            INNER JOIN
            usuarios
            ON 
                traslado_habitaciones.id_usuario = usuarios.usuario_id
            INNER JOIN
            motivo_cancelacion
            ON 
                traslado_habitaciones.motivo_cambio = motivo_cancelacion.id_cancela
        WHERE
            reservas_pms.tipo_habitacion <> 1
        ORDER BY
            traslado_habitaciones.hab_desde ASC")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function eliminaHuesped($id)
    {
        global $database;

        $data = $database->delete('huespedes', [
            "AND" => [
                'id_huesped' => $id,
            ]
        ]);
        return $data->rowCount();
    }

    public function estadisticasHuesped($id)
    {
        global $database;

        $data = $database->query("SELECT
                sum( estadia )  as ocupacion
            FROM
                (SELECT
                    id_huesped,
                    count( id ) AS estadia 
                FROM
                    reservas_pms 
                WHERE
                    id_huesped = $id UNION
                SELECT
                    id_huesped,
                    count( id ) AS estadia 
                FROM
                    historico_reservas_pms 
                WHERE
                    id_huesped = $id 
                ) AS a")->fetchAll(PDO::FETCH_ASSOC);
        return $data[0]['ocupacion'];
    }

    public function informeCamareria($fecha)
    {
        global $database;

        $data = $database->query("SELECT
            habitaciones.numero_hab, 
            tipo_habitaciones.descripcion_habitacion, 
            habitaciones.caracteristicas, 
            camarera.*
        FROM
            habitaciones
            INNER JOIN
                tipo_habitaciones
            ON 
		        habitaciones.id_tipohabitacion = tipo_habitaciones.id
		    LEFT JOIN (
				SELECT
                    camareras.apellidosCamarera, 
                    camareras.nombresCamarera, 
                    camareria.numHabitacion, 
                    camareria.observaciones, 
                    camareria.fecha,
                    camareria.sucia	
                FROM
                    camareras
                    INNER JOIN
                        camareria
                    ON 
                        camareras.idCamarera = camareria.idCamarera
                WHERE
                    camareras.estado = 1  
                    AND CAST(camareria.fecha AS DATE) = '$fecha'
                ORDER BY
                    camareras.apellidosCamarera, 
                    camareria.numHabitacion
            ) AS camarera
            ON habitaciones.numero_hab = camarera.numHabitacion
        WHERE
            tipo_habitaciones.tipo_habitacion = 1
        ORDER BY
            habitaciones.piso,
            habitaciones.numero_hab")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function ingresaObservacionCam($numeroRes, $numeroHab, $fechaObs, $reportadoPor, $reporteObs, $usuario_id, $ocupada, $sucia)
    {
        global $database;

        $data = $database->insert('camareria', [
            'numHabitacion' => $numeroHab,
            'numReserva' => $numeroRes,
            'idCamarera' => $reportadoPor,
            'fecha' => $fechaObs,
            'observaciones' => $reporteObs,
            'idUsuario' => $usuario_id,
            'ocupada' => $ocupada,
            'sucia' => $sucia,
        ]);
        return $database->id();
    }

    public function traeCamareras()
    {
        global $database;

        $data = $database->select('camareras', [
            'apellidosCamarera',
            'nombresCamarera',
            'idCamarera',
        ], [
            'ORDER' => 'apellidosCamarera'
        ], [
            'estado' => 1
        ]);
        return $data;
    }

    public function estadoHabitacionesHK()
    {
        global $database;

        $data = $database->query("SELECT
            habitaciones.numero_hab,
            habitaciones.caracteristicas,
            tipo_habitaciones.descripcion_habitacion,
            habitaciones.sucia,
            habitaciones.mantenimiento,
            habitaciones.ocupada,
            reservas.fecha_llegada,
            reservas.fecha_salida,
            reservas.num_reserva,
            mmto.desde_fecha,
            mmto.hasta_fecha,
            mmto.observaciones
        FROM
            habitaciones
            JOIN tipo_habitaciones ON habitaciones.id_tipohabitacion = tipo_habitaciones.id
            LEFT JOIN (
            SELECT
                reservas_pms.num_reserva,
                reservas_pms.num_habitacion,
                reservas_pms.fecha_llegada,
                reservas_pms.fecha_salida 
            FROM
                reservas_pms 
            WHERE
                reservas_pms.estado = 'CA' 
                AND reservas_pms.tipo_habitacion != 1 
            ORDER BY
                reservas_pms.num_habitacion 
            ) AS reservas 
            ON habitaciones.numero_hab = reservas.num_habitacion 
            LEFT JOIN (
            SELECT
            habitaciones.numero_hab, 
            mantenimiento_habitaciones.desde_fecha, 
            mantenimiento_habitaciones.hasta_fecha,
            mantenimiento_habitaciones.observaciones
        FROM
            mantenimiento_habitaciones
            LEFT JOIN
            habitaciones
            ON 
                mantenimiento_habitaciones.id_habitacion = habitaciones.id
        WHERE
            estado_mmto = 1
        ORDER BY
            habitaciones.numero_hab
            
        ) AS mmto 
            ON habitaciones.numero_hab = mmto.numero_hab 
        WHERE
            tipo_habitaciones.tipo_habitacion = 1 
        ORDER BY
            habitaciones.piso,
            habitaciones.numero_hab")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function reservasPorMotivo($query)
    {
        global $database;
        $data = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function buscaNitCia($ident, $id)
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'nit',
        ], [
            'nit' => $ident,
            'id_compania[!]' => $id,
        ]);

        return $data;
    }

    public function actualizaEstadoReserva($reserva)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'estado' => 'CA'
        ], [
            'num_reserva' => $reserva
        ]);
        return $data->rowCount();
    }

    public function ingresaFE($factura)
    {
        global $database;

        $data = $database->insert('datosFE', [
            'estadoEnvio' => false,
            'facturaNumero' => $factura
        ]);
        return $database->id();
    }

    public function actualizaFE($factura)
    {
        global $database;

        $data = $database->update('datosFE', [
            'estadoEnvio' => false
        ], [
            'facturaNumero' => $factura
        ]);
        return $data->rowCount();
    }

    public function traeHabitacionesDisp($tipo)
    {
        global $database;

        $data = $database->select('habitaciones', [
            'numero_hab'
        ], [
            'id_tipohabitacion' => $tipo,
            'estado' => 1,
            'mantenimiento' => 0,
        ]);
        return $data;
    }

    public function traeTodasHabitacionesMmto()
    {
        global $database;

        $data = $database->select('mantenimiento_habitaciones', [
            '[>]habitaciones' => ['id_habitacion' => 'id'],
            '[>]grupos_cajas' => ['id_mantenimiento' => 'id_grupo'],

        ], [
            'grupos_cajas.descripcion_grupo',
            'habitaciones.numero_hab',
            'mantenimiento_habitaciones.desde_fecha',
            'mantenimiento_habitaciones.hasta_fecha',
        ], [
            'mantenimiento_habitaciones.estado_mmto' => 1,
        ]);

        return $data;
    }

    public function traeHabitacionesMmto($tipo)
    {
        global $database;

        $data = $database->select('mantenimiento_habitaciones', [
            '[>]habitaciones' => ['id_habitacion' => 'id'],
        ], [
            'habitaciones.numero_hab',
            'mantenimiento_habitaciones.desde_fecha',
            'mantenimiento_habitaciones.hasta_fecha',
        ], [
            'mantenimiento_habitaciones.estado_mmto' => 1,
            'habitaciones.id_tipohabitacion' => $tipo,
        ]);

        return $data;
    }

    public function traeHabitacionesSucias($tipo)
    {
        global $database;

        $data = $database->select('habitaciones', [
            'habitaciones.numero_hab',
        ], [
            'habitaciones.id_tipohabitacion' => $tipo,
            'habitaciones.sucia' => 1,
        ]);

        return $data;
    }

    public function creaConsulta($sele)
    {
        global $database;
        $data = $database->query($sele)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function traeCorreoCia($id)
    {
        global $database;
        $data = $database->select('companias', [
            'email'
        ], [
            'id_compania' => $id
        ]);
        return $data[0]['email'];
    }

    public function traeCorreoHuesped($id)
    {
        global $database;
        $data = $database->select('huespedes', [
            'email'
        ], [
            'id_huesped' => $id
        ]);
        return $data[0]['email'];
    }

    public function traePerfilFactura($factura)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'correo',
            'id_perfil_factura',
            'tipo_factura',
        ], [
            'factura' => 1,
            'factura_numero' => $factura
        ]);
        return $data;
    }

    public function consultaDatosFE($factura)
    {
        global $database;
        $data = $database->count('datosFE', [
            'facturaNumero' => $factura
        ]);
        return $data;
    }

    public function traeInfoFacturaHist($factura)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'id_codigo_cargo',
            'tipo_factura',
            'correo',
            'referencia_cargo',
            'informacion_cargo',
            'reteiva',
            'reteica',
            'retefuente',
            'basereteiva',
            'basereteica',
            'baseretefuente',
            'id_huesped',
            'fecha_salida',
            'fecha_vencimiento',
            'numero_reserva',
            'fecha_sistema_cargo',
            'folio_cargo',
            'id_perfil_factura',
            'usuario_factura'

        ], [
            'factura_numero' => $factura,
            'factura' => 1
        ]);
        return $data;
    }

    public function traeInfoFEHistorico($numFact)
    {
        global $database;

        $data = $database->select('historicoDatosFE', [
            'QRStr',
            'cufe',
            'timeCreated',
        ], [
            'facturaNumero' => $numFact,
            'estadoEnvio' => 'true'
        ]);
        return $data;
    }

    public function traeValorRetencionesSinBaseHistorico($nroReserva, $nroFolio)
    {
        global $database;

        $data = $database->query("SELECT
                COALESCE(SUM(historico_cargos_pms.monto_cargo),0) AS monto,
                COALESCE(SUM(historico_cargos_pms.base_impuesto),0) AS base,
                COALESCE(SUM(historico_cargos_pms.impuesto),0) as impto,
                codigos_vta.idRetencion, 
                historico_cargos_pms.valor_cargo,
                retenciones.descripcionRetencion, 
                retenciones.porcentajeRetencion,
                retenciones.baseRetencion,
                COALESCE(sum(historico_cargos_pms.monto_cargo) * (retenciones.porcentajeRetencion/100),0) AS valorRetencion
                FROM
                    historico_cargos_pms
                    JOIN codigos_vta 
                    ON codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
                    RIGHT JOIN retenciones
                    ON retenciones.idRetencion = codigos_vta.idRetencion
                WHERE 
                    historico_cargos_pms.numero_reserva = $nroReserva 
                    AND historico_cargos_pms.folio_cargo = $nroFolio 
                    AND historico_cargos_pms.cargo_anulado = 0
                GROUP BY
                codigos_vta.idRetencion
                ORDER BY
                codigos_vta.idRetencion
                ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function traeValorRetencionesHistorico($nroReserva, $nroFolio)
    {
        global $database;

        $data = $database->query("SELECT 
                a.monto, a.base, retenciones.idRetencion, retenciones.descripcionRetencion, a.valorRetencion, retenciones.porcentajeRetencion
                FROM ( SELECT
                COALESCE(SUM(historico_cargos_pms.monto_cargo),0) AS monto,
                COALESCE(SUM(historico_cargos_pms.base_impuesto),0) AS base,
                COALESCE(SUM(historico_cargos_pms.impuesto),0) as impto,
                codigos_vta.idRetencion, 
                historico_cargos_pms.valor_cargo, 
                retenciones.descripcionRetencion, 
                retenciones.porcentajeRetencion,
                retenciones.baseRetencion,
                retenciones.tipoRetencion,
                COALESCE(sum(historico_cargos_pms.monto_cargo) * (porcentajeRetencion)/100,0) AS valorRetencion
                FROM
                    historico_cargos_pms,
                    retenciones,
                    codigos_vta
                WHERE
                    historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo 
                    AND codigos_vta.idRetencion = retenciones.idRetencion 
                    AND historico_cargos_pms.numero_reserva = $nroReserva 
                    AND historico_cargos_pms.folio_cargo = $nroFolio 
                    AND historico_cargos_pms.cargo_anulado = 0
                GROUP BY
                codigos_vta.idRetencion
                ORDER BY
                codigos_vta.idRetencion) AS a
                JOIN retenciones 
                ON a.idRetencion = retenciones.idRetencion 
                AND retenciones.tipoRetencion = 1 
                AND  a.base >= retenciones.baseRetencion
                ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function traeInfoFactura($factura)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'id_codigo_cargo',
            'tipo_factura',
            'correo',
            'referencia_cargo',
            'informacion_cargo',
            'reteiva',
            'reteica',
            'retefuente',
            'basereteiva',
            'basereteica',
            'baseretefuente',
            'id_huesped',
            'fecha_salida',
            'fecha_vencimiento',
            'numero_reserva',
            'fecha_sistema_cargo',
            'folio_cargo',
            'id_perfil_factura',
            'usuario_factura'

        ], [
            'factura_numero' => $factura,
            'factura' => 1
        ]);
        return $data;
    }

    public function getCargosPorGrupoVentaHist($desdeFe, $hastaFe, $usuario, $tipo, $estado, $grupo)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[>]huespedes' => ['id_huesped' => 'id_huesped'],
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre_completo',
            'historico_cargos_pms.fecha_cargo',
            'historico_cargos_pms.monto_cargo',
            'historico_cargos_pms.base_impuesto',
            'historico_cargos_pms.impuesto',
            'historico_cargos_pms.codigo_impto',
            'historico_cargos_pms.id_codigo_cargo',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.descripcion_cargo',
            'historico_cargos_pms.usuario',
            'historico_cargos_pms.id_huesped',
            'historico_cargos_pms.cantidad_cargo',
            'historico_cargos_pms.informacion_cargo',
            'historico_cargos_pms.numero_factura_cargo',
            'historico_cargos_pms.valor_cargo',
            'historico_cargos_pms.folio_cargo',
            'historico_cargos_pms.pagos_cargos',
            'historico_cargos_pms.referencia_cargo',
            'historico_cargos_pms.concecutivo_abono',
            'historico_cargos_pms.cargo_anulado',
            'historico_cargos_pms.motivo_anulacion',
            'historico_cargos_pms.fecha_anulacion',
            'historico_cargos_pms.usuario_anulacion',
            'historico_cargos_pms.numero_reserva',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.fecha_sistema_cargo',
            'historico_cargos_pms.factura_numero',
            'historico_cargos_pms.id_reserva',
        ], [
            'historico_cargos_pms.usuario' => $usuario,
            'historico_cargos_pms.fecha_cargo[>=]' => $desdeFe,
            'historico_cargos_pms.fecha_cargo[<=]' => $hastaFe,
            'historico_cargos_pms.cargo_anulado' => $estado,
            'historico_cargos_pms.concecutivo_abono' => 0,
            'codigos_vta.tipo_codigo' => $tipo,
            'codigos_vta.grupo_vta' => $grupo,
            'ORDER' => ['historico_cargos_pms.usuario' => 'ASC']
        ]);

        return $data;
    }

    public function traeUsuariosPosVentas($desdeFe, $hastaFe, $grupo)
    {
        global $database;

        $data = $database->query("SELECT usuarios.usuario,
            usuarios.nombres,
            usuarios.apellidos 
        FROM
            usuarios,
            historico_cargos_pms,
            codigos_vta
        WHERE
            usuarios.usuario = historico_cargos_pms.usuario 
            AND codigos_vta.id_cargo = historico_cargos_pms.id_codigo_cargo
            AND historico_cargos_pms.fecha_cargo >= '$desdeFe' 
            AND historico_cargos_pms.fecha_cargo <= '$hastaFe' 
            AND codigos_vta.grupo_vta = $grupo
            AND usuarios.estado = 1 
            AND usuarios.pos = 1 
        GROUP BY
            usuarios.usuario 
        ORDER BY
            usuarios.usuario")->fetchAll();
        return $data;
    }


    public function traeUsuariosPos()
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'usuario',
            'apellidos',
            'nombres',
        ], [
            'pos' => 1,
            'estado' => 1,
            'ORDER' => ['usuario' => 'ASC']
        ]);
        return $data;
    }

    public function traeDatosFactura($nroFactura)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'tipo_factura',
            'numero_reserva',
            'folio_cargo',
            'id_huesped',
            'id_perfil_factura',
            'usuario_factura'
        ], [
            'factura_numero' => $nroFactura
        ]);
        return $data;
    }

    public function traeInfoFE($numFact)
    {
        global $database;

        $data = $database->select('datosFE', [
            'QRStr',
            'cufe',
            'timeCreated',
        ], [
            'facturaNumero' => $numFact,
            'estadoEnvio' => 'true'
        ]);
        return $data;
    }

    public function asignaEdad($id, $edad)
    {
        global $database;

        $data = $database->update('huespedes', [
            'edad' => $edad,
        ], [
            'id_huesped' => $id,
        ]);
        return $data->rowCount();
    }

    public function buscaMmto($fechabusca, $numero)
    {
        global $database;

        $data = $database->select('mantenimiento_habitaciones', [
            '[<]habitaciones' => ['id_habitacion' => 'id']
        ], [
            'desde_fecha',
            'hasta_fecha',
            'observaciones'

        ], [
            'desde_fecha' => $fechabusca,
            'estado_mmto' => 1,
            'habitaciones.numero_hab' => $numero,
        ]);
        return $data;
    }

    public function asignaDiasCredito($id, $dias)
    {
        global $database;

        $data = $database->update('historico_cargos_pms', [
            'diasCredito' => $dias
        ], [
            'id_cargo' => $id
        ]);
        return $data->rowCount();
    }

    public function traeFacturasFecha()
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'id_cargo',
            'fecha_vencimiento',
            'fecha_factura',
        ], [
            'factura' => 1
        ]);
        return $data;
    }

    public function getHabitacionesLlegada($tipo, $llega)
    {
        global $database;

        $data = $database->query("SELECT num_habitacion, fecha_llegada, fecha_salida, estado  
            FROM reservas_pms 
            WHERE 
            tipo_habitacion = '$tipo' 
            and estado != 'SA' 
            and estado != 'CX'
            and estado != 'CO'
            and fecha_llegada <= '$llega'
            and fecha_salida > '$llega'
        ORDER BY 
            num_habitacion")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getHabitacionesSalen($tipo, $llega, $sale)
    {
        global $database;

        $data = $database->query("
            SELECT num_habitacion, fecha_llegada, fecha_salida, estado  
            FROM reservas_pms 
            WHERE  
            tipo_habitacion = '$tipo' 
            and estado != 'SA' 
            and estado != 'CX'
            and estado != 'CO'
            and fecha_llegada < '$sale'
            and fecha_salida > '$llega'
        ORDER BY num_habitacion")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getHabitacionesDentro($llega, $sale, $tipo)
    {
        global $database;

        $data = $database->query("SELECT num_habitacion, fecha_llegada, fecha_salida, estado  
            from reservas_pms 
            where 
            tipo_habitacion = '$tipo' 
            and estado != 'SA' 
            and estado != 'CX'
            and estado != 'CO'
            and fecha_llegada >= '$llega'
            and fecha_salida <= '$sale'
        ORDER BY num_habitacion; ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }


    public function guardaReservaTRA($reserva, $usuario)
    {
        global $database;

        $data = $database->insert('datosTRA', [
            'reserva' => $reserva,
            'id_usuario' => $usuario,
            'fecha' => date('Y-m-d H:m:i'),
        ]);
        return $database->id();
    }

    public function actualizaEstadoTRA($reserva)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'envioTra' => 1,
        ], [
            'num_reserva' => $reserva
        ]);
        return $data->rowCount();
    }

    public function buscaAcompananteTRA($reserva)
    {
        global $database;

        $data = $database->query("SELECT
            acompanantes.id_huesped, 
            huespedes.identificacion, 
            huespedes.apellido1, 
            huespedes.apellido2, 
            huespedes.nombre1, 
            huespedes.nombre2, 
            tipo_documento.descripcion_documento
        FROM
            acompanantes,
            huespedes,
            tipo_documento
        WHERE
            acompanantes.id_huesped = huespedes.id_huesped AND
            huespedes.tipo_identifica = tipo_documento.id_doc AND 
            acompanantes.id_reserva  = $reserva ORDER BY huespedes.apellido1 ASC")->fetchAll();
        return $data;
    }

    public function traeInfoHotel()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'parametros_pms.nombre_hotel',
            'parametros_pms.tra',
            'parametros_pms.tokenTra',
            'parametros_pms.urlTraHuesped',
            'parametros_pms.urlTraAcompana',
            'parametros_pms.passwordTra',
            'parametros_pms.rnt',
            'parametros_pms.envioTra',
        ]);
        return $data;
    }

    public function traeCiudadHuesped($ciudad)
    {
        global $database;

        $data = $database->select('ciudades', [
            'municipio'
        ], [
            'id_ciudad' => $ciudad
        ]);
        return $data;
    }

    public function HuespedllegadaDelDiaTRA($reserva, $fecha, $tipo)
    {
        global $database;
        $data = $database->query("SELECT
            huespedes.identificacion, 
            huespedes.apellido1, 
            huespedes.apellido2, 
            huespedes.nombre1, 
            huespedes.nombre2, 
            reservas_pms.fecha_llegada, 
            reservas_pms.fecha_salida, 
            reservas_pms.num_habitacion, 
            reservas_pms.valor_diario, 
            reservas_pms.origen_reserva, 
            tipo_habitaciones.descripcion_habitacion, 
            tipo_documento.descripcion_documento, 
            ciudades.municipio, 
            grupos_cajas.descripcion_grupo
        FROM
            huespedes,
            reservas_pms,
            tipo_documento,
            tipo_habitaciones,
            ciudades,
            grupos_cajas
        WHERE
            huespedes.id_huesped = reservas_pms.id_huesped AND
            reservas_pms.num_reserva = $reserva AND
            huespedes.tipo_identifica = id_doc AND
            reservas_pms.tipo_habitacion = tipo_habitaciones.id AND
            huespedes.ciudad = ciudades.id_ciudad AND
            reservas_pms.motivo_viaje = grupos_cajas.id_grupo")->fetchAll();
        return $data;
    }

    public function llegadasDelDiaTRA($fecha, $tipo)
    {
        global $database;
        $data = $database->select('reservas_pms', [
            '[<]huespedes' => ['id_huesped', 'id_huesped'],
        ], [
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.ciudad',
            'huespedes.identificacion',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.valor_diario',
            'reservas_pms.origen_reserva',
            'reservas_pms.num_reserva',
            'reservas_pms.num_habitacion',
        ], [
            'reservas_pms.fecha_llegada' => $fecha,
            'reservas_pms.estado' => $tipo,
            'ORDER' => ['huespedes.apellido1' => 'ASC']
        ]);
        return $data;
    }

    public function actualizaHuespedessinNombreCompleto($id, $resultado)
    {
        global $database;

        $data = $database->update('huespedes', [
            'nombre_completo' => $resultado,
        ], [
            'id_huesped' => $id,
        ]);
        return $data->rowCount();
    }

    public function huespedesSinNombreCompleto()
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'nombre_completo',
        ], [
            'nombre_completo' => Null,
            'ORDER' => ['apellido1' => 'ASC']
        ]);
        return $data;
    }

    public function enviaCargosHistoricoNC($factura)
    {
        global $database;

        $data = $database->query("INSERT INTO cargosNC SELECT * FROM historico_cargos_pms WHERE factura_numero = '$factura'")->fetchAll();

        return $data;
    }

    public function enviaCargosNC($factura)
    {
        global $database;

        $data = $database->query("INSERT INTO cargosNC SELECT * FROM cargos_pms WHERE factura_numero = '$factura'")->fetchAll();

        return $data;
    }

    public function getNotasCreditoDia($dia)
    {
        global $database;

        $data = $database->select('notasCredito', [
            '[<]usuarios' => ['usuarioNC' => 'usuario_id']
        ], [
            'usuarios.usuario',
            'idNota',
            'numeroNC',
            'motivoAnulacion',
            'facturaAnulada',
            'fechaNC',
        ], [
            'fechaNC' => $dia,
            'ORDER' => ['numeroNC' => 'ASC']

        ]);
        return $data;
    }

    public function actualizaDireccion($id, $direccion)
    {
        global $database;
        $data = $database->update('huespedes', [
            'direccion' => $direccion
        ], [
            'id_huesped' => $id
        ]);
        return $data->rowCount();
    }

    public function traeHuespedes()
    {
        global $database;

        $data = $database->query("SELECT * FROM huespedes")->fetchAll();
        return $data;
    }

    public function actualizaTarifa($id, $uno, $dos, $tre, $cua, $cin, $sei, $adi, $nin)
    {
        global $database;

        $data = $database->update('valores_tarifas', [
            'valor_un_pax' => $uno,
            'valor_dos_pax' => $dos,
            'valor_tre_pax' => $tre,
            'valor_cua_pax' => $cua,
            'valor_cin_pax' => $cin,
            'valor_sei_pax' => $sei,
            'valor_adicional' => $adi,
            'valor_nino' => $nin
        ], [
            'id' => $id,
        ]);
        return $data->rowCount();
    }

    public function traeTarifas()
    {
        global $database;

        $data = $database->query('SELECT * FROM valores_tarifas ')->fetchAll();
        return $data;
    }

    public function traeUsuarioNC($factura)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'id_usuario_anulacion'
        ], [
            'factura' => 1,
            'factura_numero' => $factura,
        ]);
        return $data[0]['id_usuario_anulacion'];
    }

    public function ingresaNCImport($factura, $fecha, $motivo, $numero, $usuario)
    {
        global $database;

        $data = $database->insert('notasCredito', [
            'numeroNC' => $numero,
            'motivoAnulacion' => $motivo,
            'facturaAnulada' => $factura,
            'fechaNC' => $fecha,
            'usuarioNC' => $usuario,


        ]);
        return $database->id();
    }

    public function traeNotas()
    {
        global $database;

        $data = $database->select('datosFE', [
            'datosFE.facturaNumero',
            'datosFE.prefijo',
            'datosFE.id',
            'datosFE.timeCreated',
            'datosFE.jsonEnviado',
        ], [
            'datosFE.prefijo' => 'NC'
        ]);
        return $data;
    }

    public function ingresaNCFactura($numero, $motivo, $idusuario, $numDoc, $fecha)
    {
        global $database;

        $data = $database->insert('notasCredito', [
            'numeroNC' => $numDoc,
            'motivoAnulacion' => $motivo,
            'usuarioNC' => $idusuario,
            'facturaAnulada' => $numero,
            'fechaNC' => $fecha,
            'createdAt' => date('Y-m-d H:m:i'),
        ]);
        return $database->id();
    }

    public function creaGrupo($empresaGrupo, $nombreGrupo, $llegada, $noches, $salida, $hombres, $mujeres, $ninos, $cantHabi, $tarifahab, $valortar, $origen, $destino, $motivo, $fuente, $segmento, $formapago, $observaciones, $usuario, $idusuario)
    {
        global $database;

        $data = $database->insert('grupos_pms', [
            'nombreGrupo' => $nombreGrupo,
            'hombres' => $hombres,
            'mujeres' => $mujeres,
            'ninos' => $ninos,
            'totalHuespedes' =>  $hombres + $mujeres + $ninos,
            'totalHabitaciones' => $cantHabi,
            'fechaLlegada' => $llegada,
            /* 
            'noches' => $noches,
            'fechaSalida' => $salida,
            'idTarifa' => $tarifahab,
            'formaPago' => $formapago,
            'valorGrupo' => $valortar,
            'idCompania' => $empresaGrupo,
            'estado' => 1,
            'observaciones' => $observaciones, 
            'idUsuario' => $idusuario,
            */
        ]);
        return $database->id();
    }

    public function actualizaMmto($idmmto, $hasta)
    {
        global $database;

        $data = $database->update('mantenimiento_habitaciones', [
            'hasta_fecha' => $hasta,
        ], [
            'id_mmto' => $idmmto
        ]);
        return $data->rowCount();
    }

    public function getMmtoHabitaciones($llega, $tipo)
    {
        global $database;

        $data = $database->select('mantenimiento_habitaciones', [
            '[>]habitaciones' => ['id_habitacion' => 'id']
        ], [
            'habitaciones.numero_hab',
            'mantenimiento_habitaciones.desde_fecha',
            'mantenimiento_habitaciones.hasta_fecha',
        ], [
            'habitaciones.id_tipohabitacion' => $tipo,
            'mantenimiento_habitaciones.desde_fecha[<=]' => $llega,
            'mantenimiento_habitaciones.hasta_fecha[>]' => $llega,
            'mantenimiento_habitaciones.estado_mmto' => 1
        ]);
        return $data;
    }

    public function traeEstadoHabitaciones()
    {
        global $database;

        $data = $database->select('habitaciones', [
            '[>]tipo_habitaciones' => ['id_tipohabitacion' => 'id']
        ], [
            'tipo_habitaciones.descripcion_habitacion',
            'habitaciones.id_tipohabitacion',
            'habitaciones.numero_hab',
            'habitaciones.camas',
            'habitaciones.pax',
            'habitaciones.estado',
            'habitaciones.mantenimiento',
            'habitaciones.sucia',
            'habitaciones.ocupada',
        ], [
            'tipo_habitaciones.tipo_habitacion' => 1,
            'ORDER' => ['habitaciones.numero_hab' => 'ASC']
        ]);
        return $data;
    }

    public function regresaCasa($reserva)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'estado'  => 'CA'
        ], [
            'num_reserva' => $reserva,
        ]);
        return $data->rowCount();
    }

    public function updateCongelada($numero, $orden)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'orden_reserva' => $orden,
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function traeDescripcionContable($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'descripcion_contable',
            'cuenta_puc',
        ], [
            'id_cargo' => $codigo,
        ]);
        return $data;
    }

    public function estadoReserva($room)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'estado',
            'con_congela',
        ], [
            'num_reserva' => $room,
        ]);
        return $data;
    }

    public function getFacturasCompanias($id)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[>]huespedes' => ['id_huesped' => 'id_huesped']
        ], [
            'huespedes.nombre_completo',
            'historico_cargos_pms.pagos_cargos',
            'historico_cargos_pms.fecha_factura',
            'historico_cargos_pms.factura_numero',
        ], [
            'historico_cargos_pms.tipo_factura' => 2,
            'historico_cargos_pms.factura' => 1,
            'historico_cargos_pms.factura_anulada' => 0,
            'historico_cargos_pms.cartera' => 0,
            'historico_cargos_pms.id_perfil_factura' => $id,
            'historico_cargos_pms.id_codigo_cargo' => 2,
            'ORDER' => ['historico_cargos_pms.factura_numero' => 'ASC']
        ]);
        return $data;
    }

    public function traeClientesCartera()
    {
        global $database;

        $data = $database->query("SELECT companias.id_compania, companias.empresa, companias.nit, companias.dv, companias.direccion, companias.email, Sum(historico_cargos_pms.pagos_cargos) as total FROM companias , historico_cargos_pms WHERE companias.id_compania = historico_cargos_pms.id_perfil_factura AND historico_cargos_pms.id_codigo_cargo = 2 AND historico_cargos_pms.cartera = 0 AND historico_cargos_pms.factura_anulada = 0 AND historico_cargos_pms.tipo_factura = 2 GROUP BY companias.id_compania ORDER BY companias.empresa")->fetchAll();

        return $data;
    }

    public function habitacionesMmto()
    {
        global $database;

        $data = $database->count('habitaciones', [
            'mantenimiento' => 1,
        ]);
        return $data;
    }

    public function lanzaQuery($sele)
    {
        global $database;

        $data = $database->query($sele)->fetchAll();
        return $data;
    }

    public function buscaHabitacionesMmto($query)
    {
        global $database;

        $data = $database->query($query)->fetchAll();
        return $data;
    }

    public function traeNombreUsuario($id)
    {
        global $database;

        $data = $database->select('usuarios', [
            'apellidos',
            'nombres',
        ], [
            'usuario_id' => $id

        ]);
        return $data[0]['apellidos'] . ' ' . $data[0]['nombres'];
    }

    public function traeRetenciones($numero)
    {
        global $database;

        $data = $database->select('retenciones', [
            'feCode',
            'descripcionRetencion',
            'porcentajeRetencion',
            'baseRetencion',
            'tipoRetencion',
            'codigoPuc',
        ], [
            'tipoRetencion' => $numero,
            'estado' => 1,
        ]);

        return $data;
    }

    public function traeValorRetenciones($nroReserva, $nroFolio)
    {
        global $database;

        $data = $database->query("SELECT 
            a.monto, a.base, retenciones.idRetencion, retenciones.descripcionRetencion, a.valorRetencion, retenciones.porcentajeRetencion
            FROM ( SELECT
            COALESCE(SUM(cargos_pms.monto_cargo),0) AS monto,
            COALESCE(SUM(cargos_pms.base_impuesto),0) AS base,
            COALESCE(SUM(cargos_pms.impuesto),0) as impto,
            codigos_vta.idRetencion, 
            cargos_pms.valor_cargo, 
            retenciones.descripcionRetencion, 
            retenciones.porcentajeRetencion,
            retenciones.baseRetencion,
            retenciones.tipoRetencion,
            COALESCE(sum(cargos_pms.monto_cargo) * (porcentajeRetencion)/100,0) AS valorRetencion
            FROM
                cargos_pms,
                retenciones,
                codigos_vta
            WHERE
                cargos_pms.id_codigo_cargo = codigos_vta.id_cargo 
                AND codigos_vta.idRetencion = retenciones.idRetencion 
                AND cargos_pms.numero_reserva = $nroReserva 
                AND cargos_pms.folio_cargo = $nroFolio 
                AND cargos_pms.cargo_anulado = 0
            GROUP BY
            codigos_vta.idRetencion
            ORDER BY
            codigos_vta.idRetencion) AS a
            JOIN retenciones 
            ON a.idRetencion = retenciones.idRetencion 
            AND retenciones.tipoRetencion = 1 
            AND  a.base >= retenciones.baseRetencion
            ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function traeValorRetencionesSinBase($nroReserva, $nroFolio)
    {
        global $database;

        $data = $database->query("SELECT
            COALESCE(SUM(cargos_pms.monto_cargo),0) AS monto,
            COALESCE(SUM(cargos_pms.base_impuesto),0) AS base,
            COALESCE(SUM(cargos_pms.impuesto),0) as impto,
            codigos_vta.idRetencion, 
            cargos_pms.valor_cargo,
            retenciones.descripcionRetencion, 
            retenciones.porcentajeRetencion,
            retenciones.baseRetencion,
            COALESCE(sum(cargos_pms.monto_cargo) * (retenciones.porcentajeRetencion/100),0) AS valorRetencion
            FROM
                cargos_pms
                JOIN codigos_vta 
                ON codigos_vta.id_cargo = cargos_pms.id_codigo_cargo
                RIGHT JOIN retenciones
                ON retenciones.idRetencion = codigos_vta.idRetencion
            WHERE 
                cargos_pms.numero_reserva = $nroReserva 
                AND cargos_pms.folio_cargo = $nroFolio 
                AND cargos_pms.cargo_anulado = 0
            GROUP BY
            codigos_vta.idRetencion
            ORDER BY
            codigos_vta.idRetencion
            ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function traeDatosPerfilFactura($numero)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'perfil_factura',
            'id_perfil_factura',
            'tipo_factura',
        ], [
            'factura' => 1,
            'factura_numero' => $numero,
        ]);

        return $data;
    }

    public function traeDatosFE($numero)
    {
        global $database;

        $data = $database->select('datosFE', [
            'cufe',
        ], [
            'facturaNumero' => $numero,
        ]);

        return $data;
    }

    public function traeDatosFEHis($numero)
    {
        global $database;

        $data = $database->select('historicoDatosFE', [
            'cufe',
        ], [
            'facturaNumero' => $numero,
        ]);

        return $data;
    }

    public function actualizaDatosFe($nroFactura, $prefijo, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, $recibeCurl, $Isvalid, $eFact, $errorMessage, $statusCode, $statusDesc, $statusMess)
    {
        global $database;

        $data = $database->update('datosFE', [
            // 'facturaNumero' => $nroFactura,
            // 'prefijo' => $prefijo,
            'timeCreated' => $timeCrea,
            'message' => $message,
            'send_email_success' => $sendSucc,
            'send_email_date_time' => $sendDate,
            'responseDian' => $respo,
            'invoicexml' => $invoicexml,
            'zipinvoicexml' => $zipinvoicexml,
            'unsignedinvoicexml' => $unsignedinvoicexml,
            'reqfe' => $reqfe,
            'rptafe' => $rptafe,
            'attacheddocument' => $attacheddocument,
            'urlinvoicexml' => $urlinvoicexml,
            'urlinvoicepdf' => $urlinvoicepdf,
            'cufe' => $cufe,
            'QRStr' => $QRStr,
            'recibeCurl' => $recibeCurl,
            'estadoEnvio' => $Isvalid,
            'jsonEnviado' => $eFact,
            'errorMessage' =>  $errorMessage,
            'statusCode' =>  $statusCode,
            'statusDesc' =>  $statusDesc,
            'statusMess' =>  $statusMess,
        ], [
            'facturaNumero' => $nroFactura,
        ]);

        return $database->id();
    }

    public function ingresaDatosFe($nroFactura, $prefijo, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, $recibeCurl, $Isvalid, $eFact, $errorMessage, $statusCode, $statusDesc, $statusMess)
    {
        global $database;

        $data = $database->insert('datosFE', [
            'facturaNumero' => $nroFactura,
            'prefijo' => $prefijo,
            'timeCreated' => $timeCrea,
            'message' => $message,
            'send_email_success' => $sendSucc,
            'send_email_date_time' => $sendDate,
            'responseDian' => $respo,
            'invoicexml' => $invoicexml,
            'zipinvoicexml' => $zipinvoicexml,
            'unsignedinvoicexml' => $unsignedinvoicexml,
            'reqfe' => $reqfe,
            'rptafe' => $rptafe,
            'attacheddocument' => $attacheddocument,
            'urlinvoicexml' => $urlinvoicexml,
            'urlinvoicepdf' => $urlinvoicepdf,
            'cufe' => $cufe,
            'QRStr' => $QRStr,
            'recibeCurl' => $recibeCurl,
            'estadoEnvio' => $Isvalid,
            'jsonEnviado' => $eFact,
            'errorMessage' =>  $errorMessage,
            'statusCode' =>  $statusCode,
            'statusDesc' =>  $statusDesc,
            'statusMess' =>  $statusMess,
        ]);

        return $database->id();
    }

    public function traeIdRegimenFiscal($codigo)
    {
        global $database;

        $data = $database->select('dianRegimenFiscal', [
            'codigo',
        ], [
            'id' => $codigo,
        ]);

        return $data[0]['codigo'];
    }

    public function traeIdResponsabilidadDianVenta($codigo)
    {
        global $database;

        $data = $database->select('dianTipoResponsabilidad', [
            'feCode',
        ], [
            'id' => $codigo,
        ]);

        return $data[0]['feCode'];
    }

    public function traeIdItemDianVenta($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'idItem',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data[0]['idItem'];
    }

    public function traeTipoUnidadDianVenta($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'tipoUnidad',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data[0]['tipoUnidad'];
    }

    public function traeCodigoDianVenta($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'identificador_dian',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data[0]['identificador_dian'];
    }

    public function datosTokenCia()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'token',
            'password',
            'facturador',
        ]);

        return $data;
    }

    public function traeCodigoDianID()
    {
        global $database;

        $data = $database->select('tipo_documentos', []);
        return $data;
    }

    public function traeTipoResponsabilidad($id)
    {
        global $database;

        $data = $database->select('dianTipoResponsabilidad', [
            'feCode',
        ], [
            'id' => $id,
        ]);

        return $data[0]['feCode'];
    }

    public function getRetenciones()
    {
        global $database;

        $data = $database->select('retenciones', [
            'idRetencion',
            'porcentajeRetencion',
            'baseRetencion',
            'tipoRetencion',
            'codigoPuc',
            'descripcionRetencion',
        ], [
            'estado' => 1,
        ]);

        return $data;
    }

    public function traeRetencionesCia($cia)
    {
        global $database;

        $data = $database->select('companias', [
            'reteiva',
            'reteica',
            'retefuente',
            'sinBaseRete',
        ], [
            'id_compania' => $cia,
        ]);

        return $data[0];
    }

    public function getTipoPerfilCodigo($id)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'perfil_venta',
        ], [
            'id_cargo' => $id,
        ]);

        return $data[0]['perfil_venta'];
    }

    public function getPrefijoNC()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'pref_credito',
        ]);

        return $data[0]['pref_credito'];
    }

    public function getNumeroCredito()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_credito',
        ]);

        return $data[0]['con_credito'];
    }

    public function actualizaNumeroCredito($id)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_credito' => $id,
        ]);

        return $data;
    }

    public function infoFactura($numero)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'id_codigo_cargo',
            'habitacion_cargo',
            'id_huesped',
            'folio_cargo',
            'pagos_cargos',
            'fecha_salida',
            'fecha_vencimiento',
            'tipo_factura',
            'id_perfil_factura',
            'numero_reserva',
            'prefijo_factura',
            'factura_numero',
            'fecha_factura',
            'factura',
            'total_consumos',
            'total_impuesto',
            'total_pagos',
            'base_impuestos',
            'total_anticipos',
        ], [
            'factura' => 1,
            'factura_numero' => $numero,
        ]);

        return $data;
    }

    public function infoFacturaHis($numero)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'id_codigo_cargo',
            'habitacion_cargo',
            'id_huesped',
            'folio_cargo',
            'pagos_cargos',
            'fecha_salida',
            'fecha_vencimiento',
            'tipo_factura',
            'id_perfil_factura',
            'numero_reserva',
            'prefijo_factura',
            'factura_numero',
            'fecha_factura',
            'factura',
            'total_consumos',
            'total_impuesto',
            'total_pagos',
            'base_impuestos',
            'total_anticipos',
        ], [
            'factura' => 1,
            'factura_numero' => $numero,
        ]);

        return $data;
    }

    public function traeCodigoPais($id)
    {
        global $database;
        $data = $database->select('paices', [
            'numero',
        ], [
            'id_pais' => $id,
        ]);

        return $data[0]['numero'];
    }

    public function traeCodigoCiudad($id)
    {
        global $database;
        $data = $database->select('ciudades', [
            'id_ciudad',
            'codigo',
        ], [
            'id_ciudad' => $id,
        ]);

        if (count($data) == 0) {
            return 'Sin Datos ';
        } else {
            return $data[0]['codigo'];
        }
    }

    public function traeCodigoIdentifica($id)
    {
        global $database;

        $data = $database->select('tipo_documento', [
            'codigo',
        ], [
            'id_doc' => $id,
        ]);

        return $data[0]['codigo'];
    }

    public function getResolucion($tipoDoc)
    {
        global $database;

        $data = $database->select('resoluciones', [
            'resolucion',
            'fecha',
            'prefijo',
            'desde',
            'hasta',
            'estado',
            'tipo',
            'vigencia',
        ], [
            'estado' => 1,
            'tipoDocumento' => $tipoDoc,
        ]);

        return $data;
    }

    public function getResponsabilidadTributaria()
    {
        global $database;

        $data = $database->select('dianTipoResponsabilidad', [
            'descripcionResponsabilidad',
            'id',
        ], [
            'ORDER' => ['descripcionResponsabilidad' => 'ASC'],
        ]);

        return $data;
    }

    public function getTipoAdquiriente()
    {
        global $database;

        $data = $database->select('dianTipoAdquiriente', [
            'descripcionAdquiriente',
            'id',
        ], [
            'ORDER' => ['descripcionAdquiriente' => 'ASC'],
        ]);

        return $data;
    }

    public function getTipoResponsabilidad()
    {
        global $database;

        $data = $database->select('dianRegimenFiscal', [
            'descripcion',
            'id',
        ], [
            'ORDER' => ['descripcion' => 'ASC'],
        ]);

        return $data;
    }

    public function traePaquetesHabitacion($tarifa)
    {
        global $database;

        $data = $database->query(
            "
        SELECT
            paquetes.codigo_vta,
            paquetes.codigo_excento,
            paquetes.valor,
            paquetes_tarifas.id_tarifa,
            paquetes_tarifas.id_paquete,
            codigos_vta.id_impto,
            codigos_vta.porcentaje_impto,
            codigos_vta.decreto_turismo,
            codigos_vta.descripcion_cargo
        FROM
            paquetes
            INNER JOIN
            paquetes_tarifas
            ON 
                paquetes.id = paquetes_tarifas.id_paquete
            INNER JOIN
            codigos_vta
            ON 
                paquetes.codigo_vta = codigos_vta.id_cargo
        WHERE
            paquetes_tarifas.id_tarifa = '$tarifa'"
        )->fetchAll();

        return $data;
    }

    public function getProductosAmenities($tipo)
    {
        global $database;

        $data = $database->select('productos_amenities', [
            'tipo_habitaciones' => ['id' => 'id_tipohabitacion'],
        ], [
            'tipo_habitaciones.descripcion_habitacion',
            'productos_amenities.id_producto',
            'productos_amenities.cantidad',
        ], [
            'id_tipohabitacion' => $tipo,
        ]);

        return $data;
    }

    public function getTipoHabitacionesOcupadas()
    {
        global $database;

        $data = $database->query("SELECT Count(reservas_pms.num_reserva) AS canHabi, reservas_pms.tipo_habitacion FROM reservas_pms WHERE reservas_pms.estado = 'CA' AND 
			reservas_pms.tipo_habitacion <> 1 GROUP BY reservas_pms.tipo_habitacion")->fetchAll();

        return $data;
    }

    public function getInventarioHotel()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'inventario_amenities',
            'bodega_inventario',
            'tipo_movimiento',
        ]);

        return $data;
    }

    public function creaHuespedDirecto($idhues, $apellido1, $apellido2, $nombre1, $nombre2, $usuario, $idusuario)
    {
        global $database;

        $data = $database->insert('huespedes', [
            'identificacion' => $idhues,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'nombre1' => $nombre1,
            'nombre2' => $nombre2,
            'nombre_completo' => $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'usuario_creador' => $usuario,
            'id_usuario' => $idusuario,
        ]);

        return $database->id();
    }

    public function traeCuentasMaestras()
    {
        global $database;

        $data = $database->select('habitaciones', [
            '[>]tipo_habitaciones' => ['id_tipohabitacion' => 'id'],
        ], [
            'habitaciones.numero_hab',
            'tipo_habitaciones.descripcion_habitacion',
        ], [
            'tipo_habitaciones.id' => 1,
            'ORDER BY' => ['habitaciones.numero_hab' => 'ASC'],
        ]);

        return $data;
    }

    public function getbuscaIden($iden)
    {
        global $database;

        $data = $database->select('huespedes', [
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'id_huesped',
        ], [
            'identificacion' => $iden,
        ]);

        return $data;
    }

    public function bloqueaCia($cia, $estado)
    {
        global $database;

        $data = $database->update('companias', [
            'activo' => $estado,
        ], [
            'id_compania' => $cia,
        ]);

        return $data->rowCount();
    }

    public function getlistadoCumpleanios($query)
    {
        global $database;

        $data = $database->query($query)->fetchAll();

        return $data;
    }

    public function getTraeCentroCia($id)
    {
        global $database;

        $data = $database->select('centrosCias', [
            'descripcion_centro',
        ], [
            'id_centro' => $id,
        ]);

        return $data;
    }

    public function getCompaniaFactura($id)
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'direccion',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'fax',
            'email',
            'id_tarifa',
            'estado_credito',
            'activo',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function eliminaCentrosCia($idCentro)
    {
        global $database;

        $data = $database->delete('centrosCias', [
            'id_centro' => $idCentro,
        ]);

        return $data->rowCount();
    }

    public function updateCentrosCia($nombre, $responsable, $idCentro)
    {
        global $database;

        $data = $database->update('centrosCias', [
            'descripcion_centro' => $nombre,
            'responsable' => $responsable,
        ], [
            'id_centro' => $idCentro,
        ]);

        return $data->rowCount();
    }

    public function insertaCentrosCia($nombre, $responsable, $idCia)
    {
        global $database;

        $data = $database->insert('centrosCias', [
            'descripcion_centro' => $nombre,
            'responsable' => $responsable,
            'id_compania' => $idCia,
        ]);

        return $database->id();
    }

    public function getTraecentros($id)
    {
        global $database;

        $data = $database->select('centrosCias', [
            'id_centro',
            'descripcion_centro',
            'responsable',
            'id_compania',
        ], [
            'id_compania' => $id,
            'ORDER' => ['descripcion_centro' => 'ASC'],
        ]);

        return $data;
    }

    public function getCentros()
    {
        global $database;

        $data = $database->select('centrosCias', [
            'id_centro',
            'descripcion_centro',
            'responsable',
            'id_compania',
        ], [
            'ORDER' => ['id_centro' => 'ASC'],
        ]);

        return $data;
    }

    public function valorAnticipos($factura)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.fecha_cargo, cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero, codigos_vta.formaPagoDian, codigos_vta.medioPagoDian, cargos_pms.fecha_factura FROM cargos_pms, codigos_vta WHERE (cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND  cargos_pms.concecutivo_abono != 0) OR (cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND cargos_pms.concecutivo_deposito != 0) GROUP BY cargos_pms.id_codigo_cargo, cargos_pms.fecha_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo")->fetchAll();

        return $data;
    }

    public function getBuscaCreditoCia($idCia)
    {
        global $database;

        $data = $database->select('companias', [
            'credito',
            'monto_credito',
            'dia_corte_credito',
            'dias_credito',
            'cupo_disponible',
        ], [
            'id_compania' => $idCia,
        ]);

        return $data;
    }

    public function getGrupos()
    {
        global $database;

        $data = $database->select('grupos_pms', [
            '[>]companias' => ['idCompania' => 'id_compania'],
        ], [
            'companias.empresa',
            'idGrupo',
            'idCompania',
            'nombreGrupo',
            'fechaLlegada',
            'fechaSalida',
            'noches',
            'idTarifa',
            'cuentaMaestra',
            'formaPago',
            'totalHuespedes',
            'totalHabitaciones',
            'estado',
        ]);

        return $data;
    }

    public function getContratoHotelero()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'contrato_hotelero',
        ]);

        return $data[0]['contrato_hotelero'];
    }

    public function buscaAcompanantes($reserva)
    {
        global $database;

        $data = $database->select('acompanantes', [
            '[<]huespedes' => ['id_huesped'],
        ], [
            'nombre_completo',
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'identificacion',
        ], [
            'id_reserva' => $reserva,
        ]);

        return $data;
    }

    public function gerBuscaCia($id)
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'nit',
            'dv',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function getBuscaPerfilCompania($regis, $filas, $codigo)
    {
        global $database;

        $data = $database->query("SELECT descripcion_tarifa, id_compania, empresa, direccion, nit, dv, tipo_documento, telefono, celular, fax, email, companias.id_tarifa, estado_credito, activo  FROM companias, tarifas WHERE (companias.id_tarifa = tarifas.id_tarifa AND empresa LIKE '%$codigo%') OR (companias.id_tarifa = tarifas.id_tarifa AND nit LIKE '%$codigo%') ORDER BY empresa ASC LIMIT $regis, $filas")->fetchAll();

        return $data;
    }

    public function getPerfilCompanias()
    {
        global $database;

        $data = $database->select('companias', [
            '[>]tarifas' => ['id_tarifa'],
        ], [
            'descripcion_tarifa',
            'id_compania',
            'empresa',
            'direccion',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'fax',
            'email',
            'id_tarifa',
            'estado_credito',
            'activo',
        ], [
            'ORDER' => ['empresa' => 'ASC'],
        ]);

        return $data;
    }

    public function getCantidadCompanias()
    {
        global $database;

        $data = $database->count('companias');

        return $data;
    }

    public function getBuscaPerfilHuesped($regis, $filas, $codigo)
    {
        global $database;

        $data = $database->query("SELECT id_huesped, nombre1, nombre2, apellido1, apellido2, nombre_completo, identificacion, direccion, telefono, email, tipo_identifica, tipo_huesped, fecha_nacimiento, sexo, celular, id_compania, idCentroCia, estado_credito, edad  FROM huespedes WHERE nombre_completo LIKE '%$codigo%' OR identificacion LIKE '%$codigo%' ORDER BY apellido1 ASC LIMIT $regis, $filas")->fetchAll();

        return $data;
    }

    public function getCantidadPerfiles()
    {
        global $database;

        $data = $database->count('huespedes');

        return $data;
    }

    public function getDiaFuenteReserva($fecha, $cod)
    {
        global $database;

        $data = $database->query("SELECT count(reservas_pms.id) as nro, sum(reservas_pms.can_hombres) as hom, sum(reservas_pms.can_mujeres) as muj, sum(reservas_pms.can_ninos) as nin, reservas_pms.fuente_reserva, sum(reservas_pms.valor_reserva) as val, grupos_cajas.descripcion_grupo FROM reservas_pms, grupos_cajas WHERE reservas_pms.fuente_reserva = grupos_cajas.id_grupo AND reservas_pms.salida_checkout = '$fecha' AND grupos_cajas.id_grupo = $cod AND reservas_pms.tipo_habitacion <> 'CMA' GROUP BY grupos_cajas.descripcion_grupo ORDER BY grupos_cajas.descripcion_grupo")->fetchAll();

        return $data;
    }

    public function getMesFuenteReserva($fecha, $mes, $anio, $cod)
    {
        global $database;

        $data = $database->query("SELECT count(historico_reservas_pms.id) as nro, sum(historico_reservas_pms.can_hombres) as hom, sum(historico_reservas_pms.can_mujeres) as muj, sum(historico_reservas_pms.can_ninos) as nin, historico_reservas_pms.fuente_reserva, sum(historico_reservas_pms.valor_reserva) as val, grupos_cajas.descripcion_grupo FROM historico_reservas_pms, grupos_cajas WHERE historico_reservas_pms.fuente_reserva = grupos_cajas.id_grupo AND year(historico_reservas_pms.salida_checkout) = '$anio' AND month(historico_reservas_pms.salida_checkout) = '$mes' AND historico_reservas_pms.salida_checkout <= '$fecha' AND grupos_cajas.id_grupo = $cod AND historico_reservas_pms.tipo_habitacion <> 'CMA' GROUP BY grupos_cajas.descripcion_grupo ORDER BY grupos_cajas.descripcion_grupo")->fetchAll();

        return $data;
    }

    public function getAniFuenteReserva($fecha, $anio, $cod)
    {
        global $database;

        $data = $database->query("SELECT count(historico_reservas_pms.id) as nro, sum(historico_reservas_pms.can_hombres) as hom, sum(historico_reservas_pms.can_mujeres) as muj, sum(historico_reservas_pms.can_ninos) as nin, historico_reservas_pms.fuente_reserva, sum(historico_reservas_pms.valor_reserva) as val, grupos_cajas.descripcion_grupo FROM historico_reservas_pms, grupos_cajas WHERE historico_reservas_pms.fuente_reserva = grupos_cajas.id_grupo AND year(historico_reservas_pms.salida_checkout) = '$anio' AND historico_reservas_pms.salida_checkout <= '$fecha' AND grupos_cajas.id_grupo = $cod AND historico_reservas_pms.tipo_habitacion <> 'CMA' GROUP BY grupos_cajas.descripcion_grupo ORDER BY grupos_cajas.descripcion_grupo")->fetchAll();

        return $data;
    }

    public function getTraeHistoricoReservas($sele)
    {
        global $database;

        $data = $database->query($sele)->fetchAll();

        return $data;
    }

    public function getActiveUser($user)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'correo',
            'nombres',
            'apellidos',
            'usuario',
            'estado',
            'foto_usuario',
            'usuario',
            'tipo',
            'empresa_id',
            'estado_usuario_pms',
            'estado_usuario_pos',
        ], [
            'usuario' => $user,
        ]);

        return $data;
    }

    public function buscaDocumentoDeposito($num)
    {
        global $database;

        $data = $database->select('imagenes', [
            'id_perfil',
            'nombre_imagen',
        ], [
            'id_perfil' => $num,
            'modulo' => 3,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['nombre_imagen'];
        }
    }

    public function muestraImagenes($modulo, $id)
    {
        global $database;

        $data = $database->select('imagenes', [
            'nombre_imagen',
        ], [
            'modulo' => $modulo,
            'id_perfil' => $id,
        ]);

        return $data;
    }

    public function insertImagenPerfil($modulo, $id, $file_name, $aux, $idusuario)
    {
        global $database;

        $data = $database->insert('imagenes', [
            'modulo' => $modulo,
            'id_perfil' => $id,
            'id_auxiliar' => $aux,
            'nombre_imagen' => $file_name,
            'id_usuario' => $idusuario,
            'fecha' => date('y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getNombreCiudad($id)
    {
        global $database;

        $data = $database->select('ciudades', [
            'municipio',
            'depto',
        ], [
            'id_ciudad' => $id,
        ]);

        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['municipio'] . ' ' . $data[0]['depto'];
        }
    }

    public function getNombreTipoHabitacion2($tipo)
    {
        global $database;

        $data = $database->select('tipo_habitaciones', [
            'descripcion_habitacion',
        ], [
            'id' => $tipo,
        ]);

        return $data[0]['descripcion_habitacion'];
    }

    public function descripcionGrupo($id)
    {
        global $database;

        $data = $database->select('grupos_cajas', [
            'descripcion_grupo',
        ], [
            'id_grupo' => $id,
        ]);
        if (count($data) == 0) {
            return 'SIN INFORMACION';
        } else {
            return $data[0]['descripcion_grupo'];
        }
    }

    public function terminaMantenimiento($id, $costo, $idusuario)
    {
        global $database;

        $data = $database->update('mantenimiento_habitaciones', [
            'estado_mmto' => 2,
            'fecha_termina_mmto' => date('Y-m-d H:i:s'),
            'id_usuario_mmto' => $idusuario,
            'valor_mmto' => $costo,
        ], [
            'id_mmto' => $id,
        ]);

        return $data->rowCount();
    }

    public function adicionaObservacionesMmto($id, $observacion)
    {
        global $database;

        $data = $database->update('mantenimiento_habitaciones', [
            'observaciones' => $observacion,
        ], [
            'id_mmto' => $id,
        ]);

        return $data->rowCount();
    }

    public function getInformacionMantenimiento($id)
    {
        global $database;

        $data = $database->select('mantenimiento_habitaciones', [
            '[>]grupos_cajas' => ['id_mantenimiento' => 'id_grupo'],
        ], [
            'grupos_cajas.descripcion_grupo',
            'id_mmto',
            'id_habitacion',
            'id_mantenimiento',
            'tipo_bloqueo',
            'desde_fecha',
            'hasta_fecha',
            'observaciones',
            'id_usuario',
            'created_at',
            'estado_mmto',
            'retirar_inventario',
            'presupuesto',
            'fecha_termina_mmto',
            'id_usuario_mmto',
            'tipo_mmto',
            'con_mantenimiento',
            'fecha_mmto',
            'valor_mmto',
        ], [
            'id_mmto' => $id,
        ]);

        return $data;
    }

    public function updateNumeroMantenimiento($numero)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_mantenimiento' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getNumeroMantenimiento()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_mantenimiento',
        ]);

        return $data[0]['con_mantenimiento'];
    }

    public function buscaReservaHab($habi, $desde, $hasta)
    {
        global $database;

        $data = $database->query("SELECT num_reserva, fecha_llegada, fecha_salida, estado, num_habitacion, id_huesped FROM reservas_pms WHERE (fecha_llegada BETWEEN '$desde' AND '$hasta') AND estado = 'ES' AND num_habitacion = '$habi'OR (fecha_salida BETWEEN '$desde' AND '$hasta') AND estado = 'ES' AND num_habitacion = '$habi' ORDER BY fecha_llegada")->fetchAll();

        return $data;
    }

    public function actualizaMmtoHabitacion($room, $mmto)
    {
        global $database;

        $data = $database->update('habitaciones', [
            'estado' => 1,
            'mantenimiento' => $mmto,
            'sucia' => 1,
        ], [
            'numero_hab' => $room,
        ]);

        return $data->rowCount();
    }

    public function adicionaMantenimiento($room, $desde, $hasta, $motivo, $inventario, $estadoHab, $observa, $presup, $numero, $tipo, $usuario)
    {
        global $database;

        $data = $database->insert('mantenimiento_habitaciones', [
            'id_habitacion' => $room,
            'id_mantenimiento' => $motivo,
            'tipo_bloqueo' => $inventario,
            'desde_fecha' => $desde,
            'hasta_fecha' => $hasta,
            'observaciones' => $observa,
            'id_usuario' => $usuario,
            'fecha_mmto' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'estado_mmto' => 1,
            'retirar_inventario' => $inventario,
            'presupuesto' => $presup,
            'tipo_mmto' => $tipo,
            'con_mantenimiento' => $numero,
        ]);

        return $database->id();
    }

    public function getHabitacionesMmto($ctamaster)
    {
        global $database;

        $data = $database->query("SELECT habitaciones.id, habitaciones.numero_hab, habitaciones.tipo_hab, habitaciones.pax, habitaciones.camas, habitaciones.estado_fo, habitaciones.estado_hk, habitaciones.mantenimiento, habitaciones.sucia, habitaciones.ocupada, tipo_habitaciones.descripcion_habitacion FROM  habitaciones, tipo_habitaciones WHERE habitaciones.id_tipohabitacion = tipo_habitaciones.id AND tipo_habitaciones.tipo_habitacion = 1 AND habitaciones.active_at = 1 AND habitaciones.mantenimiento = 0 ORDER BY  habitaciones.numero_hab")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function habitacionesMantenimiento()
    {
        global $database;

        $data = $database->select('mantenimiento_habitaciones', [
            '[>]grupos_cajas' => ['id_mantenimiento' => 'id_grupo'],
        ], [
            'grupos_cajas.descripcion_grupo',
            'mantenimiento_habitaciones.id_mmto',
            'mantenimiento_habitaciones.id_habitacion',
            'mantenimiento_habitaciones.id_mantenimiento',
            'mantenimiento_habitaciones.tipo_bloqueo',
            'mantenimiento_habitaciones.desde_fecha',
            'mantenimiento_habitaciones.hasta_fecha',
            'mantenimiento_habitaciones.observaciones',
            'mantenimiento_habitaciones.id_usuario',
            'mantenimiento_habitaciones.estado_mmto',
            'mantenimiento_habitaciones.retirar_inventario',
            'mantenimiento_habitaciones.con_mantenimiento',
            'mantenimiento_habitaciones.tipo_mmto',
            'mantenimiento_habitaciones.presupuesto',
            'mantenimiento_habitaciones.valor_mmto',
            'mantenimiento_habitaciones.created_at',
        ], [
            'mantenimiento_habitaciones.estado_mmto' => 1,
        ]);

        return $data;
    }

    public function entregaObjetosPerdidos($id, $fechaent, $entregado, $por, $observaEnt, $idusuario, $tratamiento)
    {
        global $database;

        $data = $database->update('objetos_olvidados', [
            'entregado_por' => $por,
            'entregado_a' => $entregado,
            'fecha_entrega' => $fechaent,
            'accion_objeto' => 1,
            'tratamiento_objeto' => $tratamiento,
            'observaciones_objeto' => $observaEnt,
            'id_usuario_entrega' => $idusuario,
            'updated_at' => date('Y-m-d H:i:s'),
        ], [
            'id_objeto' => $id,
        ]);

        return $data->rowCount();
    }

    public function adicionaObservacionesObjeto($id, $observacion)
    {
        global $database;

        $data = $database->update('objetos_olvidados', [
            'observaciones_objeto' => $observacion,
        ], [
            'id_objeto' => $id,
        ]);

        return $data->rowCount();
    }

    public function getNumeroHab($id)
    {
        global $database;

        $data = $database->select('habitaciones', [
            'numero_hab',
        ], [
            'id' => $id,
        ]);

        return $data[0]['numero_hab'];
    }

    public function getBuscaObjetoOlvidado($id)
    {
        global $database;

        $data = $database->select('objetos_olvidados', [
            'objeto_encontrado',
            'fecha_encontrado',
            'id_habitacion',
            'estado_objeto',
            'lugar_encontrado',
            'id_huesped',
            'encontrado_por',
            'observaciones_objeto',
            'almacenado_en',
            'id_usuario',
            'accion_objeto',
            'created_at',
        ], [
            'id_objeto' => $id,
        ]);

        return $data;
    }

    public function adicionaObjetosPerdidos($objeto, $fecha, $room, $estado, $lugar, $huesped, $encontrado, $almacena, $observa, $idusuario)
    {
        global $database;

        $data = $database->insert('objetos_olvidados', [
            'objeto_encontrado' => $objeto,
            'fecha_encontrado' => $fecha,
            'id_habitacion' => $room,
            'estado_objeto' => $estado,
            'lugar_encontrado' => $lugar,
            'id_huesped' => $huesped,
            'encontrado_por' => $encontrado,
            'observaciones_objeto' => $observa,
            'almacenado_en' => $almacena,
            'id_usuario' => $idusuario,
            'accion_objeto' => 0,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getHuespedesActivos()
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'nombre_completo',
        ], [
            'ORDER' => ['nombre_completo' => 'ASC'],
        ]);

        return $data;
    }

    public function traeNroHabitacion($id)
    {
        global $database;

        $data = $database->select('habitaciones', [
            'numero_hab',
        ], [
            'id' => $id,
        ]);

        return $data[0]['numero_hab'];
    }

    public function objetosOlvidados()
    {
        global $database;

        $data = $database->select('objetos_olvidados', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'huespedes.nombre_completo',
            'id_objeto',
            'id_habitacion',
            'id_huesped',
            'objeto_encontrado',
            'lugar_encontrado',
            'encontrado_por',
            'objetos_olvidados.id_usuario',
            'fecha_encontrado',
            'almacenado_en',
            'entregado_por',
            'entregado_a',
            'fecha_entrega',
            'estado_objeto',
            'accion_objeto',
            'tratamiento_objeto',
            'observaciones_objeto',
            'created_at',
        ], [
            'ORDER' => ['fecha_encontrado' => 'ASC'],
        ]);

        return $data;
    }

    public function traeConsecutivoDecreto()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_decreto',
        ]);

        return $data[0]['con_decreto'];
    }

    public function actualizaDecreto($regis)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_decreto' => $regis,
        ]);

        return $data->rowCount();
    }

    public function countRegistrosSinImprimir($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'fecha_llegada' => $fecha,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getFacturasPorRango($sele)
    {
        global $database;

        $data = $database->query($sele)->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getLogin($user, $pass)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
            'correo',
            'nombres',
            'apellidos',
            'usuario',
            'estado',
            'foto_usuario',
            'usuario',
            'tipo',
            'empresa_id',
            'estado_usuario_pms',
            'estado_usuario_pos',
        ], [
            'usuario' => $user,
            'password' => $pass,
            'deleted_at' => null,
        ]);

        return $data;
    }

    public function actualizaNombre($id, $nombre)
    {
        global $database;

        $data = $database->update('huespedes', [
            'nombre_completo' => $nombre,
        ], [
            'id_huesped' => $id,
        ]);

        return $data->rowCount();
    }

    public function abreCajero($user)
    {
        global $database;

        $data = $database->update('usuarios', [
            'estado_usuario_pms' => 1,
        ], [
            'usuario' => $user,
        ]);

        return $data->rowCount();
    }

    public function ingresoLog($id, $user, $pc, $ip, $accion, $inicial, $final, $modulo)
    {
        global $database;

        $data = $database->insert('log', [
            'idregistro' => $id,
            'usuario' => $user,
            'equipo' => $pc,
            'accion' => $accion,
            'iplog' => $ip,
            'datoinicial' => $inicial,
            'datofinal' => $final,
            'modulo' => $modulo,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function cambiaEstadoCajeros()
    {
        global $database;

        $data = $database->update('usuarios', [
            'estado_usuario_pms' => 0,
        ], [
            'estado' => 'A',
        ]);

        return $data;
    }

    public function getAbrirCajero($user)
    {
        global $database;

        $data = $database->update('usuarios', [
            'estado_usuario_pms' => 1,
        ], [
            'usuario' => $user,
        ]);

        return $data;
    }

    public function getCuentasCongeladas()
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'estado' => 'CO',
        ]);

        return $data;
    }

    public function getCuentasMaestras()
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'reservas_pms.num_habitacion',
        ], [
            'reservas_pms.estado' => 'CA',
            'reservas_pms.tipo_habitacion' => '1',
        ]);

        return $data;
    }

    public function habitacionesUsoDia($fecha)
    {
        global $database;

        $data = $database->query("SELECT count(id) as habi, sum(can_hombres) as hom, sum(can_mujeres) as muj, sum(can_ninos) as nin  FROM reservas_pms WHERE fecha_llegada = salida_checkout AND salida_checkout = '$fecha'")->fetchAll();

        return $data;
    }

    public function getCajerosAbiertos()
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario',
            'usuario_id',
        ], [
            'estado_usuario_pms' => 1,
            'estado' => 'A',
        ]);

        return $data;
    }

    public function getDepositosdelDia($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.id_usuario',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'cargos_pms.concecutivo_abono[>]' => 0,
            'ORDER' => [
                'concecutivo_abono' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getDepositosdelDiaporcajero($fecha, $usuario, $tipo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.usuario' => $usuario,
            'cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'cargos_pms.concecutivo_abono[>]' => 0,
            'ORDER' => [
                'concecutivo_abono' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getBuscaCargosFacturaDia($factura, $reserva, $perfil)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'fecha_cargo',
            'monto_cargo',
            'impuesto',
            'descripcion_cargo',
            'usuario',
            'pagos_cargos',
            'numero_factura_cargo',
            'folio_cargo',
        ], [
            'cargo_anulado' => 0,
            'factura_numero' => $factura,
            'numero_reserva' => $reserva,
            'perfil_factura' => $perfil,
            'ORDER' => [
                'id_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function adicionaObservaciones($reserva, $observacion)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'observaciones' => $observacion,
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data->rowCount();
    }

    public function registrosHotelerosSinImprimir($fecha)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]tipo_habitaciones' => ['tipo_habitacion' => 'codigo'],
        ], [
            'fecha_llegada',
            'huespedes.nombre_completo',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'num_habitacion',
            'num_registro',
        ], [
            'tipo_habitaciones.tipo_habitacion[<]' => 4,
            'num_registro' => 0,
            'estado' => 'CA',
            'ORDER' => ['num_habitacion' => 'ASC'],
        ]);

        return $data;
    }

    public function actualizaRegistroReserva($reserva, $numregis)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'num_registro' => $numregis,
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function actualizaRegistro($regis)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_registro_hotelero' => $regis,
        ]);

        return $data->rowCount();
    }

    public function traeConsecutivoRegistro()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_registro_hotelero',
        ]);

        return $data[0]['con_registro_hotelero'];
    }

    public function buscaFacturaNumero($factura, $reserva)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[<]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'codigos_vta.codigo_ajuste',
            'cargos_pms.id_cargo',
            'cargos_pms.id_codigo_cargo',
        ], [
            'cargos_pms.factura_numero' => $factura,
            'cargos_pms.numero_reserva' => $reserva,
        ]);

        return $data;
    }

    public function cambiaCodigoFacturaHistorico($cargo, $newcode, $descr)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'id_codigo_cargo' => $newcode,
            'descripcion_cargo' => $descr,
        ], [
            'id_cargo' => $cargo,
        ]);

        return $data;
    }

    public function cambioValorFacturaHistorico($factura, $reserva, $fecha, $usuario, $idusuario)
    {
        global $database;

        $data = $database->query("UPDATE cargos_pms SET monto_cargo = monto_cargo * -1, base_impuesto = base_impuesto  * -1, impuesto = impuesto * -1, valor_cargo = valor_cargo * -1, pagos_cargos = pagos_cargos * -1, usuario = '$usuario', id_usuario = '$idusuario', fecha_cargo = '$fecha' WHERE numero_reserva = '$reserva' AND factura_numero = '$factura'")->fetchAll();
    }

    public function getBuscaHuespedCongela($huesped)
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'identificacion',
            'tipo_identifica',
            'lugar_expedicion',
            'pais',
            'sexo',
        ], [
            'id_huesped' => $huesped,
        ]);

        return $data;
    }

    public function anulafacturaHistoricoXCongelada($factura, $reserva, $motivo, $usuario, $idusuario, $perfil)
    {
        global $database;

        $data = $database->update('historico_cargos_pms', [
            'factura_anulada' => 1,
            'cargo_anulado' => 1,
            'motivo_anulacion' => $motivo,
            'usuario_anulacion' => $usuario,
            'id_usuario_anulacion' => $idusuario,
            'fecha_anulacion' => date('Y-m-d H:i:s'),
        ], [
            'factura_numero' => $factura,
            'numero_reserva' => $reserva,
            'perfil_factura' => $perfil,
            'factura' => 1,
        ]);

        return $data;
    }



    public function eliminaHistoricoFacturaXCongelada($factura, $reserva)
    {
        global $database;

        $data = $database->delete('historico_cargos_pms', [
            'AND' => [
                'factura_numero' => $factura,
                'numero_reserva' => $reserva,
                'factura' => 0,
            ],
        ]);

        return $data;
    }

    public function activaCuentaCongeladaFacturaAnulada($factura, $reserva)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'tipo_factura' => 0,
            'id_perfil_factura' => 0,
            'factura_numero' => 0,
        ], [
            'factura_numero' => $factura,
            'numero_reserva' => $reserva,
        ]);

        return $data;
    }

    public function getBuscaHistoricoReserva($id)
    {
        global $database;

        $data = $database->select('historico_reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'huespedes.nombre_completo',
            'huespedes.identificacion',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'historico_reservas_pms.id',
            'historico_reservas_pms.cantidad',
            'historico_reservas_pms.dias_reservados',
            'historico_reservas_pms.estado',
            'historico_reservas_pms.fecha_llegada',
            'historico_reservas_pms.fecha_salida',
            'historico_reservas_pms.tipo_reserva',
            'historico_reservas_pms.num_habitacion',
            'historico_reservas_pms.num_reserva',
            'historico_reservas_pms.can_hombres',
            'historico_reservas_pms.can_mujeres',
            'historico_reservas_pms.orden_reserva',
            'historico_reservas_pms.can_ninos',
            'historico_reservas_pms.origen_reserva',
            'historico_reservas_pms.destino_reserva',
            'historico_reservas_pms.id_agencia',
            'historico_reservas_pms.id_compania',
            'historico_reservas_pms.idCentroCia',
            'historico_reservas_pms.id_huesped',
            'historico_reservas_pms.tarifa',
            'historico_reservas_pms.tipo_habitacion',
            'historico_reservas_pms.tipo_ocupacion',
            'historico_reservas_pms.valor_reserva',
            'historico_reservas_pms.valor_diario',
            'historico_reservas_pms.motivo_viaje',
            'historico_reservas_pms.fecha_reserva',
            'historico_reservas_pms.usuario',
            'historico_reservas_pms.fecha_ingreso',
            'historico_reservas_pms.observaciones',
            'historico_reservas_pms.fuente_reserva',
            'historico_reservas_pms.segmento_mercado',
            'historico_reservas_pms.cargo_habitacion',
            'historico_reservas_pms.causar_impuesto',
            'historico_reservas_pms.forma_pago',
            'historico_reservas_pms.reservaCreada',
        ], [
            'num_reserva' => $id,
        ]);

        return $data;
    }

    public function getBuscaHistoricoCargosFactura($factura, $reserva)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'fecha_cargo',
            'monto_cargo',
            'impuesto',
            'descripcion_cargo',
            'usuario',
            'pagos_cargos',
            'numero_factura_cargo',
            'folio_cargo',
        ], [
            'cargo_anulado' => 0,
            'factura_numero' => $factura,
            'numero_reserva' => $reserva,
            'ORDER' => [
                'id_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function deleteCargoshistoricoXCongelado($factura, $reserva)
    {
        global $database;

        $data = $database->delete('historico_cargos_pms', [
            'AND' => [
                'factura_numero' => $factura,
                'numero_reserva' => $reserva,
            ],
        ]);

        return $data;
    }

    public function insertCargosHistorico($factura, $reserva)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_cargos_pms SELECT * FROM cargos_pms WHERE factura_numero = '$factura' AND numero_reserva = '$reserva' AND cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function borraHistoricoCongela($numero)
    {
        global $database;

        $data = $database->delete('historico_reservas_pms', [
            'AND' => [
                'num_reserva' => $numero,
            ],
        ]);

        return $data;
    }

    public function insertaHistoricoCongela($numero)
    {
        global $database;

        $data = $database->query("INSERT INTO reservas_pms SELECT * FROM historico_reservas_pms WHERE num_reserva = '$numero'")->fetchAll();

        return $database->id();
    }

    public function getFacturasReserva($id)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[<]huespedes' => 'id_huesped',
            '[<]historico_reservas_pms' => ['numero_reserva' => 'num_reserva'],
        ], [
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'historico_reservas_pms.fecha_llegada',
            'historico_reservas_pms.salida_checkout',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.tipo_factura',
            'historico_cargos_pms.id_perfil_factura',
            'historico_cargos_pms.factura_numero',
            'historico_cargos_pms.numero_reserva',
            'historico_cargos_pms.factura_anulada',
            'historico_cargos_pms.fecha_factura',
            'historico_cargos_pms.id_usuario_factura',
            'historico_cargos_pms.total_consumos',
            'historico_cargos_pms.total_impuesto',
            'historico_cargos_pms.total_pagos',
            'historico_cargos_pms.fecha_sistema_cargo',
        ], [
            'historico_cargos_pms.factura' => 1,
            'historico_cargos_pms.numero_reserva' => $id,
            'ORDER' => ['historico_cargos_pms.factura_numero' => 'ASC'],
        ]);

        return $data;
    }

    public function getHistoricoVentasDiaCodigo($fecha, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(impuesto) as imptos, Sum(monto_cargo) as cargos, Sum(pagos_cargos) as pagos FROM historico_cargos_pms WHERE cargo_anulado = 0 AND id_codigo_cargo = '$codi' AND fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function getHistoricoVentasMesCodigo($dia, $mes, $anio, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM historico_cargos_pms WHERE historico_cargos_pms.cargo_anulado = 0 AND id_codigo_cargo = '$codi' AND MONTH(historico_cargos_pms.fecha_cargo) = '$mes' AND historico_cargos_pms.fecha_cargo <= '$dia' AND historico_cargos_pms.fecha_cargo >= '2019-07-29'")->fetchAll();

        return $data;
    }

    public function getHistoricoVentasMesCodigoHistorico($dia, $mes, $anio, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE historico_cargos_pms.cargo_anulado = 0 AND id_codigo_cargo = '$codi' AND MONTH(historico_cargos_pms.fecha_cargo) = '$mes' AND YEAR(historico_cargos_pms.fecha_cargo) = '$anio'")->fetchAll();

        return $data;
    }

    public function getHistoricoVentasAnioCodigo($dia, $anio, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM historico_cargos_pms WHERE historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.id_codigo_cargo = '$codi' AND YEAR(historico_cargos_pms.fecha_cargo) = '$anio' AND historico_cargos_pms.fecha_cargo <= '$dia' AND historico_cargos_pms.fecha_cargo >= '2019-07-29'")->fetchAll();

        return $data;
    }

    public function getHistoricoVentasAnioCodigoHistorico($dia, $anio, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM historico_cargos_pms WHERE historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.id_codigo_cargo = '$codi' AND YEAR(historico_cargos_pms.fecha_cargo) = '$anio' AND historico_cargos_pms.fecha_cargo <= '$dia' ")->fetchAll();

        return $data;
    }

    public function getHistoricoCargosDia($fecha, $tipo)
    {
        global $database;

        $data = $database->query("SELECT historico_cargos_pms.descripcion_cargo, count(historico_cargos_pms.monto_cargo) as canti, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.impuesto) as imptos, sum(historico_cargos_pms.monto_cargo+historico_cargos_pms.impuesto) as total_cargo, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM historico_cargos_pms , codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND historico_cargos_pms.cargo_anulado = 0 AND codigos_vta.tipo_codigo = '$tipo' AND historico_cargos_pms.fecha_cargo = '$fecha' GROUP BY historico_cargos_pms.descripcion_cargo ORDER BY historico_cargos_pms.descripcion_cargo ASC")->fetchAll();

        return $data;
    }

    public function getHistoricoBalanceSaldodelDia($fecha)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.monto_cargo) AS saldo_viene, Sum(historico_cargos_pms.impuesto) AS impto_viene, Sum(historico_cargos_pms.pagos_cargos) AS pagos_viene, Sum(historico_cargos_pms.monto_cargo + historico_cargos_pms.impuesto - historico_cargos_pms.pagos_cargos) AS total_viene FROM historico_cargos_pms , historico_reservas_pms WHERE historico_cargos_pms.numero_reserva = historico_reservas_pms.num_reserva AND historico_reservas_pms.tipo_reserva = 2 AND historico_cargos_pms.fecha_cargo = '$fecha' AND historico_cargos_pms.cargo_anulado = 0 AND historico_reservas_pms.cargo_habitacion < '9450'")->fetchAll();

        return $data;
    }

    public function getHistoricoBalanceSaldoAnterior($fecha)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.monto_cargo) AS saldo_viene, Sum(historico_cargos_pms.impuesto) AS impto_viene, Sum(historico_cargos_pms.pagos_cargos) AS pagos_viene, Sum(historico_cargos_pms.monto_cargo + historico_cargos_pms.impuesto - historico_cargos_pms.pagos_cargos) AS total_viene FROM historico_cargos_pms , historico_reservas_pms WHERE historico_cargos_pms.numero_reserva = historico_reservas_pms.num_reserva AND historico_reservas_pms.tipo_reserva = 2 AND historico_cargos_pms.fecha_cargo < '$fecha' AND historico_cargos_pms.cargo_anulado = 0 AND historico_reservas_pms.cargo_habitacion < '9450' AND year(historico_cargos_pms.fecha_cargo)=2019 AND historico_cargos_pms.fecha_cargo >= '2019-07-29'")->fetchAll();

        return $data;
    }

    public function cambiaHuespedReserva($rese, $hues)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'id_huesped' => $hues,
        ], [
            'num_reserva' => $rese,
        ]);

        return $data->rowCount();
    }

    public function borraCargosAnulados()
    {
        global $database;

        $data = $database->delete('cargos_pms', [
            'AND' => [
                'cargo_anulado' => 1,
            ],
        ]);

        return $data;
    }

    public function getBuscaFechaAuditoria($fecha)
    {
        global $database;

        $data = $database->select('auditoria', [
            'id_proceso',
            'titulo_proceso',
            'orden_proceso',
            'reporte',
        ], [
            'actived_at' => 1,
            'imprimir' => 1,
            'ORDER' => ['orden_proceso' => 'ASC'],
        ]);

        return $data;
    }

    public function getSalidasRealizadas($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]companias' => ['id_compania' => 'id_compania'],
            '[>]huespedes' => ['id_huesped' => 'id_huesped'],
            '[>]cargos_pms' => ['num_reserva' => 'id_reserva'],
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.salida_checkout',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.observaciones',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.estado',
            'reservas_pms.causar_impuesto',
            'huespedes.nombre_completo',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'companias.empresa',
            'cargos_pms.pagos_cargos',
        ], [
            'tipo_reserva' => $tipo,
            'estado' => $estado,
            'salida_checkout' => $fecha,
            'ORDER' => ['reservas_pms.num_habitacion' => 'ASC'],
        ]);

        return $data;
    }

    public function actualizaEstadistica($regis, $dispo, $ocup, $huesp)
    {
        global $database;

        $data = $database->update('reporte_gerencia', [
            'ingreso_promedio_habitacion_disponible' => $dispo,
            'ingreso_promedio_habitacion_ocupada' => $ocup,
            'ingreso_promedio_huesped' => $huesp,
        ], [
            'id_auditoria' => $regis,
        ]);

        return $data;
    }

    public function getAuditorias()
    {
        global $database;

        $data = $database->query('SELECT * FROM reporte_gerencia')->fetchAll();

        return $data;
    }

    public function cambiaNoShow($fecha, $estado)
    {
        global $database;

        $data = $database->update('historico_reservas_pms', [
            'estado' => 'NS',
        ], [
            'fecha_llegada' => $fecha,
            'estado' => 'ES',
        ]);

        return $data;
    }

    public function getLlegadasSinReserva($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'num_habitacion',
        ], [
            'estado' => 'CA',
            'sinreserva' => 1,
            'fecha_llegada' => $fecha,
        ]);

        return $data;
    }

    public function getSalidasAntes($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'num_habitacion',
        ], [
            'estado' => 'SA',
            'fecha_salida[>]' => $fecha,
        ]);

        return $data;
    }

    public function getHuespedesInterNal($cta, $pais)
    {
        global $database;

        $data = $database->query("SELECT Count(huespedes.id_huesped) as inter FROM huespedes , reservas_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.estado = 'CA' AND reservas_pms.tipo_habitacion <> '$cta' and huespedes.pais <>  '$pais'")->fetchAll();

        return $data[0]['inter'];
    }

    public function getHuespedesNacionales($cta, $pais)
    {
        global $database;

        $data = $database->query("SELECT Count(huespedes.id_huesped) as nales FROM huespedes , reservas_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.estado = 'CA' AND reservas_pms.tipo_habitacion <> '$cta' and huespedes.pais =  '$pais'")->fetchAll();

        return $data[0]['nales'];
    }

    public function getHuespedesRepetitivos()
    {
        global $database;

        $data = $database->query("SELECT Count(historico_reservas_pms.id_huesped) FROM historico_reservas_pms , reservas_pms WHERE reservas_pms.id_huesped = historico_reservas_pms.id_huesped AND historico_reservas_pms.estado = 'SA' AND reservas_pms.estado = 'CA' GROUP BY historico_reservas_pms.id_huesped")->fetchAll();

        return $data;
    }

    public function getIngresoHuesped($fecha)
    {
        global $database;

        $data = $database->query("SELECT sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, reservas_pms WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND reservas_pms.id_compania = 0 AND cargos_pms.cargo_anulado = 0 AND cargos_pms.fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function getIngresoIndividual($fecha)
    {
        global $database;

        $data = $database->query("SELECT sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, reservas_pms WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND cargos_pms.cargo_anulado = 0 AND cargos_pms.fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function getIngresoGrupo($fecha)
    {
        global $database;

        $data = $database->query("SELECT sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, reservas_pms WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND reservas_pms.id_grupo <> 0 AND cargos_pms.cargo_anulado = 0 AND cargos_pms.fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function getIngresoAgencia($fecha)
    {
        global $database;

        $data = $database->query("SELECT sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, reservas_pms WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND reservas_pms.id_agencia <> 0 AND cargos_pms.cargo_anulado = 0 AND cargos_pms.fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function getIngresoCia($fecha)
    {
        global $database;

        $data = $database->query("SELECT sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, reservas_pms WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND reservas_pms.id_compania <> 0 AND cargos_pms.cargo_anulado = 0 AND cargos_pms.fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function salidasPendientes($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'fecha_salida',
        ], [
            'fecha_salida' => $fecha,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getFacturasPorcompania($id)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[<]huespedes' => 'id_huesped',
        ], [
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.tipo_factura',
            'historico_cargos_pms.id_perfil_factura',
            'historico_cargos_pms.factura_numero',
            'historico_cargos_pms.numero_reserva',
            'historico_cargos_pms.factura_anulada',
            'historico_cargos_pms.fecha_factura',
            'historico_cargos_pms.id_usuario_factura',
            'historico_cargos_pms.total_consumos',
            'historico_cargos_pms.total_impuesto',
            'historico_cargos_pms.total_pagos',
            'historico_cargos_pms.fecha_sistema_cargo',
        ], [
            'historico_cargos_pms.factura' => 1,
            'historico_cargos_pms.tipo_factura' => 2,
            'historico_cargos_pms.id_perfil_factura' => $id,
            'ORDER' => ['historico_cargos_pms.factura_numero' => 'ASC'],
        ]);

        return $data;
    }

    public function getFacturasdelDia()
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[<]huespedes' => 'id_huesped',
        ], [
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.tipo_factura',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.id_perfil_factura',
            'cargos_pms.factura_numero',
            'cargos_pms.numero_reserva',
            'cargos_pms.factura_anulada',
            'cargos_pms.id_usuario_factura',
            'cargos_pms.total_consumos',
            'cargos_pms.total_impuesto',
            'cargos_pms.total_pagos',
            'cargos_pms.fecha_sistema_cargo',
        ], [
            'fecha_factura' => FECHA_PMS,
            'factura' => 1,
            'ORDER' => ['factura_numero' => 'ASC'],
        ]);

        return $data;
    }

    public function updateEstadoReserva($nro)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'estado' => 'CA',
            'salida_checkout' => null,
            'usuario_checkout' => null,
            'id_usuario_checkout' => 0,
            'fecha_checkout' => null,
        ], [
            'num_reserva' => $nro,
        ]);

        return $data->rowCount();
    }

    public function anulaFactura($nro, $motivo, $usuario, $idusuario, $perfil, $numDoc)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'cargo_anulado' => 1,
            'factura_anulada' => 1,
            'motivo_anulacion' => $motivo,
            'usuario_anulacion' => $usuario,
            'id_usuario_anulacion' => $idusuario,
            'fecha_anulacion' => FECHA_PMS,
            'numero_factura_cargo' => $numDoc,
            'fecha_sistema_anula' => date('Y-m-d H:i:s'),
        ], [
            'factura_numero' => $nro,
            'perfil_factura' => $perfil,
        ]);

        return $data->rowCount();
    }

    public function anulaFacturaHis($nro, $motivo, $usuario, $idusuario, $perfil, $numDoc)
    {
        global $database;

        $data = $database->update('historico_cargos_pms', [
            'cargo_anulado' => 1,
            'factura_anulada' => 1,
            'motivo_anulacion' => $motivo,
            'usuario_anulacion' => $usuario,
            'id_usuario_anulacion' => $idusuario,
            'fecha_anulacion' => FECHA_PMS,
            'numero_factura_cargo' => $numDoc,
            'fecha_sistema_anula' => date('Y-m-d H:i:s'),
        ], [
            'factura_numero' => $nro,
            'perfil_factura' => $perfil,
            'factura' => 1,

        ]);

        return $data->rowCount();
    }


    public function actualizaCargosFacturas($nro, $perfil)
    {
        global $database;

        $data = $database->query("UPDATE cargos_pms SET factura_numero = 0, fecha_factura = null, tipo_factura = 0, usuario_factura = null, id_usuario_factura = 0,  id_perfil_factura= 0  WHERE factura_numero = '$nro' AND factura <> 1 AND cargo_anulado = 0 AND perfil_factura = $perfil")->fetchAll();

        return $data;
    }

    public function actualizaCargosFacturasHis($nro, $perfil)
    {
        global $database;

        $data = $database->query("UPDATE historico_cargos_pms SET factura_numero = 0, fecha_factura = null, tipo_factura = 0, usuario_factura = null, id_usuario_factura = 0,  id_perfil_factura= 0  WHERE factura_numero = '$nro' AND factura <> 1 AND cargo_anulado = 0 AND perfil_factura = $perfil")->fetchAll();

        return $data;
    }


    public function getDatosFactura($nro)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'numero_reserva',
            'factura_numero',
            'habitacion_cargo',
            'factura',
            'id_huesped',
            'id_perfil_factura',
            'tipo_factura',
            'fecha_salida',
            'fecha_vencimiento',
            'folio_cargo',
        ], [
            'factura_numero' => $nro,
            'factura' => 1,
        ]);

        return $data;
    }

    public function getDatosFacturaHistorico($nro)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'numero_reserva',
            'factura_numero',
            'habitacion_cargo',
            'factura',
            'id_huesped',
            'id_perfil_factura',
            'tipo_factura',
            'fecha_salida',
            'folio_cargo',
        ], [
            'factura_numero' => $nro,
            'factura' => 1,
        ]);

        return $data;
    }

    public function updateFactura($id, $cargos, $impto, $pagos, $base, $anticipo, $fechaVen, $nro, $usuario, $fecha, $diasCre)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'id_usuario_factura' => $id,
            'usuario_factura' => $usuario,
            'fecha_factura' => $fecha,
            'fecha_vencimiento' => $fechaVen,
            'total_consumos' => $cargos,
            'total_impuesto' => $impto,
            'total_anticipos' => $anticipo,
            'base_impuestos' => $base,
            'total_pagos' => $pagos,
            'diasCredito' => $diasCre,

        ], [
            'factura_numero' => $nro,
            'factura' => 1,
        ]);

        return $data->rowCount();
    }

    public function getIdUsuario($code)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario_id',
        ], [
            'usuario' => $code,
        ]);

        return $data[0]['usuario_id'];
    }

    public function getValorFactura($id)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.base_impuesto) AS base, Sum(cargos_pms.impuesto) AS imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero FROM cargos_pms WHERE cargos_pms.cargo_anulado = 0 AND cargos_pms.factura_numero = '$id' GROUP BY cargos_pms.factura_numero ORDER BY cargos_pms.factura_numero ASC")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getFacturas()
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            'fecha_cargo',
            'factura_numero',
            'usuario_factura',
        ], [
            'factura' => 1,
        ]);

        return $data;
    }

    public function getInformacionAbono($id)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'fecha_cargo',
            'id_codigo_cargo',
            'habitacion_cargo',
            'descripcion_cargo',
            'id_usuario',
            'id_huesped',
            'cantidad_cargo',
            'informacion_cargo',
            'referencia_cargo',
            'folio_cargo',
            'pagos_cargos',
            'concecutivo_abono',
            'numero_reserva',
            'id_reserva',
            'fecha_sistema_cargo',
        ], [
            'concecutivo_abono' => $id,
        ]);

        return $data;
    }

    public function nombreUsuario($id)
    {
        global $database;

        $data = $database->select('usuarios', [
            'usuario',
        ], [
            'usuario_id' => $id,
        ]);
        if (count($data) == 0) {
            return 'USUARIO NO ASIGNADO';
        } else {
            return $data[0]['usuario'];
        }
    }

    public function getDepositosReservas($id)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'id_cargo',
            'descripcion_cargo',
            'pagos_cargos',
            'informacion_cargo',
            'fecha_cargo',
            'concecutivo_abono',
            'id_usuario',
            'id_codigo_cargo',
        ], [
            'id_reserva' => $id,
            'cargo_anulado' => 0,
            'concecutivo_abono[>=]' => 1,
        ]);

        return $data;
    }

    public function getInformacionDeposito($id)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            'fecha_cargo',
            'id_codigo_cargo',
            'habitacion_cargo',
            'descripcion_cargo',
            'id_usuario',
            'id_huesped',
            'cantidad_cargo',
            'folio_cargo',
            'pagos_cargos',
            'concecutivo_abono',
            'informacion_cargo',
            'numero_reserva',
            'id_reserva',
            'fecha_sistema_cargo',
        ], [
            'concecutivo_abono' => $id,
        ]);

        return $data;
    }

    public function getDescripcionTarifa($id)
    {
        global $database;

        $data = $database->select('tarifas', [
            'descripcion_tarifa',
        ], [
            'id_tarifa' => $id,
        ]);
        if (count($data) == 0) {
            return 'SIN TARIFA ASIGNADA';
        } else {
            return $data[0]['descripcion_tarifa'];
        }
    }

    public function getHistoricoFacturasCia($id)
    {
        global $database;

        $data = $database->query('SELECT historico_reservas_pms.fecha_llegada, historico_reservas_pms.fecha_salida, Sum(historico_cargos_pms.monto_cargo), Sum(historico_cargos_pms.impuesto), Sum(historico_cargos_pms.factura_numero),historico_cargos_pms.factura_numero, historico_cargos_pms.fecha_factura, historico_cargos_pms.pagos_cargos, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2 FROM historico_reservas_pms, historico_cargos_pms, huespedes WHERE historico_reservas_pms.num_reserva = historico_cargos_pms.numero_reserva AND historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.id_huesped = huespedes.id_huesped GROUP BY historico_reservas_pms.fecha_llegada, historico_reservas_pms.fecha_salida, historico_cargos_pms.fecha_factura, historico_cargos_pms.pagos_cargos, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2 ORDER BY historico_cargos_pms.factura_numero ASC')->fetchAll();

        return $data;
    }

    public function updateReservaHuespedCongela($reserva, $usuario, $idusuario, $fecha, $numero)
    {
        global $database;

        // Cambia Estado habitacion a Salida Huesped
        $data = $database->update('reservas_pms', [
            'estado' => 'CO',
            'con_congela' => $numero,
            'usuario_congela' => $usuario,
            'id_usuario_congela' => $idusuario,
            'fecha_congela' => date('Y-m-d H:i:s'),
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data->rowCount();
    }

    public function updateNumeroCongela($numero)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_cta_congelada' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getNumeroCongela()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_cta_congelada',
        ]);

        return $data[0]['con_cta_congelada'];
    }

    public function getFechaLlegada($llega, $sale, $tipo, $estado)
    {
        global $database;

        $data = $database->query('')->fetchAll();

        return $data;
    }

    public function getIngresoHistoricoImptoGrupo($fecha, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as impto FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND historico_cargos_pms.fecha_cargo = '$fecha' AND historico_cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getIngresoHistoricoGrupo($fecha, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.monto_cargo) as cargos FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND historico_cargos_pms.fecha_cargo = '$fecha' AND historico_cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getDatosAnioAuditoria($anio)
    {
        global $database;

        $data = $database->query("SELECT 
            sum(habitaciones_hotel) as ahabhot,
            SUM(ingreso_habitaciones) AS aingHab, 
            SUM(ingreso_impto_habitaciones) AS aingImp, 
            SUM(ingreso_promedio_habitacion_disponible)AS aingProHabDis, 
            SUM(ingreso_promedio_habitacion_ocupada)AS aingProHabOcu, 
            SUM(ingresos_compania)AS aingCom, 
            SUM(ingresos_agencia) AS aingAge, 
            SUM(ingresos_grupo) AS aingGru, 
            SUM(ingresos_individual) AS aingInd, 
            SUM(ingreso_promedio_huesped) AS aproHue, 
            SUM(habitaciones_disponibles) AS ahabDis, 
            SUM(habitaciones_fuera_orden) AS ahabFor, 
            SUM(habitaciones_fuera_servicio) AS ahabFse, 
            SUM(habitaciones_mmto) AS ahabMmto, 
            SUM(habitaciones_ocupadas) AS ahabOcu, 
            SUM(salidas_dia) AS asalDia, 
            SUM(llegadas_dia) AS alleDia, 
            SUM(habitaciones_cortesia) AS ahabCor, 
            SUM(habitaciones_usocasa) AS ahabUca, 
            SUM(habitaciones_usodia) AS ahabUdi, 
            SUM(ingreso_potencial) AS aingPot, 
            SUM(camas_disponibles) AS acamDis, 
            SUM(hombres) AS aHom, 
            SUM(mujeres) AS aMuj, 
            SUM(ninos) AS aNin, 
            SUM(huespedes_repetitivos) AS ahueRep, 
            SUM(nuevos_huespedes) AS ahueNue, 
            SUM(huespedes_nacionales) AS ahueNal, 
            SUM(huespedes_extranjeros) AS ahueInt, 
            SUM(reservas_creadashoy) AS aresHoy, 
            SUM(reservas_noshows) AS aresNos,
            SUM(salidas_anticipadas) AS asalAnt, 
            SUM(reservas_canceladas) AS aresCan, 
            SUM(llegadas_sinreserva) AS alleSin 
            FROM 
        reporte_gerencia 
        WHERE YEAR(fecha_auditoria) = '$anio'")->fetchAll();

        return $data;
    }

    public function getDatosMesAuditoria($mes, $anio)
    {
        global $database;

        $data = $database->query("SELECT 
            sum(habitaciones_hotel) as mhabhot,
            sum(ingreso_habitaciones)as mingHab, 
            sum(ingreso_impto_habitaciones) as mingImp, 
            sum(ingreso_promedio_habitacion_disponible)as mingProHabDis, 
            sum(ingreso_promedio_habitacion_ocupada)as mingProHabOcu, 
            sum(ingresos_compania)as mingCom, 
            sum(ingresos_agencia) as mingAge, 
            sum(ingresos_grupo) as mingGru, 
            sum(ingresos_individual) as mingInd, 
            sum(ingreso_promedio_huesped) as mproHue, 
            sum(habitaciones_disponibles) as mhabDis, 
            sum(habitaciones_fuera_orden) as mhabFor, 
            sum(habitaciones_fuera_servicio) as mhabFse, 
            sum(habitaciones_ocupadas) as mhabOcu, 
            sum(habitaciones_Mmto) as mhabMmto, 
            sum(salidas_dia) as msalDia, 
            sum(llegadas_dia) as mlleDia, 
            sum(habitaciones_cortesia) as mhabCor, 
            sum(habitaciones_usocasa) as mhabUca, 
            sum(habitaciones_usodia) as mhabUdi, 
            sum(ingreso_potencial) as mingPot, 
            sum(camas_disponibles) as mcamDis, 
            sum(hombres) as mHom, 
            sum(mujeres) as mMuj, 
            sum(ninos) as mNin, 
            sum(huespedes_repetitivos) as mhueRep, 
            sum(nuevos_huespedes) as mhueNue, 
            sum(huespedes_nacionales) as mhueNal, 
            sum(huespedes_extranjeros) as mhueInt, 
            sum(reservas_creadashoy) as mresHoy, 
            sum(reservas_noshows) as mresNos, 
            sum(salidas_anticipadas) as msalAnt, 
            sum(reservas_canceladas) as mresCan, 
            sum(llegadas_sinreserva) as mlleSin 
            FROM reporte_gerencia 
            WHERE month(fecha_auditoria) = '$mes' AND year(fecha_auditoria) = '$anio'")->fetchAll();

        return $data;
    }

    public function getDatosAuditoria($fecha)
    {
        global $database;

        $data = $database->select('reporte_gerencia', [
            'fecha_auditoria',
            'habitaciones_hotel',
            'ingreso_habitaciones',
            'ingreso_impto_habitaciones',
            'ingreso_promedio_habitacion_disponible',
            'ingreso_promedio_habitacion_ocupada',
            'ingresos_compania',
            'ingresos_agencia',
            'ingresos_grupo',
            'ingresos_individual',
            'ingreso_promedio_huesped',
            'habitaciones_disponibles',
            'habitaciones_fuera_orden',
            'habitaciones_fuera_servicio',
            'habitaciones_mmto',
            'habitaciones_ocupadas',
            'salidas_dia',
            'llegadas_dia',
            'habitaciones_cortesia',
            'habitaciones_usocasa',
            'habitaciones_usodia',
            'ingreso_potencial',
            'camas_disponibles',
            'hombres',
            'mujeres',
            'ninos',
            'huespedes_repetitivos',
            'nuevos_huespedes',
            'huespedes_nacionales',
            'huespedes_extranjeros',
            'reservas_creadashoy',
            'reservas_noshows',
            'salidas_anticipadas',
            'reservas_canceladas',
            'llegadas_sinreserva',
            'llegadas_hombres',
            'mujeres_llegando',
            'ninos_llegando',
            'salidas_hombres',
            'mujeres_saliendo',
            'ninos_saliendo',
            'usuario_auditoria',
            'fecha_proceso_auditoria',
        ], [
            'fecha_auditoria' => $fecha,
        ]);

        return $data;
    }

    public function insertDiaAuditoria($fecha, $habtot, $cargo, $impto, $promhab, $promocu, $habi, $promhues, $huesp, $salidas, $llegadas, $hom, $muj, $nin, $camas, $usuario, $idusuario, $ingcia, $ingage, $inggru, $ingind, $repite, $nuevos, $nales, $inter, $resehoy, $noshow, $canceladas, $saleantes, $sinreserva, $llegaho, $llegamu, $llegani, $usodiaha, $usodiaho, $usodiamu, $usodiani, $conge, $canmmto, $homsal, $mujsal, $ninsal)
    {
        global $database;

        $data = $database->insert('reporte_gerencia', [
            'fecha_auditoria' => $fecha,
            'habitaciones_hotel' => $habtot,
            'ingreso_habitaciones' => $cargo,
            'ingreso_impto_habitaciones' => $impto,
            'ingreso_promedio_habitacion_disponible' => $promhab,
            'ingreso_promedio_habitacion_ocupada' => $promocu,
            'ingreso_promedio_huesped' => $promhues,
            'habitaciones_disponibles' => $habi,
            'habitaciones_ocupadas' => $huesp,
            'salidas_dia' => $salidas,
            'llegadas_dia' => $llegadas,
            'hombres' => $hom,
            'mujeres' => $muj,
            'ninos' => $nin,
            'camas_disponibles' => $camas,
            'usuario_auditoria' => $usuario,
            'id_usuario_auditoria' => $idusuario,
            'ingresos_compania' => $ingcia,
            'ingresos_agencia' => $ingage,
            'ingresos_grupo' => $inggru,
            'ingresos_individual' => $ingind,
            'huespedes_repetitivos' => $repite,
            'nuevos_huespedes' => $nuevos,
            'huespedes_nacionales' => $nales,
            'huespedes_extranjeros' => $inter,
            'reservas_creadashoy' => $resehoy,
            'reservas_noshows' => $noshow,
            'reservas_canceladas' => $canceladas,
            'salidas_anticipadas' => $saleantes,
            'llegadas_sinreserva' => $sinreserva,
            'llegadas_hombres' => $llegaho,
            'mujeres_llegando' => $llegamu,
            'ninos_llegando' => $llegani,
            'habitaciones_usodia' => $usodiaha,
            'usodia_hombres' => $usodiaho,
            'usodia_mujeres' => $usodiamu,
            'usodia_ninos' => $usodiani,
            'cuentas_congeladas' => $conge,
            'habitaciones_mmto' => $canmmto,
            'salidas_hombres' => $homsal,
            'mujeres_saliendo' => $mujsal,
            'ninos_saliendo' => $ninsal,
            'fecha_proceso_auditoria' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getCamasDisponibles()
    {
        global $database;

        $data = $database->query("SELECT
            sum(habitaciones.camas) as camas
        FROM
            habitaciones
            INNER JOIN
            tipo_habitaciones
            ON 
                habitaciones.id_tipohabitacion = tipo_habitaciones.id
        WHERE
            habitaciones.mantenimiento = 0 AND 
            habitaciones.active_at = 1 AND 
            tipo_habitaciones.tipo_habitacion = 1")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getHuespedesenCasaCierre($cta)
    {
        global $database;

        $data = $database->query("SELECT Sum(reservas_pms.can_hombres) AS hombres, Sum(reservas_pms.can_mujeres) AS mujeres, Sum(reservas_pms.can_ninos) AS ninos FROM reservas_pms WHERE reservas_pms.estado = 'CA' AND reservas_pms.tipo_habitacion <> '$cta'")->fetchAll();

        return $data;
    }

    public function getLlegadaspmDia($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'tipo_habitacion' => 'CMA',
            'fecha_llegada' => $fecha,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getSalidaspmDia($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'tipo_habitacion' => 'CMA',
            'salida_checkout' => $fecha,
            'estado' => 'SA',
        ]);

        return $data;
    }

    public function getLlegadasHabitacionesDia($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'fecha_llegada' => $fecha,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getSalidasHabitacionesDia($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'tipo_habitacion[<>]' => CTA_MASTER,
            'salida_checkout' => $fecha,
        ]);

        return $data;
    }

    public function getHabitacionsBloqueadas($tipo)
    {
        global $database;

        $data = $database->count('habitaciones', [
            'id',
        ], [
            'estado_fo' => $tipo,
            'active_at' => 1,
        ]);

        return $data;
    }

    public function getIngresoAnioGrupo($anio, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND YEAR(cargos_pms.fecha_cargo) = '$anio' AND cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getIngresoAnioHistoricoGrupo($anio, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.monto_cargo) as cargos FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND YEAR(historico_cargos_pms.fecha_cargo) = '$anio' AND historico_cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getIngresoMesGrupo($mes, $anio, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.monto_cargo) as cargos FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND MONTH(cargos_pms.fecha_cargo) = '$mes' AND YEAR(cargos_pms.fecha_cargo) = '$anio' AND cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getIngresoMesHistoricoGrupo($mes, $anio, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.monto_cargo) as cargos FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND MONTH(historico_cargos_pms.fecha_cargo) = '$mes' AND YEAR(historico_cargos_pms.fecha_cargo) = '$anio' AND historico_cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getIngresoDiarioGrupo($fecha, $grupo)
    {
        global $database;

        $data = $database->query("SELECT COALESCE(SUM(cargos_pms.monto_cargo),0) AS cargos, COALESCE(SUM(cargos_pms.impuesto),0) AS impto, COALESCE(SUM(cargos_pms.valor_cargo),0) AS total FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND cargos_pms.fecha_cargo = '$fecha' AND cargos_pms.cargo_anulado = 0")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getIngresoDiarioImptoGrupo($fecha, $grupo)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.impuesto) as impto FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.agrupacion = '$grupo' AND cargos_pms.fecha_cargo = '$fecha' AND cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function getVentasDiaCodigo($fecha, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(impuesto) as imptos, Sum(monto_cargo) as cargos, Sum(pagos_cargos) as pagos FROM cargos_pms WHERE cargo_anulado = 0 AND id_codigo_cargo = '$codi' AND fecha_cargo = '$fecha'")->fetchAll();

        return $data;
    }

    public function getVentasMesCodigo($fecha, $anio, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.cargo_anulado = 0 AND id_codigo_cargo = '$codi' AND MONTH(cargos_pms.fecha_cargo) = '$fecha'")->fetchAll();

        return $data;
    }

    public function getVentasMesCodigoHistorico($mes, $anio, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM historico_cargos_pms WHERE historico_cargos_pms.cargo_anulado = 0 AND id_codigo_cargo = '$codi' AND MONTH(historico_cargos_pms.fecha_cargo) = '$mes' AND YEAR(historico_cargos_pms.fecha_cargo) = '$anio'")->fetchAll();

        return $data;
    }

    public function getVentasAnioCodigo($fecha, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.cargo_anulado = 0 AND cargos_pms.id_codigo_cargo = '$codi' AND YEAR(cargos_pms.fecha_cargo) = '$fecha'")->fetchAll();

        return $data;
    }

    public function getVentasAnioCodigoHistorico($fecha, $codi)
    {
        global $database;

        $data = $database->query("SELECT Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.pagos_cargos) as pagos FROM historico_cargos_pms WHERE historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.id_codigo_cargo = '$codi' AND YEAR(historico_cargos_pms.fecha_cargo) = '$fecha'")->fetchAll();

        return $data;
    }

    public function getBuscaAuditoriaFecha()
    {
        global $database;

        $data = $database->select('auditoria', [
            'titulo_proceso',
            'reporte',
        ], [
            'imprimir' => 1,
            'ORDER' => 'orden_proceso',
        ]);

        return $data;
    }

    public function getCargosAnuladosporFecha($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre_completo',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.fecha_sistema_anula',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.fecha_anulacion' => $fecha,
            'cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getCargosporFecha($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.factura_anulada',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'ORDER' => [
                'fecha_sistema_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function depositosReservas($master)
    {
        global $database;

        $data = $database->query("SELECT huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, reservas_pms.num_reserva, reservas_pms.fecha_llegada, reservas_pms.fecha_salida, reservas_pms.num_habitacion, cargos_pms.fecha_cargo, cargos_pms.descripcion_cargo, cargos_pms.pagos_cargos, cargos_pms.concecutivo_abono, cargos_pms.id_usuario FROM huespedes, reservas_pms, cargos_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.estado = 'ES' AND reservas_pms.num_reserva = cargos_pms.id_reserva AND cargos_pms.cargo_anulado = 0")->fetchAll();

        return $data;
    }

    public function motivoCancelaReserva($id)
    {
        global $database;

        $data = $database->select('motivo_cancelacion', [
            'descripcion_motivo',
        ], [
            'id_cancela' => $id,
        ]);

        return $data[0]['descripcion_motivo'];
    }

    public function getHuespedesenCasaSinReserva($tipo, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'reservas_pms.id',
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_reserva',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.id_compania',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.salida_checkout',
            'reservas_pms.observaciones',
            'reservas_pms.causar_impuesto',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.tipo_reserva' => $tipo,
            'reservas_pms.estado' => $estado,
            'reservas_pms.sinreserva' => 1,
            'ORDER' => 'reservas_pms.num_habitacion',
        ]);

        return $data;
    }

    public function cantidadPM()
    {
        global $database;

        $count = $database->count('habitaciones', [
            'tipo_hab' => CTA_MASTER,
        ], [
            'active_at' => 1,
        ]);

        return $count;
    }

    public function cantidadHabitaciones($tipo)
    {
        global $database;

        $data = $database->select('habitaciones', [
            '[>]tipo_habitaciones' => ['id_tipohabitacion' => 'id'],
        ], [
            'habitaciones.numero_hab',
            'tipo_habitaciones.descripcion_habitacion',
        ], [
            'habitaciones.active_at' => 1,
            'tipo_habitaciones.tipo_habitacion' => $tipo,
        ]);

        return $data;
    }


    public function getBuscaRecibosDia($fecha)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]reservas_pms' => ['numero_reserva' => 'num_reserva'],
        ], [
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.num_reserva',
            'reservas_pms.num_habitacion',
            'huespedes.nombre_completo',
            'cargos_pms.prefijo_factura',
            'cargos_pms.factura_numero',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.pagos_cargos',
            'cargos_pms.id_usuario_factura',
            'cargos_pms.total_consumos',
            'cargos_pms.total_impuesto',
            'cargos_pms.total_pagos',
            'cargos_pms.fecha_cargo',
            'cargos_pms.factura_anulada',
            'cargos_pms.perfil_factura',
            'cargos_pms.id_perfil_factura',
            'cargos_pms.fecha_sistema_cargo',
        ], [
            // 'cargos_pms.fecha_cargo' => $fecha,
            'reservas_pms.num_habitacion[!]' => 9600,
            'cargos_pms.concecutivo_abono[>]' => 0,
            'cargos_pms.factura' => 0,
            'ORDER' => ['cargos_pms.concecutivo_abono'],
        ]);

        return $data;
    }


    public function getBuscaFacturasDia($fecha)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]datosFE' => ['factura_numero' => 'facturaNumero'],
            '[>]huespedes' => 'id_huesped',
            '[>]reservas_pms' => ['numero_reserva' => 'num_reserva'],
        ], [
            'datosFE.estadoEnvio',
            'datosFE.cufe',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.num_reserva',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.nombre_completo',
            'huespedes.email',
            'cargos_pms.prefijo_factura',
            'cargos_pms.factura_numero',
            'cargos_pms.id_usuario_factura',
            'cargos_pms.total_consumos',
            'cargos_pms.total_impuesto',
            'cargos_pms.total_pagos',
            'cargos_pms.fecha_factura',
            'cargos_pms.factura_anulada',
            'cargos_pms.perfil_factura',
            'cargos_pms.tipo_factura',
            'cargos_pms.id_perfil_factura',
            'cargos_pms.numero_factura_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.correo',
        ], [
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.factura' => 1,
            'ORDER' => ['cargos_pms.factura_numero'],
        ]);

        return $data;
    }

    public function getBuscaFacturasFecha($fecha, $rese, $cargo)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]historico_reservas_pms' => ['numero_reserva' => 'num_reserva'],
        ], [
            'historico_reservas_pms.fecha_llegada',
            'historico_reservas_pms.fecha_salida',
            'historico_reservas_pms.num_reserva',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'historico_cargos_pms.factura_numero',
            'historico_cargos_pms.id_usuario_factura',
            'historico_cargos_pms.total_consumos',
            'historico_cargos_pms.total_impuesto',
            'historico_cargos_pms.total_pagos',
            'historico_cargos_pms.fecha_factura',
            'historico_cargos_pms.factura_anulada',
            'historico_cargos_pms.fecha_sistema_cargo',
        ], [
            'historico_cargos_pms.fecha_cargo' => $fecha,
            'historico_cargos_pms.factura' => 1,
            'ORDER' => ['historico_cargos_pms.factura_numero'],
        ]);

        return $data;
    }

    public function cierreDiarioCajero($user)
    {
        global $database;

        $data = $database->update('usuarios', [
            'estado_usuario_pms' => 2,
        ], [
            'usuario' => $user,
        ]);

        return $data->rowCount();
    }

    public function formaPago($id)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'descripcion_cargo',
        ], [
            'id_cargo' => $id,
        ]);
        if (count($data) == 0) {
            return 'SIN FORMA DE PAGO DEFINIDO';
        } else {
            return $data[0]['descripcion_cargo'];
        }
    }

    public function motivoViaje($id)
    {
        global $database;

        $data = $database->select('grupos_cajas', [
            'descripcion_grupo',
        ], [
            'id_grupo' => $id,
        ]);
        if (count($data) == 0) {
            return 'SIN MOTIVO DE VIAJE DEFINIDO';
        } else {
            return $data[0]['descripcion_grupo'];
        }
    }

    public function getCityExp($idcity)
    {
        global $database;

        $data = $database->select('ciudades', [
            'municipio',
            'depto',
        ], [
            'id_ciudad' => $idcity,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['municipio'] . ' ' . $data[0]['depto'];
        }
    }

    public function getLandGuest($idland)
    {
        global $database;

        $data = $database->select('paices', [
            'descripcion',
        ], [
            'id_pais' => $idland,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion'];
        }
    }

    public function creaHuespedAdicional($apellido1, $apellido2, $nombre1, $nombre2, $identificacion, $tipoiden, $sexo, $fechanace, $nacion, $ciudad, $usuario, $idusuario, $correo)
    {
        global $database;

        $data = $database->insert('huespedes', [
            'identificacion' => $identificacion,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'nombre1' => $nombre1,
            'nombre2' => $nombre2,
            'tipo_identifica' => $tipoiden,
            'sexo' => $sexo,
            'tipo_huesped' => 1,
            'fecha_nacimiento' => $fechanace,
            'pais' => $nacion,
            'ciudad' => $ciudad,
            'usuario_creador' => $usuario,
            'id_usuario' => $idusuario,
            'nombre_completo' => $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2,
            'email' => $correo,
            'fecha_creacion' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function adicionaHuespedAdicional($reserva, $huesped)
    {
        global $database;

        $data = $database->insert('acompanantes', [
            'id_reserva' => $reserva,
            'id_huesped' => $huesped,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function buscaHuespedAcompanante($id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'tipo_identifica',
            'identificacion',
            'lugar_expedicion',
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'fecha_nacimiento',
            'sexo',
            'pais',
            'ciudad',
        ], [
            'identificacion' => $id,
        ]);

        return $data;
    }

    public function eliminaAcompanante($id)
    {
        global $database;

        $data = $database->delete('acompanantes', [
            'id' => $id,
        ]);

        return $data;
    }

    public function getBuscarAcompanantesHistoricoReserva($idreser)
    {
        global $database;

        $data = $database->select('acompanantes', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'acompanantes.id',
            'huespedes.id_huesped',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre_completo',
            'huespedes.identificacion',
            'huespedes.tipo_identifica',
            'huespedes.lugar_expedicion',
            'huespedes.pais',
            'huespedes.sexo',
        ], [
            'acompanantes.id_reserva' => $idreser,
        ]);

        return $data;
    }

    public function getBuscarAcompanantesReserva($idreser)
    {
        global $database;

        $data = $database->select('acompanantes', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'acompanantes.id',
            'huespedes.id_huesped',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre_completo',
            'huespedes.identificacion',
            'huespedes.tipo_identifica',
            'huespedes.lugar_expedicion',
            'huespedes.pais',
            'huespedes.pais_expedicion',
            'huespedes.ciudad_expedicion',
            'huespedes.sexo',
        ], [
            'acompanantes.id_reserva' => $idreser,
        ]);

        return $data;
    }

    public function trasladaCargoHabitacion($idconsumo, $idreserva, $idhuesped, $newreserva, $motivotras, $usuario)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'id_reserva' => $idreserva,
            'cargo_trasladado' => 1,
            'usuario_traslado' => $usuario,
            'fecha_traslado' => FECHA_PMS,
            'motivo_traslado' => $motivotras,
            'numero_reserva' => $newreserva,
        ], [
            'id_cargo' => $idconsumo,
        ]);

        return $data->rowCount();
    }

    public function updateAnulaSalida($numero, $usuario, $idusuario)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'estado' => 'CA',
            'tipo_reserva' => 2,
            'usuario_ingreso' => $usuario,
            'id_usuario_ingreso' => $idusuario,
            // 'hora_llegada' => date('H:i:s'),
            // 'fecha_ingreso' => date('Y-m-d H:i:s'),
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getReservasporTipoHabSalida($tipo, $llega, $sale, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'num_habitacion',
            'fecha_llegada',
            'fecha_salida',
        ], [
            'fecha_llegada[>=]' => $llega,
            'fecha_salida[<=]' => $sale,
            'tipo_habitacion' => $tipo,
            'estado' => $estado,
        ]);

        return $data;
    }

    public function getReservasporTipoHab($tipo, $llega, $sale, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'num_habitacion',
            'fecha_llegada',
            'fecha_salida',
            'estado',
        ], [
            'fecha_salida[>=]' => $llega,
            'fecha_salida[<]' => $sale,
            'tipo_habitacion' => $tipo,
            'estado' => $estado,

        ]);

        return $data;
    }

    public function traeEstadoHabitacionesHotel($tipo, $llega, $sale)
    {
        global $database;

        $data = $database->query("SELECT num_habitacion, fecha_llegada, fecha_salida, estado FROM reservas_pms WHERE (estado = 'CA'  OR estado = 'ES') AND tipo_habitacion = '$tipo' AND fecha_llegada <= '$llega' and fecha_salida >= '$sale' order BY num_habitacion")->fetchAll();
        return $data;
    }

    public function getEnCasaporTipoHab($tipo, $llega, $sale, $estado)
    {
        global $database;

        $data = $database->query("SELECT num_habitacion, fecha_llegada, fecha_salida, estado FROM reservas_pms WHERE estado = 'CA' AND tipo_habitacion = '$tipo' AND fecha_llegada <= '$llega' AND fecha_salida > '$sale' ORDER BY num_habitacion")->fetchAll();

        return $data;
    }

    public function getSaleMananaTipoHab($tipo, $llega, $sale, $estado)
    {
        global $database;

        $data = $database->query("SELECT num_habitacion, fecha_llegada, fecha_salida, estado FROM reservas_pms WHERE (estado = 'CA' OR estado = 'ES') AND tipo_habitacion = '$tipo' AND fecha_salida = '$llega' ORDER BY num_habitacion")->fetchAll();

        return $data;
    }

    public function cargosDelDia($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.id_codigo_cargo, codigos_vta.descripcion_cargo FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.fecha_cargo = '$fecha' AND cargos_pms.cargo_anulado = 0 AND codigos_vta.tipo_codigo = '$tipo' GROUP BY codigos_vta.descripcion_cargo ORDER BY codigos_vta.descripcion_cargo")->fetchAll();

        return $data;
    }

    public function getCargosdelDiaporCodigo($fecha, $codigo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.nombre_completo',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.numero_reserva',
        ], [
            'cargos_pms.id_codigo_cargo' => $codigo,
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.cargo_anulado' => 0,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function updateCiaReserva($idcia, $idcentro, $idrese)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'id_compania' => $idcia,
            'idCentroCia' => $idcentro,
        ], [
            'num_reserva' => $idrese,
        ]);

        return $data->rowCount();
    }

    public function cambiaEstadoHabitacion($habita, $estado)
    {
        global $database;

        $data = $database->update('habitaciones', [
            'sucia' => $estado,
        ], [
            'numero_hab' => $habita,
        ]);

        return $data->rowCount();
    }

    public function cambiaOcupacionHabitacion($habita, $estado)
    {
        global $database;

        $data = $database->update('habitaciones', [
            'ocupada' => $estado,
        ], [
            'numero_hab' => $habita,
        ]);

        return $data->rowCount();
    }


    public function getDataUser($user)
    {
        global $database;

        $data = $database->select('usuarios', [
            'apellidos',
            'nombres',
        ], [
            'usuario' => $user,
        ]);

        return $data;
    }

    public function getReservasCreadasHoy($fecha, $tipo)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.tipo_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.id_compania',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.observaciones',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.fecha_reserva' => $fecha,
            'reservas_pms.tipo_reserva' => $tipo,
        ]);

        return $data;
    }

    public function getUsuarios()
    {
        global $database;

        $data = $database->select('usuarios', [
            'nombres',
            'apellidos',
            'usuario',
        ], [
            'estado' => '1',
            'ORDER' => ['usuario' => 'ASC'],
        ]);

        return $data;
    }

    public function habitacionesDisponibles($cuenta)
    {
        global $database;

        $data = $database->query("SELECT COUNT(id) as rooms FROM habitaciones WHERE id_tipohabitacion <> '$cuenta' AND active_at = 1")->fetchAll();

        return $data[0]['rooms'];
    }

    public function updateAnulaIngreso($numero, $usuario, $idusuario)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'estado' => 'ES',
            'tipo_reserva' => 1,
            'usuario_ingreso' => $usuario,
            'id_usuario_ingreso' => $idusuario,
            // 'hora_llegada' => date('H:i:s'),
            // 'fecha_ingreso' => date('Y-m-d H:i:s'),
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getCargosporReserva($reserva)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.numero_reserva' => $reserva,
            'cargos_pms.cargo_anulado' => 0,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getCargosdelDiaporReserva($fecha, $reserva)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.numero_reserva' => $reserva,
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.cargo_anulado' => 0,
            'cargos_pms.tipo_factura' => 0,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function borraHistoricoCargos()
    {
        global $database;

        $data = $database->delete('cargos_pms', [
            'AND' => [
                'factura_numero[>]' => 0,
            ],
        ]);

        return $data;
    }

    public function enviaHistoricoFE()
    {
        global $database;

        $data = $database->query('INSERT INTO historicoDatosFE SELECT * FROM datosFE WHERE facturaNumero != 0')->fetchAll();

        return $data;
    }

    public function borraHistoricoFE()
    {
        global $database;

        $data = $database->delete('datosFE', [
            'AND' => [
                'facturaNumero[>]' => 0,
            ],
        ]);

        return $data;
    }

    public function enviaHistoricoCargos()
    {
        global $database;

        $data = $database->query('INSERT INTO historico_cargos_pms SELECT * FROM cargos_pms WHERE factura_numero != 0')->fetchAll();

        return $data;
    }

    public function borraHistoricoSalidas($fecha, $tipo)
    {
        global $database;

        $data = $database->delete('reservas_pms', [
            'AND' => [
                'estado' => $tipo,
            ],
        ]);

        return $data;
    }

    public function enviaHistoricoSalidas($fecha, $tipo)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_reservas_pms SELECT * FROM reservas_pms WHERE estado = '$tipo'")->fetchAll();

        return $data;
    }

    public function cambiaEstadoHistorico($fecha, $tipo)
    {
        global $database;

        $data = $database->update('historico_reservas_pms', [
            'estado' => 'NS',
        ], [
            'fecha_llegada' => $fecha,
            'estado' => $tipo,
        ]);

        return $data;
    }

    public function borraEnviadasaHistorico($fecha, $tipo)
    {
        global $database;

        $data = $database->delete('reservas_pms', [
            'AND' => [
                'fecha_llegada' => $fecha,
                'estado' => $tipo,
            ],
        ]);

        return $data;
    }

    public function borraCanceladasHistorico($tipo)
    {
        global $database;

        $data = $database->delete('reservas_pms', [
            'AND' => [
                'estado' => $tipo,
            ],
        ]);

        return $data;
    }

    public function enviaHistoricoCanceladas($tipo)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_reservas_pms SELECT * FROM reservas_pms WHERE estado = '$tipo'")->fetchAll();

        return $data;
    }

    public function enviaHistoricoEstadias($fecha, $tipo)
    {
        global $database;

        $data = $database->query("INSERT INTO historico_reservas_pms SELECT * FROM reservas_pms WHERE estado = '$tipo' AND fecha_llegada = '$fecha'")->fetchAll();

        return $data;
    }

    public function getBuscarHuespedReserva($buscar)
    {
        global $database;

        $data = $database->query("SELECT huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.email, huespedes.identificacion, huespedes.id_huesped FROM huespedes WHERE identificacion LIKE '%$buscar%' OR nombre_completo LIKE '%$buscar%' order by huespedes.apellido1")->fetchAll();

        return $data;
    }

    public function getCargosAnuladosdelDiaporcajero($fecha, $usuario, $tipo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre_completo',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.fecha_sistema_anula',
            'cargos_pms.factura_numero',
        ], [
            'cargos_pms.fecha_anulacion' => $fecha,
            'cargos_pms.usuario_anulacion' => $usuario,
            'cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getCargosDia($fecha, $tipo)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.descripcion_cargo, count(cargos_pms.monto_cargo) as canti, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, sum(cargos_pms.monto_cargo+cargos_pms.impuesto) as total_cargo, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms , codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.cargo_anulado = 0 AND codigos_vta.tipo_codigo = '$tipo' AND cargos_pms.fecha_cargo = '$fecha' GROUP BY cargos_pms.descripcion_cargo ORDER BY cargos_pms.descripcion_cargo ASC")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getBalanceSaldoAnterior($fecha)
    {
        global $database;

        $data = $database->query("SELECT
            COALESCE (Sum( cargos_pms.monto_cargo ),0) AS saldo_viene,
            COALESCE (Sum( cargos_pms.impuesto ),0) AS impto_viene,
            COALESCE (Sum( cargos_pms.pagos_cargos ),0) AS pagos_viene,
            COALESCE (Sum( cargos_pms.monto_cargo + cargos_pms.impuesto - cargos_pms.pagos_cargos ),0) AS total_viene 
        FROM
            cargos_pms,
            reservas_pms 
        WHERE
            cargos_pms.numero_reserva = reservas_pms.num_reserva 
            AND reservas_pms.tipo_reserva = 2 
            AND cargos_pms.fecha_cargo < '$fecha' 
            AND cargos_pms.cargo_anulado = 0 ")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getBalanceSaldodelDia($fecha)
    {
        global $database;

        $data = $database->query("SELECT Sum(cargos_pms.monto_cargo) AS saldo_viene, Sum(cargos_pms.impuesto) AS impto_viene, Sum(cargos_pms.pagos_cargos) AS pagos_viene, Sum(cargos_pms.monto_cargo + cargos_pms.impuesto - cargos_pms.pagos_cargos) AS total_viene FROM cargos_pms , reservas_pms WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND reservas_pms.tipo_reserva = 2 AND cargos_pms.fecha_cargo = '$fecha' AND cargos_pms.cargo_anulado = 0 AND reservas_pms.cargo_habitacion < '9450'")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function cambiaFechaAuditoria($fecha)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'fecha_auditoria' => $fecha,
        ]);

        return $data->rowCount();
    }

    public function limpiaProcesosAuditoria()
    {
        global $database;

        $data = $database->update('auditoria', [
            'estado_proceso' => 0,
        ]);

        return $data;
    }

    public function getExtranjerosSaliendo($pais, $fecha, $estado)
    {
        global $database;

        $data = $database->query("SELECT huespedes.identificacion, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.direccion, huespedes.email, huespedes.pais, huespedes.tipo_identifica, huespedes.sexo, reservas_pms.fecha_llegada, reservas_pms.fecha_salida, reservas_pms.salida_checkout, reservas_pms.dias_reservados, reservas_pms.num_habitacion, reservas_pms.tarifa, reservas_pms.tipo_habitacion, reservas_pms.can_hombres, reservas_pms.can_mujeres, reservas_pms.can_ninos, reservas_pms.valor_diario FROM huespedes, reservas_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.estado = '$estado' AND reservas_pms.salida_checkout = '$fecha' AND huespedes.pais <> '$pais'")->fetchAll();

        return $data;
    }

    public function buscaNacionalidad($pais)
    {
        global $database;

        $data = $database->select('paices', [
            'descripcion',
        ], [
            'id_pais' => $pais,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion'];
        }
    }

    public function getExtranjerosenCasa($pais, $fecha, $estado)
    {
        global $database;

        $data = $database->query("SELECT huespedes.identificacion, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.direccion, huespedes.email, huespedes.pais, huespedes.tipo_identifica, huespedes.sexo, reservas_pms.fecha_llegada, reservas_pms.fecha_salida, reservas_pms.dias_reservados, reservas_pms.num_habitacion, reservas_pms.tarifa, reservas_pms.tipo_habitacion, reservas_pms.can_hombres, reservas_pms.can_mujeres, reservas_pms.can_ninos, reservas_pms.valor_diario FROM huespedes, reservas_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.estado = '$estado' AND reservas_pms.fecha_llegada = '$fecha' AND huespedes.pais <> '$pais'")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }


    public function getExtranjerosLlegando($pais, $fecha)
    {
        global $database;

        $data = $database->query("SELECT huespedes.identificacion, huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre2, huespedes.direccion, huespedes.email, huespedes.pais, huespedes.tipo_identifica, huespedes.sexo, reservas_pms.fecha_llegada, reservas_pms.fecha_salida, reservas_pms.dias_reservados, reservas_pms.num_habitacion, reservas_pms.tarifa, reservas_pms.tipo_habitacion, reservas_pms.can_hombres, reservas_pms.can_mujeres, reservas_pms.can_ninos, reservas_pms.valor_diario FROM huespedes, reservas_pms WHERE huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.estado = 'CA' AND reservas_pms.fecha_llegada = '$fecha' AND huespedes.pais <> '$pais'")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function updateEstadia($impto, $salida, $noches, $numero, $motivo, $fuente, $segmento, $formapa, $orden, $placa)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'causar_impuesto' => $impto,
            'fecha_salida' => $salida,
            'dias_reservados' => $noches,
            'motivo_viaje' => $motivo,
            'fuente_reserva' => $fuente,
            'segmento_mercado' => $segmento,
            'forma_pago' => $formapa,
            'orden_reserva' => $orden,
            'placaVehiculo' => $placa,
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function EstadoAuditoriaPMS($tipo)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'proceso_auditoria' => $tipo,
        ]);

        return $data->rowCount();
    }

    public function limpiaCargoHabitaciones()
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'cargo_habitacion' => 0,
        ], [
            'cargo_habitacion' => 1,
        ]);

        return $data->rowCount();
    }

    public function getHistoricoCargosUsuarios($fecha, $tipo)
    {
        global $database;

        $data = $database->query("SELECT DISTINCT historico_cargos_pms.id_usuario, usuarios.apellidos, usuarios.nombres FROM historico_cargos_pms, usuarios, codigos_vta WHERE historico_cargos_pms.id_usuario = usuarios.usuario_id AND historico_cargos_pms.fecha_cargo = '$fecha' AND historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.tipo_codigo = '$tipo' ORDER BY usuarios.usuario")->fetchAll();

        return $data;
    }

    public function getHistoricoCargosdelDiaporcajero($fecha, $usuario, $tipo, $estado)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'historico_cargos_pms.fecha_cargo',
            'historico_cargos_pms.monto_cargo',
            'historico_cargos_pms.base_impuesto',
            'historico_cargos_pms.impuesto',
            'historico_cargos_pms.codigo_impto',
            'historico_cargos_pms.id_codigo_cargo',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.descripcion_cargo',
            'historico_cargos_pms.usuario',
            'historico_cargos_pms.id_usuario',
            'historico_cargos_pms.id_huesped',
            'historico_cargos_pms.cantidad_cargo',
            'historico_cargos_pms.informacion_cargo',
            'historico_cargos_pms.valor_cargo',
            'historico_cargos_pms.folio_cargo',
            'historico_cargos_pms.pagos_cargos',
            'historico_cargos_pms.referencia_cargo',
            'historico_cargos_pms.concecutivo_abono',
            'historico_cargos_pms.cargo_anulado',
            'historico_cargos_pms.motivo_anulacion',
            'historico_cargos_pms.fecha_anulacion',
            'historico_cargos_pms.usuario_anulacion',
            'historico_cargos_pms.numero_reserva',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.fecha_sistema_cargo',
            'historico_cargos_pms.factura_numero',
            'historico_cargos_pms.id_reserva',
        ], [
            'historico_cargos_pms.fecha_cargo' => $fecha,
            'historico_cargos_pms.id_usuario' => $usuario,
            'historico_cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getHistoricoCargosAnuladosdelDiaporcajero($fecha, $usuario, $tipo, $estado)
    {
        global $database;

        $data = $database->select('historico_cargos_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'historico_cargos_pms.fecha_cargo',
            'historico_cargos_pms.monto_cargo',
            'historico_cargos_pms.base_impuesto',
            'historico_cargos_pms.impuesto',
            'historico_cargos_pms.codigo_impto',
            'historico_cargos_pms.id_codigo_cargo',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.descripcion_cargo',
            'historico_cargos_pms.id_usuario',
            'historico_cargos_pms.usuario',
            'historico_cargos_pms.id_huesped',
            'historico_cargos_pms.cantidad_cargo',
            'historico_cargos_pms.informacion_cargo',
            'historico_cargos_pms.valor_cargo',
            'historico_cargos_pms.folio_cargo',
            'historico_cargos_pms.pagos_cargos',
            'historico_cargos_pms.referencia_cargo',
            'historico_cargos_pms.concecutivo_abono',
            'historico_cargos_pms.cargo_anulado',
            'historico_cargos_pms.motivo_anulacion',
            'historico_cargos_pms.fecha_anulacion',
            'historico_cargos_pms.usuario_anulacion',
            'historico_cargos_pms.numero_reserva',
            'historico_cargos_pms.habitacion_cargo',
            'historico_cargos_pms.fecha_sistema_cargo',
            'historico_cargos_pms.factura_numero',
        ], [
            'historico_cargos_pms.fecha_anulacion' => $fecha,
            'historico_cargos_pms.id_usuario_anulacion' => $usuario,
            'historico_cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'ORDER' => [
                'habitacion_cargo' => 'ASC',
            ],
        ]);

        return $data;
    }

    public function getUsuariosCargos($fecha, $tipo)
    {
        global $database;

        $data = $database->query("SELECT DISTINCT cargos_pms.id_usuario, usuarios.apellidos, usuarios.nombres, usuarios.usuario FROM cargos_pms, usuarios, codigos_vta WHERE cargos_pms.id_usuario = usuarios.usuario_id AND cargos_pms.fecha_cargo = '$fecha' AND cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND codigos_vta.tipo_codigo = '$tipo' ORDER BY usuarios.usuario")->fetchAll();

        return $data;
    }

    public function getCargosdelDiaporcajero($fecha, $usuario, $tipo, $estado)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]huespedes' => ['id_huesped' => 'id_huesped'],
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.base_impuesto',
            'cargos_pms.impuesto',
            'cargos_pms.codigo_impto',
            'cargos_pms.id_codigo_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.cargo_anulado',
            'cargos_pms.motivo_anulacion',
            'cargos_pms.fecha_anulacion',
            'cargos_pms.usuario_anulacion',
            'cargos_pms.numero_reserva',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'cargos_pms.factura_numero',
            'cargos_pms.id_reserva',
        ], [
            'cargos_pms.fecha_cargo' => $fecha,
            'cargos_pms.usuario' => $usuario,
            'cargos_pms.cargo_anulado' => $estado,
            'codigos_vta.tipo_codigo' => $tipo,
            'cargos_pms.concecutivo_abono' => 0,
            'ORDER' => ['cargos_pms.habitacion_cargo' => 'ASC']
        ]);

        return $data;
    }

    public function updateProcesoAuditoria($id, $estado)
    {
        global $database;

        $data = $database->update('auditoria', [
            'estado_proceso' => $estado,
        ], [
            'id_proceso' => $id,
        ]);

        return $data;
    }

    public function getProcesoAuditoria()
    {
        global $database;

        $data = $database->select('auditoria', [
            'id_proceso',
            'titulo_proceso',
            'estado_proceso',
            'nombre_proceso',
            'tipo_proceso',
            'reporte',
        ], [
            'actived_at' => 1,
            'ORDER' => ['orden_proceso' => 'ASC'],
        ]);

        return $data;
    }

    public function actualizaNumeroFolio($folio, $id)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'folio_cargo' => $folio,
        ], [
            'id_cargo' => $id,
        ]);

        return $data->rowCount();
    }

    public function movimientoTotalDia($fecha)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargosDia, sum(cargos_pms.impuesto) as imptosDia, sum(cargos_pms.pagos_cargos) as pagosDia FROM cargos_pms WHERE cargos_pms.fecha_cargo = '$fecha' AND cargos_pms.cargo_anulado = 0 GROUP BY cargos_pms.fecha_cargo")->fetchAll();
        if (count($data) == 0) {
            return 0;
        } else {
            return $data;
        }
    }

    public function updateEstadoHabitacion($room)
    {
        global $database;

        $data = $database->update('habitaciones', [
            'sucia' => 1,
            'ocupada' => 0,
        ], [
            'numero_hab' => $room,
        ]);

        return $data->rowCount();
    }

    public function getSaldoHabitacion($reserva)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.numero_reserva = '$reserva' and cargos_pms.cargo_anulado = 0 AND factura_numero = 0 GROUP BY cargos_pms.numero_reserva")->fetchAll();

        return $data;
    }

    public function saldoFolio($reserva, $folio)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo+cargos_pms.impuesto) as saldoFol FROM cargos_pms WHERE cargos_pms.numero_reserva = '$reserva' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.folio_cargo = '$folio' AND factura_numero = 0 GROUP BY cargos_pms.numero_reserva, cargos_pms.folio_cargo")->fetchAll();
        if (count($data) == 0) {
            return 0;
        } else {
            return $data[0]['saldoFol'];
        }
    }

    public function pagosFolio($reserva, $folio)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.pagos_cargos) as saldoFol FROM cargos_pms WHERE cargos_pms.numero_reserva = '$reserva' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.folio_cargo = '$folio' AND factura_numero = 0 GROUP BY cargos_pms.numero_reserva")->fetchAll();
        if (count($data) == 0) {
            return 0;
        } else {
            return $data[0]['saldoFol'];
        }
    }

    public function cambiaTarifaHabitacion($id, $tipo, $habi)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'valor_diario' => $habi,
            'tarifa' => $tipo,
        ], [
            'num_reserva' => $id,
        ]);

        return $data->rowCount();
    }

    public function updateMmtoRoom($habi, $mmto)
    {
        global $database;

        $data = $database->update('habitaciones', [
            'estado' => $mmto,
            'estado_fo' => 'FS',
            'estado_hk' => 'FS',
        ], [
            'numero_hab' => $habi,
        ]);

        return $data->rowCount();
    }

    public function insertCambioHabitaciones($id, $tipoact, $habiact, $tiponue, $habinue, $mmto, $motivo, $observa, $fecha, $tipo, $idUsuario)
    {
        global $database;

        $data = $database->insert('traslado_habitaciones', [
            'tipo_desde' => $tipoact,
            'tipo_hasta' => $tiponue,
            'hab_desde' => $habiact,
            'hab_hasta' => $habinue,
            'fecha' => $fecha,
            'id_reserva' => $id,
            'motivo_cambio' => $motivo,
            'observaciones' => $observa,
            'tipo_traslado' => $tipo,
            'id_usuario' => $idUsuario,
        ]);

        return $database->id();
    }

    public function cambiaHabitacion($id, $tipo, $habi)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'num_habitacion' => $habi,
            'tipo_habitacion' => $tipo,
        ], [
            'num_reserva' => $id,
        ]);

        return $data->rowCount();
    }

    public function updateReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $numero, $observa, $formapa, $impto, $empresa)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'fecha_llegada' => $llegada,
            'fecha_salida' => $salida,
            'dias_reservados' => $noches,
            'can_hombres' => $hombres,
            'can_mujeres' => $mujeres,
            'can_ninos' => $ninos,
            'orden_reserva' => $orden,
            'tipo_habitacion' => $tipohabi,
            'num_habitacion' => $nrohabitacion,
            'tarifa' => $tarifahab,
            'valor_reserva' => ($valortarifa * $noches),
            'valor_diario' => $valortarifa,
            'origen_reserva' => $origen,
            'destino_reserva' => $destino,
            'motivo_viaje' => $motivo,
            'fuente_reserva' => $fuente,
            'segmento_mercado' => $segmento,
            'observaciones' => $observa,
            'forma_pago' => $formapa,
            'causar_impuesto' => $impto,
            'id_compania' => $empresa,
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getBuscaReserva($id)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.id_huesped',
            'huespedes.nombre_completo',
            'reservas_pms.cantidad',
            'reservas_pms.dias_reservados',
            'reservas_pms.estado',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.tipo_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.origen_reserva',
            'reservas_pms.destino_reserva',
            'reservas_pms.id_agencia',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.id_huesped',
            'reservas_pms.tarifa',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tipo_reserva',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.motivo_viaje',
            'reservas_pms.fecha_reserva',
            'reservas_pms.fecha_ingreso',
            'reservas_pms.usuario',
            'reservas_pms.observaciones',
            'reservas_pms.fuente_reserva',
            'reservas_pms.segmento_mercado',
            'reservas_pms.cargo_habitacion',
            'reservas_pms.causar_impuesto',
            'reservas_pms.forma_pago',
            'reservas_pms.reservaCreada',
            'reservas_pms.placaVehiculo',
            'reservas_pms.equipaje',
            'reservas_pms.tipoTransporte',

        ], [
            'reservas_pms.num_reserva' => $id,
        ]);

        return $data;
    }

    public function getHistoricoReservasCia($id)
    {
        global $database;

        $data = $database->select('historico_reservas_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]tipo_habitaciones' => ['tipo_habitacion' => 'id'],
        ], [
            'huespedes.id_huesped',
            'huespedes.nombre_completo',
            'tipo_habitaciones.descripcion_habitacion',
            'historico_reservas_pms.dias_reservados',
            'historico_reservas_pms.estado',
            'historico_reservas_pms.fecha_llegada',
            'historico_reservas_pms.fecha_salida',
            'historico_reservas_pms.salida_checkout',
            'historico_reservas_pms.tipo_reserva',
            'historico_reservas_pms.num_habitacion',
            'historico_reservas_pms.num_reserva',
            'historico_reservas_pms.num_registro',
            'historico_reservas_pms.orden_reserva',
            'historico_reservas_pms.tarifa',
            'historico_reservas_pms.valor_diario',
            'historico_reservas_pms.observaciones',
            'historico_reservas_pms.can_hombres',
            'historico_reservas_pms.can_mujeres',
            'historico_reservas_pms.can_ninos',
            'historico_reservas_pms.id_huesped',
            'historico_reservas_pms.tipo_habitacion',
        ], [
            'historico_reservas_pms.id_compania' => $id,
            'ORDER' => 'historico_reservas_pms.fecha_llegada',
        ]);

        return $data;
    }

    public function getReservasEsperadasCia($id)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]tipo_habitaciones' => ['tipo_habitacion' => 'id'],
        ], [
            'huespedes.id_huesped',
            'huespedes.nombre_completo',
            'tipo_habitaciones.descripcion_habitacion',
            'reservas_pms.dias_reservados',
            'reservas_pms.estado',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.tipo_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_huesped',
            'reservas_pms.tarifa',
        ], [
            'reservas_pms.id_compania' => $id,
        ]);

        return $data;
    }

    public function getHuespedesCia($id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'nombre_completo',
            'identificacion',
            'direccion',
            'telefono',
            'email',
            'tipo_identifica',
            'tipo_huesped',
            'fecha_nacimiento',
            'sexo',
            'celular',
            'id_compania',
            'estado_credito',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function getContactosCia($id)
    {
        global $database;

        $data = $database->select('contactos_compania', [
            'id_contacto',
            'apellidos',
            'nombres',
            'identificacion',
            'cargo',
            'area',
            'celular',
            'telefono',
            'extencion',
            'email',
        ], [
            'id_compania' => $id,
            'actived_at' => 1,
        ]);

        return $data;
    }

    public function updateCompania($id, $nit, $dv, $tipodoc, $compania, $direccion, $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $credito, $monto, $diascre, $diacorte, $tipoemp, $codciiu, $tipoAdqui, $tipoRespo, $repoTribu, $reteIva, $reteIca, $reteFte, $baseRete)
    {
        global $database;

        $data = $database->update('companias', [
            'empresa' => $compania,
            'direccion' => $direccion,
            'nit' => $nit,
            'dv' => $dv,
            'tipo_documento' => $tipodoc,
            'telefono' => $telefono,
            'celular' => $celular,
            'email' => $correo,
            'web' => $web,
            'ciudad' => $ciudad,
            'credito' => $credito,
            'monto_credito' => $monto,
            'dias_credito' => $diascre,
            'id_forma_pago' => $formapago,
            'dia_corte_credito' => $diacorte,
            'id_tarifa' => $tarifa,
            'tipo_empresa' => $tipoemp,
            'reteiva' => $reteIva,
            'reteica' => $reteIca,
            'retefuente' => $reteFte,
            'sinBaseRete' => $baseRete,
            'updated_at' => date('Y-m-d H:i:s'),
            'id_codigo_ciiu' => $codciiu,
            'tipoAdquiriente' => $tipoAdqui,
            'tipoResponsabilidad' => $tipoRespo,
            'responsabilidadTributaria' => $repoTribu,
        ], [
            'id_compania' => $id,
        ]);

        // return $data->rowCount();
        $result = [
            'id' => $data->rowCount(),
            'error' => $database->error,
        ];

        return $result;
    }

    public function getBuscaIdEmpresa($id)
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'direccion',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'email',
            'web',
            'ciudad',
            'tipo_empresa',
            'estado_credito',
            'credito',
            'monto_credito',
            'dia_corte_credito',
            'dias_credito',
            'id_tarifa',
            'id_forma_pago',
            'id_codigo_ciiu',
            'usuario',
            'reteiva',
            'reteica',
            'retefuente',
            'sinBaseRete',
            'tipo_compania',
            'tipoAdquiriente',
            'tipoResponsabilidad',
            'responsabilidadTributaria',
            'created_at',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function updateHuesped($id, $iden, $tipodoc, $apellido1, $apellido2, $nombre1, $nombre2, $sexo, $direccion, $telefono, $celular, $correo, $fechanace, $pais, $ciudad, $paisExp, $ciudadExp, $tipoAdqui, $tipoRespo, $repoTribu, $empresa, $profesion, $edad)
    {
        global $database;

        $data = $database->update('huespedes', [
            'nombre1' => $nombre1,
            'nombre2' => $nombre2,
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $correo,
            'identificacion' => $iden,
            'pais_expedicion' => $paisExp,
            'ciudad_expedicion' => $ciudadExp,
            'tipo_identifica' => $tipodoc,
            'fecha_nacimiento' => $fechanace,
            'edad' => $edad,
            'sexo' => $sexo,
            'celular' => $celular,
            'profesion' => $profesion,
            'pais' => $pais,
            'ciudad' => $ciudad,
            'nombre_completo' => $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2,
            'tipoAdquiriente' => $tipoAdqui,
            'tipoResponsabilidad' => $tipoRespo,
            'responsabilidadTributaria' => $repoTribu,
            'id_compania' => $empresa,
        ], [
            'id_huesped' => $id,
        ]);

        $result = [
            'id' => $data->rowCount(),
            'error' => $database->error,
        ];
        return $result;
    }

    public function getBuscaIdHuesped($id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'nombre_completo',
            'identificacion',
            'direccion',
            'telefono',
            'email',
            'tipo_identifica',
            'tipo_huesped',
            'pais_expedicion',
            'ciudad_expedicion',
            'fecha_nacimiento',
            'sexo',
            'celular',
            'id_compania',
            'idCentroCia',
            'id_forma_pago',
            'id_tarifa',
            'estado_credito',
            'pais',
            'ciudad',
            'profesion',
            'id_forma_pago',
            'tipoAdquiriente',
            'tipoResponsabilidad',
            'responsabilidadTributaria',

        ], [
            'id_huesped' => $id,
        ]);

        return $data;
    }

    public function buscaHuespedHueped($ident, $id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'nombre_completo',
            'identificacion',
        ], [
            'identificacion' => $ident,
            'id_huesped[!]' => $id,
        ]);

        return $data;
    }

    public function updateCiaHuesped($idcia, $idhues, $idCentro)
    {
        global $database;

        $data = $database->update('huespedes', [
            'id_compania' => $idcia,
            'idCentroCia' => $idCentro,
        ], [
            'id_huesped' => $idhues,
        ]);

        return $data->rowCount();
    }

    public function getBuscaCentroCia($id)
    {
        global $database;

        $data = $database->select('centrosCias', [
            'descripcion_centro',
            'id_centro',
        ], [
            'id_centro' => $id,
        ]);

        return $data;
    }

    public function getReservasEsperadas($id)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]tipo_habitaciones' => ['tipo_habitacion' => 'id'],
        ], [
            'tipo_habitaciones.descripcion_habitacion',
            'reservas_pms.id',
            'reservas_pms.cantidad',
            'reservas_pms.dias_reservados',
            'reservas_pms.estado',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.tipo_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.num_registro',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.origen_reserva',
            'reservas_pms.destino_reserva',
            'reservas_pms.id_agencia',
            'reservas_pms.id_compania',
            'reservas_pms.id_huesped',
            'reservas_pms.tarifa',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.motivo_viaje',
            'reservas_pms.fecha_reserva',
            'reservas_pms.usuario',
            'reservas_pms.observaciones',
            'reservas_pms.fuente_reserva',
            'reservas_pms.causar_impuesto',
            'reservas_pms.cargo_habitacion',
        ], [
            'id_huesped' => $id,
        ]);

        return $data;
    }

    public function getHistoricoReservas($id)
    {
        global $database;

        $data = $database->select('historico_reservas_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]tipo_habitaciones' => ['tipo_habitacion' => 'id'],
        ], [
            'huespedes.id_huesped',
            'huespedes.nombre_completo',
            'tipo_habitaciones.descripcion_habitacion',
            'historico_reservas_pms.dias_reservados',
            'historico_reservas_pms.estado',
            'historico_reservas_pms.fecha_llegada',
            'historico_reservas_pms.fecha_salida',
            'historico_reservas_pms.salida_checkout',
            'historico_reservas_pms.tipo_reserva',
            'historico_reservas_pms.num_habitacion',
            'historico_reservas_pms.num_reserva',
            'historico_reservas_pms.num_registro',
            'historico_reservas_pms.orden_reserva',
            'historico_reservas_pms.valor_diario',
            'historico_reservas_pms.observaciones',
            'historico_reservas_pms.tipo_habitacion',
            'historico_reservas_pms.can_hombres',
            'historico_reservas_pms.can_mujeres',
            'historico_reservas_pms.can_ninos',
            'historico_reservas_pms.id_huesped',
            'historico_reservas_pms.tarifa',
        ], [
            'historico_reservas_pms.id_huesped' => $id,
        ]);

        return $data;
    }

    public function getPrimerDia($ctamaster)
    {
        global $database;

        $data = $database->query("SELECT reservas_pms.fecha_llegada, reservas_pms.num_habitacion, reservas_pms.tipo_habitacion FROM reservas_pms WHERE (reservas_pms.tipo_habitacion <> '$ctamaster' AND reservas_pms.estado = 'CA') ORDER BY reservas_pms.fecha_llegada ASC LIMIT 1")->fetchAll();

        return $data[0]['fecha_llegada'];
    }

    public function getUltimoDia($ctamaster)
    {
        global $database;

        $data = $database->query("SELECT reservas_pms.fecha_salida, reservas_pms.num_habitacion, reservas_pms.tipo_habitacion FROM reservas_pms WHERE (reservas_pms.tipo_habitacion <> '$ctamaster' AND reservas_pms.estado = 'CA') ORDER BY reservas_pms.fecha_llegada DESC LIMIT 1")->fetchAll();

        return $data[0]['fecha_salida'];
    }

    public function buscaCasa($fecha, $room)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'reservas_pms.dias_reservados',
            'reservas_pms.tarifa',
            'reservas_pms.estado',
            'reservas_pms.valor_diario',
            'reservas_pms.num_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.causar_impuesto',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
        ], [
            'reservas_pms.fecha_salida[>=]' => $fecha,
            'reservas_pms.num_habitacion' => $room,
            'reservas_pms.estado' => 'CA',
        ]);

        return $data;
    }

    public function buscaEstadia($fecha, $room)
    {
        global $database;

        $data = $database->query("SELECT huespedes.apellido1, huespedes.apellido2, huespedes.nombre1, huespedes.nombre_completo, huespedes.nombre2, reservas_pms.dias_reservados, reservas_pms.tarifa, reservas_pms.estado, reservas_pms.valor_diario, reservas_pms.num_reserva, reservas_pms.num_habitacion, reservas_pms.can_hombres, reservas_pms.can_mujeres, reservas_pms.can_ninos, reservas_pms.fecha_llegada, reservas_pms.fecha_salida FROM huespedes, reservas_pms WHERE (huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.num_habitacion = '$room' AND reservas_pms.fecha_llegada = '$fecha' AND reservas_pms.estado = 'CA') OR (huespedes.id_huesped = reservas_pms.id_huesped AND reservas_pms.num_habitacion = '$room' AND reservas_pms.fecha_llegada = '$fecha' AND reservas_pms.estado = 'ES') 
				")->fetchAll();

        return $data;
    }

    public function getTipoDocumentoHuesped($id)
    {
        global $database;

        $data = $database->select('tipo_documento', [
            'descripcion_documento',
        ], [
            'id_doc' => $id,
        ]);

        return $data[0]['descripcion_documento'];
    }

    public function getDatosHuespedReserva($id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'direccion',
            'identificacion',
            'telefono',
            'email',
            'celular',
            'pais_expedicion',
            'ciudad_expedicion',
            'fecha_nacimiento',
            'tipo_identifica',
            'fecha_creacion',
            'usuario_creador',
        ], [
            'id_huesped' => $id,
        ]);

        return $data;
    }

    public function sumPagosdelDia($fecha)
    {
        global $database;

        $data = $database->sum('cargos_pms', [
            'pagos_cargos',
        ], [
            'fecha_cargo' => $fecha,
            'cargo_anulado' => 0,
            'concecutivo_abono[>]' => 0,
        ]);

        return $data;
    }

    public function sumDepositosdelDia($fecha)
    {
        global $database;

        $data = $database->sum('cargos_pms', [
            'pagos_cargos',
        ], [
            'fecha_cargo' => $fecha,
            'cargo_anulado' => 0,
            'concecutivo_abono[>]' => 0,
        ]);

        return $data;
    }

    public function sumAbonosdelDia($fecha)
    {
        global $database;

        $data = $database->sum('cargos_pms', [
            'pagos_cargos',
        ], [
            'fecha_cargo' => $fecha,
            'cargo_anulado' => 0,
            'concecutivo_abono[>]' => 0,
        ]);

        return $data;
    }

    public function sumCargosdelDia($fecha)
    {
        global $database;

        $data = $database->sum('cargos_pms', [
            'monto_cargo',
        ], [
            'fecha_cargo' => $fecha,
            'cargo_anulado' => 0,
        ]);

        return $data;
    }

    public function updateAnulaConsumo($id, $motivo, $fecha, $usuario, $idusuario)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'cargo_anulado' => 1,
            'fecha_anulacion' => $fecha,
            'usuario_anulacion' => $usuario,
            'id_usuario_anulacion' => $idusuario,
            'motivo_anulacion' => $motivo,
            'fecha_sistema_anula' => date('Y-m-d H:i:s'),
        ], [
            'id_cargo' => $id,
        ]);

        return $data->rowCount();
    }

    public function getSalidasSinRealizar($ctamaster, $fecha)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.id_huesped',
            'reservas_pms.id',
            'reservas_pms.cantidad',
            'reservas_pms.dias_reservados',
            'reservas_pms.estado',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.tipo_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.origen_reserva',
            'reservas_pms.destino_reserva',
            'reservas_pms.id_agencia',
            'reservas_pms.id_compania',
            'reservas_pms.id_huesped',
            'reservas_pms.tarifa',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.motivo_viaje',
            'reservas_pms.fecha_reserva',
            'reservas_pms.usuario',
            'reservas_pms.observaciones',
            'reservas_pms.fuente_reserva',
            'reservas_pms.causar_impuesto',
            'reservas_pms.cargo_habitacion',
        ], [
            'reservas_pms.tipo_habitacion[<>]' => $ctamaster,
            'reservas_pms.estado' => 'CA',
            'reservas_pms.fecha_salida' => $fecha,
        ]);

        return $data;
    }

    public function updateRoomChange($reserva)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'cargo_habitacion' => 1,
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data->rowCount();
    }

    public function buscaTextoCodigoVenta($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'id_cargo',
            'descripcion_cargo',
            'id_impto',
            'decreto_turismo',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data;
    }

    public function buscaCodigoTipoHabitacion($codigo)
    {
        global $database;

        $data = $database->select('tipo_habitaciones', [
            'deptoventa_habitacion',
            'deptoventa_excento',
        ], [
            'id' => $codigo,
        ]);

        return $data;
    }

    public function getCargoTodasHabitaciones($ctamaster)
    {
        global $database;

        $data = $database->query("SELECT id, cantidad, dias_reservados, estado, fecha_llegada, fecha_salida, tipo_reserva, num_habitacion, num_reserva, can_hombres, can_mujeres, can_ninos, origen_reserva, destino_reserva, id_agencia, id_compania, id_huesped, tarifa, tipo_habitacion, tipo_ocupacion, valor_reserva, valor_diario, motivo_viaje, fecha_reserva, usuario, observaciones, fuente_reserva, causar_impuesto, cargo_habitacion FROM reservas_pms WHERE tipo_habitacion != '$ctamaster' AND estado = 'CA' ORDER BY num_habitacion")->fetchAll();

        return $data;
    }

    public function getCargoUnaHabitacion($reserva)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'id',
            'cantidad',
            'dias_reservados',
            'estado',
            'fecha_llegada',
            'fecha_salida',
            'tipo_reserva',
            'num_habitacion',
            'num_reserva',
            'can_hombres',
            'can_mujeres',
            'can_ninos',
            'origen_reserva',
            'destino_reserva',
            'id_agencia',
            'id_compania',
            'id_huesped',
            'tarifa',
            'tipo_habitacion',
            'tipo_ocupacion',
            'valor_reserva',
            'valor_diario',
            'motivo_viaje',
            'fecha_reserva',
            'usuario',
            'observaciones',
            'fuente_reserva',
            'causar_impuesto',
            'cargo_habitacion',
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function getReservaActual($reserva)
    {
        global $database;

        // Trae los Datos Actuales de la Reserva
        $data = $database->select('reservas_pms', [
            'id',
            'cantidad',
            'dias_reservados',
            'estado',
            'fecha_llegada',
            'fecha_salida',
            'tipo_reserva',
            'num_habitacion',
            'num_reserva',
            'can_hombres',
            'can_mujeres',
            'can_ninos',
            'orden_reserva',
            'origen_reserva',
            'destino_reserva',
            'id_agencia',
            'id_compania',
            'id_huesped',
            'tarifa',
            'tipo_habitacion',
            'tipo_ocupacion',
            'valor_reserva',
            'valor_diario',
            'motivo_viaje',
            'fecha_reserva',
            'usuario',
            'observaciones',
            'causar_impuesto',
            'fuente_reserva',
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function updateCargosReservaFolio($reserva, $factura, $folio, $fecha, $usuario, $idusuario, $tipofac, $id, $perfilFac)
    {
        global $database;

        // Asigna Numero de Habitacion a los Cargos del Huesped [Por Folio]
        $data = $database->update('cargos_pms', [
            'factura_numero' => $factura,
            'fecha_factura' => $fecha,
            'usuario_factura' => $usuario,
            'id_usuario_factura' => $idusuario,
            'tipo_factura' => $tipofac,
            'id_perfil_factura' => $id,
            'perfil_factura' => $perfilFac,
        ], [
            'folio_cargo' => $folio,
            'numero_reserva' => $reserva,
            'factura_numero' => 0,
            'cargo_anulado' => 0,
        ]);

        return $data->rowCount();
    }

    public function updateReservaHuespedSalida($reserva, $usuario, $idusuario, $fecha)
    {
        global $database;
        // Cambia Estado habitacion a Salida Huesped
        $data = $database->update('reservas_pms', [
            'estado' => 'SA',
            'salida_checkout' => $fecha,
            'usuario_checkout' => $usuario,
            'id_usuario_checkout' => $idusuario,
            'fecha_checkout' => date('Y-m-d H:i:s'),
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function insertFacturaHuesped($codigo, $textcodigo, $valor, $refer, $numero, $room, $idhues, $folio, $canti, $usuario, $idUsuario, $fecha, $numfactura, $tipofac, $id, $idcentro, $prefijo, $perfilFac, $detallePag, $baseRete, $baseIva, $baseIca, $reteiva, $reteica, $retefuente, $correofac)
    {
        global $database;

        $data = $database->insert('cargos_pms', [
            'fecha_cargo' => $fecha,
            'id_codigo_cargo' => $codigo,
            'descripcion_cargo' => $textcodigo,
            'usuario' => $usuario,
            'id_usuario' => $idUsuario,
            'id_huesped' => $idhues,
            'cantidad_cargo' => $canti,
            'folio_cargo' => $folio,
            'pagos_cargos' => $valor,
            'habitacion_cargo' => $room,
            'factura_numero' => $numfactura,
            'numero_reserva' => $numero,
            'referencia_cargo' => $refer,
            'tipo_factura' => $tipofac,
            'id_perfil_factura' => $id,
            'idCentroCosto' => $idcentro,
            'fecha_salida' => FECHA_PMS,
            'factura' => 1,
            'informacion_cargo' => $detallePag,
            'prefijo_factura' => $prefijo,
            'perfil_factura' => $perfilFac,
            'baseretefuente' => $baseRete,
            'basereteiva' => $baseIva,
            'basereteica' => $baseIca,
            'reteiva' => $reteiva,
            'reteica' => $reteica,
            'retefuente' => $retefuente,
            'correo' => $correofac,
            'fecha_sistema_cargo' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function updateNumeroFactura($numero)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_factura' => $numero,
        ]);

        return $data;
    }

    public function getNumeroFactura()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_factura',
        ]);

        return $data[0]['con_factura'];
    }

    public function getCargosReservaModal($reserva)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'cargos_pms.id_cargo',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.impuesto',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.valor_unitario_sin_impto',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.numero_reserva',
            'cargos_pms.cargo_anulado',
            'cargos_pms.factura_numero',
            'cargos_pms.numero_factura_cargo',
            'codigos_vta.tipo_codigo',
            'codigos_vta.porcentaje_impto',
        ], [
            'cargos_pms.numero_reserva' => $reserva,
            'cargos_pms.cargo_anulado' => 0,
            'cargos_pms.tipo_factura' => 0,
            'ORDER' => 'cargos_pms.id_cargo',
        ]);

        return $data;
    }

    public function getCargosReservaFolio($reserva, $folio)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'cargos_pms.id_cargo',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.impuesto',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.valor_unitario_sin_impto',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.numero_reserva',
            'cargos_pms.cargo_anulado',
            'cargos_pms.factura_numero',
            'cargos_pms.prefijo_factura',
            'cargos_pms.numero_factura_cargo',
            'codigos_vta.tipo_codigo',
        ], [
            'cargos_pms.numero_reserva' => $reserva,
            'cargos_pms.folio_cargo' => $folio,
            'cargos_pms.cargo_anulado' => 0,
            // 'cargos_pms.tipo_factura' => 0,
            'ORDER' => 'cargos_pms.id_cargo',
        ]);

        return $data;
    }


    public function insertaNuevaAgencia($nit, $dv, $tipodoc, $agencia, $direccion, $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $potencial, $comision, $credito, $monto, $diascre, $diacorte, $usuario)
    {
        global $database;

        $data = $database->insert('agencias', [
            'agencia' => $agencia,
            'nit' => $nit,
            'dv' => $dv,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'celular' => $celular,
            'email' => $correo,
            'tipo_documento' => $tipodoc,
            'web' => $web,
            'ciudad' => $ciudad,
            'credito' => $credito,
            'monto_credito' => $monto,
            'dias_credito' => $diascre,
            'id_forma_pago' => $formapago,
            'potencial' => $potencial,
            'comision' => $comision,
            'dia_corte_credito' => $diacorte,
            'created_at' => date('Y-m-d H:i:s'),
            'id_tarifa' => $tarifa,
            'usuario' => $usuario,
            'activo' => 1,
        ]);

        return $data->rowCount();
    }

    public function getCityName($tipo)
    {
        global $database;

        $data = $database->select('ciudades', [
            'municipio',
            'depto',
        ], [
            'id_ciudad' => $tipo,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['municipio'] . ' - ' . $data[0]['depto'];
        }
    }

    public function getLandName($tipo)
    {
        global $database;

        $data = $database->select('paices', [
            'descripcion',
        ], [
            'id_pais' => $tipo,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data[0]['descripcion'];
        }
    }

    public function getTypeCia($tipo)
    {
        global $database;

        $data = $database->select('tipo_cia', [
            'descripcion',
        ], [
            'id_tipo_cia' => $tipo,
        ]);

        return $data[0]['descripcion'];
    }

    public function getInfoCia()
    {
        global $database;

        $data = $database->select('empresas', [
            'conMod',
            'invMod',
            'comMod',
            'cxpMod',
            'cxcMod',
            'posMod',
            'tarMod',
            'pmsMod',
            'resMod',
            'empresa',
            'nit',
            'dv',
            'direccion',
            'pais',
            'ciudad',
            'celular',
            'telefonos',
            'web',
            'correo',
            'logo',
            'xlogo',
            'ylogo',
            'tlogo',
            'codigo_ciiu',
            'tipo_empresa',
            'impto_incl'
        ]);

        return $data;
    }

    public function getConsumosReservaAgrupadoCodigo($numero)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.descripcion_cargo, cargos_pms.habitacion_cargo,Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) AS imptos, Sum(cargos_pms.pagos_cargos) AS pagos FROM cargos_pms WHERE cargos_pms.numero_reserva = '$numero' and cargos_pms.cargo_anulado = 0 GROUP BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo")->fetchAll();

        return $data;
    }

    public function getConsumosCongeladaReservaAgrupadoCodigoFolio($numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.numero_reserva = '$numero' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.tipo_factura = 0 AND cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' GROUP BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo, cargos_pms.folio_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo, cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getFacturaDetallada($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.id_codigo_cargo, cargos_pms.fecha_cargo, cargos_pms.descripcion_cargo, cargos_pms.cantidad_cargo AS cant, cargos_pms.habitacion_cargo, cargos_pms.monto_cargo AS cargos, cargos_pms.valor_cargo AS total, cargos_pms.impuesto as imptos, cargos_pms.codigo_impto, cargos_pms.pagos_cargos AS pagos, cargos_pms.reteiva AS reteiva, cargos_pms.reteica AS reteica, cargos_pms.retefuente AS retefuente, cargos_pms.basereteiva AS basereteiva, cargos_pms.reteica AS basereteica, cargos_pms.baseretefuente AS baseretefuente,cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.numero_reserva = '$numero' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' ORDER BY cargos_pms.numero_reserva, cargos_pms.id_cargo, cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getFacturaDetalladaHistorico($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.fecha_cargo, historico_cargos_pms.descripcion_cargo, historico_cargos_pms.cantidad_cargo AS cant, historico_cargos_pms.habitacion_cargo, historico_cargos_pms.monto_cargo AS cargos, historico_cargos_pms.valor_cargo AS total, historico_cargos_pms.impuesto as imptos, historico_cargos_pms.codigo_impto, historico_cargos_pms.pagos_cargos AS pagos, historico_cargos_pms.reteiva AS reteiva, historico_cargos_pms.reteica AS reteica, historico_cargos_pms.retefuente AS retefuente, historico_cargos_pms.basereteiva AS basereteiva, historico_cargos_pms.reteica AS basereteica, historico_cargos_pms.baseretefuente AS baseretefuente,historico_cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND historico_cargos_pms.factura_numero = '$fact' AND historico_cargos_pms.numero_reserva = '$numero' AND historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' ORDER BY historico_cargos_pms.numero_reserva, historico_cargos_pms.id_cargo, historico_cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }


    public function getConsumosReservaAgrupadoCodigoFolio($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.id_codigo_cargo, cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.valor_cargo) AS total, Sum(cargos_pms.impuesto) as imptos, cargos_pms.codigo_impto, Sum(cargos_pms.pagos_cargos) AS pagos, Sum(cargos_pms.reteiva) AS reteiva, Sum(cargos_pms.reteica) AS reteica, Sum(cargos_pms.retefuente) AS retefuente, Sum(cargos_pms.basereteiva) AS basereteiva, Sum(cargos_pms.reteica) AS basereteica, Sum(cargos_pms.baseretefuente) AS baseretefuente,cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.numero_reserva = '$numero' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' GROUP BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo, cargos_pms.folio_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo, cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getConsumosReservaAgrupadoCodigoFolioHis($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.descripcion_cargo, count(historico_cargos_pms.id_codigo_cargo) AS cant, historico_cargos_pms.habitacion_cargo, Sum(historico_cargos_pms.monto_cargo) AS cargos, Sum(historico_cargos_pms.valor_cargo) AS total, Sum(historico_cargos_pms.impuesto) as imptos, historico_cargos_pms.codigo_impto, Sum(historico_cargos_pms.pagos_cargos) AS pagos, Sum(historico_cargos_pms.reteiva) AS reteiva, Sum(historico_cargos_pms.reteica) AS reteica, Sum(historico_cargos_pms.retefuente) AS retefuente, Sum(historico_cargos_pms.basereteiva) AS basereteiva, Sum(historico_cargos_pms.reteica) AS basereteica, Sum(historico_cargos_pms.baseretefuente) AS baseretefuente,historico_cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND historico_cargos_pms.factura_numero = '$fact' AND historico_cargos_pms.numero_reserva = '$numero' AND historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' GROUP BY historico_cargos_pms.numero_reserva, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.folio_cargo ORDER BY historico_cargos_pms.numero_reserva, historico_cargos_pms.id_codigo_cargo, historico_cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getConsumosReservaAgrupadoFolio($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.numero_reserva = '$numero' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' GROUP BY cargos_pms.numero_reserva, cargos_pms.folio_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getConsumosReservasinImpuestos($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM cargos_pms, codigos_vta WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.numero_reserva = '$numero' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.folio_cargo = '$folio' AND codigos_vta.id_impto = 81 AND codigos_vta.tipo_codigo = '$tipo' GROUP BY cargos_pms.numero_reserva, cargos_pms.folio_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getConsumosReservaAgrupadoFolioHis($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT historico_cargos_pms.descripcion_cargo, count(historico_cargos_pms.id_codigo_cargo) AS cant, historico_cargos_pms.habitacion_cargo, Sum(historico_cargos_pms.monto_cargo) AS cargos, Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.pagos_cargos) AS pagos, historico_cargos_pms.factura_numero, codigos_vta.porcentaje_impto FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND historico_cargos_pms.factura_numero = '$fact' AND historico_cargos_pms.numero_reserva = '$numero' AND historico_cargos_pms.cargo_anulado = 0 AND historico_cargos_pms.folio_cargo = '$folio' AND codigos_vta.tipo_codigo = '$tipo' GROUP BY historico_cargos_pms.numero_reserva, historico_cargos_pms.folio_cargo ORDER BY historico_cargos_pms.numero_reserva, historico_cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getValorImptoFolio($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT codigos_vta.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.porcentaje_impto, cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos, cargos_pms.factura_numero FROM cargos_pms, codigos_vta WHERE cargos_pms.codigo_impto = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.numero_reserva = '$numero' and cargos_pms.cargo_anulado = 0 and cargos_pms.folio_cargo = $folio and codigos_vta.tipo_codigo = '$tipo' GROUP BY cargos_pms.numero_reserva, cargos_pms.codigo_impto, cargos_pms.folio_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.codigo_impto, cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getValorImptoFolioHis($fact, $numero, $folio, $tipo)
    {
        global $database;

        $data = $database->query("SELECT codigos_vta.id_cargo, codigos_vta.descripcion_cargo, codigos_vta.porcentaje_impto, historico_cargos_pms.habitacion_cargo, Sum(historico_cargos_pms.monto_cargo) as cargos, Sum(historico_cargos_pms.impuesto) as imptos, Sum(historico_cargos_pms.pagos_cargos) as pagos, historico_cargos_pms.factura_numero FROM historico_cargos_pms, codigos_vta WHERE historico_cargos_pms.codigo_impto = codigos_vta.id_cargo AND historico_cargos_pms.factura_numero = '$fact' AND historico_cargos_pms.numero_reserva = '$numero' and historico_cargos_pms.cargo_anulado = 0 and historico_cargos_pms.folio_cargo = $folio and codigos_vta.tipo_codigo = '$tipo' GROUP BY historico_cargos_pms.numero_reserva, historico_cargos_pms.codigo_impto, historico_cargos_pms.folio_cargo ORDER BY historico_cargos_pms.numero_reserva, historico_cargos_pms.codigo_impto, historico_cargos_pms.folio_cargo")->fetchAll();

        return $data;
    }

    public function getCargosReserva($reserva, $folio)
    {
        global $database;

        $data = $database->select('cargos_pms', [
            '[>]codigos_vta' => ['id_codigo_cargo' => 'id_cargo'],
        ], [
            'cargos_pms.id_cargo',
            'cargos_pms.fecha_cargo',
            'cargos_pms.monto_cargo',
            'cargos_pms.impuesto',
            'cargos_pms.habitacion_cargo',
            'cargos_pms.descripcion_cargo',
            'cargos_pms.usuario',
            'cargos_pms.id_huesped',
            'cargos_pms.cantidad_cargo',
            'cargos_pms.informacion_cargo',
            'cargos_pms.valor_cargo',
            'cargos_pms.folio_cargo',
            'cargos_pms.pagos_cargos',
            'cargos_pms.referencia_cargo',
            'cargos_pms.concecutivo_abono',
            'cargos_pms.numero_reserva',
            'cargos_pms.cargo_anulado',
            'cargos_pms.factura_numero',
            'cargos_pms.numero_factura_cargo',
            'cargos_pms.fecha_sistema_cargo',
            'codigos_vta.tipo_codigo',
            'codigos_vta.porcentaje_impto',
        ], [
            'cargos_pms.numero_reserva' => $reserva,
            'cargos_pms.folio_cargo' => $folio,
            'cargos_pms.cargo_anulado' => 0,
            'cargos_pms.factura_numero' => 0,
            'ORDER' => 'cargos_pms.id_cargo',
        ]);

        return $data;
    }

    public function getReservasHisDatos($reserva)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.num_registro',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.id_compania',
            'reservas_pms.id_agencia',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.motivo_viaje',
            'reservas_pms.origen_reserva',
            'reservas_pms.destino_reserva',
            'reservas_pms.forma_pago',
            'reservas_pms.causar_impuesto',
            'reservas_pms.observaciones',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function getReservasDatos($reserva)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.num_registro',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.id_agencia',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.motivo_viaje',
            'reservas_pms.origen_reserva',
            'reservas_pms.destino_reserva',
            'reservas_pms.forma_pago',
            'reservas_pms.causar_impuesto',
            'reservas_pms.salida_checkout',
            'reservas_pms.observaciones',
            'reservas_pms.observaciones_cancela',
            'reservas_pms.fecha_ingreso',
            'reservas_pms.hora_llegada',
            'reservas_pms.equipaje',
            'reservas_pms.placaVehiculo',
            'reservas_pms.tipoTransporte',
            'reservas_pms.id_usuario_ingreso',
            'reservas_pms.reservaCreada',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre_completo',
            'huespedes.identificacion',
            'huespedes.telefono',
            'huespedes.fecha_nacimiento',
            'huespedes.celular',
            'huespedes.email',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function getReservasDatosHistorico($reserva)
    {
        global $database;

        $data = $database->select('historico_reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'historico_reservas_pms.cantidad',
            'historico_reservas_pms.fecha_llegada',
            'historico_reservas_pms.fecha_salida',
            'historico_reservas_pms.dias_reservados',
            'historico_reservas_pms.tipo_habitacion',
            'historico_reservas_pms.num_habitacion',
            'historico_reservas_pms.num_reserva',
            'historico_reservas_pms.num_registro',
            'historico_reservas_pms.can_hombres',
            'historico_reservas_pms.can_mujeres',
            'historico_reservas_pms.can_ninos',
            'historico_reservas_pms.orden_reserva',
            'historico_reservas_pms.id_compania',
            'historico_reservas_pms.id_agencia',
            'historico_reservas_pms.tipo_ocupacion',
            'historico_reservas_pms.tarifa',
            'historico_reservas_pms.valor_reserva',
            'historico_reservas_pms.valor_diario',
            'historico_reservas_pms.estado',
            'historico_reservas_pms.motivo_viaje',
            'historico_reservas_pms.origen_reserva',
            'historico_reservas_pms.destino_reserva',
            'historico_reservas_pms.forma_pago',
            'historico_reservas_pms.causar_impuesto',
            'historico_reservas_pms.salida_checkout',
            'historico_reservas_pms.observaciones',
            'historico_reservas_pms.observaciones_cancela',
            'historico_reservas_pms.hora_llegada',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre_completo',
            'huespedes.identificacion',
            'huespedes.id_huesped',
        ], [
            'historico_reservas_pms.num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function getForecastHabitacionFecha($room, $fecha)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'id_huesped',
        ], []);

        return $data;
    }

    public function getHabitaciones($ctamaster)
    {
        global $database;

        $data = $database->query("SELECT habitaciones.id, habitaciones.numero_hab, habitaciones.caracteristicas, habitaciones.tipo_hab, habitaciones.pax, habitaciones.camas, habitaciones.estado_fo, habitaciones.estado_hk, tipo_habitaciones.descripcion_habitacion, habitaciones.mantenimiento, habitaciones.sucia, habitaciones.ocupada FROM habitaciones, tipo_habitaciones WHERE habitaciones.id_tipohabitacion = tipo_habitaciones.id AND tipo_habitaciones.tipo_habitacion = 1 AND habitaciones.active_at = 1 AND habitaciones.id_tipohabitacion <> '1' ORDER BY habitaciones.piso,  habitaciones.numero_hab")->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getMotivoGrupo($caja)
    {
        global $database;

        $data = $database->select('grupos_cajas', [
            'id_grupo',
            'descripcion_grupo',
        ], [
            'caja' => $caja,
            'ORDER' => 'descripcion_grupo',
        ]);

        return $data;
    }

    public function buscaTipoEmpresa($id)
    {
        global $database;

        $data = $database->select('grupos_cajas', [
            'descripcion_grupo',
        ], [
            'id_grupo' => $id,
        ]);

        return $data[0]['descripcion_grupo'];
    }

    public function getBuscaAgencia($id)
    {
        global $database;

        $data = $database->count('agencias', [
            'nit' => $id,
        ]);

        return $data;
    }

    public function getAgencias()
    {
        global $database;

        $data = $database->select('agencias', [
            'id_agencia',
            'agencia',
            'nit',
            'dv',
            'direccion',
            'telefono',
            'fax',
            'celular',
            'email',
            'id_tarifa',
            'pais',
            'ciudad',
            'potencial',
            'noches',
            'comision',
            'id_forma_pago',
            'localizacion',
            'segmento',
            'estado_credito',
            'activo',
        ]);

        return $data;
    }

    public function getCiudadesPais($pais)
    {
        global $database;

        $data = $database->select('ciudades', [
            'id_ciudad',
            'municipio',
            'depto',
        ], [
            'id_pais' => $pais,
            'ORDER' => 'municipio',
        ]);

        return $data;
    }

    public function getPaices()
    {
        global $database;

        $data = $database->select('paices', [
            'id_pais',
            'descripcion',
        ], [
            'ORDER' => 'descripcion',
        ]);

        return $data;
    }

    public function getTotalHuespedeseCasaTipo($ctamaster, $tipo)
    {
        global $database;

        if ($tipo == 1) {
            $campo = 'can_hombres';
        }
        if ($tipo == 2) {
            $campo = 'can_mujeres';
        }
        if ($tipo == 3) {
            $campo = 'can_ninos';
        }

        $data = $database->sum('reservas_pms', [
            $campo,
        ], [
            'tipo_habitacion[<>]' => $ctamaster,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getHuespedesLlegando($ctamaster, $fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'num_habitacion',
        ], [
            'tipo_habitacion[>]' => $ctamaster,
            'estado' => 'ES',
            'fecha_llegada' => $fecha,
        ]);

        return $data;
    }

    public function getHuespedesSaliendo($ctamaster, $fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'num_habitacion',
        ], [
            'tipo_habitacion[>]' => $ctamaster,
            'estado' => 'SA',
            'fecha_salida' => $fecha,
        ]);

        return $data;
    }

    public function getHuespedesenCasaHotel($ctamaster)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'num_habitacion',
        ], [
            'tipo_habitacion[>]' => $ctamaster,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getTotalHabitacionesOUT($ctamaster, $tipo)
    {
        global $database;

        $data = $database->count('habitaciones', [
            'numero_hab',
        ], [
            'tipo_hab[>]' => $ctamaster,
            'estado_hk' => $tipo,
            'active_at' => 1,
        ]);

        return $data;
    }

    public function getTotalHabitacionesHotel($ctamaster)
    {
        global $database;

        $data = $database->count('habitaciones', [
            'numero_hab',
        ], [
            'tipo_hab[>]' => $ctamaster,
            'active_at' => 1,
        ]);

        return $data;
    }

    public function getNombreHuesped($hues)
    {
        global $database;

        $data = $database->select('huespedes', [
            'nombre_completo',
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
        ], [
            'id_huesped' => $hues,
        ]);
        if (count($data) == 0) {
            return '';
        } else {
            return $data;
        }
    }

    public function getHabitacionLlegandoHoy($hab, $fecha)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'id_huesped',
        ], [
            'num_habitacion' => $hab,
            'estado' => 'ES',
            'fecha_llegada' => $fecha,
        ]);
        if (count($data) == 0) {
            return '0';
        } else {
            return $data[0]['id_huesped'];
        }
    }

    public function getHabitacionenCasa($hab)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'id_huesped',
        ], [
            'num_habitacion' => $hab,
            'estado' => 'CA',
        ]);
        if (count($data) == 0) {
            return '0';
        } else {
            return $data[0]['id_huesped'];
        }
    }

    public function getEstadoHabitaciones($ctamaster)
    {
        global $database;

        $data = $database->select('habitaciones', [
            'id',
            'numero_hab',
            'estado_fo',
            'estado_hk',
            'camas',
        ], [
            'tipo_hab[>]' => $ctamaster,
            'active_at' => 1,
            'ORDER' => 'numero_hab',
        ]);

        return $data;
    }

    public function getReservasActivas($tipo, $estado)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'num_reserva',
        ], [
            'tipo_reserva' => $tipo,
            'estado' => $estado,
        ]);

        return $data;
    }

    public function getHuespedesenSalida($tipo, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.orden_reserva',
            'reservas_pms.id_compania',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.usuario_cancela',
            'reservas_pms.fecha_cancela',
            'reservas_pms.motivo_cancela',
            'reservas_pms.causar_impuesto',
            'reservas_pms.observaciones',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.tipo_reserva' => $tipo,
            'reservas_pms.estado' => $estado,
            'ORDER' => 'reservas_pms.num_habitacion',
        ]);

        return $data;
    }

    public function getbuscaDatosHuesped($id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'profesion',
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'nombre_completo',
            'identificacion',
            'tipo_identifica',
            'pais_expedicion',
            'ciudad_expedicion',
            'lugar_expedicion',
            'fecha_nacimiento',
            'direccion',
            'telefono',
            'email',
            'ciudad',
            'pais',
            'sexo',
            'tipoAdquiriente',
            'tipoResponsabilidad',
            'responsabilidadTributaria',
        ], [
            'id_huesped' => $id,
        ]);

        return $data;
    }

    public function getbuscaDatosReservaHuesped($reserva)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'num_habitacion',
            'id_huesped',
            'causar_impuesto',
        ], [
            'num_reserva' => $reserva,
        ]);

        return $data;
    }

    public function getDescripcionIva($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'descripcion_cargo',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data[0]['descripcion_cargo'];
    }

    public function getCodigoIvaCargo($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'id_impto',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data[0]['id_impto'];
    }

    public function getPorcentajeIvaCargo($codigo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'porcentaje_impto',
            'decreto_turismo',
        ], [
            'id_cargo' => $codigo,
        ]);

        return $data;
    }

    public function getNumeroAbono()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_abonos',
        ]);

        return $data[0]['con_abonos'];
    }

    public function updateNumeroAbonos($numero)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_abonos' => $numero,
        ]);

        return $data;
    }

    public function insertAbonosCuenta($codigo, $textcodigo, $valor, $refer, $detalle, $numero, $room, $idhues, $folio, $canti, $usuario, $idusuario, $fecha, $numabono)
    {
        global $database;

        $data = $database->insert('cargos_pms', [
            'fecha_cargo' => $fecha,
            'id_codigo_cargo' => $codigo,
            'descripcion_cargo' => 'ABONO EN ' . $textcodigo,
            'usuario' => $usuario,
            'id_usuario' => $idusuario,
            'id_huesped' => $idhues,
            'cantidad_cargo' => $canti,
            'folio_cargo' => $folio,
            'pagos_cargos' => $valor,
            'habitacion_cargo' => $room,
            'concecutivo_abono' => $numabono,
            'numero_reserva' => $numero,
            'referencia_cargo' => $refer,
            'informacion_cargo' => $detalle,
            'fecha_sistema_cargo' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function insertCargosConsumos($codigo, $textcodigo, $valor, $canti, $refer, $folio, $detalle, $numero, $idhues, $usuario, $idusuario, $fecha, $room, $totalcargo, $impuesto, $baseimpto, $iva)
    {
        global $database;

        $data = $database->insert('cargos_pms', [
            'fecha_cargo' => $fecha,
            'id_codigo_cargo' => $codigo,
            'descripcion_cargo' => $textcodigo,
            'usuario' => $usuario,
            'id_usuario' => $idusuario,
            'id_huesped' => $idhues,
            'cantidad_cargo' => $canti,
            'folio_cargo' => $folio,
            'valor_cargo' => $valor,
            'monto_cargo' => $totalcargo,
            'impuesto' => $impuesto,
            'codigo_impto' => $iva,
            'base_impuesto' => $baseimpto,
            'habitacion_cargo' => $room,
            'numero_reserva' => $numero,
            'referencia_cargo' => $refer,
            'informacion_cargo' => $detalle,
            'fecha_sistema_cargo' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getCodigosConsumos($tipo)
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'id_cargo',
            'descripcion_cargo',
            'id_impto',
            'codigo_propina',
            'decreto_turismo',
        ], [
            'tipo_codigo' => $tipo,
            'restringido' => 0,
            'ORDER' => 'descripcion_cargo',
        ]);

        return $data;
    }

    public function getIvaReservaFolio($numero, $folio)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as baseImpto, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.numero_reserva = '$numero' and cargos_pms.cargo_anulado = 0 and cargos_pms.factura_numero = 0 and cargos_pms.folio_cargo = '$folio' and cargos_pms.codigo_impto = 23 GROUP BY cargos_pms.numero_reserva ORDER BY cargos_pms.numero_reserva")->fetchAll();

        return $data;
    }

    public function getConsumosReservaFolio($numero, $folio)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.numero_reserva = '$numero' and cargos_pms.cargo_anulado = 0 and cargos_pms.factura_numero = 0 and cargos_pms.folio_cargo = '$folio' GROUP BY cargos_pms.numero_reserva ORDER BY cargos_pms.numero_reserva")->fetchAll();

        return $data;
    }

    public function getSaldoHabitacion01($reserva)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.numero_reserva = '$reserva' and cargos_pms.cargo_anulado = 0 GROUP BY cargos_pms.numero_reserva")->fetchAll();

        return $data;
    }

    public function getConsumoReservaNew($estado)
    {

        global $database;

        $data = $database->query("SELECT reservas_pms.num_reserva, reservas_pms.fecha_llegada, reservas_pms.fecha_salida, reservas_pms.num_habitacion, reservas_pms.id_compania, huespedes.nombre_completo, reservas_pms.valor_diario, SUM(cargos_pms.valor_cargo) AS cargos, SUM(cargos_pms.pagos_cargos) AS pagos FROM huespedes LEFT JOIN reservas_pms ON huespedes.id_huesped = reservas_pms.id_huesped LEFT JOIN cargos_pms ON reservas_pms.num_reserva = cargos_pms.numero_reserva WHERE reservas_pms.estado = '$estado' AND cargos_pms.cargo_anulado = 0 AND cargos_pms.factura = 0 AND cargos_pms.factura_numero = 0 GROUP BY reservas_pms.num_reserva ORDER BY reservas_pms.num_habitacion, reservas_pms.num_reserva")->fetchAll();
        return $data;
    }

    public function traeBalanceHabitaciones($tipo)
    {
        global $database;
        $data = $database->query("SELECT
            reservas_pms.num_reserva, 
            reservas_pms.causar_impuesto, 
            reservas_pms.num_habitacion, 
            reservas_pms.id_compania, 
            reservas_pms.fecha_llegada, 
            reservas_pms.fecha_salida, 
            reservas_pms.valor_diario, 
            reservas_pms.observaciones, 
            reservas_pms.tarifa, 
            reservas_pms.valor_reserva, 
            reservas_pms.tipo_habitacion, 
            COALESCE ( SUM( cargos_pms.valor_cargo ), 0 ) AS cargos, 
            COALESCE ( SUM( cargos_pms.pagos_cargos ), 0 ) AS pagos, 
            COALESCE ( SUM( cargos_pms.impuesto ), 0 ) AS imptos, 
            huespedes.nombre_completo, 
            huespedes.fecha_nacimiento, 
            huespedes.id_huesped,
            companias.empresa,
            companias.nit,
            companias.dv
        FROM
            reservas_pms
            LEFT JOIN
            cargos_pms
            ON 
                cargos_pms.numero_reserva = reservas_pms.num_reserva AND
                cargos_pms.cargo_anulado = 0 AND
                cargos_pms.factura = 0 AND
                cargos_pms.factura_numero = 0
            INNER JOIN huespedes ON reservas_pms.id_huesped = huespedes.id_huesped
            LEFT JOIN companias ON reservas_pms.id_compania = companias.id_compania
        WHERE
            reservas_pms.estado = '$tipo'
        GROUP BY
            reservas_pms.num_reserva
        ORDER BY
            reservas_pms.num_reserva ASC")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

    public function getConsumosReserva($numero)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos FROM cargos_pms WHERE cargos_pms.numero_reserva = '$numero' and cargos_pms.cargo_anulado = 0 AND cargos_pms.tipo_factura = 0 GROUP BY cargos_pms.numero_reserva ORDER BY cargos_pms.numero_reserva")->fetchAll();

        return $data;
    }

    public function updateDepositoReserva($numero, $huesped, $hab)
    {
        global $database;

        $data = $database->update('cargos_pms', [
            'numero_reserva' => $numero,
            'habitacion_cargo' => $hab,
            'id_huesped' => $huesped,
        ], [
            'id_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getBuscaReservaDeposito($numero)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'id_huesped',
            'num_habitacion',
            'tipo_habitacion',
            'num_reserva',
        ], [
            'num_reserva' => $numero,
        ]);
        if (count($data) == 0) {
            return 0;
        } else {
            return $data[0];
        }
    }

    public function getBuscaDeposito($numero)
    {
        global $database;

        $data = $database->count('cargos_pms', [
            'id_reserva' => $numero,
        ]);

        return $data;
    }

    public function getRegistroHotelero($numero)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'num_registro',
        ], [
            'num_reserva' => $numero,
        ]);
        if (count($data) == 0) {
            return 0;
        } else {
            return $data[0]['num_registro'];
        }
    }
   
    public function updateIngresaReserva($origen, $destino, $motivo, $fuente, $segmento, $formapago, $numero, $usuario, $placa, $equipaje, $transporte)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'origen_reserva' => $origen, 
            'destino_reserva' => $destino, 
            'segmento_mercado' => $segmento, 
            'motivo_viaje'=> $motivo, 
            'fuente_reserva'=> $fuente, 
            'forma_pago' => $formapago,
            'estado' => 'CA',
            'tipo_reserva' => 2,
            'usuario_ingreso' => $usuario,
            'hora_llegada' => date('H:i:s'),
            'fecha_ingreso' => date('Y-m-d H:i:s'),
            'placaVehiculo' => $placa,
            'equipaje' => $equipaje,
            'tipoTransporte' => $transporte,
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getFacturacionenCasa($tipo, $estado)
    {
        global $database;

        $data = $database->query("SELECT cargos_pms.habitacion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos, cargos_pms.descripcion_cargo, reservas_pms.num_reserva, reservas_pms.tipo_habitacion, reservas_pms.orden_reserva, reservas_pms.num_habitacion, reservas_pms.fecha_llegada, reservas_pms.causar_impuesto, reservas_pms.fecha_salida, huespedes.nombre1, huespedes.nombre2, huespedes.apellido1, huespedes.apellido2,  huespedes.identificacion FROM cargos_pms, reservas_pms, huespedes WHERE cargos_pms.numero_reserva = reservas_pms.num_reserva AND reservas_pms.tipo_reserva = '$tipo' AND reservas_pms.estado = '$estado' AND cargos_pms.cargo_anulado = 0 AND reservas_pms.id_huesped = huespedes.id_huesped GROUP BY cargos_pms.habitacion_cargo, cargos_pms.numero_reserva ORDER BY cargos_pms.habitacion_cargo ASC, cargos_pms.numero_reserva ASC")->fetchAll();

        return $data;
    }

    public function getNumeroPMDeposito($cuenta)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            'num_reserva',
        ], [
            'num_habitacion' => $cuenta,
            'estado' => 'CA',
        ]);
        if (count($data) == 0) {
            return '0';
        } else {
            return $data[0]['num_reserva'];
        }
    }

    public function insertDepositoReserva($fecha, $forma, $valor, $detalle, $numero, $idhues, $idusuario, $usuario, $ctadeposito, $folio, $numdeposito, $encasa, $textoforma)
    {
        global $database;

        $data = $database->insert('cargos_pms', [
            'fecha_cargo' => $fecha,
            'id_codigo_cargo' => $forma,
            'habitacion_cargo' => $ctadeposito,
            'descripcion_cargo' => 'DEPOSITO EN ' . $textoforma,
            'usuario' => $usuario,
            'id_usuario' => $idusuario,
            'id_huesped' => $idhues,
            'cantidad_cargo' => 1,
            'folio_cargo' => $folio,
            'pagos_cargos' => $valor,
            'concecutivo_abono' => $numdeposito,
            'informacion_cargo' => $detalle,
            'numero_reserva' => $encasa,
            'id_reserva' => $numero,
            'fecha_sistema_cargo' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function getNumeroDeposito()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_deposito',
        ]);

        return $data[0]['con_deposito'];
    }

    public function updateNumeroDeposito($numero)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_deposito' => $numero,
        ]);

        return $data;
    }

    public function getCuentaDepositosPms()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'cuenta_depositos',
        ]);

        return $data[0]['cuenta_depositos'];
    }

    public function getMotivoCancelacion($tipo)
    {
        global $database;

        $data = $database->select('motivo_cancelacion', [
            'id_cancela',
            'descripcion_motivo',
        ], [
            'tipo_cancelacion' => $tipo,
            'ORDER' => 'descripcion_motivo',
        ]);

        return $data;
    }

    public function updateCancelaReserva($numero, $usuario, $motivo, $observa)
    {
        global $database;

        $data = $database->update('reservas_pms', [
            'estado' => 'CX',
            'motivo_cancela' => $motivo,
            'usuario_cancela' => $usuario,
            'observaciones_cancela' => $observa,
            'fecha_cancela' => date('Y-m-d H:i:s'),
        ], [
            'num_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getCountHuespedesenCasa($ctamaster, $fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'estado' => 'CA',
            'tipo_habitacion[<>]' => $ctamaster,
        ]);

        return $data;
    }

    public function getCountCuentasMaestrasenCasa($ctamaster, $fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'estado' => 'CA',
            'tipo_habitacion' => $ctamaster,
        ]);

        return $data;
    }

    public function getTotalHuespedeseCasa($tipo)
    {
        global $database;

        $data = $database->query("SELECT count(id) as habi, Sum(reservas_pms.can_hombres) AS hom, Sum(reservas_pms.can_mujeres) AS muj, Sum(reservas_pms.can_ninos) AS nin FROM reservas_pms WHERE reservas_pms.estado = 'CA' AND reservas_pms.tipo_habitacion <> '1'")->fetchAll();

        return $data;
    }

    public function getTotalCuentasMaestras()
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'tipo_habitacion' => 'CMA',
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getTotalHuespedeseSaliendo()
    {
        global $database;

        $fecha = FECHA_PMS;
        $ctamas = CTA_MASTER;

        $data = $database->query("SELECT count(id) as habi, Sum(reservas_pms.can_hombres) AS hom, Sum(reservas_pms.can_mujeres) AS muj, Sum(reservas_pms.can_ninos) AS nin FROM reservas_pms WHERE reservas_pms.estado = 'CA' AND reservas_pms.fecha_salida = '$fecha'")->fetchAll();

        return $data;
    }

    public function getTotalHuespedeseLlegando()
    {
        global $database;

        $fecha = FECHA_PMS;
        $ctamas = CTA_MASTER;

        $data = $database->query("SELECT count(id) as habi, Sum(reservas_pms.can_hombres) AS hom, Sum(reservas_pms.can_mujeres) AS muj, Sum(reservas_pms.can_ninos) AS nin FROM reservas_pms WHERE reservas_pms.estado = 'ES' AND reservas_pms.fecha_llegada = '$fecha'")->fetchAll();

        return $data;
    }

    public function getLlegadasDelDia($tipo, $fecha, $estado)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'tipo_reserva' => $tipo,
            'fecha_llegada' => $fecha,
            'estado' => $estado,
        ]);

        return $data;
    }

    public function getRegistrosDelDia($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'estado' => 'CA',
            'num_registro' => 0,
        ]);

        return $data;
    }

    public function getSalidasDelDia($fecha)
    {
        global $database;

        $data = $database->count('reservas_pms', [
            'id',
        ], [
            'tipo_reserva' => 2,
            'fecha_salida[<=]' => $fecha,
            'estado' => 'CA',
        ]);

        return $data;
    }

    public function getNumeroTarifa($id)
    {
        global $database;

        $data = $database->select('tarifas', []);

        return $data;
    }

    public function getNombreTarifa($tipo)
    {
        global $database;

        $data = $database->select('valores_tarifas', [
            '[<]tarifas' => ['id_subtarifa' => 'id_tarifa'],
        ], [
            'tarifas.descripcion_tarifa',
        ], [
            'valores_tarifas.id' => $tipo,
        ]);
        if (count($data) == 0) {
            return 'Sin Datos ' . $tipo;
        } else {
            return $data[0]['descripcion_tarifa'];
        }
    }

    public function getNombreTipoHabitacion($tipo)
    {
        global $database;

        $data = $database->select('tipo_habitaciones', [
            'descripcion_habitacion',
        ], [
            'id' => $tipo,
        ]);

        return $data;
    }

    public function getMotivoViaje()
    {
        global $database;

        $data = $database->select('tipo_viaje', [
            'id_tipo_viaje',
            'descripcion_viaje',
        ], [
            'ORDER' => 'descripcion_viaje',
        ]);

        return $data;
    }

    public function getbuscaCompania($id)
    {
        global $database;

        $data = $database->count('companias', [
            'nit' => $id,
        ]);

        return $data;
    }

    public function insertaNuevaCompania($nit, $dv, $tipodoc, $compania, $direccion, $ciudad, $telefono, $celular, $web, $correo, $tarifa, $formapago, $credito, $monto, $diascre, $diacorte, $usuario, $tipoemp, $codciiu, $tipoAdqui, $tipoRespo, $repoTribu, $reteIva, $reteIca, $reteFte, $baseRete)
    {
        global $database;

        $data = $database->insert('companias', [
            'empresa' => $compania,
            'direccion' => $direccion,
            'nit' => $nit,
            'dv' => $dv,
            'tipo_documento' => $tipodoc,
            'telefono' => $telefono,
            'celular' => $celular,
            'email' => $correo,
            'web' => $web,
            'ciudad' => $ciudad,
            'credito' => $credito,
            'monto_credito' => $monto,
            'dias_credito' => $diascre,
            'id_forma_pago' => $formapago,
            'dia_corte_credito' => $diacorte,
            'created_at' => date('Y-m-d H:i:s'),
            'id_tarifa' => $tarifa,
            'usuario' => $usuario,
            'activo' => 1,
            'tipo_empresa' => $tipoemp,
            'id_codigo_ciiu' => $codciiu,
            'tipo_compania' => 3,
            'reteiva' => $reteIva,
            'reteica' => $reteIca,
            'retefuente' => $reteFte,
            'sinBaseRete' => $baseRete,
            'tipoAdquiriente' => $tipoAdqui,
            'tipoResponsabilidad' => $tipoRespo,
            'responsabilidadTributaria' => $repoTribu,
        ]);

        return $database->id();
    }

    public function getFormasPago()
    {
        global $database;

        $data = $database->select('codigos_vta', [
            'id',
            'descripcion',
        ], [
            'ORDER' => 'descripcion',
        ]);

        return $data;
    }

    public function getTarifasHuespedes()
    {
        global $database;

        $data = $database->select('tarifas', [
            'id_tarifa',
            'descripcion_tarifa',
        ], [
            'ORDER' => 'descripcion_tarifa',
        ]);

        return $data;
    }

    public function getTipoHuespedes()
    {
        global $database;

        $data = $database->select('tipo_huesped', [
            'id_tipo_huesped',
            'descripcion_tipo',
        ]);

        return $data;
    }

    public function insertaNuevoHuesped($iden, $tipodoc, $apellido1, $apellido2, $nombre1, $nombre2, $sexo, $direccion, $telefono, $celular, $correo, $fechanace, $pais, $ciudad, $paisExp, $ciudadExp, $usuario, $idusuario, $tipoAdqui, $tipoRespo, $repoTribu, $empresa, $profesion, $edad)
    {
        global $database;

        $data = $database->insert('huespedes', [
            'apellido1' => $apellido1,
            'apellido2' => $apellido2,
            'nombre1' => $nombre1,
            'nombre2' => $nombre2,
            'direccion' => $direccion,
            'telefono' => $telefono,
            'email' => $correo,
            'identificacion' => $iden,
            'tipo_identifica' => $tipodoc,
            'pais_expedicion' => $paisExp,
            'ciudad_expedicion' => $ciudadExp,
            'fecha_nacimiento' => $fechanace,
            'edad' => $edad,
            'estado_credito' => 1,
            'sexo' => $sexo,
            'usuario_creador' => $usuario,
            'id_usuario' => $idusuario,
            'celular' => $celular,
            'pais' => $pais,
            'ciudad' => $ciudad,
            'profesion' => $profesion,
            'nombre_completo' => $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2,
            'tipoAdquiriente' => $tipoAdqui,
            'tipoResponsabilidad' => $tipoRespo,
            'responsabilidadTributaria' => $repoTribu,
            'id_compania' => $empresa,
            'fecha_creacion' => date('Y-m-d H:i:s'),
        ]);

        $result = [
            'id' => $database->id(),
            'error' => $database->error,
        ];

        return $result;
    }

    public function getTipoDocumento()
    {
        global $database;

        $data = $database->select('tipo_documento', [
            'id_doc',
            'descripcion_documento',
        ], [
            'deleted_at' => null,
            'ORDER' => 'descripcion_documento',
        ]);

        return $data;
    }

    public function getbuscaHuesped($id)
    {
        global $database;

        $data = $database->count('huespedes', [
            'identificacion' => $id,
        ]);

        return $data;
    }

    public function getNombreEmpresa($id)
    {
        global $database;

        $data = $database->select('companias', [
            'nit',
            'dv',
            'empresa',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function insertLlegadaSinReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $idcia, $idCentro, $numero, $usuario, $estado, $observa, $formapa, $sinrese, $impto, $idusuario, $tipo, $placavehiculo, $equipaje, $transporte)
    {
        global $database;

        $data = $database->insert('reservas_pms', [
            'cantidad' => 1,
            'estado' => $estado,
            'dias_reservados' => $noches,
            'fecha_llegada' => $llegada,
            'fecha_salida' => $salida,
            'num_habitacion' => $nrohabitacion,
            'num_reserva' => $numero,
            'can_hombres' => $hombres,
            'can_mujeres' => $mujeres,
            'can_ninos' => $ninos,
            'orden_reserva' => $orden,
            'origen_reserva' => $origen,
            'destino_reserva' => $destino,
            'id_compania' => $idcia,
            'idCentroCia' => $idCentro,
            'id_huesped' => $idhuesp,
            'segmento_mercado' => $segmento,
            'tarifa' => $tarifahab,
            'tipo_habitacion' => $tipohabi,
            'valor_reserva' => ($valortarifa * $noches),
            'valor_diario' => $valortarifa,
            'motivo_viaje' => $motivo,
            'fecha_reserva' => FECHA_PMS,
            'hora_llegada' => date('H:i:s'),
            'fuente_reserva' => $fuente,
            'usuario' => $usuario,
            'usuario_ingreso' => $usuario,
            'id_usuario_ingreso' => $idusuario,
            'observaciones' => $observa,
            'sinreserva' => $sinrese,
            'forma_pago' => $formapa,
            'causar_impuesto' => $impto,
            'tipo_reserva' => $tipo,
            'placaVehiculo' => $placavehiculo,
            'equipaje' => $equipaje,
            'tipoTransporte' => $transporte,
            'reservaCreada' => date('Y-m-d H:i:s'),
        ]);

        return $database->id();
    }

    public function insertNuevaReserva($iden, $llegada, $salida, $noches, $hombres, $mujeres, $ninos, $orden, $tipohabi, $nrohabitacion, $tarifahab, $valortarifa, $origen, $destino, $motivo, $fuente, $segmento, $idhuesp, $idcia, $idCentro, $numero, $usuario, $estado, $observa, $formapa, $sinrese, $impto, $idusuario, $tipo)
    {
        global $database;

        $data = $database->insert('reservas_pms', [
            'cantidad' => 1,
            'estado' => $estado,
            'dias_reservados' => $noches,
            'fecha_llegada' => $llegada,
            'fecha_salida' => $salida,
            'num_habitacion' => $nrohabitacion,
            'num_reserva' => $numero,
            'can_hombres' => $hombres,
            'can_mujeres' => $mujeres,
            'can_ninos' => $ninos,
            'orden_reserva' => $orden,
            'origen_reserva' => $origen,
            'destino_reserva' => $destino,
            'id_compania' => $idcia,
            'idCentroCia' => $idCentro,
            'id_huesped' => $idhuesp,
            'segmento_mercado' => $segmento,
            'tarifa' => $tarifahab,
            'tipo_habitacion' => $tipohabi,
            'valor_reserva' => ($valortarifa * $noches),
            'valor_diario' => $valortarifa,
            'motivo_viaje' => $motivo,
            'fecha_reserva' => FECHA_PMS,
            'fuente_reserva' => $fuente,
            'usuario' => $usuario,
            'usuario_ingreso' => $usuario,
            'id_usuario_ingreso' => $idusuario,
            'observaciones' => $observa,
            'sinreserva' => $sinrese,
            'forma_pago' => $formapa,
            'causar_impuesto' => $impto,
            'tipo_reserva' => $tipo,
            'reservaCreada' => date('Y-m-d H:i:s'),

        ]);

        return $database->id();
    }

    public function updateNumeroReserva($numero)
    {
        global $database;

        $data = $database->update('parametros_pms', [
            'con_reserva' => $numero,
        ]);

        return $data->rowCount();
    }

    public function getNumeroReserva()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'con_reserva',
        ]);

        return $data[0]['con_reserva'];
    }

    public function getCiudades()
    {
        global $database;

        $data = $database->select('ciudades', [
            'id_ciudad',
            'codigo',
            'municipio',
            'depto',
        ], [
            'ORDER' => 'municipio',
        ]);

        return $data;
    }

    public function getSeleccionFuente()
    {
        global $database;

        $data = $database->select('fuente_reserva', [
            'id_fuente',
            'descripcion_fuente',
        ], [
            'ORDER' => 'descripcion_fuente',
        ], [
            'active_at' => 1,
        ]);

        return $data;
    }

    public function getBuscaCia($id)
    {
        global $database;

        $data = $database->select('companias', [
            'empresa',
            'nit',
            'dv',
            'email',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function getSeleccionaCompania($id)
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'email',
            'activo',
            'ciudad',
            'direccion',
            'estado_credito',
            'credito',
            'monto_credito',
            'dia_corte_credito',
            'dias_credito',
            'reteiva',
            'reteica',
            'retefuente',
            'sinBaseRete',
            'tipoAdquiriente',
            'tipoResponsabilidad',
            'responsabilidadTributaria',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function getSeleccionaAgencia($id)
    {
        global $database;

        $data = $database->select('agencias', [
            'id_agencia',
            'agencia',
            'nit',
            'dv',
            'direccion',
            'telefono',
            'email',
        ], [
            'id_compania' => $id,
        ]);

        return $data;
    }

    public function getSeleccionaHuesped($id)
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'identificacion',
            'apellido1',
            'apellido2',
            'nombre1',
            'nombre2',
            'direccion',
            'celular',
            'tipo_identifica',
            'email',
            'sexo',
            'id_compania',
            'idCentroCia',
            'pais',
        ], [
            'id_huesped' => $id,
        ]);

        return $data;
    }

    public function getValorTarifa($tarifa)
    {
        global $database;

        $data = $database->select('valores_tarifas', [
            'valor_un_pax',
            'valor_dos_pax',
            'valor_tre_pax',
            'valor_cua_pax',
            'valor_cin_pax',
            'valor_sei_pax',
            'valor_sie_pax',
            'valor_och_pax',
            'valor_nue_pax',
            'valor_die_pax',
            'valor_nino',
            'valor_adicional',
            'valor_dormitorio',
        ], [
            'id' => $tarifa,
        ]);

        return $data;
    }

    public function getSeleccionaTarifa($tipo, $llega, $sale)
    {
        global $database;
        $data = $database->select('valores_tarifas', [
            '[>]tarifas' => ['id_subtarifa' => 'id_tarifa'],
        ], [
            'valores_tarifas.id',
            'tarifas.descripcion_tarifa',
            'valores_tarifas.id_tipohabitacion',
        ], [
            'valores_tarifas.id_tipohabitacion' => $tipo,
            'ORDER' => 'tarifas.descripcion_tarifa',
        ]);

        return $data;
    }

    public function getSeleccionaDormitorio($tipo)
    {
        global $database;

        $data = $database->select('habitaciones', [
            'numero_hab',
            'dormitorios',
        ], [
            'ORDER' => 'orden_dormitorio',
        ], [
            'tipo_hab' => $tipo,
            'orden_dormitorio' => null,
        ]);

        return $data;
    }

    public function getSeleccionaHabitacionesTipo($tipo)
    {
        global $database;

        $data = $database->query("SELECT numero_hab as num_habitacion FROM habitaciones WHERE id_tipohabitacion = '$tipo' AND active_at = 1 ORDER BY numero_hab")->fetchAll();

        return $data;
    }

    public function getSeleccionaHabitacionesTipoDia($tipo)
    {
        global $database;

        $data = $database->query("SELECT numero_hab as num_habitacion FROM habitaciones WHERE id_tipohabitacion = '$tipo' AND active_at = 1 AND mantenimiento = 0 AND sucia = 0 AND ocupada = 0 ORDER BY numero_hab")->fetchAll();

        return $data;
    }

    public function getTipoHabitacion()
    {
        global $database;

        $data = $database->select('tipo_habitaciones', [
            'id',
            'codigo',
            'descripcion_habitacion',
            'sector_habitacion',
            'deptoventa_habitacion',
            'tipo_habitacion',
        ], [
            'active_at' => 1,
            'ORDER' => 'descripcion_habitacion',
        ]);

        return $data;
    }

    public function getDatePms()
    {
        global $database;

        $data = $database->select('parametros_pms', [
            'fecha_auditoria',
        ], [
            'LIMIT' => 1,
        ]);

        return $data;
    }

    public function getPerfilHuespedes()
    {
        global $database;

        $data = $database->select('huespedes', [
            'id_huesped',
            'nombre1',
            'nombre2',
            'apellido1',
            'apellido2',
            'nombre_completo',
            'identificacion',
            'direccion',
            'telefono',
            'email',
            'tipo_identifica',
            'tipo_huesped',
            'fecha_nacimiento',
            'edad',
            'sexo',
            'celular',
            'id_compania',
            'idCentroCia',
            'estado_credito',
        ], [
            'ORDER' => 'apellido1',
        ]);

        return $data;
    }

    public function getCompanias()
    {
        global $database;

        $data = $database->select('companias', [
            'id_compania',
            'empresa',
            'direccion',
            'nit',
            'dv',
            'tipo_documento',
            'telefono',
            'celular',
            'fax',
            'email',
            'id_tarifa',
            'estado_credito',
            'reteiva',
            'reteica',
            'retefuente',
            'activo',
        ], [
            'ORDER' => 'empresa',
        ]);

        return $data;
    }

    public function getReservasActuales($tipo)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]cargos_pms' => ['num_reserva' => 'id_reserva'],
            '[>]companias' => ['id_compania' => 'id_compania'],
            '[<]huespedes' => ['id_huesped' => 'id_huesped'],
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.tipo_reserva',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.observaciones',
            'reservas_pms.observaciones_cancela',
            'reservas_pms.salida_checkout',
            'reservas_pms.causar_impuesto',
            'reservas_pms.orden_reserva',
            'huespedes.nombre_completo',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.fecha_nacimiento',
            'huespedes.id_huesped',
            'companias.empresa',
            'cargos_pms.pagos_cargos',
        ], [
            'reservas_pms.tipo_reserva' => $tipo,
        ]);

        return $data;
    }

    public function getHuespedesenCasa($tipo, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]companias' => ['id_compania' => 'id_compania'],
            '[>]huespedes' => ['id_huesped' => 'id_huesped'],
            '[>]cargos_pms' => ['num_reserva' => 'id_reserva'],
        ], [
            'reservas_pms.id',
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_reserva',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.num_registro',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.salida_checkout',
            'reservas_pms.observaciones',
            'reservas_pms.causar_impuesto',
            'reservas_pms.usuario',
            'reservas_pms.fecha_ingreso',
            'huespedes.nombre_completo',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.fecha_nacimiento',
            'huespedes.id_huesped',
            'companias.empresa',
            'cargos_pms.pagos_cargos',
        ], [
            'reservas_pms.tipo_reserva' => $tipo,
            'reservas_pms.estado' => $estado,
            'ORDER' => 'reservas_pms.num_habitacion',
        ]);

        return $data;
    }

    public function getHuespedesenCasasinCtaMaster($tipo, $estado, $ctamaster)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
            '[>]tipo_habitaciones' => ['tipo_habitacion' => 'id'],
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.observaciones',
            'reservas_pms.causar_impuesto',
            'huespedes.nombre_completo',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.fecha_nacimiento',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.fecha_salida[>]' => FECHA_PMS,
            'reservas_pms.tipo_reserva' => $tipo,
            'tipo_habitaciones.tipo_habitacion' => 1,
            'reservas_pms.estado' => $estado,
            'ORDER' => 'reservas_pms.num_habitacion',
        ]);

        return $data;
    }

    public function getCtaMasterinHouse($tipo, $estado, $ctamaster)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]huespedes' => 'id_huesped',
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.estado',
            'reservas_pms.observaciones',
            'reservas_pms.causar_impuesto',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.id_huesped',
        ], [
            'reservas_pms.tipo_reserva' => $tipo,
            'reservas_pms.estado' => $estado,
            'ORDER' => 'reservas_pms.num_habitacion',
        ]);

        return $data;
    }

    public function getReservasDia($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]companias' => ['id_compania' => 'id_compania'],
            '[>]huespedes' => ['id_huesped' => 'id_huesped'],
            '[>]cargos_pms' => ['num_reserva' => 'id_reserva'],
            '[>]habitaciones' => ['num_habitacion' => 'numero_hab'],
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_compania',
            'reservas_pms.id_huesped',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.observaciones',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tipo_reserva',
            'reservas_pms.estado',
            'reservas_pms.causar_impuesto',
            'reservas_pms.orden_reserva',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'huespedes.fecha_nacimiento',
            'huespedes.nombre_completo',
            'habitaciones.sucia',
            'companias.empresa',
            'cargos_pms.pagos_cargos',
        ], [
            'reservas_pms.tipo_reserva' => $tipo,
            'reservas_pms.estado' => $estado,
            'reservas_pms.fecha_llegada' => $fecha,
            'ORDER' => ['reservas_pms.num_habitacion' => 'ASC'],
        ]);

        return $data;
    }

    public function getSalidasDia($fecha, $tipo, $estado)
    {
        global $database;

        $data = $database->select('reservas_pms', [
            '[>]companias' => ['id_compania' => 'id_compania'],
            '[>]huespedes' => ['id_huesped' => 'id_huesped'],
        ], [
            'reservas_pms.cantidad',
            'reservas_pms.fecha_llegada',
            'reservas_pms.fecha_salida',
            'reservas_pms.salida_checkout',
            'reservas_pms.dias_reservados',
            'reservas_pms.tipo_habitacion',
            'reservas_pms.num_habitacion',
            'reservas_pms.num_reserva',
            'reservas_pms.can_hombres',
            'reservas_pms.can_mujeres',
            'reservas_pms.can_ninos',
            'reservas_pms.id_compania',
            'reservas_pms.idCentroCia',
            'reservas_pms.tarifa',
            'reservas_pms.valor_reserva',
            'reservas_pms.valor_diario',
            'reservas_pms.observaciones',
            'reservas_pms.tipo_ocupacion',
            'reservas_pms.tipo_reserva',
            'reservas_pms.estado',
            'reservas_pms.causar_impuesto',
            'huespedes.id_huesped',
            'huespedes.nombre_completo',
            'huespedes.nombre1',
            'huespedes.nombre2',
            'huespedes.apellido1',
            'huespedes.apellido2',
            'companias.empresa',
        ], [
            'tipo_reserva' => $tipo,
            'estado' => $estado,
            'fecha_salida[<=]' => $fecha,
            'ORDER' => ['reservas_pms.num_habitacion' => 'ASC'],
        ]);

        return $data;
    }
}
