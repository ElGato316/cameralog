<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'cameralog';

$link = mysqli_connect($host, $user, $password, $database);

//Check Connection
if (!$link) {
    die("Connection Failed: " . mysqli_connect_error());
}
