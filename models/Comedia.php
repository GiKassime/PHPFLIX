<?php 
require_once  'Filme.php';
class Comedia extends Filme{
    public function getTipo(){
        return "Comédia";
    }
    public function getTipoBdd(){
        return "C";
    }
}
?>