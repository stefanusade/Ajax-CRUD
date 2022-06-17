<?php

$host   = 'localhost';
$user   = 'root';
$pass   = '';
$db     = 'dbajax';

$conn   = mysqli_connect($host,$user,$pass,$db);

if($conn->connect_errno) {
    echo "DATABASE ERROR";
    exit;
}