<?php 

include_once 'app/view/api.view.php';
include_once 'app/model/product.model.php';

class ProductApiController {

    private $model;
    private $view;

    function __construct(){
        $this->model = new ProductModel();
        $this->view = new ApiView();
    }

    function get($params = []){
        $products = $this->model->getAllProducts();
        if(empty($params)){
            return $this->view->response($products, 200);
        }else{
            $product = $this->model->getProductById($params[':ID']);
            if(!empty($product)){
                $this->view->response($product, 200);
            }else{
                $this->view->response(['msg' => 'El producto con el id:' .$params[':ID'] .  'no existe'], 404);
            }
        }
        
    }

}