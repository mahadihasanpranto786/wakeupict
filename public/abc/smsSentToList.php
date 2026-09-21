<?php
require 'config.php';
$sendSent = "SELECT * FROM alert_sent ORDER BY sms_id DESC";
$smsData = $conn->query($sendSent);

$records_per_page = 10;
$total_records = $smsData->num_rows;
$total_pages = ceil($total_records / $records_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$start = ($current_page - 1) * $records_per_page;
$end = $start + $records_per_page;

$sql = "SELECT * FROM alert_sent ORDER BY sms_id DESC LIMIT $start, $records_per_page";
$results = $conn->query($sql);
$today = date("Y-m-d");

function getUsernameUsingNumber($number)
{
  require './functionConfig.php';
  $user = "SELECT name FROM members WHERE cell = $number";
  $username = $conn->query($user);
  while ($name = $username->fetch_assoc()) {
    echo $name['name'];
  }
}
?>
<?php require 'header.php'; ?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date</th>
      <th scope="col">User Contact</th>
      <th scope="col">Message</th>
      <th scope="col">SMS ID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if ($results->num_rows > 0) {
      // output data of each row
      while ($row = $results->fetch_assoc()) {
        $markedToday = '';
        if ($today == $row["sms_date"]) {
          $markedToday = 'bg-success text-white';
        }
    ?>
        <tr class="<?= $markedToday ?>">
          <td><?= $row["sms_date"] ?></td>
          <td><?php getUsernameUsingNumber($row["sms_user"]) ?></td>
          <td><?= $row["sms_message"] ?></td>
          <td><?= $row["sms_details"] ?></td>
        </tr>
    <?php
      }
    } else {
      echo "0 results";
    }
    ?>
  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
      <li class="page-item"><a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
    <?php } ?>
  </ul>
</nav>


<div class="mt-5">
  <?php require 'footer.php'; ?>
</div>