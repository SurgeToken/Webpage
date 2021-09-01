<?php

//  Initiate curl
$ch = curl_init();
// Will return the response, if false it print the response
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// Set the url
$url = "https://api.covalenthq.com/v1/56/address/0x80733dc58b98729346904241C635a5CC78Ce6df8/balances_v2/?&key=ckey_43c97667ea9547c594b5c51cf0e";

curl_setopt($ch, CURLOPT_URL,$url);
// Execute
$result=curl_exec($ch);
// Closing
curl_close($ch);

// Will dump a beauty json :3
var_dump(json_decode($result, true));
?>