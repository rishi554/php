<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database
 *
 * @author PHP Developers
 */
class database{
    
    private static $instance = null;
    private $host;
    private $db;
    private $uid;
    private $password;
    private $conn;

    public function __construct() {
        $this->host     = "localhost";
        $this->db       = "practice1";
        $this->uid      = "root";
        $this->password = "tiger";
        $this->setConfiguration($this->host, $this->db, $this->uid, $this->password);
    }
    public function getConfiguration(){
        return $this->conn;
    }
    public function setConfiguration($host,$db,$uid,$password){
        try {
            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $options = [
              PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
              PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
              PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
            ];
            $this->conn = new PDO($dsn, $uid, $password,$options);
        }catch (PDOException $e){
            die("Error!: " . $e->getMessage());
         }
    }
    // The object is created from within the class itself
    // only if the class has no instance.
    public static function getInstance(){
      if (self::$instance == null){
        self::$instance = new database;
      }
      return self::$instance;
    }
}
