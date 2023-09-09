-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2023 at 08:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `example_library`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `rent_information_with_popularity` ()   BEGIN
    SELECT users.name AS nama_penyewa, rooms.name AS nama_ruangan, rents.duration, is_popular(rooms.rented_count) AS room_status
    FROM rents 
    JOIN users ON rents.user_id = users.id
    JOIN rooms ON rents.room_id = rooms.id;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `is_popular` (`rented_count` INT) RETURNS VARCHAR(20) CHARSET utf8mb4 COLLATE utf8mb4_general_ci DETERMINISTIC BEGIN
    DECLARE details_popular VARCHAR(15);
    IF rented_count > 4 THEN
        SET details_popular = 'PALING LAKU';
    ELSE
        SET details_popular = 'KURANG LAKU';
    END IF;
    RETURN details_popular;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `rents`
--

CREATE TABLE `rents` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rents`
--

INSERT INTO `rents` (`id`, `user_id`, `room_id`, `duration`) VALUES
(1, 1, 1, 10),
(2, 2, 1, 10),
(3, 3, 2, 20),
(4, 3, 3, 10);

--
-- Triggers `rents`
--
DELIMITER $$
CREATE TRIGGER `increase_rented_count` AFTER INSERT ON `rents` FOR EACH ROW BEGIN
  UPDATE rooms
  SET rented_count = rented_count + 1
  WHERE id = NEW.room_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `rent_information`
-- (See below for the actual view)
--
CREATE TABLE `rent_information` (
`nama_penyewa` varchar(100)
,`nama_ruangan` varchar(100)
,`durasi_sewa` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `rented_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `rented_count`) VALUES
(1, 'melati', 5),
(2, 'mawar', 3),
(3, 'floris', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `address`) VALUES
(1, 'asyifa', 'bandung'),
(2, 'maulana', 'karawang'),
(4, 'asep', 'medan');

-- --------------------------------------------------------

--
-- Structure for view `rent_information`
--
DROP TABLE IF EXISTS `rent_information`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rent_information`  AS SELECT `users`.`name` AS `nama_penyewa`, `rooms`.`name` AS `nama_ruangan`, `rents`.`duration` AS `durasi_sewa` FROM ((`rents` join `users` on(`rents`.`user_id` = `users`.`id`)) join `rooms` on(`rents`.`room_id` = `rooms`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rents`
--
ALTER TABLE `rents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rents`
--
ALTER TABLE `rents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
