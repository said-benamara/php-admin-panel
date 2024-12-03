<?php
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');
$result = $conn->query("SELECT * FROM categories");
while ($row = $result->fetch_assoc()) {
  echo "<tr>
          <td>{$row['name']}</td>
          <td>
            <button onclick='editCategory({$row['id']})' class='btn btn-primary btn-sm'>Edit</button>
            <button onclick='deleteCategory({$row['id']})' class='btn btn-danger btn-sm'>Delete</button>
          </td>
        </tr>";
}
?>
