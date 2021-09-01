<?php

//Connecting to Redis server on localhost 
include("redis_config.php");



//$wallet_address = $_POST["walletAddress"];
$wallet_address = "0x80733dc58b98729346904241C635a5CC78Ce6df8";

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



/* sETH Results */

//get current price of wETH
$get_weth_price = $redis->get("wETH Price");
            
//calculate sETH Price
$seth_price = $redis->get("sETH Price");

//calculate the value of sETH
$user_seth_value = $seth_price * $seth_result;
$user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
//$row['value_eth'] = $user_seth_value_trimmed;

echo("sETH Price: " . $user_seth_value_trimmed . "\n");

//calculate users value in ETH
$user_usd_value = $user_seth_value_trimmed * $get_weth_price;
$user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');

//$row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');
$value_usd = number_format($user_usd_value_trimmed, 2, '.', ',');
echo("ETH Price: " . $value_usd . "\n");




?>