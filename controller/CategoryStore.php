<?php
session_start();

$title = $_REQUEST['title'] ?? null;
$id = $_REQUEST['id'] ?? null;
$errors = [];



// Validation
if (empty($title)) {
  $errors['title_error'] = "Title is missing";
}






if (count($errors) > 0) {
  $_SESSION["errors"] = $errors;
  header('Location: ../dashboard/Categories.php');
}else {
  include '../database/env.php';
  $query = $id ?
  "UPDATE `categories` SET `title`='$title' WHERE id = $id"
  : "INSERT INTO categories (title) VALUES ('$title')";
  $result = mysqli_query($connection, $query);
}if ($result) {
  $_SESSION["success"] = true;
  header('Location: ../dashboard/Categories.php');


}


?>