<?php
require 'config.php';

$id = $_GET['attId'];

$getRow = "SELECT * FROM attandence WHERE id = '$id'";
$rowInfo = $conn->query($getRow);
$memberInformation = $_SESSION['memberData'];
$userId = $memberInformation['id'];
$name = $memberInformation['name'];
$cell = $memberInformation['cell'];
$makeJson = array(
  'Table' => 'attandence',
  'action' => 'delete',
  'user' => $rowInfo->fetch_assoc()['member_id'],
);
$qry = json_encode($makeJson, TRUE);
$caught = "INSERT INTO penalty_assessor(acction_info, accessor_id, accessor_name, accessor_cell) VALUES ('$qry', '$userId', '$name', '$cell')";
$conn->query($caught);

$deleteSql = "DELETE FROM attandence WHERE id='$id'";
$x = $conn->query($deleteSql);



if ($x == TRUE) { ?>
  <script>
    alert('Deleted Successfully');
    window.location.href = "./penalty.php";
  </script>
<?php } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
} ?>
?>