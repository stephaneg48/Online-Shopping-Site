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

?>

<script>
    function makePurchase(event, items, uid) {
        event.preventDefault();
        var checkTotal = document.getElementById("cartTotal").getAttribute('value');
        var confirm = document.getElementById("confirmorder").value;

        emptyFieldCheck = 0;
        // check required fields and purchase confirmation
        let fields = {
            firstname: document.getElementById("firstname").value,
            lastname: document.getElementById("lastname").value,
            user_address: document.getElementById("address").value,
            city: document.getElementById("city").value,
            state: document.getElementById("state").value,
            country: document.getElementById("country").value,
            zipcode: document.getElementById("zipcode").value
        };

        for (const key in fields)
        {
            const value = fields[key];
            if (value === "")
            {
                emptyFieldCheck += 1;
            }
        }

        if (emptyFieldCheck != 0)
        {
            window.alert("Please fill in all required fields.");
        }
        else if (confirm != checkTotal)
        {
            window.alert("To complete the purchase, please enter your cart total into the Purchase Confirmation field.");
        }
        else // safe to complete
        {
            var product_info = [];
            items = document.getElementById("items").children;
            for (var i = 0; i < items.length; i++)
            {
                item = items[i];
                item_id = item.querySelector("#item_id").value;
                item_quantity = item.querySelector("#item_quantity").getAttribute('value');
                item_unit_price = item.querySelector("#item_cost").getAttribute('value');
                product_info[i] = [item_id, item_quantity, item_unit_price];
            }
            //console.log(product_info);
            
            let data = {
                userid: uid,
                products: product_info,
                total: checkTotal, // divs do not have value property, so .value will not work, use getAttribute
                address: document.getElementById("address").value,
                method: document.getElementById("methodSelect").value
            }
            console.log(data);
            let http = new XMLHttpRequest();
            http.open("POST", "api/purchase_cart.php", true);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.onreadystatechange = function() {
                if (http.readyState == 4) {
                    if (http.status === 200) {
                        //console.log(http.responseText);
                        window.location.href="./confirm_purchase.php";
                    }
                }
                
            }
            
            http.send("json=" + encodeURIComponent(JSON.stringify(data))); 
            //TODO create JS helper to update all show-balance elements
        }
    }
</script>

<div class="container-fluid">
    <h1>Checkout</h1>
    <div class="row row-cols-2 col-lg-12 g-4">
        <div class="col-lg-2" id="items">
            <?php if(count($results) == 0):?>
                <br></br>  &emsp; Your cart is empty.
            <?php endif;?>
            <?php foreach ($results as $item) : ?>
                <div class="col-lg-2" id="item">
                    <div class="card bg-light" style="width: 18rem;">
                        <div class="card-header">
                        <h5 class="card-title"><?php se($item, "category"); ?></h5>
                        </div>

                        <div class="card-body">
                            <form method="GET">
                            <a href="<?php echo get_url('product.php?id='); se($item, "product_id"); ?>"><h5 class="card-title"><?php se($item, "name"); ?></h5></a>
                        </form>
                        </div>
                        <div class="card-footer">
                            <form method="POST">
                                <label for="cost" id="item_cost" name="cost" value="<?php se($item, "unit_price"); ?>"></label>Cost: <?php se($item, "unit_price"); ?>
                                <?php if (is_logged_in()) : ?>
                                    <br><label for="quantity" id="item_quantity" name="quantity" value="<?php se($item, "desired_quantity"); ?>"></label>Quantity: <?php se($item, "desired_quantity"); ?>
                                    <input type="hidden" id="item_id" name="cart_id" value="<?php se($item, 'product_id');?>"/>
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
        
            <div class="col-lg-3">
            <form>
                <div class="form-group">
                    <label for="firstname">First name (required)</label>
                    <input type="text" class="form-control" id="firstname" required>
                </div>
                <div class="form-group">
                    <label for="lastname">Last name (required)</label>
                    <input type="text" class="form-control" id="lastname" required>
                </div>
                <div class="form-group">
                    <label for="address">Address (required)</label>
                    <input type="text" class="form-control" id="address" required>
                </div>
                <div class="form-group">
                    <label for="placenumber">Apt / Suite / Other</label>
                    <input type="text" class="form-control" id="placenumber">
                </div>
                <div class="form-group">
                    <label for="city">City (required)</label>
                    <input type="text" class="form-control" id="city" required>
                </div>
                <div class="form-group">
                    <label for="state">State/Province (required)</label>
                    <input type="text" class="form-control" id="state" required>
                </div>
                <div class="form-group">
                    <label for="country">Country (required)</label>
                    <input type="text" class="form-control" id="country" required>
                </div>
                <div class="form-group">
                    <label for="zipcode">ZIP/Postal code (required)</label>
                    <input type="number" required min="0" class="form-control" id="zipcode">
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
                    <select class="form-select" id="methodSelect" aria-label="Default select example">
                        <option value="Cash">Cash</option>
                        <option value="Visa">Visa</option>
                        <option value="MasterCard">MasterCard</option>
                        <option value="American Express">American Express</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="confirmorder">Purchase Confirmation</label>
                    <input type="number" min="0" class="form-control" id="confirmorder" placeholder="Enter total">
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
                <button type="submit" onclick="makePurchase(event, items, <?php echo get_user_id(); ?>)" class="btn btn-success">Submit</button> 
                <!-- echo so the value gets stored in submit -->
</form>
            </div>
    </div>
    <br>
    <div class="row row-cols-1 row-cols-md-3 g-5">
        <div class="col">
                <?php if ($cart_total != 0) : ?>
                    <div class="card bg-light" style="width:150px">
                        <div id="cartTotal" value=<?php echo $cart_total; ?> class="card-header">
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

