<?php
    include("simple_html_dom.php");

    $token_selected = $_POST['tokenSelected'];
    $token_post = $_POST['tokenAmount'];

    $tokens = str_replace(',', '', $token_post);

    //get token data from tokenstats.txt
    $token_stats_file = fopen("tokenstats.txt", "r") or die("Unable to open file!");

    $file_data = explode("\n", file_get_contents('tokenstats.txt'));

    $data = array();

    switch($token_selected){
        case "sUSD":

            //get the total supply of sUSD
            $total_supply_susd = $file_data[1];

            //get the total balance of bUSD
            $total_balance_busd = $file_data[2];

            //get current price of BUSD
            $busd_price = $file_data[3];

            //calculate sUSD Price
            $susd_price = $file_data[4];
            
            //get the current price of BNB
            $bnb_price = $file_data[10];
            
            //calculate the USD value of sUSD
            $user_susd_usd_price = $susd_price * $tokens;
            $user_susd_usd_price_trimmed = rtrim(sprintf('%.2f', floatval($user_susd_usd_price)),'0');
            
            $row['value_usd'] = number_format($user_susd_usd_price_trimmed, 2, '.', '');

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
            $get_total_supply_seth = $file_data[6];
           
            //get the total balance of wETH
            $get_total_balance_weth = $file_data[7];
            
            //get current price of wETH
            $get_weth_price = $file_data[8];
            
            //calculate sETH Price
            $seth_price = $file_data[9];
            
            //calculate the value of sETH
            $user_seth_value = $seth_price * $tokens;
            $user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
            $row['value_eth'] = $user_seth_value_trimmed;

            //calculate users value in ETH
            $user_usd_value = $user_seth_value_trimmed * $get_weth_price;
            $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
            
            $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', '');

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
