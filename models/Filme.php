<?php 

abstract class Filme {
    private int $id;
    private string $titulo;
    private string $diretor;
    private int $anoLancamento;
    private string $descricao;
    private string $avaliacao;

    abstract function getTipoBdd();//para o Banco de Dados
    abstract function getTipo();//Para o terminal
}
?>