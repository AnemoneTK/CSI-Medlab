<?php
    require_once "../../../DB/connect.php";

    $id = $_GET['pID'];
    $sql = "SELECT * FROM order_product
            INNER JOIN product_type ON order_product.type_id = product_type.type_id
            -- INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON order_product.unit_id = unit.unitID
            WHERE order_id = '{$id}'";
    
    $rs = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($rs);
    $json = json_encode($row);

    echo $json;
?>