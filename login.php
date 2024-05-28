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

    // Getting values from the HTML form
    if(isset($_POST['loginSubmit'])) {
        $email = $_POST['loginEmail'];
        $password = $_POST['loginPassword'];

        // Query to check if user exists
        $sql = "SELECT * FROM user WHERE email = '$email' AND passkey = '$password'";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) == 1) {
            // Start a session
            session_start();

            // Fetch user details
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];

            // Redirect to a welcome page or dashboard
            header('Location: dashboard.html');
            exit();
        } else {
            echo "Invalid email or password";
        }
    }

    // Close connection
    mysqli_close($con);
?>
