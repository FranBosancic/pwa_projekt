-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2025 at 05:58 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12


CREATE DATABASE `pwa_projekt` CHARACTER SET utf8mb4 COLLATE utf8mb4_croatian_ci;
USE `pwa_projekt`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pwa_projekt`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id` int(11) NOT NULL,
  `naziv` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id`, `naziv`) VALUES
(1, 'News'),
(2, 'Politics'),
(3, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `ID` int(11) NOT NULL,
  `naslov` varchar(32) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `kategorija_id` int(11) NOT NULL,
  `slika` varchar(64) NOT NULL,
  `arhiva` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`ID`, `naslov`, `sazetak`, `tekst`, `kategorija_id`, `slika`, `arhiva`) VALUES
(21, 'Nova pravila za sigurnost', 'Sportske organizacije pooštravaju sigurnosne mjere na stadionima zbog prošlih incidenata, a cilj je zaštititi sve posjetitelje i spriječiti nerede.', 'Zadnjih godina, sigurnost na sportskim događajima postala je jedna od glavnih tema u organizaciji velikih natjecanja. Nakon nekoliko ozbiljnih incidenata na stadionima u regiji, nadležne institucije i sportske organizacije dogovorile su nove mjere koje će biti uvedene već od idućeg mjeseca.\r\nUlazne kontrole bit će detaljnije, uključivat će provjere torbi, zabranu unošenja pirotehnike i drugih potencijalno opasnih predmeta. Također, sigurnosno osoblje bit će dodatno educirano i brojno pojačano.\r\nNavijači se pozivaju na razumijevanje i suradnju kako bi svi događaji prošli bez problema i kako bi svi prisutni mogli uživati u sportu u sigurnom okruženju.\r\nOčekuje se da će ove promjene imati pozitivan učinak na atmosferu i sigurnost na stadionima diljem zemlje.', 3, 'paris-2024-olympics-soccer.jpg', 0),
(22, 'Politička scena uzdrmana', 'Novi zakonski prijedlozi izazvali su oštre debate u saboru, a opozicija traži dodatna pojašnjenja prije glasanja.', 'Posljednjih tjedana politička scena u zemlji vrlo je dinamična zbog novih zakonskih prijedloga koje je predložila vladajuća koalicija. Prijedlozi se odnose na reforme u poreznom sustavu i javnoj upravi, a cilj je modernizacija i povećanje učinkovitosti.\\r\\nOpozicija je odmah reagirala, navodeći kako predložene promjene mogu nepovoljno utjecati na određene skupine građana i traže detaljnije analize i javne rasprave prije donošenja zakona.\\r\\nParlamentarne rasprave su burne, a neki saborski zastupnici najavljuju da će biti potrebne dodatne izmjene kako bi zakoni prošli.\\r\\nU ovom trenutku, građani prate s velikim zanimanjem političke događaje, jer promjene mogu značajno utjecati na svakodnevni život i gospodarstvo.', 2, 'pol-sc3.png', 0),
(23, 'Tehnološki napredak', 'Predstavljeni su novi modeli pametnih telefona s naprednim značajkama, uključujući savitljive ekrane i integriranu umjetnu inteligenciju.', 'Industrija pametnih telefona doživljava veliki zaokret s predstavljanjem najnovijih modela koji obećavaju promijeniti način na koji koristimo te uređaje. Najzapaženije inovacije uključuju savitljive OLED ekrane koji omogućuju transformaciju uređaja iz telefona u tablet, čime se povećava funkcionalnost i korisničko iskustvo.\\r\\nOsim toga, novi uređaji opremljeni su moćnim procesorima i naprednim kamerama, a poseban naglasak stavljen je na integraciju umjetne inteligencije koja prilagođava performanse aplikacija korisniku.\\r\\nStručnjaci predviđaju da će ove inovacije postaviti nove standarde u industriji i potaknuti konkurenciju da ubrza razvoj tehnologija.\\r\\nPotrošači se s nestrpljenjem pripremaju za dolazak ovih uređaja na tržište, a prve recenzije već su vrlo pozitivne.', 1, 'M4nigVN3vvA5EEnNX9atxY.jpg', 0),
(24, 'Ambiciozna kampanja', 'Kako bi potaknuo građane na ekološki osvještenije ponašanje, Grad Zagreb lansirao je novu kampanju koja uključuje postavljanje dodatnih reciklažnih otoka i edukativne radionice u školama.', 'Grad Zagreb predstavio je danas svoj novi plan za unapređenje sustava reciklaže u cilju smanjenja količine otpada i očuvanja okoliša. U narednih godinu dana bit će postavljeno preko 200 novih reciklažnih otoka na ključnim lokacijama u gradu, što bi trebalo olakšati građanima odvajanje plastike, papira i stakla. Uz to, u suradnji s lokalnim školama, Grad će organizirati radionice i edukacije za najmlađe, kako bi od malih nogu razvili svijest o važnosti očuvanja prirode. Gradonačelnik je naglasio kako je ovo samo jedan korak u širem planu zelenog razvoja Zagreba te pozvao sve građane da se uključe u ovu inicijativu.', 1, 'zagreb.jpg', 0),
(25, 'Sabor usvojio novi zakon', 'Nakon višemjesečnih rasprava, Hrvatski sabor usvojio je izmjene zakona o radu koje omogućuju radnicima veću zaštitu prava, uvođenje fleksibilnih radnih aranžmana i jačanje inspekcijskih ovlasti.', 'U velikoj sjednici održanoj jučer, Hrvatski sabor usvojio je novi Zakon o radu koji donosi značajne promjene u odnosima između poslodavaca i zaposlenika. Najvažnije novine uključuju mogućnost rada od kuće i fleksibilnog radnog vremena, što će radnicima omogućiti bolju ravnotežu između poslovnih i privatnih obveza. Također, zakon uvodi strože kazne za poslodavce koji krše radnička prava te jača ulogu inspektorata rada u kontroli radnih uvjeta. Ministar rada istaknuo je kako će ove promjene pomoći u smanjenju sive ekonomije i podizanju kvalitete života zaposlenih. Unatoč općem zadovoljstvu, neki sindikati izrazili su zabrinutost zbog nejasnoća u provedbi novog zakona, no očekuje se da će dodatni pravilnici uskoro razjasniti sve nedoumice.', 2, 'DSC_2294.jpg', 0),
(26, 'Održan sastanak EU lidera', 'Na nedavnom samitu Europske unije, lideri država članica raspravljali su o zajedničkim strategijama za borbu protiv klimatskih promjena i postavljanju ambicioznijih ciljeva.', 'Samit Europske unije održan prošlog tjedna okupio je lidere država članica kako bi razgovarali o važnim pitanjima vezanim uz klimatske promjene. Glavne teme bile su smanjenje emisije stakleničkih plinova, ulaganja u obnovljive izvore energije te potpora zemljama u tranziciji prema održivijoj ekonomiji. Predsjednik Europske komisije istaknuo je da je suradnja ključna za postizanje ciljeva Pariškog sporazuma. Neki su sudionici izrazili zabrinutost zbog ekonomskih posljedica, ali su se složili da je nužno djelovati brzo i odlučno. Očekuje se da će dogovoreni planovi utjecati i na nacionalne politike zemalja članica.', 2, '20220608PHT32510_original.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(4, 'admin', '$2y$10$Pgzs20fMVeXwzYSYg1NKReNasuA/JNg8SHm5p3G54lijf25l7LXvq'),
(6, 'proba', '$2y$10$RM77qODIXjeO.vzYkSM3.OQdhipS7rCPA4u/gfK.bY4eu6K3DLTba'),
(7, 'proba123', '$2y$10$v6jXI27sg2EPXWUVOgvTCeaQdQMjx3sBfEIyTJQ0nSrqx6VPALsgq'),
(8, 'a', '$2y$10$kdv7JSPnp6cIc/2q26z.GufyxMXSckiqze4LyiDNW2KQldMcYdTz6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_kategorija` (`kategorija_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `fk_kategorija` FOREIGN KEY (`kategorija_id`) REFERENCES `kategorija` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
