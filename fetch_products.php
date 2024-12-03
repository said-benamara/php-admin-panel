<?php
// Database connection
$conn = new mysqli('sql203.infinityfree.com', 'if0_37176330', 'RBCH5L9ajuC3r', 'if0_37176330_pos');

// Fetch products
$sql = "SELECT p.id,p.name,price,quantity,tax,c.name category FROM products p , categories c 
where p.category_id=c.id order by p.updated_at desc ";
$result = $conn->query($sql);
$products = [];


while ($product = $result->fetch_assoc()) {
  echo "<tr>
          <td>{$product['name']}</td>
          <td>{$product['price']} TND</td>
            <td>{$product['quantity']}</td>
              <td>{$product['tax']}%</td>
          <td>{$product['category']}</td>
          <td>
            <button class='btn btn-primary' onclick='editProduct({$product['id']})' data-bs-toggle='modal' data-bs-target='#editProductModal'  >Edit</button>
            <button class='btn btn-danger' onclick='deleteProduct({$product['id']})'>Delete</button>
          </td>
        </tr>";
}

echo json_encode($products);
$conn->close();
?>
