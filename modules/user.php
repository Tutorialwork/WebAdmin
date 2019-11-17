<?php

class User{

    public $uuid;
    public $name;
    public $password;
    public $firstjoin;
    public $lastjoin;
    public $onlinetime;
    public $ip;
    public $status;

    public function __construct($username = "", $uuid = ""){
        if(!empty($username)){
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM webadmin_players WHERE NAME = :name");
            $stmt->execute(array(":name" => $username));
            if($stmt->rowCount() != 0){
                $row = $stmt->fetch();
                $this->uuid = $row["UUID"];
                $this->name = $row["NAME"];
                $this->password = $row["WEB_PASSWORD"];
                $this->firstjoin = $row["FIRSTJOIN"];
                $this->lastjoin = $row["LASTJOIN"];
                $this->onlinetime = $row["ONLINETIME"];
                $this->ip = $row["IP"];
                $this->status = $row["STATUS"];
            }
        } else if(!empty($uuid)){
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM webadmin_players WHERE UUID = :name");
            $stmt->execute(array(":name" => $uuid));
            if($stmt->rowCount() != 0){
                $row = $stmt->fetch();
                $this->uuid = $row["UUID"];
                $this->name = $row["NAME"];
                $this->password = $row["WEB_PASSWORD"];
                $this->firstjoin = $row["FIRSTJOIN"];
                $this->lastjoin = $row["LASTJOIN"];
                $this->onlinetime = $row["ONLINETIME"];
                $this->ip = $row["IP"];
                $this->status = $row["STATUS"];
            }
        }
    }

    public function checkAuth(){
        session_start();
        if(!isset($_SESSION["webadmin_user"])){
            header("Location: login.php");
            exit;
        }
    }

    public function fetchAll(){
        require("mysql.php");
        $players = array();
        $stmt = $mysql->prepare("SELECT * FROM webadmin_players ORDER BY STATUS DESC");
        $stmt->execute();
        while($row = $stmt->fetch()){
            array_push($players, $row["UUID"]);
        }
        return $players;
    }
    
    public function fetchByQuery($query){
        require("mysql.php");
        $players = array();
        $stmt = $mysql->prepare("SELECT * FROM webadmin_players WHERE NAME LIKE :key");
        $key = "%".$query."%";
        $stmt->execute(array(":key" => $key));
        while($row = $stmt->fetch()){
            array_push($players, $row["UUID"]);
        }
        return $players;
    }

    public function fetchAllOnline(){
        require("mysql.php");
        $players = array();
        $stmt = $mysql->prepare("SELECT * FROM webadmin_players WHERE STATUS = 1");
        $stmt->execute();
        while($row = $stmt->fetch()){
            array_push($players, $row["UUID"]);
        }
        return $players;
    }

}