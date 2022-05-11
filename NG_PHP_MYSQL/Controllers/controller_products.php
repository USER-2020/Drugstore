<?php

include_once("Models/product.php");
include_once("conexion.php");

BD::createInstance();

class ControllerProducts{

    public function introduction(){

        $products = Product::consult();//access to the model
        include_once("Views/products/introduction.php");//view model

    }

    public function create(){

        if($_POST){
            print_r($_POST);
            $Nombre_prod=$_POST['Nombre_prod'];
            $Description=$_POST['Description'];
            $Stock=$_POST['Stock'];
            $Pricing=$_POST['Pricing'];

            Product::create($Nombre_prod, $Description, $Stock, $Pricing);
        }

        include_once("Views/products/create.php");

    }

    public function update(){

        if($_POST){
            $Id_= $_POST['Id_'];
            $Nombre_prod = $_POST['Nombre_prod'];
            $Description = $_POST['Description'];
            $Stock = $_POST['Stock'];
            $Pricing = $_POST['Pricing'];

            Product::update($Id_, $Nombre_prod, $Description, $Stock, $Pricing);

            // print_r($_POST);
        }

        $Id=$_GET['Id'];
        $product=( Product::search($Id) ); 
        include_once("Views/products/update.php");

    }


    public function delete(){
        print_r($_GET);
        $Id = $_GET['Id'];
        Product::delete($Id);
        header("location:./?controller=products&action=introduction");
    }
   
}


?>