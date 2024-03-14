<?php

class OrderController
{
    private $database;

    //เชื่อมต่อ Database
    public function __construct($connect)
    {
        $this->database = $connect;
    }

    //Get date from product_type table use for create form
    public function getTypes()
    {
        try {
            $sql = "SELECT * FROM product_type";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Get date from unit table use for create form
    public function getUnit()
    {
        try {
            $sql = "SELECT * FROM unit";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }


    //Create new Order
    public function insert(
        $opID,
        $productID,
        $productName,
        $productType,
        $productDetail,
        $productUse,
        $amount,
        $qtyLimit,
        $unitID,
        $due_date,
        $bf_dueDate,
    ) {
        try {
            $sql = "INSERT INTO order_product(op_id, p_id, p_name, type_id, p_detail, p_use,
                                qty, qty_lmt, unit_id, due_date, bf_dueDate)
                                VALUES(:op, :id, :pdName, :pdType, :pDetail, :pUse,
                                        :amount, :qtylimit, :unitID, :due_date, :bfDueDate)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":op", $opID);
            $stmt->bindParam(":id", $productID);
            $stmt->bindParam(":pdName", $productName);
            $stmt->bindParam(":pdType", $productType);
            $stmt->bindParam(":pDetail", $productDetail);
            $stmt->bindParam(":pUse", $productUse);
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":qtylimit", $qtyLimit);
            $stmt->bindParam(":unitID", $unitID);
            $stmt->bindParam(":due_date", $due_date);
            $stmt->bindParam(":bfDueDate", $bf_dueDate);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function getOrderDetail($ID)
    {
        try {
            $sql = "SELECT * FROM order_product
            INNER JOIN product_type ON order_product.type_id = product_type.type_id

            INNER JOIN unit ON order_product.unit_id = unit.unitID
            WHERE op_id =:id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":id", $ID);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Get product detail for table
    public function getOrderHistory()
    {
        try {
            $sql = "SELECT * FROM order_product 
            INNER JOIN product_type ON order_product.type_id = product_type.type_id
            INNER JOIN unit ON order_product.unit_id = unit.unitID";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>