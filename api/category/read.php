<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
include_once '../config/database.php';
 
$database = new Database();
$db = $database -> getConnection();

$col_categories = new MongoCollection($db, "categories"); 

$categorie_cursor = $col_categories->find();

$arry_categories = array();
$arry_categories["records"] = array();



foreach($categorie_cursor as $category){
    // array_push($arry_categories,array($category["id"] => $category["name"]));
    $arry_categories[$category["id"]] = $category["name"];
    $category_item = array(
        "id" => $category['id'],
        "name" =>$category['name']
    );
    array_push($arry_categories["records"], $category_item);
}


if(count($arry_categories["records"])>0){
    echo json_encode($arry_categories);
}else{
    echo json_encode(
        array("message" => "No products found.")
    );
}

?>