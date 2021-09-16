<?php
    include("simple_html_dom.php");

    //Connecting to Redis server on localhost 
    include("redis_config.php");
   
    /* SurgeUSD Stats */

        //get total supply for sUSD
        
        //get data from BSCScan for sUSD & bUSD
        $get_html_susd = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
        $get_html_busd = file_get_html('https://bscscan.com/token/0xe9e7cea3dedca5984780bafc599bd69add087d56?a=0x14fee7d23233ac941add278c123989b86ea7e1ff');
        
        //store data into variables
        $susd_holders = $get_html_susd->find('div[class="mr-3"]',0)->plaintext;
        $total_supply_susd = $get_html_susd->find('span[class="hash-tag text-truncate"]',0)->plaintext;
        $total_balance_busd = $get_html_busd->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
        $busd_price = $get_html_busd->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
        
        //strip commas from total supply susd
        $total_supply_susd_no_commas = str_replace(',', '', $total_supply_susd);
        
        //remove unneeded data from total balance busd
        $total_balance_busd_trimmed = substr($total_balance_busd, 8, -5);

        //strip commas from total balance busd
        $total_balance_busd_no_commas = str_replace(',', '', $total_balance_busd_trimmed);
        
        //format busd price
        $busd_price_trimmed = substr($busd_price, 12, 6);  

        //calculate sUSD Price
        $susd_price = $total_balance_busd_no_commas / $total_supply_susd_no_commas;

        //format susd price 
        $susd_trimmed = rtrim(sprintf('%.16f', floatval($susd_price)),'0');

        //get the current price of BNB
        $get_bnb_price = file_get_html('https://bscscan.com/token/0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c');
        $bnb_price = $get_bnb_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
        $bnb_price_trimmed = substr($bnb_price, 12, 6);
        $bnb_price = $bnb_price_trimmed;

    
    /* SurgeETH Stats */


        //get data from BSCScan for sETH & wETH
        $get_html_seth = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
        $get_html_weth = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

        //store data into variables
        $seth_holders = $get_html_seth->find('div[class="mr-3"]',0)->plaintext;
        $total_supply_seth = $get_html_seth->find('span[class="hash-tag text-truncate"]',0)->plaintext;
        $total_balance_weth = $get_html_weth->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
        $weth_price = $get_html_weth->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;

        //strip commas from sETH
        $total_supply_seth_no_commas = str_replace(',', '', $total_supply_seth);

        //strip commas from wETH
        $weth_price_trimmed = substr($weth_price, 12, 8);
        $weth_price_no_commas = str_replace(',', '', $weth_price_trimmed);

        //remove unneeded data from total balance wETH
        $total_balance_weth_trimmed = substr($total_balance_weth, 8, -5);

        //strip commas from total balance wETH
        $total_balance_weth_no_commas = str_replace(',', '', $total_balance_weth_trimmed);

        //remove unneeded data from current price of wETH
        $weth_price_trimmed = substr($weth_price, 12, 6);
        
        //calculate sETH Price
        $seth_price = $total_balance_weth_no_commas / $total_supply_seth_no_commas;

        //format sETH price
        $seth_trimmed = rtrim(sprintf('%.16f', floatval($seth_price)),'0');

    
    /* SurgeBTC Stats */

        //get data from BSCScan for sBTC & BTCb
        $get_html_sbtc = file_get_html('https://bscscan.com/token/0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1');
        $get_html_btcb = file_get_html('https://bscscan.com/token/0x7130d2a12b9bcbfae4f2634d864a1ee1ce3ead9c?a=0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1');

        //store data into variables
        $sbtc_holders = $get_html_sbtc->find('div[class="mr-3"]',0)->plaintext;
        $total_supply_sbtc = $get_html_sbtc->find('span[class="hash-tag text-truncate"]',0)->plaintext;
        $total_balance_btcb = $get_html_btcb->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
        $btcb_price = $get_html_btcb->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;

        //strip commas from sBTC
        $total_supply_sbtc_no_commas = str_replace(',', '', $total_supply_sbtc);

        //strip commas from btcb
        $btcb_price_trimmed = substr($btcb_price, 12, 8);
        $btcb_price_no_commas = str_replace(',', '', $btcb_price_trimmed);

        //remove unneeded data from total balance btcb
        $total_balance_btcb_trimmed = substr($total_balance_btcb, 8, -5);

        //strip commas from total balance btcb
        $total_balance_btcb_no_commas = str_replace(',', '', $total_balance_btcb_trimmed);

        //remove unneeded data from current price of btcb
        $btcb_price_trimmed = substr($btcb_price, 12, 6);
        
        //calculate sBTC Price
        $sbtc_price = $total_balance_btcb_no_commas / $total_supply_sbtc_no_commas;

        //format sBTC price
        $sbtc_trimmed = rtrim(sprintf('%.16f', floatval($sbtc_price)),'0');


    /* SurgeADA Stats */

        //get data from BSCScan for sADA & bADA
        $get_html_sada = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
        $get_html_bada = file_get_html('https://bscscan.com/token/0x3ee2200efb3400fabb9aacf31297cbdd1d435d47?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');

        //store data into variables
        $sada_holders = $get_html_sada->find('div[class="mr-3"]',0)->plaintext;
        $total_supply_sada = $get_html_sada->find('span[class="hash-tag text-truncate"]',0)->plaintext;
        $total_balance_bada = $get_html_bada->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
        $bada_price = $get_html_bada->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;

        //strip commas from sADA
        $total_supply_sada_no_commas = str_replace(',', '', $total_supply_sada);

        //strip commas from bADA
        $bada_price_trimmed = substr($bada_price, 12, 8);
        $bada_price_no_commas = str_replace(',', '', $bada_price_trimmed);

        //remove unneeded data from total balance bADA
        $total_balance_bada_trimmed = substr($total_balance_bada, 8, -5);

        //strip commas from total balance bADA
        $total_balance_bada_no_commas = str_replace(',', '', $total_balance_bada_trimmed);

        //remove unneeded data from current price of bADA
        $bada_price_trimmed = substr($bada_price, 12, 6);
        
        //calculate sADA Price
        $sada_price = $total_balance_bada_no_commas / $total_supply_sada_no_commas;

        //format sADA price
        $sada_trimmed = rtrim(sprintf('%.16f', floatval($sada_price)),'0');

    
    //set the data in redis string 
        $redis->set("sUSD Holders", trim($susd_holders));
        $redis->set("sUSD Total Supply", trim($total_supply_susd_no_commas));
        $redis->set("bUSD Total Balance", trim($total_balance_busd_no_commas));
        $redis->set("bUSD Price", trim($busd_price_trimmed));
        $redis->set("sUSD Price", trim($susd_trimmed));
        $redis->set("BNB Price", trim($bnb_price_trimmed));

        $redis->set("sETH Holders", trim($seth_holders));
        $redis->set("sETH Total Supply", trim($total_supply_seth_no_commas));
        $redis->set("wETH Total Balance", trim($total_balance_weth_no_commas));
        $redis->set("wETH Price", trim($weth_price_no_commas));
        $redis->set("sETH Price", trim($seth_trimmed));
        
        $redis->set("sBTC Holders", trim($sbtc_holders));
        $redis->set("sBTC Total Supply", trim($total_supply_sbtc_no_commas));
        $redis->set("BTCb Total Balance", trim($total_balance_btcb_no_commas));
        $redis->set("BTCb Price", trim($btcb_price_no_commas));
        $redis->set("sBTC Price", trim($sbtc_trimmed));
        
        $redis->set("sADA Holders", trim($sada_holders));
        $redis->set("sADA Total Supply", trim($total_supply_sada_no_commas));
        $redis->set("bADA Total Balance", trim($total_balance_bada_no_commas));
        $redis->set("bADA Price", trim($bada_price_no_commas));
        $redis->set("sADA Price", trim($sada_trimmed));

        echo "1";
    
?>
