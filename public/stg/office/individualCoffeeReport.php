<?php
require './config.php';

$member_id = $_POST['member_id'];
$selected_month = $_POST['selected_month'];
$selected_year = $_POST['selected_year'];


$sql = "SELECT * FROM attandence WHERE 
member_id = '$member_id' AND 
status = 'Coffee' AND 
MONTH(date_time) = '$selected_month' AND YEAR(date_time) = '$selected_year'";

$result = $conn->query($sql);


// Month name convert 
$monthData   = DateTime::createFromFormat('!m', $selected_month);
$monthName = $monthData->format('F'); // March

// Show Member name by id 

$sql_name = "SELECT * FROM members WHERE id = '$member_id'";
$sql_name_result = $conn->query($sql_name);


$member_name = $sql_name_result->fetch_row()[1];




?>

<?php require 'header.php'; ?>

<div class="container">
  <div class="card">
    <div class="row">
      <div class="col-12 overflow-auto" style="height: 60vh;">
        <div class="row mx-3 text-center">
          <div class="col-sm-4">
            <div class="card text-white bg-success my-3">
              <div class="card-header">Employee Name</div>
              <div class="card-body text-center">
                <h5 class="card-title"><span class="h4 mb-3"><?= $member_name ?></span></h5>
                <h5 class="card-title"><span class="h1"><i class="fa fa-user" aria-hidden="true"></i></span></h5>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card text-white bg-primary my-3">
              <div class="card-header">Month</div>
              <div class="card-body text-center">
                <h5 class="card-title"><span class="h3 mb-3"><?= $monthName ?></span></h5>
                <h5 class="card-title"><span class="h1"><i class="fa fa-calendar" aria-hidden="true"></i></span></h5>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card text-white bg-info my-3">
              <div class="card-header">Cup of coffees this month</div>
              <div class="card-body text-center">
                <h5 class="card-title"><span class="h3 mb-3"><?php print_r(mysqli_num_rows($result)); ?></h5>
                <h5 class="card-title"><span class="h1"><i class="fa fa-coffee" aria-hidden="true"></i></span></h5>
              </div>
            </div>
          </div>
        </div>
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">Date & Time</th>
              <th scope="col">Remarks</th>
            </tr>
          </thead>
          <?php
          $x = 1;
          if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
              $dateTime = $row["date_time_mod"];;
              $dateTimeCoffee = date('h:i:s a m/d/Y', strtotime($dateTime));
          ?>
              <tbody>
                <tr>
                  <td> <?= $dateTimeCoffee; ?></td>
                  <td> <?= $row["remarks"]; ?></td>
                </tr>
            <?php
            }
          } else {
            echo '<p class="alert alert-danger">No DATA FOUND</p>';
          } ?>
              </tbody>
        </table>
      </div>
    </div>
  </div>
</div>