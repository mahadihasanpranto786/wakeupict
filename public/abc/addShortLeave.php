<?php 

require './config.php';

$shortLeaveDate = $_POST['short_leave_date'];
$shortLeaveStart = $_POST['short_leave_start'];
$shortLeaveEnd = $_POST['short_leave_end'];
$shortLeaveExplanation = $_POST['short_leave_explanation'];
$memberId = $_SESSION['memberData']['id'];

// print_r($memberId);
// exit();

$sql = "INSERT INTO short_leave(short_leave_date, short_leave_start_time, short_leave_end_time, short_leave_explanation, member_id) VALUES ('$shortLeaveDate','$shortLeaveStart','$shortLeaveEnd','$shortLeaveExplanation', '$memberId')";
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
?>