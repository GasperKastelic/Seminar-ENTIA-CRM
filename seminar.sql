-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 04, 2022 at 04:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar`
--

-- --------------------------------------------------------

--
-- Table structure for table `dobavitelji`
--

CREATE TABLE `dobavitelji` (
  `ime_dobavitelja` varchar(40) NOT NULL,
  `naslov_dobavitelja` varchar(40) NOT NULL,
  `email_dobavitelja` varchar(40) NOT NULL,
  `telefon_dobavitelja` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dobavitelji`
--

INSERT INTO `dobavitelji` (`ime_dobavitelja`, `naslov_dobavitelja`, `email_dobavitelja`, `telefon_dobavitelja`) VALUES
('Andivi d.o.o.', 'Zagrebška cesta 101', 'info@andivi.si', '031 990 834'),
('Conrad d.o.o.', 'Pod jelšami 14', 'info@conrad.si', '040 111 221'),
('Digitklik d.o.o.', 'Špruha 31', 'info@digitklik.si', '051 132 189'),
('IC Elektronika d.o.o.', 'Vodovodna cesta 100', 'info@icelektronika.si', '031 112 119'),
('LSCS ', 'Wassen China', 'lscs@info.com', '+332 3325 43'),
('Mi elektronika d.o.o.', 'Podpeška cesta 67', 'info@mielektronika.si', '040 332 189'),
('OMF d.o.o.', 'Pod lipami 28', 'info@omf.si', '031 312 403'),
('Razsvetljava d.o.o.', 'Vič 2a', 'razsvetljava@info.si', '030 444 555'),
('Technobox d.o.o.', 'Šmartinska cesta 52', 'info@technobox.si', '031 111 339'),
('TPS d.o.o.', 'Korenova cesta 5', 'info@tps.si', '031 838 444');

-- --------------------------------------------------------

--
-- Table structure for table `izdelki`
--

CREATE TABLE `izdelki` (
  `id_izdelka` int(11) NOT NULL,
  `ime_izdelka` varchar(40) NOT NULL,
  `ime_dobavitelja` varchar(40) NOT NULL,
  `podrocje_izdelka` varchar(30) NOT NULL,
  `nabavna_cena` int(20) NOT NULL,
  `prodajna_cena` int(20) NOT NULL,
  `zaloga_izdelka` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `izdelki`
--

INSERT INTO `izdelki` (`id_izdelka`, `ime_izdelka`, `ime_dobavitelja`, `podrocje_izdelka`, `nabavna_cena`, `prodajna_cena`, `zaloga_izdelka`) VALUES
(62, 'EL-M01 ', 'OMF d.o.o.', 'Pametni dom', 60, 200, 100),
(63, 'EL-M01a', 'OMF d.o.o.', 'Pametni dom', 50, 220, 250),
(64, 'EL-M01 2.0', 'Mi elektronika d.o.o.', 'Pametni dom', 80, 500, 100),
(65, 'EL-M01a 2.0', 'Mi elektronika d.o.o.', 'Pametni dom', 70, 450, 77),
(66, 'EL-S01', 'OMF d.o.o.', 'Pametni dom', 20, 110, 320),
(67, 'EL-R01', 'OMF d.o.o.', 'Pametni dom', 42, 220, 99),
(68, 'EL-IR01', 'OMF d.o.o.', 'Pametni dom', 42, 110, 19),
(69, 'EL-E801', 'OMF d.o.o.', 'Pametni dom', 23, 200, 30),
(70, 'EL-E1601', 'OMF d.o.o.', 'Pametni dom', 25, 330, 111),
(71, 'EL-WTH01', 'OMF d.o.o.', 'Pametni dom', 25, 250, 31),
(72, 'EL-CD01', 'OMF d.o.o.', 'Pametni dom', 27, 250, 32),
(73, 'EL-CA01', 'OMF d.o.o.', 'Pametni dom', 19, 180, 40),
(75, 'Senzor T/H', 'Andivi d.o.o.', 'Pametni dom', 100, 130, 44),
(76, 'Senzor C02', 'Andivi d.o.o.', 'Pametni dom', 111, 140, 44),
(78, 'Senzor tlaka', 'TPS d.o.o.', 'Pametni dom', 120, 166, 10),
(85, 'Senzor LUX', 'Andivi d.o.o.', 'Pametni dom', 10, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `projekti`
--

CREATE TABLE `projekti` (
  `id_projekta` int(20) NOT NULL,
  `ime_projekta` varchar(40) NOT NULL,
  `tip_projekta` varchar(30) NOT NULL,
  `id_stranke` int(20) NOT NULL,
  `id_uporabnika` int(11) NOT NULL,
  `zacetek_projekta` date NOT NULL,
  `zakljucek_projekta` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projekti`
--

INSERT INTO `projekti` (`id_projekta`, `ime_projekta`, `tip_projekta`, `id_stranke`, `id_uporabnika`, `zacetek_projekta`, `zakljucek_projekta`) VALUES
(22, 'Hiša Turk', 'Hiša', 8, 35, '2022-10-01', '2023-10-01'),
(23, 'Tacenske vile', 'Večstanovanjski objekt', 11, 36, '2022-02-02', '2023-10-10'),
(24, 'Trnovske vile', 'Večstanovanjski objekt', 10, 37, '2022-02-02', '2023-10-10'),
(25, 'Stanovanje Turk', 'Hiša', 9, 38, '2022-01-09', '2023-09-08'),
(26, 'Stanovanje Samec', 'Hiša', 9, 38, '2022-01-09', '2023-09-08'),
(27, 'Stanovanje Vtrovec', 'Stanovanje', 12, 38, '2022-10-09', '2023-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `stranke`
--

CREATE TABLE `stranke` (
  `id_stranke` int(20) NOT NULL,
  `naziv_stranke` varchar(20) NOT NULL,
  `tip_stranke` varchar(20) NOT NULL,
  `naslov_stranke` varchar(40) NOT NULL,
  `email_stranke` varchar(40) NOT NULL,
  `telefon_stranke` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stranke`
--

INSERT INTO `stranke` (`id_stranke`, `naziv_stranke`, `tip_stranke`, `naslov_stranke`, `email_stranke`, `telefon_stranke`) VALUES
(5, 'Marko Mohar', 'Fizična oseba', 'Dunajska 22', 'marko.mohar@gmail.com', '031 111 222'),
(7, 'Nejc Udovč', 'Fizična oseba', 'Stopiče 21', 'nejc22@gmail.com', '040 1998 263'),
(8, 'Rok Turk', 'Fizična oseba', 'Podgrad 2a', 'roki@gmail.com', '030 789 322'),
(9, 'Miha Samec', 'Fizična oseba', 'Slovenska 22', 'mihi@gmail.com', '030 222 222'),
(10, 'Alex Sonec', 'Pravna oseba', 'Dunajska 21', 'alex@gmail.com', '030 111 111'),
(11, 'Biger d.o.o.', 'Pravna oseba', 'Tacenski vrtovi 33', 'info@bigger.com', '050 888 000'),
(12, 'Maša Vrtovec', 'Fizična oseba', 'Dolnja Težka Voda 5', 'asa.vrtovec@siol.net', '404 444 444'),
(13, 'Domen Novak', 'Fizična oseba', 'Težka Voda 11', 'domen.novak45@siol.net', '031 333 333'),
(14, 'Neuhaus d.o.o.', 'Pravna oseba', 'Ljubljanska cesta 1', 'neuhaus@info.si', '051 555 655');

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki`
--

CREATE TABLE `uporabniki` (
  `id_uporabnika` int(11) NOT NULL,
  `ime_uporabnika` varchar(20) NOT NULL,
  `priimek_uporabnika` varchar(20) NOT NULL,
  `geslo_uporabnika` varchar(30) NOT NULL,
  `podruznica_uporabnika` varchar(20) NOT NULL,
  `datum_rojstva` date NOT NULL,
  `telefon_uporabnika` varchar(20) NOT NULL,
  `email_uporabnika` varchar(40) NOT NULL,
  `nivo_uporabnika` int(11) DEFAULT 0,
  `token` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uporabniki`
--

INSERT INTO `uporabniki` (`id_uporabnika`, `ime_uporabnika`, `priimek_uporabnika`, `geslo_uporabnika`, `podruznica_uporabnika`, `datum_rojstva`, `telefon_uporabnika`, `email_uporabnika`, `nivo_uporabnika`, `token`) VALUES
(35, 'Gašper', 'Kastelic', 'gasper123', 'Ljubljana', '1997-10-01', '040 123 456', 'gasper.kastelic@entia.si', 1, '6b774ab2faee676204e1d49ae032b8cb'),
(36, 'Jaka', 'Koščak', 'jaka123', 'Maribor', '1995-09-01', '030 123 333', 'jaka.koscak@entia.si', 0, '8dbdfd6099b6b5170e67ea6f9aa22656'),
(37, 'Jernej', 'Jagarinec', 'jernej123', 'Ljubljana', '1980-03-06', '030 223 693', 'jernej.jagarinec@entia.si', 1, NULL),
(38, 'Miha', 'Zupančič', 'miha3954', 'Koper', '1990-10-02', '031 111 615', 'miha.zupancic@entia.si', 0, NULL),
(39, 'Vid', 'Kožar', 'ddkodo0', 'Kranj', '1995-02-10', '030 111 849', 'vid.kozar@entia.si', 1, NULL),
(40, 'Anže', 'Hafner', 'kufytdtufy', 'Kranj', '2000-10-07', '051 389 000', 'anze.hafner@entia.si', 0, NULL),
(41, 'Miha', 'Pavlič', 'miha123', 'Ljubljana', '1980-10-10', '031 333 443', 'miha.pavlic@entia.si', 0, 'fdfe8ff5adbc23797351e77d92b2df76'),
(42, 'Nejc', 'Meglič', 'nejc123', 'Ljubljana', '1998-10-09', '030 221 695', 'nejc.meglic@entia.si', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dobavitelji`
--
ALTER TABLE `dobavitelji`
  ADD PRIMARY KEY (`ime_dobavitelja`);

--
-- Indexes for table `izdelki`
--
ALTER TABLE `izdelki`
  ADD PRIMARY KEY (`id_izdelka`),
  ADD KEY `dobavitelj_izdelka` (`ime_dobavitelja`);

--
-- Indexes for table `projekti`
--
ALTER TABLE `projekti`
  ADD PRIMARY KEY (`id_projekta`),
  ADD KEY `projekti_ibfk_1` (`id_uporabnika`),
  ADD KEY `id_stranke` (`id_stranke`);

--
-- Indexes for table `stranke`
--
ALTER TABLE `stranke`
  ADD PRIMARY KEY (`id_stranke`);

--
-- Indexes for table `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`id_uporabnika`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `izdelki`
--
ALTER TABLE `izdelki`
  MODIFY `id_izdelka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `projekti`
--
ALTER TABLE `projekti`
  MODIFY `id_projekta` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `stranke`
--
ALTER TABLE `stranke`
  MODIFY `id_stranke` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `id_uporabnika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `izdelki`
--
ALTER TABLE `izdelki`
  ADD CONSTRAINT `izdelki_ibfk_1` FOREIGN KEY (`ime_dobavitelja`) REFERENCES `dobavitelji` (`ime_dobavitelja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projekti`
--
ALTER TABLE `projekti`
  ADD CONSTRAINT `projekti_ibfk_1` FOREIGN KEY (`id_uporabnika`) REFERENCES `uporabniki` (`id_uporabnika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projekti_ibfk_2` FOREIGN KEY (`id_stranke`) REFERENCES `stranke` (`id_stranke`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
