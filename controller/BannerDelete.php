<?php

include('../database/env.php');
session_start();

    $id = $_REQUEST['id'];

    $query = "DELETE FROM `banner` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);


    if (!$result) {
        echo "Query Failed: " . mysqli_error($connection);
    } else {
        header('Location: ../controller/BannerStore.php');
    }




?>
