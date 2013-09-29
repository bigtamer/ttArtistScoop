-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2013 at 04:51 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ascoopdb`
--
CREATE DATABASE `ascoopdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ascoopdb`;

-- --------------------------------------------------------

--
-- Table structure for table `tblartist`
--

CREATE TABLE IF NOT EXISTS `tblartist` (
  `artistId` int(11) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `DOB` varchar(50) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `stageName` varchar(255) DEFAULT NULL,
  `preferedGenre` varchar(255) DEFAULT NULL,
  `interest` varchar(50) DEFAULT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `profilePhoto` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`artistId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblartist`
--

INSERT INTO `tblartist` (`artistId`, `gender`, `DOB`, `bio`, `stageName`, `preferedGenre`, `interest`, `experience`, `profilePhoto`, `featured`) VALUES
(11, 'F', '2007/3/9', 'best ting from rima', 'sexyness', 'Hip Hop', 'getting signed by hD', 'none', 'cy@hotmail.com_1365287756_cyart.png', 1),
(12, 'M', '2001/2/Day', 'best performa', 'gyalis', 'Soca', 'tryna make it big', 'worked with machel', 'jj@gmail.com_1365288632_2013-03-23 08.28.06.jpg', 1),
(13, '0', 'Yr/Mth/Day', 'straight from country', '', 'DanceHall', '', '', 'd@gmail.com_1365289340_2013-03-23 08.28.28.jpg', 1),
(14, 'M', '1998/5/3', 'kown for my wicked free styles', 'bounty', 'Soca', 'getting signed', 'none!!!!', 'john@gmail.com_1365462181_worst_vibez.jpg', 1),
(20, 'F', '1990/12/23', 'whats ma name?', 'lala', 'Rock', 'yuh fada', 'plenty', 'christy@ttas.com_1366422650_cyart.png', 0),
(22, 'M', '2004/1/2', 'lkjlj', 'ljlkjljljljlkjlj', 'Rap', 'lkjljlkj', 'lljljljljlj', 'tester@gmail.com_1366425972_100_0087.JPG', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblclcomment`
--

CREATE TABLE IF NOT EXISTS `tblclcomment` (
  `ClCommentid` int(11) NOT NULL AUTO_INCREMENT,
  `ClComment` varchar(255) DEFAULT NULL,
  `commenter` int(11) NOT NULL,
  `clause` int(11) NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `agree` tinyint(4) NOT NULL,
  PRIMARY KEY (`ClCommentid`),
  KEY `ClCommentid` (`ClCommentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `tblclcomment`
--

INSERT INTO `tblclcomment` (`ClCommentid`, `ClComment`, `commenter`, `clause`, `dateposted`, `agree`) VALUES
(128, 'changed the old terms', 15, 49, '2013-04-19 00:16:45', 1),
(129, 'changed', 15, 53, '2013-04-19 00:17:11', 1),
(151, 'this is boring', 21, 126, '2013-04-20 02:17:56', 2),
(152, 'this is boring', 21, 126, '2013-04-20 02:18:01', 2),
(154, 'yuh piggy smelly', 21, 127, '2013-04-20 02:18:28', 1),
(155, 'you suck', 21, 116, '2013-04-20 02:18:53', 2),
(158, 'ok', 20, 116, '2013-04-20 02:22:03', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblcontract`
--

CREATE TABLE IF NOT EXISTS `tblcontract` (
  `contractId` int(11) NOT NULL AUTO_INCREMENT,
  `drafter` int(11) NOT NULL,
  `participant` int(11) NOT NULL,
  `Ctype` int(11) NOT NULL,
  `dateDrafted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT NULL,
  `dateConfirmed` date DEFAULT NULL,
  PRIMARY KEY (`contractId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `tblcontract`
--

INSERT INTO `tblcontract` (`contractId`, `drafter`, `participant`, `Ctype`, `dateDrafted`, `status`, `dateConfirmed`) VALUES
(4, 15, 12, 1, '2013-04-15 17:09:05', 'accepted', '2013-04-18'),
(5, 15, 11, 1, '2013-04-16 19:40:59', 'accepted', '2013-04-18'),
(6, 15, 11, 1, '2013-04-17 15:50:50', 'accepted', '2013-04-18'),
(9, 15, 13, 1, '2013-04-19 00:18:10', 'pending', NULL),
(15, 16, 13, 1, '2013-04-19 19:25:49', 'accepted', '2013-04-20'),
(17, 21, 20, 1, '2013-04-20 02:08:45', 'pending', NULL),
(19, 21, 20, 2, '2013-04-20 02:10:51', 'accepted', '2013-04-20'),
(20, 21, 20, 2, '2013-04-20 02:15:00', 'pending', NULL),
(21, 21, 20, 1, '2013-04-20 02:15:12', 'accepted', '2013-04-20');

-- --------------------------------------------------------

--
-- Table structure for table `tblcritique`
--

CREATE TABLE IF NOT EXISTS `tblcritique` (
  `critiqueId` int(11) NOT NULL AUTO_INCREMENT,
  `lawyer` int(11) NOT NULL,
  `clause` int(11) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `agree` tinyint(4) NOT NULL,
  PRIMARY KEY (`critiqueId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tblcritique`
--

INSERT INTO `tblcritique` (`critiqueId`, `lawyer`, `clause`, `comment`, `agree`) VALUES
(5, 3, 37, 'go ahead', 1),
(6, 3, 38, 'na he mad', 2),
(10, 4, 49, 'ok good changes ', 1),
(11, 6, 121, 'this is shit', 2),
(12, 6, 124, 'crazyyyyy', 2),
(13, 6, 125, 'insane', 1),
(14, 6, 125, 'insane', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tblctype`
--

CREATE TABLE IF NOT EXISTS `tblctype` (
  `cTypeId` int(11) NOT NULL AUTO_INCREMENT,
  `cType` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`cTypeId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tblctype`
--

INSERT INTO `tblctype` (`cTypeId`, `cType`, `description`) VALUES
(1, 'Distribution ', 'Negotiates the supple of the artist''s music to the public, in this deal the artist would have the responsibility of all other cost associated with promotion etc.'),
(2, 'Production ', 'Deal that specifies the terms for production cost, normally includes terms brought forward by a producer');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomclause`
--

CREATE TABLE IF NOT EXISTS `tblcustomclause` (
  `clauseId` int(11) NOT NULL AUTO_INCREMENT,
  `contract` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `clause` longtext,
  `orderNum` int(11) DEFAULT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` date DEFAULT NULL,
  PRIMARY KEY (`clauseId`),
  KEY `contractId` (`contract`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=132 ;

--
-- Dumping data for table `tblcustomclause`
--

INSERT INTO `tblcustomclause` (`clauseId`, `contract`, `title`, `clause`, `orderNum`, `dateposted`, `dateUpdated`) VALUES
(31, 4, '1.Territory:', 'Caribbean with 1.9.1', 1, '2013-04-15 17:09:05', NULL),
(32, 4, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option; 12 1.9', 2, '2013-04-15 17:09:05', NULL),
(33, 4, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties. 12 1.9', 3, '2013-04-15 17:09:05', NULL),
(34, 4, '4. Royalties:', 'We shall pay to Artist all-in royalties Masters."12 1.9', 4, '2013-04-15 17:09:05', NULL),
(35, 4, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical12 1.9', 5, '2013-04-15 17:09:05', NULL),
(36, 4, '6. Release Commitment:', 'We agree to release each LP   12 1.9', 6, '2013-04-15 17:09:05', NULL),
(37, 5, '1.Territory:', 'The Universe, fgfg, fgfg 13', 1, '2013-04-16 19:40:59', NULL),
(38, 5, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option;13', 2, '2013-04-16 19:40:59', NULL),
(39, 5, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties.13', 3, '2013-04-16 19:40:59', NULL),
(40, 5, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of 13', 4, '2013-04-16 19:40:59', NULL),
(41, 5, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and CD-ROMS."13', 5, '2013-04-16 19:40:59', NULL),
(42, 5, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreement. "13', 6, '2013-04-16 19:40:59', NULL),
(43, 6, '1.Territory:', 'The World excluding;\r\n\r\nusa\r\n\r\ntrinidad', 1, '2013-04-17 15:50:50', NULL),
(44, 6, '2. Recording Commitment:', '(ii) We shall have the right to exercise the option at any time until the date [[ten (10)]] business days after our receipt of the Option Warning (the "Extension Period").\n\n(iii) The term of this Agreement shall continue until either the end of the Extension Period or our notice (the "Termination Notice") to you that we do not wish to exercise such option, whichever is sooner.\n\n(iv) For avoidance of doubt, nothing herein shall limit our right to send a Termination Notice to you at any time, nor limit our right to exercise an option at any time if you fail to send us an Option Warning in accordance with subparagraph (i) above.', 2, '2013-04-17 15:50:50', NULL),
(45, 6, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties.\r\n\r\n(a) [[LP1: $]] \r\n\r\n(b) Company will pay Artist [[one-half (1/2)]] of the [[LP 1]] Fund upon commencement of recording of the First LP, and the balance of the recording fund within [[thirty (30) days]] of your delivering to us the completed Masters. With respect to subsequent LPs required to be delivered hereunder, if any, the recording fund shall be equal to the greater of:\r\n\r\n(i) the applicable "minimum fund" set forth in subparagraph 3(c) hereof or, an amount which is the equivalent of sixty-six and two-thirds percent [[(66 2/3%)]] of the net earned artist royalties in respect of sales of royalty bearing units through normal retail channels in the United States of the immediately prior LP.\r\n\r\n(ii) No respective recording fund shall exceed the "maximum funds" set forth in subparagraph 3(c).\r\n\r\n(c) Recording fund advances for the Second LP shall be subject to the following minimums and maximums:\r\n\r\nLP  Minimum Maximum\r\n\r\nLP2 [[$]]   [[$]]\r\n\r\n[as applicable]\r\n\r\n(d) Company shall pay Artist one-half (1/2) of each recording fund advance upon commencement of recording for each respective LP. The balance of each respective recording fund advance will be payable to Artist within thirty (30) days of the delivery of each completed LP to Company.\r\n"', 3, '2013-04-17 15:50:50', NULL),
(46, 6, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of Company''s "net profits" in connection with its exploitation of the Masters delivered hereunder. The term "net profits" shall mean all gross income actually paid to Company in connection with its exploitation of such Masters less all expenses (excluding overhead only) paid or incurred by Company in connection with the exploitation, manufacture, sale, advertising, promotion and marketing of such Masters."', 4, '2013-04-17 15:50:50', NULL),
(47, 6, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and CD-ROMS."', 5, '2013-04-17 15:50:50', NULL),
(48, 6, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreement. "', 6, '2013-04-17 15:50:50', NULL),
(61, 9, '1.Territory:', 'The Universe"', 1, '2013-04-19 00:18:10', NULL),
(62, 9, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option;\r\n\r\n(b)[[ _____ (___) additional LPs]]. Company may exercise its option in respect of a particular LP at any time before the later of (i) [[eight (8) months]] after delivery of the prior LP or (ii) [[thirty (30) days]] after your written notice to Company of your request that we decide whether to exercise such option.\r\n\r\n(c) Notwithstanding anything to the contrary contained in paragraph 2(b) above, if we have not exercised our option for the next applicable LP as of the date by which we are required to exercise our option pursuant to paragraph 2(b) above, the following shall apply:\r\n\r\n(i) You shall send us written notice (an "Option Warning") that our option has not yet been exercised.\r\n\r\n(ii) We shall have the right to exercise the option at any time until the date [[ten (10)]] business days after our receipt of the Option Warning (the "Extension Period").\r\n\r\n(iii) The term of this Agreement shall continue until either the end of the Extension Period or our notice (the "Termination Notice") to you that we do not wish to exercise such option, whichever is sooner.\r\n\r\n(iv) For avoidance of doubt, nothing herein shall limit our right to send a Termination Notice to you at any time, nor limit our right to exercise an option at any time if you fail to send us an Option Warning in accordance with subparagraph (i) above.\r\n\r\n(d) During the term hereof, you shall record for us sufficient Masters to constitute [[one (1) twelve-inch, 33 and 1/3 rpm long-playing record or the equivalent]], of no less than [[forty (40) and no more than fifty (50) minutes in duration]], and such additional masters as we may request pursuant to paragraph 2(b) above to constitute the additional LPs of your recording commitment.\r\n\r\n"', 2, '2013-04-19 00:18:10', NULL),
(63, 9, '3. Advances/Recording Funds:', '(b) Company will pay Artist [[one-half (1/2)]] of the [[LP 1]] Fund upon commencement of recording of the First LP, and the balance of the recording fund within [[thirty (30) days]] of your delivering to us the completed Masters. With respect to subsequent LPs required to be delivered hereunder, if any, the recording fund shall be equal to the greater of:\n\n(i) the applicable "minimum fund" set forth in subparagraph 3(c) hereof or, an amount which is the equivalent of sixty-six and two-thirds percent [[(66 2/3%)]] of the net earned artist royalties in respect of sales of royalty bearing units through normal retail channels in the United States of the immediately prior LP.\n\n(ii) No respective recording fund shall exceed the "maximum funds" set forth in subparagraph 3(c).\n\n(c) Recording fund advances for the Second LP shall be subject to the following minimums and maximums:\n\nLP  Minimum Maximum\n\nLP2 [[$]]   [[$]]\n\n[as applicable]\n\n(d) Company shall pay Artist one-half (1/2) of each recording fund advance upon commencement of recording for each respective LP. The balance of each respective recording fund advance will be payable to Artist within thirty (30) days of the delivery of each completed LP to Company.\n"', 3, '2013-04-19 00:18:10', NULL),
(64, 9, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of Company''s "net profits" in connection with its exploitation of the Masters delivered hereunder. The term "net profits" shall mean all gross income actually paid to Company in connection with its exploitation of such Masters less all expenses (excluding overhead only) paid or incurred by Company in connection with the exploitation, manufacture, sale, advertising, promotion and marketing of such Masters."', 4, '2013-04-19 00:18:10', NULL),
(65, 9, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and CD-ROMS."', 5, '2013-04-19 00:18:10', NULL),
(66, 9, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreement. "', 6, '2013-04-19 00:18:10', NULL),
(93, 15, '1.Territory:', 'The Universe and them some more of them', 1, '2013-04-19 19:25:49', '2013-04-19'),
(94, 15, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option;\r\n\r\n(b)[[ _____ (___) additional LPs]]. Company may exercise its option in respect of a particular LP at any time before the later of (i) [[eight (8) months]] after delivery of the prior LP or (ii) [[thirty (30) days]] after your written notice to Company of your request that we decide whether to exercise such option.\r\n\r\n(c) Notwithstanding anything to the contrary contained in paragraph 2(b) above, if we have not exercised our option for the next applicable LP as of the date by which we are required to exercise our option pursuant to paragraph 2(b) above, the following shall apply:\r\n\r\n(i) You shall send us written notice (an "Option Warning") that our option has not yet been exercised.\r\n\r\n(ii) We shall have the right to exercise the option at any time until the date [[ten (10)]] business days after our receipt of the Option Warning (the "Extension Period").\r\n\r\n(iii) The term of this Agreement shall continue until either the end of the Extension Period or our notice (the "Termination Notice") to you that we do not wish to exercise such option, whichever is sooner.\r\n\r\n(iv) For avoidance of doubt, nothing herein shall limit our right to send a Termination Notice to you at any time, nor limit our right to exercise an option at any time if you fail to send us an Option Warning in accordance with subparagraph (i) above.\r\n\r\n(d) During the term hereof, you shall record for us sufficient Masters to constitute [[one (1) twelve-inch, 33 and 1/3 rpm long-playing record or the equivalent]], of no less than [[forty (40) and no more than fifty (50) minutes in duration]], and such additional masters as we may request pursuant to paragraph 2(b) above to constitute the additional LPs of your recording commitment.\r\n\r\n"', 2, '2013-04-19 19:25:49', NULL),
(95, 15, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties.\r\n\r\n(a) [[LP1: $]] \r\n\r\n(b) Company will pay Artist [[one-half (1/2)]] of the [[LP 1]] Fund upon commencement of recording of the First LP, and the balance of the recording fund within [[thirty (30) days]] of your delivering to us the completed Masters. With respect to subsequent LPs required to be delivered hereunder, if any, the recording fund shall be equal to the greater of:\r\n\r\n(i) the applicable "minimum fund" set forth in subparagraph 3(c) hereof or, an amount which is the equivalent of sixty-six and two-thirds percent [[(66 2/3%)]] of the net earned artist royalties in respect of sales of royalty bearing units through normal retail channels in the United States of the immediately prior LP.\r\n\r\n(ii) No respective recording fund shall exceed the "maximum funds" set forth in subparagraph 3(c).\r\n\r\n(c) Recording fund advances for the Second LP shall be subject to the following minimums and maximums:\r\n\r\nLP  Minimum Maximum\r\n\r\nLP2 [[$]]   [[$]]\r\n\r\n[as applicable]\r\n\r\n(d) Company shall pay Artist one-half (1/2) of each recording fund advance upon commencement of recording for each respective LP. The balance of each respective recording fund advance will be payable to Artist within thirty (30) days of the delivery of each completed LP to Company.\r\n"', 3, '2013-04-19 19:25:49', NULL),
(96, 15, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of Company''s "net profits" in connection with its exploitation of the Masters delivered hereunder. The term "net profits" shall mean all gross income actually paid to Company in connection with its exploitation of such Masters less all expenses (excluding overhead only) paid or incurred by Company in connection with the exploitation, manufacture, sale, advertising, promotion and marketing of such Masters."', 4, '2013-04-19 19:25:49', NULL),
(97, 15, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and CD-ROMS."', 5, '2013-04-19 19:25:49', NULL),
(98, 15, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreement. "', 6, '2013-04-19 19:25:49', NULL),
(105, 17, '1.Territory:', 'The Universe" 1', 1, '2013-04-20 02:08:45', '2013-04-20'),
(106, 17, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option;\n\n(b)[[ _____ (___) additional LPs]]. Company may exercise its option in respect of a particular LP at any time before the later of (i) [[eight (8) months]] after delivery of the prior LP or (ii) [[thirty (30) days]] after your written notice to Company of your request that we decide whether to exercise such option.\n\n(c) Notwithstanding anything to the contrary contained in paragraph 2(b) above, if we have not exercised our option for the next applicable LP as of the date by which we are required to exercise our option pursuant to paragraph 2(b) above, the following shall apply:2', 2, '2013-04-20 02:08:45', '2013-04-20'),
(107, 17, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties.\n\n(a) [[LP1: $]] \n\n(b) Company will pay Artist [[one-half (1/2)]] of the [[LP 1]] Fund upon commencement of recording of the First LP, and the balance of the recording fund within [[thirty (30) days]] of your delivering to us the completed Masters. With respect to subsequent LPs required to be delivered hereunder, if any, the recording fund shall be equal to the greater of:\n\n(i) the applicable "minimum fund" set forth in subparagraph 3(c) hereof or, an amount which is the equivalent of sixty-six and two-thirds percent [[(66 2/3%)]] of the net earned artist royalties in respect of sales of royalty bearing units through normal retail channels in the United States of the immediately prior LP.\n\n(ii) No respective recording fund shall exceed the "maximum funds" set forth in subparagraph 3(c).\n\n(c) Recording fund advances for the Second LP shall be subject to the following minimums and maximums:3', 3, '2013-04-20 02:08:45', '2013-04-20'),
(108, 17, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of Company''s "net profits" in connection with its exploitation of the Masters delivered hereunder. The term "net profits" shall mean all gross income actually paid to Company in connection with its exploitation of such Masters less all expenses (excluding overhead only) paid or incurred by Company in connection with the exploitation,4', 4, '2013-04-20 02:08:45', '2013-04-20'),
(109, 17, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and5', 5, '2013-04-20 02:08:45', '2013-04-20'),
(110, 17, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreeme6', 6, '2013-04-20 02:08:45', '2013-04-20'),
(116, 19, '1. Accountings:', '(a) Statements as to royalties and other sums payable hereunder shall be sent by us to you on a semi-annual basis, within ninety (90) days after each June 30 and December 31 of each year during which records are sold and paid for. The statements shall be accompanied by a payment of accrued sums, if any, for the applicable accounting period,', 1, '2013-04-20 02:10:51', '2013-04-20'),
(117, 19, '2. Videos:', 'Fifty percent (50%) of the costs accrued in the production of video recordings utilizing the Master recordings hereunder shall be recoupable from artist royalties earned by Artist. Such recoupment may be cross-collateralized with artist royalties earned from any LP or project hereunder. All decisions regarding the production, distribution, and manufacture of video recordings, including but not limited to budgets, schedules, locations, and production staff, shall be mutually agreed upon by Company and Artist, provided, however in cases of disagreement, Company''s decision shall be controlling. Without limiting the generality of paragraph 5 above, Artist will', 2, '2013-04-20 02:10:51', '2013-04-20'),
(118, 19, '3. Warranties, Representation & Indemnities:', '(b) Company shall not be required to make any payments of any nature for or in connection with the exercise of rights by Company pursuant to this Agreement except as specifically provided in this Agreement.\n\n(c) No materials submitted by Artist for any use hereunder, including master recordings and the musical compositions embodied thereon, will violate any law or infringe upon or violate the rights of any other person. Without limitation of the foregoing sentence, Artist shall not incorporate any so-called "samples" or any other unauthorized material in any master recordings or musical compositions delivered to Company hereunder unless Artist has received written clearances satisfactory to Company from all applicable third parties and promptly furnished copies of such clearances to Company.', 3, '2013-04-20 02:10:51', '2013-04-20'),
(119, 19, '4. Unique Services:', 'You expressly acknowledge that your services hereunder are of special, unique and intellectual character which gives them peculiar value and that in the event of a breach by you of any term, condition, or covenant hereof we will be caused irreparable injury. You expressly agree that in the event you shall breach any provision of this contract, we shall be entitled to seek any and all remedies provided', 4, '2013-04-20 02:10:51', '2013-04-20'),
(120, 19, '5. Governing Law:', 'This contract has been entered into in the State of New York and its validity, construction, interpretation and legal effect shall be governed by the laws of such State of applicable to contracts entered', 5, '2013-04-20 02:10:51', '2013-04-20'),
(121, 20, '1. Accountings:', '(a) Statements as to royalties and other sums payable hereunder shall be sent by us to you on a semi-annual basis, within ninety (90) days after each June 30 and December 31 of each year during which records are sold and paid for. The statements shall be accompanied by a payment of accrued sums, if any, for the applicable accounting period, less all recoupable advances or charges under this contract. We shall have the right to retain, as a reserve against charges, credits, or returns, such portion of payable royalties as shall be in our best business judgment. We further agree that a base reserve established in a particular accounting period shall be liquidated as sales over the following four (4) accounting periods. At such time as a reserve is liquidated, it shall be deemed to be a sale in the period in which it was liquidated.\r\n\r\n(b) You shall be deemed to have consented to all royalty statements and all other accountings rendered by us hereunder and each such royalty statement or other accounting shall be conclusive, final, and binding, shall constitute an account stated, and shall not be subject to any objection for any reason whatsoever unless specific objection in writing, stating the basis thereof, is given by you to us within two years (2) years after the date rendered. No action, suit or proceeding of any nature in respect of any royalty "', 1, '2013-04-20 02:15:00', NULL),
(122, 20, '2. Videos:', 'Fifty percent (50%) of the costs accrued in the production of video recordings utilizing the Master recordings hereunder shall be recoupable from artist royalties earned by Artist. Such recoupment may be cross-collateralized with artist royalties earned from any LP or project hereunder. All decisions regarding the production, distribution, and manufacture of video recordings, including but not limited to budgets, schedules, locations, and production staff, shall be mutually agreed upon by Company and Artist, provided, however in cases of disagreement, Company''s decision shall be controlling. Without limiting the generality of paragraph 5 above, Artist will grant free synchronization licenses to Company for all Controlled Corporations used in videos. Company shall not be obligated to produce videos hereunder. \r\n\r\nWe shall have the right to release for sale compilation videos containing any video recordings created by you and us hereunder, and we agree that the royalty payable to you in respect of said compilation shall be no less favorable than the royalty payable to any other artist whose performance is contained on the applicable compilation."', 2, '2013-04-20 02:15:00', NULL),
(123, 20, '3. Warranties, Representation & Indemnities:', 'You warrant and represent:\r\n\r\n(a) You have the right and power to enter into and fully perform this agreement.\r\n\r\n(b) Company shall not be required to make any payments of any nature for or in connection with the exercise of rights by Company pursuant to this Agreement except as specifically provided in this Agreement.\r\n\r\n(c) No materials submitted by Artist for any use hereunder, including master recordings and the musical compositions embodied thereon, will violate any law or infringe upon or violate the rights of any other person. Without limitation of the foregoing sentence, Artist shall not incorporate any so-called "samples" or any other unauthorized material in any master recordings or musical compositions delivered to Company hereunder unless Artist has received written clearances satisfactory to Company from all applicable third parties and promptly furnished copies of such clearances to Company.\r\n\r\n(d) Artist will at all times indemnify and hold Company harmless from and against any and all claims or damages arising out of any breach by Artist of any warranty or representation made herein. Pending the resolution of any such claim, Company shall be entitled to withhold payment of any royalties payable to Artist."', 3, '2013-04-20 02:15:00', NULL),
(124, 20, '4. Unique Services:', 'You expressly acknowledge that your services hereunder are of special, unique and intellectual character which gives them peculiar value and that in the event of a breach by you of any term, condition, or covenant hereof we will be caused irreparable injury. You expressly agree that in the event you shall breach any provision of this contract, we shall be entitled to seek any and all remedies provided in such event by law or equity, in addition to any other rights or remedies available to us."', 4, '2013-04-20 02:15:00', NULL),
(125, 20, '5. Governing Law:', 'This contract has been entered into in the State of New York and its validity, construction, interpretation and legal effect shall be governed by the laws of such State of applicable to contracts entered into and performed entirely therein.\r\n	\r\nPlease sign this letter where indicated to confirm your agreement to the foregoing. This letter when signed by you and Company shall constitute a binding agreement. We intend to prepare a more formal agreement incorporating the foregoing material terms and all such other terms and conditions, but until such time, if ever, as such a more formal agreement shall have been executed by the parties, this shall constitute a binding agreement."', 5, '2013-04-20 02:15:00', NULL),
(126, 21, '1.Territory:', 'The Universe"', 1, '2013-04-20 02:15:12', NULL),
(127, 21, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option\n(c) Notwithstanding anything to the contrary contained in paragraph 2(b) above, if we have not exercised our option for the next applicable LP as of the date by which we are required to exercise our option pursuant to paragraph 2(b) above, the following shall apply:\n\n(i) You shall send us written notice (an "Option Warning") that our option has not yet been exercised.\n\n(ii) We shall have the right to exercise the option at any time until the date [[ten (10)]] business days after our receipt of the Option Warning (the "Extension Period").\n\n(iii) The term of this Agreement shall continue until either the end of the Extension Period or our notice (the "Termination Notice") to you that we do not wish to exercise such option, whichever is sooner.\n\n(iv) For avoidance of doubt, nothing herein shall limit our right to send a Termination Notice to you at any time, nor limit our right to exercise an option at any time if you fail to send us an Option Warning in accordance with subparagraph (i) above.\n\n(d) During the term hereof, you shall record for us sufficient Masters to constitute [[one (1) twelve-inch, 33 and 1/3 rpm long-playing record or the equivalent]], of no less than [[forty (40) and no more than fifty (50) minutes in duration]], and such additional masters as we may request pursuant to paragraph 2(b) above to constitute the additional LPs of your recording commitment.\n\n"', 2, '2013-04-20 02:15:12', '2013-04-20'),
(128, 21, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties.\r\n\r\n(a) [[LP1: $]] \r\n\r\n(b) Company will pay Artist [[one-half (1/2)]] of the [[LP 1]] Fund upon commencement of recording of the First LP, and the balance of the recording fund within [[thirty (30) days]] of your delivering to us the completed Masters. With respect to subsequent LPs required to be delivered hereunder, if any, the recording fund shall be equal to the greater of:\r\n\r\n(i) the applicable "minimum fund" set forth in subparagraph 3(c) hereof or, an amount which is the equivalent of sixty-six and two-thirds percent [[(66 2/3%)]] of the net earned artist royalties in respect of sales of royalty bearing units through normal retail channels in the United States of the immediately prior LP.\r\n\r\n(ii) No respective recording fund shall exceed the "maximum funds" set forth in subparagraph 3(c).\r\n\r\n(c) Recording fund advances for the Second LP shall be subject to the following minimums and maximums:\r\n\r\nLP  Minimum Maximum\r\n\r\nLP2 [[$]]   [[$]]\r\n\r\n[as applicable]\r\n\r\n(d) Company shall pay Artist one-half (1/2) of each recording fund advance upon commencement of recording for each respective LP. The balance of each respective recording fund advance will be payable to Artist within thirty (30) days of the delivery of each completed LP to Company.\r\n"', 3, '2013-04-20 02:15:12', NULL),
(129, 21, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of Company''s "net profits" in connection with its exploitation of the Masters delivered hereunder. The term "net profits" shall mean all gross income actually paid to Company in connection with its exploitation of such Masters less all expenses (excluding overhead only) paid or incurred by Company in connection with the exploitation, manufacture, sale, advertising, promotion and marketing of such Masters."', 4, '2013-04-20 02:15:12', NULL),
(130, 21, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and CD-ROMS."', 5, '2013-04-20 02:15:12', NULL),
(131, 21, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreement. "', 6, '2013-04-20 02:15:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblgenre`
--

CREATE TABLE IF NOT EXISTS `tblgenre` (
  `genreId` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`genreId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tblgenre`
--

INSERT INTO `tblgenre` (`genreId`, `genre`, `description`) VALUES
(1, 'Soca', NULL),
(2, 'Reggae', NULL),
(3, 'DanceHall', NULL),
(4, 'Hip Hop', NULL),
(5, 'Rap', NULL),
(6, 'R&B', NULL),
(7, 'Alternative', NULL),
(8, 'Rock', NULL),
(9, 'Country', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbllabel`
--

CREATE TABLE IF NOT EXISTS `tbllabel` (
  `labelId` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `companyName` varchar(255) DEFAULT NULL,
  `companyContact` varchar(255) DEFAULT NULL,
  `companyEmail` varchar(255) DEFAULT NULL,
  `companyLetterHead` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`labelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbllabel`
--

INSERT INTO `tbllabel` (`labelId`, `address`, `companyName`, `companyContact`, `companyEmail`, `companyLetterHead`) VALUES
(9, '4 De''Verteuil Street WoodBrook', '', '', '', 'test@ttas.com_1365204353_'),
(15, '4 Best Drive West', 'best music rage', '6222222', 'bml@gmail.com', 'jdoe@gmail.com_1365480093_2013-03-23 09.02.23.png'),
(16, '5 Buller Street WoodBrook', 'jane Sounds ltd', '628 1406', 'janeDoeltd@.com', 'janeDoe@gmail.com_1365707909_2013-03-23 08.41.11.jpg'),
(17, '50 woodbrook street, woodbrook', 'JT Records', '6281406', 'jtr@gmail.com', 'jt@gmail.com_1366150588_worst_vibez.jpg'),
(21, '146 east west north south', 'superpharm', '6451234', 'superpharm@gmail.com', 'carin@ttas.com_1366423322_2013-03-23 08.37.04.jpg'),
(23, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbllawyer`
--

CREATE TABLE IF NOT EXISTS `tbllawyer` (
  `lawyerId` int(11) NOT NULL AUTO_INCREMENT,
  `client` int(11) NOT NULL,
  `userType` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` tinyint(255) DEFAULT NULL,
  PRIMARY KEY (`lawyerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tbllawyer`
--

INSERT INTO `tbllawyer` (`lawyerId`, `client`, `userType`, `email`, `password`, `status`) VALUES
(3, 11, 4, 'jack@gmail.com', '20055', 1),
(4, 12, 4, 'jimbo@gmail.com', '42', 1),
(6, 21, 4, 'melissa@ttas.com', '1503', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsample`
--

CREATE TABLE IF NOT EXISTS `tblsample` (
  `sampleId` int(11) NOT NULL AUTO_INCREMENT,
  `genre` int(11) NOT NULL,
  `uploader` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT '0',
  `dateadded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`sampleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `tblsample`
--

INSERT INTO `tblsample` (`sampleId`, `genre`, `uploader`, `title`, `description`, `featured`, `dateadded`, `url`) VALUES
(28, 1, 12, 'Justin Timberlake - Mirrors', '', 0, '2013-04-19 22:49:57', 'http://www.youtube.com/embed/uuZE_IRwLNI'),
(30, 2, 20, 'Busy Signal - Come Over (Missing You)(Official HD ', '', 0, '2013-04-20 01:54:32', 'http://www.youtube.com/embed/inb2IrBrr40'),
(31, 5, 20, 'Secretary', '', 0, '2013-04-20 01:55:31', 'http://www.youtube.com/embed/rhVasc60rRE');

-- --------------------------------------------------------

--
-- Table structure for table `tblscomment`
--

CREATE TABLE IF NOT EXISTS `tblscomment` (
  `SCommentid` int(11) NOT NULL AUTO_INCREMENT,
  `SComment` varchar(255) DEFAULT NULL,
  `commenter` int(11) NOT NULL,
  `sample` int(11) NOT NULL,
  `dateposted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`SCommentid`),
  KEY `SCommentid` (`SCommentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tblscomment`
--

INSERT INTO `tblscomment` (`SCommentid`, `SComment`, `commenter`, `sample`, `dateposted`) VALUES
(28, 'love this', 20, 30, '2013-04-20 01:55:44'),
(30, 'yu mad', 20, 31, '2013-04-20 01:56:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbltemplateclause`
--

CREATE TABLE IF NOT EXISTS `tbltemplateclause` (
  `templateId` int(11) NOT NULL AUTO_INCREMENT,
  `cType` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `clause` longtext,
  `clauseTip` varchar(255) DEFAULT NULL,
  `orderNum` int(11) DEFAULT NULL,
  PRIMARY KEY (`templateId`),
  KEY `cType` (`cType`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbltemplateclause`
--

INSERT INTO `tbltemplateclause` (`templateId`, `cType`, `title`, `clause`, `clauseTip`, `orderNum`) VALUES
(1, 1, '1.Territory: ', 'The Universe', 'countries, regions in which the artist music will be distributed', 1),
(2, 1, '2. Recording Commitment:', '(a) [[One(1)]] LP [[("LP 1")]], plus, at our option;\r\n\r\n(b)[[ _____ (___) additional LPs]]. Company may exercise its option in respect of a particular LP at any time before the later of (i) [[eight (8) months]] after delivery of the prior LP or (ii) [[thirty (30) days]] after your written notice to Company of your request that we decide whether to exercise such option.\r\n\r\n(c) Notwithstanding anything to the contrary contained in paragraph 2(b) above, if we have not exercised our option for the next applicable LP as of the date by which we are required to exercise our option pursuant to paragraph 2(b) above, the following shall apply:\r\n\r\n(i) You shall send us written notice (an "Option Warning") that our option has not yet been exercised.\r\n\r\n(ii) We shall have the right to exercise the option at any time until the date [[ten (10)]] business days after our receipt of the Option Warning (the "Extension Period").\r\n\r\n(iii) The term of this Agreement shall continue until either the end of the Extension Period or our notice (the "Termination Notice") to you that we do not wish to exercise such option, whichever is sooner.\r\n\r\n(iv) For avoidance of doubt, nothing herein shall limit our right to send a Termination Notice to you at any time, nor limit our right to exercise an option at any time if you fail to send us an Option Warning in accordance with subparagraph (i) above.\r\n\r\n(d) During the term hereof, you shall record for us sufficient Masters to constitute [[one (1) twelve-inch, 33 and 1/3 rpm long-playing record or the equivalent]], of no less than [[forty (40) and no more than fifty (50) minutes in duration]], and such additional masters as we may request pursuant to paragraph 2(b) above to constitute the additional LPs of your recording commitment.\r\n\r\n', 'specifies recording commitments, special attention to #of LPs and duration of delievery', 2),
(3, 1, '3. Advances/Recording Funds:', 'We will provide the following recording funds (inclusive of all producer advances and recording costs), which shall be recoupable from any and all royalties.\r\n\r\n(a) [[LP1: $]] \r\n\r\n(b) Company will pay Artist [[one-half (1/2)]] of the [[LP 1]] Fund upon commencement of recording of the First LP, and the balance of the recording fund within [[thirty (30) days]] of your delivering to us the completed Masters. With respect to subsequent LPs required to be delivered hereunder, if any, the recording fund shall be equal to the greater of:\r\n\r\n(i) the applicable "minimum fund" set forth in subparagraph 3(c) hereof or, an amount which is the equivalent of sixty-six and two-thirds percent [[(66 2/3%)]] of the net earned artist royalties in respect of sales of royalty bearing units through normal retail channels in the United States of the immediately prior LP.\r\n\r\n(ii) No respective recording fund shall exceed the "maximum funds" set forth in subparagraph 3(c).\r\n\r\n(c) Recording fund advances for the Second LP shall be subject to the following minimums and maximums:\r\n\r\nLP  Minimum Maximum\r\n\r\nLP2 [[$]]   [[$]]\r\n\r\n[as applicable]\r\n\r\n(d) Company shall pay Artist one-half (1/2) of each recording fund advance upon commencement of recording for each respective LP. The balance of each respective recording fund advance will be payable to Artist within thirty (30) days of the delivery of each completed LP to Company.\r\n', 'specifies Advances/Recording Funds, place close attention to earnings percentages and LPs min & max $ ', 3),
(4, 1, '4. Royalties:', 'We shall pay to Artist all-in royalties (i.e., inclusive of producer and artist royalties) in the amount of fifty [[(50%)]] percent of Company''s "net profits" in connection with its exploitation of the Masters delivered hereunder. The term "net profits" shall mean all gross income actually paid to Company in connection with its exploitation of such Masters less all expenses (excluding overhead only) paid or incurred by Company in connection with the exploitation, manufacture, sale, advertising, promotion and marketing of such Masters.', 'specifies royalty payments, close attention to % of net profits', 4),
(5, 1, '5. Musical Compositions:', 'Artist hereby waives its right to receive mechanical royalties in connection with the exploitation of Masters hereunder, and Artist hereby grants to Company a license for the use of the musical compositions written by Artist and embodied on the Masters free of charge with respect to all exploitations of the Masters pursuant to this Agreement, including, but not limited to, the mechanical reproduction of such musical compositions on audio-only records, audio-visual recordings and CD-ROMS.', 'specifies musical composition right, close attention to licence granted line 2 ', 5),
(6, 1, '6. Release Commitment:', 'We agree to release each LP hereunder in the United States within one hundred and [[twenty (120) days]] after your delivery to us of such LP in satisfactory form, together with all requisite accompanying materials (the "U.S. Release Period"). In the event that we fail to release said record in the United States during the U.S. Release Period, you shall give us notice thereof. If we fail to release such LP within [[sixty (60) days]] after we receive such notice, you shall have the right to terminate this agreement. ', 'specifies Release Commitment, close attention to durations', 6),
(7, 2, '1. Accountings:', '(a) Statements as to royalties and other sums payable hereunder shall be sent by us to you on a semi-annual basis, within ninety (90) days after each June 30 and December 31 of each year during which records are sold and paid for. The statements shall be accompanied by a payment of accrued sums, if any, for the applicable accounting period, less all recoupable advances or charges under this contract. We shall have the right to retain, as a reserve against charges, credits, or returns, such portion of payable royalties as shall be in our best business judgment. We further agree that a base reserve established in a particular accounting period shall be liquidated as sales over the following four (4) accounting periods. At such time as a reserve is liquidated, it shall be deemed to be a sale in the period in which it was liquidated.\r\n\r\n(b) You shall be deemed to have consented to all royalty statements and all other accountings rendered by us hereunder and each such royalty statement or other accounting shall be conclusive, final, and binding, shall constitute an account stated, and shall not be subject to any objection for any reason whatsoever unless specific objection in writing, stating the basis thereof, is given by you to us within two years (2) years after the date rendered. No action, suit or proceeding of any nature in respect of any royalty ', 'specifies accounting information ', 1),
(8, 2, '2. Videos:', 'Fifty percent (50%) of the costs accrued in the production of video recordings utilizing the Master recordings hereunder shall be recoupable from artist royalties earned by Artist. Such recoupment may be cross-collateralized with artist royalties earned from any LP or project hereunder. All decisions regarding the production, distribution, and manufacture of video recordings, including but not limited to budgets, schedules, locations, and production staff, shall be mutually agreed upon by Company and Artist, provided, however in cases of disagreement, Company''s decision shall be controlling. Without limiting the generality of paragraph 5 above, Artist will grant free synchronization licenses to Company for all Controlled Corporations used in videos. Company shall not be obligated to produce videos hereunder. \r\n\r\nWe shall have the right to release for sale compilation videos containing any video recordings created by you and us hereunder, and we agree that the royalty payable to you in respect of said compilation shall be no less favorable than the royalty payable to any other artist whose performance is contained on the applicable compilation.', 'specifies cost & payments for videos', 2),
(9, 2, '3. Warranties, Representation & Indemnities:', 'You warrant and represent:\r\n\r\n(a) You have the right and power to enter into and fully perform this agreement.\r\n\r\n(b) Company shall not be required to make any payments of any nature for or in connection with the exercise of rights by Company pursuant to this Agreement except as specifically provided in this Agreement.\r\n\r\n(c) No materials submitted by Artist for any use hereunder, including master recordings and the musical compositions embodied thereon, will violate any law or infringe upon or violate the rights of any other person. Without limitation of the foregoing sentence, Artist shall not incorporate any so-called "samples" or any other unauthorized material in any master recordings or musical compositions delivered to Company hereunder unless Artist has received written clearances satisfactory to Company from all applicable third parties and promptly furnished copies of such clearances to Company.\r\n\r\n(d) Artist will at all times indemnify and hold Company harmless from and against any and all claims or damages arising out of any breach by Artist of any warranty or representation made herein. Pending the resolution of any such claim, Company shall be entitled to withhold payment of any royalties payable to Artist.', 'important warranty information ', 3),
(10, 2, '4. Unique Services:', 'You expressly acknowledge that your services hereunder are of special, unique and intellectual character which gives them peculiar value and that in the event of a breach by you of any term, condition, or covenant hereof we will be caused irreparable injury. You expressly agree that in the event you shall breach any provision of this contract, we shall be entitled to seek any and all remedies provided in such event by law or equity, in addition to any other rights or remedies available to us.', 'mandatory services available to the artist', 4),
(11, 2, '5. Governing Law:', 'This contract has been entered into in the State of New York and its validity, construction, interpretation and legal effect shall be governed by the laws of such State of applicable to contracts entered into and performed entirely therein.\r\n	\r\nPlease sign this letter where indicated to confirm your agreement to the foregoing. This letter when signed by you and Company shall constitute a binding agreement. We intend to prepare a more formal agreement incorporating the foregoing material terms and all such other terms and conditions, but until such time, if ever, as such a more formal agreement shall have been executed by the parties, this shall constitute a binding agreement.', 'laws and regulations specific to region', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `dSigniture` varchar(255) DEFAULT NULL,
  `userType` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `dateAdded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`userid`, `firstName`, `lastName`, `email`, `password`, `dSigniture`, `userType`, `active`, `dateAdded`) VALUES
(9, 'jesse', 'tamer', 'test@ttas.com', '098f6bcd4621d373cade4e832627b4f6', '', 2, 1, '2013-04-05 23:25:53'),
(11, 'cyanne', 'ali', 'cy@hotmail.com', '67a39629f96c4aa5ee9b660ce1b38abc', 'cy@hotmail.com_1365287756.jpg', 3, 1, '2013-04-06 22:35:56'),
(12, 'jesse', 'james', 'jj@gmail.com', 'a1361cb85be840d6a2d762c68e4910e2', '', 3, 1, '2013-04-06 22:50:32'),
(13, 'daniel', 'tamer', 'd@gmail.com', 'aa47f8215c6f30a0dcdb2a36a9f4168e', '', 3, 1, '2013-04-06 23:02:20'),
(14, 'john', 'creece', 'john@gmail.com', '527bd5b5d689e2c32ae974c6229ff785', '', 3, 1, '2013-04-08 23:03:01'),
(15, 'john', 'doe', 'jdoe@ttas.com', 'a31405d272b94e5d12e9a52a665d3bfe', 'jdoe@gmail.com_1365480093.jpg', 2, 1, '2013-04-09 04:01:33'),
(16, 'jane', 'doe', 'janeDoe@gmail.com', '5844a15e76563fedd11840fd6f40ea7b', '', 2, 1, '2013-04-11 19:18:29'),
(17, 'jesse', 'jackson', 'jt@gmail.com', 'a1361cb85be840d6a2d762c68e4910e2', '', 2, 0, '2013-04-16 22:16:28'),
(20, 'christy', 'lala', 'christy@ttas.com', 'e2f48e57eebb4d0158e25ab3408ea4ea', 'christy@ttas.com_1366422650_true love.jpg', 3, 1, '2013-04-20 01:50:50'),
(21, 'carin', 'lolo', 'carin@ttas.com', '3906ae213a66b7e80f6d7f48c7fa8f8e', 'carin@ttas.com_1366423322_2013-03-23 08.42.53.png', 2, 1, '2013-04-20 02:02:02'),
(22, 'ljlj', 'ljljljklkj', 'tester@gmail.com', 'f5d1278e8109edd94e1e4197e04873b9', 'tester@gmail.com_1366425972_100_0110.JPG', 3, 1, '2013-04-20 02:46:12'),
(23, 'ljljl', 'lkjlkjljl', 'test@g.com', '098f6bcd4621d373cade4e832627b4f6', 'test@g.com_1366426150_100_0111.JPG', 2, 0, '2013-04-20 02:49:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblusertype`
--

CREATE TABLE IF NOT EXISTS `tblusertype` (
  `utypeid` int(11) NOT NULL AUTO_INCREMENT,
  `usertype` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`utypeid`),
  KEY `usertype` (`usertype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tblusertype`
--

INSERT INTO `tblusertype` (`utypeid`, `usertype`, `description`) VALUES
(1, 'Admin', 'Administrator of website'),
(2, 'Label', 'Executive user responsible for drafting contracts'),
(3, 'Artist', 'User responsible for adding samples to be assessed by execs'),
(4, 'lawyer', 'views and adds comments for clients negotions');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
