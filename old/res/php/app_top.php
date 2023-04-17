<?php 
	/// session_start();
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  date_default_timezone_set("America/Bogota");

	require 'functions.php'; 
	require 'funciones.php';
	require 'rutas.php';

	$user    = new User_Actions();

	$empresa = $user->getInfoCia();

	/// echo print_r($empresa);

	define("NAME_EMPRESA", $empresa[0]['empresa']);
	
	$nit = number_format($empresa[0]['nit'],0);
	$nit = str_replace(",",".",$nit);

	// define("IP_CONECT", $_SERVER['REMOTE_ADDR']);
	define("NIT_EMPRESA", $nit.'-'.$empresa[0]['dv']);
	define("ADRESS_EMPRESA", $empresa[0]['direccion']);
	define("TELEFONO_EMPRESA",$empresa[0]['telefonos']);
	define("CELULAR_EMPRESA", $empresa[0]['celular']);
	define("PAIS_EMPRESA", $empresa[0]['pais']);
	define("CIUDAD_EMPRESA", $empresa[0]['ciudad']);
	define("WEB_EMPRESA", $empresa[0]['web']);
	define("CORREO_EMPRESA", $empresa[0]['correo']);
	define("LOGO_EMPRESA", $empresa[0]['logo']);
	define("TIPO_DOC", $empresa[0]['tipo_empresa']);
	define("CIIU", $empresa[0]['codigo_ciiu']);
	define("IP_ACCESS", $empresa[0]['ip_acceso']);
	define("TIPOEMPRESA", $user->getTypeCia($empresa[0]['tipo_empresa']));
	define("CMS", $empresa[0]['cms']);

/* Datos Hotel */
	
	$hotel         = $user->getHotelInfo();
	
	$hotelabout    = $user->getAboutHotel();	 
	$rooms         = $user->getRoomHotel();
	$sliders       = $user->getSliderHotel();	

	$userTwitter   = $user->getUserSocial('Twitter');
	$userGoogle    = $user->getUserSocial('Google');
	$userFacebook  = $user->getUserSocial('Facebook');
	$userInstagram = $user->getUserSocial('Instagram');

	define('ID_HOTEL', $hotel[0]['id_hotel']);
	define("NAME_HOTEL", $hotel[0]['hotel_name']);
	define("NIT_HOTEL", $hotel[0]['nit_hotel']);
	define("MAIL_HOTEL", $hotel[0]['email']);
	define("MAIL_CONTACT", $hotel[0]['email_contact']);
	define("MAIL_BOOKING", $hotel[0]['email_book']);
	define("ADRESS_HOTEL", $hotel[0]['adress']);
	define("PHONE_HOTEL", $hotel[0]['phone']);
	define("MOVIL_HOTEL", $hotel[0]['movil']);
	define("CITY_HOTEL", $hotel[0]['city']);
	define("LAND_HOTEL", $hotel[0]['land']);
	define("LOGO_HOTEL", $hotel[0]['logo']);
	define("ICONO_HOTEL", $hotel[0]['icono']);
	define("COLOR_MENU", $hotel[0]['color_menu']);
	define("FONT_MENU", $hotel[0]['font_menu']);
	define("COLOR_FOOTER", $hotel[0]['color_footer']);
	define("FONT_FOOTER", $hotel[0]['font_footer']);
	define("COLOR_CARD", $hotel[0]['color_card']);
	define("FONT_CARD", $hotel[0]['font_card']);
	define("ADULTS", $hotel[0]['max_adults']);
	define("KIDS", $hotel[0]['max_babys']);
	define("WEB_PAGE", $hotel[0]['web']); 
	define("LANGUAGE", $hotel[0]['language']);
	define("MAPS", $hotel[0]['api_key_maps']);
	define("KEYWORD_TEXT", $hotel[0]['keyword_text']);
	define("ANALYTICS", $hotel[0]['api_key_analytics']);
	define("GOOGLETAG", $hotel[0]['api_key_googletag']);
	define("TEMPLATE", $hotel[0]['template']);
	define("IMG_FONDO", $hotel[0]['img_portada']);
	define("DESCRIPTIONS", $hotel[0]['description']);
  define("CHECKIN", $hotel[0]['check_in']);
  define("CHECKOUT", $hotel[0]['check_out']);
  define("ESTADO", $hotel[0]['active_at']);
  define("MMTO", $hotel[0]['mmto']);
  define("MENSAJEMMTO", $hotel[0]['textoMmto']);

	$hotelabout    = $user->getAboutHotel();	 
	$rooms         = $user->getRoomHotel();

	$userTwitter   = $user->getUserSocial('Twitter');
	$userGoogle    = $user->getUserSocial('Google');
	$userFacebook  = $user->getUserSocial('Facebook');
	$userInstagram = $user->getUserSocial('Instagram');



	$pc = gethostname();
	$ip = $_SERVER['REMOTE_ADDR'];
	if(!isset($_GET['section'])){
		$link    = '';		
	}else{
		/// $infoseo = $user->getInfoSeo($_GET['section'],ID_HOTEL);	
		$link    = $_GET['section'];
	}
	if(empty($infoseo)){
	}
	if(!isset($_GET['section'])){
	}elseif(isset($_GET['section']) && $_GET['section'] == 'home'){
		$sliders = $user->getSliderHotel(ID_HOTEL);	
	}elseif(isset($_GET['section']) && $_GET['section'] == 'about'){
		$totimages = $user->getCantidadImagenes(ID_HOTEL);
		$cant      = rand(1,($totimages-5));						
		$galleries = $user->getGallery($cant,5,ID_HOTEL);				
	}elseif(isset($_GET['section']) && $_GET['section'] == 'rooms'){
		$infoseo = $user->getInfoSeo($_GET['section'],ID_HOTEL);	
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'article'){
		$article = $user->getArticleInfo($_GET['url'],ID_HOTEL);
		$link = $_GET['url'];
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'news'){
		$news = $user->getNews(ID_HOTEL);
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'new'){
		$infonew = $user->getNewsInfo($_GET['url'],ID_HOTEL);
		$link    = $_GET['section'].'/'.$_GET['url'];
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'events'){
		$events = $user->getEvents(ID_HOTEL);
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'event'){
		$infoevent = $user->getEventsInfo($_GET['url'],ID_HOTEL);
		$link = $_GET['section'].'/'.$_GET['url'];
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'room'){
		$inforoom  = $user->getRoomInfo($_GET['url'],ID_HOTEL);
		$morerooms = $user->getMoreRoom($_GET['url'],ID_HOTEL);
		$images    = $user->getImagesRoom($inforoom[0]['id_room'],ID_HOTEL);
		$link = $_GET['section'].'/'.$_GET['url'];
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'destination'){
		$destination = $user->getDestinoInfo(ID_HOTEL,$_GET['id_destino']);
		$link = $_GET['url'];
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'hotel'){
		$hotel = $user->getHotelInfo(ID_HOTEL);
		$link = $_GET['url'];
	}elseif(isset($_GET['section']) &&	$_GET['section'] == 'tourism'){
		$tourisms = $user->getTourism(ID_HOTEL);
	}elseif(isset($_GET['section']) && $_GET['section'] == 'gallery'){ 
		$totimages = $user->getCantidadImagenes(ID_HOTEL); 
		if($totimages<20){
			$cant = 0 ;
		}else{
			$cant = rand(1,($totimages-20 )); 
		};
		$images = $user->getGallery($cant,20,ID_HOTEL);	
	}


 ?> 