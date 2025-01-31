<?php 
require_once  'Filme.php';
class Acao extends Filme{
    public function getTipo() : string{
        return "Ação";
    }
    public function getTipoBdd(): string{
        return "A";
    }
}
?>