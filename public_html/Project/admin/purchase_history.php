<?php
require(__DIR__."/../../../partials/nav.php");
?>

<?php

$db = getDB();

if (!is_logged_in()) {
    flash("You must be logged in to view this page", "warning");
    die(header("Location: login.php"));
}
if (!has_role("Admin") && !has_role("Shop Owner")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}

$uid = get_user_id();

$stmt = $db->prepare("SELECT U.username, O.id, O.user_id, O.total_price, O.address, O.payment_method, O.created FROM Orders O, Users U WHERE U.id = O.user_id LIMIT 10"); // need dynamic query after

$stmt->execute() or die("there was a problem with the given data: " . var_export($e->errorInfo, true));

$results = [];
while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $results[] = $r;
}

?>

<?php
require(__DIR__."/../../../partials/flash.php");
?>

<h1>All Purchases</h1>
<table id="purchases" class="table table-striped table-hover table-bordered border-dark" style="width:fit-content">
    

    <tbody>
        <?php if (empty($results)) : echo "No purchase history found." ?>
            
        <?php else : ?>
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
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
                    <td><?php $username = $results[$i]['username']; $user_id = $results[$i]['user_id']; echo "<a href='../profile.php?id=$user_id'>$username</a>" ?></td>
                    <td><?php echo $results[$i]['total_price']; ?></td>
                    <td><?php echo $results[$i]['address']; ?></td>
                    <td><?php echo $results[$i]['payment_method']; ?></td>
                    <td><?php echo $results[$i]['created']; ?></td>
                    <td>
                        <a class="btn btn-primary" href="<?php $order_id = $results[$i]['id']; $user_id = $results[$i]['user_id']; echo get_url("admin/purchase.php?id=$order_id&user_id=$user_id"); ?>">View</a>
                    </td>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
    </tbody>
</table>