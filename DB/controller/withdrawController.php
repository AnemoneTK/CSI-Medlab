<?php

class WithdrawController
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
        $withdraw,
        $unitID,
        $warning,
    ) {
        try {
            $sql = "INSERT INTO withdraw(
                op_id, 
                p_id, 
                p_name, 
                type_id, 
                withdraw, 
                unit_id, 
                warning
                )
                VALUES(:op, :id, :pdName, :pdType, 
                        :withdraw, :unitID, :warning)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":op", $opID);
            $stmt->bindParam(":id", $productID);
            $stmt->bindParam(":pdName", $productName);
            $stmt->bindParam(":pdType", $productType);
            $stmt->bindParam(":withdraw", $withdraw);
            $stmt->bindParam(":unitID", $unitID);
            $stmt->bindParam(":warning", $warning);
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

    function updateQTY(
        $op_id,
        $amount
    )
    {
        try {
            $sql = "UPDATE product SET qty=:amount WHERE op_id =:op_id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":op_id", $op_id);
            $stmt->bindParam(":amount", $amount);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // Get product detail for table
    public function getWithdrawHistory()
    {
        try {
            $sql = "SELECT * FROM  withdraw 
            INNER JOIN product_type ON  withdraw.type_id = product_type.type_id
            INNER JOIN unit ON  withdraw.unit_id = unit.unitID";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>