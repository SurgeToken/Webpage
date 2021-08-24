<?php
include("simple_html_dom.php");

$data = array();

//get the # of holders for sUSD
$get_holders = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
$holders = $get_holders->find('div[class="mr-3"]',0)->plaintext;
$row['holders'] = $holders;

//get the total supply of sUSD
$get_total_supply = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
$total_supply = $get_total_supply->find('span[class="hash-tag text-truncate"]',0)->plaintext;
$total_supply_no_commas = str_replace(',', '', $total_supply);
$row['total_supply_susd'] = $total_supply_no_commas;

//get the total balance of bUSD
$get_total_balance = file_get_html('https://bscscan.com/token/0xe9e7cea3dedca5984780bafc599bd69add087d56?a=0x14fee7d23233ac941add278c123989b86ea7e1ff');
$total_balance = $get_total_balance->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
$total_balance_trimmed = substr($total_balance, 8, -5);
$total_balance_no_commas = str_replace(',', '', $total_balance_trimmed);
$row['total_balance_busd'] = $total_balance_no_commas;

//get current price of BUSD
$get_busd_price = file_get_html('https://bscscan.com/token/0xe9e7cea3dedca5984780bafc599bd69add087d56?a=0x14fee7d23233ac941add278c123989b86ea7e1ff');
$busd_price = $get_busd_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
$busd_price_trimmed = substr($busd_price, 12, 6);
$row['busd_price'] = $busd_price_trimmed;

$susd_price = $total_balance_no_commas / $total_supply_no_commas;
$susd_trimmed = rtrim(sprintf('%.8f', floatval($susd_price)),'0');
$row['susd_price'] = $susd_trimmed;

array_push($data, $row);

echo json_encode($data); 



?>