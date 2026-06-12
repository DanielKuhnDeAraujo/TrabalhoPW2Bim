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
  foto varchar(30) NOT NULL
) DEFAULT CHARSET=utf8 AUTO_INCREMENT=6;

INSERT INTO `tabelarevista` (`id`, `nome`, `ano`, `edicao`, `datacadastro`, `foto`) VALUES
(1, 'O Cavaleiro das Trevas', 1986, 1, '2026-06-11 12:00:00', 'batman_cavaleiro.png'),
(2, 'A Piada Mortal', 1988, 1, '2026-06-11 12:05:00', 'piada_mortal.png'),
(3, 'Watchmen', 1986, 1, '2026-06-11 12:10:00', 'watchmen_01.png'),
(4, 'Guerra Civil', 2006, 1, '2026-06-11 12:15:00', 'guerra_civil_01.png'),
(5, 'Homem-Aranha: A Última Caçada de Kraven', 1987, 1, '2026-06-11 12:20:00', 'spiderman_kraven.png');