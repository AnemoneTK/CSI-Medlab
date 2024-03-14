<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";

require_once "../../../DB/connect.php";


if (!isset($_GET["id"])) {
  header(("Location: warehouse.php"));
} else {
  $id = $_GET["id"];
  $name = $_GET["name"];
  $result = $wh->getPDinWH($id);
}


?>
<title>รายการยาใน <?php echo $name; ?></title>

<body style="height:2000px">
  <div class="content-wrapper px-5 py-2" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <a href="./warehouse.php" class="btn btn-outline-info">ย้อนกลับ</a>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <div class="d-inline-flex justify-content-between align-items-center w-100">
                  <h3 class="card-title">
                    รายการยาใน
                    <?php echo $name; ?>
                    ทั้งหมด
                  </h3>
                </div>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>รหัสยา</th>
                      <th>ชื่อ</th>
                      <th>ชนิดยา</th>
                      <th>รายละเอียด</th>
                      <th>วิธีใช้</th>
                      <th>จำนวน</th>
                      <th>หน่วย</th>
                      <th>วันนำเข้า</th>
                      <th>วันหมดอายุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                      <tr>
                        <td><?php echo $row["p_id"]; ?></td>
                        <td><?php echo $row["p_name"]; ?></td>
                        <td><?php echo $row["type_name"]; ?></td>
                        <td><?php echo $row["p_detail"]; ?></td>
                        <td><?php echo $row["p_use"]; ?></td>

                        <?php
                        if ($row["qty"] <= $row["qty_lmt"]) { ?>
                          <td style="color: red; font-weight: bold;"><?php echo $row["qty"]; ?></td>
                        <?php } else { ?>
                          <td><?php echo $row["qty"]; ?></td>
                        <?php } ?>

                        <td><?php echo $row["unitName"]; ?></td>
                        <td><?php echo $row["insert_date"]; ?></td>
                        <?php
                        $date1 = date_create($row["due_date"]);
                        $date2 = date_create(date("Y-m-d"));
                        $diff = date_diff($date2, $date1);
                        $rs = (int)$diff->format("%R%a");
                        if ($rs <= $row["bf_dueDate"]) { ?>
                          <td style="color: red; font-weight: bold;"><?php echo $row["due_date"]; ?></td>
                        <?php } else { ?>
                          <td><?php echo $row["due_date"]; ?></td>
                        <?php } ?>

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

  $(".delete-btn").click(function(e) {
    var opId = $(this).data('id');
    e.preventDefault();
    deleteConfirm(opId);
  })

  function deleteConfirm(opId) {
    Swal.fire({
      title: 'ยืนยันการลบข้อมูล?',
      // text: "",
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'ลบข้อมูล!',
      showLoaderOnConfirm: true,
      preConfirm: function() {
        return new Promise(function(resolve) {
          $.ajax({
              url: './method/deleteProduct.php',
              type: 'GET',
              data: 'id=' + opId,
            })
            .done(function() {
              Swal.fire({
                title: 'success',
                text: 'ลบเรียบร้อยแล้ว!',
                icon: 'success',
              }).then(() => {
                document.location.href = 'showAllProduct.php';
              })
            })
            .fail(function() {
              Swal.fire('Oops...', 'Something went wrong with ajax !', 'error')
              window.location.reload();
            });
        });
      },
    });
  }
</script>

</html>