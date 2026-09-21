<?php
require './config.php';


require './header.php';




$MAC = exec('getmac');
$MAC = strtok($MAC, ' ');
// echo "MAC address of client is: $MAC";



if (empty($_SESSION['memberData'])) { 

  $name = 'Thief';
  $cell = 'Anonymous';
  $mac = $MAC; 

  $sql = "INSERT INTO cute_people (cute_name, cute_cell, cute_mac_address) VALUES ('$name', '$cell', '$mac')";
  $result = $conn->query($sql);

  ?>

  <div class="alert alert-danger display-4 py-5 text-center" role="alert">
    <p>I GOT YOU "<?php echo $mac ?>"</p>
  </div>

<?php } else {
  $name = $_SESSION['memberData']['name'];
  $cell = $_SESSION['memberData']['cell'];
  $mac = $MAC; 

  $sql = "INSERT INTO cute_people (cute_name, cute_cell, cute_mac_address) VALUES ('$name', '$cell', '$mac')";
  $result = $conn->query($sql);

?>

  <div class="alert alert-danger display-4 py-5 text-center" role="alert">
    <p>I GOT YOU <?php echo $name ?></p>
  </div>

<?php }

require './footer.php' ?>