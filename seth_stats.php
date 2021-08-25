<?php
include("simple_html_dom.php");

$data = array();

//get the # of holders for sETH
$get_holders = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

$holders = $get_holders->find('div[class="mr-3"]',0)->plaintext;
//echo "Holders: " . $holders . "<br/>";
$row['holders'] = $holders;

//get the total supply of sETH
$get_total_supply = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

$total_supply = $get_total_supply->find('span[class="hash-tag text-truncate"]',0)->plaintext;

$total_supply_no_commas = str_replace(',', '', $total_supply);
//echo "Total Supply sETH: " . $total_supply  . "<br/>";
//echo "Total Supply sETH No Commas: " . $total_supply_no_commas  . "<br/>";
$row['total_supply_seth'] = $total_supply_no_commas;

//get the total balance of bUSD
$get_total_balance = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

$total_balance = $get_total_balance->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;

$total_balance_trimmed = substr($total_balance, 8, -5);
$total_balance_no_commas = str_replace(',', '', $total_balance_trimmed);


//echo "Total Balance wETH: " . $total_balance_trimmed . "<br/>";
//echo "Total Balance No Commas: " . $total_balance_no_commas . "<br/>";
$row['total_balance_weth'] = $total_balance_no_commas;

//get current price of BUSD
$get_weth_price = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

$weth_price = $get_weth_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;

$weth_price_trimmed = substr($weth_price, 12, 6);
//echo "WETH Price: " . $weth_price_trimmed . "<br/>";
$row['weth_price'] = $weth_price_trimmed;

$seth_price = $total_balance_no_commas / $total_supply_no_commas;
//echo "sETH Price: " . $seth_price;

$seth_trimmed = rtrim(sprintf('%.12f', floatval($seth_price)),'0');
//echo "SurgeUSD Price: " . $seth_trimmed;
$row['seth_price'] = $seth_trimmed;

array_push($data, $row);

echo json_encode($data); 



?>