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
    $user_id = get_user_id();
    error_log("user id is $user_id");
    $item_id = (int)se($_POST, "item_id", 0, false);
    $quantity = (int)se($_POST, "quantity", 0, false);
    $cost = (int)se($_POST, "cost", 0, false);
    $isValid = true;
    $errors = [];
    if ($user_id <= 0) {
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

    function add_item($item_id, $user_id, $quantity = 1)
    {
        error_log("add_item() Item ID: $item_id, User_id: $user_id, Quantity $quantity");
        //I'm using negative values for predefined items so I can't validate >= 0 for item_id
        if (/*$item_id <= 0 ||*/$user_id <= 0 || $quantity === 0) {
            
            return;
        }
        $db = getDB();
        $stmt = $db->prepare("INSERT INTO Cart (item_id, user_id, quantity) VALUES (:item_id, :user_id, :quantity) ON DUPLICATE KEY UPDATE quantity = quantity + :quantity");
        try {
            //if using bindValue, all must be bind value, can't split between this an execute assoc array
            $stmt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
            $stmt->bindValue(":item_id", $item_id, PDO::PARAM_INT);
            $stmt->bindValue(":user_id", $user_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error adding $quantity of $item_id to user $user_id: " . var_export($e->errorInfo, true));
        }
        return false;
    }

    if($isValid){
        //get true price from DB, don't trust the client
        $db = getDB();
        $stmt = $db->prepare("SELECT name,cost FROM Products where id = :id");
        $name = "";
        try {
            $stmt->execute([":id" => $item_id]);
            $r = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($r) {
                $cost = (int)se($r, "cost", 0, false);
                $name = se($r, "name", "", false);
            }
        } catch (PDOException $e) {
            error_log("Error getting cost of $item_id: " . var_export($e->errorInfo, true));
            $isValid = false;
        }
    }
    if ($isValid) 

    {
    
            add_item($item_id, $user_id, $quantity);
            http_response_code(200);
            $response["message"] = "Added $quantity of $name to cart";
            //success

    }
    $response["message"] = join("<br>", $errors);

}
echo json_encode($response);