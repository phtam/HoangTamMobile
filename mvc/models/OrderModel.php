<?php 
        
    class OrderModel extends DB
    {
        function GetAllOrder()
        {
            $sql = "SELECT * FROM `orders` JOIN payments ON payments.pay_id = orders.pay_id 
            JOIN customers ON customers.cus_username = orders.cus_username";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function GetDetailOrder($orderID)
        {
            $sql = "SELECT * FROM `product_order` JOIN `products` ON products.pro_id = product_order.pro_id WHERE ord_id = $orderID";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function GetPayment($orderID)
        {
            $sql = "SELECT * FROM `orders` JOIN payments ON payments.pay_id = orders.pay_id WHERE orders.ord_id = $orderID ";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function GetCustomer($orderID)
        {
            $sql = "SELECT * FROM `orders` JOIN customers ON customers.cus_username = orders.cus_username WHERE orders.ord_id = $orderID";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function CreateOrder($orderID, $dateCreate, $addressShipped, $status, $payments, $username)   
        {
            $sql = "INSERT INTO `orders`(`ord_id`, `ord_date_create`, `ord_date_shipped`, `ord_address_shipped`, `ord_status`, `pay_id`, `cus_username`)
             VALUES ($orderID, '$dateCreate', '' , '$addressShipped', $status, $payments, '$username')";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function GetIDOrder()
        {
            $sql = "SELECT ord_id FROM `orders` WHERE ord_id = (SELECT MAX(ord_id) FROM `orders`)";
            $result = mysqli_query($this->conn, $sql);
            $row = mysqli_num_rows($result);
            if($row > 0){
                while($row = mysqli_fetch_array($result)){
                    return $row["ord_id"];
                }
            }else{
                return 0;
            }
        }

        function AddProductToBill($productID, $orderID, $quantity, $total )
        {
            $sql = "INSERT INTO `product_order`(`pro_id`, `ord_id`, `pro_ord_quantity`, `pro_ord_total`) 
            VALUES ($productID,$orderID,$quantity,$total)";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function CheckOut($orderID)
        {
            $sql = "SELECT * FROM `orders` WHERE ord_id = $orderID ";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function Pay($orderID)
        {
            $sql= "UPDATE `orders` SET `ord_status`= 1 WHERE ord_id = $orderID ";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function Ship($orderID, $ngaygiao){
            $sql= "UPDATE `orders` SET `ord_date_shipped`= '$ngaygiao' WHERE ord_id = $orderID";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }

        function GetBillsOfCustomer($username)
        {
            $sql = "SELECT * FROM `orders` JOIN payments ON payments.pay_id = orders.pay_id 
            JOIN customers ON customers.cus_username = orders.cus_username WHERE orders.cus_username = '$username'";
            $result = mysqli_query($this->conn, $sql);
            return $result;
        }

        function UpdateAmount($productID, $orderID)
        {
            $sql = "UPDATE `products` SET products.pro_quantity = products.pro_quantity - (SELECT product_order.pro_ord_quantity 
            FROM product_order WHERE product_order.pro_id = $productID AND product_order.ord_id = $orderID ) WHERE products.pro_id = $productID";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result);
        }
        

    }
    

?>