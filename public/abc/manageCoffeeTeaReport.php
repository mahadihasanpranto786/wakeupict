<?php
require 'config.php';
$sql = "SELECT * FROM members WHERE active_status = 1";
$result = $conn->query($sql);
?>
<?php require 'header.php'; ?>
<div class="container mb-3">
  <div class="card">
    <div class="row">
      <div class="col-12">
        <h5 class="lead pt-3 ml-2">Generate Coffee Report</h5>
        <small class="Lead pb-3 ml-2">Welcome : <b> <?= $_SESSION['memberData']['name']; ?> </b></small>
        <hr>
        <div class="total__coffee__by--month mb-5">
          <div class="bg-info py-3 text-center mb-4">
            <h3 class="text-white">All Report By Month</h3>
          </div>
          <form action="./monthlyCoffeeReport.php" method="post" class="sticky-top p-3">
            <div class="form-row">
              <?php
              if ($result->num_rows > 0) {
              ?>
                <!-- Month Selection  -->
                <div class="form-group col-md-4">
                  <label for="inputEmployee">Select Month</label>
                  <select id="inputEmployee" name="selected_month" class="form-control" required>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                </div>
                <!-- Year Selection  -->
                <div class="form-group col-md-4">
                  <label for="inputEmployee">Select Year</label>
                  <select id="inputEmployee" name="selected_year" class="form-control" required>
                    <option value="2021">2021</option>
                    <option value="2022" selected>2022</option>
                    <option value="2023">2023</option>
                  </select>
                </div>
              <?php
              }
              ?>
            </div>
            <button type="submit" class="btn btn-info">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require "./footer.php" ?>