<?php
require(__DIR__ . "/../../partials/nav.php");

if(!is_logged_in(true))
{
    flash("You're not logged in");
}

$results = [];
$db = getDB();
$stmt = $db->prepare("SELECT id, name, description, category, stock, unit_price, visibility FROM Products WHERE visibility = 1 AND stock > 0 LIMIT 99");
try {
    $stmt->execute();
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}
?>

<script>
    function purchase(item) {
        console.log("TODO purchase item", item);
        //TODO create JS helper to update all show-balance elements
    }
</script>

<div class="container-fluid">
    <h1>Shop</h1>
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-light">
                    <div class="card-header">
                    <h5 class="card-title"><?php se($item, "category"); ?></h5>
                    </div>

                    <div class="card-body">
                        <h5 class="card-title"><?php se($item, "name"); ?></h5>
                        <p class="card-text"><?php se($item, "description"); ?></p>
                    </div>
                    <div class="card-footer">
                        Cost: <?php se($item, "unit_price"); ?>
                        <button onclick="purchase('<?php se($item, 'id'); ?>')" class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>