<?php

include('../database/env.php');


    $id = $_REQUEST['id'];
    $query = "DELETE FROM `categories` WHERE id = '$id'";
    $result = mysqli_query($connection, $query);


    if (!$result) {
        echo "Query Failed: " . mysqli_error($connection);
    } else {
        header('Location: ../dashboard/Categories.php');
    }




?>
