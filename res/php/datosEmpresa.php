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

  echo json_encode($empresa);
