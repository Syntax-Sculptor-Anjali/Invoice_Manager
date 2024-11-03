<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $item = htmlspecialchars($_POST['item']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $price = htmlspecialchars($_POST['price']);
    $total = $quantity * $price;

    // Insert into the database
    $stmt = $pdo->prepare("INSERT INTO invoices (customer_name, item, quantity, price, total) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$customer_name, $item, $quantity, $price, $total]);

    header("Location: index.php");
    exit();
}
?>
