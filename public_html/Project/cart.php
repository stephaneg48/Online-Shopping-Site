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
$query = "SELECT name, unit_price, product_id, user_id, desired_quantity FROM Cart WHERE user_id = :id";

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
</div>

<?php
require(__DIR__."/../../partials/flash.php");
?>

