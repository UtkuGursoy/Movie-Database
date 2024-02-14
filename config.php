<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'step5';

$connection = mysqli_connect($servername,$username,$password,$database);

if($connection->connect_errno > 0){
    die('Unable to connect to database [' . $connection->connect_error . ']');
}

?>