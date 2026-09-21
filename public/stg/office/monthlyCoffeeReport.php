<?php
require './config.php';
$getMonth = $_POST['selected_month'];
$getYear = $_POST['selected_year'];
$sql = "SELECT * FROM attandence WHERE status = 'Coffee' AND MONTH(date_time) = $getMonth AND YEAR(date_time) = $getYear";
$result = $conn->query($sql);
$memberData = "SELECT * FROM members WHERE active_status = 1";
$members = $conn->query($memberData);

// Month number to month name conversion 
$monthNum  = $getMonth;
$dateObj   = DateTime::createFromFormat('!m', $monthNum);
$monthName = $dateObj->format('F');
?>

<?php require 'header.php'; ?>
<div class="bg-warning p-2 mb-3">
  <div class="d-flex">
    <div class="mr-auto p-2">
      <h5>Total Coffee Inserted On <?= $monthName ?>(<?= $getYear ?>): <span class="h3"><?= mysqli_num_rows($result) ?></span> </h5>
    </div>
    <div class="p-2">
      <button class="text-right" onclick="window.print()">Print</button>
    </div>
  </div>
</div>
<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Member Name</th>
      <th scope="col">Cup Of Coffees</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($members as $member) {  ?>
      <tr>
        <td> <?= $member['name']; ?></td>
        <td>
          <?php
          $cc = 0;
          foreach ($result as $allCoffee) {
            if ($member['id'] == $allCoffee['member_id']) {
              $cc++;
            }
          }
          echo $cc;
          ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<?php require "./footer.php" ?>