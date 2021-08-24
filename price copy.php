<?php

$data = array();

        //get the total supply of sUSD
        $total_supply_susd_url = "https://api.bscscan.com/api?module=stats&action=tokensupply&contractaddress=0x14fee7d23233ac941add278c123989b86ea7e1ff&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";
        $total_supply_susd_json = file_get_contents($total_supply_susd_url);
        $total_supply_susd_json_data = json_decode($total_supply_susd_json, true);
        $row['susd_total_supply'] = $total_supply_susd_json_data["result"];

        //get the total balance of bUSD
        $total_balance_busd_url = "https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0xe9e7cea3dedca5984780bafc599bd69add087d56&address=0x14fee7d23233ac941add278c123989b86ea7e1ff&tag=latest&apikey=7BY2SX3KIF1NT1QEPY82VZB2WBTJFMN75R";
        $total_balance_busd_json = file_get_contents($total_balance_busd_url);
        $total_balance_busd_json_data = json_decode($total_balance_busd_json, true);
        $row['busd_total_balance'] = $total_balance_busd_json_data["result"];




        array_push($data, $row);

        die(json_encode($data));

    ?>