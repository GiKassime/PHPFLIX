<?php
require_once  './dao/FilmeDAO.php';
require_once   'models/Acao.php';
require_once   'models/Comedia.php';
require_once   'models/Drama.php';
require_once   'models/Outro.php';
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
        echo "****************************************\n\n";
        $resposta = readline("Digite sua resposta: ");

        switch ($resposta) {
            case 1:
                $filmes = $filmeDao->buscarFilmes();
                listarFilmes($filmes);
                $id = readline("Digite o ID do filme: ");
                $filmeId = $filmeDao->buscarFilmes('id = ?', [$id]);
                if ($filmeId) {
                    echo "\n****************************************\n";
                    echo "*           FILME ENCONTRADO           *\n";
                    echo "****************************************\n";
                    listarFilmes($filmeId);
                    echo "****************************************\n\n";
                } 
                break;
            case 2:

            case 2://maior para menor ano
                $filmesAno = $filmeDao->buscarFilmes('1 ORDER BY ano_lancamento DESC');
                echo "\n****************************************\n";
                echo "*              FILMES LANÇADOS         *\n";
                echo "****************************************\n\n";
                listarFilmes($filmesAno);
                break;
            case 3: // Da maior para a menor avaliação
                $filmesAvaliacao = $filmeDao->buscarFilmes('1 ORDER BY avaliacao DESC');
                echo "\n****************************************\n";
                echo "* FILMES ORDENADOS POR AVALIAÇÃO (DESC) *\n";
                echo "****************************************\n\n";
                listarFilmes($filmesAvaliacao);
                break;
            case 4:
                $genero = menuGenero();
                $filmesGenero = $filmeDao->buscarFilmes('tipo = ?', [$genero]);
                echo "\n****************************************\n";
                echo "* FILMES ORDENADOS POR GENÊRO - ".strtoupper($filmesGenero[0]->getTipo() ?? 'OUTRO')  ."   *\n";
                echo "****************************************\n\n";
                listarFilmes($filmesGenero);
                break; 
        }
    } while ($resposta != 0);
}
function listarFilmes($filmes)
{
    if (!empty($filmes)) {
        foreach ($filmes as $filme) {
            echo "ID: {$filme->getId()} | Título: {$filme->getTitulo()} | Gênero: {$filme->getTipo()}  \nDuração: {$filme->getDuracao()} minutos | Diretor: {$filme->getDiretor()}  \nPrêmios: " . ($filme->getPremios() ?: "Nenhum") . "  \nDescrição: {$filme->getDescricao()}  \nAvaliação: {$filme->getAvaliacao()} | " . ($filme->isLancado() ? "Ano de Lançamento: {$filme->getAnoLancamento()}" : "Lançamento em {$filme->getAnoLancamento()}") . "\n";
            echo "\n****************************************\n";


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
    do {
        $resposta = readline("Qual sua nota de 0-10 para o filme " . $filme->getTitulo() . "? : ");
    } while ($resposta > 10 || $resposta < 0);
    $filme->setAvaliacao($resposta);
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
        echo "* O - OUTRO                            *\n";
        echo "****************************************\n";
        $resposta = readline("Escolha o gênero do filme: ");
    } while (!in_array(strtoupper($resposta), ['R', 'A', 'C', 'D','O'])); //fiz desse jeito para reitulizar la embaixo, se não fica muita repetição aaaaaaa
    return strtoupper($resposta);
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
    echo "****************************************\n\n";
    $resposta = readline("Digite sua resposta: ");
    switch ($resposta) {
        case 1:
            echo "****************************************\n";
            echo "*               CADASTRO               *\n";
            echo "****************************************\n\n";
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
                case 'O':
                    $filme = new Outro();
                    $filme->setNomeGenero(readline("Qual o nome desse outro gênero?"));
                    break;
            }
            echo cadastraFilme($filme);
            break;
        case 2:
            echo "****************************************\n";
            echo "*                EXCLUIR               *\n";
            echo "****************************************\n\n";
            listarFilmes($filmeDao->buscarFilmes());
            $id = readline("Digite o ID do filme que deseja excluir: ");
            if($id){
                $filmeDao->excluirFilme($id);
                echo "Filme excluído com sucesso\n";
            }else{
                echo "ID inválido\n";
            }
            break;
        case 3:
            echo "****************************************\n";
            echo "*           LISTA DE FILMES            *\n";
            echo "****************************************\n\n";
            listarFilmes($filmeDao->buscarFilmes());
            break;
        case 4:
            buscaAvancada();
            break;
        case 0: 
            echo "****************************************\n";
            echo "*     OBRIGADO POR USAR  PHPFLIX 1.0   *\n";
            echo "****************************************\n";
        break;
        default:
            echo "OPÇÃO! INVALIDA\n";
            break;
    }
} while ($resposta != 0);

