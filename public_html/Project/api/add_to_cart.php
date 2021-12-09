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
    $errors = [];
    if ($uid <= 0) {
        //invald user
        array_push($errors, "Invalid user");
        $isValid = false;
    }
    if ($cost <= 0) {
        array_push($errors, "Invalid cost");
        $isValid = false;
    }
    //I'll have predefined items loaded in at negative values
    //so I don't need/want this check
    /*if ($item_id <= 0) {
        //invalid item
        array_push($errors, "Invalid item");
        $isValid = false;
    }*/
    if ($quantity <= 0) {
        //invalid quantity
        array_push($errors, "Invalid quantity");
        $isValid = false;
    }

    function add_item($name, $item_id, $cost, $uid, $quantity)
    {
        error_log("add_item() Item name: $name Item ID: $item_id, User_id: $uid Cost: $cost Quantity $quantity");
        if (/*$item_id <= 0 ||*/$uid <= 0 || $quantity === 0 || $cost === 0) {
            
            return;
        }
        // continue here
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Cart (name, unit_price, product_id, user_id, desired_quantity) VALUES (:name, :unit_price, :product_id, :user_id, :desired_quantity) ON DUPLICATE KEY UPDATE desired_quantity = desired_quantity + :desired_quantity");
        try {
            //if using bindValue, all must be bind value, can't split between this an execute assoc array
            $stmt->bindValue(":name", $name, PDO::PARAM_STR);
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
    if ($isValid) 

    {
            add_item($name, $item_id, $cost, $uid, $quantity);
            http_response_code(200);
    }
    $response["message"] = "Added $quantity of $name to cart";
    //success

}
echo json_encode($response);
?>

<?php
//note we need to go up 1 more directory
require_once(__DIR__ . "/../../../partials/flash.php");
?>
