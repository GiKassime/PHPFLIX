<?php 
require_once  'Filme.php';
class Comedia extends Filme{
    public function getTipo() : string{
        return "Comédia";
    }
    public function getTipoBdd(): string{
        return "C";
    }
}
?>