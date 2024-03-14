<?php
require_once "../../../DB/connect.php";


    // if(isset($_POST["submit"])){
        $user_id = $_POST["user_id"];
        $fullname = $_POST["fname"];
        $username = $_POST["username"];
        $userPassword = $_POST["user_password"];
        $roleID = $_POST["role_id"];

        $newPassword = md5($userPassword . $username);
        

        $result = $emp->update($fullname, $username, $newPassword, $roleID, $user_id);
        if($result){
            echo json_encode(array("status" => "success", "msg" => "อัปเดตข้อมูล ".$username." เรียบร้อยแล้ว"));
            // header("Location:../showEMP.php");
        }
    // }
?>