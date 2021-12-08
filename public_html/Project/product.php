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
if(isset($_POST["id"]))
{
    $id = se($_GET, "id", $_POST["id"], false);
}
$quantity = se($_GET, "quantity", "", false);



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
                }
                console.log(http);
            }
        }
        http.open("POST", "api/add_to_cart.php", true);
        let data = {
            prodname: name,
            item_id: item,
            cost: cost,
            quantity: event.target.parentElement.quantity.value

        }
        let q = Object.keys(data).map(key => key + '=' + data[key]).join('&');
        console.log(q)
        http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        http.send(q);
        //TODO create JS helper to update all show-balance elements
    }
</script>

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
                        <?php if (is_logged_in()) : ?>
                                <br><label for="quantity">Quantity:</label>
                                <input type="number" max="99" id="quantity" name="quantity" value="<?php se($quantity); ?>" style="width:50px"></input><br><br>
                                <button onclick="add_to_cart(event, '<?php se($result, 'name'); ?>', '<?php se($result, 'id'); ?>', '<?php se($result, 'unit_price'); ?>', 1)" class="btn btn-primary">Add to Cart</button>
                            <!-- four parameters: name, item id, cost, quantity -->
                            <?php endif; ?>
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