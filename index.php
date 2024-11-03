<?php
include 'db.php';

// Fetch invoices
$stmt = $pdo->query("SELECT * FROM invoices");
$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Manager</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Invoice Manager</h1>
        <form action="generate_invoice.php" method="post">
            <h2>Create New Invoice</h2>
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" required>

            <label for="item">Item:</label>
            <input type="text" id="item" name="item" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>

            <label for="price">Price:</label>
            <input type="number" step="0.01" id="price" name="price" required>

            <button type="submit">Generate Invoice</button>
        </form>

        <h2>Existing Invoices</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($invoices as $invoice): ?>
            <tr>
                <td><?= $invoice['id'] ?></td>
                <td><?= $invoice['customer_name'] ?></td>
                <td><?= $invoice['item'] ?></td>
                <td><?= $invoice['quantity'] ?></td>
                <td><?= $invoice['price'] ?></td>
                <td><?= $invoice['total'] ?></td>
                <td>
                    <a href="edit_invoice.php?id=<?= $invoice['id'] ?>">Edit</a>
                    <a href="delete_invoice.php?id=<?= $invoice['id'] ?>" onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>
