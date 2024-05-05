 <?php
 
// require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);
echo print_r($postBody);