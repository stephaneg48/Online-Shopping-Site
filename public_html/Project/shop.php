<?php
require(__DIR__ . "/../../partials/nav.php");


function get_categories()
{
    $db = getDB();
    $stmt = $db->prepare("SELECT DISTINCT category FROM Products");
    $cats = [];
    try {
        $stmt->execute();
        $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if($r)
        {
            $cats = $r;
        }
    }
    catch(PDOException $e) {
        error_log("Category lookup error: " . var_export($e, true));
    }
    return $cats;
}

$results = [];
$db = getDB();
//Sort and Filters
$col = se($_GET, "col", "unit_price", false);
if (!in_array($col, ["unit_price"])) {
    $col = "unit_price"; //default value, prevent sql injection
}
$order = se($_GET, "order", "asc", false);
//allowed list
if (!in_array($order, ["asc", "desc"])) {
    $order = "asc"; //default value, prevent sql injection
}

$query = "SELECT id, name, description, category, stock, unit_price, visibility FROM Products WHERE 1=1 AND visibility = 1 AND stock > 0";

$name = se($_GET, "name", "", false);
$cat = se($_GET, "category", "", false);
$id = se($_GET, "id", "", false);
$quantity = se($_GET, "quantity", "", false);

// dynamic query for search
$params = []; //define default params, add keys as needed and pass to execute
//apply name filter
if (!empty($name)) {
    $query .= " AND name like :name";
    $params[":name"] = "%$name%";
}

if (!empty($cat) && ($cat != "All")) {
    $query .= " AND category = :cat";
    $params[":cat"] = "$cat";
}

if(!empty($id)) {
$query .= " AND id = :id";
$params[":id"] = "$id";
}

//apply column and order sort
if (!empty($col) && !empty($order)) {
    $query .= " ORDER BY $col $order LIMIT 10"; //be sure you trust these values, I validate via the in_array checks above
}

error_log($query);
// list visible products (based on filters, if any)...
$stmt = $db->prepare($query); //dynamically generated query

try {
    $stmt->execute($params); //dynamically populated params to bind
    $r = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($r) {
        $results = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}
?>


<script>
    function add_to_cart(event, item, cost, quantity) {
        console.log("TODO purchase item", item);
        console.log(event);
        let example = 1;
        if (example === 1) {
            let http = new XMLHttpRequest();
            http.onreadystatechange = () => {
                if (http.readyState == 4) {
                    if (http.status === 200) {
                        let data = JSON.parse(http.responseText);
                        console.log("received data", data);
                        flash(data.message, "success");
                    }
                    console.log(http);
                }
            }
            http.open("POST", "api/add_to_cart.php", true);
            let data = {
                item_id: item,
                cost: cost,
                quantity: event.target.parentElement.quantity.value

            }
            let q = Object.keys(data).map(key => key + '=' + data[key]).join('&');
            console.log(q)
            http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            http.send(q);
        } else if (example === 2) {
            let data = new FormData();
            data.append("item_id", item);
            data.append("cost", cost);
            data.append("quantity", 1);
            fetch("api/add_to_cart.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                        "X-Requested-With": "XMLHttpRequest",
                    },
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Success:', data);
                    flash(data.message, "success");
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        } else if (example === 3) {
            $.post("api/add_to_cart.php", {
                    item_id: item,
                    quantity: 1,
                    cost: cost
                }, (resp, status, xhr) => {
                    console.log(resp, status, xhr);
                    let data = JSON.parse(resp);
                    flash(data.message, "success");
                },
                (xhr, status, error) => {
                    console.log(xhr, status, error);
                });
        }
        //TODO create JS helper to update all show-balance elements
    }

</script>

<div class="container-fluid">
    <h1>Shop</h1>
    <form class="row row-cols-6 g-3 align-items-center">
        <div class="col">
            <div class="input-group">
                <div class="input-group-text">Search</div>
                <input class="form-control" name="name" placeholder="Product Name" value="<?php se($name); ?>" />
            </div>
        </div>

        <div class="col">
            <div class="input-group">
                <div class="input-group-text">Sort</div>
                <!-- make sure these match the in_array filter above-->
                <select class="form-control" name="col" value="<?php se($col); ?>">
                    <option value="unit_price">Cost</option>
                </select>
                
                <script>
                    //quick fix to ensure proper value is selected since
                    //value setting only works after the options are defined and php has the value set prior
                    document.forms[0].col.value = "<?php se($col); ?>";
                </script>
                <select class="form-control" name="order" value="<?php se($order); ?>">
                    <option value="asc">Up</option>
                    <option value="desc">Down</option>
                </select>
                <script>
                    //quick fix to ensure proper value is selected since
                    //value setting only works after the options are defined and php has the value set prior
                    document.forms[0].order.value = "<?php se($order); ?>";
                </script>
            </div>
        </div>

        <div class="col">
            <div class="input-group">
                <div class="input-group-text">Category</div>
                <?php $cats = get_categories();?>
                <select class="form-control" name="category">
                    <option value="">All</option>
                    <?php foreach ($cats as $c):?>
                        <option value="<?php se($c, "category");?>"> <?php se($c,"category");?> <!-- what shows in dropdown --> </option>
                    <?php endforeach?>
                </select>
                <script>
                    document.forms[0].category.value = "<?php se($cat); ?>";
                </script>
            </div>
        </div>

        <div class="col">
            <div class="input-group">
                <input type="submit" class="btn btn-primary" value="Search" />
            </div>
        </div>
    </form>
    
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php if(count($results) == 0):?>
            
            <br></br>No results
        <?php endif;?>
        <?php foreach ($results as $item) : ?>
            <div class="col">
                <div class="card bg-light">
                    <div class="card-header">
                    <h5 class="card-title"><?php se($item, "category"); ?></h5>
                    </div>

                    <div class="card-body">
                    <form method="GET">
                        <a href="<?php echo get_url('product.php?id='); se($item, "id"); ?>"><h5 class="card-title"><?php se($item, "name"); ?></h5></a>
                        <p class="card-text"><?php se($item, "description"); ?></p>
                    </form>
                    </div>
                    <div class="card-footer">
                        <form method="POST">
                            <label for="cost" name="cost"></label>Cost: <?php se($item, "unit_price"); ?>
                            <?php if (is_logged_in()) : ?>
                                <br><label for="quantity">Quantity:</label>
                                <input type="number" max="99" id="quantity" name="quantity" value="<?php se($quantity); ?>" style="width:50px"></input><br><br>
                                <button onclick="add_to_cart(event, '<?php se($item, 'id'); ?>', '<?php se($item, 'unit_price'); ?>', 1)" class="btn btn-primary">Add to Cart</button>
                            <!-- three parameters: item, cost, quantity -->
                            <?php endif; ?>
                        </form>
                        <?php if (has_role("Admin") || has_role("Shop Owner")) : ?>
                            <form action="<?php echo get_url('admin/edit_product.php'); ?>" method="POST">
                                <input type="hidden" name="product" value="<?php se($item, 'name'); ?>" />
                                <button class="btn btn-primary">Edit Product</a> 
                            </form>
                            
                            <!-- the class makes it look like a button here -->
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>