<?php
require_once "../../../DB/connect.php";

$loginUsername = $_POST["username"];
$loginPassword = $_POST["password"];
$userRole = 3;

$newPassword = md5($loginPassword . $loginUsername);

$result = $emp->getUser($loginUsername, $newPassword, $userRole);

if (!$loginUsername) {
  echo json_encode(array("status" => "warning", "msg" => "กรุณากรอกรหัสประจำตัว"));
} else if (!$loginPassword) {
  echo json_encode(array("status" => "warning", "msg" => "กรุณากรอกรหัสผ่าน"));
} else if (!$result) {
  echo json_encode(array("status" => "error", "msg" => "รหัสประจำตัว หรือ รหัสผ่าน <br/>ไม่ถูกต้อง"));
} else {
  echo json_encode(array("status" => "success", "msg" => ""));
  $_SESSION["username"] = $loginUsername;
  $_SESSION["userID"] = $result["id"];
}
