<?php 

require './config.php';

$startTime = $_POST['startTime'];
$endTime = $_POST['endTime']; 
$id = $_SESSION['memberData']['id'];

$sql = "UPDATE members SET start_time ='$startTime',end_time ='$endTime' WHERE id = '$id'";

$result = $conn->query($sql);

if ($result == 1) {
  $_SESSION["memberData"]["start_time"] = $startTime;
  $_SESSION["memberData"]["end_time"] = $endTime;
  $_SESSION["style"] = 'alert alert-success';
  $_SESSION["msg"] = 'Your Request accepted';
  header('Location: ' . './manageTime.php');
}else {
  $_SESSION["style"] = 'alert alert-danger';
  $_SESSION["msg"] = 'Operation Free.';
  header('Location: ' . './manageTime.php');
}
