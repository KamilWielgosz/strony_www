-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Cze 2016, 23:18
-- Wersja serwera: 10.1.13-MariaDB
-- Wersja PHP: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wynajem_sal`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `koszt` (IN `ID` INT(8))  BEGIN
set @koszt=(select KOSZT_SALI *TIMESTAMPDIFF(hour,  concat(data_rozpoczecia, ' ', godzina_rozpoczecia), concat(data_zakonczenia, ' ', godzina_zakonczenia)) from rezerwacja natural join sala where ID_REZERWACJI=ID);
SELECT @koszt;
update rezerwacja set KOSZT_CALKOWITY=@koszt where ID_REZERWACJI=ID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `budynek`
--

CREATE TABLE `budynek` (
  `ID_BUDYNKU` int(2) NOT NULL,
  `ADRES` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ILOSC_SAL` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `budynek`
--

INSERT INTO `budynek` (`ID_BUDYNKU`, `ADRES`, `ILOSC_SAL`) VALUES
(1, 'ul. Warszawska 1', 10),
(2, 'ul. Warszawska 2', 10),
(3, 'ul. Warszawska 3', 10),
(4, 'ul. Warszawska 4', 10),
(5, 'ul. Warszawska 5', 10),
(6, 'ul. Warszawska 6', 10),
(7, 'ul. Warszawska 7', 10),
(8, 'ul. Warszawska 8', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoba`
--

CREATE TABLE `osoba` (
  `ID_OSOBY` int(8) NOT NULL DEFAULT '0',
  `IMIE` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `NAZWISKO` varchar(40) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `LOGIN` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `HASLO` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `NR_TELEFONU` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `osoba`
--

INSERT INTO `osoba` (`ID_OSOBY`, `IMIE`, `NAZWISKO`, `LOGIN`, `HASLO`, `NR_TELEFONU`) VALUES
(16, 'Jan', 'Jankowski', 'jan', 'jan', 2312312);

--
-- Wyzwalacze `osoba`
--
DELIMITER $$
CREATE TRIGGER `new_id` BEFORE INSERT ON `osoba` FOR EACH ROW BEGIN 
    IF((SELECT count(ID_OSOBY) FROM osoba)>0) THEN
        SET NEW.ID_OSOBY=(SELECT MAX(ID_OSOBY)+1 FROM osoba);
    ELSE
        SET NEW.ID_OSOBY=0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacja`
--

CREATE TABLE `rezerwacja` (
  `ID_REZERWACJI` int(8) NOT NULL,
  `KOSZT_CALKOWITY` int(8) NOT NULL,
  `GODZINA_ROZPOCZECIA` time NOT NULL,
  `GODZINA_ZAKONCZENIA` time NOT NULL,
  `DATA_ROZPOCZECIA` date NOT NULL,
  `DATA_ZAKONCZENIA` date NOT NULL,
  `ID_OSOBY` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `rezerwacja`
--

INSERT INTO `rezerwacja` (`ID_REZERWACJI`, `KOSZT_CALKOWITY`, `GODZINA_ROZPOCZECIA`, `GODZINA_ZAKONCZENIA`, `DATA_ROZPOCZECIA`, `DATA_ZAKONCZENIA`, `ID_OSOBY`) VALUES
(1, 200, '18:00:00', '20:00:00', '2016-12-22', '2016-12-22', 16);

--
-- Wyzwalacze `rezerwacja`
--
DELIMITER $$
CREATE TRIGGER `new_id_rezerwacja` BEFORE INSERT ON `rezerwacja` FOR EACH ROW BEGIN 
    IF((SELECT count(ID_REZERWACJI) FROM rezerwacja)>0) THEN
        SET NEW.ID_REZERWACJI=(SELECT MAX(ID_REZERWACJI)+1 FROM rezerwacja);
    ELSE
        SET NEW.ID_REZERWACJI=0;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rezerwacja_sprzet`
--

CREATE TABLE `rezerwacja_sprzet` (
  `ID_REZERWACJI` int(8) NOT NULL,
  `ID_SPRZETU` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sala`
--

CREATE TABLE `sala` (
  `ID_SALI` int(3) NOT NULL,
  `NR_SALI` int(3) NOT NULL,
  `ILOSC_MIEJSC` int(3) NOT NULL,
  `KOSZT_SALI` int(6) NOT NULL,
  `DOSTEPNOSC` tinyint(1) NOT NULL,
  `ID_BUDYNKU` int(2) NOT NULL,
  `ID_REZERWACJI` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `sala`
--

INSERT INTO `sala` (`ID_SALI`, `NR_SALI`, `ILOSC_MIEJSC`, `KOSZT_SALI`, `DOSTEPNOSC`, `ID_BUDYNKU`, `ID_REZERWACJI`) VALUES
(1, 22, 58, 100, 1, 1, NULL),
(2, 34, 40, 100, 0, 2, 1),
(4, 424, 23, 222, 1, 3, NULL),
(6, 321, 22, 231, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sprzet`
--

CREATE TABLE `sprzet` (
  `ID_SPRZETU` int(6) NOT NULL,
  `KOSZT_SPRZETU` int(4) NOT NULL,
  `ID_SALI` int(3) DEFAULT NULL,
  `dostepnosc` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `sprzet`
--

INSERT INTO `sprzet` (`ID_SPRZETU`, `KOSZT_SPRZETU`, `ID_SALI`, `dostepnosc`) VALUES
(1, 20, NULL, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `budynek`
--
ALTER TABLE `budynek`
  ADD PRIMARY KEY (`ID_BUDYNKU`);

--
-- Indexes for table `osoba`
--
ALTER TABLE `osoba`
  ADD PRIMARY KEY (`ID_OSOBY`);

--
-- Indexes for table `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD PRIMARY KEY (`ID_REZERWACJI`),
  ADD KEY `ID_OSOBY` (`ID_OSOBY`);

--
-- Indexes for table `rezerwacja_sprzet`
--
ALTER TABLE `rezerwacja_sprzet`
  ADD PRIMARY KEY (`ID_REZERWACJI`),
  ADD KEY `ID_SPRZETU` (`ID_SPRZETU`);

--
-- Indexes for table `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`ID_SALI`),
  ADD KEY `ID_BUDYNKU` (`ID_BUDYNKU`),
  ADD KEY `ID_REZERWACJI` (`ID_REZERWACJI`);

--
-- Indexes for table `sprzet`
--
ALTER TABLE `sprzet`
  ADD PRIMARY KEY (`ID_SPRZETU`),
  ADD KEY `ID_SALI` (`ID_SALI`);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `rezerwacja`
--
ALTER TABLE `rezerwacja`
  ADD CONSTRAINT `rezerwacja_ibfk_1` FOREIGN KEY (`ID_OSOBY`) REFERENCES `osoba` (`ID_OSOBY`);

--
-- Ograniczenia dla tabeli `rezerwacja_sprzet`
--
ALTER TABLE `rezerwacja_sprzet`
  ADD CONSTRAINT `rezerwacja_sprzet_ibfk_1` FOREIGN KEY (`ID_SPRZETU`) REFERENCES `sprzet` (`ID_SPRZETU`),
  ADD CONSTRAINT `rezerwacja_sprzet_ibfk_2` FOREIGN KEY (`ID_REZERWACJI`) REFERENCES `rezerwacja` (`ID_REZERWACJI`);

--
-- Ograniczenia dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `sala_ibfk_1` FOREIGN KEY (`ID_BUDYNKU`) REFERENCES `budynek` (`ID_BUDYNKU`),
  ADD CONSTRAINT `sala_ibfk_2` FOREIGN KEY (`ID_REZERWACJI`) REFERENCES `rezerwacja` (`ID_REZERWACJI`);

--
-- Ograniczenia dla tabeli `sprzet`
--
ALTER TABLE `sprzet`
  ADD CONSTRAINT `sprzet_ibfk_1` FOREIGN KEY (`ID_SALI`) REFERENCES `sala` (`ID_SALI`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
