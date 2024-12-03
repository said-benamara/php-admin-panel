<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$query = "SELECT id, customer_name, customer_phone, total_amount, created_at date_created FROM invoices ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$invoices = array();
while ($row = mysqli_fetch_assoc($result)) {
    $invoices[] = $row;
}

echo json_encode($invoices);
?>
