<?php

define('LIMIT', 1000000);
$range = range(1, LIMIT);
$result = 0;
$sequence = [];
$sums = [];
$primeSums = [];
$row = [];
$rowSequence = [];

foreach($range as $number){
    if(isPrime($number)){
        $sequence[] = $number;
    }
}

$seqTotal = count($sequence);

for($i = 0; $i < $seqTotal; $i++) {
    if (validSum($result, $sequence[$i])) {
        $result += $sequence[$i];
        $sums[] = $result;
        $row[] = $sequence[$i];
        $rowSequence[$result] = $row;
    } else {
        break;
    }
}

$sumsTotal = count($sums);

for($i = 0; $i < $sumsTotal; $i++){
    if(isPrime($sums[$i])){
        $primeSums[] = $sums[$i];
    }
}

output($primeSums, $rowSequence);

function output($primeSums, $rowSequence)
{
    $biggestSum = end($primeSums);
    $resultRow = $rowSequence[$biggestSum];

    echo PHP_EOL;
    echo 'result: ' . $biggestSum . ' - of ' . count($resultRow) . ' consecutive primes ' . PHP_EOL;
    echo (implode(' + ', $resultRow)) . PHP_EOL;
    echo PHP_EOL;
}

function validSum($sum, $current)
{
    return ($sum <= LIMIT) && ( ($sum + $current) <= LIMIT);
}

function isPrime($num)
{
    if ($num == 1)
        return false;

    for ($i = 2; $i <= sqrt($num); $i++){
        if ($num % $i == 0){
            return false;
        }
    }

    return true;
}

