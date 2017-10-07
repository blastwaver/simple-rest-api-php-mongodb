<?php
// required headers
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// include database and object files
// include database and object files
include_once './config/database.php';


// get database connection
$database = new Database();
$db = $database->getConnection();

$col_products = new MongoCollection($db, "products");
 
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
 
$update_target = array("id"=>1);
try {
     $col_products->update($update_target, array(
        "id" =>1,
        "name"=>"kkkkkk",
        "price"=>123213,
        "description"=>"asddasdas",
        "category_id"=>1,
        'modified' => date('Y-m-d H:i:s'),
        "created"=>date('Y-m-d H:i:s')
    ));
} catch(MongoCursorException $e) {
    echo "Can't save the same person twice!\n";
}


// var_dump($update_resurt);
 
// update the product
// if($product->update()){
//     echo '{';
//         echo '"message": "Product was updated."';
//     echo '}';
// }
 
// // if unable to update the product, tell the user
// else{
//     echo '{';
//         echo '"message": "Unable to update product."';
//     echo '}';
// }
?>