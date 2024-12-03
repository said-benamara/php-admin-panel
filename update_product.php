<?php

// Database credentials
$host = "sql203.infinityfree.com";
$user = "if0_37176330";
$pass = "RBCH5L9ajuC3r";
$dbname = "if0_37176330_pos"; // Replace with your database name

// Create a database connection
$conn = new mysqli($host, $user, $pass, $dbname);
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$tax = $_POST['tax'];
$quantity = $_POST['quantity'];
$conn->query("UPDATE products SET name='$name', price='$price', quantity='$quantity' , tax='$tax',updated_at=sysdate() WHERE id=$id");

?>
