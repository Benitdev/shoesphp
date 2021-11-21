<?php 
class Home extends Controller {
    var $HomeModel;
    public function __construct()
    {
        // Call Models
        $this->HomeModel = $this->model("HomeModel");
    }
    public function showHome(){        
        

        // Call Views
        $this->view("home");
    }
}
?>