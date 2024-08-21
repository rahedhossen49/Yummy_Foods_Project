<?php


$DatabaseHostName = 'localhost';
$DatabaseUserName = 'root';
$DatabasePassword = '';
$DatabaseName = 'yummy_food';


$connection = mysqli_connect($DatabaseHostName,$DatabaseUserName,$DatabasePassword,$DatabaseName);


if (!$connection) {
 die('Could not connect: ' . mysqli_connect_error());
}



?>