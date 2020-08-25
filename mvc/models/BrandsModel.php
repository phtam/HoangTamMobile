<?php
    class BrandsModel extends DB{

        public function GetAllBrand(){
            $sql = "SELECT * FROM `brands`";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

        public function GetDetailBrand($id){
            $sql = "SELECT * FROM `brands` WHERE `brd_id`= $id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

        public function AddBrand($name, $desc=""){
            $sql = "INSERT INTO `brands` (`brd_name`, `brd_desc`) VALUES ('$name', '$desc')";
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

        public function UpdateBrand($id, $name, $desc){
            $sql = "UPDATE `brands` SET `brd_name`='$name',`brd_desc`='$desc' WHERE `brd_id`=$id";
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

        public function DeleteBrand($id){
            $sql = "DELETE FROM `brands` WHERE `brd_id`=$id";
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

    }

?>