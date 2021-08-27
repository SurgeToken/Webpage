<?php 
   //Connecting to Redis server on localhost 
   $redis = new Redis(); 
   $redis->connect('redis', 6793);
   $redis->auth($_ENV["REDIS_PASS"]);
   //echo "Connection to server sucessfully\n"; 
   //set the data in redis string 
   // Get the stored data and print it 
   //$example_data = $redis->get("testdata");
   $example_data = $redis->keys('*');
   //print_r($example_data);
   print("<br>");

   $keys = array_keys($example_data);
   foreach($example_data as $key => $value) {
    echo $value . "<br>";
    echo $redis->get($value);
    echo "<br><br>";
  }

?>