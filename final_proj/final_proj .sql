-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-06-05 17:38:56
-- 伺服器版本： 10.4.24-MariaDB
-- PHP 版本： 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `final_proj`
--

-- --------------------------------------------------------

--
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `ID` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `identity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`ID`, `name`, `email`, `password`, `identity`) VALUES
(1, 'Lin', 'tank910217@gmail.com', '12345', 1),
(2, 'Eris', 'tank910217@yahoo.com.tw', '12345', 2),
(8, 'user1', 'user@user.com', '0000', 1),
(9, 'user', 'user@user.com', '0000', 2),
(10, 'user00', 'tank910217@gmail.com', '0000', 2),
(11, 'user0000', 'user@user.com', '0000', 2),
(12, 'Eric', 'user@user.com', '1111', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `identity`
--

CREATE TABLE `identity` (
  `i_id` int(5) NOT NULL,
  `identities` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `identity`
--

INSERT INTO `identity` (`i_id`, `identities`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- 資料表結構 `item`
--

CREATE TABLE `item` (
  `item_id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` int(5) NOT NULL,
  `stock` int(20) NOT NULL,
  `price` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `item`
--

INSERT INTO `item` (`item_id`, `name`, `type`, `stock`, `price`) VALUES
(1, 'A牌美工刀', 1, 76, 68),
(2, 'B牌美工刀', 1, 30, 75),
(9, '廚房紙巾', 3, 135, 25),
(10, 'iphone充電線', 4, 60, 120),
(12, '手機架', 4, 100, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `order_status`
--

CREATE TABLE `order_status` (
  `os_id` int(5) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `order_status`
--

INSERT INTO `order_status` (`os_id`, `status`) VALUES
(1, '未完成'),
(2, '完成');

-- --------------------------------------------------------

--
-- 資料表結構 `order_t`
--

CREATE TABLE `order_t` (
  `order_id` int(11) NOT NULL,
  `customer` int(20) NOT NULL,
  `item` int(20) NOT NULL,
  `amount` int(20) NOT NULL,
  `total_price` int(40) NOT NULL,
  `status` int(5) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `order_t`
--

INSERT INTO `order_t` (`order_id`, `customer`, `item`, `amount`, `total_price`, `status`, `time`) VALUES
(2, 10, 10, 50, 6000, 2, '2022-06-03'),
(3, 11, 9, 50, 1250, 1, '2022-06-03'),
(4, 2, 1, 20, 1000, 2, '2022-06-05'),
(5, 2, 9, 50, 1250, 2, '2022-06-05'),
(6, 12, 9, 35, 875, 2, '2022-06-05'),
(7, 12, 10, 7, 840, 1, '2022-06-05'),
(8, 12, 2, 4, 300, 2, '2022-06-05');

-- --------------------------------------------------------

--
-- 資料表結構 `purchase_record`
--

CREATE TABLE `purchase_record` (
  `p_id` int(20) NOT NULL,
  `item` int(20) NOT NULL,
  `amount` int(50) NOT NULL,
  `purchase_price` int(20) NOT NULL,
  `p_time` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `purchase_record`
--

INSERT INTO `purchase_record` (`p_id`, `item`, `amount`, `purchase_price`, `p_time`) VALUES
(3, 2, 23, 25, '2022-05-29'),
(16, 9, 190, 20, '2022-03-24'),
(17, 10, 60, 100, '2022-05-08'),
(18, 10, 50, 99, '2022-06-02'),
(19, 1, 101, 52, '2022-06-04'),
(22, 12, 100, 50, '2022-06-04'),
(23, 9, 30, 45, '2022-06-04');

-- --------------------------------------------------------

--
-- 資料表結構 `type`
--

CREATE TABLE `type` (
  `t_id` int(5) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `type`
--

INSERT INTO `type` (`t_id`, `type`) VALUES
(1, '文具'),
(2, '書籍'),
(3, '廚房用品'),
(4, '3C配件'),
(11, '衣服');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `identity` (`identity`);

--
-- 資料表索引 `identity`
--
ALTER TABLE `identity`
  ADD PRIMARY KEY (`i_id`);

--
-- 資料表索引 `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `type` (`type`);

--
-- 資料表索引 `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`os_id`);

--
-- 資料表索引 `order_t`
--
ALTER TABLE `order_t`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer` (`customer`,`item`),
  ADD KEY `status` (`status`),
  ADD KEY `item` (`item`);

--
-- 資料表索引 `purchase_record`
--
ALTER TABLE `purchase_record`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `item` (`item`);

--
-- 資料表索引 `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`t_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `ID` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `identity`
--
ALTER TABLE `identity`
  MODIFY `i_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_status`
--
ALTER TABLE `order_status`
  MODIFY `os_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `order_t`
--
ALTER TABLE `order_t`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `purchase_record`
--
ALTER TABLE `purchase_record`
  MODIFY `p_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `type`
--
ALTER TABLE `type`
  MODIFY `t_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`identity`) REFERENCES `identity` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- 資料表的限制式 `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`t_id`) ON UPDATE CASCADE;

--
-- 資料表的限制式 `order_t`
--
ALTER TABLE `order_t`
  ADD CONSTRAINT `order_t_ibfk_1` FOREIGN KEY (`status`) REFERENCES `order_status` (`os_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_t_ibfk_2` FOREIGN KEY (`item`) REFERENCES `item` (`item_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `order_t_ibfk_3` FOREIGN KEY (`customer`) REFERENCES `account` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- 資料表的限制式 `purchase_record`
--
ALTER TABLE `purchase_record`
  ADD CONSTRAINT `purchase_record_ibfk_1` FOREIGN KEY (`item`) REFERENCES `item` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
