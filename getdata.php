<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $data = array();

    $wallet_address = $_POST["walletAddress"];

    $seth_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x5B1d1BBDCc432213F83b15214B93Dc24D31855Ef&address=". $wallet_address ."&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R
    ";
    $susd_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x14fEe7d23233AC941ADd278c123989b86eA7e1fF&address=".$wallet_address."&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R
    ";

    $json_seth = file_get_contents($seth_url);
    $json_susd = file_get_contents($susd_url);

    $seth = json_decode($json_seth);
    $susd = json_decode($json_susd);

    $seth_result = $seth->result;
    $susd_result =  $susd->result;

    /* sUSD Results */

    //get the current price of BNB
    $bnb_price = $redis->get("BNB Price");
                
    //calculate the USD value of sUSD
    $user_susd_usd_price = $susd_price * $susd_result;
    $user_susd_usd_price_trimmed = rtrim(sprintf('%.2f', floatval($user_susd_usd_price)),'0');

    //calculate users value in BNB
    $user_bnb_value = $user_susd_usd_price / $bnb_price;
    $user_bnb_value_trimmed = rtrim(sprintf('%.12f', floatval($user_bnb_value)),'0');
    
    //send data to array
    $row['susd_amount'] = $susd_result;
    $row['value_bnb'] = $user_bnb_value_trimmed;
    $row['value_susd_usd'] = number_format($user_susd_usd_price_trimmed, 2, '.', ',');

    /* sETH Results */

    //get current price of wETH
    $get_weth_price = $redis->get("wETH Price");
                
    //calculate sETH Price
    $seth_price = $redis->get("sETH Price");

    //calculate the value of sETH
    $user_seth_value = $seth_price * $seth_result;
    $user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
    
    //calculate users value in ETH
    $user_usd_value = $user_seth_value_trimmed * $get_weth_price;
    $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');

    //send data to array
    $row['seth_amount'] = $seth_result;
    $row['value_eth'] = $user_seth_value_trimmed;
    $row['value_seth_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');

    //push all $row variables into the $data array
    array_push($data, $row);
    
    //push the $data array to index.html
    echo json_encode($data); 




?>