

<?php

// require 'vendor/autoload.php'; // include Composer's autoloader

$uname = "naky";
$pass= "skdltm1303";
$dbName ="blastwaver";
$port = "57584";
$uri = "mongodb://".$uname.":".$pass."@ds157584.mlab.com:".$port."/".$dbName;
$collection = "prac";

//create a connection
$conn = new MongoClient($uri);
$db = $conn->selectDB($dbName);
$col = new MongoCollection($db, $collection);

$data = new stdClass;
$data->foo = 'foo';
$data->bar = 'bar';

$col->insert($data);
echo $data->_id; // An instance of MongoId

?>