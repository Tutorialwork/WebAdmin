<?php

class UUIDResolver{

    public $row_history;
    public $username;

    public function __construct($uuid){
        $json = file_get_contents("https://api.mojang.com/user/profiles/".str_replace("-", "", $uuid)."/names");
        $array = json_decode($json);
        $this->row_history = $array;
        $this->username = end($array)->name;
    }

}