<?php 
require_once  'Filme.php';
class Romance extends Filme{
    public function getTipo(){
        return "Romance";
    }
    public function getTipoBdd(){
        return "R";
    }
}
?>