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
$sql = "SELECT * FROM weekly WHERE id = '$id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
// Close connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Update Task</title>
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="task.css">
    <style>
        /* Additional CSS for photo gallery */
        body {
            margin: 0;
            padding: 0;
            background: url('file:///C:/Users/User/Downloads/compressed_1f6c97428b2244f5128e486cc7e90062.webp') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }
        .container {
            margin: 0 auto;
            max-width: 800px;
            padding: 20px;
            background-color: rgba(190, 2, 2, 0.5); /* Semi-transparent background */
            border-radius: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent background for table */
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: #fff; /* Text color */
        }
        th {
            background-color: #333; /* Header background color */
        }
        #newtask {
            background-color: rgba(255, 255, 255, 0.1); /* Semi-transparent background for task input area */
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        #newtask input[type="text"], #newtask input[type="date"], #newtask select, #newtask button {
            margin-right: 10px;
        }
        #newtask input[type="text"], #newtask input[type="date"], #newtask select {
            padding: 8px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.7); /* Semi-transparent background for input fields */
            color: #333; /* Text color */
        }
        #push {
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #333; /* Button background color */
            color: #fff; /* Button text color */
            cursor: pointer;
        }
        #push:hover {
            background-color: #555; /* Button background color on hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="newtask">
            <form action="db.php" method="post">
                <label>Task Details</label>
                <br>
                <input type="text" name="task" id="task" placeholder="Task to be done.." value="<?php echo $row['task'];?>">
                <br>
                <label>Due Date</label>
                <br>
                <input type="date" name="due" id="due" value="<?php echo date($row['due']);?>"> <!-- Added input for due date -->
                <br>
                <label>Priority</label>
                <br>
                <select name="priority" id="priority" > <!-- Added select for priority level -->
                    <option value="low" <?php if($row['priority']=="low") echo 'selected="selected"' ?> >Low</option>
                    <option value="medium" <?php if($row['priority']=="medium") echo 'selected="selected"' ?>>Medium</option>
                    <option value="high" <?php if($row['priority']=="high") echo 'selected="selected"' ?>>High</option>
                </select>
                <br>
                <label>Subject</label>
                <br>
                <select name="subject" id="subject"> <!-- Added select for subject -->
                    <option value="computerScience" <?php if($row['category']=="computerScience") echo 'selected="selected"' ?> >Computer Science</option>
                    <option value="mathematics" <?php if($row['category']=="mathematics") echo 'selected="selected"' ?>>Mathematics</option>
                    <option value="literature" <?php if($row['category']=="literature") echo 'selected="selected"' ?>>Literature</option>
                    <option value="arts" <?php if($row['category']=="arts") echo 'selected="selected"' ?>>Arts</option>
                </select>
                <br>
                <input name="id" type="hidden" value="<?php echo $row['id'];?>" />
                <input type="submit" id="submit" name="editTask" value="Edit">
                <p><a href="viewTask.php">Cancel</a> </p>
            </form>
        </div>
    </div>
</body>
</html>
