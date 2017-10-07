<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
 
$database = new Database();
$db = $database -> getConnection();

$col_products = new MongoCollection($db, "products");
$col_categories = new MongoCollection($db, "categories"); 

$products_cursor = $col_products->find();
$categorie_cursor = $col_categories->find();

$arry_categories = array();
$arry_products = array();
$arry_products["records"] = array();



foreach($categorie_cursor as $category){
    // array_push($arry_categories,array($category["id"] => $category["name"]));
    $arry_categories[$category["id"]] = $category["name"];
}

foreach( $products_cursor as $product){
    $product_item =array(
        "id" => $product['id'],
        "name" => $product['name'],
        "description" => $product['description'],
        "price" => $product['price'],
        "category_id" => $product['category_id'],
        // "category_name" => $arry_categories['1']        
        "category_name" => $arry_categories[$product['category_id']]
    );
    array_push($arry_products["records"], $product_item);
}


if(count($arry_products["records"])>0){
    echo json_encode($arry_products);
}else{
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>