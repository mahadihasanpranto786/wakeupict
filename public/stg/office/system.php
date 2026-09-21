<?php



require 'config.php';
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$status = $_POST['status'];
$dateData = date('Y-m-d');
$dt = new DateTime('now', new DateTimezone('Asia/Dhaka'));
$dateTimeData = $dt->format('Y-m-d H:i:s');
$remarks = $_POST['remarks'];

$MAC = exec('getmac');
$MAC = strtok($MAC, ' ');

$sql = "SELECT * FROM members WHERE cell='$mobile' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $memberId = $row["id"];
        $memberData = $row;
    }

    $sql = "INSERT INTO attandence (member_id, status, date_time, date_time_mod, remarks, mac_address ) VALUES ('$memberId', '$status', '$dateData', '$dateTimeData', '$remarks', '$MAC')";

    if ($status == 'Enter' || $status == 'Leave' || $status == 'Break Start' || $status == 'Break End' || $status == 'Coffee' || $status == 'Tea' || $status == 'Just Login') {
        $conn->query($sql);
    } else {
        header('Location: ' . './welcome_buddy.php');
        exit();
    }

    if ($status == 'Just Login') {
        $_SESSION['isLogin'] = TRUE;
    }


    //$_SESSION['isLogin'] = TRUE;
    $_SESSION['memberData'] = $memberData;
    $_SESSION["style"] = 'alert alert-success';
    $_SESSION["msg"] = 'Your Request accepted';
    header('Location: ' . './index.php');
} else {
    $_SESSION["style"] = 'alert alert-danger';
    $_SESSION["msg"] = 'Fail to login.';
    header('Location: ' . './index.php');
}
