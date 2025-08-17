<?php 
  error_reporting(E_ALL);
  ini_set('display_errors', '1');
  setlocale(LC_ALL,"es_CO.utf8","es_CO","esp")  ;
  require 'function_admin.php';
  require 'funciones_admin.php';

  $admin = new Admin_Actions();
  $user  = new User_Actions();

  echo HOTEL_ID; 

  $hotel = $user->getHotelInfo(HOTEL_ID); 

  define("TITLE", $hotel[0]['title_web']);
  define('ID_HOTEL', $hotel[0]['id_hotel']);
  define("NAME_HOTEL", $hotel[0]['hotel_name']);
  define("NIT_HOTEL", $hotel[0]['nit_hotel']);
  define("WEB_HOTEL", $hotel[0]['web']);
  define("MAIL_HOTEL", $hotel[0]['email']);
  define("MAIL_CONTACT", $hotel[0]['email_contact']);
  define("MAIL_BOOKING", $hotel[0]['email_book']);
  define("ADRESS_HOTEL", $hotel[0]['adress']);
  define("PHONE_HOTEL", $hotel[0]['phone']);
  define("MOVIL_HOTEL", $hotel[0]['movil']); 
  define("CITY_HOTEL", $hotel[0]['city']);
  define("LAND_HOTEL", $hotel[0]['land']);
  define("LOGO_HOTEL", $hotel[0]['logo']);
  define("CHECKIN", $hotel[0]['check_in']);
  define("CHECKOUT", $hotel[0]['check_out']);


  if(isset($_SESSION['admin']) && !isset($_GET['section'])){    
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'booking'){
    $hoy          = date('Y-m-d');
    $nuevafecha   = strtotime ( '-1 day' , strtotime ( $hoy ) ) ;
    $hoy          = date ( 'Y-m-j' , $nuevafecha );    
    $fecha        = strtotime($hoy) ; 
    $reservations = $user->getBookingStatus(HOTEL_ID,$_GET['status'],$fecha);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'dataCompany'){
    $companys = $admin->getInfoCompany(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'roomrates'){
    $rooms = $admin->getRooms(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'social'){
    $socials = $admin->socialMenu(HOTEL_ID); 
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'users'){
    $users = $admin->getUsers(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'rooms'){
    $rooms = $admin->getRooms(HOTEL_ID); 
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'plans'){
    $plans = $admin->getPlans(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'articles'){
    $articles = $admin->getArticles(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'events'){
    $events = $admin->getEvents(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'news'){
    $news = $user->getNews(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'tourism'){
    $tourims = $user->getTourism(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'sliders'){
    $sliders = $user->getSliders(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'galeria'){
    $images = $admin->getGallery(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'menus'){
    $menus = $admin->getMenus(HOTEL_ID);
  }elseif(isset($_SESSION['admin']) && isset($_GET['section']) && $_GET['section'] == 'general'){
  }elseif(isset($_GET['section']) && $_GET['section'] == 'rooms'){ 
    $totimages = $user->getCantidadImagenes(ID_HOTEL);
  }elseif(isset($_GET['section']) &&  $_GET['section'] == 'article'){
    $article = $user->getArticleInfo($_GET['id_article']);
  }elseif(isset($_GET['section']) &&  $_GET['section'] == 'room'){
    $inforoom = $user->getRoomInfo($_GET['id_room']);
    $images = $user->getImagesRoom($_GET['id_room']);
  }elseif(isset($_GET['section']) &&  $_GET['section'] == 'destination'){
    //  Obtener Info del Destino
    $destination = $user->getDestinoInfo(ID_HOTEL,$_GET['id_destino']);
    // $destinations = $user->getDestinos(ID_HOTEL);
    // Obtener el Perfil del Usuario
    if(isset($_SESSION['user'])){ 
      $profile = $user->getProfile($_SESSION['user']) ;
      // VErificar que la publicaicon visitada ya este en favoritos   
      $check = $user-> checkFavorites($profile[0]['user_id'],$_GET['post_id']);
    }
  }elseif(isset($_GET['section']) &&  $_GET['section'] == 'hotel'){
    //  Obtener Info del Destino
    $hotel = $user->getHotelInfo(ID_HOTEL,$_GET['id_HOTEL']);
 //  }elseif(isset($_GET['section']) && $_GET['section'] == 'gallery'){
    //  Obtener Publicaciones
    // $gallery = $user->getGallery();       
  }elseif(isset($_SESSION['user']) && isset($_GET['section']) && $_GET['section'] == 'my-favorites'){
    $profile = $user->getProfile($_SESSION['user']);
    $posts = $user->getMyFavorites($profile[0]['user_id']);
  }


 ?> 