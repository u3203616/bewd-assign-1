<?php

$host       = "localhost";
$username   = "conorf14_admin";
$password   = ";7]$]1St3-@S";
$dbname     = "conorf14_tasktrack"; 
$dsn        = "mysql:host=$host;dbname=$dbname"; 
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

/* Attempt to connect to MySQL database */
try{
    $pdo_connection = new PDO($dsn, $username, $password, $options);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>