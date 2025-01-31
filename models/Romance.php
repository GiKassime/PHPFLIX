<?php 
require_once  'Filme.php';
class Romance extends Filme{
    public function getTipo() : string{
        return "Romance";
    }
    public function getTipoBdd() : string{
        return "R";
    }
}
?>