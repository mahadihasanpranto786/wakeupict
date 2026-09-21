<?php
require './config.php';
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

$memberPassword = $_SESSION['memberData']['password'];
$memberId = $_SESSION['memberData']['id'];

$x = 0;
if ($oldPassword == $memberPassword) {
  $x = 1;
  if ($newPassword == $confirmPassword) {
    $x = 2;
  }
}

if ($x == 2) {
  $sql = "UPDATE members SET password='$confirmPassword' WHERE id='$memberId'";
  $result = $conn->query($sql);
  $_SESSION["memberData"]["password"] = $confirmPassword;
  $_SESSION["style"] = 'alert alert-success';
  $_SESSION["msg"] = 'Your Request accepted';
  echo "
  <script>
     alert('Your Password Has Been Updated');
     location.href = './index.php';
  </script>
  ";
}else{
  if ($x == 0) {
    $_SESSION["style"] = 'alert alert-danger';
    $_SESSION["msg"] = 'Old password & new password mismatch';
    header('Location: ' . './managePassword.php');
  } elseif ($x == 1) {
    $_SESSION["style"] = 'alert alert-danger';
    $_SESSION["msg"] = 'New password & confirm password miss match';
    header('Location: ' . './managePassword.php');
  }
}





?>