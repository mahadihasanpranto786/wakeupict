<?php
require 'config.php';

$sql = "SELECT * FROM members";

$result = $conn->query($sql);


?>
<?php require 'header.php'; ?>

<div class="container">
  <div class="card">
    <div class="row">
      <div class="col-12">
        <form action="./individualLeaveReport.php" method="post" class="sticky-top p-3">
          <h5 class="lead">Generate Leave Report</b></h5>
          <small class="Lead">Welcome : <b> <?= $_SESSION['memberData']['name']; ?> </small>
          <hr>

          <?php
          if ($result->num_rows > 0) {
          ?>
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="inputEmployee">Employee Name</label>
                <select id="inputEmployee" name="member_id" class="form-control" required>
                  <?php
                  foreach ($result as $x) {
                  ?>
                    <option value="<?= $x['id']; ?>"><?= $x['name']; ?></option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-4">
                <label for="inputEmployee">Employee Name</label>
                <select id="inputEmployee" name="leave_status" class="form-control" required>
                  <option value="Short Leave">Short Leave</option>
                  <option value="Full Leave">Full Leave</option>
                </select>
              </div>

            <?php
          }
            ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <br>
      </div>
    </div>
  </div>
</div>