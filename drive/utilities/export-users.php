<?php
/**
 * Place this file inside the root of your Veno File Manager
 */
function users2csv($users) {

   $headers = array();

   foreach ($users as $user) {
      foreach ($user as $key => $userdata) {
         unset($user['pass']);
         if (!in_array($key, $headers) && 'pass' !== $key) {
            $headers[] = $key;
         }
      }
   }

   $set_headers = array(
      $headers
   );

   $new_users = array();

   foreach ($users as $key => $user) {
      $new_users[$key] = array();

      foreach ($headers as $header) {
         $uservalue = isset($user[$header]) ? $user[$header] : '';
         $new_users[$key][] = $uservalue;
      }
   }

   $fp = fopen('users-export.csv', 'w');

   foreach ($set_headers as $header) {
      fputcsv($fp, $header);
   }
   foreach ($new_users as $key => $user) {
         fputcsv($fp, $user);
   }
   fclose($fp);
   echo "File created, download users-export.csv from /the root of your Veno File Manager";
   unlink(__FILE__);
}

include 'vfm-admin/users/users.php';

users2csv($_USERS);
