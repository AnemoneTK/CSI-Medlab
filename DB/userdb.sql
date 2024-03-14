-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 05:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `customer_tel` int(10) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `roleID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fullname`, `username`, `userPassword`, `roleID`) VALUES
(1, 'Admin Account', 'Admin', 'e3823b5071f291b71b94c203987ba891', 3),
(2, 'User Account', 'User', 'e20bcb1b02b2c87cdf4026aebf4eb797', 2),
(3, 'Manager Account', 'Manager', '7d43cb86d5bfff1b0700004782f55aa3', 1),
(4, 'นริศรา จ่างสะเดา', '65039089', '1307f262de078fab6bddee538de59883', 2),
(5, 'นนท์ ยิ่งคง', 'Non', '4522dc7e1ffb5dd09f1a3fe5c0607801', 3),
(6, 'Test', 'Test002', '9f719096b3840922cd359395ec048ecd', 2);

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` int(11) NOT NULL,
  `op_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `p_name` text NOT NULL,
  `type_id` int(3) NOT NULL,
  `p_detail` text NOT NULL,
  `p_use` text NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_lmt` int(11) NOT NULL,
  `unit_id` int(3) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date DEFAULT NULL,
  `bf_dueDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `op_id`, `p_id`, `p_name`, `type_id`, `p_detail`, `p_use`, `qty`, `qty_lmt`, `unit_id`, `insert_date`, `due_date`, `bf_dueDate`) VALUES
(1, 1, 1, 'Abacavir (อะบาคาเวียร์) ', 2, 'ช่วยลดจำนวนเชื้อเอชไอวีในร่างกายของผู้ป่วยที่ติดเชื้อ', 'ยารับประทาน', 500, 100, 5, '2023-11-27 16:19:36', '2024-01-15', 30),
(2, 2, 2, 'Acetazolamide (อะเซตาโซลาไมด์)', 2, 'รักษาโรคต้อหิน ลมชัก ขับปัสสาวะ ป้องกันและลดอาการที่เกิดจากการขึ้นที่สูง', 'ยารับประทาน ยาฉีด', 100, 50, 2, '2023-11-27 16:24:30', '2024-01-15', 2),
(3, 2, 2, 'Acetazolamide (อะเซตาโซลาไมด์)', 2, 'รักษาโรคต้อหิน ลมชัก ขับปัสสาวะ ป้องกันและลดอาการที่เกิดจากการขึ้นที่สูง', 'ยารับประทาน ยาฉีด', 100, 50, 2, '2023-11-28 16:24:10', '2024-01-15', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `op_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `p_name` text NOT NULL,
  `type_id` int(3) NOT NULL,
  `p_detail` text NOT NULL,
  `p_use` text NOT NULL,
  `wh_id` int(3) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_lmt` int(11) NOT NULL,
  `unit_id` int(3) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `due_date` date NOT NULL,
  `bf_dueDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`op_id`, `p_id`, `p_name`, `type_id`, `p_detail`, `p_use`, `wh_id`, `qty`, `qty_lmt`, `unit_id`, `insert_date`, `due_date`, `bf_dueDate`) VALUES
(1, 1, 'Doxycycline (ด็อกซีไซคลิน) ', 2, 'ยาปฏิชีวนะในกลุ่มเตตราไซคลิน (Tetracycline) โดยมีคุณสมบัติรักษาอาการติดเชื้อแบคทีเรียต่าง ๆ เช่น สิว การติดเชื้อในระบบทางเดินปัสสาวะ การติดเชื้อในลำไส้ใหญ่ ติดเชื้อที่ตา โรคหนองในแท้ โรคหนองในเทียม และโรคเหงือก', 'Category D จากการศึกษาในมนุษย์ พบความเสี่ยงทำให้เกิดความผิดปกติต่อทารกในครรภ์ จะใช้ก็ต่อเมื่อพิจารณาแล้วว่า ก่อให้เกิดประโยชน์ต่อมารดาและยอมรับความเสี่ยงที่อาจเกิดต่อทารกในครรภ์ โดยมากมักใช้ในกรณีที่จำเป็นในการช่วยชีวิต หรือใช้รักษาโรคร้ายแรงของมารดา ซึ่งไม่สามารถใช้ยาอื่น ๆ ทดแทนได้  สตรีมีครรภ์หรือให้นมบุตรควรหลีกเลี่ยงการใช้ยานี้', 1, 200, 100, 2, '2023-11-28 16:26:58', '2023-12-09', 10),
(2, 2, 'Acetazolamide (อะเซตาโซลาไมด์)', 2, 'รักษาโรคต้อหิน ลมชัก ขับปัสสาวะ ป้องกันและลดอาการที่เกิดจากการขึ้นที่สูง', 'ยารับประทาน ยาฉีด', 2, 100, 50, 2, '2023-11-22 16:56:42', '2023-12-09', 2),
(3, 3, 'Bisacodyl (บิซาโคดิล)', 2, 'รักษาอาการท้องผูก', 'เด็กอายุ 4-10 ปี รับประทานยา 5 มิลลิกรัม ก่อนนอน\r\nผู้ใหญ่ รับประทานยา 5-10 มิลลิกรัม สูงสุดไม่เกิน 20 มิลลิกรัม ก่อนนอน', 3, 275, 150, 2, '2023-11-22 16:56:42', '2023-12-02', 20),
(4, 4, 'Baclofen (บาโคลเฟน) ', 2, 'บรรเทาอาการกล้ามเนื้อหดเกร็ง', 'ยารับประทาน', 1, 500, 150, 5, '2023-11-22 16:56:42', '2023-12-30', 10),
(5, 5, 'Paracetamol(พาราเซตามอล)', 1, 'บรรเทาอาการปวดลดไข้', 'ยาน้ำสำหรับเด็ก แพทย์หรือเภสัชกรจะคำนวณปริมาณยาแต่ละมื้อตามน้ำหนักตัวของเด็กแต่ละคน', 2, 300, 100, 2, '2023-11-25 02:47:02', '2024-01-30', 30),
(6, 6, 'Flunarizine (ฟลูนาริซีน)', 2, 'ป้องกันโรคไมเกรน บรรเทาอาการวิงเวียนศีรษะ', 'ยารับประทาน', 3, 200, 100, 4, '2023-11-22 16:56:42', '2024-01-31', 30);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`type_id`, `type_name`) VALUES
(1, 'ยาน้ำ'),
(2, 'ยาเม็ด');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `roleID` int(1) NOT NULL,
  `roleName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `roleName`) VALUES
(1, 'ผู้บริหาร'),
(2, 'เจ้าหน้าที่'),
(3, 'ผู้ดูแล');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unitID` int(3) NOT NULL,
  `unitName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unitID`, `unitName`) VALUES
(1, 'กระป๋อง'),
(2, 'กล่อง'),
(3, 'แคปซูล'),
(4, 'ชุด'),
(5, 'กระปุก');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `wh_id` int(11) NOT NULL,
  `wh_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`wh_id`, `wh_name`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE `withdraw` (
  `withdraw_id` int(11) NOT NULL,
  `op_id` int(5) NOT NULL,
  `p_id` int(5) NOT NULL,
  `p_name` text NOT NULL,
  `type_id` int(3) NOT NULL,
  `withdraw` int(11) NOT NULL,
  `unit_id` int(3) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `warning` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`withdraw_id`, `op_id`, `p_id`, `p_name`, `type_id`, `withdraw`, `unit_id`, `insert_date`, `warning`) VALUES
(1, 5, 5, 'Paracetamol(พาราเซตามอล)', 1, 100, 2, '2023-11-28 16:23:46', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_emp_role` (`roleID`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_type_od` (`type_id`),
  ADD KEY `fk_unitID_od` (`unit_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`op_id`),
  ADD KEY `fk_unitID` (`unit_id`),
  ADD KEY `fk_typeID` (`type_id`),
  ADD KEY `fk_whID` (`wh_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`roleID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unitID`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`wh_id`);

--
-- Indexes for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD PRIMARY KEY (`withdraw_id`),
  ADD KEY `fk_type_wd` (`type_id`),
  ADD KEY `fk_unit_wd` (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_product`
--
ALTER TABLE `order_product`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `op_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `roleID` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unitID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `wh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdraw`
--
ALTER TABLE `withdraw`
  MODIFY `withdraw_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `fk_emp_role` FOREIGN KEY (`roleID`) REFERENCES `role` (`roleID`);

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `fk_type_od` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`),
  ADD CONSTRAINT `fk_unitID_od` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unitID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_typeID` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`),
  ADD CONSTRAINT `fk_unitID` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unitID`),
  ADD CONSTRAINT `fk_whID` FOREIGN KEY (`wh_id`) REFERENCES `warehouse` (`wh_id`);

--
-- Constraints for table `withdraw`
--
ALTER TABLE `withdraw`
  ADD CONSTRAINT `fk_type_wd` FOREIGN KEY (`type_id`) REFERENCES `product_type` (`type_id`),
  ADD CONSTRAINT `fk_unit_wd` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unitID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
