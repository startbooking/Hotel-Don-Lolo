
 <?php
    require_once 'init.php';
    date_default_timezone_set('America/Bogota');

    class Hotel_Admin
    {

    public function interfacePMS(){
        global $database;

        $data = $database->query("SELECT
            interfacePMS.id, 
            ambientes.nombre, 
            impuestos.descripcion_cargo AS descripcion_impto, 
            codigos_vta.descripcion_cargo, 
            interfacePMS.tipo_codigo
        FROM
            interfacePMS
            INNER JOIN
            codigos_vta AS impuestos
            ON 
                interfacePMS.id_codigo = impuestos.id_cargo
            INNER JOIN
            codigos_vta
            ON 
                interfacePMS.id_codigo_pms = codigos_vta.id_cargo
            INNER JOIN
            ambientes
            ON 
                interfacePMS.id_ambiente = ambientes.id_ambiente
        ORDER BY
            ambientes.nombre")->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }

        public function eliminaRetencion($id)
        {
            global $database;

            $data = $database->delete('retenciones', [
                'idRetencion' => $id,
            ]);
            return $data->rowCount();
        }

        public function updateRetencion($idImptoModImp, $nombreModImp, $porcentajeModImp, $baseReteUpd, $tipoReteUpd, $imptoDianUpd, $pucModImp)
        {
            global $database;

            $data = $database->update('retenciones', [
                'descripcionRetencion' => $nombreModImp,
                'porcentajeRetencion' => $porcentajeModImp,
                'baseRetencion' => $baseReteUpd,
                'tipoRetencion' => $tipoReteUpd,
                'codigoPuc' => $pucModImp,
                'feCode' => $imptoDianUpd,
            ], [
                'idRetencion' => $idImptoModImp,
            ]);
            return $data->rowCount();
        }

        public function insertRetencion($nombreAdi, $porcentaje, $baseRete, $tipoRete, $imptoDian, $pucAdi)
        {
            global $database;

            $data = $database->insert('retenciones', [
                'descripcionRetencion' => $nombreAdi,
                'porcentajeRetencion' => $porcentaje,
                'baseRetencion' => $baseRete,
                'tipoRetencion' => $tipoRete,
                'codigoPuc' => $pucAdi,
                'estado' => 1,
                'feCode' => $imptoDian,
            ]);
            $result = [
                'id' => $database->id(),
                'error' => $database->errorInfo,
            ];

            return $result;
        }

        public function getRetenciones()
        {
            global $database;

            $data = $database->select('retenciones', [
                '[>]dianImpuestos' => ['feCode' => 'id']
            ], [
                'retenciones.idRetencion',
                'retenciones.idCargo',
                'retenciones.descripcionRetencion',
                'retenciones.porcentajeRetencion',
                'retenciones.baseRetencion',
                'retenciones.codigo',
                'retenciones.procedimiento',
                'retenciones.filtroRetenciones',
                'retenciones.tipoRetencion',
                'retenciones.codigoPuc',
                'retenciones.estado',
                'retenciones.feCode',
                'dianImpuestos.name',
            ]);
            return $data;
        }
        public function resolucionesActivas()
        {
            global $database;

            $data = $database->count('resoluciones', [
                'AND' => ['estado' => 1]
            ]);
            return $data;
        }

        public function cambiaEstado($id, $cambio)
        {
            global $database;

            $data = $database->update('resoluciones', [
                'estado' => $cambio,
            ], [
                'id' => $id
            ]);

            $result = [
                'id' => $data->rowCount(),
                'error' => $database->errorInfo,
            ];

            return $result;
            // return $data;

        }

        public function insertResolucion($resol, $desde, $hasta, $prefijo, $fecha, $tipo, $vigencia)
        {
            global $database;

            $data = $database->insert('resoluciones', [
                'resolucion' => $resol,
                'fecha' => $fecha,
                'prefijo' => $prefijo,
                'desde' => $desde,
                'hasta' => $hasta,
                'estado' => 2,
                'tipo' => $tipo,
                'modulo' => 1,
                'tipoDocumento' => 1,
                'vigencia' => $vigencia,
            ]);
            $result = [
                'id' => $database->id(),
                'error' => $database->errorInfo,
            ];
            return $result;
        }

        public function updateResolucion($resol, $desde, $hasta, $prefijo, $fecha, $tipo, $vigencia, $id)
        {
            global $database;

            $data = $database->update('resoluciones', [
                'resolucion' => $resol,
                'fecha' => $fecha,
                'prefijo' => $prefijo,
                'desde' => $desde,
                'hasta' => $hasta,
                'estado' => 2,
                'tipo' => $tipo,
                'modulo' => 1,
                'tipoDocumento' => 1,
                'vigencia' => $vigencia,
            ], [
                'id' => $id
            ]);
            $result = [
                'id' => $data->rowCount(),
                'error' => $database->errorInfo,
            ];
            return $result;
        }

        public function eliminaResolucion($id)
        {
            global $database;

            $data = $database->delete('resoluciones', [
                'id' => $id,
            ]);
            return $data->rowCount();
        }
        public function traeMediosPago()
        {
            global $database;

            $data = $database->select('dianMediosPago', [
                'id',
                'name',
            ], [
                'ORDER' => ['name' => 'ASC']
            ]);
            return $data;
        }

        public function impuestosDian()
        {
            global $database;

            $data = $database->select('dianImpuestos', [
                'id',
                'name',
                'code',
            ], [
                'ORDER' => ['name' => 'ASC']
            ]);
            return $data;
        }

        public function traePorceImpto($codigo)
        {
            global $database;

            $data = $database->get('codigos_vta', [
                'porcentaje_impto'
            ], [
                'id_cargo' => $codigo
            ]);
            return $data['porcentaje_impto'];
        }

        public function unidades_medida()
        {
            global $database;

            $data = $database->select('dianUnidades', [
                'id',
                'name'
            ], [
                'ORDER' => ['name' => 'ASC']
            ]);
            return $data;
        }

        public function eliminaMesa($idmesa)
        {
            global $database;

            $data = $database->delete('mesas', [
                'id' => $idmesa
            ]);
            return $data->rowCount();
        }

        public function updateMesa($idmesa, $idambi, $mesa, $pers)
        {
            global $database;

            $data = $database->update('mesas', [
                'ambiente'    => $idambi,
                'numero_mesa' => $mesa,
                'puestos'     => $pers
            ], [
                'id' => $idmesa
            ]);
            return $data->rowCount();
        }

        public function insertMesa($idambi, $mesa, $pers)
        {
            global $database;

            $data = $database->insert('mesas', [
                'ambiente'    => $idambi,
                'numero_mesa' => $mesa,
                'puestos'     => $pers,
                'flag'        => 0,
                'estado'      => 'L'
            ]);
            return $database->id();
        }

        public function getMesasAmbiente()
        {
            global $database;

            $data = $database->select('mesas', [
                '[>]ambientes' => ['ambiente' => 'id_ambiente']
            ], [
                'ambientes.id_ambiente',
                'ambientes.nombre',
                'mesas.numero_mesa',
                'mesas.puestos',
                'mesas.id'
            ], [
                'ORDER' => [
                    'ambientes.nombre' => 'ASC',
                    'mesas.numero_mesa' => 'ASC'
                ]
            ]);
            return $data;
        }

        public function getResoluciones($id)
        {
            global $database;

            $data = $database->select('resoluciones', [
                'id',
                'idDocumento',
                'resolucion',
                'fecha',
                'prefijo',
                'desde',
                'hasta',
                'estado',
                'tipo',
                'ambiente',
                'id_ambiente',
                'claveTecnica',
                'tipoDocumento',
                'modulo',
                'vigencia',
            ], [
                'modulo' => $id,
                'ORDER' => ['fecha' => 'DESC']
            ]);
            return $data;
        }

        public function actualizaInfoFactura($idHotel, $tituloFac, $infoBanco, $infoFact, $infoPie)
        {
            global $database;

            $data = $database->update('parametros_pms', [
                'actividad' => $tituloFac,
                'info_banco' => $infoBanco,
                'info_factura' => $infoFact,
                'info_pie' => $infoPie,
            ], [
                'id' => $idHotel,
            ]);
            return  $data->rowCount();
        }

        public function getInfoTextosFacturaHotel()
        {
            global $database;

            $data = $database->select('parametros_pms', [
                'actividad',
                'info_banco',
                'info_factura',
                'info_pie'

            ]);
            return $data;
        }


        public function insertCiudad($paices, $ciudad, $codigo)
        {
            global $database;

            $data = $database->insert('ciudades', [
                'id_pais' => $paices,
                'codigo' => $codigo,
                'municipio' => $ciudad,
            ]);
            return $database->id();
        }

        public function getCiudades()
        {
            global $database;

            $data = $database->select('ciudades', [
                '[>]paices' => ['id_pais' => 'id_pais']
            ], [
                'paices.descripcion',
                'ciudades.municipio',
                'ciudades.codigo',
                'ciudades.id_ciudad',
            ], [
                'ORDER' => [
                    'paices.descripcion' => 'ASC',
                    'ciudades.municipio' => 'ASC'
                ]
            ]);
            return $data;
        }

        public function activaAmbiente($ambiente, $estado)
        {
            global $database;

            $data = $database->update('ambientes', [
                'active_at' => $estado,
            ], [
                'id_ambiente' => $ambiente,
            ]);

            return $data->rowCount();
        }

        public function updateFormaPagoPos($descripcion, $puc, $contabil, $id, $pms)
        {
            global $database;

            $data = $database->update('formas_pago', [
                'descripcion' => $descripcion,
                'cuenta_puc' => $puc,
                'descripcion_contable' => $contabil,
                'pms' => $pms,
            ], [
                'id_pago' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaFormaPagoPos($id)
        {
            global $database;

            $data = $database->delete('formas_pago', [
                'id_pago' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertFormaPagoPos($descripcion, $puc, $contabil, $pms)
        {
            global $database;

            $data = $database->insert('formas_pago', [
                'descripcion' => $descripcion,
                'cuenta_puc' => $puc,
                'descripcion_contable' => $contabil,
                'pms' => $pms,
            ]);

            return $database->id();
        }

        public function getFormasPagoPos()
        {
            global $database;

            $data = $database->select('formas_pago', [
                'id_pago',
                'descripcion',
                'cuenta_puc',
                'descripcion_contable',
                'pms',
            ], [
                'ORDER' => 'descripcion',
            ]);

            return $data;
        }

        public function getInfoCia()
        {
            global $database;

            $data = $database->get('empresas', [
                '[>]paices' => ['pais' => 'id_pais'],
                '[>]ciudades' => ['ciudad' => 'id_ciudad'],
                '[>]tipo_cia' => ['tipo_empresa' => 'id_tipo_cia'],
            ],[
                'empresas.empresa',
                'empresas.nit',
                'empresas.dv',
                'empresas.conMod',
                'empresas.invMod',
                'empresas.comMod',
                'empresas.cxpMod',
                'empresas.cxcMod',
                'empresas.posMod',
                'empresas.tarMod',
                'empresas.pmsMod',
                'empresas.resMod',
                'empresas.feMod',
                'empresas.direccion',
                'empresas.pais',
                'empresas.ciudad',
                'empresas.celular',
                'empresas.telefonos',
                'empresas.web',
                'empresas.correo',
                'empresas.logo',
                'empresas.xlogo',
                'empresas.ylogo',
                'empresas.tlogo',
                'empresas.codigo_ciiu',
                'empresas.rnt',
                'empresas.impto_incl',
                'empresas.cms',
                'empresas.ip_acceso',
                'empresas.codigo_ciiu',
                'empresas.tipo_empresa',
                'paices.descripcion',
                'ciudades.municipio',
                'tipo_cia.descripcion(tipoEmpresa)'
            ]);

            return $data;
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

        public function activaEquipo($id, $tipo)
        {
            global $database;

            $data = $database->update('accesos', [
                'actived_at' => $tipo,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaEquipo($id)
        {
            global $database;

            $data = $database->delete('accesos', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateEquipo($id, $equipo, $descrip)
        {
            global $database;

            $data = $database->update('accesos', [
                'direccion' => $equipo,
                'descripcion' => $descrip,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id' => $id,
            ]);

            return $database->id();
        }

        public function insertEquipo($equipo, $descrip)
        {
            global $database;

            $data = $database->insert('accesos', [
                'direccion' => $equipo,
                'descripcion' => $descrip,
                'actived_at' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function updateCia($empresa, $nit, $dv, $direcc, $ciudad, $web, $email, $tele, $celu, $rnt, $impto, $logo, $ciiu, $tipoEmp)
        {
            global $database;

            $data = $database->update('empresas', [
                'empresa' => $empresa,
                'nit' => $nit,
                'dv' => $dv,
                'direccion' => $direcc,
                'ciudad' => $ciudad,
                'celular' => $celu,
                'telefonos' => $tele,
                'web' => $web,
                'correo' => $email,
                'logo' => $logo,
                'rnt' => $rnt,
                'impto_incl' => $impto,
                'codigo_ciiu' => $ciiu,
                'tipo_empresa' => $tipoEmp,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            $result = [
                'id' => $data->rowCount(),
                'error' => $database->errorInfo,
            ];

            return $result;
        }

        public function getAccesoDirecciones()
        {
            global $database;

            $data = $database->select('accesos', [
                'id',
                'direccion',
                'descripcion',
                'actived_at',
            ], [
                'deleted_at' => null,
            ]);

            return $data;
        }

        /* Usuarios Sistema */
        public function updateUserNew($apellidos, $nombres, $identificacion, $correo, $telefono, $celular, $tipo, $idPos, $idPMS, $idInv, $id)
        {
            global $database;

            $data = $database->update('usuarios', [
                'identificacion' => $identificacion,
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'telefono' => $telefono,
                'celular' => $celular,
                'tipo' => $tipo,
                'pos' => $idPos,
                'pms' => $idPMS,
                'inv' => $idInv,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'usuario_id' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertUserNew($usuario, $claveIn, $apellidos, $nombres, $identificacion, $correo, $telefono, $celular, $tipo, $idPos, $idPMS, $idInv, $idFe, $idUsr)
        {
            global $database;

            $data = $database->insert('usuarios', [
                'identificacion' => $identificacion,
                'estado' => '1',
                'nombres' => $nombres,
                'apellidos' => $apellidos,
                'correo' => $correo,
                'telefono' => $telefono,
                'celular' => $celular,
                'usuario' => $usuario,
                'password' => $claveIn,
                'tipo' => $tipo,
                'inv' => $idInv,
                'pos' => $idPos,
                'pms' => $idPMS,
                'fe' => $idFe,
                'idUsuarioCrea' => $idUsr,
            ]);

            //  return $database->id();
            $result = [
                'id' => $database->id(),
                'error' => $database->errorInfo,
            ];

            return $result;
        }

        public function getUsuariosSistema()
        {
            global $database;

            $data = $database->select('usuarios', [
                'usuario_id',
                'usuario',
                'apellidos',
                'nombres',
                'identificacion',
                'correo',
                'estado',
                'telefono',
                'celular',
                'tipo',
                'pos',
                'inv',
                'pms',
                'foto_usuario',
            ]);

            return $data;
        }

        /* Impuestos del Sistema */
        public function updateImpuesto($descripcion, $porcentaje, $tipo, $puc, $contabil, $id, $dian)
        {
            global $database;

            $data = $database->update('codigos_vta', [
                'descripcion_cargo' => $descripcion,
                'porcentaje_impto' => $porcentaje,
                'tipo_impto' => $tipo,
                'cuenta_puc' => $puc,
                'descripcion_contable' => $contabil,
                'identificador_dian' => $dian,
                'tipo_codigo' => 2,
            ], [
                'id_cargo' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaImpuesto($id)
        {
            global $database;

            $data = $database->delete('codigos_vta', [
                'id_cargo' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertImpuesto($descripcion, $porcentaje, $tipo, $puc, $contabil, $dian)
        {
            global $database;

            $data = $database->insert('codigos_vta', [
                'descripcion_cargo' => $descripcion,
                'porcentaje_impto' => $porcentaje,
                'tipo_impto' => $tipo,
                'cuenta_puc' => $puc,
                'descripcion_contable' => $contabil,
                'identificador_dian' => $dian,
                'tipo_codigo' => 2,
                'restringido' => 0,
            ]);

            return $database->id();
        }

        public function getPorcentajeImpto($id)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'porcentaje_impto',
            ], [
                'id_cargo' => $id,
            ]);

            return $data[0]['porcentaje_impto'];
        }

        public function getDescriptionImpto($id)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'descripcion_cargo',
            ], [
                'id_cargo' => $id,
            ]);
            if (count($data) == 0) {
                return '';
            } else {
                return $data[0]['descripcion_cargo'];
            }
        }

        /* FUNCIONES PARAMETROS INVENTARIOS */
        /* Tipos de Movimientos Inventarios */
        public function updateTipoMovi($id, $descrip, $tipo, $compra, $ajuste, $traslado)
        {
            global $database;

            $data = $database->update('tipo_movimiento_inventario', [
                'descripcion_tipo' => $descrip,
                'tipo' => $tipo,
                'compra' => $compra,
                'ajuste' => $ajuste,
                'traslado' => $traslado,
            ], [
                'id_tipomovi' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaTipoMovi($id)
        {
            global $database;

            $data = $database->delete('tipo_movimiento_inventario', [
                'id_tipomovi' => $id,
            ]);

            return $database->id();
        }

        public function inserTipoMovi($descrip, $tipo, $compra, $ajuste, $traslado)
        {
            global $database;

            $data = $database->insert('tipo_movimiento_inventario', [
                'descripcion_tipo' => $descrip,
                'tipo' => $tipo,
                'compra' => $compra,
                'ajuste' => $ajuste,
                'traslado' => $traslado,
            ]);

            return $database->id();
        }

        public function getTipoMovimientos()
        {
            global $database;

            $data = $database->select('tipo_movimiento_inventario', [
                'id_tipomovi',
                'descripcion_tipo',
                'tipo',
                'ajuste',
                'traslado',
                'compra',
                'ordenes',
                'remisiones',
                'proveedor',
                'venta',
                'cierre',
            ]);

            return $data;
        }

        /* Unidades de Medida Inventarios */
        public function eliminaUnidad($id)
        {
            global $database;

            $data = $database->delete('unidades', [
                'id_unidad' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateUnidad($id, $descrip)
        {
            global $database;

            $data = $database->update('unidades', [
                'descripcion_unidad' => $descrip,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_unidad' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertUnidad($descrip)
        {
            global $database;

            $data = $database->insert('unidades', [
                'descripcion_unidad' => $descrip,
                'act_unid' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function getUnidadesMedida()
        {
            global $database;

            $data = $database->select('unidades', [
                'id_unidad',
                'descripcion_unidad',
            ]);

            return $data;
        }

        /* Centros de Costo Inventarios */
        public function eliminaCentro($id)
        {
            global $database;

            $data = $database->delete('centrocosto', [
                'id_centrocosto' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateCentro($descripcion, $depto, $costo, $gasto, $id)
        {
            global $database;

            $data = $database->update('centrocosto', [
                'descripcion_centro' => $descripcion,
                'id_depto' => $depto,
                'puc1_costo' => $costo,
                'puc1_gasto' => $gasto,
            ], [
                'id_centrocosto' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertCentro($descripcion, $depto, $costo, $gasto)
        {
            global $database;

            $data = $database->insert('centrocosto', [
                'descripcion_centro' => $descripcion,
                'id_depto' => $depto,
                'puc1_costo' => $costo,
                'puc1_gasto' => $gasto,
            ]);

            return $database->id();
        }

        public function getCentroCosto($code)
        {
            global $database;

            $data = $database->select('centrocosto', [
                'descripcion_centro',
            ], [
                'id_centrocosto' => $code,
            ]);
            if (count($data) == 0) {
                return 'Sin Cento de Costo Asociado';
            } else {
                return $data[0]['descripcion_centro'];
            }
        }

        public function getCentrosCosto()
        {
            global $database;

            $data = $database->select('centrocosto', [
                'id_centrocosto',
                'id_depto',
                'descripcion_centro',
                'puc1_costo',
                'puc2_costo',
                'puc1_gasto',
                'puc2_gasto',
                'centroContable',
            ], [
                'ORDER' => ['descripcion_centro' => 'ASC'],
            ]);

            return $data;
        }

        /* Conversiones de Medidad de Inventarios */
        public function updateConversion($id, $unidad, $conversion, $valor)
        {
            global $database;

            $data = $database->update('conversiones', [
                'id_unidad' => $unidad,
                'id_conversion' => $conversion,
                'valor_conversion' => $valor,
            ], [
                'id' => $id,
            ]);

            return $database->id();
        }

        public function eliminaConversion($id)
        {
            global $database;

            $data = $database->delete('conversiones', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function getConversion($unidad)
        {
            global $database;

            $data = $database->select('unidades', [
                'descripcion_unidad',
            ], [
                'id_unidad' => $unidad,
            ]);

            return $data[0]['descripcion_unidad'];
        }

        public function insertConversion($unidad, $conversion, $valor)
        {
            global $database;

            $data = $database->insert('conversiones', [
                'id_unidad' => $unidad,
                'id_conversion' => $conversion,
                'valor_conversion' => $valor,
            ]);

            return $database->id();
        }

        public function getConversionesUnidades()
        {
            global $database;

            $data = $database->select('conversiones', [
                '[>]unidades' => 'id_unidad',
            ], [
                'conversiones.id',
                'unidades.descripcion_unidad',
                'conversiones.id_conversion',
                'conversiones.id_unidad',
                'conversiones.valor_conversion',
            ], [
                'ORDER' => 'unidades.descripcion_unidad',
            ]);

            return $data;
        }

        /* Bodegas De Almacenamiento Inventarios */
        public function eliminaBodega($id)
        {
            global $database;

            $data = $database->delete('bodegas', [
                'id_bodega' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateBodega($id, $bodega, $tipo)
        {
            global $database;

            $data = $database->update('bodegas', [
                'descripcion_bodega' => $bodega,
                'tipo_bodega' => $tipo,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_bodega' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertBodega($bodega, $tipo)
        {
            global $database;

            $data = $database->insert('bodegas', [
                'descripcion_bodega' => $bodega,
                'tipo_bodega' => $tipo,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function getBodegas()
        {
            global $database;

            $data = $database->select('bodegas', [
                'id_bodega',
                'descripcion_bodega',
                'tipo_bodega',
            ], [
                'ORDER' => ['tipo_bodega' => 'ASC'],
            ]);

            return $data;
        }

        public function getNombreBodega($code)
        {
            global $database;

            $data = $database->select('bodegas', [
                'descripcion_bodega',
            ], [
                'id_bodega' => $code,
            ]);
            if (count($data) == 0) {
                return 'Sin Bodega Asociada';
            } else {
                return $data[0]['descripcion_bodega'];
            }
        }

        /* Grupos de Inventarios */
        public function eliminaGrupo($id)
        {
            global $database;

            $data = $database->delete('grupos_inventarios', [
                'id_grupo' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateGrupoInv($id, $familia, $grupo)
        {
            global $database;

            $data = $database->update('grupos_inventarios', [
                'id_familia' => $familia,
                'descripcion_grupo' => $grupo,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_grupo' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertGrupoInv($id, $grupo)
        {
            global $database;

            $data = $database->insert('grupos_inventarios', [
                'descripcion_grupo' => $grupo,
                'id_familia' => $id,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function traeGrupoInventarios($id)
        {
            global $database;

            $data = $database->select('grupos_inventarios', [
                'id_grupo',
                'id_familia',
                'descripcion_grupo',
            ], [
                'id_grupo' => $id,
            ]);

            return $data;
        }

        public function getGruposInventarios()
        {
            global $database;

            $data = $database->select('grupos_inventarios', [
                'id_grupo',
                'id_familia',
                'descripcion_grupo',
            ], [
                'deleted_at' => null,
                'ORDER' => ['descripcion_grupo' => 'ASC'],
            ]);

            return $data;
        }

        /* Familias de Inventarios */
        public function getGruposFamilia($id)
        {
            global $database;

            $data = $database->select('grupos_inventarios', [
                'id_grupo',
                'descripcion_grupo',
            ], [
                'id_familia' => $id,
                'ORDER' => 'descripcion_grupo',
            ]);

            return $data;
        }

        public function getDescriptionFamilia($id)
        {
            global $database;

            $data = $database->select('familia_inventarios', [
                'descripcion_familia',
            ], [
                'id_familia' => $id,
            ]);
            if (count($data) == 0) {
                return '';
            } else {
                return $data[0]['descripcion_familia'];
            }
        }

        public function getFamiliasInventarios()
        {
            global $database;

            $data = $database->select('familia_inventarios', [
                'id_familia',
                'descripcion_familia',
            ], [
                'deleted_at' => null,
                'ORDER' => ['descripcion_familia' => 'ASC'],
            ]);

            return $data;
        }

        public function updateFamilia($familia, $id)
        {
            global $database;

            $data = $database->update('familia_inventarios', [
                'descripcion_familia' => $familia,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_familia' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertFamilia($familia)
        {
            global $database;

            $data = $database->insert('familia_inventarios', [
                'descripcion_familia' => $familia,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function eliminaFamilia($id)
        {
            global $database;

            $data = $database->update('familia_inventarios', [
                'deleted_at' => date('Y-m-d H:i:s'),
            ], [
                'id_familia' => $id,
            ]);

            return $data->rowCount();
        }

        /* SubGrupos de Inventarios */
        public function getSubGruposInventarios()
        {
            global $database;

            $data = $database->select('subgrupos_inventarios', [
                '[>]grupos_inventarios' => 'id_grupo',
            ], [
                'grupos_inventarios.id_familia',
                'grupos_inventarios.descripcion_grupo',
                'subgrupos_inventarios.descripcion_subgrupo',
                'grupos_inventarios.id_familia',
                'subgrupos_inventarios.id_grupo',
                'subgrupos_inventarios.id_subgrupo',
            ], [
                'ORDER' => 'grupos_inventarios.descripcion_grupo',
            ]);

            return $data;
        }

        public function insertSubgrupo($id, $grupo, $subgrupo)
        {
            global $database;

            $data = $database->insert('subgrupos_inventarios', [
                'descripcion_subgrupo' => $subgrupo,
                'id_grupo' => $grupo,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function actualizaSubgrupo($id, $familia, $grupo, $subgrupo)
        {
            global $database;

            $data = $database->update('subgrupos_inventarios', [
                'descripcion_subgrupo' => $subgrupo,
                'id_grupo' => $grupo,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_subgrupo' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaSubgrupo($id)
        {
            global $database;

            $data = $database->delete('subgrupos_inventarios', [
                'id_subgrupo' => $id,
            ]);

            return $data->rowCount();
        }

        /* FUNCIONES PARAMETROS PUNTOS DE VENTA */
        /* Periodos de Servicio */
        public function getPeriodos()
        {
            global $database;

            $data = $database->select('periodosServicio', [
                '[>]ambientes' => ['id_ambiente'],
            ], [
                'ambientes.nombre',
                'id_periodo',
                'descripcion_periodo',
                'desde_hora',
                'hasta_hora',
                'id_ambiente',
            ]);

            return $data;
        }

        public function insertPeriodo($periodo, $ambi, $desde, $hasta)
        {
            global $database;

            $data = $database->insert('periodosServicio', [
                'descripcion_periodo' => $periodo,
                'desde_hora' => $desde,
                'hasta_hora' => $hasta,
                'id_ambiente' => $ambi,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function updatePeriodo($id, $periodo, $ambi, $desde, $hasta)
        {
            global $database;

            $data = $database->update('periodosServicio', [
                'descripcion_periodo' => $periodo,
                'desde_hora' => $desde,
                'hasta_hora' => $hasta,
                'id_ambiente' => $ambi,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_periodo' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaPeriodo($id)
        {
            global $database;

            $data = $database->delete('periodosServicio', [
                'id_periodo' => $id,
            ]);

            return $data->rowCount();
        }

        public function actualizaPeriodo($id, $descr, $ambi, $porce)
        {
            global $database;

            $data = $database->update('periodosServicio', [
                'descripcion_periodo' => $descr,
                'desde_hora' => $desde_fecha,
                'hasta_hora' => $hasta,
                'id_ambiente' => $ambi,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_periodo' => $id,
            ]);

            return $data->rowCount();
        }

        /* Descuentos */
        public function getDescuentos()
        {
            global $database;

            $data = $database->select('descuentos_pos', [
                '[>]ambientes' => ['id_ambiente'],
            ], [
                'ambientes.nombre',
                'id_descuento',
                'descripcion_descuento',
                'porcentaje',
                'hora_inicio',
                'hora_final',
                'lunes',
                'martes',
                'miercoles',
                'jueves',
                'viernes',
                'sabado',
                'domingo',
                'id_ambiente',
                'actived_at',
            ]);

            return $data;
        }

        public function activaDescuento($id, $tipo)
        {
            global $database;

            $data = $database->update('descuentos_pos', [
                'actived_at' => $tipo,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_descuento' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertDescuento($descr, $ambi, $porce)
        {
            global $database;

            $data = $database->insert('descuentos_pos', [
                'descripcion_descuento' => $descr,
                'porcentaje' => $porce,
                'id_ambiente' => $ambi,
                'actived_at' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function eliminaDescuento($id)
        {
            global $database;

            $data = $database->delete('descuentos_pos', [
                'id_descuento' => $id,
            ]);

            return $data->rowCount();
        }

        public function actualizaDescuento($id, $descr, $ambi, $porce)
        {
            global $database;

            $data = $database->update('descuentos_pos', [
                'descripcion_descuento' => $descr,
                'porcentaje' => $porce,
                'id_ambiente' => $ambi,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_descuento' => $id,
            ]);

            return $data->rowCount();
        }

        /* Ambientes POS */
        public function eliminaAmbiente($id)
        {
            global $database;

            $data = $database->delete('ambientes', [
                'id_ambiente' => $id,
            ]);

            return $data->rowCount();
        }

        public function actualizaAmbiente($id, $ambiente, $prefijo, $impto, $factura, $orden, $comanda, $venta, $propina, $bodega, $centro, $logo)
        {
            global $database;

            $data = $database->update('ambientes', [
                'nombre' => $ambiente,
                'id_centrocosto' => $centro,
                'prefijo' => $prefijo,
                'impuesto' => $impto,
                'conc_factura' => $factura,
                'conc_orden' => $orden,
                'conc_comanda' => $comanda,
                'codigo_venta' => $venta,
                'codigo_propina' => $propina,
                'id_bodega' => $bodega,
                'logo' => $logo,
                'active_at' => 1,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_ambiente' => $id,
            ]);

            return $data->rowCount();
        }

        public function adicionaAmbiente($ambiente, $prefijo, $impto, $factura, $orden, $comanda, $venta, $propina, $bodega, $centro, $logo, $fechaaud)
        {
            global $database;

            $data = $database->insert('ambientes', [
                'nombre' => $ambiente,
                'id_centrocosto' => $centro,
                'prefijo' => $prefijo,
                'impuesto' => $impto,
                'conc_factura' => $factura,
                'conc_orden' => $orden,
                'conc_comanda' => $comanda,
                'codigo_venta' => $venta,
                'codigo_propina' => $propina,
                'id_bodega' => $bodega,
                'logo' => $logo,
                'fecha_auditoria' => $fechaaud,
                'active_at' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            return $database->id();
        }

        public function getNombreAmbiente($code)
        {
            global $database;

            $data = $database->select('ambientes', [
                'nombre',
            ], [
                'id_ambiente' => $code,
            ]);
            if (count($data) == 0) {
                return 'Sin Ambiente Asociado';
            } else {
                return $data[0]['nombre'];
            }
        }

        public function getAmbientes()
        {
            global $database;

            $data = $database->select('ambientes', [
                '[>]centrocosto' => ['id_centrocosto' => 'id_centrocosto'],
                '[>]bodegas' => ['id_bodega' => 'id_bodega']

            ],[
                'ambientes.id_ambiente',
                'ambientes.fecha_auditoria',
                'ambientes.codigo',
                'ambientes.nombre',
                'ambientes.id_centrocosto',
                'ambientes.conc_factura',
                'ambientes.conc_orden',
                'ambientes.conc_comanda',
                'ambientes.prefijo',
                'ambientes.servicio',
                'ambientes.propina',
                'ambientes.impuesto',
                'ambientes.id_bodega',
                'ambientes.codigo_venta',
                'ambientes.codigo_propina',
                'ambientes.codigo_servicio',
                'ambientes.logo',
                'ambientes.active_at',
                'centrocosto.descripcion_centro',
                'bodegas.descripcion_bodega'
            ], [
                'ambientes.deleted_at' => null,
            ]);

            return $data;
        }

        /* Tipos de Platos POS */
        public function getTipoPlatos()
        {
            global $database;

            $data = $database->select('secciones_pos', [
                'id_seccion',
                'nombre_seccion',
                'estado_seccion',
                'id_ambiente',
            ], [
                'deleted_at' => null,
            ]);

            return $data;
        }

        public function insertTipoPlato($descr, $ambi)
        {
            global $database;

            $data = $database->insert('secciones_pos', [
                'nombre_seccion' => $descr,
                'created_at' => date('Y-m-d H:i:s'),
                'id_ambiente' => $ambi,
                'estado_seccion' => 1,
            ]);

            return $database->id();
        }

        public function updateTipoPlato($ambi, $agrup, $id)
        {
            global $database;

            $data = $database->update('secciones_pos', [
                'nombre_seccion' => $agrup,
                'id_ambiente' => $ambi,
                'updated_at' => date('Y-m-d H:i:s'),
            ], [
                'id_seccion' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaTipoPlato($id)
        {
            global $database;

            $data = $database->update('secciones_pos', [
                'deleted_at' => date('Y-m-d H:i:s'),
            ], [
                'id_seccion' => $id,
            ]);

            return $data->rowCount();
        }

        /* FUNCIONES PARAMETROS PMS HOTEL */

        public function updateConsecutivoHotel($id, $factu, $depo, $abono, $reser, $regis, $decre, $efec, $avan, $pagos, $reca, $ctaco, $mmto)
        {
            global $database;

            $data = $database->update('parametros_pms', [
                'con_factura' => $factu,
                'con_reserva' => $reser,
                'con_avances' => $avan,
                'con_abonos' => $abono,
                'con_cta_congelada' => $ctaco,
                'con_decreto' => $decre,
                'con_pago' => $pagos,
                'con_registro_hotelero' => $regis,
                'con_deposito' => $depo,
                'con_efectivo' => $efec,
                'con_recaudos' => $reca,
                'con_mantenimiento' => $mmto,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateHotel($id, $hotel, $direc, $ciudad, $habit, $camas, $horas, $email, $tele, $celu, $ctade, $iddep)
        {
            global $database;

            $data = $database->update('parametros_pms', [
                'nombre_hotel' => $hotel,
                'direccion' => $direc,
                'ciudad' => $ciudad,
                'nro_habitaciones' => $habit,
                'email' => $email,
                'telefono' => $tele,
                'celular' => $celu,
                'camas' => $camas,
                'hora_salida' => $horas,
                'cuenta_depositos' => $ctade,
                'id_perfil_depositos' => $iddep,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function getPerfilHuesped()
        {
            global $database;

            $data = $database->select('huespedes', [
                'nombre_completo',
                'id_huesped',
            ], [
                'ORDER' => 'nombre_completo',
            ]);

            return $data;
        }

        public function getPaquetesTarifa($id)
        {
            global $database;

            $data = $database->query("SELECT
            tarifas.descripcion_tarifa, 
            paquetes.descripcion, 
            paquetes_tarifas.id, 
            tarifas.id_tarifa
        FROM
            tarifas
            INNER JOIN
            paquetes_tarifas
            ON 
                tarifas.id_tarifa = paquetes_tarifas.id_tarifa
            INNER JOIN
            paquetes
            ON 
                paquetes_tarifas.id_paquete = paquetes.id
        WHERE tarifas.id_tarifa = $id")->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        }

        public function getPaquetesTarifaOld2($id)
        {
            global $database;

            $data = $database->select('paquetes_tarifas', [
                '[>]tarifas' => ['id_tarifa' => 'id_tarifa'],
                '[>]paquetes' => ['id' => 'id_paquete'],
            ], [
                'tarifas.descripcion_tarifa',
                'paquetes.descripcion',
                'tarifas.id_tarifa',
            ], [
                'paquetes_tarifas.id_tarifa' => $id,
            ]);

            return $data;
        }

        public function getPaquetesTarifaOld($id)
        {
            global $database;

            $data = $database->select('paquetes_tarifas', [
                '[>]tarifas' => ['id_tarifa' => 'id_tarifa'],
                '[>]paquetes' => ['id' => 'id_paquete'],
            ], [
                'tarifas.descripcion_tarifa',
                'paquetes.descripcion',
                'tarifas.id_tarifa',
            ], [
                'paquetes_tarifas.id_tarifa' => $id,
            ]);

            return $data;
        }



        /* SubGrupos Tarifas PMS */
        public function eliminaValorSubgrupoTarifa($id)
        {
            global $database;

            $data = $database->delete('valores_tarifas', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateValorSubgrupoTarifa($id, $desde, $hasta, $uno, $dos, $tre, $cua, $cin, $sei, $adi, $nin)
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
                'valor_nino' => $nin,
                'desde_fecha' => $desde,
                'hasta_fecha' => $hasta,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function getValorSubTarifaHabitacion($id)
        {
            global $database;

            $data = $database->select('valores_tarifas', [
                'id',
                'id_tipohabitacion',
                'id_subtarifa',
                'paquetes',
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
                'valor_adicional',
                'valor_nino',
                'desde_fecha',
                'hasta_fecha',
            ], [
                'id' => $id,
            ]);

            return $data;
        }

        public function insertValorSubgrupoTarifa($idsub, $idhab, $desde, $hasta, $uno, $dos, $tre, $cua, $cin, $sei, $adi, $nin)
        {
            global $database;

            $data = $database->insert('valores_tarifas', [
                'id_tipohabitacion' => $idhab,
                'id_subtarifa' => $idsub,
                'valor_un_pax' => $uno,
                'valor_dos_pax' => $dos,
                'valor_tre_pax' => $tre,
                'valor_cua_pax' => $cua,
                'valor_cin_pax' => $cin,
                'valor_sei_pax' => $sei,
                'valor_adicional' => $adi,
                'valor_nino' => $nin,
                'desde_fecha' => $desde,
                'hasta_fecha' => $hasta,
            ]);

            return $database->id();
        }

        /* SubTarifas PMS */
        public function getValorSubTarifas($id)
        {
            global $database;

            $data = $database->select('valores_tarifas', [
                '[>]tipo_habitaciones' => ['id_tipohabitacion' => 'id'],
            ], [
                'tipo_habitaciones.descripcion_habitacion',
                'valores_tarifas.id',
                'valores_tarifas.id_tipohabitacion',
                'valores_tarifas.valor_un_pax',
                'valores_tarifas.valor_dos_pax',
                'valores_tarifas.valor_tre_pax',
                'valores_tarifas.valor_cua_pax',
                'valores_tarifas.valor_cin_pax',
                'valores_tarifas.valor_sei_pax',
                'valores_tarifas.valor_sie_pax',
                'valores_tarifas.valor_och_pax',
                'valores_tarifas.valor_nue_pax',
                'valores_tarifas.valor_die_pax',
                'valores_tarifas.valor_adicional',
                'valores_tarifas.valor_nino',
                'valores_tarifas.desde_fecha',
                'valores_tarifas.hasta_fecha',
            ], [
                'valores_tarifas.id_subtarifa' => $id,
                'ORDER' => 'tipo_habitaciones.descripcion_habitacion',
            ]);

            return $data;
        }

        public function eliminaSubtarifa($id)
        {
            global $database;

            $data = $database->delete('tarifas', [
                'id_tarifa' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateSubtarifa($id, $idgru, $descri)
        {
            global $database;

            $data = $database->update('tarifas', [
                'descripcion_tarifa' => $descri,
            ], [
                'id_tarifa' => $id,
            ]);

            return $database->id();
        }

        public function insertSubtarifa($idgru, $descri)
        {
            global $database;

            $data = $database->insert('tarifas', [
                'descripcion_tarifa' => $descri,
                'id_grupo_tarifa' => $idgru,
            ]);

            return $database->id();
        }

        /* Tarifas PMS */
        public function getTarifasGrupo($id)
        {
            global $database;

            $data = $database->select('tarifas', [
                'id_tarifa',
                'id_grupo_tarifa',
                'descripcion_tarifa',
            ], [
                'id_grupo_tarifa' => $id,
            ]);

            return $data;
        }

        public function eliminaGrupoTarifa($id)
        {
            global $database;

            $data = $database->delete('grupos_tarifas', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateGrupoTarifa($id, $descri)
        {
            global $database;

            $data = $database->update('grupos_tarifas', [
                'descripcion' => $descri,
            ], [
                'id' => $id,
            ]);

            return $database->id();
        }

        public function insertGrupoTarifa($descri)
        {
            global $database;

            $data = $database->insert('grupos_tarifas', [
                'descripcion' => $descri,
            ]);

            return $database->id();
        }

        public function getTarifas()
        {
            global $database;

            $data = $database->select('grupos_tarifas', [
                'id',
                'descripcion',
            ], [
                'ORDER' => 'descripcion',
            ]);

            return $data;
        }

        /* Paquetes PMS */
        public function eliminaPaquete($id)
        {
            global $database;

            $data = $database->delete('paquetes', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updatePaquete($id, $descrip, $frecuen, $tipcar, $codpaq, $codexc, $valor)
        {
            global $database;

            $data = $database->update('paquetes', [
                'descripcion' => $descrip,
                'codigo_vta' => $codpaq,
                'codigo_excento' => $codexc,
                'tipo_cargo' => $tipcar,
                'frecuencia' => $frecuen,
                'valor' => $valor,
            ], [
                'id' => $id,
            ]);

            return $database->id();
        }

        public function insertPaquete($descrip, $frecuen, $tipcar, $codpaq, $codexc, $valor)
        {
            global $database;

            $data = $database->insert('paquetes', [
                'descripcion' => $descrip,
                'codigo_vta' => $codpaq,
                'codigo_excento' => $codexc,
                'tipo_cargo' => $tipcar,
                'frecuencia' => $frecuen,
                'valor' => $valor,
            ]);

            return $database->id();
        }

        public function getPaquetes()
        {
            global $database;

            $data = $database->select('paquetes', [
                'id',
                'codigo',
                'descripcion',
                'codigo_vta',
                'codigo_excento',
                'tipo_cargo',
                'frecuencia',
                'valor',
                'separar_tarifa',
            ]);

            return $data;
        }

        public function updateHabitacion($id, $nrohab, $tipo, $sector, $camas, $pax, $destipo)
        {
            global $database;

            $data = $database->update('habitaciones', [
                'numero_hab' => $nrohab,
                'id_tipohabitacion' => $tipo,
                'id_sector' => $sector,
                'camas' => $camas,
                'pax' => $pax,
                'descripcion' => $destipo,
            ], [
                'id' => $id,
            ]);

            return $database->id();
        }

        /* Habitaciones PMS */
        public function eliminaHabitacion($id)
        {
            global $database;

            $data = $database->delete('habitaciones', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertHabitacion($nrohab, $tipo, $sector, $camas, $pax, $destipo)
        {
            global $database;

            $data = $database->insert('habitaciones', [
                'numero_hab' => $nrohab,
                'id_tipohabitacion' => $tipo,
                'descripcion' => $destipo,
                'id_sector' => $sector,
                'pax' => $pax,
                'camas' => $camas,
                'estado_fo' => 'SV',
                'estado_hk' => 'SV',
                'active_at' => 1,
                'estado' => 1,
            ]);

            return $database->id();
        }

        public function activaHabitacion($id, $tipo)
        {
            global $database;

            $data = $database->update('habitaciones', [
                'active_at' => $tipo,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function getHabitaciones()
        {
            global $database;

            $data = $database->select('habitaciones', [
                'id',
                'numero_hab',
                'id_tipohabitacion',
                'tipo_hab',
                'pax',
                'camas',
                'estado',
                'id_sector',
                'active_at',
                'dormitorios',
                'caracteristicas',
            ], [
                'ORDER' => 'numero_hab',
            ]);

            return $data;
        }

        /* Tipos de Habitaciones PMS */
        public function getDescrTipoHab($tipo)
        {
            global $database;

            $data = $database->select('tipo_habitaciones', [
                'descripcion_habitacion',
            ], [
                'id' => $tipo,
            ]);

            return $data[0]['descripcion_habitacion'];
        }

        public function updateTipoHabi($id, $codigo, $descr, $sector, $codvta, $codexe)
        {
            global $database;

            $data = $database->update('tipo_habitaciones', [
                'codigo' => $codigo,
                'descripcion_habitacion' => $descr,
                'deptoventa_habitacion' => $codvta,
                'deptoventa_excento' => $codexe,
                'sector_habitacion' => $sector,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaTipoHabi($id)
        {
            global $database;

            $data = $database->delete('tipo_habitaciones', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertTipoHabi($codigo, $descr, $sector, $codvta, $codexc)
        {
            global $database;

            $data = $database->insert('tipo_habitaciones', [
                'codigo' => $codigo,
                'descripcion_habitacion' => $descr,
                'deptoventa_habitacion' => $codvta,
                'deptoventa_excento' => $codexc,
                'sector_habitacion' => $sector,
                'active_at' => 1,
            ]);

            return $database->id();
        }

        public function activaTipoHabi($id, $tipo)
        {
            global $database;

            $data = $database->update('tipo_habitaciones', [
                'active_at' => $tipo,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function getTipoHabitacion()
        {
            global $database;

            $data = $database->select('tipo_habitaciones', [
                '[<]sector_habitaciones' => ['sector_habitacion' => 'id_sector']
            ], [
                'sector_habitaciones.descripcion_sector',
                'tipo_habitaciones.id',
                'tipo_habitaciones.codigo',
                'tipo_habitaciones.descripcion_habitacion',
                'tipo_habitaciones.sector_habitacion',
                'tipo_habitaciones.deptoventa_habitacion',
                'tipo_habitaciones.deptoventa_excento',
                'tipo_habitaciones.active_at',
            ], [
                'ORDER' => 'descripcion_habitacion',
            ]);

            return $data;
        }

        public function getTipoHabitacionAct()
        {
            global $database;

            $data = $database->select('tipo_habitaciones', [
                'id',
                'codigo',
                'descripcion_habitacion',
                'sector_habitacion',
                'deptoventa_habitacion',
                'deptoventa_excento'
            ], [
                'active_at' => 1,
                'ORDER' => 'descripcion_habitacion',
            ]);

            return $data;
        }

        /* Sectores de Habitaciones PMS */
        public function getDescripcionSector($id)
        {
            global $database;

            $data = $database->select('sector_habitaciones', [
                'descripcion_sector',
            ], [
                'id_sector' => $id,
            ]);

            return $data[0]['descripcion_sector'];
        }

        public function getDescrSectorHab($tipo)
        {
            global $database;

            $data = $database->select('sector_habitaciones', [
                'descripcion_sector',
            ], [
                'id_sector' => $tipo,
            ]);

            return $data[0]['descripcion_sector'];
        }

        public function updateSector($sector, $id)
        {
            global $database;

            $data = $database->update('sector_habitaciones', [
                'descripcion_sector' => $sector,
            ], [
                'id_sector' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaSector($id)
        {
            global $database;

            $data = $database->delete('sector_habitaciones', [
                'id_sector' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertSectorHabi($sector)
        {
            global $database;

            $data = $database->insert('sector_habitaciones', [
                'descripcion_sector' => $sector,
            ]);

            return $database->id();
        }

        public function getSectorHabitacion()
        {
            global $database;

            $data = $database->select('sector_habitaciones', [
                'id_sector',
                'descripcion_sector',
            ], [
                'ORDER' => 'descripcion_sector',
            ]);

            return $data;
        }

        /* Agrupaciones de Ventas PMS */
        public function getAgrupacion($id)
        {
            global $database;

            $data = $database->select('agrupaciones', [
                'descripcion',
            ], [
                'id' => $id,
            ]);

            return $data[0]['descripcion'];
        }

        public function eliminaAgrupacion($id)
        {
            global $database;

            $data = $database->delete('agrupaciones', [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function updateAgrupacion($agrup, $id)
        {
            global $database;

            $data = $database->update('agrupaciones', [
                'descripcion' => $agrup,
            ], [
                'id' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertAgrupacion($agrup)
        {
            global $database;

            $data = $database->insert('agrupaciones', [
                'descripcion' => $agrup,
            ]);

            return $database->id();
        }

        public function getAgrupaciones()
        {
            global $database;

            $data = $database->select('agrupaciones', [
                'id',
                'descripcion',
            ], [
                'ORDER' => 'descripcion',
            ]);

            return $data;
        }

        /* FINAL FUNCIONES PARAMETROS PMS HOTEL */

        public function getCodigosCiiu()
        {
            global $database;

            $data = $database->select('ciiu', [
                'id_ciiu',
                'codigo',
                'descripcion',
            ], [
                'ORDER' => 'codigo',
            ]);

            return $data;
        }

        public function getTipoDocumento()
        {
            global $database;

            $data = $database->select('tipo_documento', [
                'id_doc',
                'descripcion_documento',
            ], [
                'ORDER' => 'descripcion_documento',
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

        public function getTiposCia()
        {
            global $database;

            $data = $database->select('tipo_cia', [
                'id_tipo_cia',
                'descripcion',
            ], [
                'ORDER' => 'descripcion',
            ]);

            return $data;
        }

        public function getDepto($id)
        {
            global $database;

            $data = $database->select('deptos', [
                'nombre_depto',
            ], [
                'id_depto' => $id,
            ]);
            if (count($data) == 0) {
                return '';
            } else {
                return $data[0]['nombre_depto'];
            }
        }

        public function updateDepto($descripcion, $id)
        {
            global $database;

            $data = $database->update('deptos', [
                'nombre_depto' => $descripcion,
            ], [
                'id_depto' => $id,
            ]);

            return $database->id();
        }

        public function eliminaDepto($id)
        {
            global $database;

            $data = $database->delete('deptos', [
                'id_depto' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertDepto($depto)
        {
            global $database;

            $data = $database->insert('deptos', [
                'nombre_depto' => $depto,
            ]);

            return $database->id();
        }

        public function getDeptosAreas()
        {
            global $database;

            $data = $database->select('deptos', [
                'id_depto',
                'nombre_depto',
            ], [
                'ORDER' => 'nombre_depto',
            ]);

            return $data;
        }

        public function eliminaCodigoVenta($id)
        {
            global $database;

            $data = $database->delete('codigos_vta', [
                'id_cargo' => $id,
            ]);

            $result = [
                'id' => $data->rowCount(),
                'error' => $database->errorInfo,
            ];

            return $result;

            // return $data->rowCount();
        }

        public function updateCodigoVenta($descripcion, $impto, $grupo, $puc, $contabil, $id, $centro)
        {
            global $database;

            $data = $database->update('codigos_vta', [
                'descripcion_cargo' => $descripcion,
                'id_impto' => $impto,
                'grupo_vta' => $grupo,
                'cuenta_puc' => $puc,
                'centroCosto' => $centro,
                'descripcion_contable' => $contabil,
            ], [
                'id_cargo' => $id,
            ]);

            return $database->id();
        }

        public function insertCodigoVenta($nombre, $unidad, $imptos, $grupo, $reteFte, $reteIca, $centro, $puc, $contabil, $codigo, $porcentaje)
        {
            global $database;

            $data = $database->insert('codigos_vta', [
                'descripcion_cargo' => $nombre,
                'id_impto' => $imptos,
                'grupo_vta' => $grupo,
                'cuenta_puc' => $puc,
                'centroCosto' => $centro,
                'descripcion_contable' => $contabil,
                'tipoUnidad' => $unidad,
                'identificador_dian' => $codigo,
                'idRetencion' => $reteFte,
                'idReteIca' => $reteIca,
                'porcentaje_impto' => $porcentaje,
                'tipo_codigo' => 1,
                'restringido' => 0,
            ]);

            $result = [
                'id' => $database->id(),
                'error' => $database->errorInfo,
            ];

            return $result;
        }

        public function getGruposVentas()
        {
            global $database;

            $data = $database->select('agrupaciones', [
                'id',
                'descripcion',
            ], [
                'ORDER' => 'descripcion',
            ]);

            return $data;
        }

        public function getDescriptionAgrup($id)
        {
            global $database;

            $data = $database->select('agrupaciones', [
                'descripcion',
            ], [
                'id' => $id,
            ]);
            if (count($data) == 0) {
                return '';
            } else {
                return $data[0]['descripcion'];
            }
        }

        public function updateFormaPago($descripcion, $puc, $contabil, $id, $forma, $medio, $cruce)
        {
            global $database;

            $data = $database->update('codigos_vta', [
                'descripcion_cargo' => $descripcion,
                'cuenta_puc' => $puc,
                'cuenta_cruce' => $cruce,
                'descripcion_contable' => $contabil,
                'identificador_dian' => $forma,
                'medioPagoDian' => $medio,
            ], [
                'id_cargo' => $id,
            ]);

            return $data->rowCount();
        }

        public function eliminaFormaPago($id)
        {
            global $database;

            $data = $database->delete('codigos_vta', [
                'id_cargo' => $id,
            ]);

            return $data->rowCount();
        }

        public function insertFormaPago($descripcion, $puc, $contabil, $forma, $medio, $cruce)
        {
            global $database;

            $data = $database->insert('codigos_vta', [
                'descripcion_cargo' => $descripcion,
                'cuenta_puc' => $puc,
                'cuenta_cruce' => $cruce,
                'descripcion_contable' => $contabil,
                'identificador_dian' => $forma,
                'medioPagoDian' => $medio,
                'tipo_codigo' => 3,
                'restringido' => 0,
            ]);

            return $database->id();
        }

        public function activaFormaPago($id, $tipo)
        {
            global $database;

            $data = $database->update('codigos_vta', [
                'restringido' => $tipo,
            ], [
                'id_cargo' => $id,
            ]);

            return $data->rowCount();
        }


        public function getCodigosFormasPago($tipo)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                '[<]dianMediosPago' => ['medioPagoDian' => 'id']
            ], [
                'id_cargo',
                'codigo_depto',
                'agrupacion',
                'id_impto',
                'porcentaje_impto',
                'tipo_impto',
                'cuenta_puc',
                'cuenta_cruce',
                'descripcion_cargo',
                'descripcion_contable',
                'centroCosto',
                'grupo_vta',
                'maximo_credito',
                'propina',
                'codigo_propina',
                'restringido',
                'identificador_dian',
                'medioPagoDian',
                'dianMediosPago.name'
            ], [
                'tipo_codigo' => $tipo,
                'ORDER' => 'descripcion_cargo',
            ]);

            return $data;
        }


        public function getCodigosVentas($tipo)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'id_cargo',
                'codigo_depto',
                'agrupacion',
                'id_impto',
                'porcentaje_impto',
                'tipo_impto',
                'cuenta_puc',
                'descripcion_cargo',
                'descripcion_contable',
                'centroCosto',
                'grupo_vta',
                'maximo_credito',
                'propina',
                'codigo_propina',
                'restringido',
                'identificador_dian',
                'medioPagoDian',
            ], [
                'tipo_codigo' => $tipo,
                'ORDER' => 'descripcion_cargo',
            ]);

            return $data;
        }

        public function getCodigosImptos($tipo)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                '[<]dianImpuestos' => ['identificador_dian' => 'id']
            ], [
                'codigos_vta.id_cargo',
                'codigos_vta.codigo_depto',
                'codigos_vta.agrupacion',
                'codigos_vta.id_impto',
                'codigos_vta.porcentaje_impto',
                'codigos_vta.tipo_impto',
                'codigos_vta.cuenta_puc',
                'codigos_vta.descripcion_cargo',
                'codigos_vta.descripcion_contable',
                'codigos_vta.centroCosto',
                'codigos_vta.grupo_vta',
                'codigos_vta.maximo_credito',
                'codigos_vta.propina',
                'codigos_vta.codigo_propina',
                'codigos_vta.identificador_dian',
                'codigos_vta.restringido',
                'dianImpuestos.name'
            ], [
                'codigos_vta.tipo_codigo' => $tipo,
                'codigos_vta.tipo_impto' => 1,
                'ORDER' => [
                    'dianImpuestos.name' => 'ASC',
                    'codigos_vta.descripcion_cargo' => 'ASC'
                ]
            ]);

            return $data;
        }
        public function getCodigosImpuestos($tipo)
        {
            global $database;

            $data = $database->select('codigos_vta', [
                'id_cargo',
                'codigo_depto',
                'agrupacion',
                'id_impto',
                'porcentaje_impto',
                'tipo_impto',
                'cuenta_puc',
                'descripcion_cargo',
                'descripcion_contable',
                'centroCosto',
                'grupo_vta',
                'maximo_credito',
                'propina',
                'codigo_propina',
                'restringido',
            ], [
                'tipo_codigo' => 2,
                'tipo_impto' => $tipo,
                'ORDER' => 'descripcion_cargo',
            ]);

            return $data;
        }

        public function getRetencion($tipo)
        {
            global $database;

            $data = $database->select('retenciones', [
                'idRetencion',
                'descripcionRetencion',
                'porcentajeRetencion'
            ], [
                'tipoRetencion' => $tipo,
                'ORDER' => ['descripcionRetencion' => 'ASC']
            ]);
            return $data;
        }

        public function getDatosHotel()
        {
            global $database;

            $data = $database->select('parametros_pms', [
                'id',
                'fecha_auditoria',
                'nombre_hotel',
                'direccion',
                'nro_habitaciones',
                'habitaciones',
                'email',
                'telefono',
                'fax',
                'celular',
                'licencia',
                'camas',
                'nit_hotel',
                'dv_hotel',
                'cuenta_cartera',
                'cuenta_depositos',
                'cuenta_cargos_perdidos',
                'hora_salida',
                'iva_incluido',
                'ciudad',
                'pais',
                'con_lista_espera',
                'con_factura',
                'con_deposito',
                'con_reserva',
                'con_companias',
                'con_agencia',
                'con_huesped',
                'con_contactos',
                'con_avances',
                'con_abonos',
                'con_pago',
                'con_cta_congelada',
                'con_decreto',
                'con_mantenimiento',
                'con_registro_hotelero',
                'con_efectivo',
                'con_recaudos',
                'mantenimiento',
                'id_perfil_depositos',
                'codigo_hotel',
                'codigo_cta_master',
                'codigo_devoluciones',
                'hoteldemo',
                'resolucion',
                'actividad',
                'info_banco',
                'info_factura',
                'info_pie',
                'facturador',
                'tra',
            ], [
                'LIMIT' => 1,
            ]);

            return $data;
        }

        public function actualizaNumeroFolio($folio, $id)
        {
            global $database;

            $data = $database('cargos_pms', [
                'folio_cargo' => $folio,
            ], [
                'id_cargo' => $id,
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

            return $data[0]['municipio'] . ' ' . $data[0]['depto'];
        }

        public function getLandName($tipo)
        {
            global $database;

            $data = $database->select('paices', [
                'descripcion',
            ], [
                'id_pais' => $tipo,
            ]);

            return $data[0]['descripcion'];
        }
    }
    ?>