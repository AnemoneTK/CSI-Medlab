<?php
require_once "../../resource/layout/head.php";
require_once "../resource/layout/head.php";
require_once "../../../DB/connect.php";

require '../barcode/vendor/autoload.php';
$generator = new Picqer\Barcode\BarcodeGeneratorHTML();

?>

<title>คำสั่งซื้อ</title>

<body onload="document.order.p_id.focus()">

  <div class="content-wrapper py-4" style="width: auto; height:fit-content; font-family: 'Prompt', sans-serif;">
    <section class="content">
      <div class="container-fluid row">
        <div class="col-md-6">
          <div class="card card-warning w-20">
            <div class="card-header">
              <div class="d-inline-flex justify-content-between align-items-center w-100">
                <h3 class="card-title">รายละเอียดการสั่งซื้อ</h3>
              </div>
            </div>

            <form action="./order.php" method="POST" name="order" id="order">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="op_id" id="op_id">

                      <label>รหัสยา</label>
                      <input type="text" name="p_id" class="form-control" id="p_id" placeholder="รหัสยา" required>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-8">
                    <div class="form-group">
                      <label for="p_name">ชื่อ</label>
                      <input type="text" name="p_name" class="form-control" id="p_name" readonly>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="p_type">ประเภท</label>
                      <select name="p_type" class="form-control select2" id="type_id" style="width: 100%;" readonly>
                        <option selected="selected" disabled="disabled"></option>
                        <?php
                        $result = $order->getTypes();
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
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="p_amount">จำนวนในคลัง</label>
                        <input type="number" name="p_amount" class="form-control" id="qty" readonly>
                      </div>
                    </div>



                    <div class="col-sm-2">
                      <div class="form-group">
                        <label for="p_unit">หน่วย</label>
                        <select name="p_unit" class="form-control select2" id="unit_id" style="width: 100%;" readonly>
                          <option selected="selected" readonly></option>
                          <?php
                          $result = $order->getUnit();
                          while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
                            <option value="<?php echo $row["unitID"]; ?>"><?php echo $row["unitName"]; ?></option>
                          <?php
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="p_limit">จำนวนสั่งซื้อ</label>
                          <input type="number" name="p_order" class="form-control" id="qty_order" placeholder="จำนวน" required>
                          <input type="hidden" name="p_limit" class="form-control" id="qty_lmt" placeholder="จำนวน">
                        </div>
                      </div>
                    </div>

                    <input type="hidden" name="bf_date" id="bf_dueDate" class="form-control" placeholder="วัน">

                  </div>

                  <textarea style="display:none" name="p_detail" class="form-control" id="p_detail" rows="3" placeholder="Enter ..."></textarea>
                  <textarea style="display:none" name="p_use" class="form-control" rows="3" id="p_use" placeholder="Enter ..."></textarea>


                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" name="submitOrder" class="btn btn-warning w-100">ยืนยัน</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>


        <div class="col-md-6">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">รายการสั่งซื้อ</h3>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card-body">
                <table id="example1" class="table  table-hover">
                  <thead>
                    <tr>
                      <th>รหัสยา</th>
                      <th>ชื่อ</th>
                      <th>จำนวน</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      if (isset($_POST["submitOrder"])) {
                        $opID = $_POST["op_id"];
                        $p_id = $_POST["p_id"];
                        $p_name = $_POST["p_name"];
                        $type_id = $_POST["p_type"];
                        $productDetail = $_POST["p_detail"];
                        $productUse = $_POST["p_use"];
                        $qty_order = $_POST["p_order"];
                        $qty_lmt = $_POST["p_limit"];
                        $unit_id = $_POST["p_unit"];
                        $due_date = "2024-1-15";
                        $bf_dueDate = $_POST["bf_date"];

                        $status = $order->insert(
                          $opID,
                          $p_id,
                          $p_name,
                          $type_id,
                          $productDetail,
                          $productUse,
                          $qty_order,
                          $qty_lmt,
                          $unit_id,
                          $due_date,
                          $bf_dueDate
                        );
                        if ($status) {
                          // $last_id = $link->lastInsertID();
                          echo "<td>" . $p_id . "</td>";
                          echo "<td>" . $p_name . "</td>";
                          echo "<td>" . $qty_order . "</td>";
                          echo "<td>" . $generator->getBarcode($p_id, $generator::TYPE_CODE_128) . "</td>";
                        } else {
                          echo "error";
                        }
                      }
                      ?>
                    </tr>
                  </tbody>
                </table>
              </div>
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
  $(function() {
    $('#p_id').autocomplete({
      source: "../method/orderSearch.php",
      minLength: 1,
      close: function() {
        var id = $(this).val();
        $.get("../method/orderSearchDetail.php", {
          'p_ID': id
        }, function(data) {
          $('#op_id').val(data.op_id);
          $('#p_name').val(data.p_name);
          $('#type_id').val(data.type_id);
          $('#p_detail').val(data.p_detail);
          $('#p_use').val(data.p_use);
          $('#qty').val(data.qty);
          $('#qty_lmt').val(data.qty_lmt);
          $('#unit_id').val(data.unit_id);
          $('#bf_dueDate').val(data.bf_dueDate);
        }, "json");
      }

    });
  })

  $(function() {
    $("#example1").DataTable({
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,

      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>

</html>