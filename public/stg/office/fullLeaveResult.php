<?php
 require './config.php';

$fullLeaveResult = $_POST['full_leave_result'];
$fullLeaveTableId = $_POST['full_leave_table_id'];

// print_r($fullLeaveResult);
// echo '<br>';
// echo '<br>';
// echo '<br>';
// print_r($fullLeaveTableId);
// exit();


$sql = "UPDATE full_leave SET full_leave_status ='$fullLeaveResult' WHERE full_leave_id = '$fullLeaveTableId'";
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
