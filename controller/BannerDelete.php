<?php

include('../database/env.php');
session_start();

if (isset($_GET['id'])) {
    $id = ($_GET['id']);

    $query = "DELETE FROM `banner` WHERE `id` = '$id'";
    $_SESSION["delete"] = true;
    $result = mysqli_query($connection, $query);


    if (!$result) {
        echo "Query Failed: " . mysqli_error($connection);
    } else {
        header('Location: ../controller/BannerStore.php');
    }
}



?>
