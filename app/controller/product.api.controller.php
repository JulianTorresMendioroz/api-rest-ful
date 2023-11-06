<?php 

include_once 'app/model/product.model.php';
include_once 'app/controller/api.controller.php';

class ProductApiController extends APIController {

    private $model;
    protected $view;


    function __construct(){
        parent::__construct();
        $this->model = new ProductModel();
        
    }

    //capturo params si los hay o no
    function get($params = []) {
        if (empty($params)) {
            $filterOffer = 0;
            if (isset($_GET['offer'])) {
                $filterOffer = $_GET['offer'] == 1;
                $prodsOffer = $this->model->filterOffer($filterOffer);
                if ($prodsOffer) {
                    //Me trae la oferta, pero solo me marca Array (SIN DATOS), para ver si me cumplia la query le puse json_encode
                    //me trae bien el filtro, pero me lo muestra con " / ", el filtro se cumple pero tengo que solucionar que se muestre
                    // de forma correcta en POSTMAN
                    $this->view->response(['msg' => 'Las ofertas de los productos son: ' . json_encode($prodsOffer)], 200);
                } else {
                    $this->view->response(['msg' => 'No hay productos con oferta'], 404);
                }
            } else {
                //si no hay ningun filtro "offer" mando todos los productos
                $products = $this->model->getAllProducts();
                $this->view->response($products, 200);
            }
        } else {
            //y si no hay parametros, busco por el producto por id
            $product = $this->model->getProductById($params[':ID']);
            if (!empty($product)) {
                $this->view->response($product, 200);
            } else {
                $this->view->response(['msg' => 'El producto con el ID: ' . $params[':ID'] . ' no existe'], 404);
            }
        }
    }

    public function create() {
        //traigo los datos del json   
         $body = $this->getData();

         //inserto data en db
         $img = $body->img;
         $name = $body->name;
         $description = $body->description;
         $price = $body->price;
         $fk_category = $body->fk_id_category;

        $id = $this->model->addProduct($img,$name,$description, $price,$fk_category);

        $this->view->response(['msg' => 'El producto se insertó con el id:' . $id], 201);
        

    }
 
    public function update($params = []) {
        $product_id = $params[':ID'];
        $product = $this->model->getProductById($product_id);

        if ($product) {
            $body = $this->getData();

        $name = $body->name;
        $description = $body->description;
        $price = $body->price;
        $this->model->updateProduct($name, $description, $price, $product_id);

            $this->view->response(['msg' => 'El producto con el id:' . $product_id . 'se modificó correctamente'], 200);
        }
        else 
            $this->view->response(['msg' => 'El producto con el id:' . $product_id . 'no se pudo modificar'], 404);
        }


    function delete($params = []){
        //capturo el id
        $product_id = $params[':ID'];
        //me traigo ese producto en especifico
        $product = $this->model->getProductById($product_id);
        //si hay un producto en la db
        if($product){
            //elimino y muestro mensaje 
            $this->model->deleteProductById($product_id);
            $this->view->response(['msg' => 'Se elimino el producto con id:' . $product_id], 200);
        }else{
            //si no muestro mensaje de error 
            $this->view->response(['msg' => 'El producto con el id:' . $product_id . 'no se pudo eliminar'], 404);
        }

    }

}