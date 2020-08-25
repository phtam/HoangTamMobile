<?php 
    class PaymentModel extends DB{

        public function GetAllPayment(){
            $sql = "SELECT * FROM `payments`";
            
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

        function AddPayment($name)
        {
            $sql = "INSERT INTO `payments`(`pay_name`) VALUES ('$name')";

            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

        function GetDetailPayment($payID)
        {
            $sql = "SELECT * FROM `payments` WHERE `pay_id`= $payID";
            
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

        function UpdatePayment($payID, $name)
        {
            $sql = "UPDATE `payments` SET `pay_name` = '$name' WHERE `pay_id`= $payID";
            
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

        function DeletePayment($payID)
        {
            $sql = "DELETE FROM `payments` WHERE `pay_id`= $payID";
            
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

    }

?>