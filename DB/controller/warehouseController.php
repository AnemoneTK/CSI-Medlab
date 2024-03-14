<?php
class WarehouseController
{
    private $database;

    //เชื่อมต่อ Database
    public function __construct($connect)
    {
        $this->database = $connect;
    }

    public function createWarehouse($whName,){
        try {
            $sql = "INSERT INTO warehouse(wh_name) VALUES(:wh_name)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":wh_name", $whName);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($whName)
    {
        try {
            $sql = "DELETE FROM warehouse WHERE id =:wh_name";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":wh_name", $whName);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getDetail($whName)
    {
        try {
            $sql = "SELECT * FROM warehouse WHERE wh_name =:wh_name";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":wh_name", $whName);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($whName)
    {
        try {
            $sql = "UPDATE warehouse 
                SET wh_name=:wh_name
                WHERE wh_name =:wh_name ";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":wh_name", $whName);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function showWarehouse(){
        try {
            $sql = "SELECT * FROM warehouse";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Get product detail with condition warehouse id
    function getPDinWH($whID)
    {
        try {
            $sql = "SELECT * FROM product
            INNER JOIN product_type ON product.type_id = product_type.type_id
            INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON product.unit_id = unit.unitID
            WHERE warehouse.wh_id = $whID";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insertWarehouse($newWarehouse) {
        try {
            $sql = "INSERT INTO warehouse(wh_name	)
                                VALUES(:wh_name)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":wh_name", $newWarehouse);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
}
?>