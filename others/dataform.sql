-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2023-10-20 14:36:17
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

CREATE TABLE `dataform` (
  `dataFormPrimaryKey` char(64) NOT NULL,
  `dataFormdateOfApplication` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '申請日期',
  `dataFormFirstTime` tinyint(1) NOT NULL COMMENT '第1次請領',
  `dataFormCertificateHasCeased` tinyint(1) NOT NULL COMMENT '撤銷原因消滅補發',
  `dataFormLost` tinyint(1) NOT NULL COMMENT '遺失補發',
  `dataFormReplacement` tinyint(1) NOT NULL COMMENT '換發記帳士證書',
  `dataFormEnglishVersion` tinyint(1) NOT NULL COMMENT '英文版記帳士證書',
  `dataFormApplicant` tinytext NOT NULL COMMENT '申請人',
  `dataFormIdentityCardNumber` tinytext NOT NULL COMMENT '身分證字號',
  `dataFormContactNumber` tinytext NOT NULL COMMENT '連絡電話',
  `dataFormPhoneNumber` tinytext NOT NULL COMMENT '手機號碼',
  `dataFormResidence` tinytext NOT NULL COMMENT '居住縣市',
  `dataFormAddress` tinytext NOT NULL COMMENT '通訊地址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- 傾印資料表的資料 `dataform`
--

INSERT INTO `dataform` (`dataFormPrimaryKey`, `dataFormdateOfApplication`, `dataFormFirstTime`, `dataFormCertificateHasCeased`, `dataFormLost`, `dataFormReplacement`, `dataFormEnglishVersion`, `dataFormApplicant`, `dataFormIdentityCardNumber`, `dataFormContactNumber`, `dataFormPhoneNumber`, `dataFormResidence`, `dataFormAddress`) VALUES
('0', '2023-10-20 12:35:09', 1, 0, 0, 0, 0, 'Jason', 'A123456789', '02-0123-4567', '0900-123-456', '台北市', '台北市大安區臥龍街100號');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
