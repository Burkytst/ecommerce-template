<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
    
    // Set the post variables so we easily identify them, also make sure they are integer
    $product_id = (int)$_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    $sql = "SELECT * FROM products WHERE id = $product_id";
    $stmt = $dbconnect->query($sql);
    $product = $stmt->fetch();

    // Check if the product exists (array is not empty)
    if ($product && $quantity > 0) {
        // Product exists in database, now we can create/update the session variable for the cart
        if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            if (array_key_exists($product_id, $_SESSION['cart'])) {
                // Product exists in cart so just update the quanity
                $_SESSION['cart'][$product_id] += $quantity;
            } else {
                // Product is not in cart so add it
                $_SESSION['cart'][$product_id] = $quantity;
            }
        } else {
            // There are no products in cart, this will add the first product to cart
            $_SESSION['cart'] = array($product_id => $quantity);
        }
    }
    // Prevent form resubmission...
    header('location: index.php?page=cart');
    exit;
}

// Update product quantities in cart if the user clicks the "Update" button on the shopping cart page
if (isset($_POST['update']) && isset($_SESSION['cart'])) {
    // Loop through the post data so we can update the quantities for every product in cart
    foreach ($_POST as $k => $v) {
        if (strpos($k, 'quantity') !== false && is_numeric($v)) {
            $id = str_replace('quantity-', '', $k);
            $quantity = (int)$v;
            // Always do checks and validation
            if (is_numeric($id) && isset($_SESSION['cart'][$id]) && $quantity > 0) {
                // Update new quantity
                $_SESSION['cart'][$id] = $quantity;
            }
        }
    }
    // Prevent form resubmission...
    header('location: cart.php');
    exit;
}

//Let´s present the cart if there is items in it
$products_in_cart  = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
$num_items_in_cart = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

$products = array();
$subtotal = 0.00;

if ($products_in_cart) {

    
    // There are products in the cart so we need to select those products from the database
    // Products in cart array to question mark string array, we need the SQL statement to include IN (?,?,?,...etc)
    $array_to_question_marks = implode(',', array_fill(0, count($products_in_cart), '?'));
    $stmt = $dbconnect->prepare('SELECT * FROM products WHERE id IN (' . $array_to_question_marks . ')');
    // We only need the array keys, not the values, the keys are the id's of the products
    $stmt->execute(array_keys($products_in_cart));
    // Fetch the products from the database and return the result as an Array
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($products as $product) {
        $subtotal    += (float)$product['price'] * (int)$products_in_cart[$product['id']];
        $subquantity += (int)$product['quantity'] * (int)$products_in_cart[$product['quantity']];
    }

    $totalPrice = $subtotal + 20;
}

?>

<?=template_header('cart')?>
<?php if (empty($products)): ?>
    <h1>Här var det tomt!</h1>
<?php else: ?>
    <form action="cart.php" method="post">
    <div class="container mt-5 p-3 rounded cart">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="product-details mr-2">
                    <a href="index.php"><div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span class="ml-2">Continue Shopping</span></div></a>
                    <hr>
                    <h6 class="mb-0">Shopping cart</h6>
                    <div class="d-flex justify-content-between"><span>You have <?=$subquantity?> items in your cart</span>
                        <div class="d-flex flex-row align-items-center"><span class="text-black-50">Sort by:</span>
                            <div class="price ml-2"><span class="mr-1">price</span><i class="fa fa-angle-down"></i></div>
                        </div>
                    </div>
        <?php foreach ($products as $product): ?>
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row"><img class="rounded" src="img/products/<?=$product['img_url']?>" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block"><?=$product['title']?></span></div>
                        </div>

                        <div class="d-flex flex-row align-items-center"><span class="d-block"><?=$product['price']?></div>
                        <div class="d-flex flex-row align-items-center"><span class="d-block"><input type="number" name="quantity-<?=$product['id']?>" value="<?=$products_in_cart[$product['id']]?>" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required> </span><span class="d-block ml-5 font-weight-bold">&nbsp;$<?=$product['price'] * $products_in_cart[$product['id']]?></span></div>
                    </div>

        <?php endforeach; ?>
        </div>
            </div>
            
            <div class="col-md-4">
                <div class="payment-info">
                
                    <div class="d-flex justify-content-between align-items-center"><span>Card details</span><img class="rounded" src="https://i.imgur.com/WU501C8.jpg" width="30"></div><span class="type d-block mt-3 mb-1">Card type</span><label class="radio"> <input type="radio" name="card" value="payment" checked> <span><img width="30" src="https://img.icons8.com/color/48/000000/mastercard.png"/></span> </label>

                    <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/visa.png"/></span> </label>

                    <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/ultraviolet/48/000000/amex.png"/></span> </label>


                    <label class="radio"> <input type="radio" name="card" value="payment"> <span><img width="30" src="https://img.icons8.com/officel/48/000000/paypal.png"/></span> </label>
                    <div><label class="credit-card-label">Name on card</label><input type="text" class="form-control credit-inputs" placeholder="Name"></div>
                    <div><label class="credit-card-label">Card number</label><input type="text" class="form-control credit-inputs" placeholder="0000 0000 0000 0000"></div>
                    <div class="row">
                        <div class="col-md-6"><label class="credit-card-label">Date</label><input type="text" class="form-control credit-inputs" placeholder="12/24"></div>
                        <div class="col-md-6"><label class="credit-card-label">CVV</label><input type="text" class="form-control credit-inputs" placeholder="342"></div>
                    </div>
                    <hr class="line">
                    <div class="d-flex justify-content-between information"><span>Subtotal</span><span>$<?=$subtotal?></span></div>
                    <div class="d-flex justify-content-between information"><span>Shipping</span><span>$20.00</span></div>
                    <div class="d-flex justify-content-between information"><span>Total(Incl. taxes)</span><span>$<?=$totalPrice?></span></div>
                
                    <input class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="submit" value="Update" name="update">
                    <input class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="submit" value="Place Order" name="placeorder">
                </form>
                </div>
            </div>
        </div>
    </div>
 <?php endif; ?>


<?=template_footer()?>



