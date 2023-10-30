<?php 

class ProductModel {

    private $db;

    public function __construct(){

        require_once './config_db/db.php';
        $conn = new db();
        $this->db = $conn->connection();

    }

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