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

    if(isset($_POST['register']))
    {
        $username = $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $passkey = $_POST['passkey'];

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

    }

    // Getting values from the HTML form
    if(isset($_POST['loginSubmit'])) {
        $username = $_POST['username'];
        $password = $_POST['loginPassword'];

        // Query to check if user exists
        $sql = "SELECT * FROM user WHERE username = '$username' AND passkey = '$password'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) == 1) {

            // Fetch user details
            session_start();
            $row = mysqli_fetch_assoc($result);
            $_SESSION['userId'] = $row['id'];

            // Redirect to a welcome page or dashboard
            header('Location: dashboard.html');
        } else {
            echo "Invalid username or password";
        }
    }

    if(isset($_POST['submitTask']))
    {
        session_start();
        $task = $_POST['task'];
        $due = $_POST['due'];
        $priority = $_POST['priority'];
        $subject = $_POST['subject'];
        $userid = $_SESSION['userId'];

        // using sql to create a data entry query
        $sql = "INSERT INTO weekly (task, due, priority, userid, category, completed) VALUES ('$task', '$due', '$priority', '$userid', '$subject', 0)";
    
        // send query to the database to add values and confirm if successful
        $rs = mysqli_query($con, $sql);
        if($rs)
        {
            echo "Tasks added!";
        }

        header('Location: viewTask.php');
    }

    if(isset($_POST['deleteUser']))
    {
        session_start();
        $userId = $_SESSION['userId'];
        $sql = "DELETE FROM user WHERE id = '$userId'";
        $result = mysqli_query($con, $sql);

        if($result)
        {
            echo "User Deleted!";
        }

        header('Location: login.html');
    }

    if(isset($_POST['changePassword']))
    {
        session_start();
        $userid = $_SESSION['userId'];
        $passkey = $_POST['passkey'];

        $sql = "Update user set passkey = '$passkey' WHERE id = '$userid'";
        $result = mysqli_query($con, $sql);

        if($result)
        {
            echo "Password Changed!";
        }

        header('Location: login.html');
    }

    if(isset($_POST['editTask']))
    {
        session_start();
        $task = $_POST['task'];
        $due = $_POST['due'];
        $priority = $_POST['priority'];
        $subject = $_POST['subject'];
        $id = $_POST['id'];

        // using sql to create a data entry query
        $sql = "update weekly set task = '$task', due = '$due', priority = '$priority', category = '$subject', completed = 0 where id = '$id'";
    
        // send query to the database to add values and confirm if successful
        $rs = mysqli_query($con, $sql);
        if($rs)
        {
            echo "Tasks edited!";
        }

        header('Location: viewTask.php');
    }

    // Close connection
    mysqli_close($con);
?>