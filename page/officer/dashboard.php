<?php
require_once "../resource/layout/head.php";
require_once "../../DB/connect.php";

$result = $pd->getProductDetail();

?>
<style>
  .highcharts-figure,
  .highcharts-data-table table {
    min-width: 360px;
    max-width: 800px;
    margin: 0px 0px 1em 0px;
  }

  .highcharts-data-table table {
    font-family: 'Prompt', sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
  }

  .highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
  }

  .highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
  }

  .highcharts-data-table td,
  .highcharts-data-table th,
  .highcharts-data-table caption {
    padding: 0.5em;
  }

  .highcharts-data-table thead tr,
  .highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
  }

  .highcharts-data-table tr:hover {
    background: #f1f7ff;
  }
</style>

<title>รายการยา</title>
<!-- <body style="height:2000px"> -->
<div class="content-wrapper py-3 px-2" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ภาพรวม</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-tablets"></i></span>
            <div class="info-box-content">
              <a href="./product/showAllProduct.php" style="color: #555;">
                <span class="info-box-text">ยาทั้งหมดในคลัง <small>คลิกเพื่อดูรายละเอียด</small></span>

                <span class="info-box-number">
                  <?php
                  $sql = "SELECT SUM(qty) as qty FROM product";

                  $query_sql = mysqli_query($link, $sql);
                  $resultQTY = mysqli_fetch_assoc($query_sql);
                  echo $resultQTY['qty'];
                  ?>
                </span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-box"></i></span>
            <div class="info-box-content">
              <a href="./print/showStock.php" style="color: #555;">
                <span class="info-box-text">ยาเหลือน้อย <small>คลิกเพื่อดูรายละเอียด</small></span>

                <span class="info-box-number">
                  <?php
                  $sql = "SELECT COUNT(*) as num FROM product WHERE qty<=qty_lmt";

                  $query_sql = mysqli_query($link, $sql);
                  $resultQtyLimit = mysqli_fetch_assoc($query_sql);
                  echo $resultQtyLimit['num'];
                  ?>
                </span>
              </a>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-md-4">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-calendar-days"></i></span>
            <div class="info-box-content">
              <a href="./print/showEXP.php" style="color: #555;">
                <span class="info-box-text">ยาใกล้หมดอายุ <small>คลิกเพื่อดูรายละเอียด</small></span>
                <span class="info-box-number">
                  <?php
                  $sql = "SELECT COUNT(*) as num FROM product
              WHERE DATEDIFF(due_date, CURRENT_DATE()) <= bf_dueDate";
                  $query_sql = mysqli_query($link, $sql);
                  $resultDate = mysqli_fetch_assoc($query_sql);
                  echo $resultDate['num'];
                  ?>
                </span>
              </a>
            </div>
          </div>
        </div>



      </div>
    </div>
  </section>



  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <figure class="highcharts-figure">
            <div id="chart-container"></div>
          </figure>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">รายการยา</h3>
            </div>

            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>รหัสยา</th>
                    <th>ชื่อ</th>
                    <th>ชนิดยา</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ตำแหน่งจัดเก็บ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $row["p_id"]; ?></td>
                      <td><?php echo $row["p_name"]; ?></td>
                      <td><?php echo $row["type_name"]; ?></td>
                      <td><?php echo $row["qty"]; ?></td>
                      <td><?php echo $row["unitName"]; ?></td>
                      <td><?php echo $row["wh_name"]; ?></td>
                    </tr>
                  <?PHP } ?>
                </tbody>
                <!-- <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                </tfoot> -->
              </table>
            </div>
          </div>
        </div>
  </section>





</div>


</body>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
  Highcharts.chart('chart-container', {
    chart: {
      type: 'line'
    },
    title: {
      text: 'การรับเข้า - ส่งออกของยา'
    },
    subtitle: {

    },
    xAxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },
    yAxis: {
      title: {
        text: ''
      }
    },
    plotOptions: {
      line: {
        dataLabels: {
          enabled: true
        },
        enableMouseTracking: true
      }
    },
    series: [{
      name: 'การรับยาเข้า',
      data: [890, 1020, 1200, 955, 825, 800, 1230, 1586, 1300, 947, 795, 900]
    }, {
      name: 'การเบิกออก',
      data: [800, 950, 1000, 900, 795, 790, 1120, 1500, 1230, 800, 766, 875]
    }]
  });

  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</html>