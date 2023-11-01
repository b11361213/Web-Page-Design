-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-11-01 13:45:23
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `form`
--

-- --------------------------------------------------------

--
-- 資料表結構 `dataform`
--

DROP TABLE IF EXISTS `dataform`;
CREATE TABLE `dataform` (
  `dataFormPrimaryKey` int(64) NOT NULL,
  `dataFormDateOfApplicationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '申請日期',
  `dataFormApplyForPurposeChoice` tinytext NOT NULL COMMENT '申請項目',
  `dataFormApplicantFormText` tinytext NOT NULL COMMENT '申請人',
  `dataFormIdentityCardNumberFormText` tinytext NOT NULL COMMENT '身分證字號',
  `dataFormContactNumberFormText` tinytext NOT NULL COMMENT '連絡電話',
  `dataFormPhoneNumberFormText` tinytext NOT NULL COMMENT '手機號碼',
  `dataFormResidenceFormChoice` tinytext NOT NULL COMMENT '居住縣市',
  `dataFormAddressFormText` tinytext NOT NULL COMMENT '通訊地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `dataform`
--

INSERT INTO `dataform` (`dataFormPrimaryKey`, `dataFormDateOfApplicationDate`, `dataFormApplyForPurposeChoice`, `dataFormApplicantFormText`, `dataFormIdentityCardNumberFormText`, `dataFormContactNumberFormText`, `dataFormPhoneNumberFormText`, `dataFormResidenceFormChoice`, `dataFormAddressFormText`) VALUES
(1, '2023-11-01 12:38:50', 'dataFormFirstTime', 'Murasaki', 'A200000000', '02-1234-5678', '0912-345-678', '台北市', '台北市大安區臥龍街100號');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `dataform`
--
ALTER TABLE `dataform`
  ADD PRIMARY KEY (`dataFormPrimaryKey`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dataform`
--
ALTER TABLE `dataform`
  MODIFY `dataFormPrimaryKey` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
