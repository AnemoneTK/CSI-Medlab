<?php
    $title = "สร้างบัญชีใหม่";
    require_once "header.php";
    require_once "../resource/layout/head.php";
    require_once "../../DB/connect.php";

    $result = $emp->getRole();

    // if(isset($_POST["submit"])){
    //     $fullname = $_POST["fname"];
    //     $username = $_POST["username"];
    //     $userPassword = $_POST["user_password"];
    //     $roleID = $_POST["role_id"];

    //     $status = $emp->insert($fullname,$username,$userPassword,$roleID);
    //     if($status){
    //         echo "Success";
    //     }else{
    //         echo "Try again";
    //     }
    // }
?>
    <h1 class="text-center my-5">สร้างบัญชีใหม่</h1>
    <div class="d-flex align-items-center justify-content-center h-100">
        <!-- <form class="w-50 needs-validation" method="POST" action="createUserForm.php" validate> -->
        <form action="./method/createNewEMP.php" id="createNewEMP" method="POST" class="w-50 needs-validation"validate>
            <div class="form-group  mb-2">
                <label for="fname" class="h5">ชื่อ-นามสกุล</label>
                <input type="text" class="form-control" name="fname"  placeholder="กรุณากรอกชื่อ-นามสกุล" required>
            </div>
            <div class="form-group mb-2">
                <label for="username" class="h5">รหัสประจำตัว</label>
                <input type="text" class="form-control" name="username"  placeholder="Enter username" required>
            </div>
            <div class="form-group mb-3">
                <label for="user_password" class="h5">รหัสผ่าน</label>
                <input type="password" class="form-control" name="user_password"  placeholder="กรุณากรอกรหัสผ่าน" required minlength="8" maxlength="20">
                <small id="passwordHelpInline" class="text-muted h6">
                Must be 8-20 characters long.
                </small>
            </div>
            <div class="form-row align-items-center">
                <div class="form-group mb-3 mt-2 ">
                    <label for="role_id">ตำแหน่ง</label>
                    <select name="role_id" class="custom-select w-100 p-2" id="role_id" required>
                        <option selected>Choose...</option>
                        <?php
                            while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                                <option value="<?php echo $row["roleID"];?>"><?php echo $row["roleName"];?></option>
                            <?php
                            }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success mt-4">สร้างบัญชีใหม่</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#createNewEMP").submit(function(e) {
                e.preventDefault();

                let formUrl = $(this).attr("action");
                let reqMethod = $(this).attr("method");
                let formData = $(this).serialize();
                $.ajax({
                    url: formUrl,
                    type: reqMethod,
                    data: formData,
                    success: function(data) {
                        let result = JSON.parse(data);
                        if (result.status == "success") {
                            Swal.fire({
                                position: 'center',
                                icon: result.status,
                                title: result.msg,
                                showConfirmButton: false,
                                timer: 1500
                            })
                            // window.location.href = "./createUserForm.php";
                        } else {
                            // Swal.fire("ล้มเหลว", result.msg, result.status)
                            Swal.fire({
                                position: 'center',
                                icon: result.status,
                                title: result.msg,
                                showConfirmButton: true,
                                timer: 1500
                            })
                        }
                    }
                })
            })
        })
    </script>
</body>
</html>