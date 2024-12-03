<?php
// Database connection
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get invoice ID from GET parameter
$invoiceId = isset($_GET['invoice_id']) ? $_GET['invoice_id'] : 0;

// Fetch invoice and customer details
$sql = "SELECT invoices.*, customers.name customer_name, customers.phone customer_phone
        FROM invoices 
        INNER JOIN customers ON invoices.customer_phone = customers.phone
        WHERE invoices.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $invoiceId);
$stmt->execute();
$result = $stmt->get_result();

// Check if invoice exists
if ($result->num_rows > 0) {
    $invoice = $result->fetch_assoc();
    
    // Fetch invoice items
    $sqlItems = "SELECT * FROM invoice_items WHERE invoice_id = ?";
    $stmtItems = $conn->prepare($sqlItems);
    $stmtItems->bind_param("i", $invoiceId);
    $stmtItems->execute();
    $resultItems = $stmtItems->get_result();
} else {
    echo "Invoice not found.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #<?php echo $invoiceId; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice-table th, .invoice-table td {
            text-align: center;
            padding: 10px;
        }
        .invoice-header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
     <div class="invoice-container" style="display: flex; justify-content: space-between; align-items: flex-start; margin: 20px;">
    <!-- Left Side (Invoice Details) -->
    <div class="invoice-left" style="flex: 1; margin-right: 20px;">
        <div class="invoice-header">
            <h2>Invoice #<?php echo $invoiceId; ?></h2>
            <p><strong>Customer Name:</strong> <?php echo $invoice['customer_name']; ?></p>
            <p><strong>Phone:</strong> <?php echo $invoice['customer_phone']; ?></p>
            <p><strong>Date:</strong> <?php echo date("F j, Y, g:i a", strtotime($invoice['created_at'])); ?></p>
        </div>
    </div>

    <!-- Right Side (Total Amount) -->
    <div class="invoice-right" style="flex: 0 0 300px;">
        <div class="total-amount-cadre" style="border: 3px solid #007bff; padding: 20px; text-align: center; background-color: #f8f9fa;">
            <h1><strong>Total Amount:</strong></h1>
            <h1 style="color: #007bff;">TND <?php echo number_format($invoice['total_amount'], 2); ?></h1>
        </div>
    </div>
</div>

        <h4>Invoice Items</h4>
        <table class="table table-bordered invoice-table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($item = $resultItems->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>TND <?php echo number_format($item['price'], 2); ?></td>
                    <td>TND <?php echo number_format($item['total'], 2); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Print Button -->
        <button class="btn btn-primary" onclick="window.print();">Print Invoice</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
