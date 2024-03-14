<?php
require_once "../../../DB/connect.php";
require_once "../../../DB/controller/productController.php";

    if(!isset($_GET["id"])){
        header(("Location:../product/showAllProduct.php"));
    }else{
        $id = $_GET["id"];
        $result = $pd->deleteProduct($id);
        if($result){
            header(("Location:../product/showAllProduct.php"));
        }
    }

?>