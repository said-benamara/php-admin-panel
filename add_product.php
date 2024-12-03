<?php
// Database credentials
$servername = "sql203.infinityfree.com";
$username = "if0_37176330";
$password = "RBCH5L9ajuC3r";
$dbname = "if0_37176330_pos"; // Replace with your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

$name = $_POST['name'];
$price = $_POST['price'];
$category = $_POST['category'];
$tax = $_POST['tax'];
$qty = $_POST['qty'];
$conn->query("INSERT INTO products (name, price, category_id,tax, quantity) VALUES ('$name', '$price', '$category','$tax','$qty')");

/*
// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the POST data
$productName = $_POST['productName'];
$category = $_POST['category'];
$prix = $_POST['prix'];
$tax = $_POST['tax'];
$description = $_POST['description'];

// Prepare the SQL query to insert the data into the products table
$sql = "INSERT INTO products (product_name, category, prix, tax, description) 
        VALUES ('$productName', '$category', '$prix', '$tax', '$description')";

// Execute the query and check if it was successful
if ($conn->query($sql) === TRUE) {
    echo "Product added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();*/
?>
