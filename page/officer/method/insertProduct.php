<?php
require_once "../../../DB/connect.php";
require_once "../../../DB/controller/productController.php";

// if(isset($_POST["submit"])){
    $productID = $_POST["p_id"];
    $productName = $_POST["p_name"];
    $productType = $_POST["p_type"];
    $productDetail = $_POST["p_detail"];
    $productUse = $_POST["p_use"];
    $warehouse_id = $_POST["p_location"];
    $amount = $_POST["p_amount"];
    $limit = $_POST["p_limit"];
    $unitID = $_POST["p_unit"];
    $dueDate = date('Y-m-d', strtotime($_POST['p_dueDate']));
    $bf_dueDate = $_POST["bf_date"];

    $status = $pd->insert($productID,$productName,$productType,
                            $productDetail, $productUse, $warehouse_id,
                            $amount, $limit, $unitID, $dueDate, $bf_dueDate);
        if($status){
            // header(("Location: previous_file.php"));
            echo json_encode(array("status" => "success", "msg" => "สร้างรายการ".$productName."แล้ว"));
        } else{
            echo json_encode(array("status" => "error", "msg" => ""));
            // header(("Location: previous_file.php"));

        }
    
// }
?>