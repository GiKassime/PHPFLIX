<?php
require_once  'Filme.php';
class Outro extends Filme {
    private string $nomeGenero;

    public function getTipo(): string {
        return $this->nomeGenero;
    }
    public function getTipoBdd(): string {
        return 'O';
    }

    public function setNomeGenero($nomeGenero) {
        $this->nomeGenero = $nomeGenero;
    }
}
