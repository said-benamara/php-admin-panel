<?php


$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get total amount of today's invoices
$sql_today_invoices = "SELECT SUM(total_amount) AS total_today FROM invoices WHERE DATE(created_at) = CURDATE()";
$result_today_invoices = $conn->query($sql_today_invoices);
$total_today = 0;
if ($result_today_invoices->num_rows > 0) {
    while($row = $result_today_invoices->fetch_assoc()) {
        $total_today = $row['total_today'];
    }
}

// Get total amount of today's invoices
$sql_today_invoices1 = "SELECT count(*) AS total_invoices FROM invoices WHERE DATE(created_at) = CURDATE()";
$result_today_invoices1 = $conn->query($sql_today_invoices1);
$total_invoices = 0;
if ($result_today_invoices1->num_rows > 0) {
    while($row = $result_today_invoices1->fetch_assoc()) {
        $total_invoices = $row['total_invoices'];
    }
}

// Get total amount of today's invoices
$sql_today_customer = "SELECT count(*) AS custcount FROM customers WHERE DATE(updated_at) = CURDATE()";
$result_today_customer = $conn->query($sql_today_customer);
$total_customers = 0;
if ($result_today_customer->num_rows > 0) {
    while($row = $result_today_customer->fetch_assoc()) {
        $total_customers = $row['custcount'];
    }
}

// Get total quantity of products
$sql_total_products = "SELECT SUM(quantity) AS total_quantity FROM products";
$result_total_products = $conn->query($sql_total_products);
$total_quantity = 0;
if ($result_total_products->num_rows > 0) {
    while($row = $result_total_products->fetch_assoc()) {
        $total_quantity = $row['total_quantity'];
    }
}

$conn->close();

// Return the data as JSON
echo json_encode([
    'total_today' => $total_today,
    'total_quantity' => $total_quantity, 
    'total_invoices' => $total_invoices,
    'total_customers' => $total_customers
]);
?>
