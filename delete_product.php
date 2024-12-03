<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$id = $_POST['id'];
$sql = "DELETE FROM products WHERE id = $id";

if ($conn->query($sql) === TRUE) {
  echo "Product deleted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
