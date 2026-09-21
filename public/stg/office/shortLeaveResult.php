<?php
 require './config.php';

$shortLeaveResult = $_POST['short_leave_result'];
$shortLeaveTableId = $_POST['short_leave_table_id'];


$sql = "UPDATE short_leave SET short_leave_status ='$shortLeaveResult' WHERE short_leave_id = '$shortLeaveTableId'";
$result = $conn->query($sql);


if ($result == 1) {
  echo "
  <script>
     alert('Thank You.!');
     location.href = './individualLeaveReport.php';
  </script>
  ";
} else {
  echo "
  <script>
     alert('Something Wrong.!');
     location.href = './individualLeaveReport.php';
  </script>
  ";
}

?>