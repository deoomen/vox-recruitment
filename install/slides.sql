-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 16 Sie 2020, 13:20
-- Wersja serwera: 10.3.22-MariaDB-1ubuntu1
-- Wersja PHP: 7.4.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `vox-recruitment`
--

--
-- Zrzut danych tabeli `slide`
--

INSERT INTO `slide` (`id`, `title`, `text`, `no`) VALUES
(1, '1111', '111111111111111111', NULL),
(2, '222', '22222222', NULL),
(3, '333', '33333333333', NULL),
(4, '444', '44444444444', NULL),
(5, '555', '5555555555', NULL),
(6, '666', '666666666666', NULL),
(7, '777', '77777777777', NULL),
(8, '888', '88888888', NULL),
(9, '999', '999999999', NULL),
(10, '10', '1010101010101010', NULL),
(11, '11', '11111111111111111', NULL),
(12, '12', '1211212121221212122', NULL);

--
-- Zrzut danych tabeli `slide_photo`
--

INSERT INTO `slide_photo` (`id`, `id_slide`, `filename`, `no`) VALUES
(1, 1, 'https://dummyimage.com/300x200/000/fff.jpg&text=1-1', NULL),
(2, 1, 'https://dummyimage.com/150x200/cf23cf/fff.jpg&text=1-2', NULL),
(3, 1, 'https://dummyimage.com/150x200/2399cf/fff.jpg&text=1-3', NULL),
(4, 1, 'https://dummyimage.com/100x150/76cf23/fff.jpg&text=1-4', NULL),
(5, 1, 'https://dummyimage.com/150x100/cfcf23/fff.jpg&text=1-5', NULL),
(6, 1, 'https://dummyimage.com/150x100/cf9923/fff.jpg&text=1-6', NULL),
(7, 1, 'https://dummyimage.com/150x200/cf4e23/fff.jpg&text=1-7', NULL),
(8, 1, 'https://dummyimage.com/300x400/23bbcf/fff.jpg&text=1-8', NULL),
(9, 2, 'https://dummyimage.com/300x200/0a0a0a/fff.jpg&text=2-1', NULL),
(10, 2, 'https://dummyimage.com/150x200/4fb3c1/fff.jpg&text=2-2', NULL),
(11, 2, 'https://dummyimage.com/150x200/c3fd11/fff.jpg&text=2-3', NULL),
(12, 2, 'https://dummyimage.com/100x150/a61ff3/fff.jpg&text=2-4', NULL),
(13, 2, 'https://dummyimage.com/150x100/c0c929/fff.jpg&text=2-5', NULL),
(14, 2, 'https://dummyimage.com/150x100/0f19f3/fff.jpg&text=2-6', NULL),
(15, 2, 'https://dummyimage.com/150x200/ff5e03/fff.jpg&text=2-7', NULL),
(16, 2, 'https://dummyimage.com/300x400/713ff0/fff.jpg&text=2-8', NULL),
(17, 3, 'https://dummyimage.com/300x200/a0a0a0/fff.jpg&text=3-1', NULL),
(18, 3, 'https://dummyimage.com/150x200/f13b1c/fff.jpg&text=3-2', NULL),
(19, 3, 'https://dummyimage.com/150x200/3cdf11/fff.jpg&text=3-3', NULL),
(20, 3, 'https://dummyimage.com/100x150/6af13f/fff.jpg&text=3-4', NULL),
(21, 3, 'https://dummyimage.com/150x100/0c9c92/fff.jpg&text=3-5', NULL),
(22, 3, 'https://dummyimage.com/150x100/f0913f/fff.jpg&text=3-6', NULL),
(23, 3, 'https://dummyimage.com/150x200/ffe530/fff.jpg&text=3-7', NULL),
(24, 3, 'https://dummyimage.com/300x400/17f30f/fff.jpg&text=3-8', NULL),
(25, 4, 'https://dummyimage.com/300x200/ac158d/fff.jpg&text=4-1', NULL),
(26, 4, 'https://dummyimage.com/150x200/ff75a9/fff.jpg&text=4-2', NULL),
(27, 4, 'https://dummyimage.com/150x200/75a9ff/fff.jpg&text=4-3', NULL),
(28, 4, 'https://dummyimage.com/150x200/a975ff/fff.jpg&text=4-4', NULL),
(29, 4, 'https://dummyimage.com/150x200/a9ff75/fff.jpg&text=4-5', NULL),
(30, 4, 'https://dummyimage.com/150x100/75ffa9/fff.jpg&text=4-6', NULL),
(31, 4, 'https://dummyimage.com/150x100/acd851/fff.jpg&text=4-7', NULL),
(32, 4, 'https://dummyimage.com/300x400/dc581d/fff.jpg&text=4-8', NULL),
(33, 5, 'https://dummyimage.com/300x200/ca51d8/fff.jpg&text=5-1', NULL),
(34, 5, 'https://dummyimage.com/150x200/ff579a/fff.jpg&text=5-2', NULL),
(35, 5, 'https://dummyimage.com/150x200/579aff/fff.jpg&text=5-3', NULL),
(36, 5, 'https://dummyimage.com/150x200/9a57ff/fff.jpg&text=5-4', NULL),
(37, 5, 'https://dummyimage.com/150x200/9aff57/fff.jpg&text=5-5', NULL),
(38, 5, 'https://dummyimage.com/150x100/57ff9a/fff.jpg&text=5-6', NULL),
(39, 5, 'https://dummyimage.com/150x100/ca8d15/fff.jpg&text=5-7', NULL),
(40, 5, 'https://dummyimage.com/300x400/cd85d1/fff.jpg&text=5-8', NULL),
(41, 6, 'https://dummyimage.com/300x200/d851ac/fff.jpg&text=6-1', NULL),
(42, 6, 'https://dummyimage.com/150x200/9a57ff/fff.jpg&text=6-2', NULL),
(43, 6, 'https://dummyimage.com/150x200/dd759a/fff.jpg&text=6-3', NULL),
(44, 6, 'https://dummyimage.com/150x200/ff57a9/fff.jpg&text=6-4', NULL),
(45, 6, 'https://dummyimage.com/150x200/cd8a15/fff.jpg&text=6-5', NULL),
(46, 6, 'https://dummyimage.com/150x100/9ffa75/fff.jpg&text=6-6', NULL),
(47, 6, 'https://dummyimage.com/150x100/158dca/fff.jpg&text=6-7', NULL),
(48, 6, 'https://dummyimage.com/300x400/d185cd/fff.jpg&text=6-8', NULL),
(49, 7, 'https://dummyimage.com/300x200/1299cd/fff.jpg&text=7-1', NULL),
(50, 7, 'https://dummyimage.com/150x200/dc5899/fff.jpg&text=7-2', NULL),
(51, 7, 'https://dummyimage.com/150x200/5cd8a1/fff.jpg&text=7-3', NULL),
(52, 7, 'https://dummyimage.com/150x200/dd85c1/fff.jpg&text=7-4', NULL),
(53, 7, 'https://dummyimage.com/150x100/957ffa/fff.jpg&text=7-5', NULL),
(54, 7, 'https://dummyimage.com/150x100/c8a51d/fff.jpg&text=7-6', NULL),
(55, 7, 'https://dummyimage.com/150x200/df594a/fff.jpg&text=7-7', NULL),
(56, 7, 'https://dummyimage.com/300x400/ddd89f/fff.jpg&text=7-8', NULL),
(57, 8, 'https://dummyimage.com/300x200/99cd12/fff.jpg&text=8-1', NULL),
(58, 8, 'https://dummyimage.com/150x200/58dc99/fff.jpg&text=8-2', NULL),
(59, 8, 'https://dummyimage.com/150x200/d8a15c/fff.jpg&text=8-3', NULL),
(60, 8, 'https://dummyimage.com/150x200/85c1dd/fff.jpg&text=8-4', NULL),
(61, 8, 'https://dummyimage.com/150x100/7ffa59/fff.jpg&text=8-5', NULL),
(62, 8, 'https://dummyimage.com/150x100/a51d8c/fff.jpg&text=8-6', NULL),
(63, 8, 'https://dummyimage.com/150x200/d89fdd/fff.jpg&text=8-7', NULL),
(64, 8, 'https://dummyimage.com/300x400/89fddd/fff.jpg&text=8-8', NULL),
(65, 9, 'https://dummyimage.com/300x200/21dc99/fff.jpg&text=9-1', NULL),
(66, 9, 'https://dummyimage.com/150x200/99cd58/fff.jpg&text=9-2', NULL),
(67, 9, 'https://dummyimage.com/150x200/c51a8d/fff.jpg&text=9-3', NULL),
(68, 9, 'https://dummyimage.com/150x200/dd1c58/fff.jpg&text=9-4', NULL),
(69, 9, 'https://dummyimage.com/150x100/95aff7/fff.jpg&text=9-5', NULL),
(70, 9, 'https://dummyimage.com/150x100/c8d15a/fff.jpg&text=9-6', NULL),
(71, 9, 'https://dummyimage.com/150x200/ddf98d/fff.jpg&text=9-7', NULL),
(72, 9, 'https://dummyimage.com/300x400/dddf98/fff.jpg&text=9-8', NULL),
(73, 10, 'https://dummyimage.com/300x200/888888/fff.jpg&text=10-1', NULL),
(74, 10, 'https://dummyimage.com/150x200/c2199d/fff.jpg&text=10-2', NULL),
(75, 10, 'https://dummyimage.com/150x200/dc15a8/fff.jpg&text=10-3', NULL),
(76, 10, 'https://dummyimage.com/150x100/8c1dd5/fff.jpg&text=10-4', NULL),
(77, 10, 'https://dummyimage.com/150x100/ca8d51/fff.jpg&text=10-5', NULL),
(78, 10, 'https://dummyimage.com/150x200/a8d51c/fff.jpg&text=10-6', NULL),
(79, 10, 'https://dummyimage.com/150x200/d9fd8d/fff.jpg&text=10-7', NULL),
(80, 10, 'https://dummyimage.com/300x400/df9d8a/fff.jpg&text=10-8', NULL),
(81, 11, 'https://dummyimage.com/300x200/6fd8bb/fff.jpg&text=11-1', NULL),
(82, 11, 'https://dummyimage.com/150x200/a2587c/fff.jpg&text=11-2', NULL),
(83, 11, 'https://dummyimage.com/150x200/ae569e/fff.jpg&text=11-3', NULL),
(84, 11, 'https://dummyimage.com/150x100/ee459a/fff.jpg&text=11-4', NULL),
(85, 11, 'https://dummyimage.com/150x100/a9eca4/fff.jpg&text=11-5', NULL),
(86, 11, 'https://dummyimage.com/150x200/4563af/fff.jpg&text=11-6', NULL),
(87, 11, 'https://dummyimage.com/150x200/fa879c/fff.jpg&text=11-7', NULL),
(88, 11, 'https://dummyimage.com/300x400/1c7e6a/fff.jpg&text=11-8', NULL),
(89, 12, 'https://dummyimage.com/300x200/a6e71c/fff.jpg&text=12-1', NULL),
(90, 12, 'https://dummyimage.com/150x200/c978af/fff.jpg&text=12-2', NULL),
(91, 12, 'https://dummyimage.com/150x200/f46a3f/fff.jpg&text=12-3', NULL),
(92, 12, 'https://dummyimage.com/150x100/4a9c4e/fff.jpg&text=12-4', NULL),
(93, 12, 'https://dummyimage.com/150x100/e6a894/fff.jpg&text=12-5', NULL),
(94, 12, 'https://dummyimage.com/150x200/da719a/fff.jpg&text=12-6', NULL),
(95, 12, 'https://dummyimage.com/150x200/d8d479/fff.jpg&text=12-7', NULL),
(96, 12, 'https://dummyimage.com/300x400/8c6e1a/fff.jpg&text=12-8', NULL);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
