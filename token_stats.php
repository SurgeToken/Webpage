<?php
    include("simple_html_dom.php");

    $data = array();

    /* SurgeUSD Stats */

    //get the # of holders for sUSD
    $susd_html = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
    $susd_holders = $susd_html->find('div[class="mr-3"]',0)->plaintext;
    $row['susd_holders'] = $susd_holders;

    //get the total supply of sUSD
    $total_supply_susd = $susd_html->find('span[class="hash-tag text-truncate"]',0)->plaintext;
    $total_supply_susd_no_commas = str_replace(',', '', $total_supply_susd);
    $row['total_supply_susd'] = $total_supply_susd_no_commas;

    //get the total balance of bUSD
    $busd_token_html = file_get_html('https://bscscan.com/token/0xe9e7cea3dedca5984780bafc599bd69add087d56?a=0x14fee7d23233ac941add278c123989b86ea7e1ff');
    $total_balance_busd = $busd_token_html->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
    $total_balance_busd_trimmed = substr($total_balance_busd, 8, -5);
    $total_balance_busd_no_commas = str_replace(',', '', $total_balance_busd_trimmed);
    $row['total_balance_busd'] = $total_balance_busd_no_commas;

    //get current price of BUSD
    $busd_price = $busd_token_html->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
    $busd_price_trimmed = substr($busd_price, 12, 6);
    $row['busd_price'] = $busd_price_trimmed;

    //calculate sUSD Price
    $susd_price = $total_balance_busd_no_commas / $total_supply_susd_no_commas;
    $susd_trimmed = rtrim(sprintf('%.8f', floatval($susd_price)),'0');
    $row['susd_price'] = $susd_trimmed;


    /* SurgeETH Stats */

    //get the # of holders for sETH
    $seth_html = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
    $seth_holders = $seth_html->find('div[class="mr-3"]',0)->plaintext;
    $row['seth_holders'] = $seth_holders;

    //get the total supply of sETH
    $total_supply_seth = $seth_html->find('span[class="hash-tag text-truncate"]',0)->plaintext;
    $total_supply_seth_no_commas = str_replace(',', '', $total_supply_seth);
    $row['total_supply_seth'] = $total_supply_seth_no_commas;

    //get the total balance of wETH
    $weth_html = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
    $total_balance_weth = $weth_html->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
    $total_balance_weth_trimmed = substr($total_balance_weth, 8, -5);
    $total_balance_weth_no_commas = str_replace(',', '', $total_balance_weth_trimmed);
    $row['total_balance_weth'] = $total_balance_weth_no_commas;

    //get current price of wETH
    $weth_price = $weth_html->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
    $weth_price_trimmed = substr($weth_price, 12, 6);
    $row['weth_price'] = $weth_price_trimmed;

    //calculate sETH Price
    $seth_price = $total_balance_weth_no_commas / $total_supply_seth_no_commas;
    $seth_trimmed = rtrim(sprintf('%.12f', floatval($seth_price)),'0');
    $row['seth_price'] = $seth_trimmed;

    //push all $row variables into the $data array
    array_push($data, $row);

    //push the $data array to index.html
    echo json_encode($data); 


?>
