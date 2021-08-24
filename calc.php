<?php
    include("simple_html_dom.php");

    $token_selected = $_POST['tokenSelected'];
    $token_post = $_POST['tokenAmount'];

    $tokens = str_replace(',', '', $token_post);

    $data = array();

    switch($token_selected){
        case "sUSD":
            //get the total supply of sUSD
            $get_total_supply_susd = file_get_html('https://bscscan.com/token/0x14fee7d23233ac941add278c123989b86ea7e1ff');
            $total_supply_susd = $get_total_supply_susd->find('span[class="hash-tag text-truncate"]',0)->plaintext;
            $total_supply_susd_no_commas = str_replace(',', '', $total_supply_susd);
            $total_supply_susd = $total_supply_susd_no_commas;

            //get the total balance of bUSD
            $get_total_balance_busd = file_get_html('https://bscscan.com/token/0xe9e7cea3dedca5984780bafc599bd69add087d56?a=0x14fee7d23233ac941add278c123989b86ea7e1ff');
            $total_balance_busd = $get_total_balance_busd->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
            $total_balance_busd_trimmed = substr($total_balance_busd, 8, -5);
            $total_balance_busd_no_commas = str_replace(',', '', $total_balance_busd_trimmed);
            $total_balance_busd = $total_balance_busd_no_commas;

            //get current price of BUSD
            $get_busd_price = file_get_html('https://bscscan.com/token/0xe9e7cea3dedca5984780bafc599bd69add087d56?a=0x14fee7d23233ac941add278c123989b86ea7e1ff');
            $busd_price = $get_busd_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
            $busd_price_trimmed = substr($busd_price, 12, 6);
            $busd_price = $busd_price_trimmed;

            //calculate sUSD Price
            $susd_price = $total_balance_busd_no_commas / $total_supply_susd_no_commas;
            $susd_trimmed = rtrim(sprintf('%.16f', floatval($susd_price)),'0');
            
            //get the current price of BNB
            $get_bnb_price = file_get_html('https://bscscan.com/token/0xbb4CdB9CBd36B01bD1cBaEBF2De08d9173bc095c');
            $bnb_price = $get_bnb_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
            $bnb_price_trimmed = substr($bnb_price, 12, 6);
            $bnb_price = $bnb_price_trimmed;
            
            //calculate the USD value of sUSD
            $user_susd_usd_price = $susd_trimmed * $tokens;
            $user_susd_usd_price_trimmed = rtrim(sprintf('%.2f', floatval($user_susd_usd_price)),'0');
            $row['value_usd'] = $user_susd_usd_price_trimmed;

            //calculate users value in BNB
            $user_bnb_value = $user_susd_usd_price / $bnb_price;
            $user_bnb_value_trimmed = rtrim(sprintf('%.12f', floatval($user_bnb_value)),'0');
            $row['value_bnb'] = $user_bnb_value_trimmed;

            //push all $row variables into the $data array
            array_push($data, $row);

            //push the $data array to index.html
            echo json_encode($data); 
            
            break;
        case "sETH":
            //get the total supply of sETH
            $get_total_supply_seth = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
            $total_supply_seth = $get_total_supply_seth->find('span[class="hash-tag text-truncate"]',0)->plaintext;
            $total_supply_seth_no_commas = str_replace(',', '', $total_supply_seth);
           
            //get the total balance of wETH
            $get_total_balance_weth = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
            $total_balance_weth = $get_total_balance_weth->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
            $total_balance_weth_trimmed = substr($total_balance_weth, 8, -5);
            $total_balance_weth_no_commas = str_replace(',', '', $total_balance_weth_trimmed);
            
            //get current price of wETH
            $get_weth_price = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
            $weth_price = $get_weth_price->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
            $weth_price_trimmed = substr($weth_price, 12, 8);
            $weth_price_no_commas = str_replace(',', '', $weth_price_trimmed);
            
            //calculate sETH Price
            $seth_price = $total_balance_weth_no_commas / $total_supply_seth_no_commas;
            $seth_trimmed = rtrim(sprintf('%.12f', floatval($seth_price)),'0');
            
            //calculate the value of sETH
            $user_seth_value = $seth_trimmed * $tokens;
            $user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
            $row['value_eth'] = $user_seth_value_trimmed;

            //calculate users value in ETH
            $user_usd_value = $user_seth_value_trimmed * $weth_price_no_commas;
            $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
            $row['value_usd'] = $user_usd_value_trimmed;

            //push all $row variables into the $data array
            array_push($data, $row);

            //push the $data array to index.html
            echo json_encode($data); 
            
        

            
            break;
        default:
            break;
    }


    /* SurgeETH Stats */

    


?>
