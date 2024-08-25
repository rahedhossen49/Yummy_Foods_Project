<?php
session_start();
$title = $_REQUEST['title'] ?? null;
$detail = $_REQUEST['detail'] ?? null;
$price = $_REQUEST['price'] ?? null;
$FoodImage = $_FILES['food_img'] ?? null;
$extension = pathinfo($FoodImage['name'])['extension'] ?? null;

$acceptedExtensions = ['jpg', 'png'];
$errors = [];

// Validation
if (empty($title)) {
  $errors['title_error'] = "Title is missing";
}

if (empty($detail)) {
  $errors['detail_error'] = "Detail is missing";
}

if (empty($price)) {
  $errors['price_error'] = "Price is missing";
}

if ($FoodImage['size'] == 0) {
  $errors['foodImg_error'] = "Food image is missing";
} elseif (!in_array($extension, $acceptedExtensions)) {
  $errors['foodImg_error'] = "$extension is not acceptable! Acceptable extensions: " . join(', ', $acceptedExtensions);
}

if (count($errors) > 0) {
  $_SESSION["errors"] = $errors;
  header('Location: ../dashboard/Foods.php');
} else {

  define("UPLOAD_PATH", "../Uploads");
    if (!file_exists(UPLOAD_PATH)) {
        mkdir(UPLOAD_PATH);
    }
  $fileName = 'Food-' . uniqid() . ".$extension";
  move_uploaded_file($FoodImage['tmp_name'], UPLOAD_PATH . "/$fileName");
  include('../database/env.php');


    $query = "UPDATE `foods` SET `status` = 0";
    mysqli_query($connection, $query);

   $query = "INSERT INTO `foods`(`title`, `details`, `price`, `food_img`) VALUES ('$title','$detail','$price','./Uploads/$fileName')";

$res = mysqli_query($connection, $query);


  if ($res) {
    $query = "SELECT * FROM foods WHERE status = 1";
    $result = mysqli_query($connection, $query);
    $Food = mysqli_fetch_assoc($result);
    $_SESSION["food"] = $Food;
    $_SESSION["success"] = true;
    header("Location: ../dashboard/Foods.php");
  }
}
?>
