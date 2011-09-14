<?php

function db_query ($query) {
   $host = 'localhost';
   $user = 'trail_contest';
   $pass = 'contest55xx45'; // For live site
   $db = 'trail_contest';
   $link = mysql_connect($host, $user, $pass);
   mysql_select_db($db);
   $result=mysql_query($query, $link);
   return($result);
} # End function db_query ()

function db_fetch_array ($result) {
   $array = mysql_fetch_array($result);
   return $array;
}

?>
