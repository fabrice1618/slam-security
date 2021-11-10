<?php

class BaseView{

    private $header;
    private $footer;
    private $titlePage;

    public function getHeader(){
        $header = file_get_contents("/element/header.php");
        $header = sprintf($header, $titlePage);
        echo $header;
    }

    public function getFooter(){
        $footer = file_get_contents("/element/footer.php");
        $footer = sprintf($footer,$titlePage);
        echo $footer;
    }

}