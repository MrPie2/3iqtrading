-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 25, 2023 at 09:37 PM
-- Server version: 5.7.40-cll-lve
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ardanint_datadb`
--

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `Page_Name` varchar(255) NOT NULL,
  `Page_Contents` longtext NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `Page_Name`, `Page_Contents`, `Status`) VALUES
(1, 'Home', '', 0),
(4, 'FAQ', '', 0),
(8, 'About', '<p><img src=\"https://www.macquarie-holding.com/Resources/hero-landing-about.jpeg\" style=\"width: 100%;\"/></p><div style=\"padding: 30px\"><h2 style=\"color: rgb(0, 0, 0);\"><br/></h2><h2><font color=\"#f3310d\">Our organisation</font></h2><p><font color=\"#020202\">Macquarie is a global financial services group operating in 34 markets in asset management, retail and business banking, wealth management, leasing and asset financing, market access, commodity trading, renewables development, specialist advisory, capital raising and principal investment.</font></p><p><font color=\"#020202\">The diversity of our operations, combined with a strong capital position and robust risk management framework, has contributed to our 53-year record of unbroken profitability.</font></p><p><br/></p><h4><font color=\"#000000\">At Macquarie our purpose and principles guide our actions. These form part of our Code of Conduct, which sets out the way our people are expected to do business.</font></h4><h4><br/></h4><h3><font color=\"#f1320e\">Our purpose</font></h3><p><br/></p><h4 style=\"color: rgb(0, 0, 0);\">Empowering people to innovate and invest for a better future.</h4><p style=\"color: rgb(0, 0, 0);\">Our purpose represents<span>Â </span><i>why</i><span>Â </span>we exist and<span>Â </span><i>what</i><span>Â </span>we do. We believe that by empowering people - our colleagues, clients, communities, shareholders and partners â€“ we will achieve our shared potential.</p><p style=\"color: rgb(0, 0, 0);\"><br/></p><h3><font color=\"#f3310d\">Our principles</font></h3><p style=\"color: rgb(0, 0, 0);\">Macquarieâ€™s purpose is enabled by three long-held principles that explain<span>Â </span><i>how</i><span>Â </span>we do business.</p><p style=\"color: rgb(0, 0, 0);\"><br/></p><div class=\"row\"><div class=\"col-md-4\"><h2>Opportunity</h2><br/>We seek to identify opportunity and realise it for our clients, communities, partners, shareholders and our people. We start with real knowledge and skill.We encourage innovation, ingenuity and entrepreneurial spirit balanced with operational discipline. We support our people to learn, achieve and succeed. Our success is built on this.We value the opportunity to be part of the Macquarie team, actively seeking out and respecting different ways of thinking and the contribution of others.</div><div class=\"col-md-4\"><h2>Accountability</h2><br/>With opportunity, comes accountability.We are accountable for all our actions, to our stakeholders and each other. We do not compromise our standards.We take responsibility for our actions and everything we say and do is on the record. We analyse and manage risk, and we make decisions we are proud of and that stand the test of time.</div><div class=\"col-md-4\"><h2>Integrity</h2><br/>We act honestly and fairly. We honour our promises.We earn the trust of our stakeholders through the quality of our work and our high ethical standards.We have the courage to speak up when we make a mistake or see something that doesnâ€™t seem right.</div></div></div>', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
