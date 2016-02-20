-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2015 at 02:15 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maa-autos-online`
--

-- --------------------------------------------------------

--
-- Table structure for table `ma_addons`
--

CREATE TABLE IF NOT EXISTS `ma_addons` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `addon` varchar(60) NOT NULL,
  `group` varchar(60) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `addon` (`addon`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `ma_addons`
--

INSERT INTO `ma_addons` (`ID`, `addon`, `group`, `description`, `status`) VALUES
(1, 'FAQs', 'CMS', 'FAQs', 1),
(2, 'News', 'CMS', 'News', 1),
(3, 'Feedback', 'CMS', 'Feedback', 1),
(4, 'Addons', 'System', 'Access Control', 1),
(5, 'Media', 'CMS', 'Access Control', 1),
(6, 'All', 'System', 'Super Admin', 1),
(7, 'Settings', 'System', 'Access Control', 1),
(8, 'Users', 'System', 'Access Control', 1),
(9, 'User Rules', 'System', 'User Rules', 1),
(10, 'Configuration', 'System', 'System Configuration', 1),
(11, 'Settings Addons', 'System', 'Settings Addons', 1),
(12, 'Library Images', 'CMS', 'Library Images Management', 1),
(13, 'Media Images', 'CMS', 'Media Images Management', 1),
(14, 'Documents', 'CMS', 'Documents Attachement', 1),
(15, 'Widgets', 'CMS', 'Widgets', 1),
(16, 'Menu Builder', 'CMS', 'Menu Builder', 1),
(17, 'Route', 'System', 'Route', 1),
(18, 'Web Pages', 'CMS', 'Access Control', 1),
(19, 'Website Pages', 'CMS', 'Access Control', 1),
(22, 'Predefined Search', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_blogs`
--

CREATE TABLE IF NOT EXISTS `ma_blogs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(250) NOT NULL,
  `tags` tinytext NOT NULL,
  `details` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `ma_blogs`
--

INSERT INTO `ma_blogs` (`ID`, `user_id`, `title`, `image`, `tags`, `details`, `url`, `date`, `status`) VALUES
(52, 1, 'Jay Leno checks out Ronin RS 211, a Lotus Elise transformed 1', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-1.jpg', 'blog, jay leno', '<p>You know a vehicle is going to be something special when you need a pair of goggles to drive it, and this highly customized <a href="http://www.autoblog.com/lotus/">Lotus</a> lives up to that promise. The owner refers to his one-off as the Ronin RS 211, but underneath that barely there body are a few parts left from a <a href="http://www.autoblog.com/lotus/elise/">2005 Lotus Elise</a>.<br />\r\n<br />\r\nOwner Frank Profera totaled his Elise when a <a href="http://www.autoblog.com/porsche/">Porsche</a> rear-ended it, but he wasn&#39;t willing to give the sports car up. With a canvas to build from, Profera took inspiration from the <a href="http://www.autoblog.com/tag/lotus+2-eleven/">Lotus 2-Eleven</a> and Can-Am cars, and the Ronin resulted. Not content with just a svelte body, the powertrain received just as thorough an upgrade as the looks. The engine still displaces 1.8 liters but features improved internals. The pi&egrave;ce de r&eacute;sistance, though, is the custom turbocharger setup that runs on a mix of pump gas and alcohol to put out a claimed 680 horsepower, which sounds great screaming through the California canyons.<br />\r\n<br />\r\n&quot;Ronin&quot; is a Japanese word for a master-less samurai, and with its featherlight weight, just a vestigial windshield and gobs of power, the RS 211 is a fantastic automotive symbol for the type of sword such a warrior might carry. Watch as Jay takes an extra long drive on the latest episode of <a href="http://www.autoblog.com/tag/jay+lenos+garage/"><em>Jay Leno&#39;s Garage</em></a>.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>You know a vehicle is going to be something special when you need a pair of goggles to drive it, and this highly customized <a href="http://www.autoblog.com/lotus/">Lotus</a> lives up to that promise. The owner refers to his one-off as the Ronin RS 211, but underneath that barely there body are a few parts left from a <a href="http://www.autoblog.com/lotus/elise/">2005 Lotus Elise</a>.<br />\r\n<br />\r\nOwner Frank Profera totaled his Elise when a <a href="http://www.autoblog.com/porsche/">Porsche</a> rear-ended it, but he wasn&#39;t willing to give the sports car up. With a canvas to build from, Profera took inspiration from the <a href="http://www.autoblog.com/tag/lotus+2-eleven/">Lotus 2-Eleven</a> and Can-Am cars, and the Ronin resulted. Not content with just a svelte body, the powertrain received just as thorough an upgrade as the looks. The engine still displaces 1.8 liters but features improved internals. The pi&egrave;ce de r&eacute;sistance, though, is the custom turbocharger setup that runs on a mix of pump gas and alcohol to put out a claimed 680 horsepower, which sounds great screaming through the California canyons.<br />\r\n<br />\r\n&quot;Ronin&quot; is a Japanese word for a master-less samurai, and with its featherlight weight, just a vestigial windshield and gobs of power, the RS 211 is a fantastic automotive symbol for the type of sword such a warrior might carry. Watch as Jay takes an extra long drive on the latest episode of <a href="http://www.autoblog.com/tag/jay+lenos+garage/"><em>Jay Leno&#39;s Garage</em></a>.</p>', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-1', '2014-12-16', 1),
(53, 1, 'Jay Leno checks out Ronin RS 211, a Lotus Elise transformed 3', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-3.jpg', '2005 lotus elise, jay leno, jay lenos garage, leno, lotus, lotus elise, ronin, ronin rs 211, video', '<p>You know a vehicle is going to be something special when you need a pair of goggles to drive it, and this highly customized <a href="http://www.autoblog.com/lotus/">Lotus</a> lives up to that promise. The owner refers to his one-off as the Ronin RS 211, but underneath that barely there body are a few parts left from a <a href="http://www.autoblog.com/lotus/elise/">2005 Lotus Elise</a>.<br />\r\n<br />\r\nOwner Frank Profera totaled his Elise when a <a href="http://www.autoblog.com/porsche/">Porsche</a> rear-ended it, but he wasn&#39;t willing to give the sports car up. With a canvas to build from, Profera took inspiration from the <a href="http://www.autoblog.com/tag/lotus+2-eleven/">Lotus 2-Eleven</a> and Can-Am cars, and the Ronin resulted. Not content with just a svelte body, the powertrain received just as thorough an upgrade as the looks. The engine still displaces 1.8 liters but features improved internals. The pi&egrave;ce de r&eacute;sistance, though, is the custom turbocharger setup that runs on a mix of pump gas and alcohol to put out a claimed 680 horsepower, which sounds great screaming through the California canyons.<br />\r\n<br />\r\n&quot;Ronin&quot; is a Japanese word for a master-less samurai, and with its featherlight weight, just a vestigial windshield and gobs of power, the RS 211 is a fantastic automotive symbol for the type of sword such a warrior might carry. Watch as Jay takes an extra long drive on the latest episode of <a href="http://www.autoblog.com/tag/jay+lenos+garage/"><em>Jay Leno&#39;s Garage</em></a>.</p>', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-3', '2014-12-16', 1),
(54, 1, 'Jay Leno checks out Ronin RS 211, a Lotus Elise transformed 4', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-4.jpg', '2005 lotus elise, jay leno, jay lenos garage, leno, lotus, lotus elise, ronin, ronin rs 211, video', '<p>You know a vehicle is going to be something special when you need a pair of goggles to drive it, and this highly customized <a href="http://www.autoblog.com/lotus/">Lotus</a> lives up to that promise. The owner refers to his one-off as the Ronin RS 211, but underneath that barely there body are a few parts left from a <a href="http://www.autoblog.com/lotus/elise/">2005 Lotus Elise</a>.<br />\r\n<br />\r\nOwner Frank Profera totaled his Elise when a <a href="http://www.autoblog.com/porsche/">Porsche</a> rear-ended it, but he wasn&#39;t willing to give the sports car up. With a canvas to build from, Profera took inspiration from the <a href="http://www.autoblog.com/tag/lotus+2-eleven/">Lotus 2-Eleven</a> and Can-Am cars, and the Ronin resulted. Not content with just a svelte body, the powertrain received just as thorough an upgrade as the looks. The engine still displaces 1.8 liters but features improved internals. The pi&egrave;ce de r&eacute;sistance, though, is the custom turbocharger setup that runs on a mix of pump gas and alcohol to put out a claimed 680 horsepower, which sounds great screaming through the California canyons.<br />\r\n<br />\r\n&quot;Ronin&quot; is a Japanese word for a master-less samurai, and with its featherlight weight, just a vestigial windshield and gobs of power, the RS 211 is a fantastic automotive symbol for the type of sword such a warrior might carry. Watch as Jay takes an extra long drive on the latest episode of <a href="http://www.autoblog.com/tag/jay+lenos+garage/"><em>Jay Leno&#39;s Garage</em></a>.</p>', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-4', '2014-12-16', 1),
(55, 1, 'Jay Leno checks out Ronin RS 211, a Lotus Elise transformed 5', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-5.jpg', '2005 lotus elise, jay leno, jay lenos garage, leno, lotus, lotus elise, ronin, ronin rs 211, video', '<p>You know a vehicle is going to be something special when you need a pair of goggles to drive it, and this highly customized <a href="http://www.autoblog.com/lotus/">Lotus</a> lives up to that promise. The owner refers to his one-off as the Ronin RS 211, but underneath that barely there body are a few parts left from a <a href="http://www.autoblog.com/lotus/elise/">2005 Lotus Elise</a>.<br />\r\n<br />\r\nOwner Frank Profera totaled his Elise when a <a href="http://www.autoblog.com/porsche/">Porsche</a> rear-ended it, but he wasn&#39;t willing to give the sports car up. With a canvas to build from, Profera took inspiration from the <a href="http://www.autoblog.com/tag/lotus+2-eleven/">Lotus 2-Eleven</a> and Can-Am cars, and the Ronin resulted. Not content with just a svelte body, the powertrain received just as thorough an upgrade as the looks. The engine still displaces 1.8 liters but features improved internals. The pi&egrave;ce de r&eacute;sistance, though, is the custom turbocharger setup that runs on a mix of pump gas and alcohol to put out a claimed 680 horsepower, which sounds great screaming through the California canyons.<br />\r\n<br />\r\n&quot;Ronin&quot; is a Japanese word for a master-less samurai, and with its featherlight weight, just a vestigial windshield and gobs of power, the RS 211 is a fantastic automotive symbol for the type of sword such a warrior might carry. Watch as Jay takes an extra long drive on the latest episode of <a href="http://www.autoblog.com/tag/jay+lenos+garage/"><em>Jay Leno&#39;s Garage</em></a>.</p>', 'jay-leno-checks-out-ronin-rs-211-a-lotus-elise-transformed-5', '2014-12-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_blog_comments`
--

CREATE TABLE IF NOT EXISTS `ma_blog_comments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `blogID` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `website` varchar(120) NOT NULL,
  `comment` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ma_blog_comments`
--

INSERT INTO `ma_blog_comments` (`ID`, `blogID`, `date`, `name`, `email`, `website`, `comment`, `status`) VALUES
(1, 52, '2014-12-26 05:43:30', 'Odd Yet', 'info@oddyet.com', 'www.oddyet.com', 'Aenean tincidunt, dui vel placerat mollis, ante turpis lacinia risus, non molestie turpis sem id nibh. Pellentesque sed nunc massa. In hac habitasse platea dictumst. Mauris in rhoncus ipsum. Fusce congue dapibus lacus vel cursus.', 1),
(9, 52, '2015-01-05 06:31:43', 'Grand Cherokee', 'admin@oddyet.com', '', 'Test', 1),
(10, 52, '2015-02-20 05:49:43', 'Zaphiel Mendrion', 'habovery1947@jourrapide.com', '', 'Test Message.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_callback`
--

CREATE TABLE IF NOT EXISTS `ma_callback` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `countryID` int(11) NOT NULL,
  `phone` varchar(65) NOT NULL,
  `message` text NOT NULL,
  `IP` varchar(19) NOT NULL,
  `browser` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `ma_callback`
--

INSERT INTO `ma_callback` (`ID`, `date`, `name`, `email`, `countryID`, `phone`, `message`, `IP`, `browser`, `status`) VALUES
(34, '2015-02-15 03:37:12', 'Zaphiel Mendrion', 'habovery1947@jourrapide.com', 233, '(609) 206-3733', 'Please call back, I have some query.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 0),
(35, '2015-02-15 04:08:31', 'Zaphiel Mendrion', 'habovery1947@jourrapide.com', 233, '(609) 206-3733', 'Please Callback, I have some query.', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 0),
(36, '2015-02-20 05:45:24', 'Zaphiel Mendrion', 'habovery1947@jourrapide.com', 3, '(609) 206-3733', 'Test Message', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ma_color`
--

CREATE TABLE IF NOT EXISTS `ma_color` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `color` varchar(50) NOT NULL,
  `hex_code` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `unit` (`color`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1117 ;

--
-- Dumping data for table `ma_color`
--

INSERT INTO `ma_color` (`ID`, `color`, `hex_code`, `status`) VALUES
(37, 'Acid green', '#A8BB19', 1),
(38, 'Aero', '#7CB9E8', 1),
(39, 'Aero blue', ' #C9FFE5', 1),
(40, 'African purple', '#B284BE', 1),
(41, 'Air Force blue (RAF)', '#5D8AA8', 1),
(42, 'Air Force blue (USAF)', '#00308F', 1),
(43, 'Air superiority blue', '#72A0C1', 1),
(44, 'Alabama Crimson', '#AF002A', 1),
(45, 'Alice blue', '#F0F8FF', 1),
(46, 'Alizarin crimson', '#E32636', 1),
(47, 'Alloy orange', '#C46210', 1),
(48, 'Almond', '#EFDECD', 1),
(49, 'Amaranth', '#E52B50', 1),
(50, 'Amaranth pink', '#F19CBB', 1),
(51, 'Amaranth purple', '#AB274F', 1),
(52, 'Amazon', '#3B7A57', 1),
(53, 'Amber', '#FFBF00', 1),
(54, 'SAE/ECE Amber (color)', '#FF7E00', 1),
(55, 'American rose', '#FF033E', 1),
(56, 'Amethyst', '#9966CC', 1),
(57, 'Android green', '#A4C639', 1),
(58, 'Anti-flash white', '#F2F3F4', 1),
(59, 'Antique brass', '#CD9575', 1),
(60, 'Antique bronze', '#665D1E', 1),
(61, 'Antique fuchsia', '#915C83', 1),
(62, 'Antique ruby', '#841B2D', 1),
(63, 'Antique white', '#FAEBD7', 1),
(64, 'Ao (English)', '#008000', 1),
(65, 'Apple green', '#8DB600', 1),
(66, 'Apricot', '#FBCEB1', 1),
(67, 'Aqua', '#00FFFF', 1),
(68, 'Aquamarine', '#7FFFD4', 1),
(69, 'Army green', '#4B5320', 1),
(70, 'Arsenic', '#3B444B', 1),
(71, 'Artichoke', '#8F9779', 1),
(72, 'Arylide yellow', '#E9D66B', 1),
(73, 'Ash grey', '#B2BEB5', 1),
(74, 'Asparagus', '#87A96B', 1),
(75, 'Atomic tangerine', '#FF9966', 1),
(76, 'Auburn', '#A52A2A', 1),
(77, 'Aureolin', '#FDEE00', 1),
(78, 'AuroMetalSaurus', '#6E7F80', 1),
(79, 'Avocado', '#568203', 1),
(80, 'Azure', '#007FFF', 1),
(81, 'Azure mist/web', '#F0FFFF', 1),
(82, 'Baby blue', '#89CFF0', 1),
(83, 'Baby blue eyes', '#A1CAF1', 1),
(84, 'Baby pink', '#F4C2C2', 1),
(85, 'Baby powder', '#FEFEFA', 1),
(86, 'Baker-Miller pink', '#FF91AF', 1),
(87, 'Ball blue', '#21ABCD', 1),
(88, 'Banana Mania', '#FAE7B5', 1),
(89, 'Banana yellow', '#FFE135', 1),
(90, 'Bangladesh green', '#006A4E', 1),
(91, 'Barbie pink', '#E0218A', 1),
(92, 'Barn red', '#7C0A02', 1),
(93, 'Battleship grey', '#848482', 1),
(94, 'Bazaar', '#98777B', 1),
(95, 'Beau blue', '#BCD4E6', 1),
(96, 'Beaver', '#9F8170', 1),
(97, 'Beige', '#F5F5DC', 1),
(98, 'B''dazzled blue', '#2E5894', 1),
(99, 'Big dip o’ruby', '#9C2542', 1),
(100, 'Bisque', '#FFE4C4', 1),
(101, 'Bistre', '#3D2B1F', 1),
(102, 'Bistre brown', '#967117', 1),
(103, 'Bitter lemon', '#CAE00D', 1),
(104, 'Bitter lime', '#648C11', 1),
(105, 'Bittersweet', '#FE6F5E', 1),
(106, 'Bittersweet shimmer', '#BF4F51', 1),
(107, 'Black', '#000000', 1),
(108, 'Black bean', '#3D0C02', 1),
(109, 'Black leather jacket', '#253529', 1),
(110, 'Black olive', '#3B3C36', 1),
(111, 'Blanched almond', '#FFEBCD', 1),
(112, 'Blast-off bronze', '#A57164', 1),
(113, 'Bleu de France', '#318CE7', 1),
(114, 'Blizzard Blue', '#ACE5EE', 1),
(115, 'Blond', '#FAF0BE', 1),
(116, 'Blue', '#0000FF', 1),
(117, 'Blue (Crayola)', '#1F75FE', 1),
(118, 'Blue (Munsell)', '#0093AF', 1),
(119, 'Blue (NCS)', '#0087BD', 1),
(120, 'Blue (pigment)', '#333399', 1),
(121, 'Blue (RYB)', '#0247FE', 1),
(122, 'Blue Bell', '#A2A2D0', 1),
(123, 'Blue-gray', '#6699CC', 1),
(124, 'Blue-green', '#0D98BA', 1),
(125, 'Blue sapphire', '#126180', 1),
(126, 'Blue-violet', '#8A2BE2', 1),
(127, 'Blue yonder', '#5072A7', 1),
(128, 'Blueberry', '#4F86F7', 1),
(129, 'Bluebonnet', '#1C1CF0', 1),
(130, 'Blush', '#DE5D83', 1),
(131, 'Bole', '#79443B', 1),
(132, 'Bondi blue', '#0095B6', 1),
(133, 'Bone', '#E3DAC9', 1),
(134, 'Boston University Red', '#CC0000', 1),
(135, 'Bottle green', '#006A4E', 1),
(136, 'Boysenberry', '#873260', 1),
(137, 'Brandeis blue', '#0070FF', 1),
(138, 'Brass', '#B5A642', 1),
(139, 'Brick red', '#CB4154', 1),
(140, 'Bright cerulean', '#1DACD6', 1),
(141, 'Bright green', '#66FF00', 1),
(142, 'Bright lavender', '#BF94E4', 1),
(143, 'Bright lilac', '#D891EF', 1),
(144, 'Bright maroon', '#C32148', 1),
(145, 'Bright navy blue', '#1974D2', 1),
(146, 'Bright pink', '#FF007F', 1),
(147, 'Bright turquoise', '#08E8DE', 1),
(148, 'Bright ube', '#D19FE8', 1),
(149, 'Brilliant lavender', '#F4BBFF', 1),
(150, 'Brilliant rose', '#FF55A3', 1),
(151, 'Brink pink', '#FB607F', 1),
(152, 'British racing green', '#004225', 1),
(153, 'Bronze', '#CD7F32', 1),
(154, 'Bronze Yellow', '#737000', 1),
(155, 'Brown (traditional)', '#964B00', 1),
(156, 'Brown (web)', '#A52A2A', 1),
(157, 'Brown-nose', '#6B4423', 1),
(158, 'Brunswick green', '#1B4D3E', 1),
(159, 'Bubble gum', '#FFC1CC', 1),
(160, 'Bubbles', '#E7FEFF', 1),
(161, 'Buff', '#F0DC82', 1),
(162, 'Bud green', '#7BB661', 1),
(163, 'Bulgarian rose', '#480607', 1),
(164, 'Burgundy', '#800020', 1),
(165, 'Burlywood', '#DEB887', 1),
(166, 'Burnt orange', '#CC5500', 1),
(167, 'Burnt sienna', '#E97451', 1),
(168, 'Burnt umber', '#8A3324', 1),
(169, 'Byzantine', '#BD33A4', 1),
(170, 'Byzantium', '#702963', 1),
(171, 'Cadet', '#536872', 1),
(172, 'Cadet blue', '#5F9EA0', 1),
(173, 'Cadet grey', '#91A3B0', 1),
(174, 'Cadmium green', '#006B3C', 1),
(175, 'Cadmium orange', '#ED872D', 1),
(176, 'Cadmium red', '#E30022', 1),
(177, 'Cadmium yellow', '#FFF600', 1),
(178, 'Café au lait', '#A67B5B', 1),
(179, 'Café noir', '#4B3621', 1),
(180, 'Cal Poly green', '#1E4D2B', 1),
(181, 'Cambridge Blue', '#A3C1AD', 1),
(182, 'Camel', '#C19A6B', 1),
(183, 'Cameo pink', '#EFBBCC', 1),
(184, 'Camouflage green', '#78866B', 1),
(185, 'Canary yellow', '#FFEF00', 1),
(186, 'Candy apple red', '#FF0800', 1),
(187, 'Candy pink', '#E4717A', 1),
(188, 'Capri', '#00BFFF', 1),
(189, 'Caput mortuum', '#592720', 1),
(190, 'Cardinal', '#C41E3A', 1),
(191, 'Caribbean green', '#00CC99', 1),
(192, 'Carmine', '#960018', 1),
(193, 'Carmine (M&P)', '#D70040', 1),
(194, 'Carnelian', '#B31B1B', 1),
(195, 'Carolina blue', '#99BADD', 1),
(196, 'Carrot orange', '#ED9121', 1),
(197, 'Castleton green', '#00563F', 1),
(198, 'Catalina blue', '#062A78', 1),
(199, 'Catawba', '#703642', 1),
(200, 'Cedar Chest', '#C95A49', 1),
(201, 'Ceil', '#92A1CF', 1),
(202, 'Celadon', '#ACE1AF', 1),
(203, 'Celadon blue', '#007BA7', 1),
(204, 'Celadon green', '#2F847C', 1),
(205, 'Celeste', '#B2FFFF', 1),
(206, 'Celestial blue', '#4997D0', 1),
(207, 'Cerise', '#DE3163', 1),
(208, 'Cerise pink', '#EC3B83', 1),
(209, 'Cerulean', '#007BA7', 1),
(210, 'Cerulean blue', '#2A52BE', 1),
(211, 'Cerulean frost', '#6D9BC3', 1),
(212, 'CG Blue', '#007AA5', 1),
(213, 'CG Red', '#E03C31', 1),
(214, 'Chamoisee', '#A0785A', 1),
(215, 'Champagne', '#F7E7CE', 1),
(216, 'Charcoal', '#36454F', 1),
(217, 'Charleston green', '#232B2B', 1),
(218, 'Charm pink', '#E68FAC', 1),
(219, 'Chartreuse (traditional)', '#DFFF00', 1),
(220, 'Chartreuse (web)', '#7FFF00', 1),
(221, 'Cherry', '#DE3163', 1),
(222, 'Cherry blossom pink', '#FFB7C5', 1),
(223, 'Chestnut', '#954535', 1),
(224, 'China pink', '#DE6FA1', 1),
(225, 'China rose', '#A8516E', 1),
(226, 'Chinese red', '#AA381E', 1),
(227, 'Chinese violet', '#856088', 1),
(228, 'Chocolate (traditional)', '#7B3F00', 1),
(229, 'Chocolate (web)', '#D2691E', 1),
(230, 'Chrome yellow', '#FFA700', 1),
(231, 'Cinereous', '#98817B', 1),
(232, 'Cinnabar', '#E34234', 1),
(233, 'Cinnamon', '#D2691E', 1),
(234, 'Citrine', '#E4D00A', 1),
(235, 'Citron', '#9FA91F', 1),
(236, 'Claret', '#7F1734', 1),
(237, 'Classic rose', '#FBCCE7', 1),
(238, 'Cobalt', '#0047AB', 1),
(239, 'Cocoa brown', '#D2691E', 1),
(240, 'Coconut', '#965A3E', 1),
(241, 'Coffee', '#6F4E37', 1),
(242, 'Columbia blue', '#9BDDFF', 1),
(243, 'Congo pink', '#F88379', 1),
(244, 'Cool black', '#002E63', 1),
(245, 'Cool grey', '#8C92AC', 1),
(246, 'Copper', '#B87333', 1),
(247, 'Copper (Crayola)', '#DA8A67', 1),
(248, 'Copper penny', '#AD6F69', 1),
(249, 'Copper red', '#CB6D51', 1),
(250, 'Copper rose', '#996666', 1),
(251, 'Coquelicot', '#FF3800', 1),
(252, 'Coral', '#FF7F50', 1),
(253, 'Coral pink', '#F88379', 1),
(254, 'Coral red', '#FF4040', 1),
(255, 'Cordovan', '#893F45', 1),
(256, 'Corn', '#FBEC5D', 1),
(257, 'Cornell Red', '#B31B1B', 1),
(258, 'Cornflower blue', '#6495ED', 1),
(259, 'Cornsilk', '#FFF8DC', 1),
(260, 'Cosmic latte', '#FFF8E7', 1),
(261, 'Cotton candy', '#FFBCD9', 1),
(262, 'Cream', '#FFFDD0', 1),
(263, 'Crimson', '#DC143C', 1),
(264, 'Crimson glory', '#BE0032', 1),
(265, 'Cyan', '#00FFFF', 1),
(266, 'Cyan (process)', '#00B7EB', 1),
(267, 'Cyber grape', '#58427C', 1),
(268, 'Cyber yellow', '#FFD300', 1),
(269, 'Daffodil', '#FFFF31', 1),
(270, 'Dandelion', '#F0E130', 1),
(271, 'Dark blue', '#00008B', 1),
(272, 'Dark blue-gray', '#666699', 1),
(273, 'Dark brown', '#654321', 1),
(274, 'Dark byzantium', '#5D3954', 1),
(275, 'Dark candy apple red', '#A40000', 1),
(276, 'Dark cerulean', '#08457E', 1),
(277, 'Dark chestnut', '#986960', 1),
(278, 'Dark coral', '#CD5B45', 1),
(279, 'Dark cyan', '#008B8B', 1),
(280, 'Dark electric blue', '#536878', 1),
(281, 'Dark goldenrod', '#B8860B', 1),
(282, 'Dark gray', '#A9A9A9', 1),
(283, 'Dark green', '#013220', 1),
(284, 'Dark imperial blue', '#00416A', 1),
(285, 'Dark jungle green', '#1A2421', 1),
(286, 'Dark khaki', '#BDB76B', 1),
(287, 'Dark lava', '#483C32', 1),
(288, 'Dark lavender', '#734F96', 1),
(289, 'Dark liver', '#534B4F', 1),
(290, 'Dark liver (horses)', '#543D37', 1),
(291, 'Dark magenta', '#8B008B', 1),
(292, 'Dark midnight blue', '#003366', 1),
(293, 'Dark moss green', '#4A5D23', 1),
(294, 'Dark olive green', '#556B2F', 1),
(295, 'Dark orange', '#FF8C00', 1),
(296, 'Dark orchid', '#9932CC', 1),
(297, 'Dark pastel blue', '#779ECB', 1),
(298, 'Dark pastel green', '#03C03C', 1),
(299, 'Dark pastel purple', '#966FD6', 1),
(300, 'Dark pastel red', '#C23B22', 1),
(301, 'Dark pink', '#E75480', 1),
(302, 'Dark powder blue', '#003399', 1),
(303, 'Dark puce', '#4F3A3C', 1),
(304, 'Dark raspberry', '#872657', 1),
(305, 'Dark red', '#8B0000', 1),
(306, 'Dark salmon', '#E9967A', 1),
(307, 'Dark scarlet', '#560319', 1),
(308, 'Dark sea green', '#8FBC8F', 1),
(309, 'Dark sienna', '#3C1414', 1),
(310, 'Dark sky blue', '#8CBED6', 1),
(311, 'Dark slate blue', '#483D8B', 1),
(312, 'Dark slate gray', '#2F4F4F', 1),
(313, 'Dark spring green', '#177245', 1),
(314, 'Dark tan', '#918151', 1),
(315, 'Dark tangerine', '#FFA812', 1),
(316, 'Dark taupe', '#483C32', 1),
(317, 'Dark terra cotta', '#CC4E5C', 1),
(318, 'Dark turquoise', '#00CED1', 1),
(319, 'Dark vanilla', '#D1BEA8', 1),
(320, 'Dark violet', '#9400D3', 1),
(321, 'Dark yellow', '#9B870C', 1),
(322, 'Dartmouth green', '#00703C', 1),
(323, 'Davy''s grey', '#555555', 1),
(324, 'Debian red', '#D70A53', 1),
(325, 'Deep carmine', '#A9203E', 1),
(326, 'Deep carmine pink', '#EF3038', 1),
(327, 'Deep carrot orange', '#E9692C', 1),
(328, 'Deep cerise', '#DA3287', 1),
(329, 'Deep champagne', '#FAD6A5', 1),
(330, 'Deep chestnut', '#B94E48', 1),
(331, 'Deep coffee', '#704241', 1),
(332, 'Deep fuchsia', '#C154C1', 1),
(333, 'Deep jungle green', '#004B49', 1),
(334, 'Deep lemon', '#F5C71A', 1),
(335, 'Deep lilac', '#9955BB', 1),
(336, 'Deep magenta', '#CC00CC', 1),
(337, 'Deep mauve', '#D473D4', 1),
(338, 'Deep moss green', '#355E3B', 1),
(339, 'Deep peach', '#FFCBA4', 1),
(340, 'Deep pink', '#FF1493', 1),
(341, 'Deep puce', '#A95C68', 1),
(342, 'Deep ruby', '#843F5B', 1),
(343, 'Deep saffron', '#FF9933', 1),
(344, 'Deep sky blue', '#00BFFF', 1),
(345, 'Deep Space Sparkle', '#4A646C', 1),
(346, 'Deep Taupe', '#7E5E60', 1),
(347, 'Deep Tuscan red', '#66424D', 1),
(348, 'Deer', '#BA8759', 1),
(349, 'Denim', '#1560BD', 1),
(350, 'Desert', '#C19A6B', 1),
(351, 'Desert sand', '#EDC9AF', 1),
(352, 'Desire', '#EA3C53', 1),
(353, 'Diamond', '#B9F2FF', 1),
(354, 'Dim gray', '#696969', 1),
(355, 'Dirt', '#9B7653', 1),
(356, 'Dodger blue', '#1E90FF', 1),
(357, 'Dogwood rose', '#D71868', 1),
(358, 'Dollar bill', '#85BB65', 1),
(359, 'Donkey Brown', '#664C28', 1),
(360, 'Drab', '#967117', 1),
(361, 'Duke blue', '#00009C', 1),
(362, 'Dust storm', '#E5CCC9', 1),
(363, 'Dutch white', '#EFDFBB', 1),
(364, 'Earth yellow', '#E1A95F', 1),
(365, 'Ebony', '#555D50', 1),
(366, 'Ecru', '#C2B280', 1),
(367, 'Eerie black', '#1B1B1B', 1),
(368, 'Eggplant', '#614051', 1),
(369, 'Eggshell', '#F0EAD6', 1),
(370, 'Egyptian blue', '#1034A6', 1),
(371, 'Electric blue', '#7DF9FF', 1),
(372, 'Electric crimson', '#FF003F', 1),
(373, 'Electric cyan', '#00FFFF', 1),
(374, 'Electric green', '#00FF00', 1),
(375, 'Electric indigo', '#6F00FF', 1),
(376, 'Electric lavender', '#F4BBFF', 1),
(377, 'Electric lime', '#CCFF00', 1),
(378, 'Electric purple', '#BF00FF', 1),
(379, 'Electric ultramarine', '#3F00FF', 1),
(380, 'Electric violet', '#8F00FF', 1),
(381, 'Electric yellow', '#FFFF00', 1),
(382, 'Emerald', '#50C878', 1),
(383, 'Eminence', '#6C3082', 1),
(384, 'English green', '#1B4D3E', 1),
(385, 'English lavender', '#B48395', 1),
(386, 'English red', ' 	#AB4B52', 1),
(387, 'English violet', '#563C5C', 1),
(388, 'Eton blue', '#96C8A2', 1),
(389, 'Eucalyptus', '#44D7A8', 1),
(390, 'Fallow', '#C19A6B', 1),
(391, 'Falu red', '#801818', 1),
(392, 'Fandango', '#B53389', 1),
(393, 'Fandango pink', '#DE5285', 1),
(394, 'Fashion fuchsia', '#F400A1', 1),
(395, 'Fawn', '#E5AA70', 1),
(396, 'Feldgrau', '#4D5D53', 1),
(397, 'Feldspar', '#FDD5B1', 1),
(398, 'Fern green', '#4F7942', 1),
(399, 'Ferrari Red', '#FF2800', 1),
(400, 'Field drab', '#6C541E', 1),
(401, 'Firebrick', '#B22222', 1),
(402, 'Fire engine red', '#CE2029', 1),
(403, 'Flame', '#E25822', 1),
(404, 'Flamingo pink', '#FC8EAC', 1),
(405, 'Flattery', '#6B4423', 1),
(406, 'Flavescent', '#F7E98E', 1),
(407, 'Flax', '#EEDC82', 1),
(408, 'Flirt', '#A2006D', 1),
(409, 'Floral white', '#FFFAF0', 1),
(410, 'Fluorescent orange', '#FFBF00', 1),
(411, 'Fluorescent pink', '#FF1493', 1),
(412, 'Fluorescent yellow', '#CCFF00', 1),
(413, 'Folly', '#FF004F', 1),
(414, 'Forest green (traditional)', '#014421', 1),
(415, 'Forest green (web)', '#228B22', 1),
(416, 'French beige', '#A67B5B', 1),
(417, 'French bistre', '#856D4D', 1),
(418, 'French blue', '#0072BB', 1),
(419, 'French fuchsia', '#FD3F92', 1),
(420, 'French lilac', '#86608E', 1),
(421, 'French lime', '#9EFD38', 1),
(422, 'French mauve', '#D473D4', 1),
(423, 'French pink', '#FD6C9E', 1),
(424, 'French puce', '#4E1609', 1),
(425, 'French raspberry', '#C72C48', 1),
(426, 'French rose', '#F64A8A', 1),
(427, 'French sky blue', '#77B5FE', 1),
(428, 'French violet', '#8806CE', 1),
(429, 'French wine', '#AC1E44', 1),
(430, 'Fresh Air', '#A6E7FF', 1),
(431, 'Fuchsia', '#FF00FF', 1),
(432, 'Fuchsia (Crayola)', '#C154C1', 1),
(433, 'Fuchsia pink', '#FF77FF', 1),
(434, 'Fuchsia purple', '#CC397B', 1),
(435, 'Fuchsia rose', '#C74375', 1),
(436, 'Fulvous', '#E48400', 1),
(437, 'Fuzzy Wuzzy', '#CC6666', 1),
(438, 'Gainsboro', '#DCDCDC', 1),
(439, 'Gamboge', '#E49B0F', 1),
(440, 'Generic viridian', '#007F66', 1),
(441, 'Ghost white', '#F8F8FF', 1),
(442, 'Giants orange', '#FE5A1D', 1),
(443, 'Ginger', '#B06500', 1),
(444, 'Glaucous', '#6082B6', 1),
(445, 'Glitter', '#E6E8FA', 1),
(446, 'GO green', '#00AB66', 1),
(447, 'Gold (metallic)', '#D4AF37', 1),
(448, 'Gold (web) (Golden)', '#FFD700', 1),
(449, 'Gold Fusion', '#85754E', 1),
(450, 'Golden brown', '#996515', 1),
(451, 'Golden poppy', '#FCC200', 1),
(452, 'Golden yellow', '#FFDF00', 1),
(453, 'Goldenrod', '#DAA520', 1),
(454, 'Granny Smith Apple', '#A8E4A0', 1),
(455, 'Grape', '#6F2DA8', 1),
(456, 'Gray', '#808080', 1),
(457, 'Gray (HTML/CSS gray)', '#808080', 1),
(458, 'Gray (X11 gray)', '#BEBEBE', 1),
(459, 'Gray-asparagus', '#465945', 1),
(460, 'Gray-blue', '#8C92AC', 1),
(461, 'Green (Color Wheel) (X11 green)', '#00FF00', 1),
(462, 'Green (Crayola)', '#1CAC78', 1),
(463, 'Green (HTML/CSS color)', '#008000', 1),
(464, 'Green (Munsell)', '#00A877', 1),
(465, 'Green (NCS)', '#009F6B', 1),
(466, 'Green (pigment)', '#00A550', 1),
(467, 'Green (RYB)', '#66B032', 1),
(468, 'Green-yellow', '#ADFF2F', 1),
(469, 'Grullo', '#A99A86', 1),
(470, 'Guppie green', '#00FF7F', 1),
(471, 'Halayà úbe', '#663854', 1),
(472, 'Han blue', '#446CCF', 1),
(473, 'Han purple', '#5218FA', 1),
(474, 'Hansa yellow', '#E9D66B', 1),
(475, 'Harlequin', '#3FFF00', 1),
(476, 'Harvard crimson', '#C90016', 1),
(477, 'Harvest gold', '#DA9100', 1),
(478, 'Heart Gold', '#808000', 1),
(479, 'Heliotrope', '#DF73FF', 1),
(480, 'Heliotrope gray', '#AA98A9', 1),
(481, 'Hollywood cerise', '#F400A1', 1),
(482, 'Honeydew', '#F0FFF0', 1),
(483, 'Honolulu blue', '#006DB0', 1),
(484, 'Hooker''s green', '#49796B', 1),
(485, 'Hot magenta', '#FF1DCE', 1),
(486, 'Hot pink', '#FF69B4', 1),
(487, 'Hunter green', '#355E3B', 1),
(488, 'Iceberg', '#71A6D2', 1),
(489, 'Icterine', '#FCF75E', 1),
(490, 'Illuminating Emerald', '#319177', 1),
(491, 'Imperial', '#602F6B', 1),
(492, 'Imperial blue', '#002395', 1),
(493, 'Imperial purple', '#66023C', 1),
(494, 'Imperial red', '#ED2939', 1),
(495, 'Inchworm', '#B2EC5D', 1),
(496, 'Independence', '#4C516D', 1),
(497, 'India green', '#138808', 1),
(498, 'Indian yellow', '#E3A857', 1),
(499, 'Indigo', '#6F00FF', 1),
(500, 'Indigo dye', '#091F92', 1),
(501, 'Indigo (web)', '#4B0082', 1),
(502, 'International Klein Blue', '#002FA7', 1),
(503, 'International orange (aerospace)', '#FF4F00', 1),
(504, 'International orange (engineering)', '#BA160C', 1),
(505, 'International orange (Golden Gate Bridge)', '#C0362C', 1),
(506, 'Iris', '#5A4FCF', 1),
(507, 'Irresistible', '#B3446C', 1),
(508, 'Isabelline', '#F4F0EC', 1),
(509, 'Islamic green', '#009000', 1),
(510, 'Italian sky blue', '#B2FFFF', 1),
(511, 'Ivory', '#FFFFF0', 1),
(512, 'Jade', '#00A86B', 1),
(513, 'Japanese carmine', '#9D2933', 1),
(514, 'Japanese indigo', '#264348', 1),
(515, 'Japanese violet', '#5B3256', 1),
(516, 'Jasmine', '#F8DE7E', 1),
(517, 'Jasper', '#D73B3E', 1),
(518, 'Jazzberry jam', '#A50B5E', 1),
(519, 'Jelly Bean', '#DA614E', 1),
(520, 'Jet', '#343434', 1),
(521, 'Jonquil', '#F4CA16', 1),
(522, 'Jordy blue', '#8AB9F1', 1),
(523, 'June bud', '#BDDA57', 1),
(524, 'Jungle green', '#29AB87', 1),
(525, 'Kelly green', '#4CBB17', 1),
(526, 'Kenyan copper', '#7C1C05', 1),
(527, 'Keppel', '#3AB09E', 1),
(528, 'Khaki (HTML/CSS) (Khaki)', '#C3B091', 1),
(529, 'Khaki (X11) (Light khaki)', '#F0E68C', 1),
(530, 'Kobe', '#882D17', 1),
(531, 'Kobi', '#E79FC4', 1),
(532, 'Kombu green', '#354230', 1),
(533, 'KU Crimson', '#E8000D', 1),
(534, 'La Salle Green', '#087830', 1),
(535, 'Languid lavender', '#D6CADD', 1),
(536, 'Lapis lazuli', '#26619C', 1),
(537, 'Laser Lemon', '#FFFF66', 1),
(538, 'Laurel green', '#A9BA9D', 1),
(539, 'Lava', '#CF1020', 1),
(540, 'Lavender (floral)', '#B57EDC', 1),
(541, 'Lavender (web)', '#E6E6FA', 1),
(542, 'Lavender blue', '#CCCCFF', 1),
(543, 'Lavender blush', '#FFF0F5', 1),
(544, 'Lavender gray', '#C4C3D0', 1),
(545, 'Lavender indigo', '#9457EB', 1),
(546, 'Lavender magenta', '#EE82EE', 1),
(547, 'Lavender mist', '#E6E6FA', 1),
(548, 'Lavender pink', '#FBAED2', 1),
(549, 'Lavender purple', '#967BB6', 1),
(550, 'Lavender rose', '#FBA0E3', 1),
(551, 'Lawn green', '#7CFC00', 1),
(552, 'Lemon', '#FFF700', 1),
(553, 'Lemon chiffon', '#FFFACD', 1),
(554, 'Lemon curry', '#CCA01D', 1),
(555, 'Lemon glacier', '#FDFF00', 1),
(556, 'Lemon lime', '#E3FF00', 1),
(557, 'Lemon meringue', '#F6EABE', 1),
(558, 'Lemon yellow', '#FFF44F', 1),
(559, 'Licorice', '#1A1110', 1),
(560, 'Liberty', '#545AA7', 1),
(561, 'Light apricot', '#FDD5B1', 1),
(562, 'Light blue', '#ADD8E6', 1),
(563, 'Light brown', '#B5651D', 1),
(564, 'Light carmine pink', '#E66771', 1),
(565, 'Light coral', '#F08080', 1),
(566, 'Light cornflower blue', '#93CCEA', 1),
(567, 'Light crimson', '#F56991', 1),
(568, 'Light cyan', '#E0FFFF', 1),
(569, 'Light deep pink', '#FF5CCD', 1),
(570, 'Light fuchsia pink', '#F984EF', 1),
(571, 'Light goldenrod yellow', '#FAFAD2', 1),
(572, 'Light gray', '#D3D3D3', 1),
(573, 'Light green', '#90EE90', 1),
(574, 'Light hot pink', '#FFB3DE', 1),
(575, 'Light khaki', '#F0E68C', 1),
(576, 'Light medium orchid', '#D39BCB', 1),
(577, 'Light moss green', '#ADDFAD', 1),
(578, 'Light orchid', '#E6A8D7', 1),
(579, 'Light pastel purple', '#B19CD9', 1),
(580, 'Light pink', '#FFB6C1', 1),
(581, 'Light red ochre', '#E97451', 1),
(582, 'Light salmon', '#FFA07A', 1),
(583, 'Light salmon pink', '#FF9999', 1),
(584, 'Light sea green', '#20B2AA', 1),
(585, 'Light sky blue', '#87CEFA', 1),
(586, 'Light slate gray', '#778899', 1),
(587, 'Light steel blue', '#B0C4DE', 1),
(588, 'Light taupe', '#B38B6D', 1),
(589, 'Light Thulian pink', '#E68FAC', 1),
(590, 'Light yellow', '#FFFFE0', 1),
(591, 'Lilac', '#C8A2C8', 1),
(592, 'Lime (color wheel)', '#BFFF00', 1),
(593, 'Lime (web) (X11 green)', '#00FF00', 1),
(594, 'Lime green', '#32CD32', 1),
(595, 'Limerick', '#9DC209', 1),
(596, 'Lincoln green', '#195905', 1),
(597, 'Linen', '#FAF0E6', 1),
(598, 'Lion', '#C19A6B', 1),
(599, 'Liseran Purple', '#DE6FA1', 1),
(600, 'Little boy blue', '#6CA0DC', 1),
(601, 'Liver', '#674C47', 1),
(602, 'Liver (dogs)', '#B86D29', 1),
(603, 'Liver (organ)', '#6C2E1F', 1),
(604, 'Liver chestnut', '#987456', 1),
(605, 'Livid', '#6699CC', 1),
(606, 'Lumber', '#FFE4CD', 1),
(607, 'Lust', '#E62020', 1),
(608, 'Magenta', '#FF00FF', 1),
(609, 'Magenta (Crayola)', '#FF55A3', 1),
(610, 'Magenta (dye)', '#CA1F7B', 1),
(611, 'Magenta (Pantone)', '#D0417E', 1),
(612, 'Magenta (process)', '#FF0090', 1),
(613, 'Magenta haze', '#9F4576', 1),
(614, 'Magic mint', '#AAF0D1', 1),
(615, 'Magnolia', '#F8F4FF', 1),
(616, 'Mahogany', '#C04000', 1),
(617, 'Maize', '#FBEC5D', 1),
(618, 'Majorelle Blue', '#6050DC', 1),
(619, 'Malachite', '#0BDA51', 1),
(620, 'Manatee', '#979AAA', 1),
(621, 'Mango Tango', '#FF8243', 1),
(622, 'Mantis', '#74C365', 1),
(623, 'Mardi Gras', '#880085', 1),
(624, 'Maroon (Crayola)', '#C32148', 1),
(625, 'Maroon (HTML/CSS)', '#800000', 1),
(626, 'Maroon (X11)', '#B03060', 1),
(627, 'Mauve', '#E0B0FF', 1),
(628, 'Mauve taupe', '#915F6D', 1),
(629, 'Mauvelous', '#EF98AA', 1),
(630, 'May green', '#4C9141', 1),
(631, 'Maya blue', '#73C2FB', 1),
(632, 'Meat brown', '#E5B73B', 1),
(633, 'Medium aquamarine', '#66DDAA', 1),
(634, 'Medium blue', '#0000CD', 1),
(635, 'Medium candy apple red', '#E2062C', 1),
(636, 'Medium carmine', '#AF4035', 1),
(637, 'Medium champagne', '#F3E5AB', 1),
(638, 'Medium electric blue', '#035096', 1),
(639, 'Medium jungle green', '#1C352D', 1),
(640, 'Medium lavender magenta', '#DDA0DD', 1),
(641, 'Medium orchid', '#BA55D3', 1),
(642, 'Medium Persian blue', '#0067A5', 1),
(643, 'Medium purple', '#9370DB', 1),
(644, 'Medium red-violet', '#BB3385', 1),
(645, 'Medium ruby', '#AA4069', 1),
(646, 'Medium sea green', '#3CB371', 1),
(647, 'Medium sky blue', '#80DAEB', 1),
(648, 'Medium slate blue', '#7B68EE', 1),
(649, 'Medium spring bud', '#C9DC87', 1),
(650, 'Medium spring green', '#00FA9A', 1),
(651, 'Medium taupe', '#674C47', 1),
(652, 'Medium turquoise', '#48D1CC', 1),
(653, 'Medium Tuscan red', '#79443B', 1),
(654, 'Medium vermilion', '#D9603B', 1),
(655, 'Medium violet-red', '#C71585', 1),
(656, 'Mellow apricot', '#F8B878', 1),
(657, 'Mellow yellow', '#F8DE7E', 1),
(658, 'Melon', '#FDBCB4', 1),
(659, 'Metallic Seaweed', '#0A7E8C', 1),
(660, 'Metallic Sunburst', '#9C7C38', 1),
(661, 'Mexican pink', '#E4007C', 1),
(662, 'Midnight blue', '#191970', 1),
(663, 'Midnight green (eagle green)', '#004953', 1),
(664, 'Mikado yellow', '#FFC40C', 1),
(665, 'Mindaro', '#E3F988', 1),
(666, 'Mint', '#3EB489', 1),
(667, 'Mint cream', '#F5FFFA', 1),
(668, 'Mint green', '#98FF98', 1),
(669, 'Misty rose', '#FFE4E1', 1),
(670, 'Moccasin', '#FAEBD7', 1),
(671, 'Mode beige', '#967117', 1),
(672, 'Moonstone blue', '#73A9C2', 1),
(673, 'Mordant red 19', '#AE0C00', 1),
(674, 'Moss green', '#8A9A5B', 1),
(675, 'Mountain Meadow', '#30BA8F', 1),
(676, 'Mountbatten pink', '#997A8D', 1),
(677, 'MSU Green', '#18453B', 1),
(678, 'Mughal green', '#306030', 1),
(679, 'Mulberry', '#C54B8C', 1),
(680, 'Mustard', '#FFDB58', 1),
(681, 'Myrtle green', '#317873', 1),
(682, 'Nadeshiko pink', '#F6ADC6', 1),
(683, 'Napier green', '#2A8000', 1),
(684, 'Naples yellow', '#FADA5E', 1),
(685, 'Navajo white', '#FFDEAD', 1),
(686, 'Navy', '#000080', 1),
(687, 'Navy purple', '#9457EB', 1),
(688, 'Neon Carrot', '#FFA343', 1),
(689, 'Neon fuchsia', '#FE4164', 1),
(690, 'Neon green', '#39FF14', 1),
(691, 'New Car', '#214FC6', 1),
(692, 'New York pink', '#D7837F', 1),
(693, 'Non-photo blue', '#A4DDED', 1),
(694, 'North Texas Green', '#059033', 1),
(695, 'Nyanza', '#E9FFDB', 1),
(696, 'Ocean Boat Blue', '#0077BE', 1),
(697, 'Ochre', '#CC7722', 1),
(698, 'Office green', '#008000', 1),
(699, 'Old burgundy', '#43302E', 1),
(700, 'Old gold', '#CFB53B', 1),
(701, 'Old heliotrope', '#563C5C', 1),
(702, 'Old lace', '#FDF5E6', 1),
(703, 'Old lavender', '#796878', 1),
(704, 'Old mauve', '#673147', 1),
(705, 'Old moss green', '#867E36', 1),
(706, 'Old rose', '#C08081', 1),
(707, 'Old silver', '#848482', 1),
(708, 'Olive', '#808000', 1),
(709, 'Olive Drab (#3)', '#6B8E23', 1),
(710, 'Olive Drab #7', '#3C341F', 1),
(711, 'Olivine', '#9AB973', 1),
(712, 'Onyx', '#353839', 1),
(713, 'Opera mauve', '#B784A7', 1),
(714, 'Orange (color wheel)', '#FF7F00', 1),
(715, 'Orange (Crayola)', '#FF7538', 1),
(716, 'Orange (Pantone)', '#FF5800', 1),
(717, 'Orange (RYB)', '#FB9902', 1),
(718, 'Orange (web)', '#FFA500', 1),
(719, 'Orange peel', '#FF9F00', 1),
(720, 'Orange-red', '#FF4500', 1),
(721, 'Orchid', '#DA70D6', 1),
(722, 'Orchid pink', '#F2BDCD', 1),
(723, 'Orioles orange', '#FB4F14', 1),
(724, 'Otter brown', '#654321', 1),
(725, 'Outer Space', '#414A4C', 1),
(726, 'Outrageous Orange', '#FF6E4A', 1),
(727, 'Oxford Blue', '#002147', 1),
(728, 'OU Crimson Red', '#990000', 1),
(729, 'Pakistan green', '#006600', 1),
(730, 'Palatinate blue', '#273BE2', 1),
(731, 'Palatinate purple', '#682860', 1),
(732, 'Pale aqua', '#BCD4E6', 1),
(733, 'Pale blue', '#AFEEEE', 1),
(734, 'Pale brown', '#987654', 1),
(735, 'Pale carmine', '#AF4035', 1),
(736, 'Pale cerulean', '#9BC4E2', 1),
(737, 'Pale chestnut', '#DDADAF', 1),
(738, 'Pale copper', '#DA8A67', 1),
(739, 'Pale cornflower blue', '#ABCDEF', 1),
(740, 'Pale gold', '#E6BE8A', 1),
(741, 'Pale goldenrod', '#EEE8AA', 1),
(742, 'Pale green', '#98FB98', 1),
(743, 'Pale lavender', '#DCD0FF', 1),
(744, 'Pale magenta', '#F984E5', 1),
(745, 'Pale pink', '#FADADD', 1),
(746, 'Pale plum', '#DDA0DD', 1),
(747, 'Pale red-violet', '#DB7093', 1),
(748, 'Pale robin egg blue', '#96DED1', 1),
(749, 'Pale silver', '#C9C0BB', 1),
(750, 'Pale spring bud', '#ECEBBD', 1),
(751, 'Pale taupe', '#BC987E', 1),
(752, 'Pale turquoise', '#AFEEEE', 1),
(753, 'Pale violet-red', '#DB7093', 1),
(754, 'Pansy purple', '#78184A', 1),
(755, 'Paolo Veronese green', '#009B7D', 1),
(756, 'Papaya whip', '#FFEFD5', 1),
(757, 'Paradise pink', '#E63E62', 1),
(758, 'Paris Green', '#50C878', 1),
(759, 'Pastel blue', '#AEC6CF', 1),
(760, 'Pastel brown', '#836953', 1),
(761, 'Pastel gray', '#CFCFC4', 1),
(762, 'Pastel green', '#77DD77', 1),
(763, 'Pastel magenta', '#F49AC2', 1),
(764, 'Pastel orange', '#FFB347', 1),
(765, 'Pastel pink', '#DEA5A4', 1),
(766, 'Pastel purple', '#B39EB5', 1),
(767, 'Pastel red', '#FF6961', 1),
(768, 'Pastel violet', '#CB99C9', 1),
(769, 'Pastel yellow', '#FDFD96', 1),
(770, 'Patriarch', '#800080', 1),
(771, 'Payne''s grey', '#536878', 1),
(772, 'Peach', '#FFE5B4', 1),
(773, 'Peach-orange', '#FFCC99', 1),
(774, 'Peach puff', '#FFDAB9', 1),
(775, 'Peach-yellow', '#FADFAD', 1),
(776, 'Pear', '#D1E231', 1),
(777, 'Pearl', '#EAE0C8', 1),
(778, 'Pearl Aqua', '#88D8C0', 1),
(779, 'Pearly purple', '#B768A2', 1),
(780, 'Peridot', '#E6E200', 1),
(781, 'Periwinkle', '#CCCCFF', 1),
(782, 'Persian blue', '#1C39BB', 1),
(783, 'Persian green', '#00A693', 1),
(784, 'Persian indigo', '#32127A', 1),
(785, 'Persian orange', '#D99058', 1),
(786, 'Persian pink', '#F77FBE', 1),
(787, 'Persian plum', '#701C1C', 1),
(788, 'Persian red', '#CC3333', 1),
(789, 'Persian rose', '#FE28A2', 1),
(790, 'Persimmon', '#EC5800', 1),
(791, 'Peru', '#CD853F', 1),
(792, 'Phlox', '#DF00FF', 1),
(793, 'Phthalo blue', '#000F89', 1),
(794, 'Phthalo green', '#123524', 1),
(795, 'Picton blue', '#45B1E8', 1),
(796, 'Pictorial carmine', '#C30B4E', 1),
(797, 'Piggy pink', '#FDDDE6', 1),
(798, 'Pine green', '#01796F', 1),
(799, 'Pink (Pantone)', '#D74894', 1),
(800, 'Pink lace', '#FFDDF4', 1),
(801, 'Pink lavender', '#D8B2D1', 1),
(802, 'Pink-orange', '#FF9966', 1),
(803, 'Pink pearl', '#E7ACCF', 1),
(804, 'Pink Sherbet', '#F78FA7', 1),
(805, 'Pistachio', '#93C572', 1),
(806, 'Platinum', '#E5E4E2', 1),
(807, 'Plum', '#8E4585', 1),
(808, 'Plum (web)', '#DDA0DD', 1),
(809, 'Pomp and Power', '#86608E', 1),
(810, 'Popstar', '#BE4F62', 1),
(811, 'Portland Orange', '#FF5A36', 1),
(812, 'Powder blue', '#B0E0E6', 1),
(813, 'Princeton orange', '#FF8F00', 1),
(814, 'Prune', '#701C1C', 1),
(815, 'Prussian blue', '#003153', 1),
(816, 'Psychedelic purple', '#DF00FF', 1),
(817, 'Puce', '#CC8899', 1),
(818, 'Puce red', '#722F37', 1),
(819, 'Pullman Brown (UPS Brown)', '#644117', 1),
(820, 'Pumpkin', '#FF7518', 1),
(821, 'Purple (HTML)', '#800080', 1),
(822, 'Purple (Munsell)', '#9F00C5', 1),
(823, 'Purple (X11)', '#A020F0', 1),
(824, 'Purple Heart', '#69359C', 1),
(825, 'Purple mountain majesty', '#9678B6', 1),
(826, 'Purple navy', '#4E5180', 1),
(827, 'Purple pizzazz', '#FE4EDA', 1),
(828, 'Purple taupe', '#50404D', 1),
(829, 'Purpureus', '#9A4EAE', 1),
(830, 'Quartz', '#51484F', 1),
(831, 'Queen blue', '#436B95', 1),
(832, 'Queen pink', '#E8CCD7', 1),
(833, 'Quinacridone magenta', '#8E3A59', 1),
(834, 'Rackley', '#5D8AA8', 1),
(835, 'Radical Red', '#FF355E', 1),
(836, 'Rajah', '#FBAB60', 1),
(837, 'Raspberry', '#E30B5D', 1),
(838, 'Raspberry glace', '#915F6D', 1),
(839, 'Raspberry pink', '#E25098', 1),
(840, 'Raspberry rose', '#B3446C', 1),
(841, 'Raw umber', '#826644', 1),
(842, 'Razzle dazzle rose', '#FF33CC', 1),
(843, 'Razzmatazz', '#E3256B', 1),
(844, 'Razzmic Berry', '#8D4E85', 1),
(845, 'Red', '#FF0000', 1),
(846, 'Red (Crayola)', '#EE204D', 1),
(847, 'Red (Munsell)', '#F2003C', 1),
(848, 'Red (NCS)', '#C40233', 1),
(849, 'Red (Pantone)', '#ED2939', 1),
(850, 'Red (pigment)', '#ED1C24', 1),
(851, 'Red (RYB)', '#FE2712', 1),
(852, 'Red-brown', '#A52A2A', 1),
(853, 'Red devil', '#860111', 1),
(854, 'Red-orange', '#FF5349', 1),
(855, 'Red-purple', '#E40078', 1),
(856, 'Red-violet', '#C71585', 1),
(857, 'Redwood', '#A45A52', 1),
(858, 'Regalia', '#522D80', 1),
(859, 'Resolution blue', '#002387', 1),
(860, 'Rhythm', '#777696', 1),
(861, 'Rich black', '#004040', 1),
(862, 'Rich brilliant lavender', '#F1A7FE', 1),
(863, 'Rich carmine', '#D70040', 1),
(864, 'Rich electric blue', '#0892D0', 1),
(865, 'Rich lavender', '#A76BCF', 1),
(866, 'Rich lilac', '#B666D2', 1),
(867, 'Rich maroon', '#B03060', 1),
(868, 'Rifle green', '#444C38', 1),
(869, 'Roast coffee', '#704241', 1),
(870, 'Robin egg blue', '#00CCCC', 1),
(871, 'Rocket metallic', '#8A7F80', 1),
(872, 'Roman silver', '#838996', 1),
(873, 'Rose', '#FF007F', 1),
(874, 'Rose bonbon', '#F9429E', 1),
(875, 'Rose ebony', '#674846', 1),
(876, 'Rose gold', '#B76E79', 1),
(877, 'Rose madder', '#E32636', 1),
(878, 'Rose pink', '#FF66CC', 1),
(879, 'Rose quartz', '#AA98A9', 1),
(880, 'Rose red', '#C21E56', 1),
(881, 'Rose taupe', '#905D5D', 1),
(882, 'Rose vale', '#AB4E52', 1),
(883, 'Rosewood', '#65000B', 1),
(884, 'Rosso corsa', '#D40000', 1),
(885, 'Rosy brown', '#BC8F8F', 1),
(886, 'Royal azure', '#0038A8', 1),
(887, 'Royal blue', '#002366', 1),
(888, 'Royal fuchsia', '#CA2C92', 1),
(889, 'Royal purple', '#7851A9', 1),
(890, 'Royal yellow', '#FADA5E', 1),
(891, 'Ruber', '#CE4676', 1),
(892, 'Rubine red', '#D10056', 1),
(893, 'Ruby', '#E0115F', 1),
(894, 'Ruby red', '#9B111E', 1),
(895, 'Ruddy', '#FF0028', 1),
(896, 'Ruddy brown', '#BB6528', 1),
(897, 'Ruddy pink', '#E18E96', 1),
(898, 'Rufous', '#A81C07', 1),
(899, 'Russet', '#80461B', 1),
(900, 'Russian green', '#679267', 1),
(901, 'Russian violet', '#32174D', 1),
(902, 'Rust', '#B7410E', 1),
(903, 'Rusty red', '#DA2C43', 1),
(904, 'Sacramento State green', '#00563F', 1),
(905, 'Saddle brown', '#8B4513', 1),
(906, 'Safety orange (blaze orange)', '#FF6700', 1),
(907, 'Safety yellow', '#EED202', 1),
(908, 'Saffron', '#F4C430', 1),
(909, 'Sage', '#BCB88A', 1),
(910, 'St. Patrick''s blue', '#23297A', 1),
(911, 'Salmon', '#FA8072', 1),
(912, 'Salmon pink', '#FF91A4', 1),
(913, 'Sand', '#C2B280', 1),
(914, 'Sand dune', '#967117', 1),
(915, 'Sandstorm', '#ECD540', 1),
(916, 'Sandy brown', '#F4A460', 1),
(917, 'Sandy taupe', '#967117', 1),
(918, 'Sangria', '#92000A', 1),
(919, 'Sap green', '#507D2A', 1),
(920, 'Sapphire', '#0F52BA', 1),
(921, 'Sapphire blue', '#0067A5', 1),
(922, 'Satin sheen gold', '#CBA135', 1),
(923, 'Scarlet', '#FF2400', 1),
(924, 'Schauss pink', '#FF91AF', 1),
(925, 'School bus yellow', '#FFD800', 1),
(926, 'Screamin'' Green', '#76FF7A', 1),
(927, 'Sea blue', '#006994', 1),
(928, 'Sea green', '#2E8B57', 1),
(929, 'Seal brown', '#321414', 1),
(930, 'Seashell', '#FFF5EE', 1),
(931, 'Selective yellow', '#FFBA00', 1),
(932, 'Sepia', '#704214', 1),
(933, 'Shadow', '#8A795D', 1),
(934, 'Shadow blue', '#778BA5', 1),
(935, 'Shampoo', '#FFCFF1', 1),
(936, 'Shamrock green', '#009E60', 1),
(937, 'Sheen Green', '#8FD400', 1),
(938, 'Shimmering Blush', '#D98695', 1),
(939, 'Shocking pink', '#FC0FC0', 1),
(940, 'Shocking pink (Crayola)', '#FF6FFF', 1),
(941, 'Sienna', '#882D17', 1),
(942, 'Silver', '#C0C0C0', 1),
(943, 'Silver chalice', '#ACACAC', 1),
(944, 'Silver Lake blue', '#5D89BA', 1),
(945, 'Silver pink', '#C4AEAD', 1),
(946, 'Silver sand', '#BFC1C2', 1),
(947, 'Sinopia', '#CB410B', 1),
(948, 'Skobeloff', '#007474', 1),
(949, 'Sky blue', '#87CEEB', 1),
(950, 'Sky magenta', '#CF71AF', 1),
(951, 'Slate blue', '#6A5ACD', 1),
(952, 'Slate gray', '#708090', 1),
(953, 'Smalt (Dark powder blue)', '#003399', 1),
(954, 'Smitten', '#C84186', 1),
(955, 'Smoke', '#738276', 1),
(956, 'Smokey topaz', '#933D41', 1),
(957, 'Smoky black', '#100C08', 1),
(958, 'Snow', '#FFFAFA', 1),
(959, 'Soap', '#CEC8EF', 1),
(960, 'Solid pink', '#893843', 1),
(961, 'Sonic silver', '#757575', 1),
(962, 'Spartan Crimson', '#9E1316', 1),
(963, 'Space cadet', '#1D2951', 1),
(964, 'Spanish bistre', '#807532', 1),
(965, 'Spanish blue', '#0070B8', 1),
(966, 'Spanish carmine', '#D10047', 1),
(967, 'Spanish crimson', '#E51A4C', 1),
(968, 'Spanish gray', '#989898', 1),
(969, 'Spanish green', '#009150', 1),
(970, 'Spanish orange', '#E86100', 1),
(971, 'Spanish pink', '#F7BFBE', 1),
(972, 'Spanish red', '#E60026', 1),
(973, 'Spanish sky blue', '#00FFFF', 1),
(974, 'Spanish violet', '#4C2882', 1),
(975, 'Spanish viridian', '#007F5C', 1),
(976, 'Spiro Disco Ball', '#0FC0FC', 1),
(977, 'Spring bud', '#A7FC00', 1),
(978, 'Spring green', '#00FF7F', 1),
(979, 'Star command blue', '#007BB8', 1),
(980, 'Steel blue', '#4682B4', 1),
(981, 'Steel pink', '#CC33CC', 1),
(982, 'Stil de grain yellow', '#FADA5E', 1),
(983, 'Stizza', '#990000', 1),
(984, 'Stormcloud', '#4F666A', 1),
(985, 'Straw', '#E4D96F', 1),
(986, 'Strawberry', '#FC5A8D', 1),
(987, 'Sunglow', '#FFCC33', 1),
(988, 'Sunray', '#E3AB57', 1),
(989, 'Sunset', '#FAD6A5', 1),
(990, 'Sunset orange', '#FD5E53', 1),
(991, 'Super pink', '#CF6BA9', 1),
(992, 'Tan', '#D2B48C', 1),
(993, 'Tangelo', '#F94D00', 1),
(994, 'Tangerine', '#F28500', 1),
(995, 'Tangerine yellow', '#FFCC00', 1),
(996, 'Tango pink', '#E4717A', 1),
(997, 'Taupe', '#483C32', 1),
(998, 'Taupe gray', '#8B8589', 1),
(999, 'Tea green', '#D0F0C0', 1),
(1000, 'Tea rose', '#F88379', 1),
(1001, 'Teal', '#008080', 1),
(1002, 'Teal blue', '#367588', 1),
(1003, 'Teal deer', '#99E6B3', 1),
(1004, 'Teal green', '#00827F', 1),
(1005, 'Telemagenta', '#CF3476', 1),
(1006, 'Tenné', '#CD5700', 1),
(1007, 'Terra cotta', '#E2725B', 1),
(1008, 'Thistle', '#D8BFD8', 1),
(1009, 'Thulian pink', '#DE6FA1', 1),
(1010, 'Tickle Me Pink', '#FC89AC', 1),
(1011, 'Tiffany Blue', '#0ABAB5', 1),
(1012, 'Tiger''s eye', '#E08D3C', 1),
(1013, 'Timberwolf', '#DBD7D2', 1),
(1014, 'Titanium yellow', '#EEE600', 1),
(1015, 'Tomato', '#FF6347', 1),
(1016, 'Toolbox', '#746CC0', 1),
(1017, 'Topaz', '#FFC87C', 1),
(1018, 'Tractor red', '#FD0E35', 1),
(1019, 'Trolley Grey', '#808080', 1),
(1020, 'Tropical rain forest', '#00755E', 1),
(1021, 'True Blue', '#0073CF', 1),
(1022, 'Tufts Blue', '#417DC1', 1),
(1023, 'Tulip', '#FF878D', 1),
(1024, 'Tumbleweed', '#DEAA88', 1),
(1025, 'Turkish rose', '#B57281', 1),
(1026, 'Turquoise', '#40E0D0', 1),
(1027, 'Turquoise blue', '#00FFEF', 1),
(1028, 'Turquoise green', '#A0D6B4', 1),
(1029, 'Tuscan', '#FAD6A5', 1),
(1030, 'Tuscan brown', '#6F4E37', 1),
(1031, 'Tuscan red', '#7C4848', 1),
(1032, 'Tuscan tan', '#A67B5B', 1),
(1033, 'Tuscany', '#C09999', 1),
(1034, 'Twilight lavender', '#8A496B', 1),
(1035, 'Tyrian purple', '#66023C', 1),
(1036, 'UA blue', '#0033AA', 1),
(1037, 'UA red', '#D9004C', 1),
(1038, 'Ube', '#8878C3', 1),
(1039, 'UCLA Blue', '#536895', 1),
(1040, 'UCLA Gold', '#FFB300', 1),
(1041, 'UFO Green', '#3CD070', 1),
(1042, 'Ultramarine', '#120A8F', 1),
(1043, 'Ultramarine blue', '#4166F5', 1),
(1044, 'Ultra pink', '#FF6FFF', 1),
(1045, 'Ultra red', '#FC6C85', 1),
(1046, 'Umber', '#635147', 1),
(1047, 'Unbleached silk', '#FFDDCA', 1),
(1048, 'United Nations blue', '#5B92E5', 1),
(1049, 'University of California Gold', '#B78727', 1),
(1050, 'Unmellow yellow', '#FFFF66', 1),
(1051, 'UP Forest green', '#014421', 1),
(1052, 'UP Maroon', '#7B1113', 1),
(1053, 'Upsdell red', '#AE2029', 1),
(1054, 'Urobilin', '#E1AD21', 1),
(1055, 'USAFA blue', '#004F98', 1),
(1056, 'USC Cardinal', '#990000', 1),
(1057, 'USC Gold', '#FFCC00', 1),
(1058, 'University of Tennessee Orange', '#F77F00', 1),
(1059, 'Utah Crimson', '#D3003F', 1),
(1060, 'Vanilla', '#F3E5AB', 1),
(1061, 'Vanilla ice', '#F38FA9', 1),
(1062, 'Vegas gold', '#C5B358', 1),
(1063, 'Venetian red', '#C80815', 1),
(1064, 'Verdigris', '#43B3AE', 1),
(1065, 'Vermilion', '#E34234', 1),
(1066, 'Veronica', '#A020F0', 1),
(1067, 'Violet', '#8F00FF', 1),
(1068, 'Violet (color wheel)', '#7F00FF', 1),
(1069, 'Violet (RYB)', '#8601AF', 1),
(1070, 'Violet (web)', '#EE82EE', 1),
(1071, 'Violet-blue', '#324AB2', 1),
(1072, 'Violet-red', '#F75394', 1),
(1073, 'Viridian', '#40826D', 1),
(1074, 'Viridian green', '#009698', 1),
(1075, 'Vivid auburn', '#922724', 1),
(1076, 'Vivid burgundy', '#9F1D35', 1),
(1077, 'Vivid cerise', '#DA1D81', 1),
(1078, 'Vivid orchid', '#CC00FF', 1),
(1079, 'Vivid sky blue', '#00CCFF', 1),
(1080, 'Vivid tangerine', '#FFA089', 1),
(1081, 'Vivid violet', '#9F00FF', 1),
(1082, 'Warm black', '#004242', 1),
(1083, 'Waterspout', '#A4F4F9', 1),
(1084, 'Wenge', '#645452', 1),
(1085, 'Wheat', '#F5DEB3', 1),
(1086, 'White', '#FFFFFF', 1),
(1087, 'White smoke', '#F5F5F5', 1),
(1088, 'Wild blue yonder', '#A2ADD0', 1),
(1089, 'Wild orchid', '#D470A2', 1),
(1090, 'Wild Strawberry', '#FF43A4', 1),
(1091, 'Wild Watermelon', '#FC6C85', 1),
(1092, 'Willpower orange', '#FD5800', 1),
(1093, 'Windsor tan', '#A75502', 1),
(1094, 'Wine', '#722F37', 1),
(1095, 'Wine dregs', '#673147', 1),
(1096, 'Wisteria', '#C9A0DC', 1),
(1097, 'Wood brown', '#C19A6B', 1),
(1098, 'Xanadu', '#738678', 1),
(1099, 'Yale Blue', '#0F4D92', 1),
(1100, 'Yankees blue', '#1C2841', 1),
(1101, 'Yellow', '#FFFF00', 1),
(1102, 'Yellow (Crayola)', '#FCE883', 1),
(1103, 'Yellow (Munsell)', '#EFCC00', 1),
(1104, 'Yellow (NCS)', '#FFD300', 1),
(1105, 'Yellow (Pantone)', '#FEDF00', 1),
(1106, 'Yellow (process)', '#FFEF00', 1),
(1107, 'Yellow (RYB)', '#FEFE33', 1),
(1108, 'Yellow-green', '#9ACD32', 1),
(1109, 'Yellow Orange', '#FFAE42', 1),
(1110, 'Yellow rose', '#FFF000', 1),
(1111, 'Zaffre', '#0014A8', 1),
(1112, 'Zinnwaldite brown', '#2C1608', 1),
(1113, 'Zomp', '#39A78E', 1),
(1116, 'default', 'none', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_conditions`
--

CREATE TABLE IF NOT EXISTS `ma_conditions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ma_conditions`
--

INSERT INTO `ma_conditions` (`ID`, `name`, `status`) VALUES
(1, 'New', 1),
(2, 'Used', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_config`
--

CREATE TABLE IF NOT EXISTS `ma_config` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `group` enum('Company','System','CMS','Email','Image','Social') NOT NULL,
  `option` varchar(120) NOT NULL,
  `value` text NOT NULL,
  `read` tinyint(5) NOT NULL,
  `write` tinyint(5) NOT NULL,
  `delete` tinyint(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `ma_config`
--

INSERT INTO `ma_config` (`ID`, `group`, `option`, `value`, `read`, `write`, `delete`) VALUES
(12, 'Company', 'company_name', 'Maa Autos 1', 1, 1, 0),
(21, 'CMS', 'meta_title', 'Maa Autos', 1, 1, 0),
(81, 'Image', 'blog_image_max_width', '1000', 1, 1, 1),
(22, 'CMS', 'meta_keyword', 'Maa Autos, CMS, Autos', 1, 1, 0),
(80, 'Image', 'news_image_max_height', '500', 1, 1, 1),
(23, 'CMS', 'meta_description', 'Maa Autos is a framework of content management system', 1, 1, 0),
(75, 'Email', 'feedback_sender_email', 'info@oddyet.com', 1, 1, 1),
(76, 'Company', 'model_start_year', '1980', 1, 1, 1),
(79, 'Image', 'news_image_max_width', '1000', 1, 1, 1),
(26, 'Company', 'company_address', '54-2, company, address', 1, 1, 0),
(27, 'Company', 'company_phone', '+00-000-00-0000', 1, 1, 0),
(28, 'Company', 'company_mobile', '+00-00-00000-0000', 1, 1, 0),
(29, 'Email', 'company_email', 'info@oddyet.com', 1, 1, 0),
(30, 'Email', 'query_received_email', 'info@oddyet.com', 1, 1, 0),
(31, 'Social', 'facebook_link', 'https://www.facebook.com/', 1, 1, 1),
(32, 'Social', 'twitter_link', 'http://twitter.com/', 1, 1, 1),
(33, 'Social', 'googleplus_link', 'https://plus.google.com', 1, 1, 1),
(35, 'Social', 'fliker_id', 'fliker.com', 1, 1, 1),
(41, 'Company', 'company_city', 'City', 1, 1, 0),
(42, 'Company', 'company_country', 'Country', 1, 1, 0),
(43, 'Company', 'company_postcode', '8365', 1, 1, 0),
(44, 'Company', 'company_url', 'http://www.oddyet.com', 1, 1, 0),
(48, 'Company', 'currency', 'USD', 1, 1, 0),
(46, 'System', 'version', '1.00', 1, 0, 0),
(49, 'Company', 'currency_symbol', '$', 1, 1, 1),
(60, 'Company', 'location_latitude', '53.5500', 1, 1, 1),
(61, 'Company', 'location_longitude', '2.4333', 1, 1, 1),
(62, 'Company', 'support_phone', '+00-000-00-0000', 1, 1, 1),
(63, 'Company', 'support_fax', '+00-000-00-0000', 1, 1, 1),
(64, 'Company', 'support_address', '54-2, company, support address', 1, 1, 1),
(55, 'Company', 'company_fax', '+00-000-00-0000', 1, 1, 1),
(56, 'Company', 'skype id', 'oddyet', 1, 1, 1),
(65, 'Email', 'support_email', 'support@oddyet.com', 1, 1, 1),
(66, 'Social', 'skype_link', 'oddyet', 1, 1, 1),
(67, 'Company', 'sales_phone', '+00-00-0000-0000', 1, 1, 1),
(68, 'Company', 'sales_fax', '+00-000-00-0000', 1, 1, 1),
(69, 'Company', 'sales_address', '54-2, company, salesaddress', 1, 1, 1),
(70, 'Company', 'sales_email', 'sales@oddyet.com', 1, 1, 1),
(77, 'Image', 'user_image_max_width', '1000', 1, 1, 1),
(78, 'Image', 'user_image_max_height', '500', 1, 1, 1),
(82, 'Image', 'blog_image_max_height', '500', 1, 1, 1),
(83, 'Email', 'company_support_email', 'support@oddyet.com', 1, 1, 1),
(84, 'Social', 'linkedin_link', 'https://www.linkedin.com/', 1, 1, 1),
(85, 'Social', 'pinterest_link', 'https://www.pinterest.com/', 1, 1, 1),
(86, 'Social', 'dribbble_link', 'https://dribbble.com/', 1, 1, 1),
(87, 'CMS', 'site_title', 'Maa Autos', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_config1`
--

CREATE TABLE IF NOT EXISTS `ma_config1` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `group` enum('Company','System','CMS','Email','Image','Social') NOT NULL,
  `option` varchar(120) NOT NULL,
  `value` text NOT NULL,
  `read` tinyint(5) NOT NULL,
  `write` tinyint(5) NOT NULL,
  `delete` tinyint(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `ma_config1`
--

INSERT INTO `ma_config1` (`ID`, `group`, `option`, `value`, `read`, `write`, `delete`) VALUES
(12, 'Company', 'company_name', 'Maa Autos', 1, 1, 0),
(21, 'CMS', 'meta_title', 'Maa Autos', 1, 1, 0),
(81, 'Image', 'blog_image_max_width', '500', 1, 1, 1),
(22, 'CMS', 'meta_keyword', 'Maa Autos', 1, 1, 0),
(80, 'Image', 'news_image_max_height', '350', 1, 1, 1),
(23, 'CMS', 'meta_description', 'Maa Autos', 1, 1, 0),
(75, 'Email', 'feedback_sender_email', 'info@oddyet.com', 1, 1, 1),
(76, 'Company', 'model_start_year', '1980', 1, 1, 1),
(79, 'Image', 'news_image_max_width', '500', 1, 1, 1),
(26, 'Company', 'company_address', '61-2 Shimogata Inazawa Aichi', 1, 1, 0),
(27, 'Company', 'company_phone', '+00-000-00-0000', 1, 1, 0),
(28, 'Company', 'company_mobile', '+81-50-5534-3477', 1, 1, 0),
(29, 'Email', 'company_email', 'info@oddyet.com', 1, 1, 0),
(30, 'Email', 'query_received_email', 'info@oddyet.com', 1, 1, 0),
(31, 'Social', 'facebook_link', 'https://www.facebook.com/oddyet', 1, 1, 1),
(32, 'Social', 'twitter_link', 'http://twitter.com/', 1, 1, 1),
(33, 'Social', 'googleplus_link', 'https://plus.google.com', 1, 1, 1),
(35, 'Image', 'fliker_id', 'fliker.com', 1, 1, 1),
(41, 'Company', 'company_city', 'Aichi', 1, 1, 0),
(42, 'Company', 'company_country', 'Japan', 1, 1, 0),
(43, 'Company', 'company_postcode', '492-8365', 1, 1, 0),
(44, 'Company', 'company_url', 'http://www.marugoautos.com', 1, 1, 0),
(48, 'Company', 'currency', 'USD', 1, 1, 0),
(46, 'System', 'version', '0.31', 1, 0, 0),
(49, 'Company', 'currency_symbol', '$', 1, 1, 1),
(60, 'Company', 'location_latitude', '35.2413811', 1, 1, 1),
(61, 'Company', 'location_longitude', '136.74332', 1, 1, 1),
(62, 'Company', 'support_phone', '+81-587-36-8008', 1, 1, 1),
(63, 'Company', 'support_fax', '+81-587-36-3948', 1, 1, 1),
(64, 'Company', 'support_address', '61-2 Shimogata Inazawa Aichi, Japan 492-8365', 1, 1, 1),
(55, 'Company', 'company_fax', '+81-587-36-3948', 1, 1, 1),
(56, 'Company', 'skype id', 'oddyet', 1, 1, 1),
(65, 'Email', 'support_email', 'support@oddyet.com', 1, 1, 1),
(66, 'Social', 'skype_link', 'oddyet', 1, 1, 1),
(67, 'Company', 'sales_phone', '+81-50-5534-3477', 1, 1, 1),
(68, 'Company', 'sales_fax', '+81-587-36-3948', 1, 1, 1),
(69, 'Company', 'sales_address', '61-2 Shimogata Inazawa Aichi, Japan 492-8365', 1, 1, 1),
(70, 'Company', 'sales_email', 'sales@oddyet.com', 1, 1, 1),
(77, 'Image', 'user_image_max_width', '500', 1, 1, 1),
(78, 'Image', 'user_image_max_height', '350', 1, 1, 1),
(82, 'Image', 'blog_image_max_height', '350', 1, 1, 1),
(83, 'Email', 'company_support_email', 'support@oddyet.com', 1, 1, 1),
(84, 'Social', 'linkedin_link', 'https://www.linkedin.com/', 1, 1, 1),
(85, 'Social', 'pinterest_link', 'https://www.pinterest.com/', 1, 1, 1),
(86, 'Company', 'dribbble_link', 'https://dribbble.com/', 1, 1, 1),
(87, 'CMS', 'site_title', 'MAA AUTOS', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_countries`
--

CREATE TABLE IF NOT EXISTS `ma_countries` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT '',
  `currencyCode` char(3) DEFAULT NULL,
  `population` varchar(20) DEFAULT NULL,
  `fipsCode` char(2) DEFAULT NULL,
  `isoNumeric` char(4) DEFAULT NULL,
  `north` varchar(30) DEFAULT NULL,
  `south` varchar(30) DEFAULT NULL,
  `east` varchar(30) DEFAULT NULL,
  `west` varchar(30) DEFAULT NULL,
  `capital` varchar(30) DEFAULT NULL,
  `continentName` varchar(15) DEFAULT NULL,
  `continent` char(2) DEFAULT NULL,
  `areaInSqKm` varchar(20) DEFAULT NULL,
  `languages` varchar(30) DEFAULT NULL,
  `isoAlpha3` char(3) DEFAULT NULL,
  `geonameId` int(10) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `ma_countries`
--

INSERT INTO `ma_countries` (`ID`, `countryCode`, `name`, `currencyCode`, `population`, `fipsCode`, `isoNumeric`, `north`, `south`, `east`, `west`, `capital`, `continentName`, `continent`, `areaInSqKm`, `languages`, `isoAlpha3`, `geonameId`, `phonecode`) VALUES
(1, 'AD', 'Andorra', 'EUR', '84000', 'AN', '020', '42.65604389629997', '42.42849259876837', '1.7865427778319827', '1.4071867141112762', 'Andorra la Vella', 'Europe', 'EU', '468.0', 'ca', 'AND', 3041565, 376),
(2, 'AE', 'United Arab Emirates', 'AED', '4975593', 'AE', '784', '26.08415985107422', '22.633329391479492', '56.38166046142578', '51.58332824707031', 'Abu Dhabi', 'Asia', 'AS', '82880.0', 'ar-AE,fa,en,hi,ur', 'ARE', 290557, 971),
(3, 'AF', 'Afghanistan', 'AFN', '29121286', 'AF', '004', '38.483418', '29.377472', '74.879448', '60.478443', 'Kabul', 'Asia', 'AS', '647500.0', 'fa-AF,ps,uz-AF,tk', 'AFG', 1149361, 93),
(4, 'AG', 'Antigua and Barbuda', 'XCD', '86754', 'AC', '028', '17.729387', '16.996979', '-61.672421', '-61.906425', 'St. John''s', 'North America', 'NA', '443.0', 'en-AG', 'ATG', 3576396, 1268),
(5, 'AI', 'Anguilla', 'XCD', '13254', 'AV', '660', '18.283424', '18.166815', '-62.971359', '-63.172901', 'The Valley', 'North America', 'NA', '102.0', 'en-AI', 'AIA', 3573511, 1264),
(6, 'AL', 'Albania', 'ALL', '2986952', 'AL', '008', '42.665611', '39.648361', '21.068472', '19.293972', 'Tirana', 'Europe', 'EU', '28748.0', 'sq,el', 'ALB', 783754, 355),
(7, 'AM', 'Armenia', 'AMD', '2968000', 'AM', '051', '41.301834', '38.830528', '46.772435045159995', '43.44978', 'Yerevan', 'Asia', 'AS', '29800.0', 'hy', 'ARM', 174982, 374),
(8, 'AO', 'Angola', 'AOA', '13068161', 'AO', '024', '-4.376826', '-18.042076', '24.082119', '11.679219', 'Luanda', 'Africa', 'AF', '1246700.0', 'pt-AO', 'AGO', 3351879, 244),
(9, 'AQ', 'Antarctica', '', '0', 'AY', '010', '-60.515533', '-89.9999', '179.9999', '-179.9999', '', 'Antarctica', 'AN', '1.4E7', '', 'ATA', 6697173, 0),
(10, 'AR', 'Argentina', 'ARS', '41343201', 'AR', '032', '-21.781277', '-55.061314', '-53.591835', '-73.58297', 'Buenos Aires', 'South America', 'SA', '2766890.0', 'es-AR,en,it,de,fr,gn', 'ARG', 3865483, 54),
(11, 'AS', 'American Samoa', 'USD', '57881', 'AQ', '016', '-11.0497', '-14.382478', '-169.416077', '-171.091888', 'Pago Pago', 'Oceania', 'OC', '199.0', 'en-AS,sm,to', 'ASM', 5880801, 1684),
(12, 'AT', 'Austria', 'EUR', '8205000', 'AU', '040', '49.017056', '46.378029', '17.162722', '9.535916', 'Vienna', 'Europe', 'EU', '83858.0', 'de-AT,hr,hu,sl', 'AUT', 2782113, 43),
(13, 'AU', 'Australia', 'AUD', '21515754', 'AS', '036', '-10.062805', '-43.64397', '153.639252', '112.911057', 'Canberra', 'Oceania', 'OC', '7686850.0', 'en-AU', 'AUS', 2077456, 61),
(14, 'AW', 'Aruba', 'AWG', '71566', 'AA', '533', '12.623718127152925', '12.411707706190716', '-69.86575120104982', '-70.0644737196045', 'Oranjestad', 'North America', 'NA', '193.0', 'nl-AW,es,en', 'ABW', 3577279, 297),
(15, 'AX', 'Åland', 'EUR', '26711', '', '248', '60.488861', '59.90675', '21.011862', '19.317694', 'Mariehamn', 'Europe', 'EU', '', 'sv-AX', 'ALA', 661882, 0),
(16, 'AZ', 'Azerbaijan', 'AZN', '8303512', 'AJ', '031', '41.90564', '38.38915252685547', '50.370083', '44.774113', 'Baku', 'Asia', 'AS', '86600.0', 'az,ru,hy', 'AZE', 587116, 994),
(17, 'BA', 'Bosnia and Herzegovina', 'BAM', '4590000', 'BK', '070', '45.239193', '42.546112', '19.622223', '15.718945', 'Sarajevo', 'Europe', 'EU', '51129.0', 'bs,hr-BA,sr-BA', 'BIH', 3277605, 387),
(18, 'BB', 'Barbados', 'BBD', '285653', 'BB', '052', '13.327257', '13.039844', '-59.420376', '-59.648922', 'Bridgetown', 'North America', 'NA', '431.0', 'en-BB', 'BRB', 3374084, 1246),
(19, 'BD', 'Bangladesh', 'BDT', '156118464', 'BG', '050', '26.631945', '20.743334', '92.673668', '88.028336', 'Dhaka', 'Asia', 'AS', '144000.0', 'bn-BD,en', 'BGD', 1210997, 880),
(20, 'BE', 'Belgium', 'EUR', '10403000', 'BE', '056', '51.505444', '49.49361', '6.403861', '2.546944', 'Brussels', 'Europe', 'EU', '30510.0', 'nl-BE,fr-BE,de-BE', 'BEL', 2802361, 32),
(21, 'BF', 'Burkina Faso', 'XOF', '16241811', 'UV', '854', '15.082593', '9.401108', '2.405395', '-5.518916', 'Ouagadougou', 'Africa', 'AF', '274200.0', 'fr-BF', 'BFA', 2361809, 226),
(22, 'BG', 'Bulgaria', 'BGN', '7148785', 'BU', '100', '44.21764', '41.242084', '28.612167', '22.371166', 'Sofia', 'Europe', 'EU', '110910.0', 'bg,tr-BG', 'BGR', 732800, 359),
(23, 'BH', 'Bahrain', 'BHD', '738004', 'BA', '048', '26.282583', '25.796862', '50.664471', '50.45414', 'Manama', 'Asia', 'AS', '665.0', 'ar-BH,en,fa,ur', 'BHR', 290291, 973),
(24, 'BI', 'Burundi', 'BIF', '9863117', 'BY', '108', '-2.310123', '-4.465713', '30.847729', '28.993061', 'Bujumbura', 'Africa', 'AF', '27830.0', 'fr-BI,rn', 'BDI', 433561, 257),
(25, 'BJ', 'Benin', 'XOF', '9056010', 'BN', '204', '12.418347', '6.225748', '3.851701', '0.774575', 'Porto-Novo', 'Africa', 'AF', '112620.0', 'fr-BJ', 'BEN', 2395170, 229),
(26, 'BL', 'Saint Barthélemy', 'EUR', '8450', 'TB', '652', '17.928808791949283', '17.878183227405575', '-62.788983372985854', '-62.8739118253784', 'Gustavia', 'North America', 'NA', '21.0', 'fr', 'BLM', 3578476, 0),
(27, 'BM', 'Bermuda', 'BMD', '65365', 'BD', '060', '32.393833', '32.246639', '-64.651993', '-64.89605', 'Hamilton', 'North America', 'NA', '53.0', 'en-BM,pt', 'BMU', 3573345, 1441),
(28, 'BN', 'Brunei', 'BND', '395027', 'BX', '096', '5.047167', '4.003083', '115.359444', '114.071442', 'Bandar Seri Begawan', 'Asia', 'AS', '5770.0', 'ms-BN,en-BN', 'BRN', 1820814, 0),
(29, 'BO', 'Bolivia', 'BOB', '9947418', 'BL', '068', '-9.680567', '-22.896133', '-57.45809600000001', '-69.640762', 'Sucre', 'South America', 'SA', '1098580.0', 'es-BO,qu,ay', 'BOL', 3923057, 591),
(30, 'BQ', 'Bonaire', 'USD', '18012', '', '535', '12.304535', '12.017149', '-68.192307', '-68.416458', '', 'North America', 'NA', '', 'nl,pap,en', 'BES', 7626844, 0),
(31, 'BR', 'Brazil', 'BRL', '201103330', 'BR', '076', '5.264877', '-33.750706', '-32.392998', '-73.985535', 'Brasília', 'South America', 'SA', '8511965.0', 'pt-BR,es,en,fr', 'BRA', 3469034, 55),
(32, 'BS', 'Bahamas', 'BSD', '301790', 'BF', '044', '26.919243', '22.852743', '-74.423874', '-78.995911', 'Nassau', 'North America', 'NA', '13940.0', 'en-BS', 'BHS', 3572887, 1242),
(33, 'BT', 'Bhutan', 'BTN', '699847', 'BT', '064', '28.323778', '26.70764', '92.125191', '88.75972', 'Thimphu', 'Asia', 'AS', '47000.0', 'dz', 'BTN', 1252634, 975),
(34, 'BV', 'Bouvet Island', 'NOK', '0', 'BV', '074', '-54.400322', '-54.462383', '3.487976', '3.335499', '', 'Antarctica', 'AN', '', '', 'BVT', 3371123, 0),
(35, 'BW', 'Botswana', 'BWP', '2029307', 'BC', '072', '-17.780813', '-26.907246', '29.360781', '19.999535', 'Gaborone', 'Africa', 'AF', '600370.0', 'en-BW,tn-BW', 'BWA', 933860, 267),
(36, 'BY', 'Belarus', 'BYR', '9685000', 'BO', '112', '56.165806', '51.256416', '32.770805', '23.176889', 'Minsk', 'Europe', 'EU', '207600.0', 'be,ru', 'BLR', 630336, 375),
(37, 'BZ', 'Belize', 'BZD', '314522', 'BH', '084', '18.496557', '15.8893', '-87.776985', '-89.224815', 'Belmopan', 'North America', 'NA', '22966.0', 'en-BZ,es', 'BLZ', 3582678, 501),
(38, 'CA', 'Canada', 'CAD', '33679000', 'CA', '124', '83.110626', '41.67598', '-52.636291', '-141', 'Ottawa', 'North America', 'NA', '9984670.0', 'en-CA,fr-CA,iu', 'CAN', 6251999, 1),
(39, 'CC', 'Cocos [Keeling] Islands', 'AUD', '628', 'CK', '166', '-12.072459094', '-12.208725839', '96.929489344', '96.816941408', 'West Island', 'Asia', 'AS', '14.0', 'ms-CC,en', 'CCK', 1547376, 0),
(40, 'CD', 'Democratic Republic of the Congo', 'CDF', '70916439', 'CG', '180', '5.386098', '-13.455675', '31.305912', '12.204144', 'Kinshasa', 'Africa', 'AF', '2345410.0', 'fr-CD,ln,kg', 'COD', 203312, 0),
(41, 'CF', 'Central African Republic', 'XAF', '4844927', 'CT', '140', '11.007569', '2.220514', '27.463421', '14.420097', 'Bangui', 'Africa', 'AF', '622984.0', 'fr-CF,sg,ln,kg', 'CAF', 239880, 236),
(42, 'CG', 'Republic of the Congo', 'XAF', '3039126', 'CF', '178', '3.703082', '-5.027223', '18.649839', '11.205009', 'Brazzaville', 'Africa', 'AF', '342000.0', 'fr-CG,kg,ln-CG', 'COG', 2260494, 0),
(43, 'CH', 'Switzerland', 'CHF', '7581000', 'SZ', '756', '47.805332', '45.825695', '10.491472', '5.957472', 'Berne', 'Europe', 'EU', '41290.0', 'de-CH,fr-CH,it-CH,rm', 'CHE', 2658434, 41),
(44, 'CI', 'Ivory Coast', 'XOF', '21058798', 'IV', '384', '10.736642', '4.357067', '-2.494897', '-8.599302', 'Yamoussoukro', 'Africa', 'AF', '322460.0', 'fr-CI', 'CIV', 2287781, 0),
(45, 'CK', 'Cook Islands', 'NZD', '21388', 'CW', '184', '-10.023114', '-21.944164', '-157.312134', '-161.093658', 'Avarua', 'Oceania', 'OC', '240.0', 'en-CK,mi', 'COK', 1899402, 682),
(46, 'CL', 'Chile', 'CLP', '16746491', 'CI', '152', '-17.507553', '-55.916348', '-66.417557', '-80.785851', 'Santiago', 'South America', 'SA', '756950.0', 'es-CL', 'CHL', 3895114, 56),
(47, 'CM', 'Cameroon', 'XAF', '19294149', 'CM', '120', '13.078056', '1.652548', '16.192116', '8.494763', 'Yaoundé', 'Africa', 'AF', '475440.0', 'en-CM,fr-CM', 'CMR', 2233387, 237),
(48, 'CN', 'China', 'CNY', '1330044000', 'CH', '156', '53.56086', '15.775416', '134.773911', '73.557693', 'Beijing', 'Asia', 'AS', '9596960.0', 'zh-CN,yue,wuu,dta,ug,za', 'CHN', 1814991, 86),
(49, 'CO', 'Colombia', 'COP', '44205293', 'CO', '170', '13.380502', '-4.225869', '-66.869835', '-81.728111', 'Bogotá', 'South America', 'SA', '1138910.0', 'es-CO', 'COL', 3686110, 57),
(50, 'CR', 'Costa Rica', 'CRC', '4516220', 'CS', '188', '11.216819', '8.032975', '-82.555992', '-85.950623', 'San José', 'North America', 'NA', '51100.0', 'es-CR,en', 'CRI', 3624060, 506),
(51, 'CU', 'Cuba', 'CUP', '11423000', 'CU', '192', '23.226042', '19.828083', '-74.131775', '-84.957428', 'Havana', 'North America', 'NA', '110860.0', 'es-CU', 'CUB', 3562981, 53),
(52, 'CV', 'Cape Verde', 'CVE', '508659', 'CV', '132', '17.197178', '14.808022', '-22.669443', '-25.358747', 'Praia', 'Africa', 'AF', '4033.0', 'pt-CV', 'CPV', 3374766, 238),
(53, 'CW', 'Curacao', 'ANG', '141766', 'UC', '531', '12.385672', '12.032745', '-68.733948', '-69.157204', 'Willemstad', 'North America', 'NA', '', 'nl,pap', 'CUW', 7626836, 0),
(54, 'CX', 'Christmas Island', 'AUD', '1500', 'KT', '162', '-10.412356007', '-10.5704829995', '105.712596992', '105.533276992', 'The Settlement', 'Asia', 'AS', '135.0', 'en,zh,ms-CC', 'CXR', 2078138, 61),
(55, 'CY', 'Cyprus', 'EUR', '1102677', 'CY', '196', '35.701527', '34.6332846722908', '34.59791599999994', '32.27308300000004', 'Nicosia', 'Europe', 'EU', '9250.0', 'el-CY,tr-CY,en', 'CYP', 146669, 357),
(56, 'CZ', 'Czechia', 'CZK', '10476000', 'EZ', '203', '51.058887', '48.542915', '18.860111', '12.096194', 'Prague', 'Europe', 'EU', '78866.0', 'cs,sk', 'CZE', 3077311, 0),
(57, 'DE', 'Germany', 'EUR', '81802257', 'GM', '276', '55.055637', '47.275776', '15.039889', '5.865639', 'Berlin', 'Europe', 'EU', '357021.0', 'de', 'DEU', 2921044, 49),
(58, 'DJ', 'Djibouti', 'DJF', '740528', 'DJ', '262', '12.706833', '10.909917', '43.416973', '41.773472', 'Djibouti', 'Africa', 'AF', '23000.0', 'fr-DJ,ar,so-DJ,aa', 'DJI', 223816, 253),
(59, 'DK', 'Denmark', 'DKK', '5484000', 'DA', '208', '57.748417', '54.562389', '15.158834', '8.075611', 'Copenhagen', 'Europe', 'EU', '43094.0', 'da-DK,en,fo,de-DK', 'DNK', 2623032, 45),
(60, 'DM', 'Dominica', 'XCD', '72813', 'DO', '212', '15.631809', '15.20169', '-61.244152', '-61.484108', 'Roseau', 'North America', 'NA', '754.0', 'en-DM', 'DMA', 3575830, 1767),
(61, 'DO', 'Dominican Republic', 'DOP', '9823821', 'DR', '214', '19.929859', '17.543159', '-68.32', '-72.003487', 'Santo Domingo', 'North America', 'NA', '48730.0', 'es-DO', 'DOM', 3508796, 1809),
(62, 'DZ', 'Algeria', 'DZD', '34586184', 'AG', '012', '37.093723', '18.960028', '11.979548', '-8.673868', 'Algiers', 'Africa', 'AF', '2381740.0', 'ar-DZ', 'DZA', 2589581, 213),
(63, 'EC', 'Ecuador', 'USD', '14790608', 'EC', '218', '1.43902', '-4.998823', '-75.184586', '-81.078598', 'Quito', 'South America', 'SA', '283560.0', 'es-EC', 'ECU', 3658394, 593),
(64, 'EE', 'Estonia', 'EUR', '1291170', 'EN', '233', '59.676224', '57.516193', '28.209972', '21.837584', 'Tallinn', 'Europe', 'EU', '45226.0', 'et,ru', 'EST', 453733, 372),
(65, 'EG', 'Egypt', 'EGP', '80471869', 'EG', '818', '31.667334', '21.725389', '35.794861', '24.698111', 'Cairo', 'Africa', 'AF', '1001450.0', 'ar-EG,en,fr', 'EGY', 357994, 20),
(66, 'EH', 'Western Sahara', 'MAD', '273008', 'WI', '732', '27.669674', '20.774158', '-8.670276', '-17.103182', 'El Aaiún', 'Africa', 'AF', '266000.0', 'ar,mey', 'ESH', 2461445, 212),
(67, 'ER', 'Eritrea', 'ERN', '5792984', 'ER', '232', '18.003084', '12.359555', '43.13464', '36.438778', 'Asmara', 'Africa', 'AF', '121320.0', 'aa-ER,ar,tig,kun,ti-ER', 'ERI', 338010, 291),
(68, 'ES', 'Spain', 'EUR', '46505963', 'SP', '724', '43.791721', '36.000332', '4.315389', '-9.290778', 'Madrid', 'Europe', 'EU', '504782.0', 'es-ES,ca,gl,eu,oc', 'ESP', 2510769, 34),
(69, 'ET', 'Ethiopia', 'ETB', '88013491', 'ET', '231', '14.89375', '3.402422', '47.986179', '32.999939', 'Addis Ababa', 'Africa', 'AF', '1127127.0', 'am,en-ET,om-ET,ti-ET,so-ET,sid', 'ETH', 337996, 251),
(70, 'FI', 'Finland', 'EUR', '5244000', 'FI', '246', '70.096054', '59.808777', '31.580944', '20.556944', 'Helsinki', 'Europe', 'EU', '337030.0', 'fi-FI,sv-FI,smn', 'FIN', 660013, 358),
(71, 'FJ', 'Fiji', 'FJD', '875983', 'FJ', '242', '-12.480111', '-20.67597', '-178.424438', '177.129334', 'Suva', 'Oceania', 'OC', '18270.0', 'en-FJ,fj', 'FJI', 2205218, 679),
(72, 'FK', 'Falkland Islands', 'FKP', '2638', 'FK', '238', '-51.24065', '-52.360512', '-57.712486', '-61.345192', 'Stanley', 'South America', 'SA', '12173.0', 'en-FK', 'FLK', 3474414, 0),
(73, 'FM', 'Micronesia', 'USD', '107708', 'FM', '583', '10.08904', '1.02629', '163.03717', '137.33648', 'Palikir', 'Oceania', 'OC', '702.0', 'en-FM,chk,pon,yap,kos,uli,woe,', 'FSM', 2081918, 0),
(74, 'FO', 'Faroe Islands', 'DKK', '48228', 'FO', '234', '62.400749', '61.394943', '-6.399583', '-7.458', 'Tórshavn', 'Europe', 'EU', '1399.0', 'fo,da-FO', 'FRO', 2622320, 298),
(75, 'FR', 'France', 'EUR', '64768389', 'FR', '250', '51.092804', '41.371582', '9.561556', '-5.142222', 'Paris', 'Europe', 'EU', '547030.0', 'fr-FR,frp,br,co,ca,eu,oc', 'FRA', 3017382, 33),
(76, 'GA', 'Gabon', 'XAF', '1545255', 'GB', '266', '2.322612', '-3.978806', '14.502347', '8.695471', 'Libreville', 'Africa', 'AF', '267667.0', 'fr-GA', 'GAB', 2400553, 241),
(77, 'GB', 'United Kingdom', 'GBP', '62348447', 'UK', '826', '59.360249', '49.906193', '1.759', '-8.623555', 'London', 'Europe', 'EU', '244820.0', 'en-GB,cy-GB,gd', 'GBR', 2635167, 44),
(78, 'GD', 'Grenada', 'XCD', '107818', 'GJ', '308', '12.318283928171299', '11.986893', '-61.57676970108031', '-61.802344', 'St. George''s', 'North America', 'NA', '344.0', 'en-GD', 'GRD', 3580239, 1473),
(79, 'GE', 'Georgia', 'GEL', '4630000', 'GG', '268', '43.586498', '41.053196', '46.725971', '40.010139', 'Tbilisi', 'Asia', 'AS', '69700.0', 'ka,ru,hy,az', 'GEO', 614540, 995),
(80, 'GF', 'French Guiana', 'EUR', '195506', 'FG', '254', '5.776496', '2.127094', '-51.613949', '-54.542511', 'Cayenne', 'South America', 'SA', '91000.0', 'fr-GF', 'GUF', 3381670, 594),
(81, 'GG', 'Guernsey', 'GBP', '65228', 'GK', '831', '49.731727816705416', '49.40764156876899', '-2.1577152112246267', '-2.673194593476069', 'St Peter Port', 'Europe', 'EU', '78.0', 'en,fr', 'GGY', 3042362, 0),
(82, 'GH', 'Ghana', 'GHS', '24339838', 'GH', '288', '11.173301', '4.736723', '1.191781', '-3.25542', 'Accra', 'Africa', 'AF', '239460.0', 'en-GH,ak,ee,tw', 'GHA', 2300660, 233),
(83, 'GI', 'Gibraltar', 'GIP', '27884', 'GI', '292', '36.155439135670726', '36.10903070140248', '-5.338285164001491', '-5.36626149743654', 'Gibraltar', 'Europe', 'EU', '6.5', 'en-GI,es,it,pt', 'GIB', 2411586, 350),
(84, 'GL', 'Greenland', 'DKK', '56375', 'GL', '304', '83.627357', '59.777401', '-11.312319', '-73.04203', 'Nuuk', 'North America', 'NA', '2166086.0', 'kl,da-GL,en', 'GRL', 3425505, 299),
(85, 'GM', 'Gambia', 'GMD', '1593256', 'GA', '270', '13.826571', '13.064252', '-13.797793', '-16.825079', 'Banjul', 'Africa', 'AF', '11300.0', 'en-GM,mnk,wof,wo,ff', 'GMB', 2413451, 220),
(86, 'GN', 'Guinea', 'GNF', '10324025', 'GV', '324', '12.67622', '7.193553', '-7.641071', '-14.926619', 'Conakry', 'Africa', 'AF', '245857.0', 'fr-GN', 'GIN', 2420477, 224),
(87, 'GP', 'Guadeloupe', 'EUR', '443000', 'GP', '312', '16.516848', '15.867565', '-61', '-61.544765', 'Basse-Terre', 'North America', 'NA', '1780.0', 'fr-GP', 'GLP', 3579143, 590),
(88, 'GQ', 'Equatorial Guinea', 'XAF', '1014999', 'EK', '226', '2.346989', '0.92086', '11.335724', '9.346865', 'Malabo', 'Africa', 'AF', '28051.0', 'es-GQ,fr', 'GNQ', 2309096, 240),
(89, 'GR', 'Greece', 'EUR', '11000000', 'GR', '300', '41.7484999849641', '34.8020663391466', '28.2470831714347', '19.3736035624134', 'Athens', 'Europe', 'EU', '131940.0', 'el-GR,en,fr', 'GRC', 390903, 30),
(90, 'GS', 'South Georgia and the South Sandwich Islands', 'GBP', '30', 'SX', '239', '-53.970467', '-59.479259', '-26.229326', '-38.021175', 'Grytviken', 'Antarctica', 'AN', '3903.0', 'en', 'SGS', 3474415, 0),
(91, 'GT', 'Guatemala', 'GTQ', '13550440', 'GT', '320', '17.81522', '13.737302', '-88.223198', '-92.23629', 'Guatemala City', 'North America', 'NA', '108890.0', 'es-GT', 'GTM', 3595528, 502),
(92, 'GU', 'Guam', 'USD', '159358', 'GQ', '316', '13.652333', '13.240611', '144.953979', '144.619247', 'Hagåtña', 'Oceania', 'OC', '549.0', 'en-GU,ch-GU', 'GUM', 4043988, 1671),
(93, 'GW', 'Guinea-Bissau', 'XOF', '1565126', 'PU', '624', '12.680789', '10.924265', '-13.636522', '-16.717535', 'Bissau', 'Africa', 'AF', '36120.0', 'pt-GW,pov', 'GNB', 2372248, 245),
(94, 'GY', 'Guyana', 'GYD', '748486', 'GY', '328', '8.557567', '1.17508', '-56.480251', '-61.384762', 'Georgetown', 'South America', 'SA', '214970.0', 'en-GY', 'GUY', 3378535, 592),
(95, 'HK', 'Hong Kong', 'HKD', '6898686', 'HK', '344', '22.559778', '22.15325', '114.434753', '113.837753', 'Hong Kong', 'Asia', 'AS', '1092.0', 'zh-HK,yue,zh,en', 'HKG', 1819730, 852),
(96, 'HM', 'Heard Island and McDonald Islands', 'AUD', '0', 'HM', '334', '-52.909416', '-53.192001', '73.859146', '72.596535', '', 'Antarctica', 'AN', '412.0', '', 'HMD', 1547314, 0),
(97, 'HN', 'Honduras', 'HNL', '7989415', 'HO', '340', '16.510256', '12.982411', '-83.155403', '-89.350792', 'Tegucigalpa', 'North America', 'NA', '112090.0', 'es-HN', 'HND', 3608932, 504),
(98, 'HR', 'Croatia', 'HRK', '4491000', 'HR', '191', '46.53875', '42.43589', '19.427389', '13.493222', 'Zagreb', 'Europe', 'EU', '56542.0', 'hr-HR,sr', 'HRV', 3202326, 385),
(99, 'HT', 'Haiti', 'HTG', '9648924', 'HA', '332', '20.08782', '18.021032', '-71.613358', '-74.478584', 'Port-au-Prince', 'North America', 'NA', '27750.0', 'ht,fr-HT', 'HTI', 3723988, 509),
(100, 'HU', 'Hungary', 'HUF', '9982000', 'HU', '348', '48.585667', '45.74361', '22.906', '16.111889', 'Budapest', 'Europe', 'EU', '93030.0', 'hu-HU', 'HUN', 719819, 36),
(101, 'ID', 'Indonesia', 'IDR', '242968342', 'ID', '360', '5.904417', '-10.941861', '141.021805', '95.009331', 'Jakarta', 'Asia', 'AS', '1919440.0', 'id,en,nl,jv', 'IDN', 1643084, 62),
(102, 'IE', 'Ireland', 'EUR', '4622917', 'EI', '372', '55.387917', '51.451584', '-6.002389', '-10.478556', 'Dublin', 'Europe', 'EU', '70280.0', 'en-IE,ga-IE', 'IRL', 2963597, 353),
(103, 'IL', 'Israel', 'ILS', '7353985', 'IS', '376', '33.340137', '29.496639', '35.876804', '34.270278754419145', '', 'Asia', 'AS', '20770.0', 'he,ar-IL,en-IL,', 'ISR', 294640, 972),
(104, 'IM', 'Isle of Man', 'GBP', '75049', 'IM', '833', '54.419724', '54.055916', '-4.3115', '-4.798722', 'Douglas', 'Europe', 'EU', '572.0', 'en,gv', 'IMN', 3042225, 0),
(105, 'IN', 'India', 'INR', '1173108018', 'IN', '356', '35.504223', '6.747139', '97.403305', '68.186691', 'New Delhi', 'Asia', 'AS', '3287590.0', 'en-IN,hi,bn,te,mr,ta,ur,gu,kn,', 'IND', 1269750, 91),
(106, 'IO', 'British Indian Ocean Territory', 'USD', '4000', 'IO', '086', '-5.268333', '-7.438028', '72.493164', '71.259972', '', 'Asia', 'AS', '60.0', 'en-IO', 'IOT', 1282588, 246),
(107, 'IQ', 'Iraq', 'IQD', '29671605', 'IZ', '368', '37.378029', '29.069445', '48.575916', '38.795887', 'Baghdad', 'Asia', 'AS', '437072.0', 'ar-IQ,ku,hy', 'IRQ', 99237, 964),
(108, 'IR', 'Iran', 'IRR', '76923300', 'IR', '364', '39.777222', '25.064083', '63.317471', '44.047279', 'Tehran', 'Asia', 'AS', '1648000.0', 'fa-IR,ku', 'IRN', 130758, 0),
(109, 'IS', 'Iceland', 'ISK', '308910', 'IC', '352', '66.53463', '63.393253', '-13.495815', '-24.546524', 'Reykjavik', 'Europe', 'EU', '103000.0', 'is,en,de,da,sv,no', 'ISL', 2629691, 354),
(110, 'IT', 'Italy', 'EUR', '60340328', 'IT', '380', '47.095196', '36.652779', '18.513445', '6.614889', 'Rome', 'Europe', 'EU', '301230.0', 'it-IT,de-IT,fr-IT,sc,ca,co,sl', 'ITA', 3175395, 39),
(111, 'JE', 'Jersey', 'GBP', '90812', 'JE', '832', '49.265057', '49.169834', '-2.022083', '-2.260028', 'Saint Helier', 'Europe', 'EU', '116.0', 'en,pt', 'JEY', 3042142, 0),
(112, 'JM', 'Jamaica', 'JMD', '2847232', 'JM', '388', '18.526976', '17.703554', '-76.180321', '-78.366638', 'Kingston', 'North America', 'NA', '10991.0', 'en-JM', 'JAM', 3489940, 1876),
(113, 'JO', 'Jordan', 'JOD', '6407085', 'JO', '400', '33.367668', '29.185888', '39.301167', '34.959999', 'Amman', 'Asia', 'AS', '92300.0', 'ar-JO,en', 'JOR', 248816, 962),
(114, 'JP', 'Japan', 'JPY', '127288000', 'JA', '392', '45.52314', '24.249472', '145.820892', '122.93853', 'Tokyo', 'Asia', 'AS', '377835.0', 'ja', 'JPN', 1861060, 81),
(115, 'KE', 'Kenya', 'KES', '40046566', 'KE', '404', '5.019938', '-4.678047', '41.899078', '33.908859', 'Nairobi', 'Africa', 'AF', '582650.0', 'en-KE,sw-KE', 'KEN', 192950, 254),
(116, 'KG', 'Kyrgyzstan', 'KGS', '5508626', 'KG', '417', '43.238224', '39.172832', '80.283165', '69.276611', 'Bishkek', 'Asia', 'AS', '198500.0', 'ky,uz,ru', 'KGZ', 1527747, 996),
(117, 'KH', 'Cambodia', 'KHR', '14453680', 'CB', '116', '14.686417', '10.409083', '107.627724', '102.339996', 'Phnom Penh', 'Asia', 'AS', '181040.0', 'km,fr,en', 'KHM', 1831722, 855),
(118, 'KI', 'Kiribati', 'AUD', '92533', 'KR', '296', '4.71957', '-11.437038', '-150.215347', '169.556137', 'Tarawa', 'Oceania', 'OC', '811.0', 'en-KI,gil', 'KIR', 4030945, 686),
(119, 'KM', 'Comoros', 'KMF', '773407', 'CN', '174', '-11.362381', '-12.387857', '44.538223', '43.21579', 'Moroni', 'Africa', 'AF', '2170.0', 'ar,fr-KM', 'COM', 921929, 269),
(120, 'KN', 'Saint Kitts and Nevis', 'XCD', '51134', 'SC', '659', '17.420118', '17.095343', '-62.543266', '-62.86956', 'Basseterre', 'North America', 'NA', '261.0', 'en-KN', 'KNA', 3575174, 1869),
(121, 'KP', 'North Korea', 'KPW', '22912177', 'KN', '408', '43.006054', '37.673332', '130.674866', '124.315887', 'Pyongyang', 'Asia', 'AS', '120540.0', 'ko-KP', 'PRK', 1873107, 0),
(122, 'KR', 'South Korea', 'KRW', '48422644', 'KS', '410', '38.612446', '33.190945', '129.584671', '125.887108', 'Seoul', 'Asia', 'AS', '98480.0', 'ko-KR,en', 'KOR', 1835841, 0),
(123, 'KW', 'Kuwait', 'KWD', '2789132', 'KU', '414', '30.095945', '28.524611', '48.431473', '46.555557', 'Kuwait City', 'Asia', 'AS', '17820.0', 'ar-KW,en', 'KWT', 285570, 965),
(124, 'KY', 'Cayman Islands', 'KYD', '44270', 'CJ', '136', '19.7617', '19.263029', '-79.727272', '-81.432777', 'George Town', 'North America', 'NA', '262.0', 'en-KY', 'CYM', 3580718, 1345),
(125, 'KZ', 'Kazakhstan', 'KZT', '15340000', 'KZ', '398', '55.451195', '40.936333', '87.312668', '46.491859', 'Astana', 'Asia', 'AS', '2717300.0', 'kk,ru', 'KAZ', 1522867, 7),
(126, 'LA', 'Laos', 'LAK', '6368162', 'LA', '418', '22.500389', '13.910027', '107.697029', '100.093056', 'Vientiane', 'Asia', 'AS', '236800.0', 'lo,fr,en', 'LAO', 1655842, 0),
(127, 'LB', 'Lebanon', 'LBP', '4125247', 'LE', '422', '34.691418', '33.05386', '36.639194', '35.114277', 'Beirut', 'Asia', 'AS', '10400.0', 'ar-LB,fr-LB,en,hy', 'LBN', 272103, 961),
(128, 'LC', 'Saint Lucia', 'XCD', '160922', 'ST', '662', '14.103245', '13.704778', '-60.874203', '-61.07415', 'Castries', 'North America', 'NA', '616.0', 'en-LC', 'LCA', 3576468, 1758),
(129, 'LI', 'Liechtenstein', 'CHF', '35000', 'LS', '438', '47.273529', '47.055862', '9.632195', '9.477805', 'Vaduz', 'Europe', 'EU', '160.0', 'de-LI', 'LIE', 3042058, 423),
(130, 'LK', 'Sri Lanka', 'LKR', '21513990', 'CE', '144', '9.831361', '5.916833', '81.881279', '79.652916', 'Colombo', 'Asia', 'AS', '65610.0', 'si,ta,en', 'LKA', 1227603, 94),
(131, 'LR', 'Liberia', 'LRD', '3685076', 'LI', '430', '8.551791', '4.353057', '-7.365113', '-11.492083', 'Monrovia', 'Africa', 'AF', '111370.0', 'en-LR', 'LBR', 2275384, 231),
(132, 'LS', 'Lesotho', 'LSL', '1919552', 'LT', '426', '-28.572058', '-30.668964', '29.465761', '27.029068', 'Maseru', 'Africa', 'AF', '30355.0', 'en-LS,st,zu,xh', 'LSO', 932692, 266),
(133, 'LT', 'Lithuania', 'LTL', '3565000', 'LH', '440', '56.446918', '53.901306', '26.871944', '20.941528', 'Vilnius', 'Europe', 'EU', '65200.0', 'lt,ru,pl', 'LTU', 597427, 370),
(134, 'LU', 'Luxembourg', 'EUR', '497538', 'LU', '442', '50.184944', '49.446583', '6.528472', '5.734556', 'Luxembourg', 'Europe', 'EU', '2586.0', 'lb,de-LU,fr-LU', 'LUX', 2960313, 352),
(135, 'LV', 'Latvia', 'EUR', '2217969', 'LG', '428', '58.082306', '55.668861', '28.241167', '20.974277', 'Riga', 'Europe', 'EU', '64589.0', 'lv,ru,lt', 'LVA', 458258, 371),
(136, 'LY', 'Libya', 'LYD', '6461454', 'LY', '434', '33.168999', '19.508045', '25.150612', '9.38702', 'Tripoli', 'Africa', 'AF', '1759540.0', 'ar-LY,it,en', 'LBY', 2215636, 0),
(137, 'MA', 'Morocco', 'MAD', '31627428', 'MO', '504', '35.9224966985384', '27.662115', '-0.991750000000025', '-13.168586', 'Rabat', 'Africa', 'AF', '446550.0', 'ar-MA,fr', 'MAR', 2542007, 212),
(138, 'MC', 'Monaco', 'EUR', '32965', 'MN', '492', '43.75196717037228', '43.72472839869377', '7.439939260482788', '7.408962249755859', 'Monaco', 'Europe', 'EU', '1.95', 'fr-MC,en,it', 'MCO', 2993457, 377),
(139, 'MD', 'Moldova', 'MDL', '4324000', 'MD', '498', '48.490166', '45.468887', '30.135445', '26.618944', 'Chişinău', 'Europe', 'EU', '33843.0', 'ro,ru,gag,tr', 'MDA', 617790, 0),
(140, 'ME', 'Montenegro', 'EUR', '666730', 'MJ', '499', '43.570137', '41.850166', '20.358833', '18.461306', 'Podgorica', 'Europe', 'EU', '14026.0', 'sr,hu,bs,sq,hr,rom', 'MNE', 3194884, 0),
(141, 'MF', 'Saint Martin', 'EUR', '35925', 'RN', '663', '18.130354', '18.052231', '-63.012993', '-63.152767', 'Marigot', 'North America', 'NA', '53.0', 'fr', 'MAF', 3578421, 0),
(142, 'MG', 'Madagascar', 'MGA', '21281844', 'MA', '450', '-11.945433', '-25.608952', '50.48378', '43.224876', 'Antananarivo', 'Africa', 'AF', '587040.0', 'fr-MG,mg', 'MDG', 1062947, 261),
(143, 'MH', 'Marshall Islands', 'USD', '65859', 'RM', '584', '14.62', '5.587639', '171.931808', '165.524918', 'Majuro', 'Oceania', 'OC', '181.3', 'mh,en-MH', 'MHL', 2080185, 692),
(144, 'MK', 'Macedonia', 'MKD', '2062294', 'MK', '807', '42.361805', '40.860195', '23.038139', '20.464695', 'Skopje', 'Europe', 'EU', '25333.0', 'mk,sq,tr,rmm,sr', 'MKD', 718075, 0),
(145, 'ML', 'Mali', 'XOF', '13796354', 'ML', '466', '25.000002', '10.159513', '4.244968', '-12.242614', 'Bamako', 'Africa', 'AF', '1240000.0', 'fr-ML,bm', 'MLI', 2453866, 223),
(146, 'MM', 'Myanmar [Burma]', 'MMK', '53414374', 'BM', '104', '28.543249', '9.784583', '101.176781', '92.189278', 'Nay Pyi Taw', 'Asia', 'AS', '678500.0', 'my', 'MMR', 1327865, 0),
(147, 'MN', 'Mongolia', 'MNT', '3086918', 'MG', '496', '52.154251', '41.567638', '119.924309', '87.749664', 'Ulan Bator', 'Asia', 'AS', '1565000.0', 'mn,ru', 'MNG', 2029969, 976),
(148, 'MO', 'Macao', 'MOP', '449198', 'MC', '446', '22.222334', '22.180389', '113.565834', '113.528946', 'Macao', 'Asia', 'AS', '254.0', 'zh,zh-MO,pt', 'MAC', 1821275, 853),
(149, 'MP', 'Northern Mariana Islands', 'USD', '53883', 'CQ', '580', '20.55344', '14.11023', '146.06528', '144.88626', 'Saipan', 'Oceania', 'OC', '477.0', 'fil,tl,zh,ch-MP,en-MP', 'MNP', 4041468, 1670),
(150, 'MQ', 'Martinique', 'EUR', '432900', 'MB', '474', '14.878819', '14.392262', '-60.81551', '-61.230118', 'Fort-de-France', 'North America', 'NA', '1100.0', 'fr-MQ', 'MTQ', 3570311, 596),
(151, 'MR', 'Mauritania', 'MRO', '3205060', 'MR', '478', '27.298073', '14.715547', '-4.827674', '-17.066521', 'Nouakchott', 'Africa', 'AF', '1030700.0', 'ar-MR,fuc,snk,fr,mey,wo', 'MRT', 2378080, 222),
(152, 'MS', 'Montserrat', 'XCD', '9341', 'MH', '500', '16.824060205313184', '16.674768935441556', '-62.144100129608205', '-62.24138237036129', 'Plymouth', 'North America', 'NA', '102.0', 'en-MS', 'MSR', 3578097, 1664),
(153, 'MT', 'Malta', 'EUR', '403000', 'MT', '470', '36.079112527087844', '35.810276', '14.577639', '14.184376415657312', 'Valletta', 'Europe', 'EU', '316.0', 'mt,en-MT', 'MLT', 2562770, 356),
(154, 'MU', 'Mauritius', 'MUR', '1294104', 'MP', '480', '-10.319255', '-20.525717', '63.500179', '56.512718', 'Port Louis', 'Africa', 'AF', '2040.0', 'en-MU,bho,fr', 'MUS', 934292, 230),
(155, 'MV', 'Maldives', 'MVR', '395650', 'MV', '462', '7.091587495414767', '-0.692694', '73.637276', '72.693222', 'Malé', 'Asia', 'AS', '300.0', 'dv,en', 'MDV', 1282028, 960),
(156, 'MW', 'Malawi', 'MWK', '15447500', 'MI', '454', '-9.367541', '-17.125', '35.916821', '32.67395', 'Lilongwe', 'Africa', 'AF', '118480.0', 'ny,yao,tum,swk', 'MWI', 927384, 265),
(157, 'MX', 'Mexico', 'MXN', '112468855', 'MX', '484', '32.716759', '14.532866', '-86.703392', '-118.453949', 'Mexico City', 'North America', 'NA', '1972550.0', 'es-MX', 'MEX', 3996063, 52),
(158, 'MY', 'Malaysia', 'MYR', '28274729', 'MY', '458', '7.363417', '0.855222', '119.267502', '99.643448', 'Kuala Lumpur', 'Asia', 'AS', '329750.0', 'ms-MY,en,zh,ta,te,ml,pa,th', 'MYS', 1733045, 60),
(159, 'MZ', 'Mozambique', 'MZN', '22061451', 'MZ', '508', '-10.471883', '-26.868685', '40.842995', '30.217319', 'Maputo', 'Africa', 'AF', '801590.0', 'pt-MZ,vmw', 'MOZ', 1036973, 258),
(160, 'NA', 'Namibia', 'NAD', '2128471', 'WA', '516', '-16.959894', '-28.97143', '25.256701', '11.71563', 'Windhoek', 'Africa', 'AF', '825418.0', 'en-NA,af,de,hz,naq', 'NAM', 3355338, 264),
(161, 'NC', 'New Caledonia', 'XPF', '216494', 'NC', '540', '-19.549778', '-22.698', '168.129135', '163.564667', 'Noumea', 'Oceania', 'OC', '19060.0', 'fr-NC', 'NCL', 2139685, 687),
(162, 'NE', 'Niger', 'XOF', '15878271', 'NG', '562', '23.525026', '11.696975', '15.995643', '0.16625', 'Niamey', 'Africa', 'AF', '1267000.0', 'fr-NE,ha,kr,dje', 'NER', 2440476, 227),
(163, 'NF', 'Norfolk Island', 'AUD', '1828', 'NF', '574', '-28.995170686948427', '-29.063076742954735', '167.99773740209957', '167.91543230151365', 'Kingston', 'Oceania', 'OC', '34.6', 'en-NF', 'NFK', 2155115, 672),
(164, 'NG', 'Nigeria', 'NGN', '154000000', 'NI', '566', '13.892007', '4.277144', '14.680073', '2.668432', 'Abuja', 'Africa', 'AF', '923768.0', 'en-NG,ha,yo,ig,ff', 'NGA', 2328926, 234),
(165, 'NI', 'Nicaragua', 'NIO', '5995928', 'NU', '558', '15.025909', '10.707543', '-82.738289', '-87.690308', 'Managua', 'North America', 'NA', '129494.0', 'es-NI,en', 'NIC', 3617476, 505),
(166, 'NL', 'Netherlands', 'EUR', '16645000', 'NL', '528', '53.512196', '50.753918', '7.227944', '3.362556', 'Amsterdam', 'Europe', 'EU', '41526.0', 'nl-NL,fy-NL', 'NLD', 2750405, 31),
(167, 'NO', 'Norway', 'NOK', '5009150', 'NO', '578', '71.18811', '57.977917', '31.078052520751953', '4.650167', 'Oslo', 'Europe', 'EU', '324220.0', 'no,nb,nn,se,fi', 'NOR', 3144096, 47),
(168, 'NP', 'Nepal', 'NPR', '28951852', 'NP', '524', '30.43339', '26.356722', '88.199333', '80.056274', 'Kathmandu', 'Asia', 'AS', '140800.0', 'ne,en', 'NPL', 1282988, 977),
(169, 'NR', 'Nauru', 'AUD', '10065', 'NR', '520', '-0.504306', '-0.552333', '166.945282', '166.899033', '', 'Oceania', 'OC', '21.0', 'na,en-NR', 'NRU', 2110425, 674),
(170, 'NU', 'Niue', 'NZD', '2166', 'NE', '570', '-18.951069', '-19.152193', '-169.775177', '-169.951004', 'Alofi', 'Oceania', 'OC', '260.0', 'niu,en-NU', 'NIU', 4036232, 683),
(171, 'NZ', 'New Zealand', 'NZD', '4252277', 'NZ', '554', '-34.389668', '-47.286026', '-180', '166.7155', 'Wellington', 'Oceania', 'OC', '268680.0', 'en-NZ,mi', 'NZL', 2186224, 64),
(172, 'OM', 'Oman', 'OMR', '2967717', 'MU', '512', '26.387972', '16.64575', '59.836582', '51.882', 'Muscat', 'Asia', 'AS', '212460.0', 'ar-OM,en,bal,ur', 'OMN', 286963, 968),
(173, 'PA', 'Panama', 'PAB', '3410676', 'PM', '591', '9.637514', '7.197906', '-77.17411', '-83.051445', 'Panama City', 'North America', 'NA', '78200.0', 'es-PA,en', 'PAN', 3703430, 507),
(174, 'PE', 'Peru', 'PEN', '29907003', 'PE', '604', '-0.012977', '-18.349728', '-68.677986', '-81.326744', 'Lima', 'South America', 'SA', '1285220.0', 'es-PE,qu,ay', 'PER', 3932488, 51),
(175, 'PF', 'French Polynesia', 'XPF', '270485', 'FP', '258', '-7.903573', '-27.653572', '-134.929825', '-152.877167', 'Papeete', 'Oceania', 'OC', '4167.0', 'fr-PF,ty', 'PYF', 4030656, 689),
(176, 'PG', 'Papua New Guinea', 'PGK', '6064515', 'PP', '598', '-1.318639', '-11.657861', '155.96344', '140.842865', 'Port Moresby', 'Oceania', 'OC', '462840.0', 'en-PG,ho,meu,tpi', 'PNG', 2088628, 675),
(177, 'PH', 'Philippines', 'PHP', '99900177', 'RP', '608', '21.120611', '4.643306', '126.601524', '116.931557', 'Manila', 'Asia', 'AS', '300000.0', 'tl,en-PH,fil', 'PHL', 1694008, 63),
(178, 'PK', 'Pakistan', 'PKR', '184404791', 'PK', '586', '37.097', '23.786722', '77.840919', '60.878613', 'Islamabad', 'Asia', 'AS', '803940.0', 'ur-PK,en-PK,pa,sd,ps,brh', 'PAK', 1168579, 92),
(179, 'PL', 'Poland', 'PLN', '38500000', 'PL', '616', '54.839138', '49.006363', '24.150749', '14.123', 'Warsaw', 'Europe', 'EU', '312685.0', 'pl', 'POL', 798544, 48),
(180, 'PM', 'Saint Pierre and Miquelon', 'EUR', '7012', 'SB', '666', '47.146286', '46.786041', '-56.252991', '-56.420658', 'Saint-Pierre', 'North America', 'NA', '242.0', 'fr-PM', 'SPM', 3424932, 508),
(181, 'PN', 'Pitcairn Islands', 'NZD', '46', 'PC', '612', '-24.315865', '-24.672565', '-124.77285', '-128.346436', 'Adamstown', 'Oceania', 'OC', '47.0', 'en-PN', 'PCN', 4030699, 0),
(182, 'PR', 'Puerto Rico', 'USD', '3916632', 'RQ', '630', '18.520166', '17.926405', '-65.242737', '-67.942726', 'San Juan', 'North America', 'NA', '9104.0', 'en-PR,es-PR', 'PRI', 4566966, 1787),
(183, 'PS', 'Palestine', 'ILS', '3800000', 'WE', '275', '32.54638671875', '31.216541290283203', '35.5732955932617', '34.21665954589844', '', 'Asia', 'AS', '5970.0', 'ar-PS', 'PSE', 6254930, 0),
(184, 'PT', 'Portugal', 'EUR', '10676000', 'PO', '620', '42.145638', '36.96125', '-6.182694', '-9.495944', 'Lisbon', 'Europe', 'EU', '92391.0', 'pt-PT,mwl', 'PRT', 2264397, 351),
(185, 'PW', 'Palau', 'USD', '19907', 'PS', '585', '8.46966', '2.8036', '134.72307', '131.11788', 'Melekeok - Palau State Capital', 'Oceania', 'OC', '458.0', 'pau,sov,en-PW,tox,ja,fil,zh', 'PLW', 1559582, 680),
(186, 'PY', 'Paraguay', 'PYG', '6375830', 'PA', '600', '-19.294041', '-27.608738', '-54.259354', '-62.647076', 'Asunción', 'South America', 'SA', '406750.0', 'es-PY,gn', 'PRY', 3437598, 595),
(187, 'QA', 'Qatar', 'QAR', '840926', 'QA', '634', '26.154722', '24.482944', '51.636639', '50.757221', 'Doha', 'Asia', 'AS', '11437.0', 'ar-QA,es', 'QAT', 289688, 974),
(188, 'RE', 'Réunion', 'EUR', '776948', 'RE', '638', '-20.868391324576944', '-21.383747301469107', '55.838193901930026', '55.21219224792685', 'Saint-Denis', 'Africa', 'AF', '2517.0', 'fr-RE', 'REU', 935317, 262),
(189, 'RO', 'Romania', 'RON', '21959278', 'RO', '642', '48.266945', '43.627304', '29.691055', '20.269972', 'Bucharest', 'Europe', 'EU', '237500.0', 'ro,hu,rom', 'ROU', 798549, 40),
(190, 'RS', 'Serbia', 'RSD', '7344847', 'RI', '688', '46.18138885498047', '42.232215881347656', '23.00499725341797', '18.817020416259766', 'Belgrade', 'Europe', 'EU', '88361.0', 'sr,hu,bs,rom', 'SRB', 6290252, 0),
(191, 'RU', 'Russia', 'RUB', '140702000', 'RS', '643', '81.857361', '41.188862', '-169.05', '19.25', 'Moscow', 'Europe', 'EU', '1.71E7', 'ru,tt,xal,cau,ady,kv,ce,tyv,cv', 'RUS', 2017370, 0),
(192, 'RW', 'Rwanda', 'RWF', '11055976', 'RW', '646', '-1.053481', '-2.840679', '30.895958', '28.856794', 'Kigali', 'Africa', 'AF', '26338.0', 'rw,en-RW,fr-RW,sw', 'RWA', 49518, 250),
(193, 'SA', 'Saudi Arabia', 'SAR', '25731776', 'SA', '682', '32.158333', '15.61425', '55.666584', '34.495693', 'Riyadh', 'Asia', 'AS', '1960582.0', 'ar-SA', 'SAU', 102358, 966),
(194, 'SB', 'Solomon Islands', 'SBD', '559198', 'BP', '090', '-6.589611', '-11.850555', '166.980865', '155.508606', 'Honiara', 'Oceania', 'OC', '28450.0', 'en-SB,tpi', 'SLB', 2103350, 677),
(195, 'SC', 'Seychelles', 'SCR', '88340', 'SE', '690', '-4.283717', '-9.753867', '56.279507', '46.204769', 'Victoria', 'Africa', 'AF', '455.0', 'en-SC,fr-SC', 'SYC', 241170, 248),
(196, 'SD', 'Sudan', 'SDG', '35000000', 'SU', '729', '22.232219696044922', '8.684720993041992', '38.60749816894531', '21.827774047851562', 'Khartoum', 'Africa', 'AF', '1861484.0', 'ar-SD,en,fia', 'SDN', 366755, 249),
(197, 'SE', 'Sweden', 'SEK', '9555893', 'SW', '752', '69.0625', '55.337112', '24.156292483918484', '11.118694', 'Stockholm', 'Europe', 'EU', '449964.0', 'sv-SE,se,sma,fi-SE', 'SWE', 2661886, 46),
(198, 'SG', 'Singapore', 'SGD', '4701069', 'SN', '702', '1.471278', '1.258556', '104.007469', '103.638275', 'Singapore', 'Asia', 'AS', '692.7', 'cmn,en-SG,ms-SG,ta-SG,zh-SG', 'SGP', 1880251, 65),
(199, 'SH', 'Saint Helena', 'SHP', '7460', 'SH', '654', '-7.887815', '-16.019543', '-5.638753', '-14.42123', 'Jamestown', 'Africa', 'AF', '410.0', 'en-SH', 'SHN', 3370751, 290),
(200, 'SI', 'Slovenia', 'EUR', '2007000', 'SI', '705', '46.8766275518195', '45.421812998164', '16.6106311807', '13.3753342064709', 'Ljubljana', 'Europe', 'EU', '20273.0', 'sl,sh', 'SVN', 3190538, 386),
(201, 'SJ', 'Svalbard and Jan Mayen', 'NOK', '2550', 'SV', '744', '80.762085', '79.220306', '33.287334', '17.699389', 'Longyearbyen', 'Europe', 'EU', '62049.0', 'no,ru', 'SJM', 607072, 47),
(202, 'SK', 'Slovakia', 'EUR', '5455000', 'LO', '703', '49.603168', '47.728111', '22.570444', '16.84775', 'Bratislava', 'Europe', 'EU', '48845.0', 'sk,hu', 'SVK', 3057568, 421),
(203, 'SL', 'Sierra Leone', 'SLL', '5245695', 'SL', '694', '10', '6.929611', '-10.284238', '-13.307631', 'Freetown', 'Africa', 'AF', '71740.0', 'en-SL,men,tem', 'SLE', 2403846, 232),
(204, 'SM', 'San Marino', 'EUR', '31477', 'SM', '674', '43.99223730851663', '43.8937092171425', '12.51653186779788', '12.403538978820734', 'San Marino', 'Europe', 'EU', '61.2', 'it-SM', 'SMR', 3168068, 378),
(205, 'SN', 'Senegal', 'XOF', '12323252', 'SG', '686', '16.691633', '12.307275', '-11.355887', '-17.535236', 'Dakar', 'Africa', 'AF', '196190.0', 'fr-SN,wo,fuc,mnk', 'SEN', 2245662, 221),
(206, 'SO', 'Somalia', 'SOS', '10112453', 'SO', '706', '11.979166', '-1.674868', '51.412636', '40.986595', 'Mogadishu', 'Africa', 'AF', '637657.0', 'so-SO,ar-SO,it,en-SO', 'SOM', 51537, 252),
(207, 'SR', 'Suriname', 'SRD', '492829', 'NS', '740', '6.004546', '1.831145', '-53.977493', '-58.086563', 'Paramaribo', 'South America', 'SA', '163270.0', 'nl-SR,en,srn,hns,jv', 'SUR', 3382998, 597),
(208, 'SS', 'South Sudan', 'SSP', '8260490', 'OD', '728', '12.219148635864258', '3.493394374847412', '35.9405517578125', '24.140274047851562', 'Juba', 'Africa', 'AF', '644329.0', 'en', 'SSD', 7909807, 0),
(209, 'ST', 'São Tomé and Príncipe', 'STD', '175808', 'TP', '678', '1.701323', '0.024766', '7.466374', '6.47017', 'São Tomé', 'Africa', 'AF', '1001.0', 'pt-ST', 'STP', 2410758, 239),
(210, 'SV', 'El Salvador', 'USD', '6052064', 'ES', '222', '14.445067', '13.148679', '-87.692162', '-90.128662', 'San Salvador', 'North America', 'NA', '21040.0', 'es-SV', 'SLV', 3585968, 503),
(211, 'SX', 'Sint Maarten', 'ANG', '37429', 'NN', '534', '18.070248', '18.011692', '-63.012993', '-63.144039', 'Philipsburg', 'North America', 'NA', '', 'nl,en', 'SXM', 7609695, 0),
(212, 'SY', 'Syria', 'SYP', '22198110', 'SY', '760', '37.319138', '32.310665', '42.385029', '35.727222', 'Damascus', 'Asia', 'AS', '185180.0', 'ar-SY,ku,hy,arc,fr,en', 'SYR', 163843, 0),
(213, 'SZ', 'Swaziland', 'SZL', '1354051', 'WZ', '748', '-25.719648', '-27.317101', '32.13726', '30.794107', 'Mbabane', 'Africa', 'AF', '17363.0', 'en-SZ,ss-SZ', 'SWZ', 934841, 268),
(214, 'TC', 'Turks and Caicos Islands', 'USD', '20556', 'TK', '796', '21.961878', '21.422626', '-71.123642', '-72.483871', 'Cockburn Town', 'North America', 'NA', '430.0', 'en-TC', 'TCA', 3576916, 1649),
(215, 'TD', 'Chad', 'XAF', '10543464', 'CD', '148', '23.450369', '7.441068', '24.002661', '13.473475', 'N''Djamena', 'Africa', 'AF', '1284000.0', 'fr-TD,ar-TD,sre', 'TCD', 2434508, 235),
(216, 'TF', 'French Southern Territories', 'EUR', '140', 'FS', '260', '-37.790722', '-49.735184', '77.598808', '50.170258', 'Port-aux-Français', 'Antarctica', 'AN', '7829.0', 'fr', 'ATF', 1546748, 0),
(217, 'TG', 'Togo', 'XOF', '6587239', 'TO', '768', '11.138977', '6.104417', '1.806693', '-0.147324', 'Lomé', 'Africa', 'AF', '56785.0', 'fr-TG,ee,hna,kbp,dag,ha', 'TGO', 2363686, 228),
(218, 'TH', 'Thailand', 'THB', '67089500', 'TH', '764', '20.463194', '5.61', '105.639389', '97.345642', 'Bangkok', 'Asia', 'AS', '514000.0', 'th,en', 'THA', 1605651, 66),
(219, 'TJ', 'Tajikistan', 'TJS', '7487489', 'TI', '762', '41.042252', '36.674137', '75.137222', '67.387138', 'Dushanbe', 'Asia', 'AS', '143100.0', 'tg,ru', 'TJK', 1220409, 992),
(220, 'TK', 'Tokelau', 'NZD', '1466', 'TL', '772', '-8.553613662719727', '-9.381111145019531', '-171.21142578125', '-172.50033569335938', '', 'Oceania', 'OC', '10.0', 'tkl,en-TK', 'TKL', 4031074, 690),
(221, 'TL', 'East Timor', 'USD', '1154625', 'TT', '626', '-8.135833740234375', '-9.463626861572266', '127.30859375', '124.04609680175781', 'Dili', 'Oceania', 'OC', '15007.0', 'tet,pt-TL,id,en', 'TLS', 1966436, 0),
(222, 'TM', 'Turkmenistan', 'TMT', '4940916', 'TX', '795', '42.795555', '35.141083', '66.684303', '52.441444', 'Ashgabat', 'Asia', 'AS', '488100.0', 'tk,ru,uz', 'TKM', 1218197, 7370),
(223, 'TN', 'Tunisia', 'TND', '10589025', 'TS', '788', '37.543915', '30.240417', '11.598278', '7.524833', 'Tunis', 'Africa', 'AF', '163610.0', 'ar-TN,fr', 'TUN', 2464461, 216),
(224, 'TO', 'Tonga', 'TOP', '122580', 'TN', '776', '-15.562988', '-21.455057', '-173.907578', '-175.682266', 'Nuku''alofa', 'Oceania', 'OC', '748.0', 'to,en-TO', 'TON', 4032283, 676),
(225, 'TR', 'Turkey', 'TRY', '77804122', 'TU', '792', '42.107613', '35.815418', '44.834999', '25.668501', 'Ankara', 'Asia', 'AS', '780580.0', 'tr-TR,ku,diq,az,av', 'TUR', 298795, 90),
(226, 'TT', 'Trinidad and Tobago', 'TTD', '1228691', 'TD', '780', '11.338342', '10.036105', '-60.517933', '-61.923771', 'Port of Spain', 'North America', 'NA', '5128.0', 'en-TT,hns,fr,es,zh', 'TTO', 3573591, 1868),
(227, 'TV', 'Tuvalu', 'AUD', '10472', 'TV', '798', '-5.641972', '-10.801169', '179.863281', '176.064865', 'Funafuti', 'Oceania', 'OC', '26.0', 'tvl,en,sm,gil', 'TUV', 2110297, 688),
(228, 'TW', 'Taiwan', 'TWD', '22894384', 'TW', '158', '25.29825', '21.901806', '122.000443', '119.534691', 'Taipei', 'Asia', 'AS', '35980.0', 'zh-TW,zh,nan,hak', 'TWN', 1668284, 0),
(229, 'TZ', 'Tanzania', 'TZS', '41892895', 'TZ', '834', '-0.990736', '-11.745696', '40.443222', '29.327168', 'Dodoma', 'Africa', 'AF', '945087.0', 'sw-TZ,en,ar', 'TZA', 149590, 0),
(230, 'UA', 'Ukraine', 'UAH', '45415596', 'UP', '804', '52.369362', '44.390415', '40.20739', '22.128889', 'Kyiv', 'Europe', 'EU', '603700.0', 'uk,ru-UA,rom,pl,hu', 'UKR', 690791, 380),
(231, 'UG', 'Uganda', 'UGX', '33398682', 'UG', '800', '4.214427', '-1.48405', '35.036049', '29.573252', 'Kampala', 'Africa', 'AF', '236040.0', 'en-UG,lg,sw,ar', 'UGA', 226074, 256),
(232, 'UM', 'U.S. Minor Outlying Islands', 'USD', '0', '', '581', '28.219814', '-0.389006', '166.654526', '-177.392029', '', 'Oceania', 'OC', '0.0', 'en-UM', 'UMI', 5854968, 0),
(233, 'US', 'United States', 'USD', '310232863', 'US', '840', '49.388611', '24.544245', '-66.954811', '-124.733253', 'Washington', 'North America', 'NA', '9629091.0', 'en-US,es-US,haw,fr', 'USA', 6252001, 1),
(234, 'UY', 'Uruguay', 'UYU', '3477000', 'UY', '858', '-30.082224', '-34.980816', '-53.073933', '-58.442722', 'Montevideo', 'South America', 'SA', '176220.0', 'es-UY', 'URY', 3439705, 598),
(235, 'UZ', 'Uzbekistan', 'UZS', '27865738', 'UZ', '860', '45.575001', '37.184444', '73.132278', '55.996639', 'Tashkent', 'Asia', 'AS', '447400.0', 'uz,ru,tg', 'UZB', 1512440, 998),
(236, 'VA', 'Vatican City', 'EUR', '921', 'VT', '336', '41.90743830885576', '41.90027960306854', '12.45837546629481', '12.44570678169205', 'Vatican', 'Europe', 'EU', '0.44', 'la,it,fr', 'VAT', 3164670, 0),
(237, 'VC', 'Saint Vincent and the Grenadines', 'XCD', '104217', 'VC', '670', '13.377834', '12.583984810969037', '-61.11388', '-61.46090317727658', 'Kingstown', 'North America', 'NA', '389.0', 'en-VC,fr', 'VCT', 3577815, 1784),
(238, 'VE', 'Venezuela', 'VEF', '27223228', 'VE', '862', '12.201903', '0.626311', '-59.80378', '-73.354073', 'Caracas', 'South America', 'SA', '912050.0', 'es-VE', 'VEN', 3625428, 58),
(239, 'VG', 'British Virgin Islands', 'USD', '21730', 'VI', '092', '18.757221', '18.383710898211305', '-64.268768', '-64.71312752730364', 'Road Town', 'North America', 'NA', '153.0', 'en-VG', 'VGB', 3577718, 0),
(240, 'VI', 'U.S. Virgin Islands', 'USD', '108708', 'VQ', '850', '18.391747', '17.681725', '-64.565178', '-65.038231', 'Charlotte Amalie', 'North America', 'NA', '352.0', 'en-VI', 'VIR', 4796775, 0),
(241, 'VN', 'Vietnam', 'VND', '89571130', 'VM', '704', '23.388834', '8.559611', '109.464638', '102.148224', 'Hanoi', 'Asia', 'AS', '329560.0', 'vi,en,fr,zh,km', 'VNM', 1562822, 0),
(242, 'VU', 'Vanuatu', 'VUV', '221552', 'NH', '548', '-13.073444', '-20.248945', '169.904785', '166.524979', 'Port Vila', 'Oceania', 'OC', '12200.0', 'bi,en-VU,fr-VU', 'VUT', 2134431, 678),
(243, 'WF', 'Wallis and Futuna', 'XPF', '16025', 'WF', '876', '-13.216758181061444', '-14.314559989820843', '-176.16174317718253', '-178.1848112896414', 'Mata-Utu', 'Oceania', 'OC', '274.0', 'wls,fud,fr-WF', 'WLF', 4034749, 681),
(244, 'WS', 'Samoa', 'WST', '192001', 'WS', '882', '-13.432207', '-14.040939', '-171.415741', '-172.798599', 'Apia', 'Oceania', 'OC', '2944.0', 'sm,en-WS', 'WSM', 4034894, 684),
(245, 'XK', 'Kosovo', 'EUR', '1800000', 'KV', '0', '43.2682495807952', '41.856369601859925', '21.80335088694943', '19.977481504492914', 'Pristina', 'Europe', 'EU', '', 'sq,sr', 'XKX', 831053, 0),
(246, 'YE', 'Yemen', 'YER', '23495361', 'YM', '887', '18.9999989031009', '12.1110910264462', '54.5305388163283', '42.5325394314234', 'Sanaa', 'Asia', 'AS', '527970.0', 'ar-YE', 'YEM', 69543, 967),
(247, 'YT', 'Mayotte', 'EUR', '159042', 'MF', '175', '-12.648891', '-13.000132', '45.29295', '45.03796', 'Mamoutzou', 'Africa', 'AF', '374.0', 'fr-YT', 'MYT', 1024031, 269),
(248, 'ZA', 'South Africa', 'ZAR', '49000000', 'SF', '710', '-22.126612', '-34.839828', '32.895973', '16.458021', 'Pretoria', 'Africa', 'AF', '1219912.0', 'zu,xh,af,nso,en-ZA,tn,st,ts,ss', 'ZAF', 953987, 27),
(249, 'ZM', 'Zambia', 'ZMK', '13460305', 'ZA', '894', '-8.22436', '-18.079473', '33.705704', '21.999371', 'Lusaka', 'Africa', 'AF', '752614.0', 'en-ZM,bem,loz,lun,lue,ny,toi', 'ZMB', 895949, 260),
(250, 'ZW', 'Zimbabwe', 'ZWL', '11651858', 'ZI', '716', '-15.608835', '-22.417738', '33.056305', '25.237028', 'Harare', 'Africa', 'AF', '390580.0', 'en-ZW,sn,nr,nd', 'ZWE', 878675, 263);

-- --------------------------------------------------------

--
-- Table structure for table `ma_faqs`
--

CREATE TABLE IF NOT EXISTS `ma_faqs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `group` enum('site','installation') NOT NULL DEFAULT 'site',
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `question` (`question`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `ma_faqs`
--

INSERT INTO `ma_faqs` (`ID`, `group`, `question`, `answer`, `status`) VALUES
(31, 'site', 'Frequently Asked Questions 1', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(26, 'site', 'Frequently Asked Questions', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(32, 'site', 'Frequently Asked Questions 2', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(33, 'site', 'Frequently Asked Questions 3', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(34, 'site', 'Frequently Asked Questions 4', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(35, 'site', 'Frequently Asked Questions 5', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(36, 'site', 'Frequently Asked Questions 6', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1),
(37, 'site', 'Frequently Asked Questions 7', '<p><strong>Lorem ipsum</strong> dolor sit amet, consectetur adipiscing elit. <strong>Quisque rutrum</strong> pellentesque imperdiet. Nulla lacinia iaculis nulla non pulvinar. <strong>Cum sociis</strong> natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut eu risus enim, ut pulvinar lectus. Sed hendrerit nibh metus.</p>', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_features`
--

CREATE TABLE IF NOT EXISTS `ma_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `titleID` int(11) NOT NULL,
  `feature` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `ma_features`
--

INSERT INTO `ma_features` (`ID`, `titleID`, `feature`, `status`) VALUES
(1, 2, 'A/C: Front', 1),
(2, 2, 'A/C: Rear', 1),
(3, 2, 'Cruise Control', 1),
(4, 2, 'Navigation System', 1),
(5, 2, 'Power Steering', 1),
(6, 2, 'Remote Keyless Entry', 1),
(7, 2, 'Tilt Wheel', 1),
(8, 2, 'Digital Meter', 1),
(9, 6, 'Alloy Wheels', 1),
(10, 6, 'Power Door Locks', 1),
(11, 6, 'Power Mirrors', 1),
(12, 6, 'Sunroof', 1),
(13, 6, 'Third Row Seats', 1),
(14, 6, 'Power Slide Door', 1),
(15, 7, 'Custom Wheels', 1),
(16, 7, 'Fully Loaded', 1),
(17, 7, 'Maintenance Records', 1),
(18, 7, 'New Paint', 1),
(19, 7, 'New Tires', 1),
(20, 7, 'No Accidents', 1),
(21, 7, 'One Owner', 1),
(22, 7, 'Performance Tires', 1),
(23, 7, 'Upgraded Sound System', 1),
(24, 7, 'Non Smoker', 1),
(25, 7, 'Turbo', 1),
(26, 1, 'Anti Lock Brakes', 1),
(27, 1, 'Driver Airbag', 1),
(28, 1, 'Passenger Airbag', 1),
(29, 1, 'Side Airbag', 1),
(30, 1, 'Alarm', 1),
(31, 3, 'Child Seat', 1),
(32, 3, 'Leather Seats', 1),
(33, 3, 'Power Seats', 1),
(34, 3, 'Bucket Seat', 1),
(35, 5, 'AM/FM Radio', 1),
(36, 5, 'AM/FM Stereo', 1),
(37, 5, 'CD Changer', 1),
(38, 5, 'CD Player', 1),
(39, 5, 'Premium Sound', 1),
(40, 5, 'Satellite Radio', 1),
(41, 5, 'DVD', 1),
(42, 4, 'Power Windows', 1),
(43, 4, 'Rear Window Defroster', 1),
(44, 4, 'Rear Window Wiper', 1),
(45, 4, 'Tinted Glass', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_feature_title`
--

CREATE TABLE IF NOT EXISTS `ma_feature_title` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `title` (`title`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ma_feature_title`
--

INSERT INTO `ma_feature_title` (`ID`, `title`, `status`) VALUES
(1, 'Safety', 1),
(2, 'Comfort', 1),
(3, 'Seat', 1),
(4, 'Windows', 1),
(5, 'Sound System', 1),
(6, 'Other Features', 1),
(7, 'Other Selling Points', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_feedbacks`
--

CREATE TABLE IF NOT EXISTS `ma_feedbacks` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(160) NOT NULL,
  `company` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `message` text CHARACTER SET latin1 NOT NULL,
  `date_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `IP` varchar(19) NOT NULL,
  `browser` tinytext NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ma_feedbacks`
--

INSERT INTO `ma_feedbacks` (`ID`, `name`, `company`, `email`, `subject`, `message`, `date_timestamp`, `IP`, `browser`) VALUES
(12, 'odd Yet', 'oddyet', 'support@oddyet.com', 'Test', 'Test', '2014-08-27 04:04:05', 'fe80::84ef:42fe:bee', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0'),
(13, 'odd Yet', 'oddyet', 'support@oddyet.com', 'Test', 'Test', '2014-08-27 04:04:47', 'fe80::84ef:42fe:bee', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20100101 Firefox/31.0'),
(16, 'odd Yet', 'Oddyet', 'support@oddyet.com', 'Test Subject', 'Test', '2014-09-29 21:34:19', '', ''),
(17, 'odd Yet', 'Oddyet', 'support@oddyet.com', 'Test Subject', 'Test Message', '2014-12-20 08:40:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(18, 'odd Yet', 'Oddyet', 'support@oddyet.com', 'Oddyet', 'Oddyet', '2014-12-20 08:41:47', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(19, 'Zaphiel Mendrion', '', 'habovery1947@jourrapide.com', '', 'Test Message', '2015-02-16 03:22:13', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0');

-- --------------------------------------------------------

--
-- Table structure for table `ma_fuel_types`
--

CREATE TABLE IF NOT EXISTS `ma_fuel_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(165) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ma_fuel_types`
--

INSERT INTO `ma_fuel_types` (`ID`, `name`, `status`) VALUES
(1, 'Biodiesel', 1),
(2, 'CNG', 1),
(3, 'Diesel', 1),
(4, 'Electric', 1),
(5, 'Ethanol-FFV', 1),
(6, 'Gasoline', 1),
(7, 'Hybrid Electric', 1),
(8, 'Other', 1),
(9, 'Steam', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_languages`
--

CREATE TABLE IF NOT EXISTS `ma_languages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) NOT NULL,
  `lang` varchar(6) NOT NULL,
  `direction` enum('ltr','rtl') NOT NULL DEFAULT 'ltr',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `lang` (`language`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ma_languages`
--

INSERT INTO `ma_languages` (`ID`, `language`, `lang`, `direction`, `status`) VALUES
(1, 'English', 'en', 'ltr', 1),
(2, 'Arabic', 'ar', 'rtl', 0),
(6, 'Bangla', 'bn', 'ltr', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ma_makers`
--

CREATE TABLE IF NOT EXISTS `ma_makers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `image` varchar(65) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `ma_makers`
--

INSERT INTO `ma_makers` (`ID`, `name`, `image`, `status`) VALUES
(10, 'Others', 'others.png', 1),
(9, 'Isuzu', 'isuzu.png', 1),
(8, 'Subaru', 'subaru.png', 1),
(7, 'Mazda', 'mazda.png', 1),
(6, 'Daihatsu', 'daihatsu.png', 1),
(5, 'Suzuki', 'suzuki.png', 1),
(4, 'Honda', 'honda.png', 1),
(3, 'Mitsubishi', 'mitsubishi.png', 1),
(2, 'Nissan', 'nissan.png', 1),
(1, 'Toyota', 'toyota.png', 1),
(11, 'Alfaromoeo', 'alfaromoeo.png', 1),
(12, 'Audi', 'audi.png', 1),
(13, 'Jeep', 'jeep.png', 1),
(14, 'SAAB', 'saab.png', 1),
(15, 'Volkswagen', 'volkswagen.png', 1),
(16, 'Mercedes', 'mercedes.png', 1),
(20, 'Chrysler', 'chrysler.png', 1),
(17, 'Land Rover', 'land-rover.png', 1),
(18, 'Ford', 'ford.png', 1),
(19, 'BMW', 'bmw.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_media`
--

CREATE TABLE IF NOT EXISTS `ma_media` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('Slider Image','Page Banner','Site Logo','Widget Image') NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `ma_media`
--

INSERT INTO `ma_media` (`ID`, `type`, `title`, `url`, `status`) VALUES
(23, 'Page Banner', 'Test Page baner', 'uploads/media/page_banner/test-page-baner.jpg', 1),
(22, 'Slider Image', 'Slider Image', 'uploads/media/slider_image/slider-image.jpg', 1),
(21, 'Site Logo', 'Oddyet Maa Autos Logo', 'uploads/media/site_logo/oddyet-maa-autos-logo.png', 1),
(24, 'Widget Image', 'Widget Image', 'uploads/media/widget_image/widget-image.jpg', 1),
(25, 'Slider Image', 'Slider 2', 'uploads/media/slider_image/slider-2.jpg', 1),
(26, 'Page Banner', 'Abou Us - Maa Autos', 'uploads/media/page_banner/abou-us-maa-autos.jpg', 1),
(31, 'Widget Image', 'Contact Us', 'uploads/media/widget_image/contact-us.jpg', 1),
(28, 'Page Banner', 'Contact us - Maa Autos', 'uploads/media/page_banner/contact-us-maa-autos.jpg', 1),
(32, 'Slider Image', 'Shift into High Gear', 'uploads/media/slider_image/shift-into-high-gear.jpg', 1),
(30, 'Widget Image', 'Request a Call Back', 'uploads/media/widget_image/request-a-call-back.jpg', 1),
(33, 'Slider Image', 'Vehicle', 'uploads/media/slider_image/vehicle.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_menu`
--

CREATE TABLE IF NOT EXISTS `ma_menu` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `menu_class` varchar(50) CHARACTER SET utf8 NOT NULL,
  `menu_id` varchar(50) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ma_menu`
--

INSERT INTO `ma_menu` (`ID`, `name`, `content`, `menu_class`, `menu_id`, `status`) VALUES
(1, 'topnav', '<ul class="oddyet-menu nav navbar-nav" id="top_nav_id">\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/vehicles">Vehicles</a>\r\n		<ul>\r\n			<li>\r\n				<a href="http://localhost/ma-autos.com/vehicles">Recent Vehicles</a>\r\n				<ul>\r\n				</ul>\r\n			</li>\r\n			<li>\r\n				 <a href="http://localhost/ma-autos.com/vehicles/popular">Popular Vehicles</a>\r\n			</li>\r\n			<li>\r\n				 <a href="http://localhost/ma-autos.com/vehicles/hot">Hot Vehicles</a>\r\n			</li>\r\n		</ul>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/search">Search</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/services">Services</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/news">News</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/faqs">FAQ</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/blog">Blog</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/contact">Contact</a>\r\n	</li>\r\n	<li>\r\n		<a href="#">Others</a>\r\n		<ul>\r\n			<li>\r\n				 <a href="http://localhost/ma-autos.com/bank-details">Bank Details</a>\r\n			</li>\r\n			<li>\r\n				 <a href="http://localhost/ma-autos.com/how-to-buy">How to Buy</a>\r\n			</li>\r\n		</ul>\r\n	</li>\r\n</ul>', 'oddyet-menu nav navbar-nav', 'top_nav_id', 1),
(6, 'TopMenu', '<ul class="primary-nav" id="topmenu">\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/">Home</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/about-us">About Us</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/faqs">FAQ</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/testimonials">Testimonials</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/call-back">Request a Callback</a>\r\n	</li>\r\n</ul>', '', 'topmenu', 1),
(4, 'bottom_site_nav', '<ul class="list-unstyled link-list foot-list" id="bottom_site_nav">\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/">Home</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/about-us">About Us</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/services">Services</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/contact">Contact</a>\r\n	</li>\r\n	<li>\r\n		 <a href="http://localhost/ma-autos.com/news">News</a>\r\n	</li>\r\n</ul>', 'list-unstyled link-list foot-list', 'bottom_site_nav', 1),
(5, 'bottom_maker_nav', '<ul class="list-unstyled link-list foot-list" id="bottom_maker_nav">\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/search?maker=bmw">BMW</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/search?maker=ford">Ford</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/search?maker=honda">Honda</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/search?maker=alfaromoeo">Alfaromoeo</a>\r\n	</li>\r\n	<li>\r\n		<a href="http://localhost/ma-autos.com/search?maker=audi">Audi</a>\r\n	</li>\r\n</ul>', 'list-unstyled link-list foot-list', 'bottom_maker_nav', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_models`
--

CREATE TABLE IF NOT EXISTS `ma_models` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `maker` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=63 ;

--
-- Dumping data for table `ma_models`
--

INSERT INTO `ma_models` (`ID`, `maker`, `model`, `status`) VALUES
(1, 19, 'FUMEI', 1),
(2, 13, '-WJ47-', 1),
(3, 16, 'GH-163154', 1),
(4, 1, 'DBA-GGH20W', 1),
(5, 10, 'U-FD3HGAA', 1),
(6, 3, 'KC-V46V', 1),
(7, 9, 'U-NKR58EA', 1),
(8, 13, 'GH-KJ37', 1),
(9, 3, 'KC-BE436E', 1),
(10, 3, 'P-FK415H', 1),
(11, 16, 'ML430', 1),
(12, 3, 'U-FE317B', 1),
(13, 13, 'GH-WJ40', 1),
(14, 1, 'CBA-ACU35W', 1),
(15, 1, 'E-SXA11G', 1),
(16, 16, 'GH-163157', 1),
(17, 1, 'KC-FB5BCAT', 1),
(18, 2, 'KC-MK211HH', 1),
(19, 3, 'N-FE321E', 1),
(20, 1, 'E-JZS160', 1),
(21, 9, 'U-FSR32HB&#25913;', 1),
(22, 3, 'U-FE301B', 1),
(23, 2, 'U-MK210EN', 1),
(24, 3, 'KC-FK612KZ', 1),
(25, 6, 'TE-S210P', 1),
(26, 12, 'GF-8LAPG', 1),
(27, 3, 'KK-FH21GC', 1),
(28, 1, 'KK-HZB50', 1),
(29, 3, 'U-FE637ET&#25913;', 1),
(30, 3, 'KC-FE568B', 1),
(31, 1, 'KC-BB40', 1),
(32, 1, 'U-LY61&#25913;', 1),
(33, 16, '-163172-', 1),
(34, 14, 'GF-EB235', 1),
(35, 1, 'DBA-KSP90', 1),
(36, 1, 'CBA-MCU25W', 1),
(37, 1, 'DBA-NZE141G', 1),
(38, 1, 'DAA-NHW20', 1),
(39, 3, 'N-FE101B', 1),
(40, 10, 'KC-FB4JEAA', 1),
(41, 2, 'E-BNR32', 1),
(42, 3, 'KK-BE63EG', 1),
(43, 10, 'KK-FC3JCDA', 1),
(44, 2, 'KG-DWGE25', 1),
(45, 2, 'KR-CWGE25', 1),
(46, 1, 'TC-TRH102V', 1),
(47, 3, 'U-FE317B&#25913;', 1),
(48, 18, 'GH-1FMWU74', 1),
(49, 10, 'GH-T360', 1),
(50, 10, 'ABA-T345F', 1),
(51, 19, 'GH-RF16', 1),
(52, 1, 'KC-HZB40', 1),
(53, 1, 'U-LY61', 1),
(54, 2, 'KC-DRGE24', 1),
(55, 15, 'GH-1KBLP', 1),
(56, 3, 'K-FE101B', 1),
(57, 19, 'GH-PA25', 1),
(58, 3, 'KK-FE53EB', 1),
(59, 2, 'GF-N30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_news`
--

CREATE TABLE IF NOT EXISTS `ma_news` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `tags` tinytext NOT NULL,
  `details` longtext NOT NULL,
  `image` varchar(150) NOT NULL,
  `url` varchar(255) NOT NULL,
  `publish_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `ma_news`
--

INSERT INTO `ma_news` (`ID`, `title`, `meta_keyword`, `meta_description`, `tags`, `details`, `image`, `url`, `publish_date`, `status`) VALUES
(55, 'White Christmas: Miami Vice Ferrari Testarossa on eBay for $1.75M', 'White Christmas: Miami Vice Ferrari Testarossa on eBay for $1.75M', 'White Christmas: Miami Vice Ferrari Testarossa on eBay for $1.75M', 'news', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">Were the eighties responsible for more iconic television cars than any other decade? Without even thinking about it we can reel off B.A. Baracus&#39;&nbsp;</span><a href="http://www.autoblog.com/gmc/">GMC</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;van, the&nbsp;</span><a href="http://www.autoblog.com/tag/kitt/">Knight Industries Two Thousand</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;and&nbsp;</span><a href="http://www.autoblog.com/tag/general+lee/">General Lee</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">,&nbsp;</span><em>Hardcastle and McCormick&#39;</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">s&nbsp;</span><a href="http://www.autoblog.com/tag/coyote/">Coyote</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">,&nbsp;</span><em>Magnum P.I.</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&#39;s&nbsp;</span><a href="http://www.autoblog.com/ferrari/">Ferrari</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;308. That&#39;s before we dip into personal favorites like&nbsp;</span><em>The Fall Guy</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&#39;s GMC and the&nbsp;</span><a href="http://www.autoblog.com/ram/">Dodge Ram Power Wagon</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">from&nbsp;</span><em>Simon and Simon</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">, or hop over to cartoons like&nbsp;</span><em><a href="http://www.autoblog.com/tag/transformers/">Transformers</a></em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">, the&nbsp;</span><em>GoBots</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">and&nbsp;</span><em>MASK</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">.</span><br />\n<br />\n<span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">And then there was this, among the top rung of eighties memorabilia, a 1986&nbsp;</span><a href="http://www.autoblog.com/tag/ferrari+testarossa/">Ferrari Testarossa</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">claimed to be one of two used in&nbsp;</span><em>Miami Vice</em><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">. You&#39;ll remember that the show began with James &quot;Sonny&quot; Crockett driving a black Daytona Coupe, but it was a replica built on C3&nbsp;</span><a href="http://www.autoblog.com/chevrolet/corvette/">Corvette</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;running gear. The story is that Ferrari sued the replica maker and made the show&#39;s producers an offer: blow up the replica on the show in return for two Testarossas to use. And that, it&#39;s said, is how Crockett&#39;s convertible&nbsp;</span><a href="http://blog.caranddriver.com/buy-sonny-crocketts-miami-vice-testarossa-for-1-75-million/">got hit by a missile</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;during an undercover assignment with an arms dealer. The original cars were Carbon Black, but the show&#39;s cameras couldn&#39;t keep up with them at night, so director Michael Mann had them painted white.</span><br />\n<br />\n<span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">For sale on eBay with a Buy It Now price of $1.75M, the seller says he has the all of the service history paperwork and documentation from Ferrari North America. According to the seller, he bought it about three years ago; before that, it was last sold in 1991 and sat in a Miami garage for years, so it has 16,000 miles on the odometer. The&nbsp;</span><a href="http://www.hagerty.com/valuationtools/HVT/VehicleSearch/Report?vc=82123">Hagerty Price Guide Report</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;shows Testarossa values have nearly doubled in four years, but a pristine find should still only fetch about $93,500, just to make sure you&#39;re clear on the seller&#39;s&nbsp;</span></p>\n\n<div style="box-sizing: border-box; font-family: ''Helvetica Neue'', Helvetica, Arial, sans-serif; font-size: 13px; line-height: 19px; display: inline-block; width: auto; height: auto; text-decoration: underline; border-bottom-width: 1px; border-bottom-style: solid; padding-bottom: 1px; color: rgb(243, 91, 0); cursor: pointer; background-color: rgb(255, 255, 255);">Hollywood</div>\n\n<p><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">&nbsp;premium. Nostalgia awaits you in the gallery, and perhaps a new car&nbsp;</span><a href="http://www.ebay.com/itm/291329129292?rmvSB=true">at the link</a><span style="background-color:rgb(255, 255, 255); color:rgb(84, 86, 89)">.</span></p>', 'white-christmas-miami-vice-ferrari-testarossa-on-ebay-for-175m.jpg', 'white-christmas-miami-vice-ferrari-testarossa-on-ebay-for-175m', '2014-12-10', 1),
(56, 'Happy Holidays from Autoblog!', 'Happy Holidays from Autoblog!', 'Happy Holidays from Autoblog!', 'news', '<p><span style="color:rgb(84, 86, 89)">Cars and the holidays go hand in hand. It could be&nbsp;</span>a big red bow on a silver Lexus<span style="color:rgb(84, 86, 89)">, someone wishing you&nbsp;</span>Happy Honda Days<span style="color:rgb(84, 86, 89)">, or heck, even Mustang Stanta up above, with what we imagine is a serious horsepower increase over his current, eight-reindeer setup. We&#39;ve got a lot to be happy about in the automotive space (and elsewhere, of course), and from all of us at&nbsp;</span><em>Autoblog</em><span style="color:rgb(84, 86, 89)">, we extend our happiest of holiday wishes to you, our dear readers.</span><br />\n<br />\n<span style="color:rgb(84, 86, 89)">In the spirt of the holiday, we&#39;re taking some time to relax, drown our sorrows with egg nog, hang out with friends and family, and really, just enjoy a day or two off. We&#39;ve still got a full hopper of automotive content to keep your interest piqued until we&#39;re back in full force next week. Be sure to look back and see what our&nbsp;</span>editors&#39; dream holiday rides<span style="color:rgb(84, 86, 89)">&nbsp;are, too.</span></p>\n\n<p>&nbsp;</p>\n\n<p><strong>This content data is demo data.</strong></p>', 'happy-holidays-from-autoblog.jpg', 'happy-holidays-from-autoblog', '2014-12-26', 1),
(57, 'It won''t be long now before Nissan Leaf finally overtakes Chevy Volt', 'It won''t be long now before Nissan Leaf finally overtakes Chevy Volt', 'It won''t be long now before Nissan Leaf finally overtakes Chevy Volt', 'news', '<p><span style="color:rgb(84, 86, 89)">The two best-selling plug-in vehicles ever are the&nbsp;</span>Chevy Volt<span style="color:rgb(84, 86, 89)">&nbsp;and the&nbsp;</span>Nissan Leaf<span style="color:rgb(84, 86, 89)">. When the two vehicles launched in late 2010, the plug-in hybrid Volt quickly outpaced the all-electric Leaf and, despite lots of ups and downs since then, continues to hold on to a&nbsp;</span>cumulative sales<span style="color:rgb(84, 86, 89)">&nbsp;lead. This will change in 2015.</span><br />\n<br />\n<span style="color:rgb(84, 86, 89)">Cumulatively, from November 2010 through November 2014, the Volt sold 71,867 units while the Leaf trails with 69,220. That&#39;s a difference of just 2,647. Based on current trends (with the Leaf selling around 2,500-2,700 a month and the Volt at 1,500-1,700) we expect the Leaf to take over either in January or, more likely, February when the Leaf takes over as the most popular plug-in car in America. Perhaps even March, depending on how low the numbers are for January and February, which are always slow sales months in the US.</span><br />\n<br />\n<span style="color:rgb(84, 86, 89)">Of course, once it takes the crown, the Leaf can&#39;t expect to easily hold on for long. A new Volt is coming in the second half of 2015, likely beating a new Leaf to market. The question is, then, how well the Chevy sells with all of its new bells and whistles. Do you think the Volt will be the comeback kid once the 2016 model becomes available?</span></p>', 'it-wont-be-long-now-before-nissan-leaf-finally-overtakes-chevy-volt.jpg', 'it-wont-be-long-now-before-nissan-leaf-finally-overtakes-chevy-volt', '2014-12-26', 1),
(58, 'Honda rolls out various oddities for 2015 Tokyo Auto Salon', 'Honda rolls out various oddities for 2015 Tokyo Auto Salon', 'Honda rolls out various oddities for 2015 Tokyo Auto Salon', 'news', '<p><span style="color:rgb(84, 86, 89)">On January 9 the doors at the Makuhari Messe in Chiba will open for the&nbsp;</span><a href="http://www.autoblog.com/tokyo-auto-salon/">2015 Tokyo Auto Salon</a><span style="color:rgb(84, 86, 89)">. and you know what that means, boys and girls: that&#39;s right, all sorts of strange mod jobs. Not to be confused with the&nbsp;</span><a href="http://www.autoblog.com/tokyo-motor-show/">Tokyo Motor Show</a><span style="color:rgb(84, 86, 89)">&nbsp;that&#39;s Japan&#39;s main automotive expo, the Tokyo Auto Salon is the Nipponese equivalent of SEMA.&nbsp;</span><a href="http://www.autoblog.com/honda/">Honda</a><span style="color:rgb(84, 86, 89)">&nbsp;is among the first to announce its lineup for the show, and, well... let&#39;s just say they&#39;re not&nbsp;</span><em>all</em><span style="color:rgb(84, 86, 89)">&nbsp;hideous and leave it at that.</span><br />\n<br />\n<span style="color:rgb(84, 86, 89)">The H brand has got a whole array of customized machinery in store for the tuner expo, starting with the new&nbsp;</span><a href="http://www.autoblog.com/2014/12/02/honda-n-box-slash-kei-car-japan-official/">N-Box Slash</a><span style="color:rgb(84, 86, 89)">&nbsp;that just went on sale in Japan as the company&#39;s latest Kei car. One version of the tall wagon on the tiny wheelbase is obviously inspired by America, or at least a Japanese impression of what American car culture is like: it&#39;s decked out in red with racing stripes, flame graphics, a highway road sign and strange checkerboard wheels. Another N-Box Slash dubbed the Cyber Code:89 concept looks like something from anime, all decked out in futuristic graphics and glowing lights. A third example is rather more tastefully done up in teal with yellow accents.</span><br />\n<br />\n<span style="color:rgb(84, 86, 89)">Of course Honda hasn&#39;t put all its eggs in the Slash basket, turning its attention as it has to other models in the JDM lineup. There&#39;s a retro N-One concept with a low-key grey and white exterior but with a zany multicolor interior, a tasteful white N-WGN with Modulo accessories, an&nbsp;</span><a href="http://www.autoblog.com/honda/odyssey/">Odyssey</a><span style="color:rgb(84, 86, 89)">Absolute 20th Anniversary edition minivan, a take on the NM4 cruiser bike that&#39;d look right at home in&nbsp;</span><em>Akira</em><span style="color:rgb(84, 86, 89)">&nbsp;and &ndash; one of our favorites from the lot &ndash; a Mugen take on the&nbsp;</span><a href="http://www.autoblog.com/2014/11/10/honda-legend-jdm-acura-rlx-official/">Honda Legend that we know as the Acura RLX</a><span style="color:rgb(84, 86, 89)">. Whether your plans will take you to Tokyo for the show or not, you can scope &#39;em all out in the high-res image gallery for a closer look.</span></p>\n\n<p>&nbsp;</p>\n\n<p><strong>This content data is demo data.</strong></p>', 'honda-rolls-out-various-oddities-for-2015-tokyo-auto-salon.jpg', 'honda-rolls-out-various-oddities-for-2015-tokyo-auto-salon', '2014-12-26', 1),
(59, 'Recharge Wrap-up: Fisker takes apart Finland assembly, Nissan Leaf sales in Europe expected to grow 25%', 'Recharge Wrap-up: Fisker takes apart Finland assembly, Nissan Leaf sales in Europe expected to grow 25%', 'Recharge Wrap-up: Fisker takes apart Finland assembly, Nissan Leaf sales in Europe expected to grow 25%', 'news', '<p><strong>The&nbsp;</strong><a href="http://www.autoblog.com/fisker/karma/"><strong>Fisker Karma</strong></a><strong>&#39;s Uusikaupunki, Finland production lines are being dismantled.&nbsp;</strong><span style="color:rgb(84, 86, 89)">The lines, operated by&nbsp;</span><a href="http://www.autoblog.com/tag/valmet+automotive/">Valmet Automotive</a><span style="color:rgb(84, 86, 89)">&nbsp;in the same plant that assembles the&nbsp;</span><a href="http://www.autoblog.com/tag/mercedes-benz+a-class/">Mercedes-Benz A-Class</a><span style="color:rgb(84, 86, 89)">, have been idle since&nbsp;</span><a href="http://www.autoblog.com/fisker/">Fisker</a><span style="color:rgb(84, 86, 89)">&#39;s money woes brought them to a halt in 2012. Fisker, which has since been purchased by</span><a href="http://www.autoblog.com/tag/wanxiang/">Wanxiang</a><span style="color:rgb(84, 86, 89)">, and Valmet are still in talks over future collaboration.&nbsp;</span><a href="http://yle.fi/uutiset/fisker_karma_story_ends_in_uusikaupunki/7705342">Read more at<em>YLE</em></a><span style="color:rgb(84, 86, 89)">.</span><br />\n<br />\n<strong><a href="http://www.autoblog.com/nissan/">Nissan</a>&nbsp;expects a double-digit percentage growth in&nbsp;<a href="http://www.autoblog.com/nissan/leaf/">Leaf</a>&nbsp;sales in Europe in 2015.&nbsp;</strong><span style="color:rgb(84, 86, 89)">Nissan Europe&#39;s Jean-Pierre Diernaz puts that number at around 25 percent over 2014&#39;s record sales. Part of this is due to much lower prices than earlier model years, thanks to government incentives and lower production costs than earlier model years. Diernaz also said that the&nbsp;</span><a href="http://www.autoblog.com/tag/nissan+e-nv200/">e-NV200</a><span style="color:rgb(84, 86, 89)">&nbsp;van will make up about 20 percent of Nissan&#39;s EV sales in Europe.&nbsp;</span><a href="http://europe.autonews.com/article/20141223/ANE/141209906/nissan-sees-record-2015-for-leaf-ev-in-europe">Read more at&nbsp;<em>Automotive News Europe</em></a><span style="color:rgb(84, 86, 89)">.</span><br />\n<br />\n<strong>EV drivers pay less on average in taxes than gasoline vehicle drivers in every state except Virginia.</strong><span style="color:rgb(84, 86, 89)">&nbsp;Some states impose extra taxes and registration fees for EVs to make up for lost revenue from fuel taxes, but EV drivers still come out ahead, even when compared to high-mileage cars like the&nbsp;</span><a href="http://www.autoblog.com/toyota/prius/">Toyota Prius</a><span style="color:rgb(84, 86, 89)">. Even in Wisconsin - which might follow Colorado, Nebraska, North Carolina, Virginia and Washington in added EV fees - those who drive electric should fare better. Virginia, however, charges EV drivers an extra $114 annually across two added fees, while gas drivers would only get dinged about $35.10 in gas taxes in a 50-mpg car.&nbsp;</span><a href="http://www.greencarreports.com/news/1096024_electric-vehicles-come-out-ahead-of-gas-cars-on-taxes--except-in-one-state">Read more at&nbsp;<em>Green Car Reports</em></a><span style="color:rgb(84, 86, 89)">.</span><br />\n<br />\n<strong>Two hydrogen-powered electric bus prototypes will be deployed on a trial basis Hamburg, Germany.&nbsp;</strong><span style="color:rgb(84, 86, 89)">The&nbsp;</span><a href="http://www.autoblog.com/tag/solaris/">Solaris</a><span style="color:rgb(84, 86, 89)">&nbsp;articulated electric buses use fuel cell range extenders from&nbsp;</span><a href="http://www.autoblog.com/tag/ballard+power/">Ballard</a><span style="color:rgb(84, 86, 89)">. The buses were unveiled on December 18, and will go into operation in January 2015. The German government is funding the trial, and Hamburg aims to cease the purchase of diesel buses by 2020. The new-generation fuel cell system in the two Hamburg buses improve upon Ballard&#39;s previous design by using fewer parts and exhibiting less parasitic power loss from the integrated air compressor and coolant pump.</span></p>', 'recharge-wrap-up-fisker-takes-apart-finland-assembly-nissan-leaf-sales-in-europe-expected-to-grow-25.jpg', 'recharge-wrap-up-fisker-takes-apart-finland-assembly-nissan-leaf-sales-in-europe-expected-to-grow-25', '2014-12-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_pages`
--

CREATE TABLE IF NOT EXISTS `ma_pages` (
  `ID` int(30) NOT NULL AUTO_INCREMENT,
  `page` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(200) NOT NULL,
  `meta_title` varchar(120) NOT NULL DEFAULT '',
  `meta_keyword` varchar(255) NOT NULL DEFAULT '',
  `meta_description` varchar(180) NOT NULL,
  `content` longtext NOT NULL,
  `page_banner` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `page` (`page`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ma_pages`
--

INSERT INTO `ma_pages` (`ID`, `page`, `url`, `meta_title`, `meta_keyword`, `meta_description`, `content`, `page_banner`, `tags`, `status`) VALUES
(2, 'Services', 'services', 'Services', 'Services', 'Services', '<div class="row well">\r\n   <div class="col-md-12">\r\n    <h2>Special Services by Used Japanese Cars Exporter:</h2>\r\n    \r\n    <p>Marugo Autos, a high quality Japanese Used Cars, has a unique advantage over the other Japanese Used Cars companies operating in Japan. It has the following competitive advantages which no other company offers in the Japanese used cars industry in the country.</p>\r\n    \r\n    <div class="list-group">\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Longest history of operating in the Japanese Used Cars Industry in Japan (Since 1970)</strong></span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>THE most experienced company in the used japanese cars field</strong></span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Has been providing the best customer service to its valuable clients all over the world</strong></span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>We make sure the cars you buy from us have no major mechanical problems</strong></span>\r\n    </div>\r\n    \r\n    <p>We have been consistently beating our rivals in the Japanese used vehicles industry on all the above counts. We are confident you will be 100% satisfied with our fanatical customer support. If you have any doubt or have any questions/comments, please contact us at your convenience.</p>\r\n    <br />\r\n    <h2>Marugo Co. Ltd. Special Warranty System</h2>\r\n    \r\n    <p>You can choose between two kinds of warranties: Professional Warranty and Premium Warranty.</p>\r\n    \r\n    <div class="list-group">\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Professional Warranty</strong>&nbsp;(compulsory, US$ 50): Covers vessel sinking, fire, or loss of cargo.</span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Coverage Limit:</strong>&nbsp;Full CIF amount</span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i><strong>Coverage Area:</strong>&nbsp;From Nagoya, Japan to unloading point at your destination seaport yard.<br />\r\n     <strong>NO CLAIM ACCEPTED, after unloading your vehicle at your destination seaport yard.</strong></span>\r\n     \r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Premium Warranty</strong>&nbsp;(optional, US$ 110): Covers vessel sinking, fire, or loss of cargo, damage (except by force majeure) and theft (except original audio/accessories).</span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Coverage Limit:</strong>&nbsp;Full CIF amount.</span>\r\n     <span class="list-group-item"><i class="icon-right-open"></i> <strong>Coverage Area:</strong>&nbsp;From Nagoya, Japan to Pick up point at your destination seaport yard (BEFORE DELIVERY).<br />\r\n     NO CLAIM ACCEPTED, after you or your clearing agent picks up your vehicle at your destination sea port yard.</span>\r\n    </div>\r\n   </div>\r\n  </div>', 'uploads/media/page_banner/test-page-baner.jpg', 'Services', 1),
(3, 'Bank Details', 'bank-details', 'Bank Details', 'Bank Details', 'Bank Details', '<div class="well">\n<h2>Oddyet Bank Details</h2>\n\n<p><strong>Oddyet Co. Ltd. (Maa Autos)</strong> UK, a company famous for providing quality used vehicles has always helped our valuable customers in getting the best <a href="http://www.oddyet.com/preview/vehicles">Used Cars</a>. We strongly believe in fanatical customer support. Following is the bank details of the company. Please remit the money via either the USD or JPY account. We are committed to providing you only the best quality cars to our customers in Zambia, Tanzania, Mozambique, Kenya, Uganda, Zimbabwe and other counrtries in North America, Europe, Africa and Asia. <strong>Oddyet Co. Ltd. </strong></p>\n\n<p><br />\n<strong>Bank Account</strong><br />\n<br />\n<strong>Bank Name: &nbsp; </strong>The Bank of bank name.<br />\n<strong>Branch Name: &nbsp;</strong> Account Brach Name<br />\n<strong>Account No. &nbsp;</strong> 000-0000000<br />\n<strong>Account Name:&nbsp; </strong>(Maa Autos)<br />\n<strong>Swiftcode: &nbsp;</strong> SWIFTCODE<br />\n<br />\n<strong>Bank Account (In US Dollars) </strong><br />\n<br />\n<strong>Bank Name: &nbsp; </strong>The Bank of bank name.<br />\n<strong>Branch Name: &nbsp;</strong> Account Brach Name<br />\n<strong>Account No. &nbsp;</strong> 000-0000000<br />\n<strong>Account Name:&nbsp; </strong>(Maa Autos)<br />\n<strong>Swiftcode: &nbsp;</strong> SWIFTCODE<br />\n<br />\n<strong>Bank Address:</strong> There goes bank account details.</p>\n</div>', '', 'Bank,Details', 1),
(5, 'How to Buy', 'how-to-buy', 'How to Buy', 'How to Buy', 'How to Buy', '<div class="row well">\n<div class="col-md-12">\n<h2>Six Steps to Buy a used Vehicle from Oddyet Co. Ltd.</h2>\n\n<p><strong>Oddyet Co. Ltd.</strong> is a quality used vehicles exporters in Central UK. We have been involved in the usedvehicles business for the last four decades, being one of the OLDEST used vehicles exporters in the country. If you would like to purchase a vehicle from us, please follow the steps given below and you will get the car without any trouble.</p>\n\n<p>&nbsp;</p>\n\n<h2>Six Easy Steps to Purchasing a Vehicle from Us</h2>\n\n<div class="row">\n<div class="col-md-6">\n<h3>Select a Vehicle from our stock</h3>\n\n<div class="row">\n<div class="col-md-8">\n<p >Select a vehicle of your choice from our stock List. We have plenty of stock to fulfill your requirements for a car. However, if you are not able to find the car of your choice from the list, please give us a call or send us an email message and we will find the car for you within the shortest possible time period.</p>\n</div>\n</div>\n</div>\n\n<div class="col-md-6">\n<h3>Pay the Money at our Bank Account</h3>\n\n<div class="col-md-8">\n<p>Pay the money to the bank account given on our website within three working days.</p>\n</div>\n</div>\n</div>\n\n<div class="row">\n<div class="col-md-6">\n<h3>Free Quotation</h3>\n\n<div class="row">\n<div class="col-md-8">\n<p>Get a free quotaion by Marugo Autos. Once you have selected the car of your dreams, we will send you a free no-obligation based quotation to let you know the overall cost of the car to your destination port.</p>\n</div>\n</div>\n</div>\n\n<div class="col-md-6">\n<h3>Shipping Arrangements</h3>\n\n<div class="col-md-8">\n<p>Shipping arrangements are made after confirming the payment by your side.</p>\n</div>\n</div>\n</div>\n\n<div class="row">\n<div class="col-md-6">\n<h3>Order your Vehicle</h3>\n\n<div class="row">\n<div class="col-md-8">\n<p>Order Your vehicle by letting us know via email or give us a call to confirm your order.</p>\n</div>\n</div>\n</div>\n\n<div class="col-md-6">\n<h3>Receive Your Vehicle</h3>\n\n<div class="col-md-8">\n<p>Receive your vehicle at your destination port</p>\n</div>\n</div>\n</div>\n</div>\n</div>', '', 'How,to,Buy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_routes`
--

CREATE TABLE IF NOT EXISTS `ma_routes` (
  `ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL,
  `controller` text CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ma_routes`
--

INSERT INTO `ma_routes` (`ID`, `slug`, `controller`) VALUES
(1, 'about-us', 'contents/index/about-us'),
(2, 'services', 'contents/index/services'),
(3, 'how-to-buy', 'contents/index/how-to-buy'),
(4, 'bank-details', 'contents/index/bank-details'),
(5, 'sfsdf', 'contents/index/sfsdf');

-- --------------------------------------------------------

--
-- Table structure for table `ma_seaports`
--

CREATE TABLE IF NOT EXISTS `ma_seaports` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `country` int(11) NOT NULL,
  `seaport` varchar(150) NOT NULL,
  `value` int(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `ma_seaports`
--

INSERT INTO `ma_seaports` (`ID`, `country`, `seaport`, `value`, `status`) VALUES
(1, 19, 'Chittagong', 20, 1),
(2, 19, 'Mongla', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_showrooms`
--

CREATE TABLE IF NOT EXISTS `ma_showrooms` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(120) NOT NULL,
  `dealership_name` varchar(255) NOT NULL,
  `email` varchar(120) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(60) NOT NULL,
  `state` varchar(60) NOT NULL,
  `zipcode` varchar(20) NOT NULL,
  `countryID` int(11) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(24) NOT NULL,
  `fax` varchar(35) NOT NULL,
  `website` varchar(255) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `dealership_name` (`dealership_name`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ma_showrooms`
--

INSERT INTO `ma_showrooms` (`ID`, `url`, `dealership_name`, `email`, `address`, `city`, `state`, `zipcode`, `countryID`, `phone`, `mobile`, `fax`, `website`, `longitude`, `latitude`, `status`) VALUES
(2, 'another-international-union', 'Another International Union', 'email@website.com', '1234 Caledon Road', 'Toronto', 'ON', 'M2K 1H5', 3, '416-555-5555', '', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_subscribers`
--

CREATE TABLE IF NOT EXISTS `ma_subscribers` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ma_subscribers`
--

INSERT INTO `ma_subscribers` (`ID`, `name`, `email`, `status`) VALUES
(30, 'OddYet', 'support@oddyet.com', 1),
(29, 'OddYet', 'info@oddyet.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_testimonials`
--

CREATE TABLE IF NOT EXISTS `ma_testimonials` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `testimonial` longtext NOT NULL,
  `name` varchar(100) NOT NULL,
  `company_name` varchar(150) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `mobile` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `web` varchar(100) NOT NULL,
  `publish_date` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `ma_testimonials`
--

INSERT INTO `ma_testimonials` (`ID`, `testimonial`, `name`, `company_name`, `designation`, `phone`, `mobile`, `email`, `web`, `publish_date`, `image`, `status`) VALUES
(45, '<p>Hi, Thank you so much we received the car, Its beautiful. my wife and I love it.The car is in very good condition. You are just the best suppliers of vehicles.</p>', 'Mr. Norwell', 'Oddyet', 'Manager', '000-0000-0000', '', 'info@oddyet.com', '', '2014-09-28', '1419589489_tml.jpg', 1),
(46, '<p>Hi, Thank you so much we received the car, Its beautiful. my wife and I love it.The car is in very good condition. You are just the best suppliers of vehicles.</p>', 'Mr. Norwell', 'Oddyet', 'Administrator', '', '', 'info@oddyet.com', '', '2014-12-12', '1419589419_tml.jpg', 1),
(49, '<p>Hi, Thank you so much we received the car, Its beautiful. my wife and I love it.The car is in very good condition. You are just the best suppliers of vehicles.</p>', 'Lee Pace', 'Oddyet', 'Actor', '', '', 'suppot@oddyet.com', 'www.oddyet.com', '2014-12-12', '1419590461_tml.jpg', 1),
(50, '<p>Hi, Thank you so much we received the car, Its beautiful. my wife and I love it.The car is in very good condition. You are just the best suppliers of vehicles.</p>', 'Chris Pratt', 'Oddyet', 'Actor', '', '', 'info@oddyet.com', '', '2014-12-12', '1419590542_tml.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_transmissions`
--

CREATE TABLE IF NOT EXISTS `ma_transmissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(165) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ma_transmissions`
--

INSERT INTO `ma_transmissions` (`ID`, `name`, `status`) VALUES
(1, 'Automatic', 1),
(2, 'Manual', 1),
(3, 'Tiptronic', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_uni_config`
--

CREATE TABLE IF NOT EXISTS `ma_uni_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `option` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ma_users`
--

CREATE TABLE IF NOT EXISTS `ma_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` enum('user','demo') NOT NULL DEFAULT 'user',
  `email` varchar(120) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `image` varchar(60) NOT NULL,
  `group` int(11) NOT NULL,
  `activationDate` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `lastLogin` int(11) NOT NULL,
  `lastIP` varchar(19) NOT NULL,
  `lastBrowser` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ma_users`
--

INSERT INTO `ma_users` (`ID`, `user_type`, `email`, `password`, `firstName`, `lastName`, `image`, `group`, `activationDate`, `status`, `lastLogin`, `lastIP`, `lastBrowser`) VALUES
(1, 'user', 'admin@oddyet.com', '123123', 'Hospital', 'Management', 'odd-yet-1.jpg', 2, 0, 1, 1445316807, '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36'),
(5, 'user', 'abdullah@oddyet.com', 'sujon0711', 'Abdullah Al', 'Mamun', 'abdullah-al-mamun-5.jpg', 2, 0, 1, 1419616789, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0');

-- --------------------------------------------------------

--
-- Table structure for table `ma_users_rules`
--

CREATE TABLE IF NOT EXISTS `ma_users_rules` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(60) NOT NULL,
  `addon` text NOT NULL,
  `read` tinyint(1) NOT NULL,
  `write` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=114 ;

--
-- Dumping data for table `ma_users_rules`
--

INSERT INTO `ma_users_rules` (`ID`, `group`, `addon`, `read`, `write`, `delete`) VALUES
(1, '1', 'All', 1, 1, 1),
(11, '2', 'Settings', 1, 1, 1),
(13, '2', 'Addons', 1, 1, 1),
(15, '2', 'Menu Builder', 1, 1, 1),
(16, '2', 'Feedback', 1, 1, 1),
(17, '2', 'Widgets', 1, 1, 1),
(18, '2', 'Route', 1, 1, 1),
(19, '2', 'Media Images', 1, 1, 1),
(22, '2', 'Configuration', 1, 1, 1),
(24, '5', 'Widgets', 1, 1, 1),
(41, '5', 'Documents', 1, 1, 1),
(42, '5', 'Widgets', 1, 1, 1),
(44, '5', 'Web Pages', 1, 1, 1),
(88, '2', 'Documents', 1, 1, 1),
(48, '5', 'Library Images', 1, 1, 1),
(50, '5', 'Media', 1, 1, 1),
(51, '5', 'Menu Builder', 1, 1, 1),
(56, '5', 'Widgets', 1, 1, 1),
(57, '5', 'Website Pages', 1, 1, 1),
(58, '5', 'Web Pages', 1, 1, 1),
(62, '5', 'Settings Addons', 1, 1, 1),
(72, '5', 'Feedback', 1, 1, 1),
(74, '5', 'Sales', 1, 1, 1),
(75, '5', 'Addons', 1, 1, 1),
(112, '2', 'FAQs', 1, 1, 1),
(103, '2', 'Settings Addons', 1, 1, 1),
(106, '2', 'User Rules', 1, 1, 1),
(107, '2', 'Users', 1, 1, 1),
(109, '2', 'Web Pages', 1, 1, 1),
(110, '2', 'Website Pages', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_user_groups`
--

CREATE TABLE IF NOT EXISTS `ma_user_groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(60) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ma_user_groups`
--

INSERT INTO `ma_user_groups` (`ID`, `group`, `status`) VALUES
(1, 'Super Administrator', 0),
(2, 'Administrator', 1),
(4, 'User', 1),
(5, 'Manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_user_login_history`
--

CREATE TABLE IF NOT EXISTS `ma_user_login_history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `login` int(11) NOT NULL,
  `IP` varchar(19) NOT NULL,
  `browser` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=122 ;

--
-- Dumping data for table `ma_user_login_history`
--

INSERT INTO `ma_user_login_history` (`ID`, `userID`, `login`, `IP`, `browser`) VALUES
(1, 1, 1416682501, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(2, 2, 1416682566, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(3, 1, 1416683274, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(4, 1, 1416684140, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(5, 1, 1416684324, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(6, 1, 1416760688, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(7, 1, 1416845148, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(8, 1, 1416853633, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(9, 1, 1416853651, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(10, 1, 1416853745, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(11, 1, 1416932712, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(12, 1, 1417018484, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(13, 1, 1417107966, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(14, 1, 1417119475, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(15, 1, 1417196113, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(16, 1, 1417278692, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(17, 1, 1417364162, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(18, 1, 1417450524, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(19, 1, 1417458897, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.71 Safari/537.36'),
(20, 1, 1417539018, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(21, 1, 1417624447, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(22, 1, 1417624662, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(23, 1, 1417861433, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(24, 1, 1417969879, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(25, 1, 1418058073, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(26, 1, 1418145410, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(27, 1, 1418228573, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(28, 1, 1418321391, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(29, 1, 1418399037, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:33.0) Gecko/20100101 Firefox/33.0'),
(30, 1, 1418494578, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(31, 1, 1418575453, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(32, 1, 1418667017, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(33, 1, 1418670156, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(34, 1, 1418709065, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(35, 1, 1418713302, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(36, 1, 1418837364, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(37, 1, 1418923337, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(38, 1, 1418930152, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(39, 1, 1418935942, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(40, 1, 1418966843, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(41, 1, 1418968621, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(42, 1, 1419012940, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(43, 1, 1419013780, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(44, 1, 1419096682, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(45, 1, 1419101784, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(46, 1, 1419182049, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(47, 1, 1419190281, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(48, 1, 1419269886, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(49, 1, 1419271044, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(50, 1, 1419274576, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(51, 1, 1419358700, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(52, 1, 1419359710, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(53, 1, 1419366502, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(54, 1, 1419441984, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(55, 1, 1419443616, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(56, 1, 1419443751, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(57, 1, 1419451229, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(58, 1, 1419451353, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(59, 1, 1419452337, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(60, 1, 1419452696, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(61, 1, 1419452896, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(62, 1, 1419473370, '103.21.41.98', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(63, 1, 1419480406, '103.21.41.98', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(64, 1, 1419484102, '103.21.41.98', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(65, 1, 1419517669, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(66, 5, 1419528720, '103.21.41.98', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(67, 5, 1419576002, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(68, 5, 1419576304, '103.21.41.98', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(69, 1, 1419576409, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(70, 1, 1419585655, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(71, 5, 1419586665, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(72, 1, 1419592539, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(73, 5, 1419592679, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(74, 5, 1419603330, '103.21.41.98', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(75, 1, 1419607449, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(76, 5, 1419608991, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(77, 5, 1419616789, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(78, 1, 1419698448, '59.152.105.110', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(79, 1, 1419786462, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(80, 1, 1419792675, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(81, 1, 1419882935, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(82, 1, 1419883079, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(83, 1, 1420209672, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(84, 1, 1420209691, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(85, 1, 1420355501, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(86, 1, 1420367063, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(87, 1, 1420660621, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(88, 1, 1420661649, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(89, 1, 1420661687, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(90, 1, 1420661709, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(91, 1, 1420661734, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(92, 1, 1420661749, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(93, 1, 1420661765, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(94, 1, 1420661784, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(95, 1, 1420661811, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(96, 1, 1420661821, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(97, 1, 1420661845, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(98, 1, 1420661857, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(99, 1, 1420662068, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(100, 1, 1420662828, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(101, 1, 1420912249, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(102, 1, 1421083392, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(103, 1, 1421258297, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(104, 1, 1421260696, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(105, 1, 1421260778, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.95 Safari/537.36'),
(106, 1, 1421339926, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(107, 1, 1421387822, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(108, 1, 1421427435, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0'),
(109, 1, 1421770428, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(110, 1, 1421781443, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(111, 1, 1421786641, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.99 Safari/537.36'),
(112, 1, 1421859828, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(113, 1, 1422212636, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(114, 1, 1422364395, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(115, 1, 1422367253, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(116, 1, 1423970835, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(117, 1, 1424413629, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; rv:35.0) Gecko/20100101 Firefox/35.0'),
(118, 1, 1435586369, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0'),
(119, 1, 1444911477, '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0'),
(120, 1, 1445311024, '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36'),
(121, 1, 1445316807, '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `ma_vehicles`
--

CREATE TABLE IF NOT EXISTS `ma_vehicles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `showroomID` int(11) NOT NULL,
  `makerID` int(11) NOT NULL,
  `vehicleCode` varchar(100) NOT NULL,
  `typeID` int(11) NOT NULL,
  `chassisno` varchar(50) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(120) NOT NULL,
  `defaultImage` varchar(255) NOT NULL,
  `meta_title` varchar(120) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  `meta_description` tinytext NOT NULL,
  `modelID` int(11) NOT NULL,
  `conditionID` int(11) NOT NULL,
  `drive` varchar(20) NOT NULL,
  `engine` varchar(45) NOT NULL,
  `grade` varchar(20) NOT NULL,
  `auction_grade` varchar(128) NOT NULL,
  `year` year(4) NOT NULL,
  `fuelID` int(11) NOT NULL,
  `transmissionID` int(11) NOT NULL,
  `interior_color` varchar(20) NOT NULL,
  `exterior_color` varchar(20) NOT NULL,
  `seats` varchar(5) NOT NULL,
  `doors` varchar(5) NOT NULL,
  `km` varchar(20) NOT NULL,
  `cc` varchar(20) NOT NULL,
  `status` enum('Available','Hold','Sold out') DEFAULT NULL,
  `popularity` int(11) NOT NULL,
  `hotcar` tinyint(1) NOT NULL,
  `price` double DEFAULT NULL,
  `discountPrice` double NOT NULL,
  `description` text NOT NULL,
  `internal_notes` text NOT NULL,
  `options` text NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `refno` (`vehicleCode`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=252 ;

--
-- Dumping data for table `ma_vehicles`
--

INSERT INTO `ma_vehicles` (`ID`, `showroomID`, `makerID`, `vehicleCode`, `typeID`, `chassisno`, `name`, `url`, `defaultImage`, `meta_title`, `meta_keyword`, `meta_description`, `modelID`, `conditionID`, `drive`, `engine`, `grade`, `auction_grade`, `year`, `fuelID`, `transmissionID`, `interior_color`, `exterior_color`, `seats`, `doors`, `km`, `cc`, `status`, `popularity`, `hotcar`, `price`, `discountPrice`, `description`, `internal_notes`, `options`) VALUES
(230, 2, 13, '0230', 12, '1J4GW48J04C180709', 'Grand Cherokee', 'grand-cherokee-suv4wd-0230', '8934-2015-forte-2.jpg', 'Grand Cherokee', 'Grand Cherokee', 'Grand Cherokee', 2, 1, 'Left Hand', '5465656', 'LAREDO', '', 2004, 1, 1, '787', '108', '5', '5', '83,000', '4700', 'Available', 35, 1, 7500, 7000, '<p>Left Hand Drive</p>\r\n\r\n<div>Roof Rail</div>\r\n\r\n<div>Freedom Edition</div>\r\n\r\n<div>&nbsp;</div>\r\n', '<p>Grand Cherokee</p>\r\n', ''),
(231, 2, 16, '0231', 12, 'WDC163154-2A401275', 'Benz', 'benz-suv4wd-0231', '8934-2015-forte-2.jpg', 'Benz', 'Benz', 'Benz', 3, 1, 'Right Hand', '4.2L TSi', '', '', 2003, 1, 1, '37', '37', '5', '5', '62,340', '3,190', 'Available', 3, 1, 5600, 0, '<div>ML320</div>\r\n\r\n<p>Leather Seats</p>\r\n\r\n<div>Sunroof</div>\r\n', '', ''),
(11, 2, 1, '0010', 12, 'GGH20-', 'Alphard', 'alphard-2009-toyota-e-sxa11g', '14190972425595398_YOOOOOO2_8934-2015-forte-2jpg.jpg', 'Alphard', 'Alphard', 'Alphard', 15, 1, 'Right Hand', '4.2L TSi', 'G-L Package', '', 2009, 1, 1, '37', '37', '7', '5', '24,500', '3500', 'Available', 15, 1, 32500, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(202, 2, 10, '0202', 12, 'FD3HGA-13554', 'Hino Ranger', 'hino-ranger-truck-0202', '8934-2015-forte-2.jpg', 'Hino Ranger', 'Hino Ranger', 'Hino Ranger', 5, 1, 'Right Hand', '4.2L TSi', '', '', 1992, 1, 1, '37', '37', '3', '2', '241,500', '7,410', 'Available', 4, 1, 8800, 0, '<div>3.4 Ton</div>\r\n\r\n<p>6 Speeds</p>\r\n\r\n<div>Engine &nbsp;H07D\r\n<div>Manual</div>\r\n\r\n<div>Diesel</div>\r\n\r\n<div>&nbsp;</div>\r\n</div>\r\n', '', ''),
(203, 0, 3, '0203', 0, 'V46-1200519', 'Pajero', 'pajero-suv4wd-0203', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1996, 0, 0, 'Silver', '', '5', '5', '137,310 ', '2,800', 'Sold out', 7, 1, 1690, 0, '4WD<div>Manual</div><div>Diesel</div><div>5 Door</div>', '', ''),
(228, 2, 13, '0228', 12, '1J8GM38K54W303006', 'Cherokee', 'cherokee-2005-jeep-gh-kj37', '2012-mercedes-benz-c63-amg-coupe-and-2012-bmw-m3-coupe-photo-431766-s-787x481.jpg', 'Cherokee', 'Cherokee', 'Cherokee', 8, 1, 'Right Hand', '4.2L TSi', 'RENEGADE', '', 2005, 1, 1, '37', '37', '5', '5', '73,060', '3,700', 'Available', 38, 1, 4700, 0, '<p>Low Mileage&nbsp;</p>\n\n<div>Roof Rail</div>\n\n<div>&nbsp;</div>\n', '', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(229, 2, 3, '0229', 12, 'BE436E-40812', 'Fuso Rosa', 'fuso-rosa-1997-mitsubishi-p-fk415h', '2013-ford-focus-st-5-door-test-mule-photo-435038-s-787x481.jpg', 'Fuso Rosa', 'Fuso Rosa', 'Fuso Rosa', 10, 1, 'Right Hand', '4.2L TSi', '', '', 1997, 1, 1, '37', '37', '26', '2', '167,590', '3,560', 'Available', 0, 1, 11300, 0, '<p>Auto Door</p>\n\n<div>Diesel</div>\n\n<div>Manual</div>\n\n<div>26 Seats</div>\n', '', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(194, 0, 3, '00194', 0, 'BE436E-40631', 'Rosa Bus', 'rosa-bus-bus-00194', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1997, 0, 0, 'Green', '', '1', '2', '144,420', '3,560', 'Sold out', 0, 1, 9000, 0, 'Clean Interior&nbsp;<div>Manual&nbsp;</div><div>Diesel</div><div>4D36 Engine</div>', '', ''),
(196, 0, 3, '00196', 0, 'FK415H520691', 'Fuso Fighter', 'fuso-fighter-truck-00196', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1989, 0, 0, 'White', '', '3', '2', '228,900', '6550', 'Sold out', 4, 1, 8900, 0, 'Diesel<div>Manual&nbsp;</div><div>5 Speeds</div><div>Airconditioner</div><div>Capacity &nbsp;3.75 Ton</div>', '', ''),
(199, 0, 16, '0199', 0, '4JGAB72E6XA084860', '-Benz  ML430', 'benz-ml430-suv4wd-0199', '', '', '', '', 0, 0, 'Left Hand', '', '', '', 1999, 0, 0, 'Silver', '', '5', '5', '118,210 ', '4,300', 'Available', 2, 1, 5800, 0, 'Left Hand Drive<div>Back Monitor</div><div>CD Changer</div><div>Leather Seats</div><div><br></div>', '', ''),
(200, 0, 3, '0200', 0, 'FE317B-560852', 'Fuso Canter', 'fuso-canter-truck-0200', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1991, 0, 0, 'White', '', '3', '2', '218,160', '4,200', 'Sold out', 0, 1, 5300, 0, '4 D 33 Engine<div>Same Tyres</div>', '', ''),
(204, 0, 13, '0204', 0, '1J8G848S44Y154683', 'Grand Cherokee', 'grand-cherokee-suv4wd-0204', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2005, 0, 0, 'Black', '', '5', '5', '72,190', '4,000', 'Sold out', 0, 1, 5000, 0, '<div>Grade: LAREDO</div>4WD<div>HDD Navigation</div><div>Clean Interior &amp; Exterior</div><div><br><div><br></div></div>', '', ''),
(205, 0, 1, '0205', 0, 'ACU35-0021848', 'Harrier', 'harrier-suv4wd-0205', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2008, 0, 0, 'Pearl', '', '5', '5', '97,480 ', '2,400', 'Sold out', 0, 1, 16500, 0, '<div>Grade 240 G L Alcantara Prime</div>Power Back Door<div>Back Camera</div><div><br></div>', '', ''),
(206, 0, 1, '0206', 0, 'SXA11-0136040', 'RAV4', 'rav4-suv4wd-0206', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1998, 0, 0, 'Wine Red', '', '5', '5', '69,000', '2,000', 'Sold out', 0, 1, 2800, 0, '4WD<div>Spare Key</div><div>Low Mileage</div>', '', ''),
(207, 0, 16, '0207', 0, 'WDC1631572A553074', 'Benz ML Class', 'benz-ml-class-suv4wd-0207', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2005, 0, 0, 'Silver', '', '5', '5', '86,470', '3,720 ', 'Sold out', 0, 1, 6890, 0, '<div>ML350 Special Edition</div>4 Wheel Drive (4WD)<div>Half Leather Seats</div><div>Navigation System</div><div>Clean Exterior &amp; Interior</div><div><br></div>', '', ''),
(236, 2, 3, '0236', 12, 'FE321E-520319', 'Fuso Canter', 'fuso-canter-1990-mitsubishi-kc-be436e', '14196149193169965_YOOOOOsq_2012-bmw-m3-coupe-40-liter-v-8-engine-photo-431789-s-787x481jpg.jpg', 'Fuso Canter', 'Fuso Canter', 'Fuso Canter', 6, 1, 'Right Hand', '4.2L TSi', '', '', 1990, 1, 1, '37', '37', '3', '2', '119,785', '3,290', 'Available', 4, 1, 6000, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(245, 2, 9, '0245', 12, 'FSR32HB-3000267', 'Forward', 'forward-truck-0245', 'izuzu-forward.jpg', 'forward-truck-0245', 'forward-truck-0245', 'forward-truck-0245', 7, 1, 'Right Hand', '45321', 'FSR32HB-3000267', '', 1995, 1, 1, '37', '37', '3', '2', '188,900', '7,120', 'Available', 4, 0, 11800, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(246, 2, 3, '0246', 12, 'FE301B-541742', 'Fuso Canter', 'fuso-canter-truck-0246', '14196145397831372_YOOOOOsn_2012-mercedes-benz-c63-amg-coupe-photo-431770-s-787x481jpg.jpg', 'fuso-canter-truck-0246', 'fuso-canter-truck-0246', 'fuso-canter-truck-0246', 6, 1, 'Right Hand', '325165', '', '', 1991, 1, 1, '37', '37', '3', '2', '124,990', '3,300', 'Available', 4, 0, 5500, 0, '<p><span ><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\r\n\r\n<h3><strong>Lorem ipsum dolor sit.</strong></h3>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\r\n\r\n<h3><strong>Lorem ipsum dolor sit amet.</strong></h3>\r\n\r\n<ul>\r\n <li>Lorem ipsum dolor sit amet.</li>\r\n <li>Quisquam, labore facere tempora dicta?</li>\r\n <li>Amet recusandae dignissimos enim voluptatem.</li>\r\n <li>Aspernatur magnam porro asperiores nostrum.</li>\r\n <li>Officiis, ad iure eos vitae!</li>\r\n <li>Similique corporis a animi nesciunt?</li>\r\n</ul>\r\n', '', ''),
(197, 0, 2, '00197', 0, 'MK210EN00127', 'Condor', 'condor-truck-00197', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1993, 0, 0, 'Purple', '', '2', '2', '63,950', '6,920', 'Sold out', 0, 0, 9500, 0, '3.5 Ton<div>Airbrake</div><div>Diesel&nbsp;</div><div>Manual</div><div>6 Speeds</div><div><br></div>', '', ''),
(198, 0, 3, '0198', 0, 'FK612KZ520059', 'Fuso Fighter', 'fuso-fighter-truck-0198', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1996, 0, 0, 'White', '', '3', '2', '222,900', '7,540', 'Sold out', 0, 1, 14800, 0, '<div>5.5 Ton&nbsp;</div><div>Airbrake</div>6 Speeds&nbsp;<div>Manual&nbsp;</div><div>Diesel</div><div><br></div>', '', ''),
(193, 0, 3, '00193', 0, '&#22269; (01) 056270', 'Fighter Mignon', 'fighter-mignon-truck-00193', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2000, 0, 0, 'White', '', '2', '2', '105,730', '8200', 'Sold out', 0, 1, 15000, 0, 'Diesel<div>5 Speeds</div><div>Manual</div>', '', ''),
(238, 2, 1, '0237', 12, 'HZB50-0109594', 'Coaster', 'coaster-bus-0237', '14196148891436295_YOOOOOs7_2013-ford-focus-st-photo-435045-s-787x481jpg.jpg', 'Fuso Canter', 'Fuso Canter', 'Fuso Canter', 4, 1, 'Right Hand', '4.2L TSi', '', '', 2000, 1, 1, '37', '37', '53', '2', '183,050', '4,200', 'Available', 0, 1, 12900, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'Cruise Control, Remote Keyless Entry, Tilt Wheel, Power Door Locks, Power Mirrors, Power Slide Door, Custom Wheels, New Tires, Upgraded Sound System, Anti Lock Brakes, Driver Airbag, Alarm, Leather Seats, Power Seats, Bucket Seat, AM/FM Stereo, CD Changer, DVD, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(239, 2, 3, '0239', 12, 'FE637ET500501', 'Fuso Canter', 'fuso-canter-truck-0239', '14195198691915656_YOOOOOsD_2013-ford-focus-st-interior-photo-435061-s-787x481jpg.jpg', 'Fuso Canter', 'Fuso Canter', 'Fuso Canter', 6, 1, 'Right Hand', '4.2L TSi', '', '', 1995, 1, 1, '37', '37', '3', '2', '144,650', '4,210', 'Available', 0, 1, 7300, 0, '<p>2 Ton</p>\n\n<div>4D 33 Engine</div>\n\n<div>Wide &amp; Long Body</div>\n\n<div>Clean Exterior &amp; Interior</div>\n', '', 'A/C: Rear, Remote Keyless Entry, Fully Loaded, No Accidents, Anti Lock Brakes, Driver Airbag, Leather Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, Rear Window Wiper, Tinted Glass'),
(240, 2, 3, '0240', 12, 'FE568B530035', 'KC-FE568B', 'kc-fe568b-truck-0240', 'vehicle.jpg', 'kc-fe568b-truck-0240', 'kc-fe568b-truck-0240', 'kc-fe568b-truck-0240', 6, 1, 'Right Hand', '6554654', '', '', 1997, 1, 1, '37', '37', '3', '2', '194,660', '4,560', 'Available', 18, 0, 8500, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, Cruise Control, Tilt Wheel, Alloy Wheels, Power Door Locks, Third Row Seats, Fully Loaded, No Accidents, Non Smoker, Anti Lock Brakes, Passenger Airbag, Alarm, Child Seat, Leather Seats, Power Seats, AM/FM Radio, AM/FM Stereo, Satellite Radio, Power Windows, Rear Window Defroster, Rear Window Wiper'),
(241, 2, 1, '0241', 12, 'BB40-0004244', 'Coaster', 'coaster-bus-0241', '14196148043680274_YOOOOOsK_2013-ford-focus-st-wagon-test-mule-photo-435034-s-787x481jpg.jpg', 'coaster-bus-0241', 'coaster-bus-0241', 'coaster-bus-0241', 4, 1, 'Right Hand', '65554', '', '', 1998, 1, 1, '37', '37', '26', '2', '71,770', '3400', 'Available', 0, 0, 17500, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(242, 2, 16, '0242', 12, 'WDC163157-2A422465', 'Mercedes Benz', 'mercedes-benz-2003-mercedes-gh-163154', '2013-ford-focus-st-photo-435046-s-787x481.jpg', 'Mercedes Benz', 'Mercedes Benz', 'Mercedes Benz', 3, 1, 'Right Hand', '4.2L TSi', '', '', 2003, 1, 1, '37', '37', '5', '5', '107,940', '3,700', 'Available', 2, 0, 5000, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<div>\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n</div>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Tilt Wheel, Power Door Locks, Sunroof, Third Row Seats, Power Slide Door, Fully Loaded, No Accidents, One Owner, Performance Tires, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, CD Player, Premium Sound, Satellite Radio, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(243, 2, 1, '0243', 12, 'LY61-0059635', 'Toyoace', 'toyoace-truck-0243', '14196146242410031_YOOOOOs9_2013-ford-focus-st-wagon-test-mule-photo-435034-s-787x481jpg.jpg', 'toyoace-truck-0243', 'toyoace-truck-0243', 'toyoace-truck-0243', 4, 1, 'Right Hand', '6554564', '', '', 1994, 1, 1, '37', '37', '3', '2', '112,470', '2,800', 'Available', 0, 0, 4800, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'Cruise Control, Navigation System, Tilt Wheel, Alloy Wheels, Power Door Locks, Power Slide Door, Fully Loaded, No Accidents, Non Smoker, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Child Seat, Leather Seats, Power Seats, AM/FM Radio, AM/FM Stereo, Satellite Radio, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(244, 2, 16, '0244', 12, '4JGAB72E6XA078332', 'Mercedes Benz', 'mercedes-benz-suv4wd-0244', '14196145737043590_YOOOOOsB_2013-subaru-xv-crosstrek-photo-434422-s-787x481jpg.jpg', 'mercedes-benz-suv4wd-0244', 'mercedes-benz-suv4wd-0244', 'mercedes-benz-suv4wd-0244', 3, 1, 'Left Hand', '5441616654', '', '', 1999, 1, 1, '37', '37', '5', '5', '100,710', '4,260', 'Available', 8, 0, 6300, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ul>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ul>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(208, 0, 14, '0208', 0, 'YS3E-D48E713031756', '9-5  2.3t', '9-5-23t-sedan-0208', '', '', '', '', 0, 0, 'Left Hand', '', '', '', 2001, 0, 0, 'Silver', '', '5', '4', '77,210', '2,300 ', 'Sold out', 0, 0, 1780, 0, 'Left Hand Drive<div>Low Mileage</div><div>Leather Seats</div><div>Good Tyres</div><div><br></div>', '', ''),
(247, 2, 1, '0247', 12, 'MCU25-0160293', 'kluger v', 'kluger-v-suv4wd-0247', '1419614503147738_YOOOOOst_2012-bmw-m3-coupe-and-2012-mercedes-benz-c63-amg-coupe-photo-431768-s-787x481jpg.jpg', 'kluger-v-suv4wd-0247', 'kluger-v-suv4wd-0247', 'kluger-v-suv4wd-0247', 4, 1, 'Right Hand', '545454', '', '', 2005, 1, 1, '37', '37', '5', '5', '355347', '3000', 'Available', 2, 0, 3600, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '', 'A/C: Front, A/C: Rear, Alloy Wheels, Power Door Locks, Custom Wheels, Fully Loaded, Anti Lock Brakes, Driver Airbag, Child Seat, Leather Seats, AM/FM Radio, AM/FM Stereo, Power Windows, Rear Window Defroster'),
(248, 2, 1, '0248', 12, 'NZE141-9034355', 'FIELDER', 'fielder-2007-toyota-cba-acu35w', '14196144616768827_YOOOOO0O_2012-mercedes-benz-c63-amg-coupe-photo-431771-s-787x481jpg.jpg', 'FIELDER FIELDER', 'FIELDER FIELDER', 'FIELDER FIELDER', 14, 1, 'Right Hand', '4.2L TSi', '', '', 2007, 1, 1, '37', '37', '5', '5', '97,306', '3,190', 'Available', 9, 0, 5300, 0, '<p>FIELDER</p>\n', '<p>FIELDER</p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(250, 2, 1, 'MA-00428', 12, 'NHW20-3291108', 'Prius', 'prius-sedan-ma-00428', '2012-bmw-m3-coupe-photo-431781-s-787x481.jpg', 'Prius', 'Prius', 'Prius', 4, 1, 'Right Hand', '4.2L TSi', '', '', 2007, 1, 1, '37', '37', '5', '5', '236805', '1500', 'Available', 103, 0, 4300, 0, '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</p>\r\n\r\n<p><strong>Lorem ipsum dolor sit.</strong></p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\r\n\r\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\r\n\r\n<ul>\r\n <li>Lorem ipsum dolor sit amet.</li>\r\n <li>Quisquam, labore facere tempora dicta?</li>\r\n <li>Amet recusandae dignissimos enim voluptatem.</li>\r\n <li>Aspernatur magnam porro asperiores nostrum.</li>\r\n <li>Officiis, ad iure eos vitae!</li>\r\n <li>Similique corporis a animi nesciunt?</li>\r\n</ul>\r\n', '<p><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</p>\r\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(235, 2, 3, '0235', 12, 'FE101B106226', 'Fuso Canter', 'fuso-canter-truck-0235', '14196149464239901_YOOOOOsm_2013-ford-focus-st-wagon-and-5-door-test-mules-photo-435039-s-787x481jpg.jpg', 'Fuso Canter', 'Fuso Canter', 'Fuso Canter', 6, 1, 'Right Hand', '4.2L TSi', '', '', 1983, 1, 1, '37', '37', '3', '2', '87,770', '3,290', 'Available', 0, 0, 4000, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(210, 0, 2, '0210', 0, 'BNR32-214391', 'Skyline GT-R', 'skyline-gt-r-sedan-0210', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1991, 0, 0, 'Gray', '', '4', '3', '144,380', '2,560', 'Hold', 0, 0, 4500, 0, '4WD<div>Timing Belt Changed<br><div>5 Speeds</div><div><br></div></div>', '', ''),
(211, 0, 3, '0211', 0, 'BE63EG-300541', 'Rosa Bus', 'rosa-bus-bus-0211', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2003, 0, 0, 'Twotone', '', '54', '3', '150,300', '5,240', 'Sold out', 0, 0, 11000, 0, 'Long Body&nbsp;<div>Kid`s Bus</div><div>Manual&nbsp;</div><div>Diesel</div><div>Engine 4M51</div>', '', ''),
(212, 0, 10, '0212', 0, 'FC3JCD12022', 'Hino Ranger', 'hino-ranger-truck-0212', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2001, 0, 0, 'White', '', '3', '2', '107,580', '6,630', 'Sold out', 1, 0, 16000, 0, '6Speeds<div>Diesel</div><div>Engine J07C</div><div>3.7 Ton</div>', '', ''),
(213, 0, 2, '0213', 0, 'DWGE25-010843', 'Nissan Caravan', 'nissan-caravan-bus-0213', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2004, 0, 0, 'Other', '', '12', '4', '187,850', '3000', 'Sold out', 0, 0, 5800, 0, '12 Seats<div>Manual</div><div>Diesel</div><div><br></div>', '', ''),
(214, 0, 2, '00214', 0, 'CWGE25-032162', 'CARAVAN VAN', 'caravan-van-van-minivan-00214', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2005, 0, 0, 'Silver', '', '6', '4', '117,550', '3,000 ', 'Sold out', 0, 0, 5980, 0, 'High Roof<div>5 Speeds</div><div>Diesel</div>', '', ''),
(215, 2, 1, '0215', 12, 'TRH102-0004275', 'Hiace Van', 'hiace-van-2003-toyota-kc-fb5bcat', '2013-ford-focus-st-photo-435047-s-787x481.jpg', 'Hiace Van', 'Hiace Van', 'Hiace Van', 17, 1, 'Right Hand', '4.2L TSi', '', '', 2003, 1, 1, '37', '37', '6', '5', '138,370', '1500', 'Available', 0, 0, 5980, 0, '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n\n<p><strong>Lorem ipsum dolor sit.</strong></p>\n\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe sunt expedita numquam nulla debitis nesciunt quibusdam id est. Eos, ex tempora expedita id ratione quidem assumenda reprehenderit at provident voluptatibus!</p>\n\n<p><strong>Lorem ipsum dolor sit amet.</strong></p>\n\n<ol>\n	<li>Lorem ipsum dolor sit amet.</li>\n	<li>Quisquam, labore facere tempora dicta?</li>\n	<li>Amet recusandae dignissimos enim voluptatem.</li>\n	<li>Aspernatur magnam porro asperiores nostrum.</li>\n	<li>Officiis, ad iure eos vitae!</li>\n	<li>Similique corporis a animi nesciunt?</li>\n</ol>\n', '<p><span style="color:rgb(65, 65, 65)"><strong>Lorem ipsum dolor sit amet</strong>, consectetur adipiscing elit. Aenean aliquet fringilla metus, a ultricies ligula consequat at. Maecenas eget massa at eros ornare rhoncus. In sit amet enim risus, in mattis felis. Donec lorem arcu, tempor quis fermentum et, viverra in turpis. Nam non nunc vitae justo tincidunt lobortis eu sit amet dui. Nam ut dui aliquet nisl fermentum mollis sit amet eget lectus. Vivamus iaculis massa sit amet velit convallis aliquam. Vestibulum dolor erat, congue nec viverra eget, aliquet sit amet nunc. Donec vitae arcu orci.</span></p>\n', 'A/C: Front, A/C: Rear, Cruise Control, Navigation System, Power Steering, Remote Keyless Entry, Tilt Wheel, Digital Meter, Alloy Wheels, Power Door Locks, Power Mirrors, Sunroof, Third Row Seats, Power Slide Door, Custom Wheels, Fully Loaded, Maintenance Records, New Paint, New Tires, No Accidents, One Owner, Performance Tires, Upgraded Sound System, Non Smoker, Turbo, Anti Lock Brakes, Driver Airbag, Passenger Airbag, Side Airbag, Alarm, Child Seat, Leather Seats, Power Seats, Bucket Seat, AM/FM Radio, AM/FM Stereo, CD Changer, CD Player, Premium Sound, Satellite Radio, DVD, Power Windows, Rear Window Defroster, Rear Window Wiper, Tinted Glass'),
(216, 0, 16, '0216', 0, 'WDC1631542A394136', 'BENZ ML320', 'benz-ml320-suv4wd-0216', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2002, 0, 0, 'Silver', '', '5', '5', '89,140', '3,190', 'Sold out', 0, 0, 4680, 0, 'ML320<div>4WD</div>', '', ''),
(217, 0, 3, '0217', 0, 'FE317B-560137', 'FUSO CANTER', 'fuso-canter-truck-0217', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 1991, 0, 0, 'White', '', '3', '2', '95,300', '4,210', 'Sold out', 0, 0, 9100, 0, 'High Deck<div>4D33 Engine</div><div>Tadano Crane 2.02 Ton !!</div>', '', ''),
(232, 2, 2, '0232', 12, 'DRGE24-035045', 'Homy Coach', 'homy-coach-bus-0232', 'vehicle.jpg', 'homy-coach-bus-0232', 'homy-coach-bus-0232', 'homy-coach-bus-0232', 18, 1, 'Right Hand', '32454654', 'DX', '4.0', 1995, 1, 1, '37', '37', '15', '4', '68,340', '2,700', 'Available', 0, 0, 4980, 0, '<p>Low Mileage</p>\n\n<div>Manual&nbsp;</div>\n\n<div>Diesel</div>\n\n<div>15 Seats</div>\n', '', ''),
(233, 2, 15, '0233', 12, 'WVWZZZ1KZ7U027881', 'Volkswagen Golf', 'volkswagen-golf-sedan-0233', 'vehicle.jpg', 'volkswagen-golf-sedan-0233', 'volkswagen-golf-sedan-0233', 'volkswagen-golf-sedan-0233', 55, 1, 'Right Hand', '5484', 'E', '', 2007, 1, 1, '37', '37', '5', '5', '93,670', '1,600', 'Available', 0, 0, 3980, 0, '<p>Keyless Entry</p>\n\n<div>CD Player</div>\n', '', ''),
(192, 0, 19, '00191', 0, 'WBAPA72000WD50145', 'X3', 'x3-suv4wd-00191', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2006, 0, 0, 'White', '', '5', '5', '83,770 ', '2,500', 'Available', 1, 0, 8700, 0, '2.5i&nbsp;<div>Keyless Entry</div>', '', ''),
(201, 0, 3, '0201', 0, 'FE53EB553288', 'Fuso Canter', 'fuso-canter-truck-0201', '', '', '', '', 0, 0, 'Right Hand', '', '', '', 2000, 0, 0, 'White', '', '3', '2', '73,050', '5240', 'Sold out', 0, 0, 6800, 0, '3 Ton !!<div>High Deck</div><div>Low Mileage</div><div>Clean Interior</div><div><br></div>', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ma_vehicle_categories`
--

CREATE TABLE IF NOT EXISTS `ma_vehicle_categories` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `category` (`category`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ma_vehicle_categories`
--

INSERT INTO `ma_vehicle_categories` (`ID`, `category`, `status`) VALUES
(1, 'Coupe', 1),
(2, 'Luxury Car', 1),
(3, 'Pickup Truck', 1),
(4, 'Sedan', 1),
(5, 'Sport Utility Vehicle', 1),
(6, 'Sports Car', 1),
(7, 'Van', 1),
(8, 'Wagon', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_vehicle_enquiries`
--

CREATE TABLE IF NOT EXISTS `ma_vehicle_enquiries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleCode` varchar(20) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `countryID` int(11) NOT NULL,
  `comments` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `IP` int(19) NOT NULL,
  `browser` tinytext NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ma_vehicle_enquiries`
--

INSERT INTO `ma_vehicle_enquiries` (`ID`, `vehicleCode`, `name`, `email`, `phone`, `address`, `countryID`, `comments`, `date`, `IP`, `browser`, `status`) VALUES
(1, 'MA-00428', 'Odd Yet', 'info@oddyet.com', '0021540000', 'Address', 4, 'test comments for enquiry vehicle.', '2014-12-26 04:29:57', 0, 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0', 1),
(2, 'MA-00428', 'Odd Yet', 'info@oddyet.com', '0021540000', 'Address', 3, 'test comments for enquiry vehicle.', '2014-12-26 04:29:57', 1270, 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0', 1),
(3, 'MA-00428', 'Odd Yet', 'info@oddyet.com', '0021540000', 'Address', 3, 'test comments for enquiry vehicle.', '2014-12-26 04:29:57', 1270, 'Mozilla/5.0 (Windows NT 6.1; rv:34.0) Gecko/20100101 Firefox/34.0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_vehicle_features`
--

CREATE TABLE IF NOT EXISTS `ma_vehicle_features` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleID` int(11) NOT NULL,
  `featureID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=225 ;

--
-- Dumping data for table `ma_vehicle_features`
--

INSERT INTO `ma_vehicle_features` (`ID`, `vehicleID`, `featureID`) VALUES
(224, 250, 45),
(223, 250, 44),
(222, 250, 43),
(221, 250, 42),
(220, 250, 41),
(219, 250, 40),
(218, 250, 39),
(217, 250, 38),
(216, 250, 37),
(215, 250, 36),
(214, 250, 35),
(213, 250, 34),
(212, 250, 33),
(211, 250, 32),
(210, 250, 31),
(209, 250, 30),
(208, 250, 29),
(207, 250, 28),
(206, 250, 27),
(205, 250, 26),
(204, 250, 25),
(203, 250, 24),
(202, 250, 23),
(201, 250, 22),
(200, 250, 21),
(199, 250, 20),
(198, 250, 19),
(197, 250, 18),
(196, 250, 17),
(195, 250, 16),
(194, 250, 15),
(193, 250, 14),
(192, 250, 13),
(191, 250, 12),
(190, 250, 11),
(189, 250, 10),
(188, 250, 9),
(187, 250, 8),
(186, 250, 7),
(185, 250, 6),
(184, 250, 5),
(183, 250, 4),
(182, 250, 3),
(181, 250, 2),
(180, 250, 1),
(46, 0, 1),
(47, 0, 2),
(48, 0, 3),
(49, 0, 4),
(50, 0, 5),
(51, 0, 6),
(52, 0, 7),
(53, 0, 8),
(54, 0, 9),
(55, 0, 10),
(56, 0, 11),
(57, 0, 12),
(58, 0, 13),
(59, 0, 14),
(60, 0, 15),
(61, 0, 16),
(62, 0, 17),
(63, 0, 18),
(64, 0, 19),
(65, 0, 20),
(66, 0, 21),
(67, 0, 22),
(68, 0, 23),
(69, 0, 24),
(70, 0, 25),
(71, 0, 26),
(72, 0, 27),
(73, 0, 28),
(74, 0, 29),
(75, 0, 30),
(76, 0, 31),
(77, 0, 32),
(78, 0, 33),
(79, 0, 34),
(80, 0, 35),
(81, 0, 36),
(82, 0, 37),
(83, 0, 38),
(84, 0, 39),
(85, 0, 40),
(86, 0, 41),
(87, 0, 42),
(88, 0, 43),
(89, 0, 44),
(90, 0, 45);

-- --------------------------------------------------------

--
-- Table structure for table `ma_vehicle_images`
--

CREATE TABLE IF NOT EXISTS `ma_vehicle_images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `vehicleID` int(11) NOT NULL,
  `sequence` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `ma_vehicle_images`
--

INSERT INTO `ma_vehicle_images` (`ID`, `vehicleID`, `sequence`, `image`) VALUES
(1, 230, 616, '14181505912279052_YOOOOOsy_75044_502518969861662_1660024465_njpg.jpg'),
(2, 230, 617, '14181505919169312_YOOOOOsy_253639_175237459293712_775207627_njpg.jpg'),
(3, 230, 615, '1418150591309143_YOOOOOsy_alfaromoeopng.png'),
(4, 230, 618, '14181506056034851_YOOOOOsy_75044_502518969861662_1660024465_njpg.jpg'),
(5, 230, 619, '14181506059541932_YOOOOOsy_253639_175237459293712_775207627_njpg.jpg'),
(6, 230, 620, '14181506055472412_YOOOOOsy_alfaromoeopng.png'),
(9, 11, 603, '14190972425595398_YOOOOOO2_8934-2015-forte-2jpg.jpg'),
(8, 231, 602, '8934-2015-forte-2.jpg'),
(10, 230, 595, '8934-2015-forte-2.jpg'),
(11, 202, 586, '8934-2015-forte-2.jpg'),
(13, 247, 586, '14190974539305726_YOOOOOst_8934-2015-forte-2jpg.jpg'),
(14, 246, 586, '14190974714810181_YOOOOOsn_forza-horizon-2-napa-03jpg.jpg'),
(29, 246, 508, 'fuso-canter.jpg'),
(26, 250, 0, '2012-bmw-m3-coupe-photo-431781-s-787x481.jpg'),
(27, 248, 549, '2012-mercedes-benz-c63-amg-coupe-and-2012-bmw-m3-coupe-photo-431762-s-787x481.jpg'),
(28, 247, 529, '1.jpg'),
(20, 250, 1, '14194532785985652_YOOOOO0h_2012-bmw-m3-coupe-photo-431782-s-787x481jpg.jpg'),
(21, 250, 4, '14194532797437640_YOOOOO0h_2012-bmw-m3-coupe-photo-431783-s-787x481jpg.jpg'),
(22, 250, 6, '14194532809654879_YOOOOO0h_2012-bmw-m3-coupe-photo-431781-s-787x481jpg.jpg'),
(23, 250, 5, '14194532817090775_YOOOOO0h_2012-bmw-m3-coupe-shifter-photo-431787-s-787x481jpg.jpg'),
(24, 250, 7, '14194532826154139_YOOOOO0h_2012-bmw-m3-coupe-wheel-photo-431785-s-787x481jpg.jpg'),
(25, 250, 8, '14194532833065894_YOOOOO0h_2012-lamborghini-aventador-lp700-4-photo-431565-s-787x481jpg.jpg'),
(30, 245, 486, 'izuzu-forward.jpg'),
(31, 244, 463, 'vehicle.jpg'),
(32, 243, 439, 'vehicle.jpg'),
(33, 241, 414, 'vehicle.jpg'),
(34, 240, 388, 'vehicle.jpg'),
(35, 233, 361, 'vehicle.jpg'),
(36, 232, 333, 'vehicle.jpg'),
(37, 242, 304, '2013-ford-focus-st-photo-435046-s-787x481.jpg'),
(38, 239, 304, '14195198691915656_YOOOOOsD_2013-ford-focus-st-interior-photo-435061-s-787x481jpg.jpg'),
(39, 239, 304, '14195198694500077_YOOOOOsD_2013-ford-focus-st-interior-photo-435062-s-787x481jpg.jpg'),
(40, 239, 304, '14195198717478973_YOOOOOsD_2013-ford-focus-st-interior-photo-435063-s-787x481jpg.jpg'),
(41, 239, 304, '14195198723817341_YOOOOOsD_2013-ford-focus-st-photo-435046-s-787x481jpg.jpg'),
(42, 239, 304, '14195198738368228_YOOOOOsD_2013-ford-focus-st-photo-435047-s-787x481jpg.jpg'),
(43, 238, 269, '2013-subaru-xv-crosstrek-photo-434421-s-787x481.jpg'),
(44, 236, 233, '2012-bmw-m3-coupe-and-2012-mercedes-benz-c63-amg-coupe-photo-431768-s-787x481.jpg'),
(45, 235, 159, 'slp-chevrolet-camaro-zl1-convertible-photo-431740-s-787x481.jpg'),
(46, 234, 121, '2013-ford-focus-st-wagon-test-mule-photo-435036-s-787x481.jpg'),
(47, 228, 82, '2012-mercedes-benz-c63-amg-coupe-and-2012-bmw-m3-coupe-photo-431766-s-787x481.jpg'),
(48, 229, 42, '2013-ford-focus-st-5-door-test-mule-photo-435038-s-787x481.jpg'),
(49, 215, 1, '2013-ford-focus-st-photo-435047-s-787x481.jpg'),
(50, 248, 1, '14196144616768827_YOOOOO0O_2012-mercedes-benz-c63-amg-coupe-photo-431771-s-787x481jpg.jpg'),
(51, 248, 1, '14196144622315954_YOOOOO0O_2012-mercedes-benz-c63-amg-coupe-photo-431772-s-787x481jpg.jpg'),
(52, 248, 1, '14196144622047065_YOOOOO0O_2012-mercedes-benz-c63-amg-coupe-steering-wheel-photo-431777-s-787x481jpg.jpg'),
(53, 248, 1, '14196144654070987_YOOOOO0O_2012-mercedes-benz-c63-amg-coupe-tachometer-photo-431778-s-787x481jpg.jpg'),
(54, 248, 1, '14196144654387761_YOOOOO0O_2012-mercedes-benz-c63-amg-coupe-wheel-photo-431773-s-787x481jpg.jpg'),
(55, 247, 1, '1419614503147738_YOOOOOst_2012-bmw-m3-coupe-and-2012-mercedes-benz-c63-amg-coupe-photo-431768-s-787x481jpg.jpg'),
(56, 246, 1, '14196145397831372_YOOOOOsn_2012-mercedes-benz-c63-amg-coupe-photo-431770-s-787x481jpg.jpg'),
(57, 246, 1, '14196145408794236_YOOOOOsn_2012-mercedes-benz-c63-amg-coupe-photo-431771-s-787x481jpg.jpg'),
(58, 244, 1, '14196145737043590_YOOOOOsB_2013-subaru-xv-crosstrek-photo-434422-s-787x481jpg.jpg'),
(59, 244, 1, '1419614573471127_YOOOOOsB_2013-subaru-xv-crosstrek-photo-434421-s-787x481jpg.jpg'),
(60, 244, 1, '14196145761055123_YOOOOOsB_2013-subaru-xv-crosstrek-photo-434423-s-787x481jpg.jpg'),
(61, 243, 1, '14196146242410031_YOOOOOs9_2013-ford-focus-st-wagon-test-mule-photo-435034-s-787x481jpg.jpg'),
(62, 243, 1, '14196146241827646_YOOOOOs9_2013-ford-focus-st-wagon-test-mule-photo-435036-s-787x481jpg.jpg'),
(63, 243, 1, '14196146259194834_YOOOOOs9_2013-ford-focus-st-wagon-test-mule-photo-435037-s-787x481jpg.jpg'),
(64, 241, 1, '14196148043680274_YOOOOOsK_2013-ford-focus-st-wagon-test-mule-photo-435034-s-787x481jpg.jpg'),
(65, 241, 1, '14196148054716140_YOOOOOsK_2013-ford-focus-st-wagon-test-mule-photo-435036-s-787x481jpg.jpg'),
(66, 238, 1, '14196148891436295_YOOOOOs7_2013-ford-focus-st-photo-435045-s-787x481jpg.jpg'),
(67, 238, 1, '14196148893568868_YOOOOOs7_2013-ford-focus-st-photo-435046-s-787x481jpg.jpg'),
(68, 238, 1, '14196148901381537_YOOOOOs7_2013-ford-focus-st-photo-435047-s-787x481jpg.jpg'),
(69, 236, 1, '14196149193169965_YOOOOOsq_2012-bmw-m3-coupe-40-liter-v-8-engine-photo-431789-s-787x481jpg.jpg'),
(70, 236, 1, '14196149213296595_YOOOOOsq_2012-bmw-m3-coupe-badge-and-taillight-photo-431784-s-787x481jpg.jpg'),
(71, 236, 1, '14196149225196033_YOOOOOsq_2012-bmw-m3-coupe-and-2012-mercedes-benz-c63-amg-coupe-photo-431767-s-787x481jpg.jpg'),
(72, 235, 1, '14196149464239901_YOOOOOsm_2013-ford-focus-st-wagon-and-5-door-test-mules-photo-435039-s-787x481jpg.jpg'),
(73, 235, 1, '14196149479894477_YOOOOOsm_2013-ford-focus-st-wagon-test-mule-photo-435036-s-787x481jpg.jpg'),
(74, 235, 1, '14196149481885421_YOOOOOsm_2013-ford-focus-st-wagon-test-mule-photo-435037-s-787x481jpg.jpg'),
(75, 234, 1, '141961495778650_YOOOOOsl_slp-chevrolet-camaro-zl1-convertible-interior-photo-431755-s-787x481jpg.jpg'),
(76, 234, 1, '14196149574812969_YOOOOOsl_renault-megane-rs-volkswagen-gti-2013-ford-focus-st-5-door-and-wagon-test-mules-photo-435041-s-787x481jpg.jpg'),
(77, 234, 1, '14196149588864483_YOOOOOsl_slp-chevrolet-camaro-zl1-convertible-interior-photo-431756-s-787x481jpg.jpg'),
(80, 250, 2, '14213897986279602_YOOOOO0h_2012-bmw-m3-coupe-and-2012-mercedes-benz-c63-amg-coupe-photo-431767-s-787x481jpg.jpg'),
(79, 250, 3, '14213896468107910_YOOOOO0h_2012-bmw-m3-coupe-and-2012-mercedes-benz-c63-amg-coupe-photo-431768-s-787x481jpg.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `ma_vehicle_types`
--

CREATE TABLE IF NOT EXISTS `ma_vehicle_types` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `type_name` (`type_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `ma_vehicle_types`
--

INSERT INTO `ma_vehicle_types` (`ID`, `type_name`, `status`) VALUES
(1, 'SUV/4WD', 1),
(2, 'Sedan', 1),
(3, 'Wagon', 1),
(4, 'Hatchback', 1),
(5, 'Sport', 1),
(6, 'Mini Bus', 1),
(11, 'Bus 20+ Seats', 1),
(8, 'Pick-up', 1),
(9, 'Utility Van', 1),
(10, 'Truck', 1),
(12, 'Bus', 1),
(13, 'Van / Minivan', 1),
(21, 'Coupe', 1),
(22, 'Luxury Car', 1),
(23, 'Pickup Truck', 1),
(24, 'Sport Utility Vehicle', 1),
(25, 'Sports Car', 1),
(26, 'Van', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ma_widgets`
--

CREATE TABLE IF NOT EXISTS `ma_widgets` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `section_id` varchar(150) NOT NULL,
  `widget` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `section_id` (`widget`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ma_widgets`
--

INSERT INTO `ma_widgets` (`ID`, `section_id`, `widget`, `title`, `description`, `image`, `status`) VALUES
(1, 'footer_about_us', 'Footer About Us', 'About Marugo Autos', '<p><strong>Marugo Co. Ltd.</strong> is one of the oldest Japanese Used Cars company in Japan. It was established in 1970, more than 40 years ago.</p>\r\n\r\n<p>It was established in 1970, more than 40 years ago.</p>\r\n\r\n<p><a href="http://localhost/ma-autos.com/about-us">Read More</a></p>', '', 1),
(2, 'contact_widget', 'Contact Widget', 'Contact Us : MAA AUTOS', '<p>Contact Vehicle Exporter, Please feel free to contact with us for any questions you may have related to any vehicle you may want to purchase from us. Contact Vehicle Exporter, Please feel free to contact with us for any questions you may have related to any vehicle you may want to purchase from us. Contact Vehicle Exporter, Please feel free to contact with us for any questions you may have related to any vehicle you may want to purchase from us.</p>\n\n<p>Contact Vehicle Exporter, Please feel free to contact with us for any questions you may have related to any vehicle you may want to purchase from us. Contact Vehicle Exporter, Please feel free to contact with us for any questions you may have related to any vehicle you may want to purchase from us. Contact Vehicle Exporter, Please feel free to contact with us for any questions you may have related to any vehicle you may want to purchase from us.</p>', 'uploads/media/widget_image/contact-us.jpg', 1),
(6, 'request_a_call_back', 'Request a Call Back', 'Request a Call Back', '<p>Request a Call Back</p>', 'uploads/media/widget_image/request-a-call-back.jpg', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
