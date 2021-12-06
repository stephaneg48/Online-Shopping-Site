<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin") && !has_role("Shop Owner")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}

// doing it like this to put two features into one...

//handle the toggle first so select pulls fresh data
if ( isset($_POST["id"]) &&
    isset($_POST["name"]) && 
    isset($_POST["desc"]) && 
    isset($_POST["cat"]) && 
    isset($_POST["stock"]) && 
    isset($_POST["cost"]) ) 
    {
        error_log(var_export($_POST, true));
    $id = se($_POST, "id", "", false);
    $prod_name = se($_POST, "name", "", false);
    $desc = se($_POST, "desc", "", false);
    $cat = se($_POST, "cat", "", false);
    $stock = se($_POST, "stock", 0, false);
    $cost = se($_POST, "cost", 99999, false);
    $visible = se($_POST, "visibility", 0, false) ? 1 : 0;
    if (!empty($prod_name) && !empty($desc) && !empty($cat) && $stock >= 0 && $cost >= 0 && ($visible == 1 || $visible == 0)) 
    {
        // error_log("updating");
        $db = getDB();
        $stmt = $db->prepare("UPDATE Products SET name = :name, 
        description = :desc, 
        category = :cat, 
        stock = :stock, 
        unit_price = :cost,
        visibility = :visibility WHERE id = :id");
        try {
            $stmt->execute([":id" => $id, 
            ":name" => $prod_name, 
            ":desc" => $desc, 
            ":cat" => $cat, 
            ":stock" => $stock,
            ":cost" => $cost,
            ":visibility" => $visible]);
            flash("Updated Product", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }
}

$query = "SELECT id, name, description, category, stock, unit_price, visibility from Products";
$search = se($_POST, "product", "", false);
$params = null;
error_log(var_export($_POST, true));
$query .= " WHERE name LIKE :name";
$params =  [":name" => "%$search%"];
error_log(var_export($search, true));
$query .= " ORDER BY modified desc LIMIT 10";
$db = getDB();
$stmt = $db->prepare($query);
$products = [];
try {
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($results) {
        $products = $results;
    } else {
        flash("No matches found", "warning");
    }
} catch (PDOException $e) {
    flash(var_export($e->errorInfo, true), "danger");
}

?>
<h1>Edit Product</h1>
<form method="POST">
    <td>
        <?php /* if this is part of a search, lets persist the search criteria so it reloads correctly*/ ?>
        <input type="search" name="product" placeholder="Product Filter" value="<?php se($search); ?>"/>
        <input type="submit" value="Search" />
    </td>
</form>
<table>
    <thead>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Unit Price</th>
        <th>Visibility</th>
    </thead>
    <tbody>
        <?php if (empty($products)) : ?>
            <tr>
                <td colspan="100%">No products</td>
            </tr>
        <?php else : ?>
            <?php foreach ($products as $product) : ?>
                <tr>
                <form method="POST">
                    <td><?php se($product, "id"); ?></td>
                    <td><input type="text" name="name" value="<?php se($product, "name"); ?>"/></td>
                    <td><input type="text" name="desc" value="<?php se($product, "description"); ?>"/></td>
                    <td><input type="text" name="cat" value="<?php se($product, "category"); ?>"/></td>
                    <td><input type="number" min="1" max="999" name="stock" value="<?php se($product, "stock"); ?>"/></td>
                    <td><input type="number" min="1" max="99999" name="cost" value="<?php se($product, "unit_price"); ?>"/></td>
                    <td><input type="checkbox" checked name="visibility" value="<?php echo (se($product, "visibility", 0, false) ? "visible" : "not visible"); ?>"></td>
                    <!-- "checked" because when I add products, default visibility is 1... -->
                    <td>
                      
                            <input type="hidden" name="id" value="<?php se($product, 'id'); ?>" />
                            <?php if (isset($search) && !empty($search)) : ?>
                            <?php /* if this is part of a search, lets persist the search criteria so it reloads correctly*/ ?>
                            <input type="hidden" name="product" value="<?php se($search); ?>" />
                            <?php endif; ?>
                            <input type="submit" value="Update" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>