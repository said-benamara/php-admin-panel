<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');
$id = $_POST['id'];
$name = $_POST['name'];
$conn->query("UPDATE categories SET name='$name' WHERE id=$id");
?>
