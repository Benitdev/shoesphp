<?php 
class Home extends Controller {
    var $HomeModel;
    function __construct()
    {
        // Call Models
        $this->HomeModel = $this->model("HomeModel");
    }
    function product(){        
        

        // Call Views
        $this->view("HOME", [
            "data" => "lam on chi tui cach fix bug"
        ]);
    }
}
?>