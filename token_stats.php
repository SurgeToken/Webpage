<?php
    include("simple_html_dom.php");

    $data = array();
    

    //open tokenstats.txt file
    $token_stats_file = fopen("tokenstats.txt", "rw") or die("Unable to open file!");

    /* SurgeUSD Stats */

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

    //get the current price of BNB
    $get_bnb_price = file_get_html('https://bscscan.com/token/0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c');
    $bnb_price = $get_bnb_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
    $bnb_price_trimmed = substr($bnb_price, 12, 6);
    $bnb_price = $bnb_price_trimmed;

    //push data into $data array
    array_push($data, trim($susd_holders));
    array_push($data, trim($total_supply_susd_no_commas));
    array_push($data, trim($total_balance_busd_no_commas));
    array_push($data, trim($busd_price_trimmed));
    array_push($data, trim($susd_trimmed));
    array_push($data, trim($seth_holders));
    array_push($data, trim($total_supply_seth_no_commas));
    array_push($data, trim($total_balance_weth_no_commas));
    array_push($data, trim($weth_price_no_commas));
    array_push($data, trim($seth_trimmed));
    array_push($data, trim($bnb_price_trimmed));
    

    //loop through array and write data to tokenstats.txt
    for ($i = 0; $i < count($data); $i++) {
        $txt = $data[$i] . "\n";
        fwrite($token_stats_file, $txt);  
    }

    //close file
    fclose($token_stats_file);

?>
