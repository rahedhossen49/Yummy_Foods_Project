<?php
include('../database/env.php');
$id = $_REQUEST['id'];
$setus = $_REQUEST['status'] == 0 ? true : false;


$query = "UPDATE foods SET status = '$setus' WHERE id = '$id'";
$res = mysqli_query($connection,$query);

if ($res) {
  header('Location: ../dashboard/Foods.php');
}


















?>