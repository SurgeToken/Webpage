<?php
    
    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $token_selected = $_POST['tokenSelected'];
    $token_post = strip_tags($_POST['tokenAmount']);

    $tokens = str_replace(',', '', $token_post);

    $data = array();


    switch($token_selected){
        case "sUSD":

            //get the total supply of sUSD
            $total_supply_susd = $redis->get("sUSD Total Supply");

            //get the total balance of bUSD
            $total_balance_busd = $redis->get("bUSD Total Balance");

            //get current price of BUSD
            $busd_price = $redis->get("bUSD Price");

            //calculate sUSD Price
            $susd_price = $redis->get("sUSD Price");
            
            //get the current price of BNB
            $bnb_price = $redis->get("BNB Price");
            
            //calculate the USD value of sUSD
            $user_susd_usd_price = $susd_price * $tokens;
            $user_susd_usd_price_trimmed = rtrim(sprintf('%.2f', floatval($user_susd_usd_price)),'0');

            $row['value_usd'] = number_format($user_susd_usd_price_trimmed, 2, '.', ',');

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
            $get_total_supply_seth = $redis->get("sETH Total Supply");
           
            //get the total balance of wETH
            $get_total_balance_weth = $redis->get("wETH Total Balance");
            
            //get current price of wETH
            $get_weth_price = $redis->get("wETH Price");
            
            //calculate sETH Price
            $seth_price = $redis->get("sETH Price");
            
            //calculate the value of sETH
            $user_seth_value = $seth_price * $tokens;
            $user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
            $row['value_eth'] = $user_seth_value_trimmed;

            //calculate users value in ETH
            $user_usd_value = $user_seth_value * $get_weth_price;
            $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
            
            $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');

            //push all $row variables into the $data array
            array_push($data, $row);

            //push the $data array to index.html
            echo json_encode($data); 
            
            break;
        case "sBTC":

                //get the total supply of sBTC
                $get_total_supply_sbtc = $redis->get("sBTC Total Supply");
               
                //get the total balance of BTCb
                $get_total_balance_btcb = $redis->get("BTCb Total Balance");
                
                //get current price of BTCb
                $get_btcb_price = $redis->get("BTCb Price");
                
                //calculate sBTC Price
                $sbtc_price = $redis->get("sBTC Price");
                
                //calculate the value of sBTC
                $user_sbtc_value = $sbtc_price * $tokens;
                $user_sbtc_value_trimmed = rtrim(sprintf('%.4f', floatval($user_sbtc_value)),'0');
                $row['value_btc'] = $user_sbtc_value_trimmed;
    
                //calculate users value in BTC
                $user_usd_value = $user_sbtc_value * $get_btcb_price;
                $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
                
                $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');
    
                //push all $row variables into the $data array
                array_push($data, $row);
    
                //push the $data array to index.html
                echo json_encode($data); 
                
                break;

        /* case "sADA":

                    //get the total supply of sADA
                    $get_total_supply_sada = $redis->get("sADA Total Supply");
                   
                    //get the total balance of bADA
                    $get_total_balance_bada = $redis->get("bADA Total Balance");
                    
                    //get current price of bADA
                    $get_bada_price = $redis->get("bADA Price");
                    
                    //calculate sADA Price
                    $sada_price = $redis->get("sADA Price");
                    
                    //calculate the value of sADA
                    $user_sada_value = $sada_price * $tokens;
                    $user_sada_value_trimmed = rtrim(sprintf('%.4f', floatval($user_sada_value)),'0');
                    $row['value_ada'] = $user_sada_value_trimmed;
        
                    //calculate users value in ADA
                    $user_usd_value = $user_sada_value * $get_bada_price;
                    $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
                    
                    $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');
        
                    //push all $row variables into the $data array
                    array_push($data, $row);
        
                    //push the $data array to index.html
                    echo json_encode($data); 
                    
                    break; */
        default:
            break;
    }

?>
