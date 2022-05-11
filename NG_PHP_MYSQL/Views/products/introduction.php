<!-- Tabla o listado de productos  -->
<?php


session_start();
if (!isset($_SESSION['rol'])){
  header("location: ../../login.php");
}else{
  if($_SESSION['rol'] != 1){
    header("location: ../../login.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeProducts</title>

    <!-- CSS -->
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar_nav">
    <a name="" id="" class="btn btn-success" href="orders.php" role="button">Orders_rt</a>
    </div>
  </nav>
<div class="card">
    <div class="card-header">
    <a name="" id="" class="btn btn-success" href="?controller=products&action=create" role="button">Add Product</a><span><a class="btn btn-light left-align" href="logout.php">Logout</a></span>
    </div> 
  </div> 
<div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Nombre_prod</th>
        <th scope="col">Description</th>
        <th scope="col">Stock</th>
        <th scope="col">Pricing</th>
      </tr>
    </thead>
  <tbody>

    <?php foreach ($products as $product){ ?>

    <tr>
      <th scope="row"><?php echo $product ->Id; ?></th>
      <td><?php echo $product ->Nombre_prod; ?></td>
      <td><?php echo $product ->Description; ?></td>
      <td><?php echo $product ->Stock; ?></td>
      <td><?php echo $product ->Pricing; ?></td>
      <td>
        <a href="?controller=products&action=update&Id=<?php echo $product->Id;?>" class="btn btn-success" >Update</a>
        <a href="?controller=products&action=delete&Id=<?php echo $product->Id;?>" class="btn btn-danger">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
  </table>
</div>
</div>  

</body>
</html>

