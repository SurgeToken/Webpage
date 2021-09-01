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

$seth_result = $json_seth->result;
$susd_result =  $json_susd->result;

echo ("sETH Result: " . $seth_result);
echo ("sUSD Result: " . $susd_result);


?>