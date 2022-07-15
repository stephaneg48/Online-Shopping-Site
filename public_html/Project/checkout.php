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
$product_ids = [];
$product_names = [];
$desired_quantities = [];

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
                if($detail == "product_id")
                {
                    array_push($product_ids,$value);
                }
                if($detail == "name")
                {
                    array_push($product_names,$value);
                }
                if($detail == "desired_quantity")
                {
                    array_push($desired_quantities,$value);
                }
            }
            
        }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}

$cart_total = array_sum($cart_subtotals);

// using the product ids for each item, get the current stock for each item
// if any product's desired quantity exceeds the available stock, alert the user
// alert should tell user to go to the product details page for that product and adjust how much they want
// submit button should be disabled if the user is alerted

$desired_exceeds_stock = false;
$bad_product = ""; 
// name of product that has desired quantity that exceed the stock

for($i = 0; $i < count($product_ids); $i++)
{
    $current_product_stock = 0;
    $current_product_name = $product_names[$i];
    $current_product_id = $product_ids[$i];
    $current_product_desired_quantity = $desired_quantities[$i];
    $stmt = $db->prepare("SELECT stock FROM Products WHERE id=:id");

    $stmt->execute([":id" => $current_product_id]); 
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $current_product_stock = $r[0]["stock"]; // expecting one result...
    }

    if ($current_product_desired_quantity > $current_product_stock)
    {
        // alert the user multiple times if they attempt to do this for multiple products
        $desired_exceeds_stock = true;
        $bad_product = $current_product_name;
        break;
    }
}

?>

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
                <?php if ($desired_exceeds_stock == false) : ?>
                    <button id="purchase" type="submit" onclick="makePurchase(event, items, <?php echo get_user_id(); ?>)" class="btn btn-success">Submit</button> 
                <?php else : // put the value in the disabled button so js can take it out... simple enough ?>
                    <button id="purchase" type="submit" value="<?php echo $bad_product; ?>" class="btn btn-secondary" disabled>Submit</button> 
                <?php endif; ?>
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

<script>
    // first, check if any desired quantities are bad before allowing the user to submit the form
    // how to check? the submit button will be disabled
    // if it's disabled, alert the user
    var submitButton = document.querySelector("#purchase");
    console.log(submitButton);
    if (submitButton.disabled == true)
    {
        flash("ATTENTION: The quantity of " + submitButton.value + " that you are attempting to purchase exceeds the available stock.","warning");
        flash("Please refer to the product details page and adjust the quantity in your cart.","warning");
    }

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



