<?php

    $data = array();
    //open tokenstats.txt file
    $token_stats_file = fopen("tokenstats.txt", "r") or die("Unable to open file!");

    //read data from tokenstats.txt and put in array
    $file_data = explode("\n", file_get_contents('tokenstats.txt'));

    $row['susd_holders'] = $file_data[0];
    $row['total_supply_susd'] = $file_data[1];
    $row['total_balance_busd'] = $file_data[2];
    $row['busd_price'] = $file_data[3];
    $row['susd_price'] = $file_data[4];
    $row['seth_holders'] = $file_data[5];
    $row['total_supply_seth'] = $file_data[6];
    $row['total_balance_weth'] = $file_data[7];
    $row['weth_price'] = $file_data[8];
    $row['seth_price'] = $file_data[9];

    //push all $row variables into the $data array
    array_push($data, $row);

    //push the $data array to index.html
    echo json_encode($data); 



?>