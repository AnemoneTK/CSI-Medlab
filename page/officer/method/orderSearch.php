<?php
    require_once "../../../DB/connect.php";

    $w = $_GET['term'];
    $sql = "SELECT p_id FROM product WHERE p_id LIKE '{$w}%' ";
    $rs = mysqli_query($link, $sql);
    $json = array();
    while($row = mysqli_fetch_assoc($rs)){
        $json[] = $row["p_id"];
    }
    mysqli_free_result($rs);
    mysqli_close($link);

    $json = json_encode($json);
    echo $json;
?>