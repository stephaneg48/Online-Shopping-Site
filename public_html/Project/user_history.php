<?php
require(__DIR__."/../../partials/nav.php");
?>

<?php

$db = getDB();

if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}

$uid = get_user_id();

$stmt = $db->prepare("SELECT id, total_price, address, payment_method, created FROM Orders WHERE user_id = :user_id LIMIT 10");

$stmt->execute([":user_id" => $uid]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));

$results = [];
while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $results[] = $r;
}

?>

<?php
require(__DIR__."/../../partials/flash.php");
?>

<h1>Your Purchases</h1>
<table id="purchases" class="table table-striped table-hover table-bordered border-dark" style="width:fit-content">
    

    <tbody>
        <?php if (empty($results)) : echo "No purchase history found." ?>
            
        <?php else : ?>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Cart Total</th>
                <th scope="col">Shipping Address</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Time of Purchase</th>
                <th scope="col" style="background-color:black"></th>
                </tr>
            </thead>
            
            <?php for ($i = 0; $i < count($results); $i++) : ?>
                <tr>
                    <th scope="row"><?php echo $i+1 ?></th>
                    <td><?php echo $results[$i]['total_price']; ?></td>
                    <td><?php echo $results[$i]['address']; ?></td>
                    <td><?php echo $results[$i]['payment_method']; ?></td>
                    <td><?php echo $results[$i]['created']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php $order_id = $results[$i]['id']; echo get_url("purchase.php?id=$order_id"); ?>">View</a>
                    </td>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
    </tbody>
</table>