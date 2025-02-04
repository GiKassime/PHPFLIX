<?php 

abstract class Filme {
    private int $id;
    private string $titulo;
    private bool $lancado;
    private string $diretor;
    private string $duracao;
    private int $anoLancamento;
    private string $descricao;
    private string $premios;
    private float $avaliacao;

    abstract function getTipoBdd(): string;//para o Banco de Dados
    abstract function getTipo();//Para o terminal

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     */
    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of diretor
     */
    public function getDiretor(): string
    {
        return $this->diretor;
    }

    /**
     * Set the value of diretor
     */
    public function setDiretor(string $diretor): self
    {
        $this->diretor = $diretor;

        return $this;
    }

    /**
     * Get the value of anoLancamento
     */
    public function getAnoLancamento(): int
    {
        return $this->anoLancamento;
    }

    /**
     * Set the value of anoLancamento
     */
    public function setAnoLancamento(int $anoLancamento): self
    {
        $this->anoLancamento = $anoLancamento;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of premios
     */
    public function getPremios(): string
    {
        return $this->premios;
    }

    /**
     * Set the value of premios
     */
    public function setPremios(string $premios): self
    {
        $this->premios = $premios;

        return $this;
    }

    /**
     * Get the value of avaliacao
     */
    public function getAvaliacao(): float
    {
        return $this->avaliacao;
    }

    /**
     * Set the value of avaliacao
     */
    public function setAvaliacao(float $avaliacao): self
    {
        $this->avaliacao = $avaliacao;

        return $this;
    }

    /**
     * Get the value of duracao
     */
    public function getDuracao(): string
    {
        return $this->duracao;
    }

    /**
     * Set the value of duracao
     */
    public function setDuracao(string $duracao): self
    {
        $this->duracao = $duracao;

        return $this;
    }

    /**
     * Get the value of lancado
     */
    public function isLancado(): bool
    {
        return $this->lancado;
    }

    /**
     * Set the value of lancado
     */
    public function setLancado(bool $lancado): self
    {
        $this->lancado = $lancado;

        return $this;
    }
}
?>