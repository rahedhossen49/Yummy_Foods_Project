<?php
session_start();


$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$ValidEmail = filter_var($email,FILTER_VALIDATE_EMAIL);
//Empty Error
$errors = [];





//Email Validation

if (empty($email)) {
  $errors['email_error'] = "Email Missing";
}elseif (!$ValidEmail) {
  $errors['email_error'] = "Email Invalid";
}




//Password Validation

if (empty($password)) {
  $errors['password_error'] = "Password Missing";
}elseif (strlen($password) < 8) {
  $errors['password_error'] = "Invalid Password";
}


//errror Found


if (count($errors) > 0) {

  $_SESSION['errors'] = $errors;
  header('Location: ../signin.php');
}
else {
  include('../database/env.php');
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($connection, $query);

     if ($result ->num_rows > 0){
     $res = mysqli_fetch_assoc($result);
     $encriptPassword = $res['password'];


    if (password_verify($password, $encriptPassword )){
     $_SESSION['auth'] = $res;
     header('Location: ../dashboard/index.php');
     }

    else{
    $errors['password_error'] = "Invalid Password";
    $_SESSION['errors'] = $errors;
    header('Location: ../signin.php');
  }

}else {
       $errors['email_error'] = 'Email not found!';
        $_SESSION['errors'] = $errors;
        header("Location: ../signin.php");

}

}


?>