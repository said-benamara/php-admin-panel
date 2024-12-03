<?php

$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$name = $_POST['name'];
$phone = $_POST['phone'];
$balance = $_POST['balance'];

$conn->query("INSERT INTO customers (name,balance,phone) VALUES ('$name','$balance','$phone')");

?>

