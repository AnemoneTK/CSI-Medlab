<?php
require_once "../../../DB/connect.php";
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";



$result = $pd->getProductDetail();
$wh_Location = $wh->showWarehouse();
?>

<div class="content-wrapper py-3 px-2" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">ตำแหน่งจัดเก็บ</h1>
        </div>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <?php
          $sql_wh = "SELECT warehouse.wh_name as warehouseName, SUM(qty) as sumQTY
                FROM product 
                INNER JOIN warehouse 
                ON product.wh_id = warehouse.wh_id
                GROUP BY warehouse.wh_name ";

          $result_wh = mysqli_query($link, $sql_wh);
          $data = array();
          while ($row = mysqli_fetch_assoc($result_wh)) {
            extract($row);
            $data[] = array($row['warehouseName'], intval($row['sumQTY']));
            $data2 = json_encode($data);
          }
          ?>
          <figure class="highcharts-figure">
            <div id="container"></div>
          </figure>
        </div>


        <div class="col-lg-8 col-md-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <div class="d-inline-flex justify-content-between align-items-center w-100">

                <div class="col-lg-4 col-md-12 col-sm-12">
                  <form action="./warehouse.php" method="POST" id="createNewProduct">
                    <div class="form-group">
                      <input type="text" name="wh" class="form-control" placeholder="ตำแหน่งจัดเก็บ" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" name="insertWarehouse" class="btn btn-info w-100" id="insertWarehouse">เพิ่มตำแหน่งจัดเก็บใหม่</button>
                      <?php
                      if (isset($_POST["insertWarehouse"])) {
                        $newWH = $_POST["wh"];
                        $status = $wh->insertWarehouse($newWH);
                      }
                      ?>

                    </div>
                  </form>
                </div>

                <div class="btn-menu">
                  <!-- <a href="" class="btn btn-secondary btn-sm">
                          <i class="fa-solid fa-plus"></i>
                            เพิ่มที่จัดเก็บ
                        </a> -->

                  <a href="../print/showWarehouse.php" class="btn btn-secondary btn-">
                    <i class="fa-solid fa-print"></i>
                    ออกเอกสาร
                  </a>

                </div>
              </div>
            </div>

            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ตำแหน่งจัดเก็บ</th>
                    <th>จำนวนทั้งหมด</th>
                    <th>จำนวนที่เหลือน้อย</th>
                    <th>จำนวนที่ใกล้หมดอายุ</th>
                    <th>การดำเนินการ</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  while ($row = $wh_Location->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr>
                      <td><?php echo $row["wh_name"]; ?></td>

                      <td>
                        <?php
                        $id =  $row["wh_id"];
                        $sql = "SELECT SUM(qty) as qty FROM product WHERE wh_id = $id";

                        $query_sql = mysqli_query($link, $sql);
                        $result = mysqli_fetch_assoc($query_sql);
                        echo $result['qty'];
                        ?>
                      </td>

                      <td>
                        <?php
                        $id =  $row["wh_id"];
                        $sql = "SELECT COUNT(*) as num FROM product WHERE wh_id = $id AND qty<=qty_lmt";

                        $query_sql = mysqli_query($link, $sql);
                        $result = mysqli_fetch_assoc($query_sql);
                        echo $result['num'];
                        ?>
                      </td>
                      <td>
                        <?php
                        $id =  $row["wh_id"];
                        $sql = "SELECT COUNT(*) as num FROM product
                                WHERE wh_id = $id AND DATEDIFF(due_date, CURRENT_DATE()) <= bf_dueDate";

                        $query_sql = mysqli_query($link, $sql);
                        $result = mysqli_fetch_assoc($query_sql);
                        echo $result['num'];
                        ?>
                      </td>
                      <td>
                        <a href="./warehouseDetail.php?id=<?php echo $row["wh_id"]; ?>&name=<?php echo $row["wh_name"]; ?>" class="btn btn-primary btn-sm mr-2">
                          <i class="fa-solid fa-eye"></i>
                          ดูรายละเอียด
                        </a>
                        <!-- <a 
                                href="#"
                                class="btn btn-info btn-sm mr-2">
                                  <i class="fa-solid fa-pen-to-square"></i>
                                  แก้ไขข้อมูล
                                </a> -->
                        <a href="#" class="btn btn-danger delete-btn btn-sm delete-btn">
                          <i class="fa-solid fa-trash"></i>
                          ลบข้อมูล
                        </a>
                      </td>
                    </tr>
                  <?PHP } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>



  <script>
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
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

  <!-- Highcharts -->
  <script src="https://code.highcharts.com/highcharts.js"></script>
  <script src="https://code.highcharts.com/modules/data.js"></script>
  <script src="https://code.highcharts.com/modules/drilldown.js"></script>
  <script src="https://code.highcharts.com/modules/exporting.js"></script>
  <script src="https://code.highcharts.com/modules/export-data.js"></script>
  <script src="https://code.highcharts.com/modules/accessibility.js"></script>

  <script>
    Highcharts.chart('container', {
      chart: {
        type: 'pie'
      },
      title: {
        text: 'ปริมาณยาในตำแหน่งจัดเก็บยา',
        align: 'center'
      },


      accessibility: {
        announceNewData: {
          enabled: true
        },
        // point: {
        //     valueSuffix: '%'
        // }
      },

      plotOptions: {
        series: {
          borderRadius: 5,
          dataLabels: [{
            enabled: true,
            distance: 15,
            format: '{point.name}'
          }, {
            enabled: true,
            distance: '-30%',
            filter: {
              property: 'percentage',
              operator: '>',
              value: 5
            },
            format: '{point.y}',
            style: {
              fontSize: '0.9em',
              textOutline: 'none'
            }
          }]
        }
      },

      tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}'
      },

      series: [{
        colorByPoint: true,
        name: 'จำนวนยาในคลัง',
        data: <?php echo $data2; ?>
      }],
    });
  </script>