<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $test = $redis->get("sUSD Holders");
    echo $test;

    $row['susd_holders'] = $redis->get("sUSD Holders");
    $row['total_supply_susd'] = $redis->get("sUSD Total Supply");
    $row['total_balance_busd'] = $redis->get("bUSD Total Balance");
    $row['busd_price'] = $redis->get("bUSD Price");
    $row['susd_price'] = $redis->get("sUSD Price");
    $row['seth_holders'] = $redis->get("sETH Holders");
    $row['total_supply_seth'] = $redis->get("sETH Total Supply");
    $row['total_balance_weth'] = $redis->get("wETH Total Balance");
    $row['weth_price'] = $redis->get("wETH Price");
    $row['seth_price'] = $redis->get("sETH Price");

    //push all $row variables into the $data array
    array_push($data, $row);

    //push the $data array to index.html
    echo json_encode($data); 



?>