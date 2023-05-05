-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 05:33 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_name`, `address`) VALUES
(2, 'Paijo', 'jl. Kutilang berkicau 12, jakarta barat');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_stock`
--

CREATE TABLE `mutasi_stock` (
  `id` int(11) NOT NULL,
  `tgl_mutasi` date DEFAULT NULL,
  `pcode` char(8) DEFAULT NULL,
  `order_id` varchar(20) DEFAULT NULL,
  `type_mutasi` char(2) DEFAULT NULL,
  `jumlah` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi_stock`
--

INSERT INTO `mutasi_stock` (`id`, `tgl_mutasi`, `pcode`, `order_id`, `type_mutasi`, `jumlah`) VALUES
(1, '2023-05-05', '23050001', 'INV/05/2023/0006', 'O', 66),
(2, '2023-05-05', '23050002', 'INV/05/2023/0006', 'O', 2),
(3, '2023-05-05', '23050001', 'INV/05/2023/0006', 'O', 66),
(4, '2023-05-05', '23050002', 'INV/05/2023/0006', 'O', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` varchar(20) NOT NULL,
  `pcode` char(8) NOT NULL,
  `qty` int(3) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `subtotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_id`, `pcode`, `qty`, `price`, `subtotal`) VALUES
(2, 'INV/05/2023/0005', '23050001', 10, 10000, 100000),
(4, 'INV/05/2023/0004', '23050001', 2, 10000, 20000),
(5, 'INV/05/2023/0004', '23050002', 6, 12000, 72000),
(6, 'INV/05/2023/0006', '23050001', 66, 10000, 660000),
(7, 'INV/05/2023/0006', '23050002', 2, 12000, 24000);

-- --------------------------------------------------------

--
-- Table structure for table `order_header`
--

CREATE TABLE `order_header` (
  `order_id` varchar(20) NOT NULL,
  `order_date` date DEFAULT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `promo_code` char(8) DEFAULT NULL,
  `amount_discount` double DEFAULT NULL,
  `net` double DEFAULT NULL,
  `ppn` double DEFAULT NULL,
  `total` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_header`
--

INSERT INTO `order_header` (`order_id`, `order_date`, `customer_name`, `promo_code`, `amount_discount`, `net`, `ppn`, `total`) VALUES
('INV/05/2023/0001', '2023-05-05', 'dd', 'd', NULL, NULL, NULL, 0),
('INV/05/2023/0002', '2023-05-05', NULL, NULL, NULL, NULL, NULL, 0),
('INV/05/2023/0003', '2023-05-05', NULL, NULL, NULL, NULL, NULL, 0),
('INV/05/2023/0004', '2023-05-05', 'Paijo', 'pmo-0001', 10000, 92000, 8200, 90200),
('INV/05/2023/0005', '2023-05-05', NULL, NULL, NULL, NULL, NULL, 0),
('INV/05/2023/0006', '2023-05-05', 'Paijo', 'pmo-0001', 10000, 684000, 67400, 741400);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pcode` char(8) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pcode`, `product_name`, `price`) VALUES
('23050001', 'MIRANDA H.C N.BLACK 30.MC1', 10000),
('23050002', 'Produk MCL new', 12000);

-- --------------------------------------------------------

--
-- Table structure for table `promo`
--

CREATE TABLE `promo` (
  `promo_code` char(8) NOT NULL,
  `promo_name` varchar(150) DEFAULT NULL,
  `promo_nom` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `promo`
--

INSERT INTO `promo` (`promo_code`, `promo_name`, `promo_nom`) VALUES
('pmo-0001', 'Setiap pembelian MIRANDA H.C N.BLACK 30.MC1, mendapat porongan 1000', 10000),
('pmo-0002', 'uangme', 34000);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `pcode` char(8) NOT NULL,
  `jumlah` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`pcode`, `jumlah`) VALUES
('23050001', 68),
('23050002', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `mutasi_stock`
--
ALTER TABLE `mutasi_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `order_header`
--
ALTER TABLE `order_header`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pcode`);

--
-- Indexes for table `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_code`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`pcode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mutasi_stock`
--
ALTER TABLE `mutasi_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
