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
            if (isset($_GET['offer'])) {
                $filterOffer = $_GET['offer'] == 1;
                $prodsOffer = $this->model->filterOffer($filterOffer);
                
                if (!empty($prodsOffer)) {
                    //la consulta se cumple perfecto, pero si no le pongo el json enconde me trae solo (Array)
                    //en cambio asi, pude verificar que la consulta se hizo correctamente pero lo muestra separados con /
                    //por los dos json encode de el router y este
                    $this->view->response(['msg' => 'Las ofertas de los productos son: ' . json_encode($prodsOffer)], 200);
                } else {
                    $this->view->response(['msg' => 'No hay productos con oferta'], 404);
                }
            } else {
                // si no hay parametro == offer, mando todos los prods
                $products = $this->model->getAllProducts();
                $this->view->response($products, 200);
            }
        } else {
            // si no se cumplio/pidieron offer y allprods ordeno
            if (isset($_GET['price']) && isset($_GET['asc'])) {
                $sort = $_GET['price'];
                $asc = $_GET['asc'];
                
                if ($sort == 'price' && ($asc == 'asc')) {
                    $filterASCProducts = $this->model->getPriceASC($sort, $asc);
                    $this->view->response(['msg' => 'El precio de los productos en forma ASCENDETE son: ' . ($filterASCProducts)], 200);
                } else {
                    $this->view->response(['msg' => 'Los parametros no son validos'], 400);
                }
            } else {
                // si no hay parametros validos, busco el producto por id
                $product = $this->model->getProductById($params[':ID']);
                if (!empty($product)) {
                    $this->view->response($product, 200);
                } else {
                    $this->view->response(['msg' => 'El producto con el ID: ' . $params[':ID'] . ' no existe'], 404);
                }
            }
        }
    }
    
    function create() {
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
 
    function update($params = []) {
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
