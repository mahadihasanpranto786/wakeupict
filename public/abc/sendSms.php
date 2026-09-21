<?php
theSmsSender();
function theSmsSender()
{
  $eachDay = date('Y-m-d');
  echo '<br>';
  require 'config.php';
  $sql = "SELECT * FROM members Where active_status = '1'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $dayalpha = 0;
      $houralpha = 0;
      $minalpha = 0;
      $mobileNumber = $row['cell'];
      echo $row['name'];
      $type = $row['user_type'];
      echo '<br>';
      $member_id = $row['id'];
      echo '<br>';
      $enter = enterAnalyzer($eachDay, $member_id, 'Enter');
      $breakStart = enterAnalyzer($eachDay, $member_id, 'Break Start');
      $startBreakTime = startBreakTime($eachDay, $member_id, 'Break Start');
      $s = 1;
      while ($row = $startBreakTime->fetch_assoc()) {
        $s++;
      }
      if ($s == 1) {
      }
      $startBreakTimeE = startBreakTime($eachDay, $member_id, 'Break End');
      $breakEnd = enterAnalyzer($eachDay, $member_id, 'Break End');
      $s = 1;
      while ($row = $startBreakTimeE->fetch_assoc()) {
        $s++;
      }
      if ($s == 1) {
      }
      $leave =  enterAnalyzer($eachDay, $member_id, 'Leave');
      $judgementTime = judgementTime($enter, $leave, $breakStart, $breakEnd);
      if ($judgementTime == 100) {
        $dailyWorks = dayWork($breakStart, $breakEnd, $member_id, $eachDay);
        $dayalpha += $dailyWorks['day'];
        $houralpha +=
          $dailyWorks['hours'];
        $minalpha +=
          $dailyWorks['minite'];
        if ($type == 1) {
          if ($dailyWorks['hours'] < 8) {
            $h = 8 - $dailyWorks['hours'];
            $m = 60 - $dailyWorks['minite'];
            if ($m > 0) {
              $h = $h - 1;
            }
            alertSendSms($h, $m, $mobileNumber);
          }
        } elseif ($type == 10) {
          if ($dailyWorks['hours'] < 5) {
            $h = 5 - $dailyWorks['hours'];
            $m = 60 - $dailyWorks['minite'];
            if ($m > 0) {
              $h = $h - 1;
            }
            alertSendSms($h, $m, $mobileNumber);
          }
        }
      }
    }
  } //End if here 
}

//This function prepare SMS
function alertSendSms($h, $m, $memberNumber)
{
  require './functionConfig.php';
  $eachDay = date('Y-m-d');
  $sms = "আজ $eachDay ,  আপনি $h ঘণ্টা  $m মিনিট কাজ ফাকি দিয়েছেন";
  sendSMS($sms, $memberNumber, $eachDay); //This will trigger alert SMS
}

//This function send sms
function sendSMS($message, $contact, $eachDay)
{
  require './functionConfig.php';
  $url = 'http://log.softcoderit.com/smsapi?' . http_build_query(
    [
      "api_key" => "C2009420620cd391232cc1.24814386",
      "type" => "text",
      "contacts" => $contact,
      "senderid" => "8809612472651",
      "msg" => $message,
    ]
  );
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  $responseId = json_encode($response);
  date_default_timezone_set('Asia/Dhaka');
  $date = date('d-m-y h:i:s');
  $insert = "INSERT INTO alert_sent (sms_date, sms_user, sms_message, sms_details,record_date_time) VALUES ('$eachDay', '$contact', '$message', '$responseId', '$date')";
  $result = $conn->query($insert);
  header("Location: smsSentToList.php");
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
      //print_r($employeeTime);
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

function dayWork($breakStart, $breakEnd, $memberId, $quaryDate)
{
  require './functionConfig.php';
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = 'Enter'";
  $result = $conn->query($sql_name);
  $startTime = $result->fetch_assoc()['date_time_mod'];
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND member_id = '$memberId' AND status = 'Leave'";
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

function startBreakTime($quaryDate, $memberId, $breakStart)
{
  require './functionConfig.php';
  $sql_name = "SELECT * FROM attandence WHERE date_time = '$quaryDate' AND  member_id = '$memberId' AND status = '$breakStart'";
  $result = $conn->query($sql_name);
  return $result;
}
