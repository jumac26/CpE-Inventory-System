<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "cpe_inventory_system";

if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname))
{
	die("failed to connect!");
}

?>