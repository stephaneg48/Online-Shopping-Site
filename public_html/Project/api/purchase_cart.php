<?php

//remember, API endpoints should only echo/output precisely what you want returned
//any other unexpected characters can break the handling of the response
$response = ["OK" => false]; // default
if (isset($_POST["json"])) 
{
    require_once(__DIR__ . "/../../../lib/functions.php");
    session_start();

    $data = array();

    $incoming_data = $_POST["json"];

    $decoded_data = json_decode($incoming_data, true);

    //var_dump($decoded_data);
    $uid = get_user_id();
    //echo "\nuser id is $uid\n";

    $items = $decoded_data['products']; // 0 = item id, 1 = item quantity, 2 = item unit price
    $total_price = $decoded_data['total'];
    $address = $decoded_data['address'];
    $payment_method = $decoded_data['method'];
    
    $db = getDB();

    // make entry into Orders table
    //$stmt = $db->prepare("INSERT INTO Orders (user_id, total_price, address, payment_method) VALUES (:user_id, :total_price, :address, :payment_method");

    $stmt = $db->prepare("INSERT INTO Orders (user_id, total_price, address, payment_method) 
    VALUES (:user_id, :total_price, :address, :payment_method)");

    //echo "about to insert the order\n";
    $stmt->execute([":user_id" => $uid, ":total_price" => $total_price, ":address" => $address, ":payment_method" => $payment_method]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
    //echo "just inserted\n";

    // TODO get last order ID from Orders table

    $stmt = $db->prepare("SELECT id FROM Orders 
    WHERE user_id = :user_id AND total_price = :total_price AND address = :address AND payment_method = :payment_method AND created = (SELECT MAX(created) FROM Orders)");

    //echo "about to get the newly inserted order ID\n";
    $stmt->execute([":user_id" => $uid, ":total_price" => $total_price, ":address" => $address, ":payment_method" => $payment_method]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));

    $result = [];

    $r = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($r) {
        $result = $r;
    }

    //echo "just got the newly inserted order ID\n";
    $order_id = $result['id'];

    // copy the cart details into the OrderItems tables with the Order ID

    foreach($items as $item)
    {
        $item_id = $item[0];
        $item_quantity = $item[1];
        $item_unit_price = $item[2];

        $stmt = $db->prepare("INSERT INTO OrderItems (order_id, product_id, quantity, unit_price) 
        VALUES (:order_id, :product_id, :quantity, :unit_price)");

        //echo "inserting an ordered product into OrderItems\n";
        $stmt->execute([":order_id" => $order_id, ":product_id" => $item_id, ":quantity" => $item_quantity, ":unit_price" => $item_unit_price]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
        //echo "inserted the product\n";

        // Update the Products table stock for each item to deduct the Ordered Quantity

        $stmt = $db->prepare("UPDATE Products SET stock = stock - :stock WHERE id = :id");

        //echo "going to update products table for product $item_id\n";
        $stmt->execute([":stock" => $item_quantity, ":id" => $item_id]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
        //echo "updated the product\n";
    }

    // Clear out the user’s cart after successful order
    $stmt = $db->prepare("DELETE FROM Cart where user_id = :uid");
    $stmt->execute([":uid" => $uid]);

    http_response_code(200);
    $response['OK'] = true;
    //success
    echo json_encode($response);
    
}
else
{
    http_response_code(400);
    echo json_encode($response);
}

?>