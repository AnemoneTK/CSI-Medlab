<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";

require_once "../../../DB/connect.php";

$result = $order->getOrderHistory();

require '../barcode/vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

?>
<title>ประวัติการสั่งซื้อยา</title>

<body style="height:2000px">
  <div class="content-wrapper px-5 py-2" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ประวัติการสั่งซื้อยา</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>รหัสยา</th>
                      <th>ชื่อ</th>
                      <th>ชนิดยา</th>
                      <th>จำนวน</th>
                      <th>หน่วย</th>
                      <th>วันที่</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php


                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $row["p_id"]; ?></td>
                        <td><?php echo $row["p_name"]; ?></td>
                        <td><?php echo $row["type_name"]; ?></td>
                        <td><?php echo $row["qty"]; ?></td>
                        <td><?php echo $row["unitName"]; ?></td>
                        <td><?php echo $row["insert_date"]; ?></td>
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


  </div>

</body>
<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": false,
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

</html>