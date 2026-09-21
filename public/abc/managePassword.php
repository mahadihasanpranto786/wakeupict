<?php
require 'config.php';
$sql = "SELECT * FROM members";
$result = $conn->query($sql);
?>
<?php require 'header.php'; ?>
<div class="container">
  <div class="card">
    <form action="updatePassword.php" method="post" class="sticky-top p-3">
      <h5 class="lead">Manage Password for <b> <?= $_SESSION['memberData']['name']; ?> </b></h5>
      <hr>
      <div class="form-group">
        <label for="password">Old Password</label>
        <input type="password" class="form-control" value="" id="password" name="old_password" required>
      </div>
      <div class="form-group">
        <label for="password">New Password</label>
        <input type="password" class="form-control" value="" id="password" name="new_password" required>
      </div>
      <div class="form-group">
        <label for="password">Confirm Password</label>
        <input type="password" class="form-control" value="" id="password" name="confirm_password" required>
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