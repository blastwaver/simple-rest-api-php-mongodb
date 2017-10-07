<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    $uname = "naky";
    $pass= "skdltm1303";
    $dbName ="blastwaver";
    $port = "57584";
    $uri = "mongodb://".$uname.":".$pass."@ds157584.mlab.com:".$port."/".$dbName;
    $collection = "prac";
    
    //create a connection
    $conn = new MongoClient($uri);
    // echo $conn;
    $db = $conn->selectDB($dbName);
    // echo $db;
    $col = new MongoCollection($db, $collection);

?>