<?php
require_once 'models/Acao.php';
require_once 'models/Drama.php';
require_once 'models/Romance.php';
require_once 'models/Filme.php';
require_once 'models/Comedia.php';
require_once 'models/Outro.php';
require_once 'util/Conexao.php';

class FilmeDAO{
    public  function inserirFilme(Filme $filme){
        $sql = "INSERT INTO filmes (titulo,descricao,duracao,diretor,avaliacao,premios,ano_lancamento,tipo,lancado,genero) 
        VALUES 
        (?,?,?,?,?,?,?,?,?,?)";
        $genero = null;
        if($filme->getTipoBdd() == 'O'){
            $genero = $filme->getTipo();
        }
        $con = Conexao::getConn();
        $stm = $con->prepare($sql);
        $stm->execute(array($filme->getTitulo(),
                            $filme->getDescricao(),
                            $filme->getDuracao(),
                            $filme->getDiretor(),
                            $filme->getAvaliacao(),
                            $filme->getPremios(),
                            $filme->getAnoLancamento(),
                            $filme->getTipoBdd(),
                            $filme->isLancado()? 1 : 0,
                            $genero ));// tava dando bo pq no bdd eu não conseguia tirar do tinyint pra boolean e coloquei assim pq ele considera numero mesmo e deu certo
        
    }
    public function buscarFilmes(string $where = '', array $parametros = []) {
        $sql = "SELECT * FROM filmes " . ($where ? "WHERE $where" : "");
        $con = Conexao::getConn();
        $stm = $con->prepare($sql);
        $stm->execute($parametros);
        return $this->mapFilmes($stm->fetchAll());
    } 
    
    public function excluirFilme($id){
        $sql = "DELETE FROM filmes WHERE id = ?";
        $con = Conexao::getConn();
        $stm = $con->prepare($sql);
        return $stm->execute([$id]);
    }
    private function mapFilmes(array $registros){
        $filmes = array();
        foreach($registros as $reg){
            $filme = null;
            if ($reg['tipo'] == 'R') {
                $filme = new Romance();
            }elseif($reg['tipo'] == 'A'){
                $filme = new Acao();
            }elseif($reg['tipo'] == 'D'){
                $filme = new Drama();
            }elseif($reg['tipo'] == 'C'){
                $filme = new Comedia();
            }elseif($reg['tipo'] == 'O'){
                $filme = new Outro();
                $filme->setNomeGenero($reg['genero']);
            }

            $filme->setId($reg['id']);
            $filme->setTitulo($reg['titulo']);
            $filme->setDescricao($reg['descricao']);
            $filme->setDuracao($reg['duracao']);
            $filme->setDiretor($reg['diretor']);
            $filme->setAvaliacao($reg['avaliacao']);
            $filme->setPremios($reg['premios']);
            $filme->setAnoLancamento($reg['ano_lancamento']);
            $filme->setLancado($reg['lancado']);
            array_push($filmes,$filme);
        }
        return $filmes;
    }
}

?>