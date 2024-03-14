<?php

class ProductController
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

    public function insertType($productType) {
        try {
            $sql = "INSERT INTO product_type(type_name)
                                VALUES(:typeName)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":typeName", $productType);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function insertUnit($newUnit) {
        try {
            $sql = "INSERT INTO unit(unitName	)
                                VALUES(:unitName)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":unitName", $newUnit);
            $stmt->execute();
            return true;
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

    //Get date from warehouse table use for create form
    public function getLocation()
    {
        try {
            $sql = "SELECT * FROM warehouse";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Create new product 
    public function insert(
        $productID,
        $productName,
        $productType,
        $productDetail,
        $productUse,
        $warehouse_id,
        $amount,
        $qtyLimit,
        $unitID,
        $dueDate,
        $bf_dueDate,
    ) {
        try {
            $sql = "INSERT INTO product(p_id, p_name, type_id,
                                p_detail, p_use, wh_id,
                                qty, qty_lmt, unit_id, due_date, bf_dueDate)
                                VALUES(:id, :pdName, :pdType,
                                        :pdDetail, :pdUse, :whLocation,
                                        :amount, :qtylimit, :unitID, :dueDate, :bfDueDate)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":id", $productID);
            $stmt->bindParam(":pdName", $productName);
            $stmt->bindParam(":pdType", $productType);
            $stmt->bindParam(":pdDetail", $productDetail);
            $stmt->bindParam(":pdUse", $productUse);
            $stmt->bindParam(":whLocation", $warehouse_id);
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":qtylimit", $qtyLimit);
            $stmt->bindParam(":unitID", $unitID);
            $stmt->bindParam(":dueDate", $dueDate);
            $stmt->bindParam(":bfDueDate", $bf_dueDate);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function createType($typeName,){
        try {
            $sql = "INSERT INTO product_type(type_name) VALUES(:type_name)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":type_name", $typeName);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function createUnit($unitName,){
        try {
            $sql = "INSERT INTO unit(unitName) VALUES(:unit_name)";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":unit_name", $unitName);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    


    // Get product detail for table
    public function getProductDetail()
    {
        try {
            $sql = "SELECT * FROM product 
            INNER JOIN product_type ON product.type_id = product_type.type_id
            INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON product.unit_id = unit.unitID";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Get detail from id to edit detail
    function getDetail($ID)
    {
        try {
            $sql = "SELECT * FROM product
            INNER JOIN product_type ON product.type_id = product_type.type_id
            INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON product.unit_id = unit.unitID
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

    //Update Product detail
    function updateProduct(
        $opID,
        $productID,
        $productName,
        $productType,
        $productDetail,
        $productUse,
        $warehouse_id,
        $amount,
        $qtyLimit,
        $unitID,
        $dueDate,
        $bf_dueDate,
    )
    {
        try {
            $sql = "UPDATE product 
                SET 
                op_id=:op_id,
                p_id=:id,
                p_name=:pdName,
                type_id=:pdType,
                p_detail=:pdDetail,
                p_use=:pdUse,
                wh_id=:whLocation,
                qty=:amount,
                qty_lmt=:qtylimit,
                unit_id=:unitID,
                due_date=:dueDate,
                bf_dueDate=:bfDueDate

                WHERE op_id =:op_id ";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":op_id", $opID);
            $stmt->bindParam(":id", $productID);
            $stmt->bindParam(":pdName", $productName);
            $stmt->bindParam(":pdType", $productType);
            $stmt->bindParam(":pdDetail", $productDetail);
            $stmt->bindParam(":pdUse", $productUse);
            $stmt->bindParam(":whLocation", $warehouse_id);
            $stmt->bindParam(":amount", $amount);
            $stmt->bindParam(":qtylimit", $qtyLimit);
            $stmt->bindParam(":unitID", $unitID);
            $stmt->bindParam(":dueDate", $dueDate);
            $stmt->bindParam(":bfDueDate", $bf_dueDate);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function deleteProduct($opID)
    {
        try {
            $sql = "DELETE FROM product WHERE op_id =:op_id";
            $stmt = $this->database->prepare($sql);
            $stmt->bindParam(":op_id", $opID);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function lowStock(){
        try {
            $sql = "SELECT * FROM product 
            INNER JOIN product_type ON product.type_id = product_type.type_id
            INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON product.unit_id = unit.unitID
            WHERE qty<=qty_lmt";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function EXP(){
        try {
            $sql = "SELECT * FROM product 
            INNER JOIN product_type ON product.type_id = product_type.type_id
            INNER JOIN warehouse ON product.wh_id = warehouse.wh_id
            INNER JOIN unit ON product.unit_id = unit.unitID
            WHERE DATEDIFF(due_date, CURRENT_DATE()) <= bf_dueDate";
            return $this->database->query($sql);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
