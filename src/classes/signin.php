<?php
    session_start();
    require_once("DB.php");
    
    class SignIn extends DB{
        public string $userEmail;
        public string $userPassword;
        function __construct($userEmail,$userPassword)
        {
            $this->userEmail=$userEmail;
            $this->userPassword=$userPassword;
        }
        public function loginUser(){
            if(DB::getInstance()){
                try{
                    isset($_SESSION['currentUser'])?$_SESSION['currentUser']:array();
                    //print_r($_SESSION['currentUser']);
                    $stmt = DB::getInstance()->query('SELECT id,name,role,permission FROM user WHERE email="'.$this->userEmail.'"'.' AND password="'.$this->userPassword.'"');
                    $result=$stmt->fetch(PDO::FETCH_ASSOC);
                      //echo $v['name'].','.$v['role'].','.$v['permission'].'<br>';
                    if($result['permission']=="blocked"){
                        echo"Not authorised to login <br>";
                        session_unset();
                    }else{
                        $_SESSION['currentUser']=$result;
                        header("location:../dashboard.php");
                    }
                    //print_r($_SESSION['currentUser']);
                }catch(PDOException $e){
                    echo "Error:".$e->getMessage();
                }
            }
        }

    }