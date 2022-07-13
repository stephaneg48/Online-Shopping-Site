<?php
require(__DIR__ . "/../../partials/nav.php");
?>

<?php

$db = getDB();
$query = "SELECT id, category, name, description, stock, unit_price FROM Products WHERE 1=1 AND visibility = 1";
$name = se($_GET, "name", "", false);
$desc = se($_GET, "description", "", false);
$cat = se($_GET, "category", "", false);
$stock = se($_GET, "stock", "", false);
$cost = se($_GET, "unit_price", "", false);
$id = se($_GET, "id", "", false);
if(isset($_POST["id"]))
{
    $id = se($_GET, "id", $_POST["id"], false);
}
$quantity = se($_GET, "quantity", "", false);

$uid = get_user_id();

// dynamic query for search
$params = []; //define default params, add keys as needed and pass to execute
//apply name filter

if(!empty($id)) {
$query .= " AND id = :id";
$params[":id"] = "$id";
}

$stmt = $db->prepare($query); //dynamically generated query

try {
    $stmt->execute($params); //dynamically populated params to bind
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $result = $r;
    }
} catch (PDOException $e) {
    flash("<pre>" . var_export($e, true) . "</pre>");
}

$product_id = $_GET['id'];

$user_ids = [];
$usernames = [];
$ratings = [];
$comments = [];
// get the user ids from Ratings first, then get the usernames, then get the info after... doing it in one query won't work
// counts should be the same?

$stmt = $db->prepare("SELECT DISTINCT user_id FROM Ratings R WHERE R.product_id=:product_id");

$stmt->execute([":product_id" => $product_id]);

while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $user_ids[] = $r['user_id'];
}

foreach($user_ids as $user_id)
{
    $stmt = $db->prepare("SELECT username FROM Users WHERE id=:id");
    $stmt->execute([":id" => $user_id]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $usernames[] = $r['username'];
    }

    $stmt = $db->prepare("SELECT rating, comment FROM Ratings WHERE product_id=:product_id AND user_id=:user_id");
    $stmt->execute([":product_id" => $product_id, ":user_id" => $user_id]);
    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $ratings[] = $r['rating'];
        $comments[] = $r['comment'];
    }
}

$average_rating = "N/A";

$stmt = $db->prepare("SELECT AVG(rating) AS average_rating FROM Ratings R, Users U 
WHERE R.product_id=:product_id AND U.id IN (SELECT DISTINCT user_id FROM Ratings R WHERE R.product_id=:product_id)");

$stmt->execute([":product_id" => $product_id]);

$r = $stmt->fetch(PDO::FETCH_ASSOC);
if ($r && $r['average_rating'] != null) {
    $average_rating = round($r['average_rating'],2);
}

$order_ids = [];
$ids_of_buyers = [];
// if a user hasn't purchased the item, don't let them leave a review for it
// assume they have...
$has_purchased = "true";

// get all the order ids that have that product listed
$stmt = $db->prepare("SELECT id FROM Orders WHERE id IN (SELECT order_id FROM OrderItems WHERE product_id=:product_id)");

$stmt->execute([":product_id" => $product_id]);

while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
{
    $order_ids[] = $r['id'];
}

// get all the user ids from those order ids in Orders
foreach($order_ids as $order_id)
{
    $stmt = $db->prepare("SELECT user_id FROM Orders WHERE id=:id");

    $stmt->execute([":id" => $order_id]);

    while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $ids_of_buyers[] = $r['user_id'];
    }
}

// check if the current user id is in the list of people who purchased
// if not, prevent the user from making a review
if(!in_array($uid,$ids_of_buyers))
    $has_purchased = "false";
    


?>

<script>
    function add_to_cart(event, name, item, cost, quantity) {
        event.preventDefault();
        console.log("TODO purchase item", item);
        console.log(event);
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
            prodname: name,
            item_id: item,
            cost: cost,
            quantity: event.target.parentElement.quantity.value
        }
        let q = Object.keys(data).map(key => key + '=' + data[key]).join('&');
        console.log(q)
        http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        http.send(q);
        //TODO create JS helper to update all show-balance elements
    }

    function addRating(event, product, uid, is_valid)
    {
        event.preventDefault();
        // user can just rate, but comments are optional
        var comment = "";
        if (document.getElementById("comment").value != "")
        {
            comment = document.getElementById("comment").value;
        }
        else
        {
            comment = "N/A";
        }
        var rating = 0;
        
        if (document.querySelector('input[name="rating"]:checked') != null) // null here is really false...
        {
            rating = document.querySelector('input[name="rating"]:checked').value;
            if (uid === undefined) // no anonymous comments
            {
                flash("You must be logged in to leave a review","warning");
            }
            // else... if user id is defined, then the user must have actually purchased the item... pass this info here
            else if (is_valid === false) // don't know why the type had issues but this works
            {
                flash("You cannot leave a review for an item you have not purchased!","warning");
            }
            else // safe to submit
            {
                let data = {
                userid: uid,
                product_id: product,
                newRating: rating,
                newComment: comment,
                valid: is_valid
                }
                console.log(data);
                let http = new XMLHttpRequest();
                http.open("POST", "api/make_comment.php", true);
                http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                http.onreadystatechange = function() {
                    if (http.readyState == 4) {
                        if (http.status === 200) {
                            console.log(http.responseText);
                            flash("Thank you for leaving a review!","success");
                        }
                    }
                    
                }
            http.send("json=" + encodeURIComponent(JSON.stringify(data))); 
            }
        }
        else
        {
            window.alert("To submit a rating or comment, please choose how you would rate this product out of five points.");
        }
    }
</script>

<div class="container-fluid">
    <div class="row row-cols-1 row-cols-md-5 g-4">
        <div class="col">
            <div class="card bg-light">
                <?php for ($i = 0; $i < count($result); $i++) : ?>   

                    <?php if ($i = 1): ?>
                        <div class="card-header">
                            <h5 class="card-title"><?php se($result, "category"); ?></h5>
                        </div>
                    <?php endif;?>

                    <?php if ($i = 2): ?>
                        <div class="card-body">
                            <h5 class="card-title"><?php se($result, "name"); ?></h5>
                        </div>
                    <?php endif;?>

                    <?php if ($i = 3): ?>
                        <p class="card-text"><?php se($result, "description"); ?></p>
                    <?php endif;?>

                    <?php if ($i = 4): ?>
                        <div class="card-footer">
                        Cost: <?php se($result, "unit_price"); ?>
                        </div>
                    <?php endif;?>

                    <?php if ($i = 5): ?>
                        <div class="card-footer">
                        Stock: <?php se($result, "stock"); ?>
                        </div>
                    <?php endif;?>

                <?php endfor; ?>
                
                        <form>
                        Average User Rating: <?php echo $average_rating; ?> 
                        <?php if (is_logged_in()) : ?>
                                <br><label for="quantity">Quantity:</label>
                                <input type="number" max="99" id="quantity" name="quantity" value="<?php se($quantity); ?>" style="width:50px"></input><br><br>
                                <button onclick="add_to_cart(event, '<?php se($result, 'name'); ?>', '<?php se($result, 'id'); ?>', '<?php se($result, 'unit_price'); ?>', 1)" class="btn btn-primary">Add to Cart</button>
                            <!-- four parameters: name, item id, cost, quantity -->
                        <?php endif; ?>
                        </form>

                        <!-- add rating element here (table?) -->
                        <?php if (has_role("Admin") || has_role("Shop Owner")) : ?>
                            <form action="<?php echo get_url('admin/edit_product.php'); ?>" method="POST">
                                <input type="hidden" name="product" value="<?php se($result, 'name'); ?>" />
                                <button class="btn btn-primary">Edit Product</a> 
                            </form>
                            
                            <!-- the class makes it look like a button here -->
                        <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<br>

<label for="comment"></label>
<textarea placeholder="Leave a comment" id="comment" rows="4" cols="50"></textarea>

<br>
Rating: 
<br>
<table id="ratingSelect" class="table table-striped table-hover table-bordered border-dark" style="width:fit-content">
    <tbody>
            <tr>
                <input type="radio" name="rating" value=1>1</input>
                <input type="radio" name="rating" value=2>2</input>
                <input type="radio" name="rating" value=3>3</input>
                <input type="radio" name="rating" value=4>4</input>
                <input type="radio" name="rating" value=5>5</input>
            </tr>
    </tbody>
</table>

<button type="button" onclick="addRating(event, <?php $product_id = $_GET['id']; echo $product_id; ?>, <?php echo get_user_id();?>, <?php echo $has_purchased; ?>)" class="btn btn-primary">Submit</button> 

<br></br>

<h2><u>Comments</u></h2>

<table style="width:40%" id="userRatings" class="table table-striped table-hover border-dark">
    <tbody>
        <?php if (empty($usernames)) : echo "No reviews found. Be the first to leave a rating!"; ?>

        <?php else : ?>
            <thead>
                <th style="width:1%">User</th>
                <th style="width:1%">Comments</th>
                <th style="width:1%">Rating</th>
            </thead>
            
            <?php for ($i = 0; $i < count($usernames); $i++) : ?>
                <tr>
                    <td style="width:fit-content"><?php echo $usernames[$i]; ?></td>
                    <td style="width:1%"><?php echo $comments[$i]; ?></td>
                    <td style="width:1%"><?php echo "$ratings[$i]/5"; ?></td>
                    <input hidden id="" value=<?php ?> ></input>
                </tr>
            <?php endfor; ?>
        <?php endif; ?>
    </tbody>
</table>

<?php
require(__DIR__."/../../partials/flash.php");
?>