<?php 

require './config.php';

$fullLeaveStart = $_POST['full_leave_start'];
$fullLeaveEnd = $_POST['full_leave_end'];
$fullLeaveExplanation = $_POST['full_leave_explanation'];

$memberId = $_SESSION['memberData']['id'];

// print_r($memberId);
// exit();

$sql = "INSERT INTO full_leave(full_leave_start_date, full_leave_end_date, full_leave_explanation, member_id ) VALUES ('$fullLeaveStart','$fullLeaveEnd','$fullLeaveExplanation', '$memberId')";
$result= $conn->query($sql);


if ($result == 1) {
  $_SESSION["style"] = 'alert alert-success';
  $_SESSION["msg"] = 'Your Request accepted';
  echo "
  <script>
     alert('Your Request Has Been Submitted');
     location.href = './index.php';
  </script>
  ";
} else {
  $_SESSION["style"] = 'alert alert-danger';
  $_SESSION["msg"] = 'Operation Failed.';
  echo "
  <script>
     alert('Your Request Failed');
     location.href = './index.php';
  </script>
  ";
}
