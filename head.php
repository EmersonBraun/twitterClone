<?php 
session_start(); 
require_once('db.class.php');

$objDb = new db();
$link = $objDb->conecta_mysql();

?>