<?php
require 'config.php';
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card">
    <form action="updateTime.php" method="POST" class="sticky-top p-3">
      <h5 class="lead">Manage Time for <strong> <?= $_SESSION['memberData']['name']; ?> </strong></h5>
      <hr>
      <div class="form-group">
        <label for="startTime">Start Time</label>
        <input type="time" class="form-control" value="<?= $_SESSION["memberData"]["start_time"]; ?>" id="startTime" name="startTime" required>
      </div>
      <div class="form-group">
        <label for="endTime">End Time</label>
        <input type="time" class="form-control" value="<?= $_SESSION["memberData"]["end_time"]; ?>" id="endTime" name="endTime" required>
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
</div>
<?php require "./footer.php" ?>