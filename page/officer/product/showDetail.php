<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";

require_once "../../../DB/connect.php";

if (!isset($_GET["id"])) {
  header(("Location: showAllProduct.php"));
} else {
  $id = $_GET["id"];
  $p_Detail = $pd->getDetail($id);
}

$result = $emp->getRole();
?>

<title>รายละเอียดยา <?php echo $p_Detail["p_name"]; ?></title>

<div class="content-wrapper py-4" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">

  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <a href="./showAllProduct.php" class="btn btn-outline-info">ย้อนกลับ</a>
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
                  รายละเอียดยา <b><?php echo $p_Detail["p_name"]; ?></b>
                </h3>
                <!-- <div class="btn-menu">

                        <a href="" class="btn btn-outline-success">
                          <i class="fa-solid fa-print"></i>
                            ปริ้นเอกสาร
                        </a>
                    </div> -->
              </div>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>รหัสยา</th>
                    <th>ชื่อ</th>
                    <th>ชนิดยา</th>
                    <th>รายละเอียด</th>
                    <th>วิธีใช้</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ตำแหน่งจัดเก็บ</th>
                    <th>วันหมดอายุ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?php echo $p_Detail["p_id"]; ?></td>
                    <td><?php echo $p_Detail["p_name"]; ?></td>
                    <td><?php echo $p_Detail["type_name"]; ?></td>
                    <td><?php echo $p_Detail["p_detail"]; ?></td>
                    <td><?php echo $p_Detail["p_use"]; ?></td>
                    <td><?php echo $p_Detail["qty"]; ?></td>
                    <td><?php echo $p_Detail["unitName"]; ?></td>
                    <td><?php echo $p_Detail["wh_name"]; ?></td>
                    <td><?php echo $p_Detail["due_date"]; ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid row">
      <div class="col-md-12">
        <div class="card card-success w-20">
          <div class="card-header">
            <h3 class="card-title">แก้ไขข้อมูล</h3>
          </div>

          <form action="../method/updateProduct.php" method="POST" id="editProduct">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="op_id" value="<?php echo $p_Detail["op_id"] ?>" />
                  <div class="form-group">
                    <label>รหัสยา</label>
                    <input type="text" name="p_id" class="form-control" id="exampleInputEmail1" placeholder="รหัสยา" value="<?php echo $p_Detail["p_id"] ?>" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label for="p_name">ชื่อ</label>
                    <input type="text" name="p_name" class="form-control" id="exampleInputEmail1" placeholder="ชื่อยา" value="<?php echo $p_Detail["p_name"] ?>">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="p_type">ประเภท</label>
                    <select name="p_type" class="form-control select2" style="width: 100%;">
                      <option selected="selected">เลือกประเภท</option>
                      <?php
                      $result = $pd->getTypes();
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option <?php
                                if ($row["type_id"] == $p_Detail["type_id"])
                                  echo "selected";
                                ?> value="<?php echo $row["type_id"]; ?>"><?php echo $row["type_name"]; ?></option>
                      <?php
                      }
                      ?>
                      <!-- <option>เพิ่ม</option> -->
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="p_detail">รายละเอียด</label>
                      <textarea name="p_detail" class="form-control" rows="3" placeholder="Enter ..."><?php echo $p_Detail["p_detail"] ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="p_use">วิธีการใช้งาน</label>
                      <textarea name="p_use" class="form-control" rows="3" placeholder="Enter ..."><?php echo $p_Detail["p_use"] ?></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_amount">จำนวน</label>
                      <input type="number" name="p_amount" class="form-control" id="exampleInputEmail1" placeholder="จำนวน" value="<?php echo $p_Detail["qty"] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_limit">จำนวนขั้นต่ำ</label>
                      <input type="number" name="p_limit" class="form-control" id="exampleInputEmail1" placeholder="จำนวน" value="<?php echo $p_Detail["qty_lmt"] ?>">
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_unit">หน่วย</label>
                      <select name="p_unit" class="form-control select2" style="width: 100%;">
                        <option selected="selected">เลือกหน่วย</option>
                        <?php
                        $result = $pd->getUnit();
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option <?php
                                  if ($row["unitID"] == $p_Detail["unitID"])
                                    echo "selected";
                                  ?> value="<?php echo $row["unitID"]; ?>"><?php echo $row["unitName"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="p_location">ตำแหน่งจัดเก็บ</label>
                      <select name="p_location" class="form-control select2" style="width: 100%;">
                        <option selected="selected">เลือกตำแหน่ง</option>
                        <?php
                        $result = $pd->getLocation();
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option <?php
                                  if ($row["wh_id"] == $p_Detail["wh_id"])
                                    echo "selected";
                                  ?> value="<?php echo $row["wh_id"]; ?>"><?php echo $row["wh_name"]; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="p_dueDate">วันหมดอายุ</label>
                      <input name="p_dueDate" class="form-control" type="date" value="<?php echo $p_Detail["due_date"] ?>" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="bf_date">แจ้งเตือนก่อนหมดอายุ</label>
                      <input type="number" name="bf_date" class="form-control" id="exampleInputEmail1" placeholder="จำนวน" value="<?php echo $p_Detail["bf_dueDate"] ?>">
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-success w-100">บันทึกการแก้ไขข้อมูล</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
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
      "searching": false,
      "paging": false,
      "info": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });

  $(document).ready(function() {
    $("#editProduct").submit(function(e) {
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
            Swal.fire({
              position: 'center',
              icon: result.status,
              title: result.msg,
              showConfirmButton: true,
              // timer: 1500
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.reload();
              }
            });
          } else {
            // Swal.fire("ล้มเหลว", result.msg, result.status)
            Swal.fire({
              position: 'center',
              icon: result.status,
              title: result.msg,
              showConfirmButton: true,
              timer: 1500
            })
          }
        }
      })
    })
  })
</script>

</html>