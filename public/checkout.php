<?php
// public/checkout.php
require '../classes/Database.php';
require '../classes/Order.php';
require '../classes/Cart.php';

session_start();
$db = new Database();
$order = new Order($db->conn);
$cart = new Cart(); // Assume cart is populated with items

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id']; // Assuming user is logged in
    $productIds = array_keys($cart->getItems());
    if ($order->create($userId, $productIds)) {
        $cart->clear();
        echo "Order placed successfully!";
    } else {
        echo "Error placing order.";
    }
}
?>
