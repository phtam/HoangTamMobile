<?php
    class DB{

        public $conn;
        protected $servername = "localhost";
        protected $username = "root";
        protected $password = "";
        protected $database = "hoangtam_mobile_db";

        function __construct()
        {
            $this->conn = mysqli_connect( $this->servername, $this->username, $this->password );
            mysqli_select_db( $this->conn, $this->database );
            mysqli_set_charset($this->conn, "utf-8");
        }
    }


?>