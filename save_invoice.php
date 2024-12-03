<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$customerName = $_POST['customerName'];
$customerEmail = $_POST['customerEmail'];
$totalAmount = $_POST['totalAmount'];
$invoiceItems = json_decode($_POST['invoiceItems'], true);

mysqli_begin_transaction($conn);

try {

 // Check if customer exists
    $stmtCheckCustomer = $conn->prepare("SELECT id FROM customers WHERE phone = ?");
    $stmtCheckCustomer->bind_param("s", $customerEmail);
    $stmtCheckCustomer->execute();
    $stmtCheckCustomer->store_result();

    if ($stmtCheckCustomer->num_rows == 0) {
        // If customer doesn't exist, insert new customer
        $stmtInsertCustomer = $conn->prepare("INSERT INTO customers (name, phone, balance) VALUES (?, ?, ?)");
        $balance = 0;  // Default balance
        $stmtInsertCustomer->bind_param("ssd", $customerName, $customerEmail, $balance);
        $stmtInsertCustomer->execute();
        $customerId = $stmtInsertCustomer->insert_id; // Get the new customer ID
    } else {
        // If customer exists, get the customer ID
        $stmtCheckCustomer->bind_result($customerId);
        $stmtCheckCustomer->fetch();
    }


    // Insert Invoice
    $stmt = $conn->prepare("INSERT INTO invoices (customer_name, customer_phone, total_amount) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $customerName, $customerEmail, $totalAmount);
    $stmt->execute();
    $invoiceId = $stmt->insert_id;

    // Deduct from the Customer's Balance
    $stmtCustomer = $conn->prepare("UPDATE customers SET balance = balance - ? WHERE phone = ?");
    $stmtCustomer->bind_param("ds", $totalAmount, $customerEmail);
    $stmtCustomer->execute();

    // Insert Invoice Items and Update Product Quantities
    $stmtItem = $conn->prepare("INSERT INTO invoice_items (invoice_id, product_name, quantity, price, tax, total) VALUES (?, ?, ?, ?, ?, ?)");
    $stmtProduct = $conn->prepare("UPDATE products SET quantity = quantity - ? WHERE name = ?");
    
    foreach ($invoiceItems as $item) {
        // Insert each item into the invoice_items table
        $stmtItem->bind_param(
            "isiddd",
            $invoiceId,
            $item['product_name'],
            $item['quantity'],
            $item['price'],
            $item['tax'],
            $item['total']
        );
        $stmtItem->execute();

        // Update product quantity in the products table
        $stmtProduct->bind_param("is", $item['quantity'], $item['product_name']);
        $stmtProduct->execute();
    }

    mysqli_commit($conn);
    echo "Invoice saved successfully!";
} catch (Exception $e) {
    mysqli_roll_back($conn);
    echo "Failed to save invoice: " . $e->getMessage();
}
?>