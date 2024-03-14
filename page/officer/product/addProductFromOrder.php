<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";

require_once "../../../DB/connect.php";


?>

<body onload="document.pos.order_id.focus()">
  <div class="content-wrapper py-4" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">
    <section class="content">
      <div class="container-fluid row">
        <div class="col-md-12">
          <div class="card card-info w-20">
            <div class="card-header">
              <div class="d-inline-flex justify-content-between align-items-center w-100">
                <h3 class="card-title">เพิ่มยาเข้าคลัง</h3>
              </div>
            </div>

            <form action="../method/insertFromOrder.php" method="POST" name="pos">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>รหัสคำสั่งซื้อ</label>
                      <input type="text" name="order_id" class="form-control" id="order_id" placeholder="รหัสคำสั่งซื้อ" required>
                      <hr>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>รหัสยา</label>
                      <input type="text" name="p_id" class="form-control" id="p_id" placeholder="รหัสยา" readonly>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="p_name">ชื่อ</label>
                      <input type="text" name="p_name" class="form-control" id="p_name" placeholder="ชื่อยา" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_type">ประเภท</label>
                      <select name="p_type" class="form-control select2" id="type_id" style="width: 100%;" readonly>
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
                        <textarea name="p_detail" class="form-control" id="p_detail" rows="3" placeholder="Enter ..."></textarea>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="p_use">วิธีการใช้งาน</label>
                        <textarea name="p_use" class="form-control" rows="3" id="p_use" placeholder="Enter ..."></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="p_amount">จำนวน</label>
                        <input type="number" name="p_amount" class="form-control" id="qty" placeholder="จำนวน" readonly>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="p_limit">จำนวนขั้นต่ำ</label>
                        <input type="number" name="p_limit" class="form-control" id="qty_lmt" placeholder="จำนวน" required>
                      </div>
                    </div>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="p_unit">หน่วย</label>
                        <select name="p_unit" class="form-control select2" id="unit_id" style="width: 100%;">
                          <option selected="selected">เลือกหน่วย</option>
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
                        <select name="p_location" class="form-control select2" id="wh_id" style="width: 100%;" required>
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
                        <input name="p_dueDate" class="form-control" id="due_date" type="date" readonly>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group ">
                        <label for="bf_date">แจ้งเตือนก่อนหมดอายุ</label>
                        <input type="number" name="bf_date" class="form-control" id="bf_dueDate" placeholder="วัน" required>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info w-100" id="insertOrder">เพิ่มรายการใหม่</button>
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
</body>

<script>
  $(document).ready(function() {
    $("#insertOrder").submit(function(e) {
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


  $(function() {
    $('#order_id').autocomplete({
      source: "../method/searchProductID.php",
      minLength: 1,
      close: function() {
        var id = $(this).val();
        $.get("../method/searchProductDetail.php", {
          'pID': id
        }, function(data) {
          $('#p_id').val(data.p_id);
          $('#p_name').val(data.p_name);
          $('#type_id').val(data.type_id);
          $('#p_detail').val(data.p_detail);
          $('#p_use').val(data.p_use);
          $('#qty').val(data.qty);
          $('#qty_lmt').val(data.qty_lmt);
          $('#unit_id').val(data.unit_id);
          $('#due_date').val(data.due_date);
          $('#bf_dueDate').val(data.bf_dueDate);
        }, "json");
      }
    });
  })
</script>

</html>