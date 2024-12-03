<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');
$name = $_POST['name'];
$conn->query("INSERT INTO categories (name) VALUES ('$name')");
?>
