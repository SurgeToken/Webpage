<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $susd_holders = $redis->get("sUSD Holders");
    $susd_total_supply = $redis->get("sUSD Total Supply");
    $busd_total_balance = $redis->get("bUSD Total Balance");
    $busd_price = $redis->get("bUSD Price");
    $susd_price = $redis->get("sUSD Price");
    $seth_holders = $redis->get("sETH Holders");
    $total_supply_seth = $redis->get("sETH Total Supply");
    $total_balance_weth = $redis->get("wETH Total Balance");
    $weth_price = $redis->get("wETH Price");
    $seth_price = $redis->get("sETH Price");

    $row['susd_holders'] = $susd_holders;
    $row['total_supply_susd'] = $susd_total_supply;
    $row['total_balance_busd'] = $busd_total_balance;
    $row['busd_price'] = $busd_price;
    $row['susd_price'] = $susd_price;
    $row['seth_holders'] = $seth_holders;
    $row['total_supply_seth'] = $total_supply_seth;
    $row['total_balance_weth'] = $total_balance_weth;
    $row['weth_price'] = $weth_price;
    $row['seth_price'] = $seth_price;

    //push all $row variables into the $data array
    array_push($data, $row);

    //push the $data array to index.html
    echo json_encode($data); 



?>