<?php
include_once '../res/php/app_topFE.php';
include_once '../views/layout/top.php';

if (!isset($_GET['section'])) {
            require 'views/home.php';
        } elseif (isset($_GET['section']) && $_GET['section'] == 'index') {
            require 'views/home.php';
        }
?>







<?php 
 include ('../views/layout/bottom.php');
 ?> 