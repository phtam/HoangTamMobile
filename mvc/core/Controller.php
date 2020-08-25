<?php
    class Controller{

        // Get Model
        public function getModel($model){
            require_once "./mvc/models/".$model.".php";
            return new $model;
        }

        // Get View
        public function getView($view, $data=[]){
            require_once "./mvc/views/".$view.".php";
        }

        // Get BaseURL
        public function getBaseUrl() {
            
            $currentPath = $_SERVER['PHP_SELF'];
        
            $pathInfo = pathinfo($currentPath);
        
            $hostName = $_SERVER['HTTP_HOST'];
        
            $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
        
            return $protocol . '://' . $hostName . $pathInfo['dirname'] . "/";
        }

        // PHP Mailer
        public function getPHPMailer(){
            include('./PHPMailer/class.smtp.php');
            include "./PHPMailer/class.phpmailer.php"; 
        }

    }

?>