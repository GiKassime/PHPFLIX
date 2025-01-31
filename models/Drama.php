<?php 
require_once  'Filme.php';
class Drama extends Filme{
    public function getTipoBdd(): string{
        return "D";
    }
    public function getTipo(): string{
        return "Drama";
    }
}
?>