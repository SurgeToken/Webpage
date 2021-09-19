<?php
    include("simple_html_dom.php");

    //Connecting to Redis server on localhost 
    include("redis_config.php");
   
    $b_api_key = "7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";


    //token functions
    function sUSD(){
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
    }

    function sETH(){
        //get total supply for sETH
        $seth_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef&apikey=".$b_api_key."";

        $seth_total_supply_json = json_decode(file_get_contents($seth_token_total_supply_url));
        $seth_total_supply = $seth_total_supply_json->result;

        //get total balance of bETH
        $beth_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x2170ed0880ac9a755fd29b2688956bd959f933f8&address=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef&tag=latest&apikey=".$b_api_key."";

        $beth_total_balance_json = json_decode(file_get_contents($beth_token_total_balance_url));
        $beth_total_balance = $beth_total_balance_json->result;

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
    }

    function sBTC(){
        //get total supply for sBTC
        $sbtc_token_total_supply_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1&apikey=".$b_api_key."";

        $sbtc_total_supply_json = json_decode(file_get_contents($sbtc_token_total_supply_url));
        $sbtc_total_supply = $sbtc_total_supply_json->result;

        //get total balance of bBTC
        $bbtc_token_total_balance_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c&address=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1&tag=latest&apikey=".$b_api_key."";

        $bbtc_total_balance_json = json_decode(file_get_contents($bbtc_token_total_balance_url));
        $bbtc_total_balance = $bbtc_total_balance_json->result;

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
    }

    function sADA(){
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
    }

    sUSD();
    sETH();
    sleep(2);
    sBTC();
    sADA();

    
    //set the data in redis string 

        //sUSD-bUSD
        $redis->set("sUSD Holders", trim($susd_holders));
        $redis->set("sUSD Total Supply", trim($susd_total_supply));
        $redis->set("bUSD Total Balance", trim($busd_total_balance));
        $redis->set("bUSD Price", trim($busd_price));
        $redis->set("sUSD Price", trim($susd_trimmed));
        $redis->set("BNB Price", trim($bnb_price));
        

        //sETH-bETH
        $redis->set("sETH Holders", trim($seth_holders));
        $redis->set("sETH Total Supply", trim($seth_total_supply));
        $redis->set("bETH Total Balance", trim($beth_total_balance));
        $redis->set("bETH Price", trim($beth_price));
        $redis->set("sETH Price", trim($seth_trimmed));

        //sBTC-bBTC
        $redis->set("sBTC Holders", trim($sbtc_holders));
        $redis->set("sBTC Total Supply", trim($sbtc_total_supply));
        $redis->set("bBTC Total Balance", trim($bbtc_total_balance));
        $redis->set("bBTC Price", trim($bbtc_price));
        $redis->set("sBTC Price", trim($sbtc_trimmed));
        
        
        $redis->set("sADA Holders", trim($sada_holders));
        $redis->set("sADA Total Supply", trim($total_supply_sada_no_commas));
        $redis->set("bADA Total Balance", trim($total_balance_bada_no_commas));
        $redis->set("bADA Price", trim($bada_price_no_commas));
        $redis->set("sADA Price", trim($sada_trimmed));

        echo "1";
    
?>
