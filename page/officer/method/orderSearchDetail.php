<?php
    require_once "../../../DB/connect.php";

    $id = $_GET['p_ID'];
    $sql = "SELECT * FROM product
            INNER JOIN product_type ON product.type_id = product_type.type_id
            -- INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON product.unit_id = unit.unitID
            WHERE p_id = '{$id}'";
    
    $rs = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($rs);
    $json = json_encode($row);

    echo $json;
?>