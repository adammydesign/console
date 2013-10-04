<?php
 // db properties
define('DBHOST','localhost');
define('DBUSER','bodnant_user');
define('DBPASS','Bo-GibsoN132%');
define('DBNAME','bodnant_c0nsole');
 
// make a connection to mysql here
$conn = @mysql_connect (DBHOST, DBUSER, DBPASS);
$conn = @mysql_select_db (DBNAME);
if(!$conn){
	die( "Sorry! There seems to be a problem connecting to our database.");
}
?>