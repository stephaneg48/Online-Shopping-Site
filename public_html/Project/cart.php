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
else
{
    // get the user's id?
}

// ...

?>

<div class="container-fluid">
    <h1>Your Cart</h1>
</div>

<?php
require(__DIR__."/../../partials/flash.php");
?>

