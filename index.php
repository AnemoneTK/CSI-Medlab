<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medlab | Role Select</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/2e92bf8ff3.js" crossorigin="anonymous"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;600&family=Prompt:wght@100;300;400;700&display=swap');
    </style>
</head>

<body class="d-flex flex-column justify-content-evenly align-items-center"
style="height: 100vh; 
background-color:#1B2938;

font-family: 'Prompt', sans-serif;">
    <div class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <p class="fw-bold" style="font-size:60px; color:#ffff;">Warehouse Monitoring</p>
        <h3 style="color:#ffff;">ระบบบริการจัดการคลัง</h3>
    </div>
    <div class="container-fluid d-flex flex-row justify-content-center flex-wrap">
        <!-- <a href="./page/manager/login.php" class="card text-center d-flex flex-column justify-content-center rounded-3 m-3" style="width: 20vw; height:300px; text-decoration: none;">
            <i class="fa-solid fa-chart-pie mb-4" style="font-size: 8em; color:#dc3545;"></i>
            <h1 class="text-center w-10 fw-bold" style="font-size: 2rem; font-weight:400;">ผู้บริหาร</h1>
        </a> -->
        <a href="./page/officer/login.php" class="card text-center d-flex flex-column justify-content-center rounded-3 m-3" style="width: 20vw; height:300px; text-decoration: none;">
            <i class="fa-regular fa-address-card mb-4" style="font-size: 8em; color:#0d6efd;"></i>
            <h1 class="text-center w-10 fw-bold" style="font-size: 2rem; font-weight:400;">พนักงาน</h1>
        </a>
        <a href="./page/admin/login.php" class="card text-center d-flex flex-column justify-content-center rounded-3 m-3" style="width: 20vw; height:300px; text-decoration: none;">
            <i class="fa-solid fa-database mb-4" style="font-size: 8em; color:#198754;"></i>
            <h1 class="text-center w-10 fw-bold" style="font-size: 2rem; font-weight:400;">ผู้ดูแล</h1>
        </a>
    </div>
    <div class="pt-5">
        <a href="#" style="font-size: 20px; color:#ffff;">แจ้งปัญหาการใช้งาน</a>
    </div>

</body>

</html>