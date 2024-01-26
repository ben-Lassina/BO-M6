<?php

include '../source/config.php';
function database_connect()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_SCHEMA); 


 if ($conn->connect_errno) {
    die( 'Failed to connect to MySQL: ' . $conn->connect_error );
 }
 return $conn;
}