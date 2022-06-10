<?php include('layout/header.php');

$sql = "SELECT * FROM products";
$stmt = $dbconnect->query($sql);
$products = $stmt->fetchAll();
?>


<div class="row">

		<?php foreach($products as $product) { ?>
        <div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
            <img src="img/products/<?=$product['img_url']?>" class="w-100 shadow-1-strong rounded mb-4">
			
		</div>
            

    <?php } ?>
</div>
</body>
</html>
