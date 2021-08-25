    <?php

include("simple_html_dom.php");

    $tokens = 23851621090;
    echo "Token Amount: " . $tokens  . "<br/>";
    //get the total supply of sETH
    $get_total_supply_seth = file_get_html('https://bscscan.com/token/0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
    $total_supply_seth = $get_total_supply_seth->find('span[class="hash-tag text-truncate"]',0)->plaintext;
    $total_supply_seth_no_commas = str_replace(',', '', $total_supply_seth);
    echo "Total Supply sETH: " . $total_supply_seth_no_commas . "<br/>";

    //get the total balance of wETH
    $weth_html = file_get_html('https://bscscan.com/token/0x2170ed0880ac9a755fd29b2688956bd959f933f8?a=0x5b1d1bbdcc432213f83b15214b93dc24d31855ef');
    $total_balance_weth = $weth_html->find('div[id="ContentPlaceHolder1_divFilteredHolderBalance"]',0)->plaintext;
    $total_balance_weth_trimmed = substr($total_balance_weth, 8, -5);
    $total_balance_weth_no_commas = str_replace(',', '', $total_balance_weth_trimmed);
    echo "Total Balance wETH: " . $total_balance_weth_no_commas . "<br/>";

    //get current price of wETH
    $weth_price = $weth_html->find('div[id="ContentPlaceHolder1_tr_valuepertoken"]',0)->plaintext;
    $weth_price_trimmed = substr($weth_price, 12, 8);
    $weth_price_no_commas = str_replace(',', '', $weth_price_trimmed);
    echo "Current wETH Price: " . $weth_price_no_commas . "<br/>";

    //calculate sETH Price
    $seth_price = $total_balance_weth_no_commas / $total_supply_seth_no_commas;
    $seth_trimmed = rtrim(sprintf('%.12f', floatval($seth_price)),'0');
    echo "sETH Price: " . $seth_trimmed . "<br/>";
    
    //calculate the value of sETH
    $user_seth_value = $seth_trimmed * $tokens;
    $user_seth_value_trimmed = rtrim(sprintf('%.4f', floatval($user_seth_value)),'0');
    $row['value_eth'] = $user_seth_value_trimmed;
    echo "ETH Value: " . $user_seth_value_trimmed . "<br/>";

    //calculate users value in ETH
    $user_usd_value = $user_seth_value_trimmed * $weth_price_no_commas;
    $user_usd_value_trimmed = rtrim(sprintf('%.2f', floatval($user_usd_value)),'0');
    $row['value_eth'] = $user_eth_value_trimmed;
    echo "sETH USD Value: " . $user_usd_value_trimmed . "<br/>";
            ?>