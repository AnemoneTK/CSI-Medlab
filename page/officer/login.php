<?php
$title = "Office Login";
require_once "../login_layout.php";
require_once "../../DB/connect.php";
if (isset($_SESSION['userID'])) {
    $user_id = $_SESSION['userID'];
}
?>

<body style="font-family: 'Prompt', sans-serif;">
    <div class="d-flex flex-column justify-content-evenly align-items-center" style="height: 100vh;">
        <div class="d-flex flex-column justify-content-center align-items-center rounded-3 p-5" style=" background-image: linear-gradient(180deg, rgba(0, 52, 112, 1) 0%, rgba(0, 118, 224, 1) 80%); width:28vw; height:60vh; position:relative;">
            <a href="../../index.php">
                <i class="fa-solid fa-arrow-left" style="position:absolute; top:30px; left:30px; font-size:24px; color:#ffff; "></i>
            </a>
            <i class="fa-solid fa-address-card my-3  " style="font-size: 5rem; color:#ffff;"></i>
            <p class="fw-bold mb-3" style="font-size:40px; color:#ffff;">เข้าสู่ระบบพนักงาน</p>
            <!-- <form action="<?php //echo htmlentities($_SERVER['PHP_SELF'])
                                ?>" id="LoginFrom" method="POST" class="d-flex flex-column justify-content-center align-items-center w-75"> -->
            <form action="./method/loginOfficeDB.php" id="LoginFrom" method="POST" class="d-flex flex-column justify-content-center align-items-center w-75">
                <div class=" w-100">
                    <label for="username" class="form-label" style="font-size: 20px; color:#ffff;">รหัสประจำตัว</label>
                    <input type="text" class="form-control" name="username" placeholder="กรุณากรอกรหัสประจำตัว" id="username">
                </div>
                <div class="mt-3 mb-5 w-100">
                    <label for="password" class="form-label" style="font-size: 20px; color:#ffff;">รหัสผ่าน</label>
                    <input type="password" class="form-control" name="password" placeholder="กรุณากรอกรหัสผ่าน" id="password">
                </div>
                <button type="submit" class="btn btn-dark btn-lg text-warp w-100">เข้าสู่ระบบ</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#LoginFrom").submit(function(e) {
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
                            window.location.href = "./officerMasterPage.php";
                        } else {
                            // Swal.fire("ล้มเหลว", result.msg, result.status)
                            Swal.fire({
                                position: 'center',
                                icon: result.status,
                                title: result.msg,
                                showConfirmButton: false,
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