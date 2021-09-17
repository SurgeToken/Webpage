<?php
    include("simple_html_dom.php");

    //Connecting to Redis server on localhost 
    include("redis_config.php");
   
    $b_api_key = "7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

    //get total supply for sBTC
    $sbtc_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1&apikey=".$b_api_key."";

    $sbtc_total_supply_json = json_decode(file_get_contents($sbtc_token_total_supply_url));
    $sbtc_total_supply = $sbtc_total_supply_json->result;
    print_r($sbtc_total_supply);
    echo '<br/>';

    //get total balance of bBTC
    $bbtc_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c&address=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1&tag=latest&apikey=".$b_api_key."";

    $bbtc_total_balance_json = json_decode(file_get_contents($bbtc_token_total_balance_url));
    $bbtc_total_balance = $bbtc_total_balance_json->result;
    print_r($bbtc_total_balance);

    //get data from BSCScan for sBTC Holders
    $get_html_sbtc = file_get_html('https://bscscan.com/token/0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1');
    $sbtc_holders = $get_html_sbtc->find('div[class="mr-3"]',0)->plaintext;

    //get bBTC price from covalent
    $bbtc_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c/?&key=ckey_43c97667ea9547c594b5c51cf0e";

    $bbtc_price_json = json_decode(file_get_contents($bbtc_price_url), true);

    $bbtc_price = $bbtc_price_json['data'][0]['prices'][0]['price'];
    
    //calculate sBTC Price
    $sbtc_price = $bbtc_total_balance / $sbtc_total_supply;

    //format sBTC price
    $sbtc_trimmed = rtrim(sprintf('%.16f', floatval($sbtc_price)),'0');

    //sBTC-bBTC
        /* $redis->set("sBTC Holders", trim($sbtc_holders));
        $redis->set("sBTC Total Supply", trim($sbtc_total_supply));
        $redis->set("bBTC Total Balance", trim($bbtc_total_balance));
        $redis->set("bBTC Price", trim($sbtc_price));
        $redis->set("sBTC Price", trim($sbtc_trimmed)); */

?>