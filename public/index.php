<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

	if (mysqli_connect_errno()) {
		echo "Err " . $con->connect_error;
		exit();
	}

	$sql = "SELECT * FROM products";
    $stmt = $dbconnect->query($sql);
    $products = $stmt->fetchAll();

?>

<?=template_header('Home')?>

<div class="row">
	<?php foreach($products as $product) { ?>
		<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">

			<a href="product.php?id=<?=htmlentities($product['id'])?>">

			<a href="product.php?id=<?=$product['id']?>">

				<img src="img/products/<?=$product['img_url']?>" class="productThumb w-100 shadow-1-strong rounded mb-4">
				<h3><?=$product["title"]?></h3>
			    <h3><?=$product["price"]?></h3>
			    <h3><?=$product["stock"]?></h3>
			</a>
		</div>
    <?php } ?>
</div>

<?php
$products->free_result();
$dbconnect->close();
template_footer();
?>




