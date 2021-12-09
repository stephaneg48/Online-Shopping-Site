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

$id = get_user_id();
$query = "SELECT Products.name, Cart.unit_price, Cart.product_id, user_id, desired_quantity FROM Cart INNER JOIN Products ON Cart.product_id = Products.id WHERE user_id = $id";

$stmt = $db->prepare($query); //dynamically generated query

try {
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}
// ...

?>

<div class="container-fluid">
    <h1>Your Cart</h1>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php if(count($results) == 0):?>
            
            <br></br>No results
        <?php endif;?>
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-light">
                    <div class="card-header">
                    <h5 class="card-title"><?php se($item, "category"); ?></h5>
                    </div>

                    <div class="card-body">
                    <form method="GET">
                        <a href="<?php echo get_url('product.php?id='); se($item, "id"); ?>"><h5 class="card-title"><?php se($item, "name"); ?></h5></a>
                        <p class="card-text"><?php se($item, "description"); ?></p>
                    </form>
                    </div>
                    <div class="card-footer">
                        <form method="POST">
                            <label for="cost" name="cost"></label>Cost: <?php se($item, "unit_price"); ?>
                            <?php if (is_logged_in()) : ?>
                                <br><label for="quantity">Quantity:</label>
                                <input type="number" max="99" id="quantity" name="quantity" value="<?php se($quantity); ?>" style="width:50px"></input><br><br>
                                <button onclick="add_to_cart(event, '<?php se($item, 'name'); ?>', '<?php se($item, 'id'); ?>', '<?php se($item, 'unit_price'); ?>', 1)" class="btn btn-primary">Add to Cart</button>
                            <!-- four parameters: name, item id, cost, quantity -->
                            <?php endif; ?>
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

