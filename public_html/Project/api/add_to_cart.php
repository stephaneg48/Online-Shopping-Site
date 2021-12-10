<?php



//remember, API endpoints should only echo/output precisely what you want returned
//any other unexpected characters can break the handling of the response
$response = ["message" => "There was a problem completing your purchase"];
http_response_code(400);
error_log("req: " . var_export($_POST, true));
if (isset($_POST["item_id"]) && isset($_POST["quantity"]) && isset($_POST["cost"])) 
{
    require_once(__DIR__ . "/../../../lib/functions.php");
    session_start();
    $uid = get_user_id();
    error_log("user id is $uid");
    $item_id = (int)se($_POST, "item_id", 0, false);
    error_log("item id is $item_id");
    $quantity = (int)se($_POST, "quantity", 0, false);
    error_log("quantity is $quantity");
    $cost = (int)se($_POST, "cost", 0, false);
    error_log("cost is $cost");
    $isValid = true;
    //from ajax send update=true if it's an update, otherwise ignore sending
    //update would just be from cart page most likely so shop should remain as-is
    $isUpdate = !!se($_POST,"update", false, false);
    $errors = [];
    if ($uid <= 0) {
        array_push($errors, "Invalid user");
        $isValid = false;
    }
    if ($cost <= 0) {
        array_push($errors, "Invalid cost");
        $isValid = false;
    }
    if ($quantity < 0) {
        //invalid quantity
        array_push($errors, "Invalid quantity");
        $isValid = false;
    }

    function add_item($name, $item_id, $cost, $uid, $quantity,$isUpdate)
    {
        error_log("add_item() Item name: $name Item ID: $item_id, User_id: $uid Cost: $cost Quantity $quantity");
        if (/*$item_id <= 0 ||*/$uid <= 0 || ($quantity === 0 && !$isUpdate) || $cost === 0) {
            
            return;
        }
        // continue here
        $db = getDB();
        if($isUpdate){ // for cart page only
            $stmt = $db->prepare("INSERT INTO Cart (unit_price, product_id, user_id, desired_quantity) 
            VALUES (:unit_price, :product_id, :user_id, :desired_quantity) ON DUPLICATE KEY UPDATE desired_quantity = :desired_quantity");
        }
        elseif($isUpdate && ($quantity === 0)){ // for cart page only when the user wants to remove
            $stmt = $db->prepare("DELETE FROM Cart where product_id = :item_id AND user_id = :uid");
        }
        else{ // for shop page only - only allowing user to add to cart from here, meaning that it should append to what they already have
            $stmt = $db->prepare("INSERT INTO Cart (unit_price, product_id, user_id, desired_quantity) 
            VALUES (:unit_price, :product_id, :user_id, :desired_quantity) ON DUPLICATE KEY UPDATE desired_quantity = desired_quantity + :desired_quantity");
        }
        
        try {
            //if using bindValue, all must be bind value, can't split between this an execute assoc array
            //$stmt->bindValue(":name", $name, PDO::PARAM_STR);
            $stmt->bindValue(":unit_price", $cost, PDO::PARAM_INT);
            $stmt->bindValue(":product_id", $item_id, PDO::PARAM_INT);
            $stmt->bindValue(":user_id", $uid, PDO::PARAM_INT);
            $stmt->bindValue(":desired_quantity", $quantity, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error adding $quantity of product $item_id ($name) to user $uid: " . var_export($e->errorInfo, true));
        }
        return false;
    }

    if($isValid){
        //get true price from DB, don't trust the client
        $db = getDB();
        $stmt = $db->prepare("SELECT name, unit_price, id FROM Products where id = :id");
        $name = "";
        try {
            $stmt->execute([":id" => $item_id]);
            error_log("just finished grabbing product's info from Products table");
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($r) {
                $cost = (int)se($r, "unit_price", "", false);
                error_log("cost here is $cost");
                $name = se($r, "name", "", false);
                error_log("name here is $name");
            }
        } catch (PDOException $e) {
            error_log("Error getting cost of $item_id: " . var_export($e->errorInfo, true));
            $isValid = false;
        }
    }

    error_log("about to add to Cart");
    if ($isValid) 

    {
            add_item($name, $item_id, $cost, $uid, $quantity, $isUpdate);
            error_log("added to cart");
            http_response_code(200);
            $response["message"] = "Added $quantity of $name to cart";
    }
    error_log("outside of isValid");
    //success
    echo json_encode($response);
}

?>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>
