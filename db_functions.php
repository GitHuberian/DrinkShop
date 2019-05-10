<?php

class db_functions{
    private $conn;

    function __construct(){
        require_once 'db_connect.php';
        $db =new DB_Connect();
        $this->conn = $db->connect();
    }

    function __destruct(){

    }

    function checkUserExists($phone){
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=?");
        $stmt->bind_param("s", $phone);
        $stmt->execute();
        $stmt->store_result();

        if($stmt->num_rows > 0)
        {
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    public function registerNewUser($phone, $name, $birthdate, $address){
        $stmt = $this->conn->prepare("INSERT INTO user (Phone, Name, Birthdate, Address) VALUES(?,?,?,?)");
        $stmt->bind_param("ssss", $phone, $name, $birthdate, $address);
        $result=$stmt->execute();
        $stmt->close();

        if($result){
            $stmt=$this->conn->prepare("SELECT * FROM user WHERE Phone = ?");
            $stmt->bind_param("s", $phone);
            $stmt->execute();
            $user=$stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        }
        else
        return false;
    }

    public function getUserInformation($phone){
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE Phone=?");
        $stmt->bind_param("s", $phone);

        if($stmt->execute()){
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
            return $user;
        }
        else
            return NULL;
    }

    public function getBanner(){
        $result = $this->conn->query("SELECT * FROM banner ORDER BY IDBanner LIMIT 1");
        $banners = array();

        while($item = $result->fetch_assoc())
            $banners[] = $item;
        return $banners;
        
    }

    public function updateAvatar($phone, $fileName){
        return $result=$this->conn->query("UPDATE user SET avatarUrl='$fileName' WHERE Phone = '$phone'");
    }
    
    public function getMenuCategories(){
        $result = $this->conn->query("SELECT * FROM Menu");
        $menu = array();

        while($item = $result->fetch_assoc())
            $menu[] = $item;
        return $menu;
        
    }

    public function getDrinkByCategoryID($menuId){
        $query = "SELECT * FROM drink WHERE MenuId='".$menuId."'";
        $result = $this->conn->query($query);
        $drinks = array();

        while($item = $result->fetch_assoc())
            $drinks[] = $item;
        return $drinks;
        
    }


}