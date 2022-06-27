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




