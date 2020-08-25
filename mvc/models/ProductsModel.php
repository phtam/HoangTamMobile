<?php
    class ProductsModel extends DB{


        public function AddProduct($name, $price, $oldPrice, $shortDesc, $Desc, $specifications, $date, $quantity, $brands, $sale){

            $sql = "INSERT INTO `products`(`pro_name`, `pro_price`, `pro_old_price`, `pro_short_desc`, `pro_desc`, `pro_specifications`,
             `pro_date`, `pro_quantity`, `brd_id`, `sal_id`) VALUES  ('$name', $price, $oldPrice, '$shortDesc', '$Desc', '$specifications',
              '$date', $quantity, $brands, $sale)";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        }

  
        public function UpdateProduct($id, $name, $price, $oldPrice, $shortDesc, $Desc, $specifications, $date, $quantity, $brands, $sale){
            $sql = "UPDATE `products` SET `pro_name`= '$name' ,`pro_price`=$price,`pro_old_price`= $oldPrice,`pro_short_desc`='$shortDesc',
            `pro_desc`='$Desc', `pro_specifications`='$specifications', `pro_date`='$date',`pro_quantity`=$quantity,`brd_id`=$brands,`sal_id`=$sale 
            WHERE `pro_id`=$id";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }

            return json_encode($result);
        } 

        public function GetAllProducts(){
            $sql = "SELECT * FROM `products` JOIN `brands` ON products.brd_id=brands.brd_id JOIN `sale` ON products.sal_id=sale.sal_id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function GetDetailProduct($pro_id){
            $sql = "SELECT * FROM `products` JOIN `brands` ON products.brd_id=brands.brd_id 
            JOIN `sale` ON products.sal_id=sale.sal_id WHERE `pro_id`=$pro_id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function deleteProduct($pro_id){
            $sql = "DELETE FROM `products` WHERE `pro_id`=$pro_id";
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }

  
        public function UploadImage($file, $pro_id){
            $sql = "INSERT INTO `product_image`(`img_file_name`, `pro_id`) VALUES ('$file', $pro_id)";
            $result = false;
            if(mysqli_query($this->conn, $sql)){
                $result = true;
            }
            return json_encode($result);
            
        }



        public function GetAllImage(){
            $sql = "SELECT * FROM `product_image` JOIN `products` ON product_image.pro_id=products.pro_id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function GetProductImage($id){
            $sql = "SELECT * FROM `product_image` JOIN `products` ON product_image.pro_id=products.pro_id WHERE products.pro_id=$id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function DeleteImage($img_id){
            $sql = "DELETE FROM `product_image` WHERE `img_id`=$img_id";
            $result = mysqli_query($this->conn, $sql);

            return json_encode($result);
        }


        public function display_NewProducts(){
            $sql = "SELECT products.pro_id, `pro_name`, `pro_price`, `pro_old_price`, `brd_name`, `sal_id`, `img_id`, `img_file_name` FROM `products` 
            JOIN product_image ON product_image.pro_id=products.pro_id JOIN brands ON brands.brd_id=products.brd_id ORDER BY products.pro_id DESC LIMIT 0,10"; 
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }
        
        
        public function display_SaleProducts(){
            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id JOIN brands ON brands.brd_id=products.brd_id
            WHERE sale.sal_id <> 1 ORDER BY sale.sal_id DESC LIMIT 0,11"; 
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

  
        public function display_Sale_Products($brands, $start, $end){
            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id 
            JOIN brands ON brands.brd_id=products.brd_id WHERE sale.sal_id <> 1 AND brands.brd_id = $brands 
            ORDER BY sale.sal_id DESC LIMIT $start,$end"; 

            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function GetProduct_ByBrand($id){
            $sql = "SELECT * FROM `product_image` JOIN `products` ON product_image.pro_id=products.pro_id JOIN brands ON brands.brd_id=products.brd_id  
            JOIN sale ON sale.sal_id=products.sal_id WHERE products.brd_id=$id";
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }

        public function display_SaleProducts_ByBrand($id){
            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id JOIN brands ON brands.brd_id=products.brd_id
            WHERE sale.sal_id <> 1 AND brands.brd_id = $id ORDER BY sale.sal_id DESC LIMIT 0,4"; 
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function display_Detail_ByID($id){
            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id JOIN brands ON brands.brd_id=products.brd_id
            WHERE products.pro_id = $id LIMIT 0,1"; 
            $result = mysqli_query($this->conn, $sql);

            return $result;
        }


        public function Search_All_By_Name($keyword){
            
            $keyword = mysqli_real_escape_string($this->conn, $keyword); // ngăn chặn sql injection

            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id 
            JOIN brands ON brands.brd_id=products.brd_id WHERE products.pro_name LIKE '%$keyword%' LIMIT 0,20";

            
            $result = mysqli_query($this->conn, $sql);

            if(mysqli_num_rows($result) != 0){
                return $result;
            }else{
                return false;
            }
            
        }

        public function Search_All_By_Name_And_Brand($keyword, $brand){

            $keyword = mysqli_real_escape_string($this->conn, $keyword); // ngăn chặn sql injection
            $brand = mysqli_real_escape_string($this->conn, $brand); // ngăn chặn sql injection

            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id 
            JOIN brands ON brands.brd_id=products.brd_id WHERE products.pro_name LIKE '%$keyword%' AND brands.brd_id = $brand LIMIT 0,20";

            $result = mysqli_query($this->conn, $sql);

            if(mysqli_num_rows($result) != 0){
                return $result;
            }else{
                return false;
            }
            
        }

        public function Sort_By_Price($brand, $max, $min, $popular, $ord){

            if($popular == 0){
                $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id 
                JOIN brands ON brands.brd_id=products.brd_id WHERE products.pro_price > $min AND products.pro_price < $max AND brands.brd_id = $brand LIMIT 0,$ord"; 
            }else{
                $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id 
                JOIN brands ON brands.brd_id=products.brd_id WHERE products.pro_price > $min AND products.pro_price < $max AND brands.brd_id = $brand ORDER BY sale.sal_id DESC LIMIT 0,$ord"; 
            }
            
            $result = mysqli_query($this->conn, $sql);

            return $result;
            
        }

        public function SearchDetail($id){
            $sql = "SELECT * FROM `products` JOIN sale ON sale.sal_id=products.sal_id JOIN product_image ON product_image.pro_id=products.pro_id 
            JOIN brands ON brands.brd_id=products.brd_id WHERE products.pro_id = $id";

            $result = mysqli_query($this->conn, $sql);
            return $result;
        }


    }


?>