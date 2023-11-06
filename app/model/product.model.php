<?php 

include_once 'app/model/model.php';

class ProductModel extends Model {

 

    public function getAllProducts(){

        $query = $this->db->prepare('SELECT * FROM products INNER JOIN category ON category.id = products.fk_id_category');

        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getProductById($id){

        $query = $this->db->prepare('SELECT * FROM products WHERE id=?');
    
        $query->execute([$id]);
    
        $product = $query->fetch(PDO::FETCH_OBJ);
    
        return $product;
    }

    public function addProduct($img, $name, $description, $price, $fk_category){
        
        $query = $this->db->prepare('INSERT INTO products (img, name, description, price, fk_id_category) VALUES (?, ?, ?, ?, ?)');

        $query->execute([$img, $name, $description, $price, $fk_category]);

        return $this->db->lastInsertId();
    }

    public function filterOffer($id){

        $query = $this->db->prepare('SELECT * FROM products WHERE offer = ?');
        $query->execute([$id]);
        $productsOfferFilter = $query->fetchAll(PDO::FETCH_OBJ);
        return $productsOfferFilter;
    }

    function updateProduct($name, $description, $price, $id) {    
        $query = $this->db->prepare('UPDATE products SET name = ?, description = ?, price = ? WHERE id = ?');
        $query->execute([$name, $description, $price, $id]);
    }

    public function deleteProductById($id)
    {

        $query = $this->db->prepare('DELETE FROM products WHERE id=?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    public function getProductBySeason($season) {

        $query = $this->db->prepare('SELECT * FROM products WHERE season = ?');
        
        $query->execute([$season]);
        
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $categories;
    }

    public function getCategoryId($season){
 
        $query = $this->db->prepare('SELECT * FROM products AS p INNER JOIN category AS c ON p.fk_id_category = c.id WHERE c.season = ?');

        $query->execute();
    
        $season = $query->fetch(PDO::FETCH_OBJ);
    
        return $season;

    }
    

}