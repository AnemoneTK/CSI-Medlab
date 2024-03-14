<?php
require_once "../resource/layout/head.php";
require_once "../../DB/connect.php";
?>
<title>Officer</title>

<style>
.nav-link {
    cursor: pointer;
}
.nav-treeview .nav-link{
    padding-left: 30px;
}
.sidebar p{
    user-select: none;
}
</style>

<body class="hold-transition sidebar-mini" style="font-family: 'Prompt', sans-serif;" ">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">

                <li class="nav-item dropdown mr-2">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell" style="font-size: 24px;"></i>
                        
                        <?php
                        $sql ="SELECT COUNT(*) as num FROM product
                        WHERE qty<=qty_lmt OR DATEDIFF(due_date, CURRENT_DATE()) <= bf_dueDate";
                        
                        $query_sql = mysqli_query($link, $sql);
                        $result = mysqli_fetch_assoc($query_sql);

                        if($result['num'] > 0){ ?>
                            <span class="badge badge-danger navbar-badge " >
                            <?php
                               echo $result['num'];
                            ?>
                        </span>
                        <?php } ?>
                        
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-header">
                        <?php
                               
                               $sql ="SELECT COUNT(*) as num FROM product
                               WHERE qty<=qty_lmt OR DATEDIFF(due_date, CURRENT_DATE()) <= bf_dueDate";

                               $query_sql = mysqli_query($link, $sql);
                               $result = mysqli_fetch_assoc($query_sql);
                               echo $result['num'];
                            ?> Notifications</span>
                        <div class="dropdown-divider"></div>
                        
                        <div class="dropdown-divider" ></div>
                        <a class="dropdown-item" onclick="navigatePage('./print/showStock.php')">
                            <i class="fa-solid fa-box"></i> ยาเหลือน้อย
                            <span class="float-right text-muted font-weight-bold">
                            <?php
                               
                               $sql ="SELECT COUNT(*) as num FROM product WHERE qty<=qty_lmt";

                               $query_sql = mysqli_query($link, $sql);
                               $result = mysqli_fetch_assoc($query_sql);
                               echo $result['num'];
                               ?>
                            </span>
                        </a>
                        <a class="dropdown-item" onclick="navigatePage('./print/showEXP.php')">
                            <i class="fa-solid fa-calendar-days"></i> ยาใกล้หมดอายุ
                            <span class="float-right text-muted font-weight-bold">
                            <?php
                                $sql ="SELECT COUNT(*) as num FROM product
                                WHERE DATEDIFF(due_date, CURRENT_DATE()) <= bf_dueDate";
                                $query_sql = mysqli_query($link, $sql);
                                $result = mysqli_fetch_assoc($query_sql);
                                echo $result['num'];
                              ?>  
                            </span>
                        </a>
                        <!-- <a href="#" class="dropdown-item">
                        <i class="fa-solid fa-circle-exclamation"></i> ยาหมดสต๊อก
                            <span class="float-right text-muted font-weight-bold">
                            <?php
                                $sql ="SELECT COUNT(*) as num FROM product
                                WHERE qty = 0";
                                $query_sql = mysqli_query($link, $sql);
                                $resultDate = mysqli_fetch_assoc($query_sql);
                                echo $resultDate['num'];
                              ?>  
                            </span>
                        </a> -->
                        
                    </div>
                </li>

            </ul>
        </nav>
    </div>



    <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1B2938; ">
        <a href="#" class="brand-link d-flex align-items-center" style="cursor:default;">
            <img src="../resource/img/LogoWhite.png" alt="Medlab Logo" class=" img-fluid" style="height:auto; max-height:80px;">
            <span class="brand-text font-weight-Bold ml-2" style="font-size: 30px; color:#ffff;">MEDLAB</span>
        </a>

        <div class="sidebar" style="height: 88.6vh; position:relative;">
            <nav class="mt-5">
                <ul class="nav nav-pills nav-sidebar flex-column mb-auto" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item">
                        <a class="nav-link activeMenu" id="menu" onclick="navigatePage('./dashboard.php')">
                            <i class="nav-icon fa-solid fa-chart-area"></i>
                            <p>
                                ภาพรวม
                            </p>
                        </a>
                    </li>

                    <!-- Inventory Start -->
                    <li class="nav-item">
                        <a class="nav-link headDropdown" id="hd">
                        <i class="nav-icon fa-solid fa-pills"></i>
                            <p style="user-select: none">
                                จัดการคลังยา
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item " onclick="navigatePage('./product/showAllProduct.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p style="user-select: none">รายการยาทั้งหมด</p>
                                </a>
                            </li>
                            <li class="nav-item " onclick="navigatePage('./product/addProductFromOrder.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p style="user-select: none">เพิ่มยาจากคำสั่งซื้อ</p>
                                </a>
                            </li>
                            <li class="nav-item " onclick="navigatePage('./product/addProductForm.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p style="user-select: none">เพิ่มยาใหม่</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- Inventory End -->

                    <!-- warehouse Start -->
                    <li class="nav-item">
                        <a class="nav-link" id="menu" onclick="navigatePage('./warehouse/warehouse.php')">
                            <i class="nav-icon fa-solid fa-warehouse"></i>
                            <p>
                                ตำแหน่งจัดเก็บ
                            </p>
                        </a>
                    </li>
                    <!-- warehouse End -->
                    
                    <!-- Report Start -->
                    <li class="nav-item">
                        <a class="nav-link headDropdown" id="hd">
                            <i class="nav-icon fa-solid fa-print"></i>
                            <p>
                                ออกเอกสารรายงาน
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link" onclick="navigatePage('./order/order.php')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>คำขอสั่งซื้อ</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" onclick="navigatePage('./withdraw/withdraw.php')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>การเบิกยา</p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" onclick="navigatePage('./print/printProduct.php')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ยาทั้งหมด</p>
                                </a>
                            </li>
                            <li class="nav-item " onclick="navigatePage('./print/showWarehouse.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ตำแหน่งจัดเก็บ</p>
                                </a>
                            </li>
                            <li class="nav-item " onclick="navigatePage('./print/showStock.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ยาที่จำนวนเหลือน้อย</p>
                                </a>
                            </li>
                            <li class="nav-item" onclick="navigatePage('./print/showEXP.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ยาที่ใกล้หมดอายุ</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Report End -->

                    <!-- History Start -->
                    <li class="nav-item">
                        <a class="nav-link headDropdown" id="hd">
                            <i class="nav-icon fa-solid fa-clock-rotate-left "></i>
                            <p>
                                ประวัติการดำเนินการ
                                <i class="right fas fa-angle-left"></i>

                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" onclick="navigatePage('./order/orderHistory.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ประวัติการสั่งซื้อยา</p>
                                </a>
                            </li>
                            <li class="nav-item" onclick="navigatePage('./withdraw/withdrawHistory.php')">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>ประวัติการเบิกออก</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- History End -->

                   


                    

                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Simple Link
                                <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li> -->
                </ul>


            </nav>

            <div class="btn-group dropup w-100" style="position:absolute; bottom: 0; left:0;">
                <button type="button" class="btn btn-secondary dropdown-toggle text-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                style="border-radius: 0; position:relative;">
                    <i class="fa-solid fa-arrow-right-from-bracket mx-2 "></i>
                    ออกจากระบบ
                </button>
                <div class="dropdown-menu align-items-center text-center w-100" style="background-color: #dc3545; color:#ffff; cursor:pointer;">
                    <a href="../../DB/logout.php">
                    ยืนยันออกจากระบบ
                    </a>
                </div>
            </div>
        </div>
    </aside>

    <div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750" style="height: 200px">
        <iframe id="content" src="./dashboard.php"></iframe>
    </div>

    <footer class="main-footer d-flex justify-content-between align-items-center p-1" style="position: relative;">
        <div class="copyright px-2">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </div>
        <div class="d-none d-sm-inline px-2">
            <img src="../resource/img/IT_logo.png" alt="Medlab Logo" class="img-fluid mx-2" style="height:auto; max-height:50px;">
            <img src="../resource/img/SPU_logo.png" alt="Medlab Logo" class="img-fluid mx-2" style="height:auto; max-height:50px;">
        </div>
    </footer>

    </div>
    <!-- ./wrapper -->

    <script>
        const navigatePage = (page) => {
            document.getElementById("content").src = page;
        };

        //active function for iframe menu
        $(document).ready(function() {
            $(".main-sidebar .nav-link").click(function() {
                $(".main-sidebar .nav-link").removeClass("activeMenu");
                $(this).addClass("activeMenu");
                $(".headDropdown").removeClass("activeMenu");
            })

            $(".headDropdown").click(function() {
                $(this).toggleClass("activeDropdown");
            })
        })
    </script>