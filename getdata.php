<?php

    //Connecting to Redis server on localhost 
    include("redis_config.php");

    $data = array();
    $api_key = "7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";

    $wallet_address = $_POST["walletAddress"];

    $tokens_array = array("SUSD"=>"0x14fEe7d23233AC941ADd278c123989b86eA7e1fF", "SETH"=>"0x5B1d1BBDCc432213F83b15214B93Dc24D31855Ef");

    foreach($tokens_array as $token_name => $token_address) {

        $token_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=".$token_address."&address=". $wallet_address ."&tag=latest&apikey=".$api_key."";

        $json_token = file_get_contents($token_url);
        $token = json_decode($json_token);

        $token_result = $token->result;

        if($token_result != 0){
            
            switch($token_name){
                case "SUSD":
                    //get the current price of BNB
                    $get_bnb_price = $redis->get("BNB Price");

                    //calculate sUSD Price
                    $susd_price = $redis->get("sUSD Price");

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
                    $get_weth_price = $redis->get("wETH Price");
                            
                    //calculate sETH Price
                    $seth_price = $redis->get("sETH Price");

                    $u_token = "ETH";
                    $s_token = "sETH";

                    //calculate the ETH value of sETH
                    $user_token_value = $seth_price * $token_result;
                    $user_token_value_trimmed = rtrim(sprintf('%.2f', floatval($user_token_value)),'0');
                    
                    //calculate users value in ETH
                    $user_token_usd_value = $user_token_value * $get_weth_price;
                    $user_token_usd_value_trimmed = rtrim(sprintf('%.4f', floatval($user_token_usd_value)),'0');
                    break;
                default:
                    break;

            }

            //send data to array
            $row['token_amount'] = $token_result;
            $row['u_token'] = $u_token;
            $row['s_token'] = $s_token;
            $row['value_utoken'] = $user_token_value_trimmed;
            $row['value_token_usd'] = number_format($user_token_usd_value_trimmed, 2, '.', ',');

        }

        //push all $row variables into the $data array
        array_push($data, $row);
         
    }

    //push the $data array to index.html
    echo json_encode($data); 


?>