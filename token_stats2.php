<?php
    
   

    //token functions
    function sUSD(){

        include_once("simple_html_dom.php");

        //Connecting to Redis server on localhost 
        include("redis_config.php");

        //get total supply for sUSD
        $susd_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x14fee7d23233ac941add278c123989b86ea7e1ff&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $susd_total_supply_json = json_decode(file_get_contents($susd_token_total_supply_url));
        $susd_total_supply = $susd_total_supply_json->result;

        //get total balance of busd
        $busd_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0xe9e7cea3dedca5984780bafc599bd69add087d56&address=0x14fee7d23233ac941add278c123989b86ea7e1ff&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $busd_total_balance_json = json_decode(file_get_contents($busd_token_total_balance_url));
        $busd_total_balance = $busd_total_balance_json->result;
        $divisor = 10 ** 18;
        $busd_tb = $busd_total_balance / $divisor;

        //get data from BSCScan for sUSD & bUSD
        $get_html_susd = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
        
        //store data into variables
        $susd_holders = $get_html_susd->find('div[class="mr-3"]',0)->plaintext;

        //get busd price from covalent
        $busd_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0xe9e7cea3dedca5984780bafc599bd69add087d56/?&key=ckey_43c97667ea9547c594b5c51cf0e";
        $busd_price_json = json_decode(file_get_contents($busd_price_url), true);

        $busd_price = $busd_price_json['data'][0]['prices'][0]['price'];

        //calculate sUSD Price
        $susd_price = $busd_tb / $susd_total_supply;

        //format susd price 
        $susd_trimmed = rtrim(sprintf('%.16f', floatval($susd_price)),'0');

        //get the current price of BNB
        $bnb_price_url = "https://api.bscscan.com/api?module=stats&action=bnbprice&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $bnb_price_json = file_get_contents($bnb_price_url);
        $bnb_price_encoded = json_decode($bnb_price_json);
        $bnb_price = $bnb_price_encoded->result->ethusd;

        $redis->set("susd_holders", trim($susd_holders));
        $redis->set("busd_price", trim($busd_price));
        $redis->set("susd_price", trim($susd_trimmed));
        $redis->set("bnb_price", trim($bnb_price));

    }

    function sETH(){

        include_once("simple_html_dom.php");

        //Connecting to Redis server on localhost 
        include("redis_config.php");

        //get total supply for sETH
        $seth_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $seth_total_supply_json = json_decode(file_get_contents($seth_token_total_supply_url));
        $seth_total_supply = $seth_total_supply_json->result;

        //get total balance of bETH
        $beth_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x2170ed0880ac9a755fd29b2688956bd959f933f8&address=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $beth_total_balance_json = json_decode(file_get_contents($beth_token_total_balance_url));
        $beth_total_balance = $beth_total_balance_json->result;
        $divisor = 10 ** 18;
        $beth_tb = $beth_total_balance / $divisor;

        //get data from BSCScan for sETH & wETH
        $get_html_seth = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

        //store data into variables
        $seth_holders = $get_html_seth->find('div[class="mr-3"]',0)->plaintext;

        //get the price of bETH
        $beth_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x2170ed0880ac9a755fd29b2688956bd959f933f8/?&key=ckey_43c97667ea9547c594b5c51cf0e";
        $beth_price_json = json_decode(file_get_contents($beth_price_url), true);

        $beth_price = $beth_price_json['data'][0]['prices'][0]['price'];

        //calculate sETH Price
        $seth_price = $beth_tb / $seth_total_supply;
        
        //format sETH price
        $seth_trimmed = rtrim(sprintf('%.16f', floatval($seth_price)),'0');

        $redis->set("seth_holders", trim($seth_holders));
        $redis->set("beth_price", trim($beth_price));
        $redis->set("seth_price", trim($seth_trimmed));

        /* print_r("sETH Holders: " . $redis->get("seth_holders") . "<br/>");
        print_r("sETH TS: " . $seth_total_supply . "<br/>");
        print_r("bETH TB: " . $beth_tb . "<br/>");
        print_r("bETH Price: " . $redis->get("beth_price") ."<br/>");
        print_r("sETH Price: " . $redis->get("seth_price")); */
    }

    function sBTC(){

        include_once("simple_html_dom.php");

        //Connecting to Redis server on localhost 
        include("redis_config.php");

        //get total supply for sBTC
        $sbtc_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $sbtc_total_supply_json = json_decode(file_get_contents($sbtc_token_total_supply_url));
        $sbtc_total_supply = $sbtc_total_supply_json->result;

        //get total balance of bBTC
        $bbtc_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c&address=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $bbtc_total_balance_json = json_decode(file_get_contents($bbtc_token_total_balance_url));
        $bbtc_total_balance = $bbtc_total_balance_json->result;
        $divisor = 10 ** 18;
        $bbtc_tb = $bbtc_total_balance / $divisor;

        //get data from BSCScan for sBTC Holders
        $get_html_sbtc = file_get_html('https://bscscan.com/token/0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1');
        $sbtc_holders = $get_html_sbtc->find('div[class="mr-3"]',0)->plaintext;

        //get bBTC price from covalent
        $bbtc_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c/?&key=ckey_43c97667ea9547c594b5c51cf0e";

        $bbtc_price_json = json_decode(file_get_contents($bbtc_price_url), true);

        $bbtc_price = $bbtc_price_json['data'][0]['prices'][0]['price'];
        
        //calculate sBTC Price
        $sbtc_price = $bbtc_tb / $sbtc_total_supply;

        //format sBTC price
        $sbtc_trimmed = rtrim(sprintf('%.16f', floatval($sbtc_price)),'0');

        $redis->set("sbtc_holders", trim($sbtc_holders));
        $redis->set("bbtc_price", trim($bbtc_price));
        $redis->set("sbtc_price", trim($sbtc_trimmed));

        /* print_r("sBTC Holders: " . $redis->get("sbtc_holders") . "<br/>");
        print_r("sBTC TS: " . $sbtc_total_supply . "<br/>");
        print_r("bBTC TB: " . $bbtc_tb . "<br/>");
        print_r("bBTC Price: " . $redis->get("bbtc_price") ."<br/>");
        print_r("sBTC Price: " . $redis->get("sbtc_price")); */
    }

    function sADA(){

        include_once("simple_html_dom.php");

        //Connecting to Redis server on localhost 
        include("redis_config.php");

        //get total supply for sADA
        $sada_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $sada_total_supply_json = json_decode(file_get_contents($sada_token_total_supply_url));
        $sada_total_supply = $sada_total_supply_json->result;

        //get total balance of bADA
        $bada_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x3ee2200efb3400fabb9aacf31297cbdd1d435d47&address=0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $bada_total_balance_json = json_decode(file_get_contents($bada_token_total_balance_url));
        $bada_total_balance = $bada_total_balance_json->result;
        $divisor = 10 ** 18;
        $bada_tb = $bada_total_balance / $divisor;

        //get data from BSCScan for sADA & bADA
        $get_html_sada = file_get_html('https://bscscan.com/token/0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF');
        $sada_holders = $get_html_sada->find('div[class="mr-3"]',0)->plaintext;
            
        //get bADA price from covalent
        $bada_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x3ee2200efb3400fabb9aacf31297cbdd1d435d47/?&key=ckey_43c97667ea9547c594b5c51cf0e";

        $bada_price_json = json_decode(file_get_contents($bada_price_url), true);

        $bada_price = $bada_price_json['data'][0]['prices'][0]['price'];

        //calculate sADA Price
        $sada_price = $bada_tb / $sada_total_supply;

        //format sADA price
        $sada_trimmed = rtrim(sprintf('%.16f', floatval($sada_price)),'0');

        $redis->set("sada_holders", trim($sada_holders));
        $redis->set("bada_price", trim($bada_price));
        $redis->set("sada_price", trim($sada_trimmed));

        /* print_r("sADA Holders: " . $redis->get("sada_holders") . "<br/>");
        print_r("sADA TS: " . $sada_total_supply . "<br/>");
        print_r("bADA TB: " . $bada_tb . "<br/>");
        print_r("bADA Price: " . $redis->get("bada_price") ."<br/>");
        print_r("sADA Price: " . $redis->get("sada_price")); */
    }

    function sUSLS(){

        include_once("simple_html_dom.php");

        //Connecting to Redis server on localhost 
        include("redis_config.php");

        //get total supply for sUSELESS
        $suseless_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x2e62e57d1d36517d4b0f329490ac1b78139967c0&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $suseless_total_supply_json = json_decode(file_get_contents($suseless_token_total_supply_url));
        $suseless_total_supply = $suseless_total_supply_json->result;

        //get total balance of useless
        $useless_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x2cd2664ce5639e46c6a3125257361e01d0213657&address=0x2e62e57d1d36517d4b0f329490ac1b78139967c0&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

        $useless_total_balance_json = json_decode(file_get_contents($useless_token_total_balance_url));
        $useless_total_balance = $useless_total_balance_json->result;
        $divisor = 10 ** 18;
        $useless_tb = $useless_total_balance / $divisor;

        //get data from BSCScan for suseless & useless
        $get_html_suseless = file_get_html('https://bscscan.com/token/0x2e62e57d1d36517d4b0f329490ac1b78139967c0');
        $suseless_holders = $get_html_suseless->find('div[class="mr-3"]',0)->plaintext;
            
        //get useless price from covalent
        $useless_price_url = "https://api.covalenthq.com/v1/pricing/historical_by_addresses_v2/56/USD/0x2cd2664ce5639e46c6a3125257361e01d0213657/?&key=ckey_43c97667ea9547c594b5c51cf0e";

        $useless_price_json = json_decode(file_get_contents($useless_price_url), true);

        $useless_price = $useless_price_json['data'][0]['prices'][0]['price'];

        //calculate suseless Price
        $suseless_price = $useless_tb / $suseless_total_supply;

        //format suseless price
        $suseless_trimmed = rtrim(sprintf('%.16f', floatval($suseless_price)),'0');

        $redis->set("suseless_holders", trim($suseless_holders));
        $redis->set("useless_price", trim($useless_price));
        $redis->set("suseless_price", trim($suseless_trimmed));

        /* print_r("suseless Holders: " . $redis->get("suseless_holders") . "<br/>");
        print_r("suseless TS: " . $suseless_total_supply . "<br/>");
        print_r("useless TB: " . $useless_tb . "<br/>");
        print_r("useless Price: " . $redis->get("useless_price") ."<br/>");
        print_r("suseless Price: " . $redis->get("suseless_price")); */
    }

    sUSD();
    sETH();
    sleep(2);
    sBTC();
    sADA();
    sleep(2);
    sUSLS();
   
?>
