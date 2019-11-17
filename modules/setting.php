<?php

class Setting{

    public $string;
    public $value;

    public function __construct($string = ""){
        if(!empty($string)){
            require("mysql.php");
            $stmt = $mysql->prepare("SELECT * FROM webadmin_settings WHERE STRING = :string");
            $stmt->execute(array(":string" => $string));
            $row = $stmt->fetch();
            $this->string = $row["STRING"];
            $this->value = $row["VALUE"];
        }
    }

    public function save(){
        if(!empty($this->string) && !empty($this->value)){
            require("mysql.php");
            $stmt = $mysql->prepare("UPDATE webadmin_settings SET VALUE = :key WHERE STRING = :string");
            $stmt->execute(array(":key" => $this->value, ":string" => $this->string));
        }
    }

}