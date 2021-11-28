<?php
//note we need to go up 1 more directory
require(__DIR__ . "/../../../partials/nav.php");

if ( !has_role("Admin") && !has_role("Shop Owner"))  {
    flash("You don't have permission to view this page", "warning");
    die(header("Location: $BASE_PATH" . "home.php"));
}

if (isset($_POST["name"]) && isset($_POST["description"]) && isset($_POST["category"]) && isset($_POST["stock"]) && isset($_POST["cost"])) {
    $name = se($_POST, "name", "", false);
    $desc = se($_POST, "description", "", false);
    $cat = se($_POST, "category", "", false);
    $stock = se($_POST, "stock", "", false);
    $cost = se($_POST, "cost", "", false);
    if (empty($name)) {
        flash("Name is required", "warning"); 
    } 
    elseif(empty($desc)) {
        flash("Product must have a description", "warning");
    }
    elseif(empty($cat)) {
        flash("Product must be labeled under a new or existing category", "warning");
    }
    elseif(empty($stock)) {
        flash("New products must have a stock value", "warning");
    }
    elseif(empty($cost)) {
        flash("Product must have a cost", "warning");
    }
    else 
    {
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Products (name, description, category, stock, unit_price, visibility) VALUES(:name, :desc, :cat, :stock, :cost, 1)");
        try {
            $stmt->execute([":name" => $name, ":desc" => $desc, ":cat" => $cat, ":stock" => $stock, ":cost" => $cost]);
            flash("Successfully created product $name!", "success");
        } catch (PDOException $e) {
            if ($e->errorInfo[1] === 1062) {
                flash("A product with this name already exists, please try another", "warning");
            } else {
                flash(var_export($e->errorInfo, true), "danger");
            }
        }
    }
}

?>

<h1>Add Product</h1>
<form method="POST">
    <div>
        <label for="name">Name</label>
        <input id="name" name="name" required /><br><br>
         <!-- for and id have to match so the user can select the field from the name -->
    </div>
    <div>
        <label for="d">Description</label>
        <textarea name="description" id="d"  ></textarea><br><br>
    </div>
    <div>
        <label for="cat">Category</label>
        <input id="cat" name="category"  ></input><br><br>
    </div>
    <div>
        <label for="stock">Stock</label>
        <input id="stock" name="stock"  ></input><br><br>
    </div>
    <div>
        <label for="cost">Unit Price</label>
        <input id="cost" name="cost"  ></input><br><br>
    </div>


    <input type="submit" value="Add Product" />
</form>
<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>