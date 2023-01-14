-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Sty 2023, 19:59
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `szkola`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasy`
--

CREATE TABLE `klasy` (
  `id_klasy` int(10) NOT NULL,
  `nazwaKlasy` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `klasy`
--

INSERT INTO `klasy` (`id_klasy`, `nazwaKlasy`) VALUES
(1, '1A'),
(2, '1B');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pielegniarki`
--

CREATE TABLE `pielegniarki` (
  `id_pielegniarki` int(100) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `dataUrodzenia` date NOT NULL,
  `adresZamieszkania` varchar(100) NOT NULL,
  `numerTelefonu` varchar(9) NOT NULL,
  `pesel` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pielegniarki`
--

INSERT INTO `pielegniarki` (`id_pielegniarki`, `imie`, `nazwisko`, `dataUrodzenia`, `adresZamieszkania`, `numerTelefonu`, `pesel`) VALUES
(1, 'Anna', 'Gralicka', '1988-05-25', 'Kwiatowa 15/10, Szczecin', '876301727', '88360678912'),
(2, 'Barbara', 'Kowalska', '1975-09-08', 'Świetlista 19/2, Szczecin', '515345910', '75643098017');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczniowie`
--

CREATE TABLE `uczniowie` (
  `id_uczen` int(100) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `dataUrodzenia` date NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `adres` varchar(50) NOT NULL,
  `id_klasy` int(10) NOT NULL,
  `numerTelRodzica` int(9) NOT NULL,
  `adresEmailRodzica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `uczniowie`
--

INSERT INTO `uczniowie` (`id_uczen`, `imie`, `nazwisko`, `dataUrodzenia`, `pesel`, `adres`, `id_klasy`, `numerTelRodzica`, `adresEmailRodzica`) VALUES
(1, 'Aneta', 'Kowalska', '2016-06-16', '16316875619', 'Wąska 16/3, Szczecin', 1, 753498127, 'm.kowalska@o2.pl'),
(2, 'Szymon', 'Lagański', '2016-03-21', '16429812367', 'Policyjna 3/2, Szczecin', 1, 682398751, 'z.lagan@gmail.com'),
(3, 'Maksymilian', 'Barański', '2016-02-26', '16248715430', 'Akwenowa 43/12, Szczecin', 1, 786423908, 'd.baran@gmail.com'),
(4, 'Dominika', 'Atleta', '2016-07-02', '16654098781', 'Rajska 1/4, Szczecin', 2, 654712809, 'janatleta@o2.pl'),
(5, 'Zuzanna', 'Piliska', '2016-01-14', '16267098933', 'Ragańska 4/40, Szczecin', 2, 654109987, 'piliska.anna@gmail.com'),
(6, 'Paweł', 'Czarny', '2016-04-11', '16012564897', 'Klinicka 2/5, Szczecin', 2, 643876109, 's.czarny@gmail.com');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klasy`
--
ALTER TABLE `klasy`
  ADD PRIMARY KEY (`id_klasy`);

--
-- Indeksy dla tabeli `pielegniarki`
--
ALTER TABLE `pielegniarki`
  ADD PRIMARY KEY (`id_pielegniarki`);

--
-- Indeksy dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD PRIMARY KEY (`id_uczen`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `klasy`
--
ALTER TABLE `klasy`
  MODIFY `id_klasy` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pielegniarki`
--
ALTER TABLE `pielegniarki`
  MODIFY `id_pielegniarki` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `id_uczen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
