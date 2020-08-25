<?php
    class SaleModel extends DB{

        public function AddSale($name, $content, $startDate, $endDate, $poster){
            $sql= "INSERT INTO `sale`(`sal_name`, `sal_content`, `sal_start_date`, `sal_end_date`, `sal_poster`) VALUES ('$name', '$content', '$startDate', '$endDate', '$poster')";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        public function DeleteSale($id){
            $sql = "DELETE FROM `sale` WHERE `sal_id`=$id";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        public function UpdateSale($id, $name, $content, $startDate, $endDate, $poster){
            $sql= "UPDATE `sale` SET `sal_name`= '$name', `sal_content`= '$content', `sal_start_date`= '$startDate', `sal_end_date`= '$endDate', `sal_poster`='$poster' WHERE `sal_id`= $id";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
        }

        public function GetAllSale(){
            $sql = "SELECT * FROM `sale`";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function GetDetail($id){
            $sql = "SELECT * FROM `sale` WHERE `sal_id`=$id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

        public function display_HotDeal(){
            $sql = "SELECT * FROM `sale` ORDER BY sal_id DESC LIMIT 0,1"; 
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function GetTop3Sale(){
            $sql = "SELECT * FROM `sale` ORDER BY sal_id DESC LIMIT 0,3";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

    }

?>