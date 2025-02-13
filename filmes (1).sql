
create database Phpflix;
use Phpflix;
CREATE TABLE  `filmes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `tipo` varchar(101) NOT NULL,
  `diretor` varchar(255) NOT NULL,
  `duracao` varchar(20) NOT NULL,
  `ano_lancamento` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `premios` text DEFAULT NULL,
  `avaliacao` float NOT NULL,
  `lancado` tinyint(1) NOT NULL,
  `genero` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
);



INSERT INTO `filmes` (`id`, `titulo`, `tipo`, `diretor`, `duracao`, `ano_lancamento`, `descricao`, `premios`, `avaliacao`, `lancado`, `genero`) VALUES
(2, 'Interestelar', 'O', 'Christopher Nolan', '169', 2014, 'Exploração espacial para salvar a humanidade.', 'Oscar de Melhores Efeitos Visuais', 8.7, 1, 'Ficção Científica, Drama'),
(3, 'Vingadores: Ultimato', 'A', 'Anthony e Joe Russo', '181', 2019, 'Os Vingadores lutam contra Thanos.', 'Vários prêmios', 8.4, 1, 'Ação, Aventura'),
(4, 'Titanic', 'R', 'James Cameron', '195', 1997, 'História de amor no trágico naufrágio.', 'Oscar de Melhor Filme', 7.9, 1, 'Romance, Drama'),
(5, 'Coringa', 'D', 'Todd Phillips', '122', 2019, 'A origem do vilão icônico da DC.', 'Oscar de Melhor Ator', 8.5, 1, 'Drama, Thriller'),
(6, 'Toy Story', 'O', 'John Lasseter', '81', 1995, 'Brinquedos ganham vida quando ninguém vê.', 'Oscar de Contribuição Especial', 8.3, 1, 'Animação, Comédia');
