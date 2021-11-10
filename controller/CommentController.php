<?php 

class CommentController extends Controller {

    public function load(){
        $action = ParamUtils::findGETParam('action');
        loadView();
    }

    public function loadView(){
        echo file_get_contents('view/CommentView.php');
    }

    public function getFormInfo(){
        
    }

}

?>