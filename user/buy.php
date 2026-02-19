<?php
include("../config/database.php");
include("../includes/auth_check.php");

$event_id=$_GET['event_id'];

if(isset($_POST['buy'])){

    $ticket_id=$_POST['ticket_type_id'];
    $quantity=$_POST['quantity'];

    $ticket=$conn->query("SELECT * FROM ticket_types WHERE id=$ticket_id")->fetch_assoc();

    if($ticket['quantity_available'] < $quantity){
        die("Not enough tickets!");
    }

    $total=$ticket['price']*$quantity;

    $conn->query("INSERT INTO orders (user_id,event_id,total_amount) 
                  VALUES ('".$_SESSION['user_id']."','$event_id','$total')");

    $order_id=$conn->insert_id;

    $code=uniqid("TICKET_");

    $conn->query("INSERT INTO order_items (order_id,ticket_type_id,quantity,price,ticket_code)
                  VALUES ('$order_id','$ticket_id','$quantity','".$ticket['price']."','$code')");

    $conn->query("UPDATE ticket_types 
                  SET quantity_available=quantity_available-$quantity
                  WHERE id=$ticket_id");

    echo "Ticket Purchased! Code: ".$code;
}
?>

<h2>Buy Ticket</h2>
<form method="POST">
Ticket Type ID:<input name="ticket_type_id"><br>
Quantity:<input name="quantity"><br>
<button name="buy">Buy</button>
</form>
