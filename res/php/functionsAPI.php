
 <?php 
  date_default_timezone_set("America/Bogota");	
	require_once 'init.php';
 
	class UserAPI{

		public function getinfoImptos($codigo){
			global $database;

			$data = $database->select('codigos_vta',[
				'[>]dianTributos' => ['tributosDian' => 'id']	
			],[
				'dianTributos.identificador',
				'dianTributos.nombre',
				'dianTributos.porcentaje'
			],[
				'id_cargo' => $codigo
			]); 
			return $data;
		}

		public function getTributesDian($tribute){
			global $database;

			$data = $database->select('dianTributos',[
				'identificador',
				'nombre'
			],[
				'id' => $tribute
			]);
			return $data;
		}

		public function getValorIva($fact,$tipo){
			global $database;

			$data = $database->query("SELECT codigos_vta.descripcion_cargo, Sum(cargos_pms.impuesto) as imptos, cargos_pms.factura_numero, dianTributos.identificador FROM cargos_pms, codigos_vta, dianTributos WHERE cargos_pms.codigo_impto = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.cargo_anulado = 0 AND codigos_vta.tributosDian = dianTributos.id AND dianTributos.identificador = $tipo GROUP BY dianTributos.identificador ORDER BY dianTributos.identificador")->fetchAll();
			if(count($data)==0){
				return 0 ;
			}else{
				return $data[0]['imptos'];
			}
		}

		public function getValorImptoFolio($fact,$tipo){
			global $database;

			$data = $database->query("SELECT codigos_vta.descripcion_cargo, Sum(cargos_pms.monto_cargo) as cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) as pagos, cargos_pms.factura_numero, dianTributos.identificador, dianTributos.nombre, dianTributos.porcentaje FROM cargos_pms, codigos_vta, dianTributos WHERE cargos_pms.codigo_impto = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$fact' AND cargos_pms.cargo_anulado = 0 AND codigos_vta.tipo_codigo = '$tipo' AND codigos_vta.tributosDian = dianTributos.id GROUP BY cargos_pms.codigo_impto ORDER BY cargos_pms.codigo_impto")->fetchAll();
			return $data;
		}

		public function getRegimenFiscal($tipo){
			global $database;

			$data = $database->select('dianRegimenFiscal',[
				'codigo'
			],[
				'id' => $tipo
			]);
			return $data[0]['codigo'];
		}

		public function getTaxLevelCode($tipo){
			global $database;

			$data = $database->select('dianTaxLevelCode',[
				'codigo'
			],[
				'id' => $tipo
			]);
			return $data[0]['codigo'];
		}

		public function getZonaPostal($tipo){
			global $database;

			$data = $database->select('codigosPostales',[
				'codigo_postal'
			],[
				'id' => $tipo
			]);
			return $data[0]['codigo_postal'];
		}

		public function getCodigoCiudad($tipo){
			global $database;

			$data = $database->select('ciudades',[
				'codigo',
				'municipio',
				'depto'
			],[
				'id_ciudad' => $tipo
			]);
			return $data;
		}

		public function getCodigoCIIU($tipo){
			global $database;

			$data = $database->select('ciiu',[
				'codigo'
			],[
				'id_ciiu' => $tipo
			]);
			return $data[0]['codigo'];
		}

		public function getTipoOrganizacion($tipo){
			global $database;

			$data = $database->select('dianTipoOrganizacion',[
				'codigo'
			],[
				'id' => $tipo
			]);
			return $data[0]['codigo'];
		}

		public function traeEncabezadoFacturaPMS($numFact){
			global $database;

			$data = $database->select('cargos_pms',[
				'fecha_vencimiento',
				'tipo_factura',
				'id_perfil_factura',
				'fecha_factura',
				'total_consumos',
				'total_impuesto',
				'total_pagos',
				'base_impuestos',
				'total_anticipos'
			],[
				'factura_numero' => $numFact,
				'factura'        => 1
			]);
			return $data;
		}

		public function traeTerceroPMS($cliente){
			global $database;

			$data = $database->query("SELECT empresa AS name, nit AS identifica, dv, direccion, celular, email, ciudad, obligacionesImpto, regimenFiscal, tributo FROM companias WHERE id_compania ='$cliente'")->fetchAll();
		
			return $data;
		}

		public function traeClientePMS($cliente){
			global $database;

			$data = $database->query("SELECT nombre_completo AS name, identificacion AS identifica, ' ' as dv, direccion, celular, email, ciudad, obligacionesImpto, regimenFiscal, tributo FROM huespedes WHERE id_huesped ='$cliente'")->fetchAll();

			return $data;
		}

		public function traeFacturaPMS($factura,$tipo){
			global $database;
			$numero = 0;

			$data = $database->query("SELECT cargos_pms.id_codigo_cargo, cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.base_impuesto) AS base, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.codigo_impto, cargos_pms.factura_numero, codigos_vta.formaPagoDian, codigos_vta.medioPagoDian, cargos_pms.fecha_factura, dianTributos.identificador FROM cargos_pms, codigos_vta, codigos_vta as codImptos, dianTributos WHERE cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND codigos_vta.tipo_codigo = '$tipo' AND codImptos.tributosDian = dianTributos.id GROUP BY cargos_pms.id_codigo_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo")->fetchAll();
			return $data ;
		}

		public function traeAnticiposPMS($factura,$tipo){
			global $database;

			$data = $database->query("SELECT cargos_pms.fecha_cargo, cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero, codigos_vta.formaPagoDian, codigos_vta.medioPagoDian, cargos_pms.fecha_factura FROM cargos_pms, codigos_vta WHERE (cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND codigos_vta.tipo_codigo = '$tipo' AND cargos_pms.concecutivo_abono != 0) OR (cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND codigos_vta.tipo_codigo = '$tipo' AND cargos_pms.concecutivo_deposito != 0) GROUP BY cargos_pms.id_codigo_cargo, cargos_pms.fecha_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo")->fetchAll();
			return $data ;
		}

		public function traePagosPMS($factura,$tipo){
			global $database;

			$data = $database->query("SELECT cargos_pms.fecha_cargo, cargos_pms.descripcion_cargo, count(cargos_pms.id_codigo_cargo) AS cant, Sum(cargos_pms.monto_cargo) AS cargos, Sum(cargos_pms.impuesto) as imptos, Sum(cargos_pms.pagos_cargos) AS pagos, cargos_pms.factura_numero, codigos_vta.formaPagoDian, codigos_vta.medioPagoDian, cargos_pms.fecha_factura   FROM cargos_pms, codigos_vta WHERE (cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND codigos_vta.tipo_codigo = '$tipo' AND cargos_pms.concecutivo_abono = 0) OR (cargos_pms.id_codigo_cargo = codigos_vta.id_cargo AND cargos_pms.factura_numero = '$factura' AND codigos_vta.tipo_codigo = '$tipo' AND cargos_pms.concecutivo_deposito = 0) GROUP BY cargos_pms.id_codigo_cargo ORDER BY cargos_pms.numero_reserva, cargos_pms.id_codigo_cargo")->fetchAll();
			return $data ;
		}

		public function getInfoInvoice($tipo, $modulo, $ambiente){
			global $database;

			$data = $database->select('dianExtensions',[
				'invoiceAuthorization',
				'startDate',
				'endDate',
				'prefix',
				'from',
				'to',
				'current',
				'identificationCode',
				'providerID',
				'softwareID',
				'pinID',
				'authorizationProviderID',
				'claveTecnica',
				'customizationID',
				'invoiceTypeCode',
				'documentCurrencyCode',
				'numeroMatriculaMercantil',
				'urlCufe',
				'tributesDian',
				'test'
			],[
				'test'     => $tipo,
				'modulo'   => $modulo,
				'ambiente' => $ambiente
			]);
			return $data;
		}

		public function getInfoCia(){
			global $database;

			$data = $database->select('empresas',[
				'empresa',
				'nit', 
				'dv', 
				'direccion', 
				'pais',
				'ciudad',
				'codigoPostal',
				'celular',
				'telefonos',
				'web',
				'correo',
				'logo',
				'codigo_ciiu',
				'rnt',
				'codigo_ciiu',
				'tipo_empresa',
				'tipoOrganizacion',
				'taxLevelCode',
				'regimenFiscal',
				'companyNotes'
			]);
			return $data;
		}

		public function getTypeCia($tipo){
			global $database;

			$data = $database->select('tipo_cia',[
				'descripcion'
			],[
				'id_tipo_cia' => $tipo
			]);
			return $data[0]['descripcion'];
		}

	}
 ?>