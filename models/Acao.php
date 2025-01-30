<?php 
require_once  'Filme.php';
class Acao extends Filme{
    public function getTipo(){
        return "Ação";
    }
    public function getTipoBdd(){
        return "A";
    }
}
?>