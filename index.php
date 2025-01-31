<?php
require_once  './dao/FilmeDAO.php';
require_once   'models/Acao.php';
require_once   'models/Comedia.php';
require_once   'models/Drama.php';
require_once   'models/Romance.php';
require_once   'util/Conexao.php';
//FUNÇÕESS
function buscaAvancada()
{
    $filmeDao = new FilmeDAO();

    do {
        echo "****************************************\n";
        echo "*           BUSCA AVANÇADA             *\n";
        echo "****************************************\n";
        echo "* 1 - BUSCAR POR ID                    *\n";
        echo "* 2 - BUSCAR POR ANO DE LANÇAMENTO     *\n";
        echo "* 3 - VER DA MAIOR PARA MENOR AVALIAÇÃO*\n";
        echo "* 4 - VER POR GÊNERO                   *\n";
        echo "* 0 - VOLTAR AO MENU PRINCIPAL         *\n";
        echo "****************************************\n";
        $resposta = readline("Digite sua resposta: ");

        switch ($resposta) {
            case 1:
                $filmes = $filmeDao->listarFilmes();
                listarFilmes($filmes);
                $id = readline("Digite o ID do filme: ");
                $filmeId = $filmeDao->buscarPorId($id);
                if ($filmeId) {
                    echo "****************************************\n";
                    echo "*           FILME ENCONTRADO           *\n";
                    echo "****************************************\n";
                    listarFilmes($filmeId);
                    echo "****************************************\n";
                } 
                break;
            case 2:

            case 2:
                $ano = readline("Digite o ano de lançamento: ");
                $filmesAno = $filmeDao->buscarPorAnoLancamento($ano);
                echo "****************************************\n";
                echo "*      FILMES LANÇADOS EM " . $ano . "      *\n";
                echo "****************************************\n";
                listarFilmes($filmesAno);
                break;
            case 3: // Da maior para a menor avaliação
                $filmesAvaliacao = $filmeDao->buscarPorAvaliacaoDesc();
                echo "****************************************\n";
                echo "* FILMES ORDENADOS POR AVALIAÇÃO (DESC) *\n";
                echo "****************************************\n";
                listarFilmes($filmesAvaliacao);
                break;
            case 4:
                $genero = menuGenero();
                $filmesGenero = $filmeDao->buscarGenero($genero);
                echo "****************************************\n";
                echo "* FILMES ORDENADOS POR AVALIAÇÃO (DESC) *\n";
                echo "****************************************\n";
                listarFilmes($filmesGenero);
                break;
        }
    } while ($resposta != 0);
}
function listarFilmes($filmes)
{
    if (!empty($filmes)) {
        foreach ($filmes as $filme) {
            echo "ID: {$filme->getId()} | Título: {$filme->getTitulo()} | Gênero: {$filme->getTipo()} | Duração: {$filme->getDuracao()} minutos | Diretor: {$filme->getDiretor()} | Prêmios: " . ($filme->getPremios() ?: "Nenhum") . " | Descrição: {$filme->getDescricao()} | Avaliação: {$filme->getAvaliacao()} | " . ($filme->isLancado() ? "Ano de Lançamento: {$filme->getAnoLancamento()}" : "Lançamento em {$filme->getAnoLancamento()}") . "\n";
            echo str_repeat("-", 160) . "\n";
        }
    } else {
        echo "Nenhum filme encontrado.\n";
    }
}
function cadastraFilme($filme)
{
    $filme->setTitulo(readline("Digite o titulo do filme: "));
    do {
        $anoLancamento = readline("Digite o ano de lançamento de " . $filme->getTitulo() . ": ");
        if (strlen($anoLancamento) != 4 || !is_numeric($anoLancamento)) {
            echo "Ano de lançamento inválido! O ano deve ter exatamente 4 dígitos.\n";
        } elseif ($anoLancamento > date("Y")) {
            $filme->setAnoLancamento($anoLancamento);
            $filme->setLancado(0);
            break;
        } else {
            $filme->setAnoLancamento($anoLancamento);
            $filme->setLancado(1);
            break;
        }
    } while (true);
    $filme->setDuracao(readline("Digite a duração em minutos do filme " . $filme->getTitulo() . ":"));
    $filme->setDiretor(readline("Digite o diretor do filme " . $filme->getTitulo() . ":"));
    $filme->setPremios(readline("O filme " . $filme->getTitulo() . " tem algum premio? Se sim quais?(Deixe em branco se não possuir premios): "));
    $filme->setDescricao(readline("Coloque uma descrição do filme " . $filme->getTitulo() . ": "));
    $filme->setAvaliacao(readline("Qual sua nota de 0-10 para o filme " . $filme->getTitulo() . "? : "));
    $filmeDao = new FilmeDAO();
    $filmeDao->inserirFilme($filme);
    return "Filme cadastrado com sucesso!\n";
}
function menuGenero()
{
    do {
        echo "****************************************\n";
        echo "*       SELECIONE O GÊNERO DO FILME    *\n";
        echo "****************************************\n";
        echo "* R - ROMANCE                          *\n";
        echo "* A - AÇÃO                             *\n";
        echo "* C - COMÉDIA                          *\n";
        echo "* D - DRAMA                            *\n";
        echo "****************************************\n";
        $resposta = readline("Escolha o gênero do filme: ");
    } while (!in_array(strtoupper($resposta), ['R', 'A', 'C', 'D'])); //fiz desse jeito para reitulizar la embaixo, se não fica muita repetição aaaaaaa
    return $resposta;
}

do {
    $filmeDao = new FilmeDAO();
    echo "****************************************\n";
    echo "*         BEM VINDO AO PHPFLIX         *\n";
    echo "****************************************\n";
    echo "* 1 - CADASTRAR FILME                  *\n";
    echo "* 2 - EXCLUIR FILME                    *\n";
    echo "* 3 - LISTAR FILMES                    *\n";
    echo "* 4 - BUSCA AVANÇADA                   *\n";
    echo "* 0 - SAIR                             *\n";
    echo "****************************************\n";
    $resposta = readline("Digite sua resposta: ");
    switch ($resposta) {
        case 1:
            echo "****************************************\n";
            echo "*               CADASTRO               *\n";
            echo "****************************************\n";
            switch (menuGenero()) {
                case 'R':
                    $filme = new Romance();
                    break;
                case 'A':
                    $filme = new Acao();
                    break;
                case 'C':
                    $filme = new Comedia();
                    break;
                case 'D':
                    $filme = new Drama();
                    break;
                default:
                    echo "Gênero inválido\n";
                    continue 2; //top pq volta pro menu principal
                    break;
            }
            echo cadastraFilme($filme);
            break;
        case 2:
            echo "****************************************\n";
            echo "*                EXCLUIR               *\n";
            echo "****************************************\n";
            listarFilmes($filmeDao->listarFilmes());
            break;
        case 3:
            echo "****************************************\n";
            echo "*           LISTA DE FILMES            *\n";
            echo "****************************************\n";
            listarFilmes($filmeDao->listarFilmes());
            break;
        case 4:
            break;

        default:
            echo "OPÇÃO! INVALIDA\n";
            break;
    }
} while ($resposta != 0);
