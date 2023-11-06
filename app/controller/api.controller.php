<?php 

include_once 'app/view/api.view.php';

abstract class APIController {

    protected $view;
    private $data;

    public function __construct() {
        $this->view = new ApiView();
        //leo los datos del body
        $this->data = file_get_contents("php://input"); 
    }

    function getData(){ 
        //return json de data
        return json_decode($this->data); 
    } 




}