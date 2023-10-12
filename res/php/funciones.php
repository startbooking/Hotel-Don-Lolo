<?php

function tipoPagoDian($tipo){
    switch ($tipo) {
        case 1:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-info">Contado</span>';
        case 2:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-warning">Credito</span>';
        case '':
            return 'Sin Definir';
    }

}


function nombreMes($mes)
{
    date_default_timezone_set('America/Bogota');
    $nombreMes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

    return $nombreMes[$mes - 1];
} 

function crearThumbJPEG($rutaImagen, $rutaDestino, $anchoThumb = 200, $altoThumb = 150, $calidad = 50)
{
    $original = imagecreatefromjpeg($rutaImagen);
    if ($original !== false) {
        $thumb = imagecreatetruecolor($anchoThumb, $altoThumb);
        if ($thumb !== false) {
            $ancho = imagesx($original);
            $alto = imagesy($original);
            imagecopyresampled($thumb, $original, 0, 0, 0, 0, $anchoThumb, $altoThumb, $ancho, $alto);
            $resultado = imagejpeg($thumb, $rutaDestino, $calidad);

            return $resultado;
        }
    } else {
        return 'No Original';
    }

    return false;
}

function sucia($estado)
{
    switch ($estado) {
        case 0:
            return 'Limpia';
        case 1:
            return 'Sucia';
        case 2:
            return 'Sin Definir';
    }
}

function estadoReceta($estado)
{
    switch ($estado) {
        case 0:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-danger">en Proceso</span>';
        case 1:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-info">en Venta</span>';
        case 2:
            return 'Sin Definir';
    }
}

function generateRandomString($length = 10)
{
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $length);
}

function edad($fecha_nacimiento)
{
    $tiempo = strtotime($fecha_nacimiento);
    $ahora = time();
    $edad = ($ahora - $tiempo) / (60 * 60 * 24 * 365.25);
    $edad1 = floatval($edad);

    return substr($edad1, 3, 3);
}

function estado($estado)
{
    switch ($estado) {
        case 0:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-danger">Bloqueado</span>';
        case 1:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-info">Activo</span>';
        case 2:
            return 'Sin Definir';
    }
}

function estadoProducto($estado)
{
    switch ($estado) {
        case 0:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-danger">In-Activa</span>';
        case 1:
            return '<span style="font-size:12px;display:block;height:20px;padding:3px" class="label label-info">Activa</span>';
        case 2:
            return 'Sin Definir';
    }
}

function estadoFacturaImp($estado)
{
    switch ($estado) {
        case 0:
            return 'Activa';
        case 1:
            return 'Anulada';
        case 2:
            return 'Sin Definir';
    }
}

function estadoFactura($estado)
{
    switch ($estado) {
        case 0:
            return '<span style="font-size:12px" class="label label-info">Activa</span>';
        case 1:
            return '<span style="font-size:12px" class="label label-danger">Anulada</span>';
        case 'A':
            return '<span style="font-size:12px" class="label label-info">Activa</span>';
        case 'X':
            return '<span style="font-size:12px" class="label label-danger">Anulada</span>'; 
        case 2:
            return '<span style="font-size:12px" class="label label-default">Sin Definir</span>';
    }
}

function estadoFacturaDIAN($estado)
{
    switch ($estado) {
        case '0':
            return '<span style="font-size:12px" class="label label-warning">No Procesada</span>';
        case '1':
            return '<span style="font-size:12px" class="label label-success">Emitida</span>';
        case 'false':
            return '<span style="font-size:12px" class="label label-warning">No Procesada</span>';
        case 'true':
            return '<span style="font-size:12px" class="label label-success">Emitida</span>';
    }
}

function tipoCompania($estado)
{
    switch ($estado) {
        case 0:
            return '<span style="font-size:12px" class="label label-default">Sin Definir</span>';
        case 1:
            return '<span style="font-size:12px" class="label label-warning">Proveedor</span>';
        case 2:
            return '<span style="font-size:12px" class="label label-success">Tercero</span>';
        case 3:
            return '<span style="font-size:12px" class="label label-success">Ambos</span>';
    }
}

function estadoCompania($estado)
{
    switch ($estado) {
        case 0:
            return '<span style="font-size:12px" class="label label-default">Sin Definir</span>';
        case 1:
            return '<span style="font-size:12px" class="label label-success">Activo</span>';
        case 2:
            return '<span style="font-size:12px" class="label label-danger">Bloquado</span>';
    }
}

function tipoUsuario($user)
{
    if ($user == '1') {
        return '<span style="font-size:12px" class="label label-success">Administrador</span>';
    }
    if ($user == '2') {
        return '<span style="font-size:12px" class="label label-danger">Auditor</span>';
    }
    if ($user == '3') {
        return '<span style="font-size:12px" class="label label-warning">Cajero</span>';
    }
    if ($user == '4') {
        return '<span style="font-size:12px" class="label label-info">Digitador</span>';
    }
    if ($user == '5') {
        return '<span style="font-size:12px" class="label label-default">Consulta</span>';
    }
}

function estadoUsuario($user)
{
    if ($user == '0') {
        return '<span style="font-size:12px" class="label label-warning">InActivo</span>';
    }
    if ($user == '1') {
        return '<span style="font-size:12px" class="label label-info">Activo</span>';
    }
    if ($user == '2') {
        return '<span style="font-size:12px" class="label label-danger">Suspendido</span>';
    }
    if ($user == '3') {
        return '<span style="font-size:12px" class="label label-danger">Bloqueado</span>';
    }
}

function ciudad_destino2($code)
{
    $user = new User_Actions();
    $ciudad = $user->getCityName($code);

    return $ciudad;
}

function ciudad_hotel($code)
{
    $user = new User_Actions();
    $codecity = $user->getCityHotel($code);
    $ciudad = $user->getCityName($codecity);

    return $ciudad;
}

function clean_string($string)
{
    $bad = ['content-type', 'bcc:', 'to:', 'cc:', 'href'];

    return str_replace($bad, '', $string);
}

function getRealIP2()
{
    if ($_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
        $client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ?
        $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ?
        $_ENV['REMOTE_ADDR'] : 'unknown');

        // los proxys van añadiendo al final de esta cabecera
        // las direcciones ip que van "ocultando". Para localizar la ip real
        // del usuario se comienza a mirar por el principio hasta encontrar
        // una dirección ip que no sea del rango privado. En caso de no
        // encontrarse ninguna se toma como valor el REMOTE_ADDR

        $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);

        reset($entries);
        while (list(, $entry) = each($entries)) {
            $entry = trim($entry);
            if (preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list)) {
                // http://www.faqs.org/rfcs/rfc1918.html
                $private_ip = [
                                '/^0\./',
                        '/^127\.0\.0\.1/',
                        '/^192\.168\..*/',
                        '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                        '/^10\..*/'];

                $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
                if ($client_ip != $found_ip) {
                    $client_ip = $found_ip;
                    break;
                }
            }
        }
    } else {
        $client_ip = (!empty($_SERVER['REMOTE_ADDR'])) ?
        $_SERVER['REMOTE_ADDR'] : ((!empty($_ENV['REMOTE_ADDR'])) ?
        $_ENV['REMOTE_ADDR'] : 'unknown');
    }

    return $client_ip;
}

function consultar($campo, $tabla, $where)
{
    $sql = mysqli_query("SELECT * FROM $tabla WHERE $where");
    if ($row = mysqli_fetch_array($sql)) {
        return $row[$campo];
    } else {
        return '';
    }
}

function abonos_saldo($cuenta)
{
    $sql = mysql_query("SELECT SUM(valor) as valores FROM abono WHERE cuenta='$cuenta'");
    if ($row = mysql_fetch_array($sql)) {
        return $row['valores'];
    } else {
        return 0;
    }
}

function encrypt($string, $key)
{
    $result = '';
    $key = $key.'2015';
    for ($i = 0; $i < strlen($string); ++$i) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result .= $char;
    }

    return base64_encode($result);
}
// ####CONTRASEÑA DE-ENCRIPTAR

function decrypt($string, $key)
{
    $result = '';
    $key = $key.'2015';
    $string = base64_decode($string);
    for ($i = 0; $i < strlen($string); ++$i) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result .= $char;
    }

    return $result;
}

function diaSemana($ano, $mes, $dia)
{
    $dias = ['DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'];
    $dia = date('w', mktime(0, 0, 0, $mes, $dia, $ano));

    return $dias[$dia];
}

function cadenas()
{
    return 'YABCDFGJAH';
}

function fecha($fecha)
{
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $a = substr($fecha, 0, 4);
    $m = substr($fecha, 5, 2);
    $d = substr($fecha, 8);

    return $d.' de '.$meses[$m - 1].' de '.$a;
}

function fechaReserva($fecha)
{
    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
    $a = substr($fecha, 0, 4);
    $m = substr($fecha, 5, 2);
    $d = substr($fecha, 8);
    $dia = diaSemana($a, $m, $d);

    return ucfirst(strtolower($dia)).' '.$d.' de '.$meses[$m - 1].' de '.$a;
}

function estado_c($estado)
{
    if ($estado == 's') {
        return '<span class="label label-success">Activo</span>';
    } elseif ($estado == 'n') {
        return '<span class="label label-important">No Activo</span>';
    }
}

function estado_n($estado)
{
    if ($estado == 1) {
        return '<span class="label label-success">Activo</span>';
    } elseif ($estado == 0) {
        return '<span class="label label-danger">Inactivo</span>';
    }
}

function estado_usuario($estado)
{
    if ($estado == 'N') {
        return '<span class="label label-important">Eliminado</span>';
    } elseif ($estado == 'A') {
        return '<span class="label label-success">Activo</span>';
    } elseif ($estado == 'S') {
        return '<span class="label label-warning">In-Activo</span>';
    }
}

function estado_cliente($estado)
{
    if ($estado == 'N') {
        return 'Eliminado';
    } elseif ($estado == '1') {
        return 'Activo';
    } elseif ($estado == '0') {
        return 'In-Activo';
    }
}

function tipo_bod($estado)
{
    if ($estado == 1) {
        return '<span class="label label-success">Principal</span>';
    } elseif ($estado == 2) {
        return '<span class="label label-danger">Sub Bodega</span>';
    } elseif ($estado == 3) {
        return '<span class="label label-info">Procesamiento</span>';
    } elseif ($estado == 4) {
        return '<span class="label label-warning">Punto de Venta</span>';
    } elseif ($estado == 5) {
        return '<span class="label label-default">Externa</span>';
    } elseif ($estado == 6) {
        return '<span class="label label-important">Activos</span>';
    }
}

function mensajes($mensaje, $tipo)
{
    if ($tipo == 'verde') {
        $tipo = 'alert alert-success';
    } elseif ($tipo == 'rojo') {
        $tipo = 'alert alert-error';
    } elseif ($tipo == 'azul') {
        $tipo = 'alert alert-info';
    }

    return '<div class="'.$tipo.'" align="center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>'.$mensaje.'</strong>
          </div>';
}

function formato($valor)
{
    return number_format($valor, 2, ',', '.');
}

function mysql_escape_mimic($inp)
{
    if (is_array($inp)) {
        return array_map(__METHOD__, $inp);
    }

    if (!empty($inp) && is_string($inp)) {
        return str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"], ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $inp);
    }

    return $inp;
}

function limpiar($tags)
{
    $tags = strip_tags($tags);
    $tags = stripslashes($tags);
    $tags = mysql_escape_mimic($tags);
    $tags = trim($tags);

    return $tags;
}

function tipo_mov($tipo)
{
    if ($tipo == '1') {
        return '<span class="label label-success">ENTRADA</span>';
    } else {
        return '<span class="label label-important">SALIDA</span>';
    }
}

function frecuencia_pqte($tipo)
{
    if ($tipo == 'D') {
        return '<span class="label label-success" style="font-size:12px">Diaria</span>';
    } else {
        return '<span class="label label-info" style="font-size:12px">Estadia</span>';
    }
}

function tipo_cargo_pqte($tipo)
{
    if ($tipo == 'P') {
        return '<span class="label label-success" style="font-size:12px">Por Persona</span>';
    } else {
        return '<span class="label label-info" style="font-size:12px">Por Habitacion</span>';
    }
}

function estado_fac($estado)
{
    if ($estado == 'C') {
        // return '<button class="btn btn-primary" type="button"><span class="badge">Anulada</span> </button>';
        return '<span class="label" style="font-size:1em;background-color:#BF0F0F;pading:5px">Anulada</span>';
    } else {
        return '<span class="label" style="font-size:1em;background-color:#174D90">Activa</span>';
    }
}

function estado_pms($estado)
{
    if ($estado == 1) {
        // return '<button class="btn btn-primary" type="button"><span class="badge">Anulada</span> </button>';
        return '<span class="label label-danger" style="font-size:1em;">Cuenta PMS</span>';
    } else {
        return '<span class="label label-success" style="font-size:1em;">Factura</span>';
    }
}

function validatePassword2()
{
    // NO son iguales las password
    if (inputPassword1.val() != inputPassword2.val()) {
        reqPassword2.addClass('error');
        inputPassword2.addClass('error');

        return false;
    }
    // SI son iguales
    else {
        reqPassword2.removeClass('error');
        inputPassword2.removeClass('error');

        return true;
    }
}

function tipo_usuario($estado)
{
    if ($estado == 'A') {
        return '<span class="label label-success">Administrador</span>';
    } elseif ($estado == 'U') {
        return '<span class="label label-danger">Usuario</span>';
    } elseif ($estado == 'C') {
        return '<span class="label label-warning">Cajero</span>';
    } elseif ($estado == 'D') {
        return '<span class="label label-info">Digitador</span>';
    }
}

function cambia_est($estado)
{
    if ($estado == 'S') {
        return 'Activar';
    } elseif ($estado == 'N') {
        return 'Desactivar';
    }
}

function derechos($estado)
{
    if ($estado == 0) {
        return '<span class="label label-primary">No</span>';
    } elseif ($estado == 1) {
        return '<span class="label label-success">Si</span>';
    }
}

function tipo_prd($estado)
{
    if ($estado == 0) {
        return '<span class="label label-warning" style="font-size:12px;display:block;height:20px;padding:3px">Servicio</span>';
    } elseif ($estado == 1) {
        return '<span class="label label-success" style="font-size:12px;display:block;height:20px;padding:3px">Producto</span>';
    } elseif ($estado == 2) {
        return '<span class="label label-primary" style="font-size:12px;display:block;height:20px;padding:3px">Receta</span>';
    }
}

function tipo_imp($estado)
{
    if ($estado == 1) {
        return '<span class="label label-success">Impuesto</span>';
    } elseif ($estado == 2) {
        return '<span class="label label-warning">Retenciones</span>';
    }
}

function numtoletras2($xcifra)
{
    $xarray = [0 => 'Cero', 1 => 'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE', 'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO', 'DIECINUEVE', 'VEINTI', 30 => 'TREINTA', 40 => 'CUARENTA', 50 => 'CINCUENTA', 60 => 'SESENTA', 70 => 'SETENTA', 80 => 'OCHENTA', 90 => 'NOVENTA', 100 => 'CIENTO', 200 => 'DOSCIENTOS', 300 => 'TRESCIENTOS', 400 => 'CUATROCIENTOS', 500 => 'QUINIENTOS', 600 => 'SEISCIENTOS', 700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS'];
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, '.');
    $xaux_int = $xcifra;
    $xdecimales = '00';
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = '0'.$xcifra;
            $xpos_punto = strpos($xcifra, '.');
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra.'00', $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, ' ', STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = '';
    for ($xz = 0; $xz < 3; ++$xz) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; ++$xy) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (true === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100) {
                                    $xcadena = ' '.$xcadena.' CIEN '.$xsub;
                                } else {
                                    $xcadena = ' '.$xcadena.' '.$xseek.' '.$xsub;
                                }
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            } else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = ' '.$xcadena.' '.$xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (true === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20) {
                                    $xcadena = ' '.$xcadena.' VEINTE '.$xsub;
                                } else {
                                    $xcadena = ' '.$xcadena.' '.$xseek.' '.$xsub;
                                }
                                $xy = 3;
                            } else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10) {
                                    $xcadena = ' '.$xcadena.' '.$xseek;
                                } else {
                                    $xcadena = ' '.$xcadena.' '.$xseek.' Y ';
                                }
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = ' '.$xcadena.' '.$xseek.' '.$xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == 'ILLON') { // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena .= ' DE';
        }

        if (substr(trim($xcadena), -7, 7) == 'ILLONES') { // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena .= ' DE';
        }

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != '') {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == '1') {
                        $xcadena .= 'UN BILLON ';
                    } else {
                        $xcadena .= ' BILLONES ';
                    }
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == '1') {
                        $xcadena .= 'UN MILLON ';
                    } else {
                        $xcadena .= ' MILLONES ';
                    }
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS $xdecimales/100 M.C.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 M.C. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena .= " PESOS $xdecimales/100 M.C. ";
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
        // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace('VEINTI ', 'VEINTI', $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
        $xcadena = str_replace('UN UN', 'UN', $xcadena); // quito la duplicidad
        $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
        $xcadena = str_replace('BILLON DE MILLONES', 'BILLON DE', $xcadena); // corrigo la leyenda
        $xcadena = str_replace('BILLONES DE MILLONES', 'BILLONES DE', $xcadena); // corrigo la leyenda
        $xcadena = str_replace('DE UN', 'UN', $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)

    return trim($xcadena);
}

function subfijo2($xx)
{
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3) {
        $xsub = '';
    }

    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6) {
        $xsub = 'MIL';
    }

    return $xsub;
}

/* Funcion Para CArgar los Productos a un list */
function cargarproducto()
{
    // Conexion a la base de datos
    // Consulta SQL a ejecutar para obtener los idiomas

    $sql_con = 'SELECT * FROM productos_pos order by nombre';
    $conn = mysqli_connect('localhost', 'root', 'b4r4h0n4', 'sactel');
    // Se ejecuta la consulta
    $result = mysqli_query($conn, $sql_con);
    $respuesta = '';
    // Si se obtuvo algun registro se recorre el resultado
    if ($res = mysqli_num_rows($result) > 0) {
        // Ciclo para crear la cadena con la lista de productos que va a retornar la funcion
        while ($fila = $result->fetch_array()) {
            // A cada producto se le asigna el atributo id, lo vamos a utilizar a la hora de guardar en la base de datos
            // $respuesta .= '<li style="margin:5px 0; background:#ddd; cursor:move;        padding:5px; list-style-type: none;text-align:center" id="'.$fila['id'].'">'.utf8_encode($fila['nombre']).'</li>';
            $respuesta .= '
            <li style="" id="'.$fila['productos_pos_id'].'"><h4 style="font-weight:600;color:#0b344c;font-size:16px;">'.utf8_encode($fila['nombre']).'</h4><span class="badge" style="background-color:#9f4c33;color:#FFF;font-size:16px;">'.number_format($fila['vlr_venta'], 2).'</span> </li>';
        }
    }
    // Se regresa la cadena de respuesta
    return $respuesta;
}

/* Calcula del Digito de Verificacion del Nit */
function calcularDV($nit)
{
    if (!is_numeric($nit)) {
        return false;
    }

    $arr = [1 => 3, 4 => 17, 7 => 29, 10 => 43, 13 => 59, 2 => 7, 5 => 19,
    8 => 37, 11 => 47, 14 => 67, 3 => 13, 6 => 23, 9 => 41, 12 => 53, 15 => 71];
    $x = 0;
    $y = 0;
    $z = strlen($nit);
    $dv = '';

    for ($i = 0; $i < $z; ++$i) {
        $y = substr($nit, $i, 1);
        $x += ($y * $arr[$z - $i]);
    }

    $y = $x % 11;

    if ($y > 1) {
        $dv = 11 - $y;
    // return $dv;
    } else {
        $dv = $y;
    }

    return $dv;
}

function numero_mov($tipo)
{
    switch ($tipo) {
        case 'E':
            break;

        case 'S':
            break;

        case 'A':
            break;

        default:
            break;
    }
}

function bodegas()
{
    $sqlbod = 'select * from bodegas order by nom_alma';
    $sql = mysqli_query($conn, $sqlbod);

    return $sql;
}

function numtoletras($xcifra)
{
    $xarray = [0 => 'Cero', 1 => 'UN', 'DOS', 'TRES', 'CUATRO', 'CINCO', 'SEIS', 'SIETE', 'OCHO', 'NUEVE', 'DIEZ', 'ONCE', 'DOCE', 'TRECE', 'CATORCE', 'QUINCE', 'DIECISEIS', 'DIECISIETE', 'DIECIOCHO', 'DIECINUEVE', 'VEINTI', 30 => 'TREINTA', 40 => 'CUARENTA', 50 => 'CINCUENTA', 60 => 'SESENTA', 70 => 'SETENTA', 80 => 'OCHENTA', 90 => 'NOVENTA', 100 => 'CIENTO', 200 => 'DOSCIENTOS', 300 => 'TRESCIENTOS', 400 => 'CUATROCIENTOS', 500 => 'QUINIENTOS', 600 => 'SEISCIENTOS', 700 => 'SETECIENTOS', 800 => 'OCHOCIENTOS', 900 => 'NOVECIENTOS'];
    $xcifra = trim($xcifra);
    $xlength = strlen($xcifra);
    $xpos_punto = strpos($xcifra, '.');
    $xaux_int = $xcifra;
    $xdecimales = '00';
    if (!($xpos_punto === false)) {
        if ($xpos_punto == 0) {
            $xcifra = '0'.$xcifra;
            $xpos_punto = strpos($xcifra, '.');
        }
        $xaux_int = substr($xcifra, 0, $xpos_punto); // obtengo el entero de la cifra a covertir
        $xdecimales = substr($xcifra.'00', $xpos_punto + 1, 2); // obtengo los valores decimales
    }

    $XAUX = str_pad($xaux_int, 18, ' ', STR_PAD_LEFT); // ajusto la longitud de la cifra, para que sea divisible por centenas de miles (grupos de 6)
    $xcadena = '';
    for ($xz = 0; $xz < 3; ++$xz) {
        $xaux = substr($XAUX, $xz * 6, 6);
        $xi = 0;
        $xlimite = 6; // inicializo el contador de centenas xi y establezco el límite a 6 dígitos en la parte entera
        $xexit = true; // bandera para controlar el ciclo del While
        while ($xexit) {
            if ($xi == $xlimite) { // si ya llegó al límite máximo de enteros
                break; // termina el ciclo
            }

            $x3digitos = ($xlimite - $xi) * -1; // comienzo con los tres primeros digitos de la cifra, comenzando por la izquierda
            $xaux = substr($xaux, $x3digitos, abs($x3digitos)); // obtengo la centena (los tres dígitos)
            for ($xy = 1; $xy < 4; ++$xy) { // ciclo para revisar centenas, decenas y unidades, en ese orden
                switch ($xy) {
                    case 1: // checa las centenas
                        if (substr($xaux, 0, 3) < 100) { // si el grupo de tres dígitos es menor a una centena ( < 99) no hace nada y pasa a revisar las decenas
                        } else {
                            $key = (int) substr($xaux, 0, 3);
                            if (true === array_key_exists($key, $xarray)) {  // busco si la centena es número redondo (100, 200, 300, 400, etc..)
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux); // devuelve el subfijo correspondiente (Millón, Millones, Mil o nada)
                                if (substr($xaux, 0, 3) == 100) {
                                    $xcadena = ' '.$xcadena.' CIEN '.$xsub;
                                } else {
                                    $xcadena = ' '.$xcadena.' '.$xseek.' '.$xsub;
                                }
                                $xy = 3; // la centena fue redonda, entonces termino el ciclo del for y ya no reviso decenas ni unidades
                            } else { // entra aquí si la centena no fue numero redondo (101, 253, 120, 980, etc.)
                                $key = (int) substr($xaux, 0, 1) * 100;
                                $xseek = $xarray[$key]; // toma el primer caracter de la centena y lo multiplica por cien y lo busca en el arreglo (para que busque 100,200,300, etc)
                                $xcadena = ' '.$xcadena.' '.$xseek;
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 0, 3) < 100)
                        break;
                    case 2: // checa las decenas (con la misma lógica que las centenas)
                        if (substr($xaux, 1, 2) < 10) {
                        } else {
                            $key = (int) substr($xaux, 1, 2);
                            if (true === array_key_exists($key, $xarray)) {
                                $xseek = $xarray[$key];
                                $xsub = subfijo($xaux);
                                if (substr($xaux, 1, 2) == 20) {
                                    $xcadena = ' '.$xcadena.' VEINTE '.$xsub;
                                } else {
                                    $xcadena = ' '.$xcadena.' '.$xseek.' '.$xsub;
                                }
                                $xy = 3;
                            } else {
                                $key = (int) substr($xaux, 1, 1) * 10;
                                $xseek = $xarray[$key];
                                if (20 == substr($xaux, 1, 1) * 10) {
                                    $xcadena = ' '.$xcadena.' '.$xseek;
                                } else {
                                    $xcadena = ' '.$xcadena.' '.$xseek.' Y ';
                                }
                            } // ENDIF ($xseek)
                        } // ENDIF (substr($xaux, 1, 2) < 10)
                        break;
                    case 3: // checa las unidades
                        if (substr($xaux, 2, 1) < 1) { // si la unidad es cero, ya no hace nada
                        } else {
                            $key = (int) substr($xaux, 2, 1);
                            $xseek = $xarray[$key]; // obtengo directamente el valor de la unidad (del uno al nueve)
                            $xsub = subfijo($xaux);
                            $xcadena = ' '.$xcadena.' '.$xseek.' '.$xsub;
                        } // ENDIF (substr($xaux, 2, 1) < 1)
                        break;
                } // END SWITCH
            } // END FOR
            $xi = $xi + 3;
        } // ENDDO

        if (substr(trim($xcadena), -5, 5) == 'ILLON') { // si la cadena obtenida termina en MILLON o BILLON, entonces le agrega al final la conjuncion DE
            $xcadena .= ' DE';
        }

        if (substr(trim($xcadena), -7, 7) == 'ILLONES') { // si la cadena obtenida en MILLONES o BILLONES, entoncea le agrega al final la conjuncion DE
            $xcadena .= ' DE';
        }

        // ----------- esta línea la puedes cambiar de acuerdo a tus necesidades o a tu país -------
        if (trim($xaux) != '') {
            switch ($xz) {
                case 0:
                    if (trim(substr($XAUX, $xz * 6, 6)) == '1') {
                        $xcadena .= 'UN BILLON ';
                    } else {
                        $xcadena .= ' BILLONES ';
                    }
                    break;
                case 1:
                    if (trim(substr($XAUX, $xz * 6, 6)) == '1') {
                        $xcadena .= 'UN MILLON ';
                    } else {
                        $xcadena .= ' MILLONES ';
                    }
                    break;
                case 2:
                    if ($xcifra < 1) {
                        $xcadena = "CERO PESOS $xdecimales/100 M.C.";
                    }
                    if ($xcifra >= 1 && $xcifra < 2) {
                        $xcadena = "UN PESO $xdecimales/100 M.C. ";
                    }
                    if ($xcifra >= 2) {
                        $xcadena .= " PESOS $xdecimales/100 M.C. ";
                    }
                    break;
            } // endswitch ($xz)
        } // ENDIF (trim($xaux) != "")
      // ------------------      en este caso, para México se usa esta leyenda     ----------------
        $xcadena = str_replace('VEINTI ', 'VEINTI', $xcadena); // quito el espacio para el VEINTI, para que quede: VEINTICUATRO, VEINTIUN, VEINTIDOS, etc
        $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
        $xcadena = str_replace('UN UN', 'UN', $xcadena); // quito la duplicidad
        $xcadena = str_replace('  ', ' ', $xcadena); // quito espacios dobles
        $xcadena = str_replace('BILLON DE MILLONES', 'BILLON DE', $xcadena); // corrigo la leyenda
        $xcadena = str_replace('BILLONES DE MILLONES', 'BILLONES DE', $xcadena); // corrigo la leyenda
        $xcadena = str_replace('DE UN', 'UN', $xcadena); // corrigo la leyenda
    } // ENDFOR ($xz)

    return trim($xcadena);
}

function subfijo($xx)
{
    $xx = trim($xx);
    $xstrlen = strlen($xx);
    if ($xstrlen == 1 || $xstrlen == 2 || $xstrlen == 3) {
        $xsub = '';
    }

    if ($xstrlen == 4 || $xstrlen == 5 || $xstrlen == 6) {
        $xsub = 'MIL';
    }

    return $xsub;
}

/***  The Backup_Database class ***/
class Backup_Database
{
    public $host;                      // /    * Host where the database is located
    public $username;                  // /    * Username used to connect to database
    public $passwd;                    // /    * Password used to connect to database
    public $dbName;                    // /    * Database to backup
    public $charset;                   // /    * Database charset
    public $conn;                      // /    * Database connection
    public $backupDir;                 // /    * Backup directory where backup files are stored
    public $backupFile;                // /    * Output backup file
    public $gzipBackupFile;            // /    * Use gzip compression on backup file
    public $output;                    // /    * Content of standard output
    public $disableForeignKeyChecks;   // /    * Disable foreign key checks
    public $batchSize;                 // /    * Batch size, number of rows to process per iteration

    /**
     * Constructor initializes database.
     */
    public function __construct($host, $username, $passwd, $dbName, $charset = 'utf8', $bckname)
    {
        $this->host = $host;
        $this->username = $username;
        $this->passwd = $passwd;
        $this->dbName = $dbName;
        $this->charset = $charset;
        $this->conn = $this->initializeDatabase();
        $this->backupDir = BACKUP_DIR ? BACKUP_DIR : '.';
        // / $this->backupFile              = 'myphp-backup-'.$this->dbName.'-'.date("Ymd_His", time()).'.sql';
        $this->backupFile = $bckname.'.sql';
        $this->gzipBackupFile = defined('GZIP_BACKUP_FILE') ? GZIP_BACKUP_FILE : true;
        $this->disableForeignKeyChecks = defined('DISABLE_FOREIGN_KEY_CHECKS') ? DISABLE_FOREIGN_KEY_CHECKS : true;
        $this->batchSize = defined('BATCH_SIZE') ? BATCH_SIZE : 1000; // default 1000 rows
        $this->output = '';
    }

    protected function initializeDatabase()
    {
        try {
            $conn = mysqli_connect($this->host, $this->username, $this->passwd, $this->dbName);
            if (mysqli_connect_errno()) {
                throw new Exception('ERROR connecting database: '.mysqli_connect_error());
                exit;
            }
            if (!mysqli_set_charset($conn, $this->charset)) {
                mysqli_query($conn, 'SET NAMES '.$this->charset);
            }
        } catch (Exception $e) {
            print_r($e->getMessage());
            exit;
        }

        return $conn;
    }

    /**
     * Backup the whole database or just some tables
     * Use '*' for whole database or 'table1 table2 table3...'.
     *
     * @param string $tables
     */
    public function backupTables($tables = '*')
    {
        try {
            /*
             * Tables to export
             */
            if ($tables == '*') {
                $tables = [];
                $result = mysqli_query($this->conn, 'SHOW TABLES');
                while ($row = mysqli_fetch_row($result)) {
                    $tables[] = $row[0];
                }
            } else {
                $tables = is_array($tables) ? $tables : explode(',', str_replace(' ', '', $tables));
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS `'.$this->dbName."`;\n\n";
            $sql .= 'USE `'.$this->dbName."`;\n\n";

            /*
             * Disable foreign key checks
             */
            if ($this->disableForeignKeyChecks === true) {
                $sql .= "SET foreign_key_checks = 0;\n\n";
            }

            /*
             * Iterate tables
             */
            foreach ($tables as $table) {
                $this->obfPrint('Backing up `'.$table.'` table...'.str_repeat('.', 50 - strlen($table)), 0, 0);

                /*
                 * CREATE TABLE
                 */
                $sql .= 'DROP TABLE IF EXISTS `'.$table.'`;';
                $row = mysqli_fetch_row(mysqli_query($this->conn, 'SHOW CREATE TABLE `'.$table.'`'));
                $sql .= "\n\n".$row[1].";\n\n";

                /**
                 * INSERT INTO.
                 */
                $row = mysqli_fetch_row(mysqli_query($this->conn, 'SELECT COUNT(*) FROM `'.$table.'`'));
                $numRows = $row[0];

              // Split table in batches in order to not exhaust system memory
                $numBatches = intval($numRows / $this->batchSize) + 1; // Number of while-loop calls to perform

                for ($b = 1; $b <= $numBatches; ++$b) {
                    $query = 'SELECT * FROM `'.$table.'` LIMIT '.($b * $this->batchSize - $this->batchSize).','.$this->batchSize;
                    $result = mysqli_query($this->conn, $query);
                    $realBatchSize = mysqli_num_rows($result); // Last batch size can be different from $this->batchSize
                    $numFields = mysqli_num_fields($result);

                    if ($realBatchSize !== 0) {
                        $sql .= 'INSERT INTO `'.$table.'` VALUES ';

                        for ($i = 0; $i < $numFields; ++$i) {
                            $rowCount = 1;
                            while ($row = mysqli_fetch_row($result)) {
                                $sql .= '(';
                                for ($j = 0; $j < $numFields; ++$j) {
                                    if (isset($row[$j])) {
                                        $row[$j] = addslashes($row[$j]);
                                        $row[$j] = str_replace("\n", '\\n', $row[$j]);
                                        $row[$j] = str_replace("\r", '\\r', $row[$j]);
                                        $row[$j] = str_replace("\f", '\\f', $row[$j]);
                                        $row[$j] = str_replace("\t", '\\t', $row[$j]);
                                        $row[$j] = str_replace("\v", '\\v', $row[$j]);
                                        $row[$j] = str_replace("\a", '\\a', $row[$j]);
                                        $row[$j] = str_replace("\b", '\\b', $row[$j]);
                                        if ($row[$j] == 'true' or $row[$j] == 'false' or preg_match('/^-?[0-9]+$/', $row[$j]) or $row[$j] == 'NULL' or $row[$j] == 'null') {
                                            $sql .= $row[$j];
                                        } else {
                                            $sql .= '"'.$row[$j].'"';
                                        }
                                    } else {
                                        $sql .= 'NULL';
                                    }

                                    if ($j < ($numFields - 1)) {
                                        $sql .= ',';
                                    }
                                }

                                if ($rowCount == $realBatchSize) {
                                    $rowCount = 0;
                                    $sql .= ");\n"; // close the insert statement
                                } else {
                                    $sql .= "),\n"; // close the row
                                }

                                ++$rowCount;
                            }
                        }

                        $this->saveFile($sql);
                        $sql = '';
                    }
                }

                /*
                 * CREATE TRIGGER
                 */

                // Check if there are some TRIGGERS associated to the table
                /*$query = "SHOW TRIGGERS LIKE '" . $table . "%'";
                $result = mysqli_query ($this->conn, $query);
                if ($result) {
                    $triggers = array();
                    while ($trigger = mysqli_fetch_row ($result)) {
                        $triggers[] = $trigger[0];
                    }

                    // Iterate through triggers of the table
                    foreach ( $triggers as $trigger ) {
                        $query= 'SHOW CREATE TRIGGER `' . $trigger . '`';
                        $result = mysqli_fetch_array (mysqli_query ($this->conn, $query));
                        $sql.= "\nDROP TRIGGER IF EXISTS `" . $trigger . "`;\n";
                        $sql.= "DELIMITER $$\n" . $result[2] . "$$\n\nDELIMITER ;\n";
                    }

                    $sql.= "\n";

                    $this->saveFile($sql);
                    $sql = '';
                }*/

                $sql .= "\n\n";

                $this->obfPrint('OK');
            }

            /*
             * Re-enable foreign key checks
             */
            if ($this->disableForeignKeyChecks === true) {
                $sql .= "SET foreign_key_checks = 1;\n";
            }

            $this->saveFile($sql);

            if ($this->gzipBackupFile) {
                $this->gzipBackupFile();
            } else {
                $this->obfPrint('Backup file succesfully saved to '.$this->backupDir.'/'.$this->backupFile, 1, 1);
            }
        } catch (Exception $e) {
            print_r($e->getMessage());

            return false;
        }

        return true;
    }

    /**
     * Save SQL to file.
     *
     * @param string $sql
     */
    protected function saveFile(&$sql)
    {
        if (!$sql) {
            return false;
        }

        try {
            if (!file_exists($this->backupDir)) {
                mkdir($this->backupDir, 0777, true);
            }

            file_put_contents($this->backupDir.'/'.$this->backupFile, $sql, FILE_APPEND | LOCK_EX);
        } catch (Exception $e) {
            print_r($e->getMessage());

            return false;
        }

        return true;
    }

    /*
     * Gzip backup file
     *
     * @param integer $level GZIP compression level (default: 9)
     * @return string New filename (with .gz appended) if success, or false if operation fails
     */
    protected function gzipBackupFile($level = 9)
    {
        if (!$this->gzipBackupFile) {
            return true;
        }

        $source = $this->backupDir.'/'.$this->backupFile;
        $dest = $source.'.gz';

        $this->obfPrint('Gzipping backup file to '.$dest.'... ', 1, 0);

        $mode = 'wb'.$level;
        if ($fpOut = gzopen($dest, $mode)) {
            if ($fpIn = fopen($source, 'rb')) {
                while (!feof($fpIn)) {
                    gzwrite($fpOut, fread($fpIn, 1024 * 256));
                }
                fclose($fpIn);
            } else {
                return false;
            }
            gzclose($fpOut);
            if (!unlink($source)) {
                return false;
            }
        } else {
            return false;
        }

        $this->obfPrint('OK');

        return $dest;
    }

    /**
     * Prints message forcing output buffer flush.
     */
    public function obfPrint($msg = '', $lineBreaksBefore = 0, $lineBreaksAfter = 1)
    {
        if (!$msg) {
            return false;
        }

        if ($msg != 'OK' and $msg != 'KO') {
            $msg = date('Y-m-d H:i:s').' - '.$msg;
        }
        $output = '';

        if (php_sapi_name() != 'cli') {
            $lineBreak = '<br />';
        } else {
            $lineBreak = "\n";
        }

        if ($lineBreaksBefore > 0) {
            for ($i = 1; $i <= $lineBreaksBefore; ++$i) {
                $output .= $lineBreak;
            }
        }

        $output .= $msg;

        if ($lineBreaksAfter > 0) {
            for ($i = 1; $i <= $lineBreaksAfter; ++$i) {
                $output .= $lineBreak;
            }
        }

        // Save output for later use
        $this->output .= str_replace('<br />', '\n', $output);

        // / echo $output;

        if (php_sapi_name() != 'cli') {
            if (ob_get_level() > 0) {
                ob_flush();
            }
        }

        $this->output .= ' ';

        flush();
    }

    /**
     * Returns full execution output.
     */
    public function getOutput()
    {
        return $this->output;
    }
}

?>

