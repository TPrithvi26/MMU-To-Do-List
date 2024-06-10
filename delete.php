<?php
    // Database details
    $host = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "mmu";

    // Creating a connection
    $con = mysqli_connect($host, $db_username, $db_password, $dbname);

    // Check connection
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_REQUEST['id'];
    $sql = "DELETE FROM weekly WHERE id = '$id'";
    $result = mysqli_query($con, $sql);

    if($result)
    {
        echo "Task Deleted!";
    }

    header('Location: viewTask.php');


    // Close connection
    mysqli_close($con);
?>