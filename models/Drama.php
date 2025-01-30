<?php 
require_once  'Filme.php';
class Drama extends Filme{
    public function getTipoBdd(){
        return "D";
    }
    public function getTipo(){
        return "Drama";
    }
}
?>