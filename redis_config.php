<?php
    //Connecting to Redis server on localhost 
    $redis = new Redis(); 
    $redis->connect('redis', 6379); 
    //echo "Connection to server sucessfully\n"; 
?>