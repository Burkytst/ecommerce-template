<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

	$sql = "SELECT * FROM products";
    $stmt = $dbconnect->query($sql);
    $products = $stmt->fetchAll();

?>

<?=template_header('Home')?>




<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>CodePen - Popular Products Section Using HTML , CSS , Bootstrap</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/indexstyle.css">
</head>
<body class="col-12">
					
							<div class="text-center">
										<h3>Populare Products</h3>
										<h2>Which one is your favourite?</h2></div>
	
					
<section class="row col-12">				
<div class="d-flex flex-wrap justify-content-center mt-5">

						<?php foreach($products as $product) { ?>
<div class="card col-3 p-1 bg-white m-3">
            <div class="about-product text-center mt-2">
						<a class="text-dark" href="product.php?id=<?=htmlentities($product['id'])?>">
							<img src="img/products/<?=$product['img_url']?>" class="productThumb mw-100 shadow-1-strong rounded mb-4">
                <div>
                    <h4 class="m-1"><?=$product["title"]?></h4></a>
                    <h6 class="text-dark mt-0 text-black-50"><?=$product["description"]?></h6>
                </div>
            </div>
            <div class="stats mt-2">
                <div class="d-flex justify-content-between p-price m-1"><span>Pro Display XDR</span><span><?=$product["price"]?> </span></div>
                <div class="d-flex justify-content-between p-price m-1"><span>Pro stand</span></div>
                <div class="d-flex justify-content-between p-price m-1"><span>In stock: <?=$product["stock"]?></span></div>
            </div>
            <div class="d-flex justify-content-between total font-weight-bold mt-4"><span>Total</span><span><?=$product["price"]?> SEK</span></div>
        </div>
				
										
										<?php } ?>
					
										
								</div>
						</div>
				</div>
		</div>
</section>
<!-- partial -->
  
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</html>

<?=template_footer('Home')?>


