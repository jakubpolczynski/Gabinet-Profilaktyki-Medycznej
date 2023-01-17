-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Sty 2023, 00:46
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
-- Baza danych: `gabinet`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admini`
--

CREATE TABLE `admini` (
  `id_admina` int(10) NOT NULL,
  `imie` varchar(40) CHARACTER SET utf16 COLLATE utf16_polish_ci NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `adresZamieszkania` varchar(100) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `numerTelefonu` int(9) NOT NULL,
  `adresEmail` varchar(100) NOT NULL,
  `login` varchar(30) NOT NULL,
  `haslo` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admini`
--

INSERT INTO `admini` (`id_admina`, `imie`, `nazwisko`, `adresZamieszkania`, `pesel`, `numerTelefonu`, `adresEmail`, `login`, `haslo`) VALUES
(1, 'Andrzej', 'Matesiak', 'Kościelna 3/4, Szczecin', '83642480191', 545610389, 'amtesiak@gmail.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `badaniapielegniarskie`
--

CREATE TABLE `badaniapielegniarskie` (
  `id_badania` int(100) NOT NULL,
  `id_ucznia` int(100) NOT NULL,
  `id_klasy` int(100) NOT NULL,
  `id_pielegniarki` int(100) NOT NULL,
  `dataBadania` date NOT NULL,
  `godzinaBadania` time NOT NULL,
  `powodBadania` varchar(255) NOT NULL,
  `przeprowadzoneCzynnosci` varchar(255) NOT NULL,
  `uwagi` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `badaniaprzesiewowe`
--

CREATE TABLE `badaniaprzesiewowe` (
  `id_bilans` int(100) NOT NULL,
  `id_ucznia` int(100) NOT NULL,
  `id_klasy` int(10) NOT NULL,
  `id_pielegniarki` int(10) NOT NULL,
  `dataBilansu` date NOT NULL,
  `wzrost` decimal(10,0) NOT NULL,
  `waga` decimal(10,0) NOT NULL,
  `BMI` decimal(10,0) NOT NULL,
  `wzrok` varchar(255) NOT NULL,
  `sluch` varchar(255) NOT NULL,
  `cisnienie` varchar(255) NOT NULL,
  `statykaCiala` varchar(255) NOT NULL,
  `wadaWymowy` varchar(255) NOT NULL,
  `inneUwagi` varchar(255) NOT NULL,
  `obecnosc` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kartaucznia`
--

CREATE TABLE `kartaucznia` (
  `id_ucznia` int(100) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `id_klasy` int(100) NOT NULL,
  `adresZamieszkania` varchar(100) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `numerTelefonuRodzica` varchar(30) NOT NULL,
  `adresEmailRodzica` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `logowanie`
--

CREATE TABLE `logowanie` (
  `login` varchar(40) NOT NULL,
  `haslo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `logowanie`
--

INSERT INTO `logowanie` (`login`, `haslo`) VALUES
('pagralicka', '123456'),
('pbkowalska', '123456'),
('admin', 'admin');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obecnoscuczniownabadaniach`
--

CREATE TABLE `obecnoscuczniownabadaniach` (
  `id_klasy` int(10) NOT NULL,
  `iloscUczniow` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pielegniarki`
--

CREATE TABLE `pielegniarki` (
  `id_pielegniarki` int(10) NOT NULL,
  `imie` varchar(40) NOT NULL,
  `nazwisko` varchar(40) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `pielegniarki`
--

INSERT INTO `pielegniarki` (`id_pielegniarki`, `imie`, `nazwisko`, `login`, `haslo`) VALUES
(1, 'Anna', 'Gralicka', 'pagralicka', '123456'),
(2, 'Barbara', 'Kowalska', 'pbkowalska', '123456');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `podsumowanie`
--

CREATE TABLE `podsumowanie` (
  `liczbaSpotkan` int(100) NOT NULL DEFAULT 0,
  `zidentyfikowaneProblemy` int(100) NOT NULL DEFAULT 0,
  `uczniowieZProblemami` int(100) NOT NULL DEFAULT 0,
  `badaniaPielegniarskie` int(100) NOT NULL DEFAULT 0,
  `badaniaPrzesiewowe` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `terminarz`
--

CREATE TABLE `terminarz` (
  `id` int(100) NOT NULL,
  `data` date NOT NULL,
  `godzina` time NOT NULL,
  `opisWydarzenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admini`
--
ALTER TABLE `admini`
  ADD PRIMARY KEY (`id_admina`);

--
-- Indeksy dla tabeli `badaniapielegniarskie`
--
ALTER TABLE `badaniapielegniarskie`
  ADD PRIMARY KEY (`id_badania`);

--
-- Indeksy dla tabeli `badaniaprzesiewowe`
--
ALTER TABLE `badaniaprzesiewowe`
  ADD PRIMARY KEY (`id_bilans`);

--
-- Indeksy dla tabeli `kartaucznia`
--
ALTER TABLE `kartaucznia`
  ADD PRIMARY KEY (`id_ucznia`);

--
-- Indeksy dla tabeli `obecnoscuczniownabadaniach`
--
ALTER TABLE `obecnoscuczniownabadaniach`
  ADD PRIMARY KEY (`id_klasy`);

--
-- Indeksy dla tabeli `pielegniarki`
--
ALTER TABLE `pielegniarki`
  ADD PRIMARY KEY (`id_pielegniarki`);

--
-- Indeksy dla tabeli `terminarz`
--
ALTER TABLE `terminarz`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admini`
--
ALTER TABLE `admini`
  MODIFY `id_admina` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `badaniapielegniarskie`
--
ALTER TABLE `badaniapielegniarskie`
  MODIFY `id_badania` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `badaniaprzesiewowe`
--
ALTER TABLE `badaniaprzesiewowe`
  MODIFY `id_bilans` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `terminarz`
--
ALTER TABLE `terminarz`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
