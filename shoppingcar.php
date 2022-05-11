<?php
session_start();
$message='';

if(isset($_POST['btnAction'])){
    switch($_POST['btnAction']){
        
        case 'Add':
            
            if(is_numeric(openssl_decrypt($_POST['Id_'], COD, KEY))){
                $ID=openssl_decrypt($_POST['Id_'], COD, KEY);
                $message ='Id Correct' .$ID;
            }else{
                $message='UPS... Id incorrect' .$ID;
            }  
            if(is_string(openssl_decrypt($_POST['Nombre_prod'], COD, KEY))){
                $NAME_PROD=openssl_decrypt($_POST['Nombre_prod'],COD, KEY);
                $message='Name is correct'.$NAME_PROD. '</br>';
            }else{$message="UPS...the product's name is not undefined".'</br>'; break;}

            if(is_string(openssl_decrypt($_POST['Pricing'], COD, KEY))){
                $PRICING=openssl_decrypt($_POST['Pricing'],COD, KEY);
                $message='Pricing is correct'.$PRICING. '</br>';
            }else{$message="UPS...the pricing is not undefined".'</br>'; break;}

            if(is_numeric(openssl_decrypt($_POST['quantity'], COD, KEY))){
                $CANT=openssl_decrypt($_POST['quantity'],COD, KEY);
                $message='Amont is correct'.$CANT. '</br>';
            }else{$message="UPS...the product's quantity is not undefined".'</br>'; break;}

        if(!isset($_SESSION['shoppingcar'])){
            $Product=array(
                'ID'=>$ID,
                'NAME_PROD'=>$NAME_PROD,
                'PRICING'=>$PRICING,
                'CANT'=>$CANT
            );

            $_SESSION['shoppingcar'][0]=$Product;
            $message= "Product add successfuly";

        }else{
            $idProducts=array_column($_SESSION['shoppingcar'],"ID");
            if(in_array($ID, $idProducts)){
                echo "<script>alert('The product has already been selected');</script>";
                $message="";

            }else{

            
            $Num_Products=count($_SESSION['shoppingcar']);
            $Product=array(
                'ID'=>$ID,
                'NAME_PROD'=>$NAME_PROD,
                'PRICING'=>$PRICING,
                'CANT'=>$CANT
            );
            $_SESSION['shoppingcar'][$Num_Products]=$Product;
            $message= "Product add successfuly";
            }
        }
            
        break;

        case "Delete":
            if(is_numeric(openssl_decrypt($_POST['Id_'], COD, KEY))){
                $ID=openssl_decrypt($_POST['Id_'], COD, KEY);
                
                foreach($_SESSION['shoppingcar'] as $index=>$Product){
                    if($Product['ID']==$ID){
                        unset($_SESSION['shoppingcar'][$index]);
                        echo "<script>alert('Product delete from shopping cart'); </script>";
                    }
                }
            }else{
                $message='UPS... Id incorrect';
            }  
        break;    
    }
}

?>
