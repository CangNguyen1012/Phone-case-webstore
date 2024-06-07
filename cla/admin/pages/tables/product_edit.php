<?php
require_once("../../../Connection/connection.php");
?>

<?php
try {
$sql = "select * from category";
$stmt_category = $conn->query($sql);
$row_category = $stmt_category->fetchAll();

}catch(PDOException $ex){
    echo"Error: " . $ex->getMessage();
}

try{
$sql = "select * from product where productID = ?";
$stmt_edit = $conn->prepare($sql);
$stmt_edit->bindParam(1, $_GET['id']);
$stmt_edit->execute();
$row_edit = $stmt_edit->fetch();
}catch(PDOException $ex) {
    echo 'Error: ' . $ex->getMessage();
}

if(isset($_POST['edit'])) {
    try {
$sql = "update product
        set name = ?, price = ?, image = ?, detail = ?, categoryID = ?
        where productID = ?";
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $_POST['name']);
$stmt->bindParam(2, $_POST['price']);
$stmt->bindParam(3, $_POST['image']);
$stmt->bindParam(4, $_POST['detail']);
$stmt->bindParam(5, $_POST['category']);
$stmt->bindParam(6, $_POST['productID']);
$stmt->execute();
header('Location: basic-table.php');
    }catch(PDOException $ex){
        echo"Error: " . $ex->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Edit Product</h2>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="mb-3 mt-3">
      <label for="productID">Product ID:</label>
      <input type="text" class="form-control" id="productID" name="productID" value="<?=$row_edit['productID']?>" >
    </div>
    
    <div class="mb-3">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" name="name" value="<?=$row_edit['name']?>">
    </div>

    <div class="mb-3">
      <label for="price">Price:</label>
      <input type="number" class="form-control" id="price" name="price" value="<?=$row_edit['price']?>">
    </div>

    <div class="mb-3">
      <label for="image">Image:</label>
      <input type="text" class="form-control" id="image" name="image" value="<?=$row_edit['image']?>">
    </div>

    <div class="mb-3">
      <label for="detail">Details:</label>
      <textarea class="form-control" id="detail" name="detail">
          <?= $row_edit['detail']?>
</textarea>
    </div>
    <div class="mb-3">
        <label for="category">Category:</label>
      <select class="form-control" name="category" id="category">
      <option value="" disabled selected >Select product category</option>
      <?php foreach($row_category as $row) {?>
        <option value="<?= $row['categoryID'] ?>">
      <?php echo $row['categoryID'] . ' - ' . $row['name'] ?>
      </option>
      <?php } ?>
</select>
    </div>
    
    <button type="submit" class="btn btn-primary" id="edit" name="edit">Update</button>
  </form>
</div>

</body>
</html>