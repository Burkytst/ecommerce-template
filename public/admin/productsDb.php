<?php
	require('../../src/config.php');
    require('../../src/dbconnect.php');

    if (mysqli_connect_errno()) {
		echo "Err " . $con->connect_error;
		exit();
	}
//edit
$sql="";
$var="";
$type ="";
$arr =[];
$image_url="demo.jpg";
if(isset($_FILES) && isset($_FILES["image"])){

    $target_dir = "../img/products/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $var .=" img_url=?, ";
        $image_url = basename( $_FILES["image"]["name"] );
        $type .="s";
        array_push($arr,$image_url);
    }
}
if(isset($_POST) && isset($_POST["form_type"]) && $_POST["form_type"]=="add"){
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = floatval($_POST["price"]);
    $stock = intval($_POST["stock"]);
    $sql = "INSERT INTO products (title,description,price,stock,img_url) VALUES (?,?,?,?,?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssiis",$title,$description,$price,$stock,$image_url);
    $stmt->execute();
    echo $stmt->errno === 0? $stmt->id:0;
}
if(isset($_POST) && isset($_POST["form_type"]) && $_POST["form_type"]=="edit"){
    $id = intval($_POST["id"]);
    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = floatval($_POST["price"]);
    $stock = intval($_POST["stock"]);
    $var .= " title=?, description=?, price=?, stock=?";
    $type .="ssii";
    $sql = "UPDATE products SET ". $var . " WHERE id=?";
    $type .="i";
    array_push($arr,$title,$description,$price,$stock,$id);
    $stmt = $con->prepare($sql);
    
    $stmt->bind_param($type,...$arr);
    $stmt->execute();
    echo $stmt->errno === 0? $id:0;
}
if(isset($_POST) && isset($_POST["form_type"]) && $_POST["form_type"]=="delete"){
    $id = intval($_POST["id"]);
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
    echo $stmt->errno === 0? $id:0;
}

?>