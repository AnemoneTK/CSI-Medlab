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
          <div class="card card-danger w-20">
            <div class="card-header">
              <div class="d-inline-flex justify-content-between align-items-center w-100">
                <h3 class="card-title">รายละเอียดการเบิกยาออก</h3>
              </div>
            </div>

            <form action="./withdraw.php" method="POST" name="order" id="order">
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
                          <label for="p_limit">จำนวนที่เบิก</label>
                          <input type="number" name="qty_wh" class="form-control" id="qty_wh" placeholder="จำนวน" required>
                        </div>
                      </div>
                    </div>


                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="p_detail">หมายเหตุ</label>
                        <textarea name="p_waring" class="form-control" id="p_waring" rows="1" placeholder="Enter ..."></textarea>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-12">
                      <div class="form-group">
                        <button type="submit" name="submitWithdraw" class="btn btn-danger w-100">ยืนยัน</button>
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
              <h3 class="card-title">รายการเบิกออก</h3>
            </div>

            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="card-body">
                <table id="example1" class="table  table-hover">
                  <thead>
                    <tr>
                      <th>รหัสยา</th>
                      <th>ชื่อ</th>
                      <th>จำนวนเบิก</th>
                      <th>คงเหลือ</th>
                      <th>หมายเหตุ</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      if (isset($_POST["submitWithdraw"])) {
                        $opID = $_POST["op_id"];
                        $productID = $_POST["p_id"];
                        $productName = $_POST["p_name"];
                        $productType = $_POST["p_type"];
                        $withdraw = $_POST["qty_wh"];
                        $unitID = $_POST["p_unit"];
                        $warning = $_POST["p_waring"];

                        $inStock = $pd->getDetail($opID);
                        if ($inStock['qty'] <= $withdraw) {
                          echo "ตรวจสอบจำนวนการเบิกอีกครั้ง";
                        } else {
                          $status = $wd->insert(
                            $opID,
                            $productID,
                            $productName,
                            $productType,
                            $withdraw,
                            $unitID,
                            $warning
                          );
                          if ($status) {
                            $total = $inStock['qty'] - $withdraw;
                            $result = $wd->updateQTY($opID, $total);
                            if ($result) {
                              echo "<td>" . $productID . "</td>";
                              echo "<td>" . $productName . "</td>";
                              echo "<td>" . $withdraw . "</td>";
                              echo "<td>" . $total . "</td>";
                              echo "<td>" . $warning . "</td>";
                            } else {
                              echo "error";
                            }
                          } else {
                            echo "error";
                          }
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
          $('#qty').val(data.qty);
          $('#type_id').val(data.type_id);
          $('#unit_id').val(data.unit_id);
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