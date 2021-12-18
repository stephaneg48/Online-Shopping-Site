<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<?php

$results = [];
$db = getDB();
if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}

$uid = get_user_id();
$name = se($_POST, "name", "", false);
$cost = (int)se($_POST, "cost", 0, false);
$quantity = (int)se($_POST, "quantity", 0, false);
$item_id = (int)se($_POST, "product_id", 0, false);

$query = "SELECT Products.name, Cart.id, Cart.unit_price, Cart.product_id, user_id, desired_quantity, (Cart.unit_price * Cart.desired_quantity) as subtotal FROM Cart INNER JOIN Products ON Cart.product_id = Products.id WHERE user_id = $uid";
$subtotal = 0;
$cart_subtotals = [];

$stmt = $db->prepare($query); //dynamically generated query
try {
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
    foreach($results as $item)
        {
            foreach($item as $detail => $value)
            {
                if($detail == "subtotal")
                {
                    array_push($cart_subtotals,$value);
                }
            }
            
        }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}

$cart_total = array_sum($cart_subtotals);

$stmt = "INSERT INTO OrderItems (product_id, quantity, unit_price, order_id) 
SELECT product_id, desired_quantity, unit_price, :order_id FROM Cart WHERE user_id = $uid";

// currently have cart...
// display items from cart or display from orderitems?
// on purchase, the above statement should run (i think)?
// then the cart should be emptied, products (and shop, if stock runs out) should be updated...
// then the user should be redirected to successful checkout page?

?>

<div class="container-fluid">
    <h1>Checkout</h1>
    <div class="row row-cols-2 col-lg-12 g-4">
        <?php if(count($results) == 0):?>
            <br></br>  &emsp; Your cart is empty.
        <?php endif;?>
        <?php foreach ($results as $item) : ?>
            <div class="col-lg-2">
                <div class="card bg-light" style="width: 18rem;">
                    <div class="card-header">
                    <h5 class="card-title"><?php se($item, "category"); ?></h5>
                    </div>

                    <div class="card-body">
                        <form method="GET">
                        <a href="<?php echo get_url('product.php?id='); se($item, "product_id"); ?>"><h5 class="card-title"><?php se($item, "name"); ?></h5></a>
                        <p class="card-text"><?php se($item, "description"); ?></p>
                    </form>
                    </div>
                    <div class="card-footer">
                        <form method="POST">
                            <label for="cost" name="cost"></label>Cost: <?php se($item, "unit_price"); ?>
                            <?php if (is_logged_in()) : ?>
                                <br>Quantity: <?php se($item, "desired_quantity"); ?>
                                <input type="hidden" name="cart_id" value="<?php se($item, 'id');?>"/>
                            <!-- four parameters: name, item id, cost, quantity -->
                            <?php endif; ?>
                            <br><br><label for="subtotal" name="subtotal"></label>Subtotal: 
                            <?php 
                            $subtotal += (int)se($item, "subtotal");
                            ?>
                        </form>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
            <div class="col-lg-3">
            <form>
                <div class="form-group">
                    <label for="firstname">First name</label>
                    <input type="text" class="form-control" id="firstname">
                </div>
                <div class="form-group">
                    <label for="lastname">Last name</label>
                    <input type="text" class="form-control" id="lastname">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address">
                </div>
                <div class="form-group">
                    <label for="placenumber">Apt / Suite / Other</label>
                    <input type="text" class="form-control" id="placenumber">
                </div>
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city">
                </div>
                <div class="form-group">
                    <label for="state">State/Province</label>
                    <input type="text" class="form-control" id="state">
                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <input type="text" class="form-control" id="country">
                </div>
                <div class="form-group">
                    <label for="zipcode">ZIP/Postal code</label>
                    <input type="number" min="0" class="form-control" id="zipcode">
                    <style>
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                
                        input[type=number] {
                            -moz-appearance: textfield;
                        }
                    </style>
                </div>
                <br>
                <div class="form-group">
                    <label for="method">Payment Method</label>
                    <input type="text" class="form-control" id="method">
                </div>
                <div class="form-group">
                    <label for="confirmorder">Purchase Confirmation</label>
                    <input type="number" min="0" class="form-control" id="confirmorder"  placeholder="Enter value">
                    <style>
                        input::-webkit-outer-spin-button,
                        input::-webkit-inner-spin-button {
                            -webkit-appearance: none;
                            margin: 0;
                        }
                
                        input[type=number] {
                            -moz-appearance: textfield;
                        }
                    </style>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
</form>
            </div>
    </div>
    <br>
    <div class="row row-cols-1 row-cols-md-3 g-5">
        <div class="col">
                <?php if ($cart_total != 0) : ?>
                    <div class="card bg-light" style="width:150px">
                        <div class="card-header" >
                            Total: <?php echo $cart_total; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</div>
<?php
require(__DIR__."/../../partials/flash.php");
?>

