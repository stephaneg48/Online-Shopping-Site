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

$stmt = "INSERT INTO OrderItems (product_id, quantity, unit_cost, order_id) SELECT product_id, desired_quantity, unit_cost, order_id FROM CART WHERE user_id = :uid"

?>

<div class="container-fluid">
    <h1>Checkout</h1>
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
</div>
<?php
require(__DIR__."/../../partials/flash.php");
?>

