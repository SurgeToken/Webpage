<?php
    
    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $token_selected = $_POST['tokenSelected'];
    $token_post = strip_tags($_POST['tokenAmount']);

    $tokens = str_replace(',', '', $token_post);

    $data = array();


    switch($token_selected){
        case "sUSD":

            //get current price of BUSD
            $busd_price = $redis->get("busd_price");

            //calculate sUSD Price
            $susd_price = $redis->get("susd_price");
            
            //get the current price of BNB
            $bnb_price = $redis->get("bnb_price");
            
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

            //get current price of wETH
            $get_beth_price = $redis->get("beth_price");
            
            //calculate sETH Price
            $seth_price = $redis->get("seth_price");
            
            //calculate the value of sETH
            $user_seth_value = $seth_price * $tokens;
            $user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
            $row['value_eth'] = $user_seth_value_trimmed;

            //calculate users value in ETH
            $user_usd_value = $user_seth_value * $get_beth_price;
            $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
            
            $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');

            //push all $row variables into the $data array
            array_push($data, $row);

            //push the $data array to index.html
            echo json_encode($data); 
            
            break;
        case "sBTC":

            //get current price of BTCb
            $get_bbtc_price = $redis->get("bbtc_price");
                
            //calculate sBTC Price
            $sbtc_price = $redis->get("sbtc_price");
                
            //calculate the value of sBTC
            $user_sbtc_value = $sbtc_price * $tokens;
            $user_sbtc_value_trimmed = rtrim(sprintf('%.4f', floatval($user_sbtc_value)),'0');
            $row['value_btc'] = $user_sbtc_value_trimmed;
    
            //calculate users value in BTC
            $user_usd_value = $user_sbtc_value * $get_bbtc_price;
            $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
                
            $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');
    
            //push all $row variables into the $data array
            array_push($data, $row);
    
            //push the $data array to index.html
            echo json_encode($data); 
                
            break;
        case "sADA":

            //get current price of bADA
            $get_bada_price = $redis->get("bada_price");
                    
            //calculate sADA Price
            $sada_price = $redis->get("sada_price");
                    
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
                    
            break;
        case "sUSLS":

                //get current price of USELESS
                $get_useless_price = $redis->get("useless_price");
                
                //calculate sUSELESS Price
                $suseless_price = $redis->get("susls_price");
                        
                //calculate the value of sUSELESS
                $user_suseless_value = $suseless_price * $tokens;
                $user_suseless_value_trimmed = rtrim(sprintf('%.2f', floatval($user_suseless_value)),'0');
                $row['value_usls'] = $user_suseless_value_trimmed;
            
                //calculate users value in USELESS
                $user_usd_value = $user_suseless_value * $get_useless_price;
                $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
                        
                $row['value_usd'] = number_format($user_usd_value_trimmed, 2, '.', ',');
            
                //push all $row variables into the $data array
                array_push($data, $row);
            
                //push the $data array to index.html
                echo json_encode($data); 
                        
                break;
        default:
            break;
    }

?>
