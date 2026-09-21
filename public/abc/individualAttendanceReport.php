<?php
require './config.php';

function startBreakTime($quaryDate, $memberId, $breakStart)
{
  require './functionConfig.php';

  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND  member_id = '$memberId' AND status = '$breakStart'";
  $result = $conn->query($sql_name);
  return $result;
}

function dayWork($breakStart, $breakEnd, $memberId, $quaryDate)
{
  require './functionConfig.php';
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = 'Enter' ORDER BY id ASC";
  $result = $conn->query($sql_name);
  $startTime = $result->fetch_assoc()['date_time_mod'];
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = 'Leave' ORDER BY id DESC";
  $result = $conn->query($sql_name);
  $endTime = $result->fetch_assoc()['date_time_mod'];
  $first = $startTime;
  $second = $endTime;
  $oldData = array(
    'day' => 0,
    'hours' => 0,
    'minite' => 0,
    'seconds' => 0,
  );
  $oldData = timeCollector($second, $first, $oldData);
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND  member_id = '$memberId' AND status = 'Break Start'";
  $result = $conn->query($sql_name);
  $breakStartData = array();
  $totalBreak = $result->num_rows;
  while ($row = $result->fetch_assoc()) {
    array_push($breakStartData, $row);
  }
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND  member_id = '$memberId' AND status = 'Break End'";
  $result = $conn->query($sql_name);
  $breakEndData = array();
  while ($row = $result->fetch_assoc()) {
    array_push($breakEndData, $row);
  }
  for ($i = 0; $i < $totalBreak; $i++) {
    $oldData = timeCollector($breakEndData[$i]['date_time_mod'], $breakStartData[$i]['date_time_mod'], $oldData);
  }
  $timeSegmentation = timeSegmentation($oldData);
  return $timeSegmentation;
}

function timeSegmentation($oldData)
{
  $miniteInQ = $oldData['seconds'] / 60;
  $oldData['seconds'] = fmod($oldData['seconds'], 60);
  $oldData['minite'] = $oldData['minite'] + (int)$miniteInQ;
  $hoursInQ = $oldData['minite'] / 60;
  $oldData['minite'] = fmod($oldData['minite'], 60);
  $oldData['hours'] = $oldData['hours'] + (int)$hoursInQ;
  return $oldData;
}

function judgementTime($enter, $leave, $breakStart, $breakEnd)
{
  if ($enter == 1) {
    return 1;
  }
  if ($leave == 1) {
    return 2;
  }
  if ($breakStart != $breakEnd) {
    return 3;
  }
  return 100;
}

function timeCalculator($second, $first)
{
  $datetime1 = new DateTime($first);
  $datetime2 = new DateTime($second);
  $interval = $datetime1->diff($datetime2);
  $elapsed = $interval->format('%h hours %i minutes %s seconds');
  return $elapsed;
}

function timeCollector($second, $first, $oldData)
{
  $datetime1 = new DateTime($first);
  $datetime2 = new DateTime($second);
  $interval = $datetime1->diff($datetime2);
  $elapseDay = (float)$interval->format('%a');
  $elapseHours = (float)$interval->format('%h');
  $elapseMinite = (float)$interval->format('%i');
  $elapseSeconds = (float)$interval->format('%s');
  if (0 == $oldData['seconds']) {
    $timeCollector = array(
      'day' =>  $oldData['day'] + $elapseDay,
      'hours' => $oldData['hours'] + $elapseHours,
      'minite' =>  $oldData['minite'] + $elapseMinite + 1,
      'seconds' => $oldData['seconds'] + $elapseSeconds,
    );
  } else {
    $timeCollector = array(
      'day' =>  $oldData['day'] - $elapseDay,
      'hours' => $oldData['hours'] - $elapseHours,
      'minite' =>  $oldData['minite'] - $elapseMinite,
      'seconds' => $oldData['seconds'] - $elapseSeconds,
    );
    if ($timeCollector['seconds'] < 0) {
      $timeCollector['seconds'] = $timeCollector['seconds'] + 60;
      $timeCollector['minite'] = $timeCollector['minite'] - 1;
    }
    if ($timeCollector['minite'] < 0) {
      $timeCollector['minite'] = $timeCollector['minite'] + 60;
      $timeCollector['hours'] = $timeCollector['hours'] - 1;
    }
  }
  return $timeCollector;
}

function enterAnalyzer($quaryDate, $memberId, $status)
{
  require './functionConfig.php';
  if ($status == 'Break Start') {
    $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = '$status'  ORDER BY id DESC";
    $result = $conn->query($sql_name);
    $breakStart = 0;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $breakStart++;
      }
    } else {
      return 0;
    }
    return $breakStart;
  } elseif ($status == 'Break End') {
    $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = '$status'  ORDER BY id DESC";
    $result = $conn->query($sql_name);
    $breakEnd = 0;
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $breakEnd++;
      }
    } else {
      return 0;
    }
    return $breakEnd;
  } else {
    $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = '$status'  ORDER BY id DESC LIMIT 1";
    $sql_name_result = $conn->query($sql_name);
    $result = $sql_name_result->fetch_assoc();
    if ($result) {
      $problemInArray = $result['date_time_mod'];
      $employeeTime = date('h:i a', strtotime($problemInArray));
      print_r($employeeTime);
    } else {
      if ($status == 'Enter') {
        return 1;
      }
      if ($status == 'Leave') {
        return 1;
      }
      echo '<div class="alert alert-danger text-center" role="alert"> A </div>';
    }
  }
}

$member_id = $_POST['member_id'];
$selected_month = $_POST['selected_month'];
$selected_year = $_POST['selected_year'];

// Month name convert 
$monthData   = DateTime::createFromFormat('!m', $selected_month);
$monthName = $monthData->format('F');

// Show Member info by id 
$sql_name = "SELECT * FROM members WHERE id = '$member_id'";
$sql_name_result = $conn->query($sql_name);
$memberInfo = $sql_name_result->fetch_assoc();
$memberName = $memberInfo['name'];
$memberStartTime = $memberInfo['start_time'];
$showingMemStartOfficeTime = date('h:i a ', strtotime($memberStartTime));
$memberEndTime = $memberInfo['end_time'];
$showingMemEndOfficeTime = date('h:i a ', strtotime($memberEndTime));

//Month date printing 
$list = array();
$month = $selected_month;
$year = $selected_year;
for ($d = 1; $d <= 31; $d++) {
  $time = mktime($selected_month, 0, 0, $month, $d, $year);
  if (date('m', $time) == $month)
    $list[] = date('Y-m-d', $time);
}
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
                <h5 class="card-title"><span class="h5 mb-3"><?= $memberName ?></span></h5>
                <h5 class="card-title"><span class="h1"><i class="fa fa-user" aria-hidden="true"></i></span></h5>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card text-white bg-primary my-3">
              <div class="card-header">Month</div>
              <div class="card-body text-center">
                <h5 class="card-title"><span class="h5 mb-3"><?= $monthName ?></span></h5>
                <h5 class="card-title"><span class="h1"><i class="fa fa-calendar" aria-hidden="true"></i></span></h5>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="card text-white bg-danger my-3">
              <div class="card-header">Office Time</div>
              <div class="card-body text-center">
                <h5 class="card-title"><span class="h5 mb-3"><?= $showingMemStartOfficeTime ?> - <?= $showingMemEndOfficeTime ?></span></h5>
                <h5 class="card-title"><span class="h1"><i class="fa fa-briefcase" aria-hidden="true"></i></span></h5>
              </div>
            </div>
          </div>
        </div>

        <table class="table">
          <thead class="thead-light">
            <tr>
              <th scope="col">Date</th>
              <th scope="col">Enter</th>
              <th scope="col">Break Start</th>
              <th scope="col">Break End</th>
              <th scope="col">Leave</th>
              <th scope="col">Hours</th>
              <th scope="col">Over Time</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $dayalpha = 0;
            $houralpha = 0;
            $minalpha = 0;
            foreach ($list as $eachDay) {
            ?>
              <tr>
                <td><?php echo $eachDay; ?></td>
                <td><?php $enter = enterAnalyzer($eachDay, $member_id, 'Enter'); ?></td>
                <td><?php $breakStart = enterAnalyzer($eachDay, $member_id, 'Break Start');
                    $startBreakTime = startBreakTime($eachDay, $member_id, 'Break Start');
                    $s = 1;
                    while ($row = $startBreakTime->fetch_assoc()) {
                      echo $s;
                      echo '. ';
                      echo $row['date_time_mod'];
                      echo '<br>';
                      $s++;
                    }
                    if ($s == 1) {
                      echo 'No Break';
                    }


                    ?></td>
                <td><?php $breakEnd = enterAnalyzer($eachDay, $member_id, 'Break End');

                    $startBreakTimeE = startBreakTime($eachDay, $member_id, 'Break End');
                    $s = 1;
                    while ($row = $startBreakTimeE->fetch_assoc()) {
                      echo $s;
                      echo '. ';
                      echo $row['date_time_mod'];
                      echo '<br>';
                      $s++;
                    }
                    if ($s == 1) {
                      echo 'No Break';
                    }


                    ?></td>
                <td><?php $leave =  enterAnalyzer($eachDay, $member_id, 'Leave'); ?></td>
                <td><?php
                    $judgementTime = judgementTime($enter, $leave, $breakStart, $breakEnd);

                    if ($judgementTime == 100) {

                      $dailyWorks = dayWork($breakStart, $breakEnd, $member_id, $eachDay);

                      $dayalpha += $dailyWorks['day'];
                      $houralpha +=
                        $dailyWorks['hours'];
                      $minalpha +=
                        $dailyWorks['minite'];

                      echo "<div class='alert alert-success' role='alert'>" . 'Worked ' . $dailyWorks['hours'] . ' hours and ' . $dailyWorks['minite'] . ' Minutes' . "</div>";
                    } else {
                      if ($judgementTime == 1) {
                        echo "<div class='alert alert-danger' role='alert'>You are absent</div>";
                      }
                      if ($judgementTime == 2) {
                        echo "<div class='alert alert-warning' role='alert'>Forget to signout</div>";
                      }
                      if ($judgementTime == 3) {

                        echo "<div class='alert alert-warning' role='alert'>Break time law broken</div>";
                      }
                    }
                    ?>
                </td>
                <td>
                  <?php
                  $judgementTime = judgementTime($enter, $leave, $breakStart, $breakEnd);
                  if ($judgementTime == 100) {
                    $dailyWorks = dayWork($breakStart, $breakEnd, $member_id, $eachDay);
                    // print_r ($dailyWorks['hours'] - 8);
                    // print_r ($dailyWorks['minite'] - 0);
                    $workingHours = $dailyWorks['hours'];
                    $overtimeHours = $dailyWorks['hours'] - 8;
                    $overtimeMinuets = $dailyWorks['minite'] - 0;
                    if ($workingHours > 8) {
                      echo "<div class='alert alert-success' role='alert'>" . 'Worked ' . $overtimeHours . ' hours and ' . $overtimeMinuets . ' Minutes' . "</div>";
                    } else {
                      echo "<div class='alert alert-warning' role='alert'>No Overtime</div>";
                    }
                  } else {
                    if ($judgementTime == 1) {
                      echo "<div class='alert alert-danger' role='alert'>You are absent</div>";
                    }
                    if ($judgementTime == 2) {
                      echo "<div class='alert alert-warning' role='alert'>Forget to signout</div>";
                    }
                    if ($judgementTime == 3) {

                      echo "<div class='alert alert-warning' role='alert'>Break time law broken</div>";
                    }
                  }
                  ?>
                </td>
              </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
$exteaHours = (int)($minalpha / 60);
$minalpha = fmod($minalpha, 60);
$sum_hours = $houralpha + $exteaHours;
$dayWork = $sum_hours / 8;
$dayWorkIntern = $sum_hours / 4;
?>

<div class="p-2 border border-success mb-5">
  <?php
  print_r('This person work: <span class="h4">' . $sum_hours  . '</span> Hours and <span class="h4">' . $minalpha . '</span> minutes ');
  echo '<br>';
  print_r('Converting To Days (8h per day): <span class="h4">' . $dayWork . '</span>');
  echo '<br>';
  print_r('Converting To Days (4h per day): <span class="h4">' . $dayWorkIntern . '</span>');
  echo '<br>';
  ?>
</div>

<style>
  .work__hour__calculation {
    position: fixed;
    top: 0;
    margin-left: 65%;
    cursor: -webkit-grab;
    cursor: grab;
  }

  .work__hour__calculation .card {
    background: linear-gradient(to top right, #ffffff 86%, #ff8c00 84%);
    border: 2px solid #000;
  }
</style>
<?php
$crime = "SELECT * FROM attandence WHERE 
member_id = '$member_id' AND 
status = '000' AND 
MONTH(date_time) = '$selected_month' AND YEAR(date_time) = '$selected_year'";
$getCrimes = $conn->query($crime);
?>
<div id="draggable" class="work__hour__calculation shadow bg-white rounded">
  <div class="card">
    <div class="card-body">
      <div class="text-center">
        <p class="lead"><?= $memberName ?></p>
      </div>
      <hr>
      <h6 class="card-title"><i class="fas fa-house-user text-info"></i> Total Worked <br> => <?= $sum_hours ?> Hours and <?= $minalpha ?></h6>
      <hr>
      <h6 class="card-title"><i class="fas fa-calendar-day text-info"></i> Converting To Days(8h per day) <br> => <?= $dayWork ?> Days <span class="font-weight-bold">(employee)</span></h6>
    </div>
  </div>
</div>
<div>
  <hr>
  <h3 class="mt-3 mb-1">Marked as Foul</h3>
  <table class="table">
    <thead class="thead-light">
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Enter</th>
        <th scope="col">Leave</th>
        <th scope="col">Hours</th>
        <th scope="col">Remarks</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($getCrimes->num_rows > 0) {
        while ($dinTheDay = $getCrimes->fetch_assoc()) {
          $dayalpha = 0;
          $houralpha = 0;
          $minalpha = 0;
          foreach ($list as $eachDay) {
            if ($eachDay == $dinTheDay['date_time']) {
      ?>
              <tr>
                <td><?php echo $eachDay; ?></td>
                <td><?php $enter = enterAnalyzer($eachDay, $member_id, 'Enter'); ?></td>
                <td><?php $leave =  enterAnalyzer($eachDay, $member_id, 'Leave'); ?></td>
                <td class=""><?php
                              $judgementTime = judgementTime($enter, $leave, $breakStart, $breakEnd);

                              if ($judgementTime == 100) {

                                $dailyWorks = dayWork($breakStart, $breakEnd, $member_id, $eachDay);
                                
                                
                                $dayalpha += $dailyWorks['day'];
                                $houralpha +=
                                  $dailyWorks['hours'];
                                $minalpha +=
                                  $dailyWorks['minite'];

                                echo "<div class='alert alert-success' role='alert'>" . 'Worked <span class="cal_foul_hour">' . $dailyWorks['hours'] . '</span> hours and <span class="cal_foul_min">' . $dailyWorks['minite'] . '</span> Minutes' . "</div>";
                              } else {
                                if ($judgementTime == 1) {
                                  echo "<div class='alert alert-danger' role='alert'>You are absent</div>";
                                }
                                if ($judgementTime == 2) {
                                  echo "<div class='alert alert-warning' role='alert'>Forget to signout</div>";
                                }
                                if ($judgementTime == 3) {

                                  echo "<div class='alert alert-warning' role='alert'>Break time law broken</div>";
                                }
                              }
                              ?>
                </td>
                <td><?= $dinTheDay['remarks'] ?></td>
              </tr>
      <?php
            }
          }
        }
      }
      ?>
    </tbody>
  </table>
</div>
<?php require "./footer.php" ?>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
  $(function() {
    $("#draggable").draggable();
  });
</script>
<script>
  $(document).ready(function() {
    var foulHour = 0;
    var foulMin = 0;
    $('.cal_foul_hour').each(function() {
      foulHour += Number($(this).text());
    });
    var fourHourToMin = foulHour * 60;
    $('.cal_foul_min').each(function() {
      foulMin += Number($(this).text());
    });
    var totalFoul = foulMin + fourHourToMin;
  });
</script>