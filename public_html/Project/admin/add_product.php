<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}

// ...

?>

<h1>Add Product</h1>
<form method="POST">
    <div>
        <label for="name">Name</label>
        <input id="name" name="name" required />
    </div>
    <div>
        <label for="d">Description</label>
        <textarea name="description" id="d"></textarea>
    </div>
    <input type="submit" value="Add Product" />
</form>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>