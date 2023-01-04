<?php

function generateCoins($amount) {
    // define the coins with actual values.
    $coins = [
        'silverDollar'  => 1, 
        'halfDollar'    => 0.5,
        'quarter'       => 0.25, 
        'dime'          => 0.10, 
        'nickel'        => 0.05, 
        'penny'         => 0.01
    ];

    // converting actual values to cents
    foreach ($coins as $name => $value) {
        $coins[$name] = $value * 100;
    }

    // Convert amount into the Cents
    $reminderCents = $amount * 100;

    $silverDollar   = floor($reminderCents/$coins['silverDollar']); // all dividable by 100 is actually silver dollers
    $reminderCents -= $coins['silverDollar']*$silverDollar; // removing that much reminderCents from the actual value so that we would have only reminder
    $half           = floor($reminderCents/$coins['halfDollar']); // all dividable by 50 is half of a dollar
    $reminderCents -= $coins['halfDollar']*$half; // substract the divided value and store reminderCents as remenders
    $quarter        = floor($reminderCents/$coins['quarter']); // all dividable by 50 is quarter of a doller
    $reminderCents -= $coins['quarter']*$quarter; // substract the divided value and store reminderCents as remenders
    $dime           = floor($reminderCents/$coins['dime']); // all dividable by 50 is dime of a dollar
    $reminderCents -= $coins['dime']*$dime; // substract the divided value and store reminderCents as remenders
    $nickel         = floor($reminderCents/$coins['nickel']); // all dividable by 50 is nickel of a doller
    $reminderCents -= $coins['nickel']*$nickel; // substract the divided value and store reminderCents as remenders
    $penny          = floor($reminderCents); // all the reminder is now the pinny

    // Return the result.
    return [
        "silver-dollar" => $silverDollar, 
        "half-dollar"   => $half, 
        "quarter"       => $quarter, 
        "dime"          => $dime, 
        "nickel"        => $nickel,
        "penny"         => $penny
    ];
};