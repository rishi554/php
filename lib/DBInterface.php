<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBInterface
 *
 * @author PHP Developers
 */
interface DBInterface {
    public function setJsonEncode($response);
    public function getJsonEncode();
    public function setJsonDecode($response);
    public function getJsonDecode();
    public function setPostdata();
    public function getPostdata();
    public function getEscapString($string);
    public function SelectSingleRow($table, $condition, $fieldarray = "", $debug = "");
    public function SelectTable($table, $condition = "", $fieldarray = "", $debug = "");
    public function DeleteRecords($table, $col, $value);
    public function InsertRecords($table, $data, $debug = "");
    public function UpdateRecords($table, $condition, $updata, $debug = ""); 
    public function setConfiguration($host,$db,$uid,$password);
    public function getConfiguration();
}
