<?php
$title = "ข้อมูลพนักงาน";
require_once "header.php";
require_once "../resource/layout/head.php";
require_once "../../DB/connect.php";

$result = $emp->getUserRole();
?>
<div class="container-wrapper" >

  <section class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
    <h1 class="text-center my-3">ข้อมูลบัญชีผู้ใช้</h1>
    </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                    <th>ลำดับ</th>
                    <th>รหัสประจำตัว</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ตำแหน่ง</th>
                    <th>ดำเนินการ</th>
                    </tr>
                  </thead>

                  <tbody>
                  <?php
                      while($row = $result->fetch(PDO::FETCH_ASSOC)){?>
                          <tr>
                              <td><?php echo $row["id"];?></td>
                              <td><?php echo $row["username"];?></td>
                              <td><?php echo $row["fullname"];?></td>
                              <td><?php echo $row["roleName"];?></td>
                              <td>
                                <a 
                                href="editForm.php?id=<?php echo $row["id"];?>"
                                class="btn btn-info btn-sm mr-2">
                                  <i class="fa-solid fa-pen-to-square"></i>
                                  แก้ไขข้อมูล
                                </a>
                                <a 
                                data-id = "<?= $row["id"];?>"
                                href="?id=<?php $row["id"];?>"
                                class="btn btn-danger delete-btn btn-sm delete-btn">
                                  <i class="fa-solid fa-trash"></i>
                                  ลบบัญชีผู้ใช้
                                </a>
                              </td>
                          </tr>
                          <?PHP }?>
                  </tbody>
                  
                </table>
              </div>
            </div>
          </div>
    </div>
  </section>
</div>

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": true,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });



    $(".delete-btn").click(function(e) {
            var userId = $(this).data('id');
            e.preventDefault();
            deleteConfirm(userId);
        })

        function deleteConfirm(userId) {
            Swal.fire({
                title: 'ยืนยันการลบข้อมูล?',
                text: "คุณต้องการลบบัญชีผู้ใช้ลำดับที่ "+userId+" หรือไม่!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ลบข้อมูล!',
                showLoaderOnConfirm: true,
                preConfirm: function() {
                    return new Promise(function(resolve) {
                        $.ajax({
                                url: './method/delete.php',
                                type: 'GET',
                                data: 'id=' + userId,
                            })
                            .done(function() {
                                Swal.fire({
                                    title: 'success',
                                    text: 'ลบบัญชีเรียบร้อยแล้ว!',
                                    icon: 'success',
                                }).then(() => {
                                    document.location.href = 'showEMP.php';
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
</body>
</html>