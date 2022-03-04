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
                $stmt = DB::getInstance()->query('SELECT id,email,name,role,password,permission FROM user WHERE id='.$id.'');
                $result=$stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }catch(PDOException $e){
                echo "Not exexuted user query";
            }
        }

        static function allUserDetails(){
            try{
                $stmt = DB::getInstance()->query('SELECT id,email,name,role,password,permission FROM user WHERE role!="admin"');
                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(PDOException $e){
                echo "Not exexuted user query ".$e;
            }
        }

        static function approveUser($eId){
            try{
                $stmt = DB::getInstance()->query('UPDATE user SET permission="approved" WHERE id='.$eId.'');
                $stmt->execute();
            }catch(PDOException $e){
                echo "Not exexuted user query ".$e;
            }
        }

        static function deleteUser($eId){
            try{
                $stmt = DB::getInstance()->query('DELETE FROM user WHERE id='.$eId.'');
                $stmt->execute();
            }catch(PDOException $e){
                echo "Not exexuted user query ".$e;
            }
        }

        static function blockUser($eId){
            try{
                $stmt = DB::getInstance()->query('UPDATE user SET permission="blocked" WHERE id='.$eId.'');
                $stmt->execute();
            }catch(PDOException $e){
                echo "Not exexuted user query ".$e;
            }
        }

        //Products queries
        static function getProducts(){
            try{
                $stmt = DB::getInstance()->query('SELECT product_id, product_image, product_name, category, subcategory, price FROM products');
                $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }catch(PDOException $e){
                echo "Not exexuted user query ".$e;
            }
        }

        static function deleteProduct($prId){
            try{
                $stmt = DB::getInstance()->query('DELETE FROM products WHERE product_id='.$prId.'');
                $stmt->execute();
            }catch(PDOException $e){
                echo "Not exexuted user query ".$e;
            }
        }

        static function allproducts(){
            $users=self::getProducts();
            $head='<thead>
                        <tr>
                        <th scope="col">Product Image</th>
                        <th scope="col">Product Id</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Subcategory</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            $row='';
            foreach($users as $key => $value){
                $row .=' <tr>
                            <td>'.$value['product_image'].'</td>
                            <td>'.$value['product_id'].'</td>
                            <td>'.$value['product_name'].'</td>
                            <td>'.$value['category'].'</td>
                            <td>'.$value['subcategory'].'</td>
                            <td>'.$value['price'].'</td>
                            <td>
                                <a type="button" class="btn-sm btn-primary">Edit</a>&nbsp;
                                <a type="button" href="?currentSection=Products&eAction=deleteProduct&prId='.$value['product_id'].'" class="btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>';
                                
            }
                   
            return $head.$row."</tbody>";
        }

        static function allUsers(){
            $users=self::allUserDetails();
            $head='<thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Permission</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            $row='';
            foreach($users as $key => $value){
                $row .=' <tr>
                            <td>'.$value['id'].'</td>
                            <td>'.$value['name'].'</td>
                            <td>'.$value['email'].'</td>
                            <td>'.$value['password'].'</td>
                            <td>'.$value['role'].'</td>
                            <td>'.$value['permission'].'</td>
                            <td><a type="button" class="btn-sm btn-primary">Edit</a>&nbsp;';
                if($value['permission']=="approved"){
                    $row .='<a type="button" href="?currentSection=Users&eAction=blockUser&eId='.$value['id'].'" class="btn-sm btn-warning">Block</a>&nbsp;';
                }else{
                    $row .='<a type="button" href="?currentSection=Users&eAction=approveUser&eId='.$value['id'].'" class="btn-sm btn-success">Approve</a>&nbsp;';
                }
                $row .='<a type="button" href="?currentSection=Users&eAction=deleteUser&eId='.$value['id'].'" class="btn-sm btn-danger">Delete</a></td></tr>';
                                
            }
                   
            return $head.$row."</tbody>";
        }

        static function myProfile($id){
            $user=self::currentUserDetails($id);
            $profile='<thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Permission</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>'.$user['id'].'</td>
                        <td>'.$user['name'].'</td>
                        <td>'.$user['email'].'</td>
                        <td>'.$user['password'].'</td>
                        <td>'.$user['role'].'</td>
                        <td>'.$user['permission'].'</td>
                        <td><a type="button" class="btn-sm btn-outline-primary">Edit</a></td>
                    </tr>
                    </tbody>';
            return $profile;
        }

        static function userProfileEditForm(){
            $form='<form class="form-inline" method="POST">
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="editUserName" class="sr-only">New Name</label>
                            <input type="text" class="form-control" id="editUserName">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="userPassword" class="sr-only">New Password</label>
                            <input type="password" class="form-control" id="userPassword" placeholder="New password">
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="userPassword" class="sr-only">Confirm New Password</label>
                            <input type="password" class="form-control" id="userEmail" placeholder="New password">
                        </div>
                        <button type="submit" class="btn btn-primary m-3">Update</button>
                    </form>';
            return $form;
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
                        <a class="nav-link" href="?currentSection=Users">
                        <span data-feather="users"></span>
                        Users
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

        static function searchAddProductSection(){
            $html ='<form class="row row-cols-lg-auto g-3 align-items-center">
                        <div class="col-12">
                        <label class="visually-hidden" for="inlineFormInputGroupUsername">Search</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Enter id,name...">
                        </div>
                        </div>
                        <div class="col-12">
                        <button type="button" class="btn btn-primary">Search</button>
                        </div>
                        <div class="col-12">
                        <a class="btn btn-success" href="add-product.html">Add Product</a>
                        </div>
                    </form>';
            return $html;
        }
    }