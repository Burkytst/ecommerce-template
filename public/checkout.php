<?php
	require('../src/config.php');
    require('../src/dbconnect.php');

//Let´s present the cart if there is items in it
$products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
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
        $subtotal += (float)$product['price'] * (int)$products_in_cart[$product['id']];
    }
}

?>

<?=template_header($product['title'])?>

<?php if (empty($products)): ?>
    <h1>Här var det tomt!</h1>
<?php else: ?>
    <div class="row">
        <?php foreach ($products as $product): ?>

            <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
                <p><?=$product['title']?></p>
            </div>

        <?php endforeach; ?>
        <?=$subtotal?>
        <?php
        if (!isset($_SESSION['loggedin'])) {
            echo 'Logga in för att lägga order';
        } else {
            echo '<button>Lägg order</button>';
        }
    ?>
 <?php endif; ?>

<?=template_footer()?>

<div class="container mt-5 p-3 rounded cart">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="product-details mr-2">
                    <div class="d-flex flex-row align-items-center"><i class="fa fa-long-arrow-left"></i><span class="ml-2">Continue Shopping</span></div>
                    <hr>
                    <h6 class="mb-0">Shopping cart</h6>
                    <div class="d-flex justify-content-between"><span>You have 4 items in your cart</span>
                        <div class="d-flex flex-row align-items-center"><span class="text-black-50">Sort by:</span>
                            <div class="price ml-2"><span class="mr-1">price</span><i class="fa fa-angle-down"></i></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row"><img class="rounded" src="https://i.imgur.com/QRwjbm5.jpg" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block">Iphone 11 pro</span><span class="spec">256GB, Navy Blue</span></div>
                        </div>
                        <div class="d-flex flex-row align-items-center"><span class="d-block">2</span><span class="d-block ml-5 font-weight-bold">$900</span><i class="fa fa-trash-o ml-3 text-black-50"></i></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row"><img class="rounded" src="https://i.imgur.com/GQnIUfs.jpg" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block">One pro 7T</span><span class="spec">256GB, Navy Blue</span></div>
                        </div>
                        <div class="d-flex flex-row align-items-center"><span class="d-block">2</span><span class="d-block ml-5 font-weight-bold">$900</span><i class="fa fa-trash-o ml-3 text-black-50"></i></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row"><img class="rounded" src="https://i.imgur.com/o2fKskJ.jpg" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block">Google pixel 4 XL</span><span class="spec">256GB, Axe black</span></div>
                        </div>
                        <div class="d-flex flex-row align-items-center"><span class="d-block">1</span><span class="d-block ml-5 font-weight-bold">$800</span><i class="fa fa-trash-o ml-3 text-black-50"></i></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3 p-2 items rounded">
                        <div class="d-flex flex-row"><img class="rounded" src="https://i.imgur.com/Tja5H1c.jpg" width="40">
                            <div class="ml-2"><span class="font-weight-bold d-block">Samsung galaxy Note 10&nbsp;</span><span class="spec">256GB, Navy Blue</span></div>
                        </div>
                        <div class="d-flex flex-row align-items-center"><span class="d-block">1</span><span class="d-block ml-5 font-weight-bold">$999</span><i class="fa fa-trash-o ml-3 text-black-50"></i></div>
                    </div>
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
                    <div class="d-flex justify-content-between information"><span>Subtotal</span><span>$3000.00</span></div>
                    <div class="d-flex justify-content-between information"><span>Shipping</span><span>$20.00</span></div>
                    <div class="d-flex justify-content-between information"><span>Total(Incl. taxes)</span><span>$3020.00</span></div><button class="btn btn-primary btn-block d-flex justify-content-between mt-3" type="button"><span>$3020.00</span><span>Checkout<i class="fa fa-long-arrow-right ml-1"></i></span></button></div>
            </div>
        </div>
    </div>




