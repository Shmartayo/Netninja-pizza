<?php
    //Connect to the database
    $conn = mysqli_connect("localhost","shmartayo","shmartayo1","pizza");

    //check if there are any errors
    if(!$conn){
        echo "Connection Error: " . mysqli_connect_error();
    }
?>