<?php
//Note: this is to resolve cookie issues with port numbers
$domain = $_SERVER["HTTP_HOST"];
if (strpos($domain, ":")) {
    $domain = explode(":", $domain)[0];
}
$localWorks = true; //some people have issues with localhost for the cookie params
//if you're one of those people make this false

//this is an extra condition added to "resolve" the localhost issue for the session cookie
if (($localWorks && $domain == "localhost") || $domain != "localhost") {
    session_set_cookie_params([
        "lifetime" => 60 * 60,
        "path" => "/Project",
        //"domain" => $_SERVER["HTTP_HOST"] || "localhost",
        "domain" => $domain,
        "secure" => true,
        "httponly" => true,
        "samesite" => "lax"
    ]);
}
session_start();
require_once(__DIR__ . "/../lib/functions.php");

?>
<!-- include css and js files -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo get_url('styles.css'); ?>">
<script src="<?php echo get_url('helpers.js'); ?>"></script>
<div> <!-- this is only in a div to prevent it from conflicting with pagination -->
    <nav>
        <ul>
            <?php if (is_logged_in()) : ?>
                <li><a href="<?php echo get_url('home.php'); ?>">Home</a></li>
                <li><a href="<?php echo get_url('profile.php'); ?>">Profile</a></li>
                <li><a href="<?php echo get_url('shop.php'); ?>">Shop</a></li>
                <li><a href="<?php echo get_url('cart.php'); ?>">Your Cart</a></li>
                <li><a href="<?php echo get_url('user_history.php'); ?>">Your Purchases</a></li>
            <?php endif; ?>
            <?php if (!is_logged_in()) : ?>
                <li><a href="<?php echo get_url('login.php'); ?>">Login</a></li>
                <li><a href="<?php echo get_url('register.php'); ?>">Register</a></li>
                <li><a href="<?php echo get_url('shop.php'); ?>">Shop</a></li>
            <?php endif; ?>
            <?php if (has_role("Admin")) : ?>
                <li><a href="<?php echo get_url('admin/create_role.php'); ?>">Create Role</a></li>
                <li><a href="<?php echo get_url('admin/list_roles.php'); ?>">List Roles</a></li>
                <li><a href="<?php echo get_url('admin/assign_roles.php'); ?>">Assign Roles</a></li>
                <li><a href="<?php echo get_url('admin/add_product.php'); ?>">Add Product</a></li>
                <li><a href="<?php echo get_url('admin/edit_product.php'); ?>">Edit Product</a></li>
                <li><a href="<?php echo get_url('admin/purchase_history.php'); ?>">View All Purchases</a></li>
            <?php endif; ?>
            <?php if (has_role("Shop Owner")) : // figure doing them separately is easier to look at ?>
                <li><a href="<?php echo get_url('admin/add_product.php'); ?>">Add Product</a></li>
                <li><a href="<?php echo get_url('admin/edit_product.php'); ?>">Edit Product</a></li>
                <li><a href="<?php echo get_url('admin/purchase_history.php'); ?>">View All Purchases</a></li>
            <?php endif; ?>
            <?php if (is_logged_in()) : ?>
                <li><a href="<?php echo get_url('logout.php'); ?>">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>