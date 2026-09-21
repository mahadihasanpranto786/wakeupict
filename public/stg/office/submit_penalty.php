<?php
require 'config.php';


$memberId = $_POST['memberId'];
$status = '000';
$dateData = date('Y-m-d');
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$dateTimeData = $dt->format('Y-m-d H:i:s');
$remarks = $_POST['remark'];
$MAC = exec('getmac');
$MAC = strtok($MAC, ' ');

$memberInformation = $_SESSION['memberData'];
$userId = $memberInformation['id'];
$name = $memberInformation['name'];
$cell = $memberInformation['cell'];
$makeJson = array(
  'Table' => 'attandence',
  'action' => 'insert',
  'user' => $memberId,
);
$qry = json_encode($makeJson, TRUE);
$caught = "INSERT INTO penalty_assessor(acction_info, accessor_id, accessor_name, accessor_cell) VALUES ('$qry', '$userId', '$name', '$cell')";
$conn->query($caught);


$sql = "INSERT INTO attandence(member_id, status, date_time, date_time_mod, remarks, mac_address ) VALUES ('$memberId', '$status', '$dateData', '$dateTimeData', '$remarks', '$MAC')";
$x = $conn->query($sql);


if ($x == TRUE) { ?>
    <script>
      alert('Marked Successfully');
        window.location.href = "./penalty.php";
    </script>
<?php } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
 } ?>