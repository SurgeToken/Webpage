<?php
    include("simple_html_dom.php");

    //Connecting to Redis server on localhost 
    include("redis_config.php");
   
    $b_api_key = "7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

    //get total supply for sADA
    $sada_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF&apikey=".$b_api_key."";

    $sada_total_supply_json = json_decode(file_get_contents($sada_token_total_supply_url));
    $sada_total_supply = $sada_total_supply_json->result;

    //get total balance of bADA
    $bada_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x3ee2200efb3400fabb9aacf31297cbdd1d435d47&address=0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF&tag=latest&apikey=".$b_api_key."";

    $bada_total_balance_json = json_decode(file_get_contents($bada_token_total_balance_url));
    $bada_total_balance = $bada_total_balance_json->result;

    //get data from BSCScan for sADA & bADA
    $get_html_sada = file_get_html('https://bscscan.com/token/0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF');
    $sada_holders = $get_html_sada->find('div[class="mr-3"]',0)->plaintext;
        
    //get bADA price from covalent
    $bada_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x3ee2200efb3400fabb9aacf31297cbdd1d435d47/?&key=ckey_43c97667ea9547c594b5c51cf0e";

    $bada_price_json = json_decode(file_get_contents($bada_price_url), true);

    $bada_price = $bada_price_json['data'][0]['prices'][0]['price'];

    //calculate sADA Price
    $sada_price = $bada_total_balance / $sada_total_supply;

    //format sADA price
    $sada_trimmed = rtrim(sprintf('%.16f', floatval($sada_price)),'0');

    //sADA-bADA
    $redis->set("sADA Holders", trim($sada_holders));
    $redis->set("sADA Total Supply", trim($sada_total_supply));
    $redis->set("bADA Total Balance", trim($bada_total_balance));
    $redis->set("bADA Price", trim($bada_price));
    $redis->set("sADA Price", trim($sada_trimmed));
 



?>