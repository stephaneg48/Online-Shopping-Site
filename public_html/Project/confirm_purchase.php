<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<?php

$order_items = [];
$uid = get_user_id();

$db = getDB();
if (!is_logged_in() or empty($uid)) // add OK check so user cannot go to this page without making a purchase
{
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}
else
{
    $stmt = $db->prepare("SELECT id, total_price, address, payment_method, created FROM Orders 
    WHERE user_id = :user_id AND created = (SELECT MAX(created) FROM Orders)");
    
    $stmt->execute([":user_id" => $uid]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
    
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $order_result = $r;
    }
    
    $order_total = $order_result['total_price'];
    $user_address = $order_result['address'];
    $payment_method = $order_result['payment_method'];
    $order_creation_time = $order_result['created'];
    $order_id = $order_result['id'];
    
    $stmt = $db->prepare("SELECT product_id, quantity, unit_price FROM OrderItems WHERE order_id = :order_id");
    
    $stmt->execute([":order_id" => $order_id]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
    
    while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $order_items[] = $r;
    }

    $product_names = [];
    for ($i = 0; $i < count($order_items); $i++)
    {
        $current_prod_id = $order_items[$i]["product_id"];
        $stmt = $db->prepare("SELECT name FROM Products WHERE id = :id");
        $stmt->execute([":id" => $current_prod_id]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
        $r = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($r) {
            $product_names[] = $r;
        }
    }

    $date = date('Y-m-d H:i:s');
    similar_text($order_creation_time, $date, $percent);

    if ($percent < 89) // convoluted way of preventing user from browsing to this page
    {
        flash("You must complete a transaction to view this page", "warning");
        die(header("Location: home.php"));
    }
    else
    {
        flash("Thank you for your purchase!", "success");
    }
}

?>

<div class="container-fluid">
    <h1>Purchase Information</h1>
    <div class="row row-cols-2 col-lg-12 g-4">
        <div class="col-lg-2" id="items">
                <div class="col-lg-2">
                    <div class="card bg-light" style="width: 25rem;">

                        <div class="card-header">
                            <h5 class="card-title">
                                Order Details
                            </h5>
                        </div>

                        <div class="card-body">
                            <?php
                            echo "Your Address: $user_address<br>";
                            echo "Payment Method: $payment_method<br>";
                            ?>
                        </div>

                        <div class="card-footer">
                            <?php
                            echo "Time of Order Placement: $order_creation_time<br>";
                            ?>
                        </div>
                    </div>
                </div>

                <br></br>
                <div class="card bg-light" style="width: 25rem;">

                        <div class="card-header">
                            <h5 class="card-title">
                                Order Contents
                            </h5>
                        </div>

                        <div class="card-body">
                            <?php
                            for ($i = 0; $i < count($order_items); $i++)
                            {
                                $product_id = $order_items[$i]["product_id"];
                                $product_name = $product_names[$i]["name"];
                                $subtotal = $order_items[$i]["quantity"] * $order_items[$i]["unit_price"];
                                echo ($i + 1), ". ", $order_items[$i]["quantity"], " of <a href='product.php?id=$product_id'>$product_name</a>", "<br>";
                                echo "Subtotal: ", $subtotal, "<br><br>";
                            }
                            ?>
                        </div>

                        <div class="card-footer">
                            <?php
                            echo "Total: $order_total";
                            ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php
require(__DIR__."/../../partials/flash.php");
?>

