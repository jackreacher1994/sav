-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2016 at 08:46 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `savsoftquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_answers`
--

CREATE TABLE IF NOT EXISTS `savsoft_answers` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `uid` int(11) NOT NULL,
  `score_u` float NOT NULL DEFAULT '0',
  `rid` int(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=999 ;

--
-- Dumping data for table `savsoft_answers`
--

INSERT INTO `savsoft_answers` (`aid`, `qid`, `q_option`, `uid`, `score_u`, `rid`) VALUES
(967, 45, '196', 5, 1, 132),
(968, 54, '232', 5, 0, 132),
(972, 54, '231', 1, 1, 133),
(973, 45, '196', 1, 1, 134),
(994, 52, '224', 1, 0, 137),
(995, 50, '215', 1, 0, 137),
(996, 47, '203', 1, 1, 137),
(997, 49, '211', 1, 0, 137),
(998, 63, '268', 1, 0, 137);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_category`
--

CREATE TABLE IF NOT EXISTS `savsoft_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(1000) NOT NULL,
  `gid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `savsoft_category`
--

INSERT INTO `savsoft_category` (`cid`, `category_name`, `gid`) VALUES
(2, 'CS-Trắc Nghiệm Game', 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_group`
--

CREATE TABLE IF NOT EXISTS `savsoft_group` (
  `gid` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `group_name` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `valid_for_days` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `savsoft_group`
--

INSERT INTO `savsoft_group` (`gid`, `parent_id`, `group_name`, `price`, `valid_for_days`) VALUES
(1, 0, 'Admin', 0, 0),
(3, 0, 'RSD', 0, 0),
(4, 0, 'COD', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_group_permission`
--

CREATE TABLE IF NOT EXISTS `savsoft_group_permission` (
  `gpid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_permission_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`gpid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `savsoft_group_permission`
--

INSERT INTO `savsoft_group_permission` (`gpid`, `group_permission_name`, `description`) VALUES
(1, 'USERS', 'Qu?n  lý nhóm User'),
(2, 'QUESTIONS', 'Qu?n lý nhóm Question Bank'),
(3, 'QUIZ', 'Qu?n lý nhóm Quiz'),
(4, 'RESULT', 'Qu?n lý nhóm Result'),
(5, 'PERMISSION', 'Qu?n lý nhóm Permission');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_level`
--

CREATE TABLE IF NOT EXISTS `savsoft_level` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(1000) NOT NULL,
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `savsoft_level`
--

INSERT INTO `savsoft_level` (`lid`, `level_name`) VALUES
(1, 'Easy'),
(2, 'Difficult'),
(4, 'Very Difficult');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_options`
--

CREATE TABLE IF NOT EXISTS `savsoft_options` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `q_option` text NOT NULL,
  `q_option_match` varchar(1000) DEFAULT NULL,
  `score` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`oid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=382 ;

--
-- Dumping data for table `savsoft_options`
--

INSERT INTO `savsoft_options` (`oid`, `qid`, `q_option`, `q_option_match`, `score`) VALUES
(90, 18, '1.000.0000', NULL, 0),
(91, 18, '2.000.0000', NULL, 0),
(92, 18, 'không cần thế chấp', NULL, 1),
(93, 18, 'Cả a,b,c đều sai', NULL, 0),
(94, 19, '1', NULL, 0),
(95, 19, '2', NULL, 0),
(96, 19, '3', NULL, 0),
(97, 19, 'Nhiều hơn 3 cách', NULL, 1),
(98, 20, '1.000.000', NULL, 0),
(99, 20, '2.000.000', NULL, 1),
(100, 20, '3.000.000', NULL, 0),
(101, 20, 'Không quy định', NULL, 0),
(102, 21, '500.000', NULL, 0),
(103, 21, '1.000.000', NULL, 1),
(104, 21, '1.500.000', NULL, 0),
(105, 21, '2.000.000', NULL, 0),
(106, 22, 'Nạp tiền mặt', NULL, 0),
(107, 22, 'Nạp tiền Online', NULL, 0),
(108, 22, 'Nạp tiền trực tiếp tại quầy giao dịch của ngân hàng', NULL, 0),
(109, 22, 'Các hình thức trên', NULL, 1),
(110, 23, '24', NULL, 0),
(111, 23, '26', NULL, 0),
(112, 23, '28', NULL, 1),
(113, 23, '30', NULL, 0),
(114, 24, '2', NULL, 0),
(115, 24, '3', NULL, 0),
(116, 24, '4', NULL, 1),
(117, 24, '5', NULL, 0),
(118, 25, 'Tài khoản thực hết tiền', NULL, 0),
(119, 25, 'Tài khoản NV dưới hạn mức thanh toán', NULL, 0),
(120, 25, 'Kho hết thẻ, các mục bán hàng bị vô hiệu hóa ', NULL, 0),
(121, 25, 'Cả a,b,c đều đúng', NULL, 1),
(122, 26, 'Cài đặt CBP - RSD, từ xa', NULL, 1),
(123, 26, 'Cài đặt CBP - RSD, tại nhà', NULL, 0),
(124, 26, 'Cài đặt CBP - CBS, tại nhà', NULL, 0),
(125, 26, 'Cài đặt CBP - CBS, từ xa', NULL, 0),
(126, 27, 'Cài đặt CBP - RSD, tại nhà', NULL, 0),
(127, 27, 'Cài đặt CBP - RSD, từ xa', NULL, 1),
(128, 27, 'Cài đặt CBP - CBS, tại nhà', NULL, 0),
(129, 27, 'Cài đặt CBP - CBS, từ xa', NULL, 0),
(130, 28, 'Ng', NULL, 0),
(131, 28, 'Ng', NULL, 0),
(132, 28, 'Ng', NULL, 1),
(133, 28, 'Cả a,b,c đều sai', NULL, 0),
(134, 29, '2, sau Trung Quốc', NULL, 0),
(135, 29, '3, sau Thái Lan và Hàn Quốc', NULL, 0),
(136, 29, '3, sau Hàn Quốc và Thái Lan', NULL, 1),
(137, 29, 'Cả a,b,c đều sai', NULL, 0),
(138, 30, 'Lối chơi chân thật, chế độ chơi đa dạng', NULL, 0),
(139, 30, 'Bình luận trận đấu tiếng Việt', NULL, 0),
(140, 30, 'Đồ họa vượt trội', NULL, 1),
(141, 30, 'Cả a,b,c đều sai', NULL, 0),
(142, 31, '12', NULL, 0),
(143, 31, '14', NULL, 0),
(144, 31, '16', NULL, 1),
(145, 31, 'Cả a,b,c đều sai', NULL, 0),
(146, 32, 'Xóa ngay sau khi nhập đúng mật khẩu cấp 2', NULL, 0),
(147, 32, '24 giờ', NULL, 0),
(148, 32, '48 giờ', NULL, 0),
(149, 32, '72 giờ', NULL, 1),
(150, 33, 'Đội bóng bạn yêu thích nhất ?', NULL, 1),
(151, 33, 'Tên cha bạn là gì ?', NULL, 0),
(152, 33, 'Tên mẹ bạn là gì ?', NULL, 0),
(153, 33, 'Cầu thủ bạn yêu thích nhất ?', NULL, 0),
(154, 34, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng ngày.', NULL, 0),
(155, 34, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng tháng.', NULL, 0),
(156, 34, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng ngày.', NULL, 0),
(157, 34, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng tháng.', NULL, 1),
(158, 35, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng ngày.', NULL, 1),
(159, 35, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng ngày.', NULL, 0),
(160, 35, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng tháng.', NULL, 0),
(161, 35, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng tháng.', NULL, 0),
(162, 36, 'Đấu giải, đấu mô phỏng, đấu giả lập, đấu xếp hạng.', NULL, 0),
(163, 36, 'Đấu xếp hạng, đấu giao hữu, đấu cup, đấu giải.', NULL, 1),
(164, 36, 'Đấu cup, đấu tùy chọn, đấu xếp hạng, đấu giả lập.', NULL, 0),
(165, 36, 'Đấu ngẫu nhiên, đấu xếp hạng, đấu giả lập, đấu giải.', NULL, 0),
(166, 37, 'Trao đổi với máy thêm 1 quyền lựa chọn.', NULL, 0),
(167, 37, 'Phí giao dịch trên TCCN giảm 20%.', NULL, 0),
(168, 37, 'Mượn ngẫu nhiên 2 cầu thủ ( +5 ~ +10 ) mùa hiện tại trong mỗi trận đấu.', NULL, 0),
(169, 37, 'Thưởng kinh nghiệm cầu thủ và HLV thêm 30%.', NULL, 1),
(170, 38, 'Ưu tiên từ xa', NULL, 1),
(171, 38, 'Ưu tiên tại nhà', NULL, 0),
(172, 38, 'Không ưu tiên, từ xa', NULL, 0),
(173, 38, 'Không ưu tiên, tại nhà', NULL, 0),
(174, 39, 'Ưu tiên từ xa', NULL, 0),
(175, 39, 'Ưu tiên tại nhà', NULL, 0),
(176, 39, 'Không ưu tiên, từ xa', NULL, 0),
(177, 39, 'Không ưu tiên, tại nhà', NULL, 1),
(178, 40, 'Ưu tiên từ xa', NULL, 1),
(179, 40, 'Ưu tiên tại nhà', NULL, 0),
(180, 40, 'Không ưu tiên, từ xa', NULL, 0),
(181, 40, 'Không ưu tiên, tại nhà', NULL, 0),
(182, 41, 'Ưu tiên từ xa', NULL, 1),
(183, 41, 'Ưu tiên tại nhà', NULL, 0),
(184, 41, 'Không ưu tiên, từ xa', NULL, 0),
(185, 41, 'Không ưu tiên, tại nhà', NULL, 0),
(186, 42, 'Ưu tiên từ xa', NULL, 0),
(187, 42, 'Ưu tiên tại nhà', NULL, 0),
(188, 42, 'Không ưu tiên, từ xa', NULL, 0),
(189, 42, 'Không ưu tiên, tại nhà', NULL, 1),
(190, 43, 'Ưu tiên từ xa', NULL, 1),
(191, 43, 'Ưu tiên tại nhà', NULL, 0),
(192, 43, 'Không ưu tiên, từ xa', NULL, 0),
(193, 43, 'Không ưu tiên, tại nhà', NULL, 0),
(194, 45, '1.000.0000', NULL, 0),
(195, 45, '2.000.0000', NULL, 0),
(196, 45, 'không cần thế chấp', NULL, 1),
(197, 45, 'Cả a,b,c đều sai', NULL, 0),
(198, 46, '1', NULL, 0),
(199, 46, '2', NULL, 0),
(200, 46, '3', NULL, 0),
(201, 46, 'Nhiều hơn 3 cách', NULL, 1),
(202, 47, '1.000.000', NULL, 0),
(203, 47, '2.000.000', NULL, 1),
(204, 47, '3.000.000', NULL, 0),
(205, 47, 'Không quy định', NULL, 0),
(206, 48, '500', NULL, 0),
(207, 48, '1.000.000', NULL, 1),
(208, 48, '1.500.000', NULL, 0),
(209, 48, '2.000.000', NULL, 0),
(210, 49, 'Nạp tiền mặt', NULL, 0),
(211, 49, 'Nạp tiền Online', NULL, 0),
(212, 49, 'Nạp tiền trực tiếp tại quầy giao dịch của ngân hàng', NULL, 0),
(213, 49, 'Các hình thức trên', NULL, 1),
(214, 50, '24', NULL, 0),
(215, 50, '26', NULL, 0),
(216, 50, '28', NULL, 1),
(217, 50, '30', NULL, 0),
(218, 51, '2', NULL, 0),
(219, 51, '3', NULL, 0),
(220, 51, '4', NULL, 1),
(221, 51, '5', NULL, 0),
(222, 52, 'Tài khoản thực hết tiền', NULL, 0),
(223, 52, 'Tài khoản NV dưới hạn mức thanh toán', NULL, 0),
(224, 52, 'Kho hết thẻ, các mục bán hàng bị vô hiệu hóa ', NULL, 0),
(225, 52, 'Cả a,b,c đều đúng', NULL, 1),
(234, 55, '2, sau Trung Quốc', NULL, 0),
(235, 55, '3, sau Thái Lan và Hàn Quốc', NULL, 0),
(236, 55, '3, sau Hàn Quốc và Thái Lan', NULL, 1),
(237, 55, 'Cả a,b,c đều sai', NULL, 0),
(238, 56, 'Lối chơi chân thật, chế độ chơi đa dạng', NULL, 0),
(239, 56, 'Bình luận trận đấu tiếng Việt', NULL, 0),
(240, 56, 'Đồ họa vượt trội', NULL, 1),
(241, 56, 'Cả a,b,c đều sai', NULL, 0),
(242, 57, '12', NULL, 0),
(243, 57, '14', NULL, 0),
(244, 57, '16', NULL, 1),
(245, 57, 'Cả a,b,c đều sai', NULL, 0),
(246, 58, 'Xóa ngay sau khi nhập đúng mật khẩu cấp 2', NULL, 0),
(247, 58, '24 giờ', NULL, 0),
(248, 58, '48 giờ', NULL, 0),
(249, 58, '72 giờ', NULL, 1),
(250, 59, 'Đội bóng bạn yêu thích nhất ?', NULL, 1),
(251, 59, 'Tên cha bạn là gì ?', NULL, 0),
(252, 59, 'Tên mẹ bạn là gì ?', NULL, 0),
(253, 59, 'Cầu thủ bạn yêu thích nhất ?', NULL, 0),
(254, 60, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng ngày.', NULL, 0),
(255, 60, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng tháng.', NULL, 0),
(256, 60, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng ngày.', NULL, 0),
(257, 60, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng tháng.', NULL, 1),
(258, 61, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng ngày.', NULL, 1),
(259, 61, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng ngày.', NULL, 0),
(260, 61, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng tháng.', NULL, 0),
(261, 61, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng tháng.', NULL, 0),
(262, 62, 'Đấu giải, đấu mô phỏng, đấu giả lập, đấu xếp hạng.', NULL, 0),
(263, 62, 'Đấu xếp hạng, đấu giao hữu, đấu cup, đấu giải.', NULL, 1),
(264, 62, 'Đấu cup, đấu tùy chọn, đấu xếp hạng, đấu giả lập.', NULL, 0),
(265, 62, 'Đấu ngẫu nhiên, đấu xếp hạng, đấu giả lập, đấu giải.', NULL, 0),
(266, 63, 'Trao đổi với máy thêm 1 quyền lựa chọn.', NULL, 0),
(267, 63, 'Phí giao dịch trên TCCN giảm 20%.', NULL, 0),
(268, 63, 'Mượn ngẫu nhiên 2 cầu thủ ( +5 ~ +10 ) mùa hiện tại trong mỗi trận đấu.', NULL, 0),
(269, 63, 'Thưởng kinh nghiệm cầu thủ và HLV thêm 30%.', NULL, 1),
(270, 65, '1.000.0000', NULL, 0),
(271, 65, '2.000.0000', NULL, 0),
(272, 65, 'không cần thế chấp', NULL, 1),
(273, 65, 'Cả a,b,c đều sai', NULL, 0),
(274, 66, '1', NULL, 0),
(275, 66, '2', NULL, 0),
(276, 66, '3', NULL, 0),
(277, 66, 'Nhiều hơn 3 cách', NULL, 1),
(278, 67, '1.000.000', NULL, 0),
(279, 67, '2.000.000', NULL, 1),
(280, 67, '3.000.000', NULL, 0),
(281, 67, 'Không quy định', NULL, 0),
(282, 68, '500.000', NULL, 0),
(283, 68, '1.000.000', NULL, 1),
(284, 68, '1.500.000', NULL, 0),
(285, 68, '2.000.000', NULL, 0),
(286, 69, 'Nạp tiền mặt', NULL, 0),
(287, 69, 'Nạp tiền Online', NULL, 0),
(288, 69, 'Nạp tiền trực tiếp tại quầy giao dịch của ngân hàng', NULL, 0),
(289, 69, 'Các hình thức trên', NULL, 1),
(290, 70, '24', NULL, 0),
(291, 70, '26', NULL, 0),
(292, 70, '28', NULL, 1),
(293, 70, '30', NULL, 0),
(294, 71, '2', NULL, 0),
(295, 71, '3', NULL, 0),
(296, 71, '4', NULL, 1),
(297, 71, '5', NULL, 0),
(298, 72, 'Tài khoản thực hết tiền', NULL, 0),
(299, 72, 'Tài khoản NV dưới hạn mức thanh toán', NULL, 0),
(300, 72, 'Kho hết thẻ, các mục bán hàng bị vô hiệu hóa ', NULL, 0),
(301, 72, 'Cả a,b,c đều đúng', NULL, 1),
(302, 73, 'Cài đặt CBP - RSD, từ xa', NULL, 1),
(303, 73, 'Cài đặt CBP - RSD, tại nhà', NULL, 0),
(304, 73, 'Cài đặt CBP - CBS, tại nhà', NULL, 0),
(305, 73, 'Cài đặt CBP - CBS, từ xa', NULL, 0),
(306, 74, 'Cài đặt CBP - RSD, tại nhà', NULL, 0),
(307, 74, 'Cài đặt CBP - RSD, từ xa', NULL, 1),
(308, 74, 'Cài đặt CBP - CBS, tại nhà', NULL, 0),
(309, 74, 'Cài đặt CBP - CBS, từ xa', NULL, 0),
(310, 75, 'Ng', NULL, 0),
(311, 75, 'Ng', NULL, 0),
(312, 75, 'Ng', NULL, 1),
(313, 75, 'Cả a,b,c đều sai', NULL, 0),
(314, 76, '2, sau Trung Quốc', NULL, 0),
(315, 76, '3, sau Thái Lan và Hàn Quốc', NULL, 0),
(316, 76, '3, sau Hàn Quốc và Thái Lan', NULL, 1),
(317, 76, 'Cả a,b,c đều sai', NULL, 0),
(318, 77, 'Lối chơi chân thật, chế độ chơi đa dạng', NULL, 0),
(319, 77, 'Bình luận trận đấu tiếng Việt', NULL, 0),
(320, 77, 'Đồ họa vượt trội', NULL, 1),
(321, 77, 'Cả a,b,c đều sai', NULL, 0),
(322, 78, '12', NULL, 0),
(323, 78, '14', NULL, 0),
(324, 78, '16', NULL, 1),
(325, 78, 'Cả a,b,c đều sai', NULL, 0),
(326, 79, 'Xóa ngay sau khi nhập đúng mật khẩu cấp 2', NULL, 0),
(327, 79, '24 giờ', NULL, 0),
(328, 79, '48 giờ', NULL, 0),
(329, 79, '72 giờ', NULL, 1),
(330, 80, 'Đội bóng bạn yêu thích nhất ?', NULL, 1),
(331, 80, 'Tên cha bạn là gì ?', NULL, 0),
(332, 80, 'Tên mẹ bạn là gì ?', NULL, 0),
(333, 80, 'Cầu thủ bạn yêu thích nhất ?', NULL, 0),
(334, 81, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng ngày.', NULL, 0),
(335, 81, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng tháng.', NULL, 0),
(336, 81, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng ngày.', NULL, 0),
(337, 81, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng tháng.', NULL, 1),
(338, 82, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng ngày.', NULL, 1),
(339, 82, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng ngày.', NULL, 0),
(340, 82, 'Là điểm hỗ trợ mua item trong shop thay vì dùng Cash sẽ dùng một phần MP thay cho Cash tùy vào item trong shop – Reset điểm hàng tháng.', NULL, 0),
(341, 82, 'Là điểm nhận được sau hoàn thành các nhiệm vụ hàng ngày ngẫu nhiên từ hệ thống – Reset điểm hàng tháng.', NULL, 0),
(342, 83, 'Đấu giải, đấu mô phỏng, đấu giả lập, đấu xếp hạng.', NULL, 0),
(343, 83, 'Đấu xếp hạng, đấu giao hữu, đấu cup, đấu giải.', NULL, 1),
(344, 83, 'Đấu cup, đấu tùy chọn, đấu xếp hạng, đấu giả lập.', NULL, 0),
(345, 83, 'Đấu ngẫu nhiên, đấu xếp hạng, đấu giả lập, đấu giải.', NULL, 0),
(346, 84, 'Trao đổi với máy thêm 1 quyền lựa chọn.', NULL, 0),
(347, 84, 'Phí giao dịch trên TCCN giảm 20%.', NULL, 0),
(348, 84, 'Mượn ngẫu nhiên 2 cầu thủ ( +5 ~ +10 ) mùa hiện tại trong mỗi trận đấu.', NULL, 0),
(349, 84, 'Thưởng kinh nghiệm cầu thủ và HLV thêm 30%.', NULL, 1),
(350, 85, 'Ưu tiên từ xa', NULL, 1),
(351, 85, 'Ưu tiên tại nhà', NULL, 0),
(352, 85, 'Không ưu tiên, từ xa', NULL, 0),
(353, 85, 'Không ưu tiên, tại nhà', NULL, 0),
(354, 86, 'Ưu tiên từ xa', NULL, 0),
(355, 86, 'Ưu tiên tại nhà', NULL, 0),
(356, 86, 'Không ưu tiên, từ xa', NULL, 0),
(357, 86, 'Không ưu tiên, tại nhà', NULL, 1),
(358, 87, 'Ưu tiên từ xa', NULL, 1),
(359, 87, 'Ưu tiên tại nhà', NULL, 0),
(360, 87, 'Không ưu tiên, từ xa', NULL, 0),
(361, 87, 'Không ưu tiên, tại nhà', NULL, 0),
(362, 88, 'Ưu tiên từ xa', NULL, 1),
(363, 88, 'Ưu tiên tại nhà', NULL, 0),
(364, 88, 'Không ưu tiên, từ xa', NULL, 0),
(365, 88, 'Không ưu tiên, tại nhà', NULL, 0),
(366, 89, 'Ưu tiên từ xa', NULL, 0),
(367, 89, 'Ưu tiên tại nhà', NULL, 0),
(368, 89, 'Không ưu tiên, từ xa', NULL, 0),
(369, 89, 'Không ưu tiên, tại nhà', NULL, 1),
(370, 90, 'Ưu tiên từ xa', NULL, 1),
(371, 90, 'Ưu tiên tại nhà', NULL, 0),
(372, 90, 'Không ưu tiên, từ xa', NULL, 0),
(373, 90, 'Không ưu tiên, tại nhà', NULL, 0),
(374, 1, '<p>4</p>', NULL, 1),
(375, 1, '<p>6</p>', NULL, 0),
(376, 1, '<p>8</p>', NULL, 0),
(377, 1, '<p>10</p>', NULL, 0),
(378, 2, '<p>6</p>', NULL, 1),
(379, 2, '<p>9</p>', NULL, 0),
(380, 2, '<p>12</p>', NULL, 0),
(381, 2, '<p>15</p>', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_payment`
--

CREATE TABLE IF NOT EXISTS `savsoft_payment` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `amount` float NOT NULL,
  `paid_date` int(11) NOT NULL,
  `payment_gateway` varchar(100) NOT NULL DEFAULT 'Paypal',
  `payment_status` varchar(100) NOT NULL DEFAULT 'Pending',
  `transaction_id` varchar(1000) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_permission`
--

CREATE TABLE IF NOT EXISTS `savsoft_permission` (
  `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gpid` int(11) NOT NULL,
  `permission_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `savsoft_permission`
--

INSERT INTO `savsoft_permission` (`pid`, `gpid`, `permission_name`, `description`) VALUES
(1, 0, 'Qu?n  lý nhóm User', ''),
(2, 1, 'View List User', 'Xem thông tin user'),
(3, 1, 'Group User', 'Thêm m?i nhóm User'),
(4, 2, 'Add new question', 'Thêm m?i câu h?i');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_qbank`
--

CREATE TABLE IF NOT EXISTS `savsoft_qbank` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `question_type` varchar(100) NOT NULL DEFAULT 'Multiple Choice Single Answer',
  `question` text NOT NULL,
  `description` text NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `no_time_served` int(11) NOT NULL DEFAULT '0',
  `no_time_corrected` int(11) NOT NULL DEFAULT '0',
  `no_time_incorrected` int(11) NOT NULL DEFAULT '0',
  `no_time_unattempted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `savsoft_qbank`
--

INSERT INTO `savsoft_qbank` (`qid`, `question_type`, `question`, `description`, `cid`, `lid`, `no_time_served`, `no_time_corrected`, `no_time_incorrected`, `no_time_unattempted`) VALUES
(1, 'Multiple Choice Single Answer', '<p>2+2 = ?</p>', '', 2, 1, 0, 0, 0, 0),
(2, 'Multiple Choice Single Answer', '<p>3+3 =?&nbsp;</p>', '', 2, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_qcl`
--

CREATE TABLE IF NOT EXISTS `savsoft_qcl` (
  `qcl_id` int(11) NOT NULL AUTO_INCREMENT,
  `quid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `lid` int(11) NOT NULL,
  `noq` int(11) NOT NULL,
  PRIMARY KEY (`qcl_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `savsoft_qcl`
--

INSERT INTO `savsoft_qcl` (`qcl_id`, `quid`, `cid`, `lid`, `noq`) VALUES
(133, 11, 3, 1, 4),
(134, 11, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_quiz`
--

CREATE TABLE IF NOT EXISTS `savsoft_quiz` (
  `quid` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_name` varchar(1000) NOT NULL,
  `description` text NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `gids` text NOT NULL,
  `uids` text NOT NULL,
  `date_assign_user` int(11) NOT NULL,
  `qids` text NOT NULL,
  `noq` int(11) NOT NULL,
  `correct_score` float NOT NULL,
  `incorrect_score` float NOT NULL,
  `form_email` text NOT NULL,
  `duration` int(11) NOT NULL DEFAULT '10',
  `maximum_attempts` int(11) NOT NULL DEFAULT '1',
  `pass_percentage` float NOT NULL DEFAULT '50',
  `view_answer` int(11) NOT NULL DEFAULT '1',
  `camera_req` int(11) NOT NULL DEFAULT '1',
  `question_selection` int(11) NOT NULL DEFAULT '1',
  `gen_certificate` int(11) NOT NULL DEFAULT '0',
  `certificate_text` text,
  `allow_back` int(11) NOT NULL,
  PRIMARY KEY (`quid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `savsoft_quiz`
--

INSERT INTO `savsoft_quiz` (`quid`, `quiz_name`, `description`, `start_date`, `end_date`, `gids`, `uids`, `date_assign_user`, `qids`, `noq`, `correct_score`, `incorrect_score`, `form_email`, `duration`, `maximum_attempts`, `pass_percentage`, `view_answer`, `camera_req`, `question_selection`, `gen_certificate`, `certificate_text`, `allow_back`) VALUES
(19, 'test 02', '', 1465812414, 1497348414, '4', '', 0, '1,2', 2, 1, 0, '', 10, 100, 50, 1, 0, 0, 0, NULL, 0),
(20, 'Test 03', '', 1465963611, 1497499611, '4,3', '10,7,3,12,11', 1465952587, '', 0, 1, 0, '', 10, 100, 50, 1, 0, 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_result`
--

CREATE TABLE IF NOT EXISTS `savsoft_result` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `quid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `result_status` varchar(100) NOT NULL DEFAULT 'Open',
  `start_time` int(11) NOT NULL,
  `end_time` int(11) NOT NULL,
  `categories` text NOT NULL,
  `category_range` text NOT NULL,
  `r_qids` text NOT NULL,
  `individual_time` text NOT NULL,
  `total_time` int(11) NOT NULL DEFAULT '0',
  `score_obtained` float NOT NULL DEFAULT '0',
  `percentage_obtained` float NOT NULL DEFAULT '0',
  `attempted_ip` varchar(100) NOT NULL,
  `score_individual` text NOT NULL,
  `photo` varchar(100) NOT NULL,
  `manual_valuation` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `savsoft_result`
--

INSERT INTO `savsoft_result` (`rid`, `quid`, `uid`, `result_status`, `start_time`, `end_time`, `categories`, `category_range`, `r_qids`, `individual_time`, `total_time`, `score_obtained`, `percentage_obtained`, `attempted_ip`, `score_individual`, `photo`, `manual_valuation`) VALUES
(125, 11, 1, 'Fail', 1465540681, 1465540757, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '54,47,46,52,59', '190,0,0,0,0', 190, 0, 0, '::1', '0,0,0,0,0', '', 0),
(126, 11, 1, 'Fail', 1465543513, 1465543637, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '45,50,51,53,60', '29,6,0,0,0', 35, 0, 0, '::1', '0,0,0,0,0', '', 0),
(127, 11, 5, 'Fail', 1465543668, 1465543791, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '45,54,48,46,62', '89,0,0,0,0', 89, 0, 0, '::1', '0,0,0,0,0', '', 0),
(128, 11, 5, 'Fail', 1465543818, 1465543940, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '54,45,50,51,56', '115,0,0,0,0', 115, 0, 0, '::1', '0,0,0,0,0', '', 0),
(129, 11, 5, 'Fail', 1465544242, 1465544364, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '51,52,53,46,56', '42,0,0,0,0', 42, 0, 0, '::1', '0,0,0,0,0', '', 0),
(130, 11, 5, 'Fail', 1465544375, 1465544512, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '50,47,45,46,59', '118,0,0,0,0', 118, 0, 0, '::1', '0,0,0,0,0', '', 0),
(131, 11, 5, 'Fail', 1465544576, 1465544699, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '46,53,54,52,63', '108,0,0,0,0', 108, 0, 0, '::1', '0,0,0,0,0', '', 0),
(132, 11, 5, 'Fail', 1465545411, 0, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '45,54,50,46,63', '0,5,2,0,0', 0, 0, 0, '::1', '1,2,0,0,0', '', 0),
(133, 11, 1, 'Fail', 1465546081, 1465547220, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '54,45,48,49,61', '4,97,0,0,0', 101, 1, 20, '::1', '1,0,0,0,0', '', 0),
(134, 11, 1, 'Closed', 1465547224, 0, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '45,49,48,52,58', '20,0,0,0,0', 0, 0, 0, '::1', '1,0,0,0,0', '', 0),
(135, 11, 5, 'Closed', 1465547544, 0, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '48,49,53,46,61', '11,0,0,0,0', 0, 0, 0, '::1', '0,0,0,0,0', '', 0),
(136, 11, 1, 'Fail', 1465548918, 1465793014, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '54,48,53,45,58', '5,0,0,0,0', 5, 0, 0, '::1', '0,0,0,0,0', '', 0),
(137, 11, 1, 'Fail', 1465811416, 1465811477, 'CS-Trắc Nghiệm Cyperbay,CS-Trắc Nghiệm Game', '4,1', '52,50,47,49,63', '37,6,1,3,14', 61, 1, 20, '::1', '2,2,1,2,2', '', 0),
(138, 11, 5, 'Closed', 1465962734, 0, 'CS-Trắc Nghiệm Game', '1', '2', '0', 0, 0, 0, '::1', '0', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_status`
--

CREATE TABLE IF NOT EXISTS `savsoft_status` (
  `sid` int(11) unsigned NOT NULL,
  `name_status` varchar(255) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `savsoft_status`
--

INSERT INTO `savsoft_status` (`sid`, `name_status`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `savsoft_users`
--

CREATE TABLE IF NOT EXISTS `savsoft_users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(1000) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_no` varchar(1000) NOT NULL,
  `gid` int(11) NOT NULL DEFAULT '1',
  `su` int(11) NOT NULL DEFAULT '0',
  `gpid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `subscription_expired` int(11) NOT NULL DEFAULT '0',
  `verify_code` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `savsoft_users`
--

INSERT INTO `savsoft_users` (`uid`, `password`, `email`, `first_name`, `last_name`, `contact_no`, `gid`, `su`, `gpid`, `pid`, `sid`, `subscription_expired`, `verify_code`) VALUES
(1, '21232f297a57a5a743894a0e4a801fc3', 'admin@example.com', 'Admin', 'Admin', '1234567890', 1, 1, 1, 1, 1, 1776290400, 0),
(5, '202cb962ac59075b964b07152d234b70', 'user@example.com', 'User', 'User', '1234567890', 1, 0, 0, 0, 1, 1776882600, 0),
(10, '202cb962ac59075b964b07152d234b70', 'test02@example.com.vn', '', '', '', 4, 0, 2, 4, 1, 1781197200, 0),
(11, '202cb962ac59075b964b07152d234b70', 'test01@example.com', 'test01', 'test01', '', 4, 1, 1, 0, 1, 1781283600, 0),
(12, '202cb962ac59075b964b07152d234b70', 'test03@example.com', '', '', '', 4, 1, 1, 0, 1, 1781283600, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
