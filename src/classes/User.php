<?php
    require_once("DB.php");
    class User extends DB
    {
        public int $user_id;
        public string $username;
        public string $password;
        public string $email;

        public function __construct($username, $password, $email)
        {
            $this->user_id = rand(100,100000);
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
        }

        public function addUser(){
            if(DB::getInstance()){
                $user='INSERT INTO user (id,name,email,password) VALUES ('.$this->user_id.',"'.$this->username.'","'.$this->email.'","'.$this->password.'")';
                if(DB::getInstance()->exec($user)){
                    header("location:index.php");
                }
            }
        }
    }