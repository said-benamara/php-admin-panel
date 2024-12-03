<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$invoiceId = $_GET['id'];
$query = "SELECT product_name, quantity, price, tax, total FROM invoice_items WHERE invoice_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $invoiceId);
$stmt->execute();
$result = $stmt->get_result();

$invoiceDetails = array();
while ($row = $result->fetch_assoc()) {
    $invoiceDetails[] = $row;
}

echo json_encode($invoiceDetails);
?>
