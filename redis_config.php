<?php
    //Connecting to Redis server on localhost 
    $redis = new Redis(); 
    $redis->connect('redis', 6793);
   $redis->auth($_ENV["REDIS_PASS"]);
    //echo "Connection to server sucessfully\n"; 
?>