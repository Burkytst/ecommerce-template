<?php
	require('../../src/config.php');
    require('../../src/dbconnect.php');
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
//edit
$sql="";
$var="";
$arr =[];
$image_url="demo.jpg";
if(isset($_FILES) && isset($_FILES["image"])){

    $target_dir = "../img/products/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $var .=" img_url=?, ";
        $image_url = basename( $_FILES["image"]["name"] );
        array_push($arr,$image_url);
    }
}
if(isset($_POST) && isset($_POST["form_type"]) && $_POST["form_type"]=="add"){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = floatval($_POST["price"]);
    $stock = intval($_POST["stock"]);
    $sql = "INSERT INTO products (title,description,price,stock,img_url) VALUES (?,?,?,?,?)";
    $stmt = $dbconnect->prepare($sql);
    $result = $stmt->execute([$title,$description,$price,$stock,$image_url]);
    echo $result == 1? 1:0;
}
if(isset($_POST) && isset($_POST["form_type"]) && $_POST["form_type"]=="edit"){
    $id = intval($_POST["id"]);
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = floatval($_POST["price"]);
    $stock = intval($_POST["stock"]);
    $var .= " title=?, description=?, price=?, stock=?";
    $sql = "UPDATE products SET ". $var . " WHERE id=?";
    array_push($arr,$title,$description,$price,$stock,$id);
    $stmt = $dbconnect->prepare($sql);
    $result = $stmt->execute($arr);
    echo $result == 1? $id:0;
}
if(isset($_POST) && isset($_POST["form_type"]) && $_POST["form_type"]=="delete"){
    $id = intval($_POST["id"]);
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $dbconnect->prepare($sql);
    $result = $stmt->execute([$id]);
    echo $result == 1? $id:0;
}

?>