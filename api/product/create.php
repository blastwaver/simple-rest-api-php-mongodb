<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
$database = new Database();
$db = $database->getConnection();
 
$col_products = new MongoCollection($db, "products"); 
$id = (string) (($col_products->count()) + 1);
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// set product property values

$insert_item = array(
    'id' => $id,
    'name' => $data->name,
    'price' => $data->price,
    'description' => $data->description,
    'category_id' => $data->category_id,
    'created' => date('Y-m-d H:i:s'),
    'modified' => date('Y-m-d H:i:s'),
);

try {
    $col_products->insert($insert_item);
} catch(MongoCursorException $e) {
    echo "Can't save the same person twice!\n";
}

if(isset($insert_item["_id"])) {
    echo '{';
        echo '"message": "Product was created."';
    echo '}';
}else {
    echo '{';
        echo '"message": "Unable to create product."';
    echo '}';
}
   
?>