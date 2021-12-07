<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<?php
if (!is_logged_in()) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: login.php"));
}

// ...

?>

<div class="container-fluid">
    <h1>Your Cart</h1>
</div>

<?php
require(__DIR__."/../../partials/flash.php");
?>

