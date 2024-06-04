<?php
    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $task = $_POST['task'];
        $due = $_POST['due'];
        $priority = $_POST['priority'];
        $userid = 12;
    }

    // database details
    $host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mmu";

    // creating a connection
    $con = mysqli_connect($host, $username, $password, $dbname);

    // to ensure that the connection is made
    if (!$con)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // using sql to create a data entry query
    $sql = "INSERT INTO weekly (task, due, priority, userid) VALUES ('$task', '$due', '$priority', '$userid')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Tasks added!";
    }
  
    // close connection
    mysqli_close($con);
    header('Location: weekly.html ');
?>