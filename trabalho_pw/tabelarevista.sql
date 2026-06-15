SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET NAMES utf8;

create database banco;
use banco;

CREATE TABLE IF NOT EXISTS tabelarevista (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome varchar(50) NOT NULL,
  ano int NOT NULL,
  edicao int NOT NULL,
  datacadastro datetime NOT NULL,
  foto varchar(255) NOT NULL,
  descricao text NOT NULL
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `tabelarevista` (`id`, `nome`, `ano`, `edicao`, `datacadastro`, `foto`, `descricao`) VALUES
(1, 'O Cavaleiro das Trevas', 1986, 1, '2026-06-11 12:00:00', 'batman_cavaleiro.png', 'Minissérie de Frank Miller que mostra um Batman envelhecido retornando à ativa para combater o crime em Gotham.'),
(2, 'A Piada Mortal', 1988, 1, '2026-06-11 12:05:00', 'piada_mortal.png', 'Graphic novel que explora a relação entre Batman e Coringa, apresentando uma possível origem para o vilão.'),
(3, 'Watchmen', 1986, 1, '2026-06-11 12:10:00', 'watchmen_01.png', 'Obra clássica ambientada em um mundo alternativo onde heróis mascarados influenciam eventos políticos globais.'),
(4, 'Guerra Civil', 2006, 1, '2026-06-11 12:15:00', 'guerra_civil_01.png', 'Evento da Marvel em que os heróis se dividem após a aprovação da Lei de Registro de Super-Humanos.'),
(5, 'Homem-Aranha: A Última Caçada de Kraven', 1987, 1, '2026-06-11 12:20:00', 'spiderman_kraven.png', 'Saga em que Kraven derrota o Homem-Aranha e assume sua identidade em uma das histórias mais marcantes do personagem.');