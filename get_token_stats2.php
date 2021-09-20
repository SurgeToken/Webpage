<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");
    
    $data = array();

    $row['susd_holders'] = $redis->get("susd_holders");
    $row['busd_price'] = $redis->get("busd_price");
    $row['susd_price'] = $redis->get("susd_price");
    
    $row['seth_holders'] = $redis->get("seth_holders");
    $row['beth_price'] = $redis->get("beth_price");
    $row['seth_price'] = $redis->get("seth_price");

    $row['sbtc_holders'] = $redis->get("sBTC Holders");
    $row['total_supply_sbtc'] = $redis->get("sBTC Total Supply");
    $row['total_balance_btcb'] = $redis->get("bBTC Total Balance");
    $row['btcb_price'] = $redis->get("bBTC Price");
    $row['sbtc_price'] = $redis->get("sBTC Price");

    $row['sada_holders'] = $redis->get("sADA Holders");
    $row['total_supply_sada'] = $redis->get("sADA Total Supply");
    $row['total_balance_bada'] = $redis->get("bADA Total Balance");
    $row['bada_price'] = $redis->get("bADA Price");
    $row['sada_price'] = $redis->get("sADA Price");

    //push all $row variables into the $data array
    array_push($data, $row);

    //push the $data array to index.html
    echo json_encode($data); 



?>