<?php
    require_once("../../../Connection/connection.php");
?>

<?php
    try {
        $sql = "select * from category";
        $stmt_category = $conn->query($sql);
        $row_category = $stmt_category->fetchAll();
    } catch(PDOException $ex) {
        echo "Error: " . $ex->getMessage();
    }

    if(isset($_POST['addnew'])) {
        try {
            $sql = "insert into product values (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(1, $_POST['productID']);
            $stmt->bindParam(2, $_POST['name']);
            $stmt->bindParam(3, $_POST['price']);
            $stmt->bindParam(4, $_POST['image']);
            $stmt->bindParam(5, $_POST['details']);
            $stmt->bindParam(6, $_POST['category']);
            $stmt->execute();
            header('Location: basic-table.php');
        }catch(PDOException $ex) {
            echo "Error: " . $ex->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Add New Product</h2>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="mb-3 mt-3">
      <label for="productID">Product ID:</label>
      <input type="text" class="form-control" id="productID" name="productID" placeholder="Enter product ID">
    </div>
    <div class="mb-3">
      <label for="name">Product Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name">
    </div>
    <div class="mb-3">
      <label for="price">Price:</label>
      <input type="number" class="form-control" id="price" placeholder="Enter Price product" name="price">
    </div>
    <div class="mb-3">
      <label for="image">Image:</label>
      <input type="file" class="form-control" id="imgage" name="image">
    </div>
    <div class="mb-3">
      <label for="details">Details:</label>
      <textarea class="form-control" id="details" name="details">

      </textarea>
    </div>
    <div class="mb-3">
        <select class="form-control" name="category" id="category">
            <option value="" disabled selected >Select product category</option>
            <?php foreach($row_category as $row) {?>
                <option value="<?= $row['categoryID'] ?>">
                    <?php echo $row['categoryID'] . ' - ' . $row['name'] ?>
                </option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary" id="addnew" name="addnew">Add New</button>
  </form>
</div>

</body>
</html>
