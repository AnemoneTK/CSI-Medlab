<?php
require_once "../../../DB/connect.php";
require_once "../../../DB/controller/empController.php";

// if(isset($_POST["submit"])){
    $fullname = $_POST["fname"];
    $username = $_POST["username"];
    $userPassword = $_POST["user_password"];
    $roleID = $_POST["role_id"];

    $checkUserName = $emp->checkUsername($username);

    if($checkUserName["num"] > 0){
        echo json_encode(array("status" => "warning", "msg" => "รหัสประจำตัว<br/>".$username."<br/>ถูกใช้ไปแล้ว"));
    }else{
        $status = $emp->insert($fullname,$username,$userPassword,$roleID);
        if(!$status){
            echo json_encode(array("status" => "warning", "msg" => "เกิดข้อผิดพลาด"));
        } else{
            echo json_encode(array("status" => "success", "msg" => "สร้างบัญชีผู้ใช้ ".$username." แล้ว"));
        }
    }


    
    
// }
