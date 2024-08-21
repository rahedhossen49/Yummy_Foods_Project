<?php
session_start();
include('../database/env.php');

$name = $_REQUEST['username'];
$email = $_REQUEST['email'];
$userId = $_SESSION['auth']['id'];
$ProfileImage = $_FILES['profile'];
$extension = pathinfo($ProfileImage['name'])['extension'] ?? null;
$isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
$acceptableExtension = ['jpg', 'png',];


// error_validation
$errors = [];


//userName validation

if (empty($name)) {
  $errors['name_error'] = "Name Is Missing.";
}



//email validation

if (empty($email)) {
  $errors['email_error'] = "Email Is Missing.";
} elseif (!$isValidEmail) {
  $errors['email_error'] = "Invalid Email";
} else {
  $id = $_SESSION['auth']['id'];
  $query = "SELECT email FROM users WHERE email = '$email' AND id != '$id' ";
  $result = mysqli_query($connection, $query);

  if ($result->num_rows > 0) {

    $errors['email_error'] = "Email Is Already Available";
  }
}




// Image validationn

if ($ProfileImage['size'] > 0) {
  if (!in_array($extension, $acceptableExtension)) {
    $errors['profileImg_error'] = " $extension is not acceptable. Acceptable types are: " . implode(', ', $acceptableExtension);
  }
}




// Error found
if (count($errors) > 0) {

  $_SESSION['errors'] = $errors;
  header('Location: ../dashboard/Profile.php');
} else {
  if ($ProfileImage['size'] > 0) {
    define('UPLOAD_PATH', '../Uploads');
    if (!file_exists(UPLOAD_PATH)) {
      mkdir(UPLOAD_PATH);
    }

    //Remove old profile
    $OldProfileImage = '../' . $_SESSION['auth']['profile'];
    if (!empty($OldProfileImage) && file_exists($OldProfileImage)) {
      unlink($OldProfileImage);
    }


    $fileName = pathinfo($ProfileImage['name'],)['filename'] . '-' . uniqid() . '.' . $extension;
    move_uploaded_file($ProfileImage['tmp_name'], UPLOAD_PATH . "/$fileName");

    $query = "UPDATE `users` SET `username`='$name', `email`='$email', `profile`='Uploads/$fileName' WHERE id = '$userId'";
  } else {
    $query = "UPDATE `users` SET `username`='$name', `email`='$email' WHERE id = '$userId'";
  }

  $res = mysqli_query($connection, $query);

  if ($res) {
    $_SESSION['auth']['username'] = $name;
    $_SESSION['auth']['email'] = $email;
    $_SESSION['success'] = true;
    if ($ProfileImage['size'] > 0) {
      $_SESSION['auth']['profile'] = "Uploads/$fileName";
    }
    header('Location: ../dashboard/Profile.php');
  }
}
