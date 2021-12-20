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

$cart_id = (int)se($_POST, "cart_id", 0, false);

if(isset($_POST["delete"]))
{
    $stmt = $db->prepare("DELETE FROM Cart where id = :cart_id");
    $stmt->bindValue(":cart_id", $cart_id, PDO::PARAM_INT);
    error_log("cart id is $cart_id");
    $stmt->execute();
}

if(isset($_POST["delete_all"]))
{
    $stmt = $db->prepare("DELETE FROM Cart where user_id = :uid");
    $stmt->bindValue(":uid", $uid, PDO::PARAM_INT);
    error_log("user id is $uid, about to clear this user's cart");
    $stmt->execute();
}

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
// ...
$cart_total = array_sum($cart_subtotals);


?>

<script>
    function add_to_cart(event, name, item, cost, quantity) {
        console.log("TODO purchase item", item);
        console.log(event);
        let http = new XMLHttpRequest();
        http.onreadystatechange = () => {
            if (http.readyState == 4) {
                if (http.status === 200) {
                    let data = JSON.parse(http.responseText);
                    console.log("received data", data);
                    flash(data.message, "success");
                    event.preventDefault();
                }
                console.log(http);
            }
        }
        http.open("POST", "api/add_to_cart.php", true);
        let data = {
            update: true,
            prodname: name,
            item_id: item,
            cost: cost,
            quantity: event.target.parentElement.quantity.value            

        }
        if (event.target.parentElement.quantity.value == 0)
        {
            event.target.closest(".col").remove();
        }
        let q = Object.keys(data).map(key => key + '=' + data[key]).join('&');
        console.log(q)
        http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        http.send(q);
        //TODO create JS helper to update all show-balance elements
    }
</script>

<div class="container-fluid">
    <h1>Your Cart</h1>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php if(count($results) == 0):?>
            
            <br></br>  &emsp; Your cart is empty.
        <?php endif;?>
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-light">
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
                                <br><label for="quantity">Quantity:</label>
                                <input type="number" min="0" max="99" id="quantity" name="quantity" value="<?php se($item, "desired_quantity"); ?>" style="width:50px"></input><br><br>
                                <button onclick="add_to_cart(event, '<?php se($item, 'name'); ?>', '<?php (int)se($item, 'product_id'); ?>', '<?php se($item, 'unit_price'); ?>', 1)" class="btn btn-primary">Update</button>
                                <input type="hidden" name="cart_id" value="<?php se($item, 'id');?>"/>
                                <input type="submit" name="delete" value="Remove from Cart" class="btn btn-primary"/>
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

                <div>
                    <form method="POST">
                        <br>
                        <?php if ($cart_total != 0) : ?>
                            <input type="hidden" name="uid" value="<?php se($item, 'user_id');?>"/>
                            <input type="submit" name="delete_all" value="Remove All" class="btn btn-primary"/>
                            <a href="<?php echo get_url('checkout.php');?>" class="btn btn-success">Go to Checkout</a>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
</div>

<?php
require(__DIR__."/../../partials/flash.php");
?>

