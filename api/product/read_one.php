<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
 
// include database and object files
include_once '../config/database.php';

 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
$col_products = new MongoCollection($db, "products");
$col_categories = new MongoCollection($db, "categories"); 


$id = isset($_GET['id']) ? $_GET['id'] : die();
$find_arry = array("id" => $id);
$product = $col_products->findOne($find_arry);

$categorie_cursor = $col_categories->find();

$arry_categories = array();
$arry_products = array();
$arry_products["records"] = array();

// var_dump($product);

foreach($categorie_cursor as $category){
    $arry_categories[$category["id"]] = $category["name"];
}

// create array
$product_item = array(
    "id" =>  $product["id"],
    "name" => $product["name"],
    "description" => $product["description"],
    "price" => $product["price"],
    "category_id" => $product["category_id"],
    "category_name" => $arry_categories[$product['category_id']],
    "modified" => $product["modified"],
    "created" => $product["created"]
);

 
// make it json format
echo(json_encode($product_item));
?>