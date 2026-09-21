<?php
exit();
echo 'Khela hobe';
echo '<br>';

function timeCalculator($second, $first)
{
    $datetime1 = new DateTime($first);
    $datetime2 = new DateTime($second);
    $interval = $datetime1->diff($datetime2);
    $elapseDay = $interval->format('%a');
    $elapseHours = $interval->format('%h');
    $elapseMinite = $interval->format('%i');
    $elapseSeconds = $interval->format('%s');

    $timeCollector = array(
        'day' => $elapseDay,
        'hours' => $elapseHours,
        'minite' => $elapseMinite,
        'seconds' => $elapseSeconds,
    );

    echo '<pre>';
    print_r($timeCollector);
    $elapsed = $interval->format('%h hours %i minutes %s seconds');
    echo $elapsed;
}



$first = '2021/07/13 16:37:31';
$second = '2021/07/13 16:39:52';
timeCalculator($second, $first);


$x = 64;
$y = 60;
echo '<br>';
echo fmod($x, $y);
