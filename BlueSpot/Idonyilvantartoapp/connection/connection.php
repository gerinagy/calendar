<?php

$dbhost = "127.0.0.1";
$dbuser = "testuser";
$dbpass = "testpassword";
$dbname = "idonyilvantarto";


if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{

	die("failed to connect!");
}


