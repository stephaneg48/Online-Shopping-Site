<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if (!has_role("Admin") && !has_role("Shop Owner")) {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}
//handle the toggle first so select pulls fresh data
if ( isset($_POST["prod_name"]) || 
    isset($_POST["desc"]) || 
    isset($_POST["cat"]) || 
    isset($_POST["stock"]) || 
    isset($_POST["unit_price"]) || 
    isset($_POST["visible"]) ) 
    {
    $prod_name = se($_POST, "prod_name", "", false);
    $desc = se($_POST, "desc", "", false);
    $cat = se($_POST, "cat", "", false);
    $stock = se($_POST, "stock", 0, false);
    $cost = se($_POST, "unit_price", 99999, false);
    $visible = se($_POST, "visible", 0, false);
    if (!empty($prod_name) && !empty($desc) && !empty($cat) && $stock >= 0 && $unit_price >= 0 && ($visible == 1 || $visible == 0)) 
    {
        $db = getDB();
        $stmt = $db->prepare("UPDATE Products SET name = $prod_name, 
        description = $desc, 
        category = $cat, 
        stock = $stock, 
        unit_price = $cost,
        visibility = $visible WHERE id = :id");
        try {
            $stmt->execute([":id" => $prod_name]);
            flash("Updated Product", "success");
        } catch (PDOException $e) {
            flash(var_export($e->errorInfo, true), "danger");
        }
    }
}
$query = "SELECT id, name, description, category, stock, unit_price, visibility from Products";
$params = null;
if (isset($_POST["name"])) {
    $search = se($_POST, "name", "", false);
    $query .= " WHERE name LIKE :name";
    $params =  [":name" => "%$search%"];
}
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
    <input type="search" name="product" placeholder="Product Filter" />
    <input type="submit" value="Search"/>
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
                    <td><?php se($product, "id"); ?></td>
                    <td><input type="text" name="name" value="<?php se($product, "name"); ?>"/></td>
                    <td><input type="text" name="desc" value="<?php se($product, "description"); ?>"/></td>
                    <td><input type="text" name="cat" value="<?php se($product, "category"); ?>"/></td>
                    <td><input type="number" max="999" name="stock" value="<?php se($product, "stock"); ?>"/></td>
                    <td><input type="number" max="99999" name="cost" value="<?php se($product, "unit_price"); ?>"/></td>
                    <td><?php echo (se($product, "visibility", 0, false) ? "visible" : "not visible"); ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php se($product, 'id'); ?>" />
                            <?php if (isset($search) && !empty($search)) : ?>
                                <?php /* if this is part of a search, lets persist the search criteria so it reloads correctly*/ ?>
                                <input type="hidden" name="id" value="<?php se($product, "id"); ?>" />
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