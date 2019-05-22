<?php
require 'database.php';
require 'DBInterface.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib
 *
 * @author PHP Developers
 */
class lib extends database implements DBInterface{ 
    
    private $json_encode;
    private $json_decode;
    private $postdata;
    
    public function __construct() {
        parent::__construct();
    }

    public function DeleteRecords($table, $col, $value) {        
        $query = "DELETE FROM $table WHERE $col : ? ";
        $statement = $this->conn->prepare($query);
        if (!$statement->execute($value)) {
            return false;
        } else {
            return true;
        }
    }

    public function InsertRecords($table, $data, $debug = "") {
        
        foreach ($data as $key => $value) {
            $field[] = $key;
            $iterator[] = "?";
            if (gettype($value) != "integer")
                $values[] = "'$value'";
            else
                $values[] = "$value";
        }
        $f_list = trim(implode(", ", $field));
        $v_list = trim(implode(", ", $values));
        $i_list = trim(implode(", ", $iterator));
        
        $stmt = $this->conn->prepare("INSERT INTO $table (".$f_list.") VALUES (".$i_list.")");
        if ($debug == 1) {
            echo $stmt;
        }
        try {
            $this->conn->beginTransaction();
            $stmt->execute($v_list);
            $this->conn->commit();
            $stmt = null;
            return true;
        }catch (Exception $e){
            $this->conn->rollback();
            throw $e;
        }
    }

    public function SelectSingleRow($table, $condition, $fieldarray = "", $debug = "") {
        
    }

    public function SelectTable($table, $condition = "", $fieldarray = "", $debug = "") {
        
    }

    public function UpdateRecords($table, $condition, $updata, $debug = "") {
        
    }

    public function getEscapString($string) {
        return $this->db->quote($string);
    }

    public function getJsonDecode() {
        return $this->json_decode;
    }

    public function getJsonEncode() {
        return $this->json_encode;
    }

    public function getPostdata() {
        return $this->postdata;
    }

    public function setJsonDecode($response) {
        $this->json_decode = json_decode($response);
    }

    public function setJsonEncode($JsonResponse) {
        $this->json_encode = json_encode($JsonResponse);
    }

    public function setPostdata() {
        $this->postdata = file_get_contents("php://input");
    }

}
