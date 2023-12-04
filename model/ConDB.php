<?php
//Diferencias entre require

require_once("config.php");

class Connection{
    static public function conect(){
        $con = false;
        try {
            $data = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8";
            $con = new PDO($data,DB_USERNAME,DB_PASSWORD);
        } catch (PDOException $e) {
            $message = array(
                "COD"=> "000",
                "MSN" => ($e)
            );
            echo ($e->getMessage());
        }
        return $con; 
    }
}

?>