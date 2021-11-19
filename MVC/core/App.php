<?php
class App{

    protected $controller="Home";
    protected $action="product";
    protected $params=[];

    function __construct(){
 
        $this->handleUrl();
       
        require_once "./mvc/controllers/". $this->controller. "Controller". ".php";

        $this->controller = new $this->controller;

        call_user_func_array([$this->controller, $this->action], $this->params );

    }

    function handleUrl(){
        if( isset($_GET["url"]) ){
            $arr = explode("/", filter_var(trim($_GET["url"], "/")));
            //Controller
            if( file_exists("./mvc/controllers/".$arr[0]. "Controller".".php") ){
                $this->controller = $arr[0];
                unset($arr[0]);
            }
            
            // Action
            if(isset($arr[1])){
                if( method_exists( $this->controller , $arr[1]) ){
                    $this->action = $arr[1];
                }
                unset($arr[1]);
            }
    
            // Params
            $this->params = $arr?array_values($arr):[];
        }
    }

}
?>