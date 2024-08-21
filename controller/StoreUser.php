<?php
session_start();
include('../database/env.php');
$userName = $_REQUEST['username'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirm_password = $_REQUEST['confirm_password'];
$terms = $_REQUEST['terms'] ?? false;
$isValidEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
$encPassword = password_hash($password, PASSWORD_BCRYPT);



// error_validation
$errors = [];





//userName validation

if (empty($userName)) {
  $errors['username_error'] = "Please enter your username.";
}



//email validation

if (empty($email)) {
  $errors['email_error'] = "Please enter your email.";
}elseif (!$isValidEmail) {
  $errors['email_error'] = "Invalid email address.";
}



//password validation

if (empty($password)) {
  $errors['password_error'] = "Please enter your password.";
}elseif (strlen($password) < 8) {
  $errors['password_error'] = "Password must be at least 8 characters.";
}elseif ($password !== $confirm_password) {
  $errors['password_error'] = "Passwords do not match.";
}


//terms validation

if (!$terms) {
  $errors['terms_error'] = "You must agree to the terms.";
}

//error validation


if (count($errors) > 0) {

  $_SESSION['errors'] = $errors;
  header('Location: ../signup.php');

}
else {
  $query = "INSERT INTO users(username, email, password) VALUES ('$userName','$email','$encPassword')";
  $res = mysqli_query($connection,$query);

  if($res){
      $_SESSION['success'] = "Sign up Successfully";
      header("Location: ../signin.php");
  }


}

?>
