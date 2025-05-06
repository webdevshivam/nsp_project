-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2025 at 08:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `become_driver`
--

CREATE TABLE `become_driver` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `return_date` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `customer_name`, `vehicle_id`, `booking_date`, `return_date`, `status`) VALUES
(1, 'Shivam Kushwah', 2, '2025-04-11', '2025-04-28', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'Shivam Kushwah', 'webdev.shivamkushwah@gmail.com', 'Project or Email', 'this is the message for the great purpose', '2025-04-28 17:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `license_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `phone`, `license_number`) VALUES
(2, 'Shivam ', '9520683039', '4234234243'),
(3, 'Another Shivam', '9520683066', '21321321213');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `expense_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_type`, `amount`, `expense_date`, `description`, `created_at`) VALUES
(1, 'Fuel', 100.00, '2025-04-17', 'Some Description', '2025-04-28 16:02:26');

-- --------------------------------------------------------

--
-- Table structure for table `trip_requests`
--

CREATE TABLE `trip_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `dropoff_location` varchar(255) NOT NULL,
  `pickup_date` date NOT NULL,
  `dropoff_date` date NOT NULL,
  `pickup_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trip_requests`
--

INSERT INTO `trip_requests` (`id`, `name`, `pickup_location`, `dropoff_location`, `pickup_date`, `dropoff_date`, `pickup_time`, `created_at`) VALUES
(2, 'Shivam Kushwah', 'Rajkumar', 'Same Drop Location', '2025-04-24', '2025-04-30', '00:00:00', '2025-04-28 18:19:44');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `model` varchar(100) NOT NULL,
  `license_plate` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `per_day_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vehicle_name`, `model`, `license_plate`, `type`, `image`, `per_day_price`, `created_at`) VALUES
(1, 'Nano', 'Nano - Ultimate Model', '24332422231', 'Sedan', '1745858740_680fb0b449843.jpg', 12.00, '2025-04-28 15:58:11'),
(2, 'OMNI', 'OMNI - the GOAT', '2141242133', 'Van', '1745858787_680fb0e395ad5.jpg', 121.00, '2025-04-28 16:46:27'),
(3, 'Waganar', '324234324', '43242342423', 'Sedan', '1745858960_680fb190c7319.jpg', 12.00, '2025-04-28 16:49:20'),
(4, 'Bolero - JODD!!!', 'Bolero 2343', '2141242133', 'Van', '1745859154_680fb2527f096.jpg', 12.00, '2025-04-28 16:52:34'),
(5, 'ALTO ', 'ALTO 800', '213213213', 'Van', '1745859250_680fb2b2c6bf2.jpg', 2.00, '2025-04-28 16:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_inspections`
--

CREATE TABLE `vehicle_inspections` (
  `id` int(11) NOT NULL,
  `inspection_date` date NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `inspector` varchar(100) NOT NULL,
  `vehicle_condition` varchar(20) NOT NULL,
  `mileage` varchar(50) NOT NULL,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_inspections`
--

INSERT INTO `vehicle_inspections` (`id`, `inspection_date`, `vehicle_id`, `inspector`, `vehicle_condition`, `mileage`, `remarks`, `created_at`) VALUES
(1, '2025-04-08', '1', 'Shivam Kushwah', 'Excellent', '12', '', '2025-04-28 15:59:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `become_driver`
--
ALTER TABLE `become_driver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trip_requests`
--
ALTER TABLE `trip_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_inspections`
--
ALTER TABLE `vehicle_inspections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `become_driver`
--
ALTER TABLE `become_driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trip_requests`
--
ALTER TABLE `trip_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_inspections`
--
ALTER TABLE `vehicle_inspections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
