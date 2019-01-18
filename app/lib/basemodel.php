<?php
    abstract class BaseModel {
        
        private static $host = DB_HOST;
        private static $db = DB_NAMME;
        private static $user = DB_USER;
        private static $password = DB_PASSWORD;
        private static $instance = FALSE;
        private $dbh;
        private $stmt;
        private $error;
        public function __construct($host = NULL, $db = NULL, $user = NULL, $password = NULL)
        {
            if($host !== NULL) self::$host = $host;
            if($db !== NULL) self::$db = $db;
            if($user !== NULL) self::$user = $user;
            if($password !== NULL) self::$password = $password;
            if(!self::$instance) {
                $this->connectDB();
            }
            return self::$instance;
        }
        public function connectDB() {
            try {
                $dsn = "mysql:host=".self::$host.";dbname=".self::$db;
                $options = [
                    PDO::ATTR_PERSISTENT => true,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ];
                self::$instance = new PDO($dsn, self::$user, self::$password, $options);
                $this->dbh = self::$instance;
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                die($this->error);
            }
        }
        public function query($query)
        {
            # code...
            $this->stmt = $this->dbh->prepare($query);
        }
        public function bind($param, $value, $type = null) 
        {
            # code...
            if(is_null($type)) {
                switch(true) {
                    case is_int($value) : $type = PDO::PARAM_INT;
                                          break;
                    case is_bool($value) : $type = PDO::PARAM_BOOL;
                                           break;
                    case is_null($value) : $type = PDO::PARAM_NULL;
                                           break;
                    default : $type = PDO::PARAM_STR;
                              break;
                    
                }
            }
            $this->stmt->bindValue($param, $value, $type);
        }
        public function execute()
        {
            # code...
            return $this->stmt->execute();
        }
        public function resultSet()
        {
            # code...
            $this->execute();
            return $this->stmt->fetchAll();
        }
        public function single()
        {
            # code...
            $this->execute();
            return $this->stmt->fetch();
        }
        public function rowCount()
        {
            # code...
            return $this->stmt->rowCount();
        }
        
        public function lastInsertId()
        {
            # code...
            return $this->dbh->lastInsertId();
        }
    }
