<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

$sql = "SELECT * FROM products";
$stmt = $dbconnect->query($sql);
$products = $stmt->fetchAll();
?>

<?=template_header('Home')?>

<div class="row">
	<?php foreach($products as $product) { ?>
		<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
			<a href="#">
				<img src="img/products/<?=$product['img_url']?>" class="productThumb w-100 shadow-1-strong rounded mb-4">
			</a>
		</div>
    <?php } ?>
</div>

<?=template_footer()?>




