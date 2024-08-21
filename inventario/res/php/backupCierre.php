<?php 

	require_once '../../../res/php/rutas.php' ;
	require_once '../../../res/php/configdb.php' ;
  require_once '../../../res/php/app_topInventario.php'; 


  $fecha = date('Y-m-d');

  $connection = [ 
    'host'      => $server,
    'database'  => $dbname,
    'user'      => $dbuser,
    'password'  => $dbpass,
    'charset'   => 'utf8',
    'collation' => 'utf8_spanish_ci'
  ];
  $bckname        = 'INV_'.$dbname.'_'.$fecha;

  define("DB_HOST", $server);
  define("DB_NAME", $dbname);
  define("DB_USER", $dbuser);
  define("DB_PASSWORD", $dbpass);
  define("BACKUP_DIR", "../../backups"); // Comment this line to use same script's directory ('.')
  define("TABLES", '*'); // Full backup
  //define("TABLES", 'table1, table2, table3'); // Partial backup
  define("CHARSET", 'utf8');
  define("GZIP_BACKUP_FILE", true); // Set to false if you want plain SQL backup files (not gzipped)
  define("DISABLE_FOREIGN_KEY_CHECKS", true); // Set to true if you are having foreign key constraint fails
  define("BATCH_SIZE", 1000); // Batch size when selecting rows from database in order to not exhaust system 
  define("BCK_NAME",$bckname); // Nombre Backup Archivo de Salida  
  $backupDatabase = new Backup_Database(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, CHARSET, BCK_NAME);
  $result  = $backupDatabase->backupTables(TABLES, BACKUP_DIR) ? 1 : 0 ;
  echo $result;
  /// $backupDatabase->obfPrint('Backup result: ' . $result, 1);


 ?>
