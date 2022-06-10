<?php include('layout/header.php');

$sql = "
SELECT * FROM products
";
$stmt = $dbconnect->prepare($sql);
$stmt->execute();
$products = $stmt->fetch();
?>


<div class="row">


        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img src="img/products/<?=$products['img_url']?>" class="w-100 shadow-1-strong rounded mb-4">
        </div>
 
</div>
</body>
</html>
