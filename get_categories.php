<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

$result = $conn->query("SELECT * FROM categories ");

while ($row = $result->fetch_assoc()) {
  echo "<option value='{$row['id']}'>{$row['name']}</option>";
        
}

?>
