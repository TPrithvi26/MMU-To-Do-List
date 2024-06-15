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
  $sql = "SELECT * FROM weekly WHERE userid = '$userId'";
  $result = mysqli_query($con, $sql);


    $tempSubjectArts = 'Arts';
    $tempSubjectLiterature = 'Literature';
    $tempSubjectComputerScience = 'Computer Science';
    $tempSubjectMathematics = 'Mathematics';

    $tempSubjectArtsCount = 0;
    $tempSubjectLiteratureCount = 0;
    $tempSubjectComputerScienceCount = 0;
    $tempSubjectMathematicsCount = 0;
    
    $rows = array();

    while($data = mysqli_fetch_assoc($result)){
        $temp = array();
        $tempSubject = 'default';
        if ($data['category'] == 'arts') {
            $tempSubjectArtsCount = $tempSubjectArtsCount + 1;
        } elseif ($data['category'] == 'literature') {
            $tempSubjectLiteratureCount = $tempSubjectLiteratureCount + 1;
        } elseif ($data['category'] == 'computerScience') {
            $tempSubjectComputerScienceCount = $tempSubjectComputerScienceCount + 1;
        } elseif ($data['category'] == 'mathematics') {
            $tempSubjectMathematicsCount = $tempSubjectMathematicsCount + 1;
        }
    }
    $temp = array();
    $temp[] = array('v' => $tempSubjectArts . ' - ' . $tempSubjectArtsCount);
    $temp[] = array('v' => $tempSubjectArtsCount);
    $rows[] = array('c' => $temp);

    $temp = array();
    $temp[] = array('v' => $tempSubjectLiterature . ' - ' . $tempSubjectLiteratureCount);
    $temp[] = array('v' => $tempSubjectLiteratureCount);
    $rows[] = array('c' => $temp);

    $temp = array();
    $temp[] = array('v' => $tempSubjectComputerScience . ' - ' . $tempSubjectComputerScienceCount);
    $temp[] = array('v' => $tempSubjectComputerScienceCount);
    $rows[] = array('c' => $temp);

    $temp = array();
    $temp[] = array('v' => $tempSubjectMathematics . ' - ' . $tempSubjectMathematicsCount);
    $temp[] = array('v' => $tempSubjectMathematicsCount);
    $rows[] = array('c' => $temp);

    $result = mysqli_query($con, $sql);

    while($data = mysqli_fetch_assoc($result)){
        $table = array();
        $table['cols'] = array(
            array('label' => 'Subject', 'type' => 'string'),
            array('label' => 'Count', 'type' => 'number')
        );
        $table['rows'] = $rows;
        $jsonTable = json_encode($table);
        break;
    }

    $result = mysqli_query($con, $sql);

    

  $subjectFilter = 'all';
  $priorityFilter = 'all';
  $today = date("Y-m-d");

  // Close connection
  mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);
    var options = {'title':'Subject',
                    'width':500,
                    'height':400};
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
</script>
<title>View Tasks</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.html">Back to Dashboard</a> <br>
    <a href="addTask.html">Insert New Task</a></p>
<h2>View Tasks</h2>
<?php
if(isset($_POST['subject']))
{
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
    
    $subject = $_POST['subject'];
    $priority = $_POST['priority'];
    if ($subject == 'all') {
        $userId = $_SESSION['userId'];
        $sql = "SELECT * FROM weekly WHERE userid = '$userId'";
    } 
    else {
        $sql = "SELECT * FROM weekly WHERE userid = '$userId' && category = '$subject'";
    }

    if ($priority != 'all') {
        $sql = $sql . " && priority = '$priority'";
    } 

    $subjectFilter = $subject;
    $priorityFilter = $priority;
    $result = mysqli_query($con, $sql);
    mysqli_close($con);
}
?>
<form name="form" method="post" action=""> 
<label>Subject</label>
<br>
<select name="subject" id="subject"> <!-- Added select for subject -->
    <option value="all" <?php if($subjectFilter=="all") echo 'selected="selected"' ?>>All</option>
    <option value="computerScience" <?php if($subjectFilter=="computerScience") echo 'selected="selected"' ?>>Computer Science</option>
    <option value="mathematics" <?php if($subjectFilter=="mathematics") echo 'selected="selected"' ?>>Mathematics</option>
    <option value="literature" <?php if($subjectFilter=="literature") echo 'selected="selected"' ?>>Literature</option>
    <option value="arts" <?php if($subjectFilter=="arts") echo 'selected="selected"' ?>>Arts</option>
</select>
<br>
<label>Priority</label>
<br>
<select name="priority" id="priority"> <!-- Added select for priority level -->
    <option value="all" <?php if($priorityFilter=="all") echo 'selected="selected"' ?>>All</option>
    <option value="low" <?php if($priorityFilter=="low") echo 'selected="selected"' ?>>Low</option>
    <option value="medium" <?php if($priorityFilter=="medium") echo 'selected="selected"' ?>>Medium</option>
    <option value="high" <?php if($priorityFilter=="high") echo 'selected="selected"' ?>>High</option>
</select>
<p><input name="submit" type="submit" value="Filter" /></p>
</form>
<table width="100%" border="1" style="border-collapse:collapse;">
<thead>
<tr>
<th><strong>Task Details</strong></th>
<th><strong>Due Date</strong></th>
<th><strong>Priority</strong></th>
<th><strong>Subject</strong></th>
<th><strong>Completion</strong></th>
<th><strong>Overdue</strong></th>
</tr>
</thead>
<tbody>
<?php
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
<td align="center"><?php echo $row["task"]; ?></td>
<td align="center"><?php echo $row["due"]; ?></td>
<td align="center"><?php 
    if ($row["priority"] == "low") {
        echo "Low";
    } elseif ($row["priority"] == "medium") {
        echo "Medium";
    } else {
        echo "High";
    }
 ?></td>
<td align="center"><?php 
    if ($row["category"] == "literature") {
        echo "Literature";
    } elseif ($row["category"] == "mathematics") {
        echo "Mathematics";
    } elseif ($row["category"] == "computerScience") {
        echo "Computer Science";
    } elseif ($row["category"] == "arts") {
        echo "Arts";
    }
 ?></td>
<td align="center"><?php 
    if ($row["completed"] == 0) {
        echo "Incomplete";
    } else {
        echo "Completed";
    }
 ?></td>
 <td align="center"><?php 
    if (date($row['due']) <= $today) {
        echo "Yes";
    } else {
        echo "No";
    }
 ?></td>
<td align="center">
<a href="editTask.php?id=<?php echo $row["id"]; ?>">Edit</a>
</td>
<td align="center">
<a href="completion.php?id=<?php echo $row["id"]; ?>">Completed</a>
<td align="center">
<a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
<div id="chart_div"></div>
</body>
</html>