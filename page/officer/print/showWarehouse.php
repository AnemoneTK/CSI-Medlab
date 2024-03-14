<?php
require_once "../../../DB/connect.php";
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";



$result = $pd->getProductDetail();
$wh_Location = $wh->showWarehouse();
?>
<title>ตำแหน่งจัดเก็บ</title>
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
        <div class="col-lg-12 col-md-12 col-sm-12">
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

            <div class="card-body">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>ตำแหน่งจัดเก็บ</th>
                    <th>จำนวนทั้งหมด</th>
                    <th>จำนวนที่เหลือน้อย</th>
                    <th>จำนวนที่ใกล้หมดอายุ</th>
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