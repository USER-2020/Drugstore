<?php
include '../../conexion.php';
include '../../config.php';
include '../../shoppingcar.php';


if (!isset($_SESSION['rol'])){
  header("location: ../../login.php");
}else{
  if($_SESSION['rol'] != 2){
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
    <title>Store</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- ICONS -->
    <link rel="stylesheet" href="../../assets/css/foundation-icons.css">

    <!-- CSS BOOOSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <!-- SCRIPT BOOSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="navbar-nav">
      <a class="nav-link" href="../../?controller=pages&actions=home">Home <span class="sr-only">(current)</span></a>
      <a class="nav-link" href="login.php">Store</a>
      <a class="nav-link" href="?controller=products&action=introduction">Blog</a>
      <a class="nav-link" href="../../showshoppingcar.php"><i class="fi-shopping-cart"></i> Shopping Car(<?php
        echo (empty($_SESSION['shoppingcar']))?0:count($_SESSION['shoppingcar']);
      ?>)</a>
      <a class="btn btn-light rigth-align" href="../../logout.php">Logout</a>
    </div>
</nav> 
    <div class="container-fluid">
    <i class="fas fa-cart-plus"></i>  
    <h1>Hello user</h1>
    <div class="alert alert-success">
      <?php echo $message; ?>
    </div>  
    
        <?php 
        
        $conexionBD = BD::createInstance();
        $query = "SELECT * FROM products";
        $result = $conexionBD->query($query);
        while($row = $result->fetch()){
            ?>
            

          <div class="row" style="display: inline-block; width: 25rem;">
            <div class="col-8" >                        
              <div class="card" style=" width:20rem; box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2); margin-top: 10px; text-align: center; height: 500px;">
              <!-- border-radius: 15px;  display: inline-block;  padding: 10px auto; width: 18rem; -->
              <img src="../../assets/img/DSC00595.JPG" class="card-img-top" alt="DrogueriaJaramillos.com"  style="box-sizing: content-box;">
              <!-- width="100px" height="200px" -->
              <div class="card-body">
                  <h3 class="card-title"><?php echo $row['Nombre_prod']; ?></h3>
                  <p class="card-text"><?php echo $row['Description']; ?></p>
                  <h5><?php echo $row['Pricing']; ?></h5>
                  <form action="" method="post">
                    <input type="hidden" name="Id_" id="Id_" value="<?php echo openssl_encrypt($row['Id_'], COD, KEY); ?>">
                    <input type="hidden" name="Nombre_prod" id="Nombre_prod" value="<?php echo openssl_encrypt($row['Nombre_prod'], COD, KEY); ?>">
                    <input type="hidden" name="Pricing" id="Pricing" value="<?php echo openssl_encrypt($row['Pricing'], COD, KEY); ?>">
                    <input type="hidden" name="quantity" id="quantity" value="<?php echo openssl_encrypt(1, COD, KEY); ?>">
                  <button name="btnAction" value="Add" type="submit" class="btn btn-primary"><i class="fi-shopping-cart"></i> Add to cart</button>
                  </form>
                  
              </div>
              </div>
           </div>
          </div>
        <?php
        }
        ?>
    </div>

    

    
</body>
</html>