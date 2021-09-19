<?php
    include("simple_html_dom.php");

    //Connecting to Redis server on localhost 
    include("redis_config.php");
   
    $b_api_key = "7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

    //get total supply for sUSD
    $susd_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x14fee7d23233ac941add278c123989b86ea7e1ff&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

    $susd_total_supply_json = json_decode(file_get_contents($susd_token_total_supply_url));
    $susd_total_supply = $susd_total_supply_json->result;

    //get total balance of busd
    $busd_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0xe9e7cea3dedca5984780bafc599bd69add087d56&address=0x14fee7d23233ac941add278c123989b86ea7e1ff&tag=latest&apikey=".$b_api_key."";

    $busd_total_balance_json = json_decode(file_get_contents($busd_token_total_balance_url));
    $busd_total_balance = $busd_total_balance_json->result;

    //get data from BSCScan for sUSD & bUSD
    $get_html_susd = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
    
    //store data into variables
    $susd_holders = $get_html_susd->find('div[class="mr-3"]',0)->plaintext;

    //get busd price from covalent
    $busd_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0xe9e7cea3dedca5984780bafc599bd69add087d56/?&key=ckey_43c97667ea9547c594b5c51cf0e";
    $busd_price_json = json_decode(file_get_contents($busd_price_url), true);

    $busd_price = $busd_price_json['data'][0]['prices'][0]['price'];

    //calculate sUSD Price
    $susd_price = $busd_total_balance / $susd_total_supply;

    //format susd price 
    $susd_trimmed = rtrim(sprintf('%.16f', floatval($susd_price)),'0');

    //get the current price of BNB
    $bnb_price_url = "https://api.bscscan.com/api?module=stats&action=bnbprice&apikey=".$b_api_key."";

    $bnb_price_json = file_get_contents($bnb_price_url);
    $bnb_price_encoded = json_decode($bnb_price_json);
    $bnb_price = $bnb_price_encoded->result->ethusd;

    //sUSD-bUSD
    $redis->set("sUSD Holders", trim($susd_holders));
    $redis->set("sUSD Total Supply", trim($susd_total_supply));
    $redis->set("bUSD Total Balance", trim($busd_total_balance));
    $redis->set("bUSD Price", trim($busd_price));
    $redis->set("sUSD Price", trim($susd_trimmed));
    $redis->set("BNB Price", trim($bnb_price));
    
    //move to sETH
    sleep(5);

    //Redirect using the Location header.
    header('Location: https://dev.xsurge.net/getseth.php/');

    //exit to prevent the rest of the script from executing
    exit;

?>