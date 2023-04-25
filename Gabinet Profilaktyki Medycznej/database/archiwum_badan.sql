SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

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

ALTER TABLE `badaniapielegniarskie`
  ADD PRIMARY KEY (`id_badania`);

ALTER TABLE `badaniaprzesiewowe`
  ADD PRIMARY KEY (`id_bilans`);

ALTER TABLE `badaniapielegniarskie`
  MODIFY `id_badania` int(100) NOT NULL AUTO_INCREMENT;

ALTER TABLE `badaniaprzesiewowe`
  MODIFY `id_bilans` int(100) NOT NULL AUTO_INCREMENT;