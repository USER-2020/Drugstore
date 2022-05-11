<?php
include 'conexion.php';
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
    <link rel="stylesheet" href="assets/css/foundation-icons.css">
    <!-- CSS PAYPAL  -->
    <link rel="stylesheet" type="text/css" href="https://www.paypalobjects.com/webstatic/en_US/developer/docs/css/cardfields.css"/>

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
      <a class="nav-link" href="?controller=products&action=introduction">Blog</a>
      <a class="nav-link" href="showshoppingcar.php"><i class="fi-shopping-cart"></i> Shopping Car(<?php
        echo (empty($_SESSION['shoppingcar']))?0:count($_SESSION['shoppingcar']);
      ?>)</a>
      <a class="btn btn-light rigth-align" href="logout.php">Logout</a>
    </div>
</nav> 
<?php


// print_r($_GET);

$ClientID = "AZ3TUZb7LMTDN2hPe1RYIyHxT2n1CUjFHeuL4THogUAqMzWSYxyywcfWFG7q9MbzcS_oM80XzM1XzdSn";//sandbox account
$Secret = "EMWDEzMBsuIulXDctHFyLjlTvSxx5EpXu-KRWBhEuVSQ6RdG5YziuQFFCqQoKhfU6RyCdIQm4S8K8SkE"; //secret

$Login = curl_init("https://api-m.sandbox.paypal.com/v1/oauth2/token/");
curl_setopt($Login, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($Login, CURLOPT_USERPWD, $ClientID.":".$Secret);
curl_setopt($Login, CURLOPT_POSTFIELDS, "grant_type=client_credentials");//RETORNAR TODAS LAS CREDENCIALES DE CLIENTid Y SECRET
$Answer=curl_exec($Login);

// print_r($Answer);

$objAnswer=json_decode($Answer);

// ACCESS TOKEN 
$AccessToken = $objAnswer->access_token;

// print_r($AccessToken);

$sel = curl_init("https://api-m.sandbox.paypal.com/v2/checkout/orders/".$_GET['id']);

curl_setopt($sel, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Authorization: Bearer ".$AccessToken));

curl_setopt($sel, CURLOPT_RETURNTRANSFER, TRUE);

$SelAnswer=curl_exec($sel);

// print_r($SelAnswer);

$objTransferData=json_decode($SelAnswer);

// print_r($objTransferData->purchase_units[0]->description);

$status = $objTransferData->status;
$total = $objTransferData->purchase_units[0]->amount->value;
$email = $objTransferData->purchase_units[0]->payee->email_address;
$address = $objTransferData->purchase_units[0]->shipping->address;
$namebuyer = $objTransferData->purchase_units[0]->shipping->name->full_name;
$description = $objTransferData->purchase_units[0]->description;

// print_r($description);

$pass=explode("#",$description);

$SID=$pass[0];
$passSel=openssl_decrypt($pass[1], COD, KEY);

// print_r($passSel);

curl_close($sel);
curl_close($Login);

// echo $passSel;

if($status=="COMPLETED"){
    $menssagePaypal = "<h3>Payment Approved</h3>";


    $conexionBD = BD::createInstance();
    $sentence = $conexionBD->prepare("UPDATE `sale` 
    SET `paypal_dates` = :paypal_dates, 
        `status` = 'aproved'
     WHERE `sale`.`id` = :id;");
    


    $sentence->bindParam(":id" ,$passSel);
    $sentence->bindParam(":paypal_dates" ,$SelAnswer);
    $sentence->execute();

    $sentence = $conexionBD->prepare("UPDATE `sale` 
    SET `status` = 'completed'
     WHERE `transaction_key`= :transaction_key
     AND `total`= :total
     AND `id`=:id");

    $sentence->bindParam(":transaction_key" ,$SID);
    $sentence->bindParam(":total" ,$total);
    $sentence->bindParam(":id" ,$passSel);
    $sentence->execute();

    $Completed = $sentence->rowCount();

}else{
    $menssagePaypal ="<h3>there is a problem with the payment</h3>";
}

// echo $menssagePaypal;


?>

<div class="jumbotron text-center"  >
  <h1 class="display-4">Everything on point!!</h1>
  <p class="lead"><?php echo $menssagePaypal; ?></p>
  <hr class="my-4">
  <p>The products will be sent after processing the payment </br><br>
      <strong>for clarification: drogueriajaramillos.com or   <a type="button" class="btn btn-success">Whatssap</a></strong><br></br>
      <?php

        if($Completed>=1){
            $sentence = $conexionBD->prepare("SELECT * FROM `saledetail`,`products` 
            WHERE saledetail.id_product=products.Id_ 
            AND saledetail.id_sel=:id");
        
            
            $sentence->bindParam(":id" ,$passSel);
            $sentence->execute();

            $productsList = $sentence->fetchAll(PDO::FETCH_ASSOC);
            // print_r($productsList);


        }


      ?>
    
   <div class="row">
        <?php foreach($productsList as $Product){?>

                <div class="col-3">
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title" style="color:black;"><?php echo $Product['Nombre_prod']?></h5>
                    <h6 class="card-subtitle mb-2 text-muted" style="color:black;">COP$ <?php echo $Product['unit_pricing']?></h6>
                    <p class="card-text" style="color:black;"><?php echo $Product['cant']?></p>
                    <a href="#" class="card-link">Card link</a>
                    <a href="#" class="card-link">Another link</a>
                </div>
                </div>
                </div>
        <?php }?>
   </div>   
    
     
</div>
      