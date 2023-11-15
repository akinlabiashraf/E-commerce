<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpassword = "";
$dbname = "ecommerce";

$db_con = mysqli_connect($dbhost, $dbuser,$dbpassword,$dbname);

if(!$db_con){
    die("Database connection Error".mysqli_connect_error());
}?>