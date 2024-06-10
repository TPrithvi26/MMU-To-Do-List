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
 
  session_start();
  $userId = $_SESSION['userId'];
  $sql = "SELECT * FROM user WHERE id = '$userId'";
  $result = mysqli_query($con, $sql);
  if(mysqli_num_rows($result)>0)
    {

    while($res = mysqli_fetch_array($result)){

    $username = $res['username'];
    $firstname = $res['firstname'];
    $lastname = $res['lastname'];
    $phone = $res['phone'];
    $email = $res['email'];

    }  
    }
  // Close connection
  mysqli_close($con);
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>User Profile</title>
  <style>
    body {
      font-family: "Poppins", sans-serif;
      line-height: 1.5;
      background-color: #8052ec;
      color: #fff;
    }

    h1 {
      color: #fff;
    }

    .container {
      max-width: 600px;
      width: 30%;
      margin: 122px auto;
    }

    form {
      width: 100%;
    }

    label {
      font-weight: bold;
      margin-bottom: 15px;
      color: #fff;
    }

    input,
    textarea {
      font-family: "Poppins", sans-serif;
      width: 85%;
      border: 2px solid #d1d3d4;
      background: #fff;
      margin: 0 0 5px;
      padding: 10px;
      color: #111;
    }

    fieldset {
      border: medium none !important;
      margin: 0 0 10px;
      min-width: 100%;
      padding: 0;
      width: 100%;
    }

    button {
      cursor: pointer;
      width: 90%;
      border: none;
      background: #8052ec;
      color: #fff;
      margin: 0 0 5px;
      padding: 10px;
      font-size: 15px;
    }

    p {
      color: #fff;
    }

    .login-link {
      margin-top: -23px;
      text-align: center;
      color: #d161ff;
    }

  </style>
</head>

<body>

  <h1>Profile Details</h1>
  <div class="container">
    <h3>User Name: <p><?php echo $username;?><p></h3>
    <h3>First Name: <p><?php echo $firstname;?><p></h3>
    <h3>Second Name: <p><?php echo $lastname;?><p></h3>
    <h3>Phone Number: <p><?php echo $phone;?><p></h3>
    <h3>Email: <p><?php echo $email;?><p></h3>
    <a href="changePassword.html">
      <button>Change Password</button>
    </a>
    <a href="login.html">
      <button>Logout</button>
    </a>
    
  <form action="db.php" method="post">
    <input type="submit" name="deleteUser" value="Delete">
  </form>
  </div>

  

</body>
</html>
