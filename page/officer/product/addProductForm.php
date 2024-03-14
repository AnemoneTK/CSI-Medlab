<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";

require_once "../../../DB/connect.php";


?>

<div class="content-wrapper py-4" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">

  <section class="content">
    <div class="container-fluid row">
      <div class="col-md-6">
        <div class="card card-primary w-20">
          <div class="card-header">
            <div class="d-inline-flex justify-content-between align-items-center w-100">
              <h3 class="card-title">สร้างรายการยาใหม่</h3>

              <div class="btn-menu">
                <a href="../warehouse/warehouse.php" class="btn btn-secondary btn-sm">
                  <i class="fa-solid fa-plus"></i>
                  เพิ่มตำแหน่งจัดเก็บ
                </a>

              </div>
            </div>
          </div>

          <form action="../method/insertProduct.php" method="POST" id="createNewProduct">
            <div class="card-body">
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>เลขที่ใบนำเข้า</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="รหัสสินค้า">
                    <hr>
                  </div>
                </div>
              </div> -->

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>รหัสยา</label>
                    <input type="text" name="p_id" class="form-control" id="exampleInputEmail1" placeholder="รหัสยา" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="p_name">ชื่อ</label>
                    <input type="text" name="p_name" class="form-control" id="exampleInputEmail1" placeholder="ชื่อยา" required>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label for="p_type">ประเภท</label>
                    <select name="p_type" class="form-control select2" style="width: 100%;" required>
                      <option selected="selected" value="">เลือกประเภท</option>
                      <?php
                      $result = $pd->getTypes();
                      while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                        <option value="<?php echo $row["type_id"]; ?>"><?php echo $row["type_name"]; ?></option>
                      <?php
                      }
                      ?>
                      <!-- <option>เพิ่ม</option> -->
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="p_detail">รายละเอียด</label>
                      <textarea name="p_detail" class="form-control" rows="3" placeholder="Enter ..." required></textarea>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="p_use">วิธีการใช้งาน</label>
                      <textarea name="p_use" class="form-control" rows="3" placeholder="Enter ..." required></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">

                </div>

                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_amount">จำนวน</label>
                      <input type="number" name="p_amount" class="form-control" id="exampleInputEmail1" placeholder="จำนวน" required>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_limit">จำนวนขั้นต่ำ</label>
                      <input type="number" name="p_limit" class="form-control" id="exampleInputEmail1" placeholder="จำนวน" required>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_unit">หน่วย</label>
                      <select name="p_unit" class="form-control select2" style="width: 100%;" required>
                        <option selected="selected" value="">เลือกหน่วย</option>
                        <?php
                        $result = $pd->getUnit();
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $row["unitID"]; ?>"><?php echo $row["unitName"]; ?></option>
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
                      <select name="p_location" class="form-control select2" style="width: 100%;" required>
                        <option selected="selected" value="">เลือกตำแหน่ง</option>
                        <?php
                        $result = $pd->getLocation();
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                          <option value="<?php echo $row["wh_id"]; ?>"><?php echo $row["wh_name"]; ?></option>
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
                      <input name="p_dueDate" class="form-control" type="date" required>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group ">
                      <label for="bf_date">แจ้งเตือนก่อนหมดอายุ</label>
                      <input type="number" name="bf_date" class="form-control" placeholder="วัน" required>
                    </div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button type="submit" name="submit" class="btn btn-primary w-100">ยืนยัน</button>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card card-primary w-20">
          <form action="./addProductForm.php" method="POST" id="addType">
            <div class="card-body">
              <div class="row">
                <label>เพิ่มประเภท</label>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="new_type" class="form-control" required>
                    <button type="submit" name="addType" class="btn btn-success w-100 mt-2">เพิ่ม</button>
                    <?php
                    if (isset($_POST["addType"])) {
                      $newType = $_POST["new_type"];
                      $status = $pd->insertType($newType);
                    }
                    ?>
                  </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                  <div class="card">
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>รหัสยา</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $type = $pd->getTypes();
                          while ($row = $type->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                              <td><?php echo $row["type_name"]; ?></td>
                            </tr>
                          <?PHP } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>

        <div class="card card-primary w-20">
          <form action="./addProductForm.php" method="POST" id="addType">
            <div class="card-body">
              <div class="row">
                <label>เพิ่มหน่วย</label>
                <div class="col-md-4">
                  <div class="form-group">
                    <input type="text" name="new_unit" class="form-control" id="exampleInputEmail1" required>
                    <button type="submit" name="addUnit" class="btn btn-success w-100 mt-2">เพิ่ม</button>
                    <?php
                    if (isset($_POST["addUnit"])) {
                      $newUnit = $_POST["new_unit"];
                      $status = $pd->insertUnit($newUnit);
                    }
                    ?>
                  </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                  <div class="card">
                    <div class="card-body">
                      <table id="example1" class="table table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>หน่วย</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $unit = $pd->getUnit();
                          while ($row = $unit->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                              <td><?php echo $row["unitName"]; ?></td>
                            </tr>
                          <?PHP } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>



  </section>

</div>

<script>
  $(document).ready(function() {
    $("#createNewProduct").submit(function(e) {
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
              showConfirmButton: false,
              timer: 1500
            })

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
</body>

</html>