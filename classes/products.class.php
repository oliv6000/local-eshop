<?php
include_once '../classes/db.class.php';
// user extends from class DB, so that we can use the database connection made in the DB class
class Products extends DB {

    public function getProduct($id) {
        $productData = DB::selectFirst("SELECT * FROM products WHERE id = ?", [$id]);
        return $productData;
    }
    
    public function getProducts() {
        $products = DB::selectAll("SELECT * FROM products WHERE archived=0");
        return $products;
    }

    public function getNonDiscountProducts() {
        $products = DB::selectAll("SELECT * FROM products WHERE archived=0 AND discount_percentage IS NULL");
        return $products;
    }

    public function getDiscountedProducts() {
        $products = DB::selectAll("SELECT * FROM products WHERE archived=0 AND discount_percentage IS NOT NULL");
        return $products;
    }

    public function getArchivedProducts() {
        $archivedProducts = DB::selectAll("SELECT * FROM products WHERE archived=1");
        return $archivedProducts;
    }

    public function createProduct($name, $price, $description) {
        $productCreated = DB::insert("INSERT INTO products(name, price, description) values(?,?,?)", [$name, (double)$price, $description]);
        return $productCreated;
    }

    public function updateProductInfo($product_id, $name, $price, $description) {
        $ProductInfoUpdated = DB::update("UPDATE products SET name=?, price=?, description=? WHERE id=?", [$name, $price, $description, $product_id]);
        return $ProductInfoUpdated;
    }

    public function archiveProduct($product_id) {
        $productArchived = DB::update("UPDATE products SET archived=1 WHERE id=?", [$product_id]);
        return $productArchived;
    }

    public function unarchiveProduct($product_id) {
        $productUnarchived = DB::update("UPDATE products SET archived=0 WHERE id=?", [$product_id]);
        return $productUnarchived;
    }

    public function discountProduct($product_id, $discount_amount) {
        $productDiscounted = DB::update("UPDATE products SET discount_percentage=? WHERE id=?", [$discount_amount, $product_id]);
        return $productDiscounted;
    }

    public function removeDiscountOnProduct($product_id) {
        $discountRemovedOnProduct = DB::update("UPDATE products SET discount_percentage=NULL WHERE id=?", [$product_id]);
        return $discountRemovedOnProduct;
    }

}