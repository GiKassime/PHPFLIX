<?php
require_once  'Filme.php';
class Outro extends Filme {
    private $nomeGenero;
    public function getTipo() {
        return $this->nomeGenero;
    }
    public function getTipoBdd(): string {
        return 'O';
    }

   
    

    /**
     * Get the value of nomeGenero
     */
    public function getNomeGenero()
    {
        return $this->nomeGenero;
    }

    /**
     * Set the value of nomeGenero
     */
    public function setNomeGenero($nomeGenero): self
    {
        $this->nomeGenero = $nomeGenero;

        return $this;
    }
}
