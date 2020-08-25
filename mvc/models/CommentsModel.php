<?php 
    class CommentsModel extends DB{

        function GetAllComment(){
            $sql = "SELECT * FROM `comments` JOIN products ON products.pro_id=comments.pro_id";
            $result = mysqli_query($this->conn, $sql);
            return $result; 
        }

        function DeleteComment($id)
        {
            $sql = "DELETE FROM `comments` WHERE cmt_id = $id";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result); 
        }

        function AddComment($name, $email, $content, $date, $id)
        {
            $name = mysqli_real_escape_string($this->conn, $name);
            $email = mysqli_real_escape_string($this->conn, $email);
            $content = mysqli_real_escape_string($this->conn, $content);
            
            $sql = "INSERT INTO `comments`(`cmt_name`, `cmt_email`, `cmt_content`, `cmt_date`, `pro_id`) VALUES ('$name', '$email', '$content', '$date', $id)";
            $result = mysqli_query($this->conn, $sql);
            return json_encode($result); 
        }

        function GetCommentOfProduct($id)
        {
            $sql = "SELECT * FROM `comments` WHERE `pro_id`= $id LIMIT 0,10";
            $result = mysqli_query($this->conn, $sql);
            return $result; 
        }
    
    }

?>