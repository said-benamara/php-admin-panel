<?php

$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$id = $_POST['id'];

$name = $_POST['name'];
$phone = $_POST['phone'];
$balance = $_POST['balance'];

$conn->query("UPDATE customers SET name='$name',phone='$phone',balance='$balance' , updated_at=sysdate() WHERE id=$id");

?>

