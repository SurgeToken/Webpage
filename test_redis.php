<?php 
   //Connecting to Redis server on localhost 
   $redis = new Redis(); 
   $redis->connect('redis', 6793);
   $redis->auth($_ENV["REDIS_PASS"]);
   echo "Connection to server sucessfully\n"; 
   //set the data in redis string 
   $redis->set("Example Data", "This is some example data"); 
   // Get the stored data and print it 
   $example_data = $redis->get("Example Data");
   echo "Data: $example_data";
?>