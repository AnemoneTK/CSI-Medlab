<?php
    require_once "../../../DB/connect.php";

    $w = $_GET['term'];
    $sql = "SELECT order_id FROM order_product WHERE order_id LIKE '{$w}%' ";
    $rs = mysqli_query($link, $sql);
    $json = array();
    while($row = mysqli_fetch_assoc($rs)){
        $json[] = $row["order_id"];
    }
    mysqli_free_result($rs);
    mysqli_close($link);

    $json = json_encode($json);
    echo $json;
?>