<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $susd_holders = $redis->get("sUSD Holders");
    $susd_total_supply = $redis->get("sUSD Total Supply");
    $rbusd_total_balance = $redis->get("bUSD Total Balance");
    $busd_price = $redis->get("bUSD Price");
    $susd_price = $redis->get("sUSD Price");
    $seth_holders = $redis->get("sETH Holders");
    $total_supply_seth = $redis->get("sETH Total Supply");
    $total_balance_weth = $redis->get("wETH Total Balance");
    $weth_price = $redis->get("wETH Price");
    $seth_price = $redis->get("sETH Price");
    echo $susd_holders . "<br/>" . $susd_total_supply;

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