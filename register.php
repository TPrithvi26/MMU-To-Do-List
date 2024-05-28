<?php
    // getting all values from the HTML form
    if(isset($_POST['submit']))
    {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $passkey = $_POST['passkey'];
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
    $sql = "INSERT INTO user (username, firstname, lastname, phone, email, passkey) VALUES ('$username', '$firstname', '$lastname', '$phone', '$email', '$passkey')";
  
    // send query to the database to add values and confirm if successful
    $rs = mysqli_query($con, $sql);
    if($rs)
    {
        echo "Entries added!";
    }
  
    // close connection
    mysqli_close($con);
    header('Location: login.html ');
?>