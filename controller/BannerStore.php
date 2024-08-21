<?php
session_start();
$title = $_REQUEST['title'] ?? null;
$detail = $_REQUEST['detail'] ?? null;
$ctaTitle = $_REQUEST['ctaTitle'] ?? null;
$ctaLink = $_REQUEST['ctaLink'] ?? null;
$videoLink = $_REQUEST['videoLink'] ?? null;
$bannerImage = $_FILES['banner_img'] ?? null;
$extension = pathinfo($bannerImage['name'])['extension'] ?? null;

$acceptedExtensions = ['jpg', 'png'];
$errors = [];

// Validation
if (empty($title)) {
  $errors['title_error'] = "Title is missing";
}

if (empty($detail)) {
  $errors['detail_error'] = "Detail is missing";
}

if ($bannerImage['size'] == 0) {
  $errors['bannerImage_error'] = "Banner image is missing";
} elseif (!in_array($extension, $acceptedExtensions)) {
  $errors['bannerImage_error'] = "$extension is not acceptable! Acceptable extensions: " . join(', ', $acceptedExtensions);
}

if (count($errors) > 0) {
  $_SESSION["errors"] = $errors;
  $_SESSION["banner"] = [];
  header('Location: ../dashboard/banner.php');
} else {

  define("UPLOAD_PATH", "../Uploads");
    if (!file_exists(UPLOAD_PATH)) {
        mkdir(UPLOAD_PATH);
    }
  $fileName = 'Banner-' . uniqid() . ".$extension";
  move_uploaded_file($bannerImage['tmp_name'], UPLOAD_PATH . "/$fileName");
  include('../database/env.php');


    $query = "UPDATE `banner` SET `status` = 0";
    mysqli_query($connection, $query);

    $query = "INSERT INTO banner (title, detail,  cta_link, cta_title, video_link, banner_img) VALUES ('$title','$detail','$ctaLink','$ctaTitle','$videoLink','./Uploads/$fileName')";


$res = mysqli_query($connection, $query);


  if ($res) {
    $query = "SELECT * FROM banner WHERE status = 1";
    $result = mysqli_query($connection, $query);
    $banner = mysqli_fetch_assoc($result);
    $_SESSION["banner"] = $banner;
    $_SESSION["success"] = true;
    header("Location: ../dashboard/banner.php");
  }
}
?>
