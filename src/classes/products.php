<?php
    require_once("DB.php");
    class Product extends DB
    {
        public int $product_id;
        public string $product_name;
        public string $product_image;
        public string $category;
        public string $subcategory;
        public int $price;

        public function __construct($product_name, $product_image, $category,$subcategory,$price)
        {
            $this->product_id = rand(100,100000);
            $this->product_name = $product_name;
            $this->product_image = $product_image;
            $this->category = $category;
            $this->subcategory = $subcategory;
            $this->price = $price;
        }

        public function addProduct(){
            if(DB::getInstance()){
                $product='INSERT INTO products (product_id,product_name,product_image,category,subcategory,price)
                         VALUES ('.$this->product_id.',"'.$this->product_name.'","'.$this->product_image.'","'.$this->category.'","'.$this->subcategory.'",'.$this->price.')';
                DB::getInstance()->exec($product);
            }
        }
    }