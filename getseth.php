<?php
    include("simple_html_dom.php");

    //Connecting to Redis server on localhost 
    include("redis_config.php");
   
    $b_api_key = "7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

    //get total supply for sETH
    $seth_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef&apikey=".$b_api_key."";

    $seth_total_supply_json = json_decode(file_get_contents($seth_token_total_supply_url));
    $seth_total_supply = $seth_total_supply_json->result;
    print_r($seth_total_supply);
    echo '<br/>';

    //get total balance of bETH
    $beth_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x2170ed0880ac9a755fd29b2688956bd959f933f8&address=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef&tag=latest&apikey=".$b_api_key."";

    $beth_total_balance_json = json_decode(file_get_contents($beth_token_total_balance_url));
    $beth_total_balance = $beth_total_balance_json->result;
    print_r($beth_total_balance);

    //get data from BSCScan for sETH & wETH
    $get_html_seth = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

    //store data into variables
    $seth_holders = $get_html_seth->find('div[class="mr-3"]',0)->plaintext;

    //get the price of bETH
    $beth_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x2170ed0880ac9a755fd29b2688956bd959f933f8/?&key=ckey_43c97667ea9547c594b5c51cf0e";
    $beth_price_json = json_decode(file_get_contents($beth_price_url), true);

    $beth_price = $beth_price_json['data'][0]['prices'][0]['price'];

    //calculate sETH Price
    $seth_price = $beth_total_balance / $seth_total_supply;
    
    //format sETH price
    $seth_trimmed = rtrim(sprintf('%.16f', floatval($seth_price)),'0');

   //sETH-bETH
        /* $redis->set("sETH Holders", trim($seth_holders));
        $redis->set("sETH Total Supply", trim($seth_total_supply));
        $redis->set("bETH Total Balance", trim($beth_total_balance));
        $redis->set("bETH Price", trim($beth_price));
        $redis->set("sETH Price", trim($seth_trimmed)); */

?>