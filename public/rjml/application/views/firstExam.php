<?php

echo "Bismillah";

echo "<br>" . "Exam 13.05.2021";



// $x = 22;
// $y=22;
// $xch = 0;

// for ($x = $x; $x != 1; $x--) {

// 	if ($xch == 0) {
// 		echo $x;
// 		$xch++;
// 		echo "<br>";
// 	}
// 	if($x != 1){}

// 	if ($x % 2 == 0) {
// 		echo $x / 2 . "<br>";
// 	} else {
// 		echo 3 * $x + 1 . "<br>";
// 	}
// }

// $i = 0;
// $y=22;
// while ($i < 10) {

// 	echo "new". $y . "<br>";
// 	return $y;
	
// 	$i++;
// 	if ($i == 3) break;
	
// }
// echo ("Loop stopped at i = $i");

// echo "<br>";
// echo "<br>";
// echo "2nd logic" . "<br>";

// $n = 22;

// for ($n = $n; $n != 1; $n--) {
// 	if ($n != 1) {
// 		echo $n . "<br>";
// 	} elseif ($n % 2 == 0) {
// 		echo $n / 2 . "<br>";
// 		//echo "hi";
// 	} else {
// 		echo 3 * $n + 1 . "<br>";
// 		//echo "hi";
// 	}
// }


echo "<br>";
echo "hi" . "<br>";

$count = 0;
$number = 22;
$numberch = 0; 

while ($number != 1) 
{ 
	if ($numberch == 0) {
		echo $number = $number;
		$numberch++;
		echo "<br>";
	} elseif ($number % 2 == 0) {
		$number = $number / 2 ;
		echo $number . "<br>";
	} else {
		$number = 3 * $number + 1;
		echo $number . "<br>";
	}


	$count++; // the same as count = count + 1; 
} 

echo $count;
echo "<br>";
echo "hi" . "<br>";
echo "<br>";
echo "<br>";
echo "Submit your data" . "<br>";



?>

<form action="" method="post">
<?php //echo $message; ?>
First Number: <input type="text" name="name"><br>
Last Number: <input type="text" name="email"><br>
<input type="submit" name="SubmitButton">
</form>

<?php

$message = "";
if(isset($_POST['SubmitButton'])){ //check if form was submitted
  $i = $_POST['name']; //get input text
  $j = $_POST['email']; //get input text
  //$message = "Success! You entered: ".$input;


$a=array();
//$i = 10;
//$j = 1;

$entrys = range($i, $j);
foreach ($entrys as $entry){
	if($entry){
	$count = 0;
	$entrych = 0;
	while ($entry != 1) 
	{ 
		if ($entrych == 0) {
			echo $entry = $entry;
			$entrych++;
			echo "<br>";
		} elseif ($entry % 2 == 0) {
			$entry = $entry / 2 ;
			echo $entry . "<br>";
		} else {
			$entry = 3 * $entry + 1;
			echo $entry . "<br>";
		}
	
	
		$count++; // the same as count = count + 1; 
	}
	echo "<br>";
	echo "count:" .$count;
	array_push($a, $count);
	echo "<br>";
	echo "<br>";
}
}
print_r($a);
echo "<br>";
echo "<br>";


echo "Result: " . $i. " " . $j .  " " . (max($a)) . "<br>";
} 