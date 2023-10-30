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

    function getAll(){
        $products = $this->model->getAllProducts();
        return $this->view->response($products, 200);
    }



}