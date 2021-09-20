<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $data = array();
    $api_key = "6XENNFYMQP975TRGDPMDM6GSZ4VSWW6VYG";

    $wallet_address = $_POST["walletAddress"];

    //Surge Token Array
    $tokens_array = array(
        "SUSD"=>"0x14fEe7d23233AC941ADd278c123989b86eA7e1fF", 
        "SETH"=>"0x5B1d1BBDCc432213F83b15214B93Dc24D31855Ef", 
        "SBTC"=>"0xb68c9D9BD82BdF4EeEcB22CAa7F3Ab94393108a1",
        "SADA"=>"0xbF6bB9b8004942DFb3C1cDE3Cb950AF78ab8A5AF"
    );

    foreach($tokens_array as $token_name => $token_address) {

        $token_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=".$token_address."&address=". $wallet_address ."&tag=latest&apikey=".$api_key."";

        $json_token = file_get_contents($token_url);
        $token = json_decode($json_token);

        $token_result = $token->result;

        switch($token_name){
            case "SUSD":
                //get the current price of BNB
                $get_bnb_price = $redis->get("bnb_price");

                //calculate sUSD Price
                $susd_price = $redis->get("susd_price");

                $u_token = "BNB";
                $s_token = "sUSD";

                //calculate the USD value of sUSD
                $user_token_usd_value = $susd_price * $token_result;
                $user_token_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_token_usd_value)),'0');
                
                //calculate users value in BNB
                $user_token_value = $user_token_usd_value / $get_bnb_price;
                $user_token_value_trimmed = rtrim(sprintf('%.12f', floatval($user_token_value)),'0');
                break;
            case "SETH":
                //get current price of wETH
                $get_beth_price = $redis->get("beth_price");
                        
                //calculate sETH Price
                $seth_price = $redis->get("seth_price");

                $u_token = "ETH";
                $s_token = "sETH";

                //calculate the ETH value of sETH
                $user_token_value = $seth_price * $token_result;
                $user_token_value_trimmed = rtrim(sprintf('%.4f', floatval($user_token_value)),'0');
                
                //calculate users value in ETH
                $user_token_usd_value = $user_token_value * $get_beth_price;
                $user_token_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_token_usd_value)),'0');
                break;
            case "SBTC":
                //get current price of bBTC
                $get_btcb_price = $redis->get("bBTC Price");
                            
                //calculate sBTC Price
                $sbtc_price = $redis->get("sBTC Price");

                $u_token = "BTC";
                $s_token = "sBTC";

                //calculate the BTC value of sBTC
                $user_token_value = $sbtc_price * $token_result;
                $user_token_value_trimmed = rtrim(sprintf('%.6f', floatval($user_token_value)),'0');
                    
                //calculate users value in BTC
                $user_token_usd_value = $user_token_value * $get_btcb_price;
                $user_token_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_token_usd_value)),'0');
                break;
            case "SADA":
                //get current price of bBTC
                $get_bada_price = $redis->get("bADA Price");
                                
                //calculate sADA Price
                $sada_price = $redis->get("sADA Price");
    
                $u_token = "ADA";
                $s_token = "sADA";
    
                //calculate the ADA value of sADA
                $user_token_value = $sada_price * $token_result;
                $user_token_value_trimmed = rtrim(sprintf('%.2f', floatval($user_token_value)),'0');
                        
                //calculate users value in ADA
                $user_token_usd_value = $user_token_value * $get_bada_price;
                $user_token_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_token_usd_value)),'0');
                break;
            default:
                break;

        }

        if($token_result != "0"){
            //send data to array
            $row['token_amount'] = $token_result;
            $row['u_token'] = $u_token;
            $row['s_token'] = $s_token;
            $row['value_utoken'] = $user_token_value_trimmed;
            $row['value_token_usd'] = number_format($user_token_usd_value_trimmed, 2, '.', ',');

            //push all $row variables into the $data array
            array_push($data, $row);
        } else {
            //do nothing
        }

        
         
    }

    //push the $data array to index.html
    echo json_encode(array_filter($data)); 


?>