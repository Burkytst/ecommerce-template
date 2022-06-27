<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    
    if (isset($_GET['id'])) {
    $id =  $_GET['id'];

    $sql = "SELECT * FROM products WHERE id=$id";
    $stmt = $dbconnect->query($sql);
    $product = $stmt->fetch();
    }


?>

<?=template_header($product['title'])?>

<div class="row">

		<div class="col-lg-4 col-md-12 mb-4 mb-lg-0">
				<img src="img/products/<?=$product['img_url']?>" class="productImg">
                <h1><?=$product['title']?></h1>
                <?=$product['description']?>
                <form action="cart.php" method="post">
                    <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
                    <input type="hidden" name="product_id" value="<?=$product['id']?>">
                    <input type="submit" value="Add To Cart">
                </form>
		</div>

</div>

<?=template_footer()?>




