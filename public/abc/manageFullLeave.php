<?php
require 'config.php';

$sql = "SELECT * FROM members";

$result = $conn->query($sql);


// print_r($result);
// exit();
?>
<?php require 'header.php'; ?>


<div class="container">
  <div class="card">
    <div class="row">
      <div class="col-6">
        <form action="addFullLeave.php" method="post" class="sticky-top p-3">
          <h5 class="lead">Manage Short Leave for <b> <?= $_SESSION['memberData']['name']; ?> </b></h5>
          <hr>
          <div class="form-row mb-3">
            <div class="col">
              <label for="">Start Date</label>
              <input type="date" name="full_leave_start" class="form-control" placeholder="First name" required>
            </div>
            <div class="col">
              <label for="">End Date</label>
              <input type="date" name="full_leave_end" class="form-control" placeholder="Last name" required>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Explanation</label>
            <textarea name="full_leave_explanation" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <br>
        <div class="">
          <?php
          if (empty($_SESSION['msg'])) {
          ?>

          <?php
          } else {
          ?>
            <div class=" <?= $_SESSION['style']; ?>" role="alert">
              <?= $_SESSION['msg']; ?>
            </div>
          <?php
          }
          ?>
        </div>
      </div>
      <div class="col-6">

      </div>
    </div>
  </div>
</div>