<?php

require './config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $member_id = $_POST['member_id'];
  $leave_status = $_POST['leave_status'];
  $_SESSION['member_id_post'] = $member_id;
  $_SESSION['leave_status_post'] = $leave_status;
} else {
  $member_id = $_SESSION['member_id_post'];
  $leave_status = $_SESSION['leave_status_post'];
}

$sql_short = "SELECT * FROM short_leave WHERE member_id = '$member_id' ORDER BY short_leave_id DESC";
$sql_full = "SELECT * FROM full_leave WHERE member_id = '$member_id' ORDER BY full_leave_id DESC";
$iron_man = "";

$result_short = $conn->query($sql_short);
$result_full = $conn->query($sql_full);


// Show Member name by id 

$sql_name = "SELECT * FROM members WHERE id = '$member_id'";
$sql_name_result = $conn->query($sql_name);


$member_name = $sql_name_result->fetch_row()[1];


?>
<?php require './header.php'; ?>
<div class="container">
  <div class="card">
    <div class="row">
      <div class="col-12 overflow-auto" style="height: 60vh;">

        <?php
        if ($leave_status == "Short Leave") { ?>
          <table class="table table-striped">
            <p class="text-center pt-4 pb-2">Short Leave Report for: <span class="h5 mb-3 "><?= $member_name ?></span></h5>
            </p>
            <thead>
              <tr class="">
                <th scope="col">Date (Y-M-D)</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Explanation</th>
                <th scope="col">Submission Time</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <?php
            if ($result_short->num_rows > 0) {
              while ($row = $result_short->fetch_assoc()) {

                // print_r($row);
                // exit();
                $shortTimeStart = $row['short_leave_start_time'];
                $shortTimeStartX = date('h:i a', strtotime($shortTimeStart));
                $shortTimeEnd = $row['short_leave_end_time'];
                $shortTimeEndY = date('h:i a', strtotime($shortTimeEnd));
                $shortTimeSubmissionDT = $row['short_leave_submission_date_time'];
                $shortTimeSubmissionDTZ = date('h:i:s a m/d/Y', strtotime($shortTimeSubmissionDT));

            ?>
                <tbody>
                  <tr>
                    <td><?= $row['short_leave_date']; ?></td>
                    <td><?= $shortTimeStartX; ?></td>
                    <td><?= $shortTimeEndY; ?></td>
                    <td><?= $row['short_leave_explanation'] ?></td>
                    <td><?= $shortTimeSubmissionDTZ ?></td>
                    <td>
                      <?php
                      if ($row['short_leave_status'] == 0) { ?>
                        <div class="row text-center">
                          <form action="shortLeaveResult.php" method="POST">
                            <input type="hidden" name="short_leave_result" value="1">
                            <input type="hidden" name="short_leave_table_id" value="<?= $row['short_leave_id'] ?>">
                            <button class="btn btn-success rounded-circle mr-2"><i class="fa fa-check" aria-hidden="true"></i></button>
                          </form>
                          <form action="shortLeaveResult.php" method="POST">
                            <input type="hidden" name="short_leave_result" value="2">
                            <input type="hidden" name="short_leave_table_id" value="<?= $row['short_leave_id'] ?>">
                            <button class="btn btn-danger rounded-circle mr-2"><i class="fa fa-times" aria-hidden="true"></i></button>
                          </form>
                        <?php } elseif ($row['short_leave_status'] == 1) {
                        echo "<div class='alert alert-success' role='alert'> Approved </div>";
                      } elseif ($row['short_leave_status'] == 2) {
                        echo "<div class='alert alert-danger' role='alert'> Rejected </div>";
                      } else {
                        echo "Hello";
                      } ?>
                        </div>
                    </td>
                  </tr>
                </tbody>
            <?php }
            } else {
              echo '<p class="alert alert-danger">No DATA FOUND</p>';
            }
            ?>
          </table>

        <?php } elseif ($leave_status == "Full Leave") { ?>
          <table class="table table-striped">
            <p class="text-center pt-2">Full Leave Report </p>
            <thead>
              <tr class="">
                <th scope="col">Start Date (Y-M-D)</th>
                <th scope="col">End Date (Y-M-D)</th>
                <th scope="col">Explanation</th>
                <th scope="col">Submission Time</th>
                <th scope="col">Action</th>
              </tr>
            </thead>

            <?php
            if ($result_full->num_rows > 0) {
              while ($row = $result_full->fetch_assoc()) {

                $fullTimeSubmissionDT = $row['full_leave_submission_date_time'];
                $fullTimeSubmissionDTZ = date('h:i:s a m/d/Y', strtotime($fullTimeSubmissionDT));

            ?>
                <tbody>
                  <tr>
                    <td><?= $row['full_leave_start_date']; ?></td>
                    <td><?= $row['full_leave_end_date']; ?></td>
                    <td><?= $row['full_leave_explanation']; ?></td>
                    <td><?= $fullTimeSubmissionDTZ; ?></td>
                    <td>
                      <?php
                      if ($row['full_leave_status'] == 0) { ?>
                        <div class="row text-center">
                          <form action="./fullLeaveResult.php" method="POST">
                            <input type="hidden" name="full_leave_result" value="1">
                            <input type="hidden" name="full_leave_table_id" value="<?= $row['full_leave_id'] ?>">
                            <button class="btn btn-success rounded-circle mr-2"><i class="fa fa-check" aria-hidden="true"></i></button>
                          </form>
                          <form action="fullLeaveResult.php" method="POST">
                            <input type="hidden" name="full_leave_result" value="2">
                            <input type="hidden" name="full_leave_table_id" value="<?= $row['full_leave_id'] ?>">
                            <button class="btn btn-danger rounded-circle mr-2"><i class="fa fa-times" aria-hidden="true"></i></button>
                          </form>
                        <?php } elseif ($row['full_leave_status'] == 1) {
                        echo "<div class='alert alert-success' role='alert'> Approved </div>";
                      } elseif ($row['full_leave_status'] == 2) {
                        echo "<div class='alert alert-danger' role='alert'> Rejected </div>";
                      } else {
                        echo "Hello";
                      } ?>
                        </div>
                    </td>
                  </tr>
                </tbody>
            <?php }
            } else {
              echo '<p class="alert alert-danger">No DATA FOUND</p>';
            }
            ?>
          </table>

        <?php  } else {
          echo '<p class="alert alert-danger">Contact Sajib, System Error</p>';
        } ?>

      </div>
    </div>
  </div>
</div>