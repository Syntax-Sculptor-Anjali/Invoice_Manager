<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update invoice
    $id = $_POST['id'];
    $customer_name = htmlspecialchars($_POST['customer_name']);
    $item = htmlspecialchars($_POST['item']);
    $quantity = htmlspecialchars($_POST['quantity']);
    $price = htmlspecialchars($_POST['price']);
    $total = $quantity * $price;

    $stmt = $pdo->prepare("UPDATE invoices SET customer_name = ?, item = ?, quantity = ?, price = ?, total = ? WHERE id = ?");
    $stmt->execute([$customer_name, $item, $quantity, $price, $total, $id]);

    header("Location: index.php");
    exit();
} elseif (isset($_GET['id'])) {
    // Fetch the invoice data for editing
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM invoices WHERE id = ?");
    $stmt->execute([$id]);
    $invoice = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Invoice</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Invoice</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $invoice['id'] ?>">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" value="<?= $invoice['customer_name'] ?>" required>

            <label for="item">Item:</label>
            <input type="text" id="item" name="item" value="<?= $invoice['item'] ?>" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?= $invoice['quantity'] ?>" required>

            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" value="<?= $invoice['price'] ?>" required>

            <button type="submit">Update Invoice</button>
        </form>
    </div>
</body>
</html>
