<?php

$url1 = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x5B1d1BBDCc432213F83b15214B93Dc24D31855Ef&address=0x80733dc58b98729346904241C635a5CC78Ce6df8&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R
";
$url2 = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x14fEe7d23233AC941ADd278c123989b86eA7e1fF&address=0x80733dc58b98729346904241C635a5CC78Ce6df8&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R
";

$json = file_get_contents($url1);
$obj = json_decode($json);
echo $obj


?>