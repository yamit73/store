<?php
    require_once("DB.php");
    class Helper extends DB{
        static public function signUp($userName,$userEmail,$userPassword,$userConfirmPassword){
            if(($userPassword==$userConfirmPassword) && $userEmail != "" && $userName != ""){
                $usr =new User($userName,$userPassword,$userEmail);
                $usr->addUser();
            }else{
                echo"Enter correct value";
            }
        }

        static public function signIn($userEmail,$userPassword){
            if($userEmail != "" && $userPassword != ""){
                $usr =new SignIn($userEmail,$userPassword);
                $usr->loginUser();
            }else{
                echo"Enter correct value";
            }
        }

        static function userName(){
            if(isset($_SESSION['currentUser'])){
                return $_SESSION['currentUser']['name'];
            }
        }

        static function userRole(){
            if(isset($_SESSION['currentUser'])){
                return $_SESSION['currentUser']['role'];
            }
        }

        static function currentUserDetails($id){
            try{
                $stmt = DB::getInstance()->query('SELECT id,email,name,password FROM user WHERE id='.$id.'');
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }catch(PDOException $e){
                echo "Not exexuted user query";
            }
        }

        static function myProfile($id){
            $user=self::currentUserDetails($id);
            $profile='';
        }
        static function dashboardSideNav($role){
            $userNav='<li class="nav-item">
                        <a class="nav-link" href="?currentSection=My-Profile">
                        <span data-feather="file"></span>
                        My Profile
                        </a>
                    </li>';

            $adminNav='<li class="nav-item">
                        <a class="nav-link" href="?currentSection=Orders">
                        <span data-feather="file"></span>
                        Orders
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?currentSection=Products">
                        <span data-feather="shopping-cart"></span>
                        Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?currentSection=Add-Products">
                        <span data-feather="shopping-cart"></span>
                        Add-Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?currentSection=Customers">
                        <span data-feather="users"></span>
                        Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?currentSection=Reports">
                        <span data-feather="bar-chart-2"></span>
                        Reports
                        </a>
                    </li>';

                    if($role=='admin'){
                        return $adminNav; 
                    }else if($role=='user'){
                        return $userNav; 
                    }
        }

        static function dashboardImportExportSection($role){
            $html='<div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                        </button>
                    </div>';
            if($role=='admin'){
                return $html; 
            }
        }
    }