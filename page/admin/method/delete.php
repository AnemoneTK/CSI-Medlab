<?php
require_once "../../../DB/connect.php";
require_once "../../../DB/controller/empController.php";

    if(!isset($_GET["id"])){
        header(("Location:../showEMP.php"));
    }else{
        $id = $_GET["id"];
        $result = $emp->delete($id);
        if($result){
            header(("Location:../showEMP.php"));
        }
    }
?>