<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<?php

$db = getDB();
$query = "SELECT id, category, name, description, stock, unit_price FROM Products WHERE 1=1 AND visibility = 1";
$name = se($_GET, "name", "", false);
$desc = se($_GET, "description", "", false);
$cat = se($_GET, "category", "", false);
$stock = se($_GET, "stock", "", false);
$cost = se($_GET, "unit_price", "", false);
$id = se($_GET, "id", "", false);



// dynamic query for search
$params = []; //define default params, add keys as needed and pass to execute
//apply name filter

if(!empty($id)) {
$query .= " AND id = :id";
$params[":id"] = "$id";
}

$stmt = $db->prepare($query); //dynamically generated query

try {
    $stmt->execute($params); //dynamically populated params to bind
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $result = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}

?>

<div class="container-fluid">
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <div class="col">
            <div class="card bg-light">
            <?php //error_log(var_export($result)); ?>
                <?php for ($i = 0; $i < count($result); $i++) : ?>
                    
                    <?php if ($i = 1): ?>
                        <div class="card-header">
                            <h5 class="card-title"><?php se($result, "category"); ?></h5>
                        </div>
                    <?php endif;?>

                    <?php if ($i = 2): ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php se($result, "name"); ?></h5>
                        </div>
                    <?php endif;?>

                    <?php if ($i = 3): ?>
                        <p class="card-text"><?php se($result, "description"); ?></p>
                    <?php endif;?>

                    <?php if ($i = 4): ?>
                        <div class="card-footer">
                        Cost: <?php se($result, "unit_price"); ?>
                    <?php endif;?>

                    <?php if ($i = 5): ?>
                        <div class="card-footer">
                        Stock: <?php se($result, "stock"); ?>
                        </div>
                    <?php endif;?>
                <?php endfor; ?>
        <form>
                            <button onclick="purchase('<?php se($result, 'id'); ?>')" class="btn btn-primary">Add to Cart</button>
                        </form>
                        <?php if (has_role("Admin") || has_role("Shop Owner")) : ?>
                            <form action="<?php echo get_url('admin/edit_product.php'); ?>" method="POST">
                                <input type="hidden" name="product" value="<?php se($result, 'name'); ?>" />
                                <button class="btn btn-primary">Edit Product</a> 
                            </form>
                            
                            <!-- the class makes it look like a button here -->
                        <?php endif; ?>

<?php
require(__DIR__."/../../partials/flash.php");
?>