<?php

    include 'Connection.php';
    include 'PostgreSQL.php';

    use SurgePostgreSQL\Connection as Connection;
    use SurgePostgreSQL\PostgreSQL as PostgreSQL;

    //Connecting to Redis server on localhost 
    include("redis_config.php");
    
    $data = array();

    $row['susd_holders'] = $redis->get("susd_holders");
    $row['busd_price'] = $redis->get("busd_price");
    $row['susd_price'] = $redis->get("susd_price");
    
    $row['seth_holders'] = $redis->get("seth_holders");
    $row['beth_price'] = $redis->get("beth_price");
    $row['seth_price'] = $redis->get("seth_price");
    $row['seth_beth_price'] = $redis->get("seth_beth_price");

    $row['sbtc_holders'] = $redis->get("sbtc_holders");
    $row['btcb_price'] = $redis->get("bbtc_price");
    $row['sbtc_price'] = $redis->get("sbtc_price");

    $row['sada_holders'] = $redis->get("sada_holders");
    $row['bada_price'] = $redis->get("bada_price");
    $row['sada_price'] = $redis->get("sada_price");

    $row['susls_holders'] = $redis->get("susls_holders");
    $row['useless_price'] = $redis->get("useless_price");
    $row['susls_price'] = $redis->get("susls_price");


    //push all $row variables into the $data array
    array_push($data, $row);

    //push the $data array to index.html
    echo json_encode($data); 



?>