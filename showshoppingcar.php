<?php
include 'config.php';
include 'shoppingcar.php';


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
      <a class="nav-link" href="./?controller=pages&actions=home">Home <span class="sr-only">(current)</span></a>
      <a class="nav-link" href="login.php">Store</a>
      <a class="nav-link" href="./?controller=products&action=introduction">Blog</a>
      <a class="nav-link" href="showshoppingcar.php"><i class="fi-shopping-cart"></i> Shopping Car(<?php
        echo (empty($_SESSION['shoppingcar']))?0:count($_SESSION['shoppingcar']);
      ?>)</a>
      <a class="btn btn-light rigth-align" href="logout.php">Logout</a>
    </div>
</nav> 

</br>
<div class="container-fluid">
    
    <h3>Shopping list</h3>
<?php if(!empty($_SESSION['shoppingcar'])){?>
<table class="table table-light table-bordered">
    <tbody>
        <tr>
            <th width="40%">Description</th>
            <th width="15%" class="text-center">Cant</th>
            <th width="20%" class="text-center">Pricing</th>
            <th width="20%" class="text-center">Total</th>
            <th width="5%">---</th>
        </tr>
    <?php $total = 0;?>    
    <?php foreach($_SESSION['shoppingcar'] as $index=>$Product){?>
        <tr>
            <td width="40%"><?php echo($Product['NAME_PROD'])?></td>
            <td width="15%" class="text-center"><?php echo($Product['CANT'])?></td>
            <td width="20%" class="text-center"><?php echo($Product['PRICING'])?></td>
            <td width="20%" class="text-center"><?php echo number_format($Product['PRICING']* $Product['CANT'] )?></td>
            <td width="5%">
                <form action="" method="post">
                <input type="hidden" name="Id_" id="Id_" value="<?php echo openssl_encrypt($Product['ID'], COD, KEY); ?>">
                    <button name="btnAction" value="Delete" class="btn btn-danger" type="submit" >Delete</button>
                </form>
            </td>
            
        </tr>
    <?php $total = $total+($Product['PRICING']*$Product['CANT']);?>
    <?php }?>
        <tr>
            <td colspan="3" align="right"><h3>Total</h3></td>
            <td align="right"><h3>$<?php echo number_format($total);?></h3></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="5">
                <form action="payment.php" method="post">
                    <div class="alert alert-success">
                        <div class="form-group">
                            <label for="my-input">Contact Email: </label>
                            <input id="email" name="email" class="form-control" type="email" placeholder="Input your email" required>
                        </div>
                        <small id="emailHelp" class="form-text text-muted">
                            The list of products and the order will be delivered to this email.
                        </small>
                    </div>
                    <button class="btn btn-primary btn-lg btn-block" type="submit" value="proceed" name="btnAction">Proceed to payment >></button>                    
                </form>
            </td>
        </tr>
    </tbody>
</table>
<?php }else{?> 
    <div class="alert alert-succes">
        There are no products in the cart
    </div>
<?php }?>   
</div>




</body>
</html>