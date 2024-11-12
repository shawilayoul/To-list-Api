<?php
// public/add_product.php

// Include the necessary files
require '../classes/Database.php';
require '../classes/Product.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database();
    $product = new Product($db->conn);
    
    // Get form data
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Insert the product
    if ($product->create($name, $price)) {
        echo "Product added successfully!";
    } else {
        echo "Error adding product.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        
        form {
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add_product.php" method="POST">
        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" required>
        
        <label for="price">Product Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>
        
        <input type="submit" value="Add Product">
    </form>
</body>
</html>


