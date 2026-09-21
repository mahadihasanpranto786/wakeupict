<?php
if (empty($_SESSION['isLogin'])) {
} else {
  $memberIdNav = $_SESSION['memberData']['power_type'];

  // print_r($memberIdNav);
  if ($memberIdNav == 1) {
?>
    <nav class="navbar navbar-expand-lg login__menu shadow bg-white">
      <a class="navbar-brand" href="./index.php"><img src="./images/logo-250-70-r-black-01-e1614074454238.png" class="img-fluid" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="./manageTime.php">Manage Time</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./managePassword.php">Change Password</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./manageShortLeave.php">Short Leave</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./manageFullLeave.php">Full Leave</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="./manageAttendanceReport.php">Attendance Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./manageCoffeeTeaReport.php">Coffee Report</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./manageLeaveReport.php">Leave Report</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="./officeMembers.php">Employees</a>
          </li>
        </ul>
      </div>
    </nav>

  <?php } elseif ($memberIdNav == 2) {
  ?>
    <nav class="navbar navbar-expand-lg login__menu shadow bg-white">
      <a class="navbar-brand" href="./index.php"><img src="./images/logo-250-70-r-black-01-e1614074454238.png" class="img-fluid" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="./manageTime.php">Manage Time</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./managePassword.php">Change Password</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./manageShortLeave.php">Short Leave</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./manageFullLeave.php">Full Leave</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="./manageAttendanceReport.php">Attendance Report</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./manageCoffeeTeaReport.php">Coffee Report</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./manageLeaveReport.php">Leave Report</a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="./officeMembers.php">Employees</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./penalty.php">Penalty</a>
          </li>
        </ul>
      </div>
    </nav>

  <?php } elseif ($memberIdNav == 3) { ?>
    <nav class="navbar navbar-expand-lg login__menu shadow bg-white">
      <a class="navbar-brand" href="./index.php"><img src="./images/logo-250-70-r-black-01-e1614074454238.png" class="img-fluid" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="./manageTime.php">Manage Time</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./managePassword.php">Change Password</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./manageAttendanceReport.php">Attendance Report</a>
          </li>
        </ul>
      </div>
    </nav>
  <?php } elseif ($memberIdNav == 0) { ?>
    <nav class="navbar navbar-expand-lg login__menu shadow bg-white">
      <a class="navbar-brand" href="./index.php"><img src="./images/logo-250-70-r-black-01-e1614074454238.png" class="img-fluid" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="./manageTime.php">Manage Time</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./managePassword.php">Change Password</a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="./manageShortLeave.php">Short Leave</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./manageFullLeave.php">Full Leave</a>
          </li> -->
        </ul>
      </div>
    </nav>
<?php }
}

?>