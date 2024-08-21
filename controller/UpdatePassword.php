<?php
session_start();
include("../database/env.php");

$user_id = $_SESSION["auth"]["id"];
$old_password = $_REQUEST["oldpassword"];
$new_password = $_REQUEST["newpassword"];
$confirm_password = $_REQUEST["confirmpassword"];

$errors = [];

// Old password validation
if (empty($old_password)) {
    $errors["oldpassword_error"] = "Old Password is required";
}

// New password validation
if (empty($new_password)) {
    $errors["newpassword_error"] = "New Password is required";
} else if (strlen($new_password) < 8) {
    $errors["newpassword_error"] = "New Password must be at least 8 characters long";
} else if ($new_password !== $confirm_password) {
    $errors["confirmpassword_error"] = "New Password and Confirm Password do not match";
}

// Error handling
if (count($errors) > 0) {
    $_SESSION["errors"] = $errors;
    header("Location: ../dashboard/profile.php");
    exit();
} else {
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connection, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $hashed_password = $user["password"];

        if (password_verify($old_password, $hashed_password)) {
            $new_hashed_password = password_hash($new_password, PASSWORD_BCRYPT);
            $update_query = "UPDATE users SET password='$new_hashed_password' WHERE id = '$user_id'";
            $update_result = mysqli_query($connection, $update_query);

            if ($update_result) {
                $_SESSION["password_updated"] = true;
                header("Location: ../dashboard/profile.php");

            }
        } else {
            $errors["oldpassword_error"] = "Invalid Old password!";
            $_SESSION["errors"] = $errors;
            header("Location: ../dashboard/profile.php");

        }
    } else {
        $errors["user_error"] = "User Not found";
        $_SESSION["errors"] = $errors;
        header("Location: ../dashboard/profile.php");

    }
}
?>
