<?php

class Database{
    
    // specify database credentials
    private $uname = "naky";
    private $pass= "skdltm1303";
    private $dbName ="blastwaver";
    private $port = "57584";
    public $db;

    // get the database connection
    public function getConnection(){

    $uri = "mongodb://".$this->uname.":".$this->pass."@ds157584.mlab.com:".$this->port."/".$this->dbName;

    try{
        $conn = new MongoClient($uri); 
        $this->db = $conn->selectDB($this->dbName);
    }catch(PDOException $exception){
        echo "Connection error ";
    }
    return $this->db;
    }
        
}
?>