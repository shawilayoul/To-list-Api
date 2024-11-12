// public/index.php
<?php
// public/index.php
require '../classes/Database.php';
require '../classes/Product.php';

$db = new Database();
$product = new Product($db->conn);
$products = $product->read();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .product-card {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
        }

        .product-card h2 {
            font-size: 1.5em;
            margin: 10px 0;
            color: #333;
        }

        .product-card p {
            font-size: 1.2em;
            color: #666;
        }

        .product-card .price {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>
    <h1>Product List</h1>
    <div class="product-grid">
        <?php if (empty($products)): ?>
            <p>No products found.</p>
        <?php else: ?>
            <?php foreach ($products as $prod): ?>
                <div class="product-card">
                    <h2><?php echo htmlspecialchars($prod['name']); ?></h2>
                    <p class="price">$<?php echo number_format($prod['price'], 2); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>

