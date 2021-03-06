<?php
namespace App;

require_once("DB.php");
class Helper extends DB
{
    /**
     * To signup a user
     *
     * @param [type] $userName
     * @param [type] $userEmail
     * @param [type] $userPassword
     * @param [type] $userConfirmPassword
     * @return void
     */
    public static function signUp($userName, $userEmail, $userPassword, $userConfirmPassword)
    {
        if (($userPassword==$userConfirmPassword) && $userEmail != "" && $userName != "") {
            $usr =new User($userName, $userPassword, $userEmail);
            $usr->addUser();
        } else {
            echo"Enter correct value";
        }
    }

    /**
     * To sign in a user
     *
     * @param [type] $userEmail
     * @param [type] $userPassword
     * @return void
     */
    public static function signIn($userEmail, $userPassword)
    {
        if ($userEmail != "" && $userPassword != "") {
            $usr =new SignIn($userEmail, $userPassword);
            $usr->loginUser();
        } else {
            echo"Enter correct value";
        }
    }

    /**
     * To get name of the current user
     *
     * @return void
     */
    public static function userName()
    {
        if (isset($_SESSION['currentUser'])) {
            return $_SESSION['currentUser']['name'];
        }
    }

    /**
     * To get role of user
     *
     * @return void
     */
    public static function userRole()
    {
        if (isset($_SESSION['currentUser'])) {
            return $_SESSION['currentUser']['role'];
        }
    }

    /**
     * Current user details
     *
     * @param [type] $id
     * @return void
     */
    public static function currentUserDetails($id)
    {
        try {
            $stmt = DB::getInstance()->query('SELECT id,email,name,role,password,permission FROM user WHERE id='.$id.'');
            $result=$stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query";
        }
    }

    //Admin queries
    //query related to queries

    /**
     * Get all the users from database
     *
     * @return void
     */
    public static function allUserDetails()
    {
        try {
            $stmt = DB::getInstance()->query('SELECT id,email,name,role,password,permission FROM user WHERE role!="admin"');
            $result=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    /**
     * To approve a user for login
     *
     * @param [type] $eId
     * @return void
     */
    public static function approveUser($eId)
    {
        try {
            $stmt = DB::getInstance()->query('UPDATE user SET permission="approved" WHERE id='.$eId.'');
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }

    /**
     * To delete a user from user table
     *
     * @param [type] $eId
     * @return void
     */
    public static function deleteUser($eId)
    {
        try {
            $stmt = DB::getInstance()->query('DELETE FROM user WHERE id='.$eId.'');
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }

    /**
     * To block a user from login
     */
    public static function blockUser($eId)
    {
        try {
            $stmt = DB::getInstance()->query('UPDATE user SET permission="blocked" WHERE id='.$eId.'');
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    
    /**
     * To edit user profile
     *
     * @param [type] $editMyProfileId
     * @param [type] $newPassword
     * @param [type] $newConfirmPassword
     * @param [type] $newUserName
     * @return void
     */
    public static function editMyProfile($editMyProfileId, $newPassword, $newConfirmPassword, $newUserName)
    {
        if (($newPassword==$newConfirmPassword) && $newUserName != "") {
            try {
                $stmt = DB::getInstance()->query('UPDATE user SET name="'.$newUserName.'", password="'.$newPassword.'" WHERE id='.$editMyProfileId.'');
                $stmt->execute();
            } catch (\PDOException $e) {
                echo "Not exexuted user query ".$e;
            }
            
        } else {
            echo"Enter correct value";
        }
    }

    //Products queries

    /**
     * To add product in Product constructor
     *
     * @param [type] $productName
     * @param [type] $productImage
     * @param [type] $productCategory
     * @param [type] $productSubCategory
     * @param [type] $productListPrice
     * @param [type] $productPrice
     * @return void
     */
    public static function addProduct($productName, $productImage, $productCategory, $productSubCategory, $productListPrice, $productPrice)
    {
        if ($productName!="" && $productImage!="" && $productImage != "" && $productCategory != "" && $productSubCategory != "" && $productPrice != "" && $productListPrice != "") {
            $pr =new Product($productName, $productImage, $productCategory, $productSubCategory, $productListPrice, $productPrice);
            $pr->addProduct();
        } else {
            echo"Fields should not be empty";
        }
    }

    /**
     * To get all the products in admin area
     *
     * @param [type] $offset
     * @return void
     */
    public static function getProducts($offset)
    {
        try {
            $stmt = DB::getInstance()->query('SELECT product_id, product_image, product_name, category, subcategory, price,list_price FROM products LIMIT 5 OFFSET '.$offset.'');
            $result=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    
    /**
     * To delete product form
     *
     * @param [type] $prId
     * @return void
     */
    public static function deleteProduct($prId)
    {
        try {
            $stmt = DB::getInstance()->query('DELETE FROM products WHERE product_id='.$prId.'');
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }

    /**
     * Function to get orders in database
     *
     * @return array
     */
    public static function getOrders()
    {
        try {
            $stmt = DB::getInstance()->query('SELECT * FROM orders');
            $result=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }

    /**
     * Fuction to approve the order
     *
     * @param [type] $orId
     * @return void
     */

    public static function approveOrder($orId)
    {
        $date=date("Y-m-d");
        try {
            $stmt = DB::getInstance()->query('UPDATE orders SET status="approved", order_date="'.$date.'" WHERE order_id='.$orId.'');
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    /**
     * To mark status of order as delivered
     *
     * @param [type] $orId
     * @return void
     */
    public static function orderDelivered($orId)
    {
        $date=date("Y-m-d");
        try {
            $stmt = DB::getInstance()->query('UPDATE orders SET status="delivered", delivery_date="'.$date.'" WHERE order_id='.$orId.'');
            $stmt->execute();
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }

    /**
     * Function to display all orders of
     *
     * @param [type] $products
     * @return html table
     */
    public static function allOrders($orders)
    {
        $head='<thead>
                    <tr>
                    <th scope="col">Order Id</th>
                    <th scope="col">User Id</th>
                    <th scope="col">first Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Shipping Address Price</th>
                    <th scope="col">Country</th>
                    <th scope="col">State</th>
                    <th scope="col">Pin</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Delivery Date</th>
                    </tr>
                </thead>
                <tbody>';
        $row='';
        foreach ($orders as $key => $value) {
            $row .=' <tr>
                        <td>'.$value['order_id'].'</td>
                        <td>'.$value['user_id'].'</td>
                        <td>'.$value['first_name'].'</td>
                        <td>'.$value['last_name'].'</td>
                        <td>'.$value['email'].'</td>
                        <td>'.$value['status'].'</td>
                        <td>'.$value['shipping_address'].'</td>
                        <td>'.$value['country'].'</td>
                        <td>'.$value['state'].'</td>
                        <td>'.$value['shipping_pincode'].'</td>
                        <td>'.$value['order_date'].'</td>
                        <td>'.$value['delivery_date'].'</td>';
            if ($value['status']=='pending') {
                $row .= '<td><a type="button" href="?currentSection=Orders&eAction=approveOrder&orId='.$value['order_id'].'" class="btn-sm btn-warning">Approve</a></td>
                        </tr>';
            } elseif ($value['status']=='approved') {
                $row .= '<td><a type="button" href="?currentSection=Orders&eAction=delivered&orId='.$value['order_id'].'" class="btn-sm btn-success">Deliver</a></td>
                        </tr>';
            }
                            
        }
                
        return $head.$row."</tbody>";
    }
    /**
     * To display all product to admin
     *
     * @param [type] $products
     * @return void
     */
    public static function allproducts($products)
    {
        $head='<thead>
                    <tr>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Subcategory</th>
                    <th scope="col">Price</th>
                    <th scope="col">List Price</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>';
        $row='';
        foreach ($products as $key => $value) {
            $row .=' <tr>
                        <td>'.$value['product_image'].'</td>
                        <td>'.$value['product_id'].'</td>
                        <td>'.$value['product_name'].'</td>
                        <td>'.$value['category'].'</td>
                        <td>'.$value['subcategory'].'</td>
                        <td>'.$value['price'].'</td>
                        <td>'.$value['list_price'].'</td>
                        <td>
                            <a type="button" href="?currentSection=Products&eAction=deleteProduct&prId='.$value['product_id'].'" class="btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>';
                            
        }
                
        return $head.$row."</tbody>";
    }
    /**
     * To display all users to admin
     *
     * @return void
     */
    public static function allUsers()
    {
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
        foreach ($users as $key => $value) {
            $row .=' <tr>
                        <td>'.$value['id'].'</td>
                        <td>'.$value['name'].'</td>
                        <td>'.$value['email'].'</td>
                        <td>'.$value['password'].'</td>
                        <td>'.$value['role'].'</td>
                        <td>'.$value['permission'].'</td>
                        <td><a type="button" class="btn-sm btn-primary">Edit</a>&nbsp;';
            if ($value['permission']=="approved") {
                $row .='<a type="button" href="?currentSection=Users&eAction=blockUser&eId='.$value['id'].'" class="btn-sm btn-warning">Block</a>&nbsp;';
            } else {
                $row .='<a type="button" href="?currentSection=Users&eAction=approveUser&eId='.$value['id'].'" class="btn-sm btn-success">Approve</a>&nbsp;';
            }
            $row .='<a type="button" href="?currentSection=Users&eAction=deleteUser&eId='.$value['id'].'" class="btn-sm btn-danger">Delete</a></td></tr>';
                            
        }
                
        return $head.$row."</tbody>";
    }

    /**
     * To display all profile of current user
     *
     * @param [type] $id
     * @return void
     */

    public static function myProfile($id)
    {
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
                    <td><a href="?currentSection=My-Profile&action=editMyProfile" class="btn-sm btn-outline-primary">Edit</a></td>
                </tr>
                </tbody>';
        return $profile;
    }

    /**
     * To display edit user form to user
     *
     * @return void
     */

    public static function userProfileEditForm()
    {
        $form='<form class="form-inline" method="POST">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="editUserName" class="sr-only">New Name</label>
                        <input type="text" class="form-control" name="newUserName" id="newUserName">
                        <input type="hidden" name="editMyProfileId" value="'.$_SESSION['currentUser']['id'].'">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="userPassword" class="sr-only">New Password</label>
                        <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="New password">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="userPassword" class="sr-only">Confirm New Password</label>
                        <input type="password" class="form-control" name="newConfirmPassword" id="newConfirmPassword" placeholder="New password">
                    </div>
                    <button type="submit" name="eAction" value="editProfile" class="btn btn-primary m-3">Update</button>
                </form>';
        return $form;
    }

    /**
     * To display side nav to admin and user accordingly
     *
     * @param [type] $role
     * @return void
     */
    public static function dashboardSideNav($role)
    {
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

        if ($role=='admin') {
            return $adminNav;
        } elseif ($role=='user') {
            return $userNav;
        }
    }

    /**
     * Import export section when admin is logged in
     *
     * @param [type] $role
     * @return void
     */
    public static function dashboardImportExportSection($role)
    {
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
        if ($role=='admin') {
            return $html;
        }
    }

    /**
     * Search product section to admin
     *
     * @return void
     */
    public static function searchProductSection()
    {
        $html ='<form method="POST" class="row row-cols-lg-auto g-3 align-items-center">
                    <div class="col-12">
                    <label class="visually-hidden" for="searchProduct">Search</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchTxt" name="searchTxt" placeholder="Enter name, category, subcategory...">
                    </div>
                    </div>
                    <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="eAction" value="search">Search</button>
                    </div>
                </form>';
        return $html;
    }

    /**
     * Add product form to admin in products section
     *
     * @return void
     */
    public static function addProductSection()
    {
        $html ='<form method="POST" class="row row-cols-lg-auto g-3 align-items-center mt-2" enctype="multipart/form-data">
                    <div class="col-12 ">
                        <label class="visually-hidden" for="productName">Product Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="productName" id="productName" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="productImage">Product Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="productImage" id="productImage">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="productName">Product Category</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="productCategory" id="productCategory" placeholder="Enter category">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="productSubCategory">productImage</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="productSubCategory" id="productSubCategory" placeholder="Enter sub category">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="productListPrice">productImage</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="productListPrice" id="productListPrice" placeholder="Enter list price">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="visually-hidden" for="productPrice">productImage</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="productPrice" id="productPrice" placeholder="Enter list price">
                        </div>
                    </div>
                        <div class="col-12">
                        <button class="btn btn-success" name="eAction" value="addProduct">Add Product</button>
                    </div>
                </form>';
        return $html;
    }
}
