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

    $product_id = $decoded_data['product_id']; // 0 = item id, 1 = item quantity, 2 = item unit price
    $newRating = (int)$decoded_data['newRating'];
    $newComment = $decoded_data['newComment'];
    
    $db = getDB();

    $user_ids = [];
    // make entry into Ratings table

    // prevent a user from making more than one review for an item...

    $stmt = $db->prepare("SELECT DISTINCT user_id FROM Ratings WHERE product_id=:product_id");
    $stmt->execute([":product_id" => $product_id]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));

    while ($r = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $user_ids[] = $r['user_id'];
    }
    //var_dump($user_ids);

    if (in_array($uid, $user_ids)) // update, because the user has already made a review...
    {
        $stmt = $db->prepare("UPDATE Ratings SET rating=:rating, comment=:comment WHERE product_id=:product_id AND user_id=:user_id");
        //echo "about to update the user's rating\n";
        $stmt->execute([":rating" => $newRating, ":comment" => $newComment, ":product_id" => $product_id, ":user_id" => $uid]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
        //echo "just updated\n";
    }
    else // safe to insert
    {
        $stmt = $db->prepare("INSERT INTO Ratings (product_id, user_id, rating, comment)
        VALUES (:product_id, :user_id, :rating, :comment)");

        //echo "about to insert the rating\n";
        $stmt->execute([":product_id" => $product_id, ":user_id" => $uid, ":rating" => $newRating, ":comment" => $newComment]) or die("there was a problem with the given data: " . var_export($e->errorInfo, true));
        //echo "just inserted\n";
    }
   

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