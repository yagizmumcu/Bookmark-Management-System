-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2020 at 04:01 PM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bms`
--

-- --------------------------------------------------------


DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `type_name` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_name`) VALUES
('PHP'),
('C'),
('Python'),
('Javascript'),
('Opengl'),
('Chess'),
('Unity');


--
-- Table structure for table `bookmark`
--

DROP TABLE IF EXISTS `bookmark`;
CREATE TABLE IF NOT EXISTS `bookmark` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  `url` varchar(512) COLLATE utf8mb4_turkish_ci NOT NULL,
  `note` text COLLATE utf8mb4_turkish_ci NOT NULL,
  `owner` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type_name` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `title`, `url`, `note`, `owner`, `created`,`type_name`) VALUES
(72, 'Free 3D Models', 'https://www.cgtrader.com/free-3d-models', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, nostrum? Molestiae ullam incidunt quos fuga repellendus quo officia hic numquam quis quaerat illum velit nulla, tempora aliquam reprehenderit, dolore maiores.', 74, '2020-05-06 15:29:11', 'PHP'),
(73, 'Yamaha Recent Motorbike Prices', 'https://www.yamaha-motor.eu/tr/tr/Deneyim/', 'A reprehenderit officiis mollitia tempora perferendis corrupti non nihil porro ipsa consequuntur error impedit similique pariatur commodi laudantium placeat, saepe quasi voluptas?\r\nDolorum, architecto! Autem laborum numquam voluptatum esse voluptatibus omnis minus reiciendis consequatur exercitationem, adipisci dolorum veritatis voluptates consequuntur sit illo voluptas, ipsa labore atque ratione hic? Ex cumque similique tempora.\r\nAd obcaecati dolor reiciendis delectus dicta ea, dolorem a porro, error', 74, '2020-05-06 15:51:53', 'C'),
(74, 'PHP Reference Page', 'http://www.php.net', 'This site is the main page for php functions.', 74, '2020-05-06 15:52:26', 'PHP'),
(75, 'Learn about Material Design and our Project Team', 'https://materializecss.com/preloader.html', 'Created and designed by Google, Material Design is a design language that combines the classic principles of successful design along with innovation and technology. Google\'s goal is to develop a system of design that allows for a unified user experience across all their products on any platform.', 74, '2020-05-06 15:53:23', 'Unity'),
(76, 'The new way to improve your programming skills while having fun and getting noticed', 'https://www.codingame.com/start', 'At CodinGame, our goal is to let programmers keep on improving their coding skills by solving the World\'s most challenging problems, learn new concepts, and get inspired by the best developers.', 74, '2020-05-06 15:54:50', 'Javascript'),
(77, 'Unity ', 'https://unity.com/', 'Create, operate, and monetize your interactive and immersive experiences with the world’s most widely used real-time development platform.', 74, '2020-05-06 15:56:26', 'Unity'),
(78, 'WebGL Fundamentals', 'https://webglfundamentals.org/', 'WebGL (Web Graphics Library) is often thought of as a 3D API. People think \"I\'ll use WebGL and magic I\'ll get cool 3d\". In reality WebGL is just a rasterization engine. It draws points, lines, and triangles based on code you supply. Getting WebGL to do anything else is up to you to provide code to use points, lines, and triangles to accomplish your task.', 74, '2020-05-06 15:57:32', 'Javascript'),
(79, 'Exploring ES6', 'https://exploringjs.com/es6/', 'Free book for ES6', 74, '2020-05-06 15:58:49', 'Javascript'),
(80, 'Clara.io for 3D Modelling', 'https://clara.io/learn/user-guide/modeling/modeling_basics', 'Modeling is the process of creating 3D geometric meshes that will eventually be textured, animated, and rendered in your final product.', 74, '2020-05-06 15:59:53', 'Python'),
(81, 'Bobby Fischer Teaches Chess', 'https://books.google.com.tr/books?id=TnVYAAAAYAAJ&redir_esc=y', 'Bobby Fischer Teaches Chess is a chess puzzle book written by Bobby Fischer and co-authored by Stuart Margulies and Don Mosenfelder, originally published in 1966. It is one of the best-selling chess books of all time, with over one million copies sold', 74, '2020-05-06 15:59:53', 'Chess'),
(82, 'My 60 Memorable Games by Bobby Fischer', 'https://www.amazon.com/My-Memorable-Games-Bobby-Fischer/dp/190638830X', 'My 60 Memorable Games is a chess book by Bobby Fischer, first published in 1969. It is a collection of his games dating from the 1957 New Jersey Open to the 1967 Sousse Interzonal. Unlike many players anthologies, which are often titled My Best Games and include only victories, My 60 Memorable Games includes nine draws and three losses. It has been described as a classic of objective and painstaking analysis and is regarded as one of the great pieces of chess literature', 74, '2020-05-06 15:59:53', 'Chess');
-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  `email` varchar(256) COLLATE utf8mb4_turkish_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_turkish_ci NOT NULL,
  `bday` date DEFAULT NULL,
  `notifications` int(11) DEFAULT 0,
  `profile` varchar(100) COLLATE utf8mb4_turkish_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `bday`,`notifications`, `profile`) VALUES
(74, 'John Vue', 'john@one.com', '$2y$10$ZT1zUTSywDs4xy5BBWS5C.tcLUyBDTWGj7Okacua36m60oYQUFW8S', NULL, 0, NULL),
(75, 'Hikaru Nakamura', 'GMHikaru@protonmail.com', '$2y$10$kGN88l40GtF6gidDYItxle6MONQUQWsgitoOHNxZlUQPTlqd9xhoG', NULL, 0, NULL),
(76, 'Magnus Carlsen', 'GMMagnus@protonmail.com', '$2y$10$b0FHbebYXHdeu0guPUBPgeaV6kFfj6RF3lebXnugDzDC3nn.ypyJm', NULL, 0, NULL),
(77, 'Fabiano Caruana', 'GMFabi@protonmail.com', '$2y$10$fkRCPVNMgCuFFyk.JF7U6Ofta0o07bUS8n0VERkbSIeS2rPWU3YBK', NULL, 0, NULL);


--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
