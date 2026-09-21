<?php

require 'config.php';
$today = date("Y-m-d");

//Inactive member
if (isset($_GET['inactiveMember'])) {
  $value = $_GET['inactiveMember'];
  $memberId = $_GET['memberId'];
  $makeInactive = "UPDATE members SET active_status = 0 WHERE id = $memberId";
  $conn->query($makeInactive);
}

//Active member
if (isset($_GET['activeMember'])) {
  $value = $_GET['activeMember'];
  $memberId = $_GET['memberId'];
  $makeActive = "UPDATE members SET active_status = 1 WHERE id = $memberId";
  $conn->query($makeActive);
}

//Delete member
if (isset($_GET['delete'])) {
  $value = $_GET['delete'];
  $memberId = $_GET['memberId'];
  $delete = "UPDATE members SET active_status = 99 WHERE id = $memberId";
  $conn->query($delete);
}

$activeMember = "SELECT * FROM members WHERE active_status=1;";
$inactiveMember = "SELECT * FROM members WHERE active_status=0;";

$result = $conn->query($activeMember);
$inactiveMemberResult = $conn->query($inactiveMember);

?>
<?php require './header.php' ?>
<h3 class="text-center mt-5 mb-3 bg-success py-3 text-white">Active members</h3>
<table class="table table-striped mb-4">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Name</th>
      <th scope="col">Designation</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($result->num_rows > 0) {
      $serial = 0;
      while ($row = $result->fetch_assoc()) {
        $serial++;
    ?>
        <tr>
          <td><?php echo $serial; ?></td>
          <td><?php echo $row["name"] ?></td>
          <td><?php echo $row["designation"] ?></td>
          <td>
            <a href="?inactiveMember=0&memberId=<?php echo $row["id"] ?>" class="btn btn-warning btn-flat btn-sm mr-3">Inactive</a>
            <a href="?delete=99&memberId=<?php echo $row["id"] ?>" class="btn btn-danger btn-flat btn-sm">Delete</a>
          </td>
        </tr>
    <?php }
    } else {
      echo "No Active member found";
    }
    ?>
  </tbody>
</table>
<hr>
<hr>
<h3 class="text-center mt-5 mb-3 bg-danger py-3 text-white">Inactive members</h3>
<table class="table table-striped mt-4">
  <thead>
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Name</th>
      <th scope="col">Designation</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($inactiveMemberResult->num_rows > 0) {
      $serial = 0;
      while ($row = $inactiveMemberResult->fetch_assoc()) {
        $serial++;
    ?>
        <tr>
          <td><?php echo $serial; ?></td>
          <td><?php echo $row["name"] ?></td>
          <td><?php echo $row["designation"] ?></td>
          <td>
            <a href="?activeMember=0&memberId=<?php echo $row["id"] ?>" class="btn btn-success btn-flat btn-sm">Active</a>
            <a href="?delete=99&memberId=<?php echo $row["id"] ?>" class="btn btn-danger btn-flat btn-sm">Delete</a>
          </td>
        </tr>
    <?php }
    } else {
      echo "No Inactive member found";
    }
    ?>
  </tbody>
</table>


<?php require "./footer.php" ?>