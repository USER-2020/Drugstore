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
if($_POST){
    $total = 0;
    $SID=session_id();
    $email=$_POST['email'];

    foreach($_SESSION['shoppingcar'] as $index=>$Product){
        $total = $total+($Product['PRICING']*$Product['CANT']);

    }
    $conexionBD = BD::createInstance();
    $sentence=$conexionBD->prepare("INSERT INTO `sale` (`id`, `transaction_key`, `paypal_dates`, `date`, `email`, `total`, `status`) 
    VALUES (NULL, :transaction_key, '', NOW(), :email, :total, 'waiting...');");
    $sentence->bindParam(":transaction_key", $SID);
    $sentence->bindParam(":email", $email);
    $sentence->bindParam("total", $total);
    $sentence->execute();
    $idSel=$conexionBD->lastInsertId();//Recuperar id de ventas

    foreach($_SESSION['shoppingcar'] as $index=>$Product){
        $sentence = $conexionBD->prepare("INSERT INTO `saledetail` (`id`, `id_sel`, `id_product`, `unit_pricing`, `cant`, `dowload`)
        VALUES (NULL, :id_sel, :id_product, :unit_pricing, :cant, '0');");

        $sentence->bindParam(":id_sel", $idSel);
        $sentence->bindParam(":id_product", $Product['ID']);
        $sentence->bindParam(":unit_pricing", $Product['PRICING']);
        $sentence->bindParam(":cant", $Product['CANT']);
        $sentence->execute();

    }

    // echo "<h3>".$total."</h3>";
}
?>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AZ3TUZb7LMTDN2hPe1RYIyHxT2n1CUjFHeuL4THogUAqMzWSYxyywcfWFG7q9MbzcS_oM80XzM1XzdSn"></script>
<script>
    // Render the PayPal button into #paypal-button-container
    paypal.Buttons({

        style: {
            color:  'gold',
            shape:  'pill',
            label:  'checkout',
            height: 40,
            size: 'responsive'
            
            
        },

        // Set up the transaction
        createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: <?php echo $total;?>,
                            currency: 'USD'
                        },
                        description: "<?php echo $SID;?>#<?php echo openssl_encrypt($idSel, COD, KEY); ?>",
                        // details: "<?php echo $SID;?>#<?php echo openssl_encrypt($idSel, COD, KEY);?>";
                        // "Purchase of products: $ <?php echo number_format($total,2)?>;
                    }]
                });
            },


            // Cancel to payment 
            onCancel : function(data){
                alert("Payment canceled");
                console.log(data);
            },



            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    console.log(orderData);
                    // console.log(data);
                    var transaction = orderData.purchase_units[0].payments.captures[0];
                    // console.log(transaction);
                    window.location= "verify.php?facilitatorAccessToken="+data.facilitatorAccessToken+"&id="+orderData.id;

                    console.log('TRANSACTION STATUS: ',orderData.status);
                    console.log('DATA: ', orderData.payer.email_address);
                    console.log('      ', transaction.amount.value);
                    console.log('      ', orderData.purchase_units[0].description);
                    
                    
                   
                    // Replace the above to show a success message within this page, e.g.
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '';
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });

            }
          

            


    }).render('#paypal-button-container');
</script>

<div class="jumbotron text-center"  >
  <h1 class="display-4">Final Step!</h1>
  <p class="lead">You are about to pay in PayPal the sum of:</p>
  <h4>$<?php echo number_format($total, 2); ?></h4>
  <div id="paypal-button-container"></div>
  <div id="paypal-button"></div>
  <hr class="my-4">
  <p>The products will be sent after processing the payment
      <strong>for clarification: drogueriajaramillos.com or   <a type="button" class="btn btn-success">Whatssap</a></strong>
  </p>  
</div>
</body>
</html>






   

   