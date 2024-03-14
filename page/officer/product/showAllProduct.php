<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";


require_once "../../../DB/connect.php";

$result = $pd->getProductDetail();


?>
<title>Test Report</title>

<body style="height:2000px">
  <div class="content-wrapper px-5 py-2" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">รายการยาทั้งหมด</h1>
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
                  <h3 class="card-title"></h3>

                  <div class="btn-menu">

                    <a href="../print/printProduct.php" class="btn btn-outline-success">
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
                      <th>รหัสยา</th>
                      <th>ชื่อ</th>
                      <th>ชนิดยา</th>
                      <th>จำนวน</th>
                      <th>หน่วย</th>
                      <th>ตำแหน่งจัดเก็บ</th>
                      <th>การดำเนินการ</th>
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
                        <td><?php echo $row["wh_name"]; ?></td>
                        <td>
                          <a href="showDetail.php?id=<?php echo $row["op_id"]; ?>" class="btn btn-primary btn-sm mr-2">
                            <i class="fa-solid fa-eye"></i>
                            ดูรายละเอียด |
                            <i class="fa-solid fa-pen-to-square"></i>
                            แก้ไขข้อมูล
                          </a>
                          <a data-id="<?= $row["op_id"]; ?>" href="?id=<?php $row["op_id"]; ?>" class="btn btn-danger delete-btn btn-sm delete-btn">
                            <i class="fa-solid fa-trash"></i>
                            ลบข้อมูล
                          </a>
                        </td>
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
              url: '../method/deleteProduct.php',
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