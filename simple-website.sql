-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2020 at 08:45 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simple-website`
--

-- --------------------------------------------------------

--
-- Table structure for table `mp_blogs`
--

CREATE TABLE `mp_blogs` (
  `blog_id` int(11) NOT NULL,
  `blog_title` varchar(80) NOT NULL,
  `blog_data` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `status` enum('A','I') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `org_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_blogs`
--

INSERT INTO `mp_blogs` (`blog_id`, `blog_title`, `blog_data`, `meta_keywords`, `meta_desc`, `sort_order`, `date`, `status`, `photo`, `org_id`) VALUES
(1, 'Blog2', 'This is my blog', NULL, NULL, 0, '2019-10-09', 'A', 'upload/blogs_org1_1.png', 'org1'),
(2, 'Blog1', '<h3 style=\\\"font-style: normal; font-weight: normal; font-family: Arial, Verdana;\\\"><span style=\\\"font-size: 10pt;\\\">g new</span><span style=\\\"font-size: 10pt; font-weight: bold;\\\"> testing</span><span style=\\\"font-size: 10pt;\\\"> blo</span><span style=\\\"font-size: 10pt; text-decoration-line: underline;\\\">h and new fo</span><span style=\\\"font-size: 10pt;\\\">rmatting</span></h3><div style=\\\"\\\"><p class=\\\"MsoNormal\\\" style=\\\"font-style: normal; font-weight: normal;\\\">Click Insert and then choose the elements you want from the\r\ndifferent galleries. Themes and styles also help keep your document\r\ncoordinated. When you click Design and choose a new Theme, the pictures,\r\ncharts, and SmartArt graphics change to match your new theme. When you apply\r\nstyles, your headings change to match the new theme. Save time in Word with new\r\nbuttons that show up where you need them.<o:p></o:p></p>\r\n\r\n<p class=\\\"MsoNormal\\\" style=\\\"font-style: normal; font-weight: normal;\\\">To change the way a picture fits in your document, click it\r\nand a button for layout options appears next to it. When you work on a table,\r\nclick where you want to add a row or a column, and then click the plus sign.\r\nReading is easier, too, in the new Reading view. You can collapse parts of the\r\ndocument and focus on the text you want. If you need to stop reading before you\r\nreach the end, Word remembers where you left off - even on another device</p><h4>Sub heading</h4>\r\n\r\n<p class=\\\"MsoNormal\\\" style=\\\"font-style: normal; font-weight: normal;\\\"><ol><li><a href=\\\"http://youtube.com\\\">Video</a> provides <span style=\\\"color: rgb(255, 0, 0);\\\">a powerful way to help you prove your point.\r\nWhen you click Online Video, you can paste in the embed code for t</span>he video you\r\nwant to add. You can also type a keyword to search online for the video that\r\nbest fits your document. To make your document look professionally produced,\r\nWord provides header, footer, cover page, and text box designs that complement\r\neach other. For example, you can add a matching cover page, header, and\r\nsidebar.</li><li>Click Insert and then choose the elements you want from the\r\ndifferent galleries. Themes and styles also help keep your document\r\ncoordinated. When you click Design and choose a new Theme, the pictures,\r\ncharts, and SmartArt graphics change to match your new theme. When you apply\r\nstyles, your headings change to match the new theme. Save time in Word with new\r\nbuttons that show up where you need them.</li></ol><o:p></o:p></p>\r\n\r\n<p class=\\\"MsoNormal\\\" style=\\\"font-style: normal; font-weight: normal;\\\"><o:p></o:p></p>\r\n\r\n<p class=\\\"MsoNormal\\\" style=\\\"font-style: normal;\\\">To change th<span style=\\\"font-weight: bold;\\\">e way a picture fits in your document, click it\r\nand a button for layout options appears next to it. When you work on a table,\r\nclick where you want to add a row or a column, and then click the plus sign.\r\nReading is easier, too, in the new Reading view. You can collapse parts of the\r\ndocument and focus on the text you want. If you need to stop reading </span>before you\r\nreach the end, Word remembers where you left off - even on another device.<o:p></o:p></p>\r\n\r\n<p class=\\\"MsoNormal\\\" style=\\\"font-weight: normal;\\\">Video provides a powerful way to help you prove your point.\r\nWhen you click Online Video, you can paste in the embed code for the video you<span style=\\\"font-style: italic;\\\">\r\nwant to add. You can also type a keyword to search online for the video that\r\nbest fits your document. To make</span> your document look professionally produced,\r\nWord provides header, footer, cover page, and text box designs that complement\r\neach other. For example, you can add a matching cover page, header, and\r\nsidebar.<o:p></o:p></p></div><div style=\\\"font-style: normal; font-weight: normal; font-family: Arial, Verdana;\\\"><br></div>', 'consult', 'consult', 0, '2019-09-11', 'A', NULL, 'org1'),
(3, 'tset', 'fa', NULL, NULL, NULL, '2019-10-02', 'A', 'upload/blogs_org1_3tset.png', 'org1'),
(4, 'New blog', 'Today', NULL, NULL, NULL, '2019-10-16', 'A', 'upload/blogs_org1_4New blog.png', 'org1');

-- --------------------------------------------------------

--
-- Table structure for table `mp_events`
--
CREATE TABLE `mp_interested` (
  `event_id` int(11) NOT NULL,
  `org_id` varchar(100) NOT NULL,
  `interested_name`  varchar(255) DEFAULT NULL,
  `interested_email` varchar(255) DEFAULT NULL,
  `interested_phone` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `mp_events` (
  `event_id` int(11) NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_desc` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `page_alias` varchar(255) DEFAULT NULL,
  `event_format` text DEFAULT NULL,
  `event_date` varchar(255) DEFAULT NULL,
  `event_email` varchar(255) DEFAULT NULL,
  `event_phone` varchar(255) DEFAULT NULL,
  `event_reglink` varchar(500) DEFAULT NULL,
  `event_addDetails` text DEFAULT NULL,
  `event_thumbnail` varchar(255) DEFAULT NULL,
  `org_id` varchar(100) DEFAULT NULL,
  `count_interested` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_events`
--

INSERT INTO `mp_events` (`event_id`, `event_title`, `event_desc`, `meta_keywords`, `sort_order`, `status`, `page_alias`, `event_format`, `event_date`, `event_email`, `event_phone`, `event_reglink`, `event_addDetails`, `event_thumbnail`, `org_id`) VALUES
(1, 'Event1', 'erewqerewqerewqerew\nqerewqerewqerewqerewqerewqerewqere \nwqerewqerewqerewqerewqerewqerew  \n erewqerewqerewqerewqerewqer \newqerewqerewqerewqerewqe rewqerewqerewqerewqerewqerewqerew\nqerewqerewqerewqerewq', '', 0, 'A', NULL, 'rqre', '2018-12-01', 'roshanm0903@gmail.com', '944179487', 'www.google.com', 'erqe', 'upload/1_WhatsApp Image 2019-07-25 at 02.58.14.jpeg', 'org1'),
(2, 'Event2', 'rgtw', '', 0, 'A', NULL, '', '', 'roshanm0903@gmail.com', '09551045397', '', '', NULL, 'org2'),
(4, 'pm live', 'test', 'dfasdg', 0, 'A', NULL, 'fasdfds', '', 'fsdafs@gmail.com', '124', '', '', NULL, 'org2'),
(6, 'Event3', '', '', 0, 'I', NULL, '', '', '', '', '', '', 'upload/9_red_brickphoto.jpeg', 'org2'),
(8, 'put data', 'testtes', '', 0, 'I', NULL, '', '', '', '', '', '', 'upload/9_red_brickphoto.jpeg', 'org1'),
(9, 'PUT DATA', 'PUT DATA TESTING', '', 0, 'A', NULL, '', '', '', '', '', '', 'upload/9_red_brickphoto.jpeg', 'org1'),
(10, 'putdata edit testin', 'putdata edit testin', '', 0, 'I', NULL, '', '', '', '', '', '', NULL, NULL),
(11, 'put data testing 22324', 'dsafas', '', 0, 'I', NULL, '', '', '', '', '', '', 'upload/_ea9d468243a408df546ed2946e8bc86e.jpg', NULL),
(12, 'edit 9', 'sdga', '', 0, 'I', NULL, '', '', '', '', '', '', NULL, NULL),
(13, 'edit 9', 'sdga', '', 0, 'I', NULL, '', '', '', '', '', '', NULL, ''),
(14, 'tests', 'fdhg', '', 0, 'I', NULL, '', '', '', '', '', '', NULL, ''),
(15, 'tsetes', 'test', '', 0, 'I', NULL, '', '', '', '', '', '', NULL, ''),
(16, 'test org id put dagaa', 'test', '', 0, 'I', NULL, '', '', '', '', '', '', NULL, ''),
(17, 'test org id', 'org id', '', 0, 'I', NULL, '', '', '', '', '', '', 'upload/9_red_brickphoto.jpeg', 'org1'),
(18, 'title', 'desc', '', 0, 'A', NULL, 'format', '393/2141sd', 'email@rmei.co', '993', 'dsandsgk', 'dafd', 'upload/9_red_brickphoto.jpeg', 'org1'),
(19, 'New Event', 'New Event', '', 0, 'A', NULL, 'test', '', 'newevent@gmail.com', '', '', '', 'upload/19_ea9d468243a408df546ed2946e8bc86e.jpg', 'org1'),
(21, 'new ebet', 'fdasg', '', 0, 'A', NULL, '', '', '', '', '', '', 'upload/9_red_brickphoto.jpeg', 'org1'),
(22, 'hello', 'new event 1010', '', 0, 'A', NULL, '', '', 'roshanm0903@gmail.com', '09551045397', '', 'www.google.com', 'upload/9_red_brickphoto.jpeg', 'org1');

-- --------------------------------------------------------

--
-- Table structure for table `mp_main`
--

CREATE TABLE `mp_main` (
  `id` int(11) NOT NULL,
  `tagline1` varchar(255) DEFAULT NULL,
  `tagline2` varchar(255) DEFAULT NULL,
  `facebookLink` varchar(255) DEFAULT NULL,
  `instagramLink` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `photo1` varchar(255) DEFAULT NULL,
  `photo2` varchar(255) DEFAULT NULL,
  `photo3` varchar(255) DEFAULT NULL,
  `photo4` varchar(255) DEFAULT NULL,
  `linkedinLink` varchar(255) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL,
  `org_name` text DEFAULT NULL,
  `about` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_main`
--

INSERT INTO `mp_main` (`id`, `tagline1`, `tagline2`, `facebookLink`, `instagramLink`, `email`, `logo`, `photo1`, `photo2`, `photo3`, `photo4`, `linkedinLink`, `org_id`, `org_name`, `about`) VALUES
(1, 'Tagline 1 tagline 1', 'Tagline 2', 'https://facebook.com/home.php', 'insta linkdd', 'roshanm0903@gmail.com', 'upload/iimlogo.png', 'upload/main_org1_1Photo1.png', 'upload/main_org1_1Photo2.png', 'upload/main_org1_1Photo3.png', 'upload/main_org1_1Photo4.png', 'linked in', 'org1', 'The product management and technology club', 'Video provides a powerful way to help you prove your point. your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document. '),
(2, 'tg1', 'tg2', '', '', '', 'upload/iimlogo.png', NULL, NULL, NULL, NULL, '', 'zab', 'new club', 'club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 '),
(3, 'Tagline 1 tagline 1', 'Tagline 2', 'https://facebook.com/home.php', 'insta linkdd', 'roshanm0903@gmail.com', 'upload/iimlogo.png', 'upload/main_org1_1Photo1.png', 'upload/main_org1_1Photo2.png', 'upload/main_org1_1Photo3.png', 'upload/main_org1_1Photo4.png', 'linked in', 'org2', 'club number 2', 'club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 '),
(4, 'tg1', 'tg2', '', '', '', 'upload/iimlogo.png', NULL, NULL, NULL, NULL, '', 'xab', 'new club', 'club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 '),
(5, 'tg1', 'tg2', '', '', '', 'upload/iimlogo.png', NULL, NULL, NULL, NULL, '', 'zba', '', 'club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 club 2 ');

-- --------------------------------------------------------

--
-- Table structure for table `mp_members`
--

CREATE TABLE `mp_members` (
  `mem_id` int(30) NOT NULL,
  `name` text CHARACTER SET utf8 NOT NULL,
  `mem_bio` text CHARACTER SET utf8 NOT NULL,
  `email` text CHARACTER SET utf8 NOT NULL,
  `phone` int(32) NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('A','I') CHARACTER SET utf8 NOT NULL DEFAULT 'A',
  `meta_keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `org_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mp_members`
--

INSERT INTO `mp_members` (`mem_id`, `name`, `mem_bio`, `email`, `phone`, `photo`, `status`, `meta_keywords`, `org_id`) VALUES
(1, 'Roshan', 'Hello phtp test', 'p19@gmail.com', 837842, 'upload/members_org1_1Roshan.png', 'A', '', 'org1'),
(3, 'Roshan Manellore', 'test 2', 'roshanm0903@gmail.com', 2147483647, 'upload/members_org1_3Roshan Manellore.png', 'A', 'consult', 'org1'),
(4, 'Roshan Manellore 3', 'haha', 'roshanm0903@gmail.com', 2147483647, 'upload/WhatsApp Image 2019-08-11 at 19.37.53.jpeg', 'A', 'fas', 'org2'),
(5, 'Roshan Manellore3', 'dfasdg', 'roshanm0903@gmail.com', 2147483647, 'upload/5_red_brickphoto.jpeg', 'A', '', 'org1'),
(6, 'Roshan Manellore3', 'dfasdg', 'roshanm0903@gmail.com', 2147483647, '', 'A', '', 'org2'),
(7, 'Roshan Manellore Photo', 'teadsg', 'roshanm0903@gmail.com', 2147483647, 'upload/7_red_brickphoto.jpeg', 'A', 'fasdfa', 'org1'),
(8, 'photo2', 'testing\r\nupload image', 'roshanm0903@gmail.com', 2147483647, '', 'A', '', 'org2'),
(11, 'photo test', 'dga', 'ggsd@gmiall.co', 14, '../upload/11_WhatsApp Image 2019-08-11 at 22.51.30.jpeg', 'A', 'ga', 'org2');

-- --------------------------------------------------------

--
-- Table structure for table `mp_pages`
--

CREATE TABLE `mp_pages` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_desc` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `parent` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `page_alias` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `org_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mp_pages`
--

INSERT INTO `mp_pages` (`page_id`, `page_title`, `page_desc`, `meta_keywords`, `meta_desc`, `sort_order`, `parent`, `status`, `page_alias`, `photo`, `org_id`) VALUES
(1, 'Welcome to my site org1', 'Holla! org 1', 'tags', 'descsds', 0, '-1', 'A', 'index', 'upload/1_tagline photo3.jpeg', 'org1'),
(2, 'About Us', '<div><span style=\\\"font-size: 10pt;\\\">Hello world!</span></div><div><span style=\\\"font-size: 10pt;\\\"><br></span></div><div><span style=\\\"font-size: 10pt;\\\">New update here!</span></div>', 'consult', 'consult', 1, '9', 'A', 'about-us', 'upload/2_page test.jpeg', 'org1'),
(9, 'Blog org1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<br><br>ontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \\\"de Finibus Bonorum et Malorum\\\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \\\"Lorem ipsum dolor sit amet..\\\", comes from a line in section 1.10.32.<br>', 'category', 'description goes here', 1, '-1', 'A', 'blog', NULL, 'org1'),
(10, 'PHP', 'PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. PHP is now installed on more than 244 million websites and 2.1 million web servers Originally created by Rasmus Lerdorf in 1995, the reference implementation of PHP is now produced by The PHP Group. While PHP originally stood for Personal Home Page, it now stands for PHP: Hypertext Preprocessor, a recursive acronym<br><br>PHP code is interpreted by a web server with a PHP processor module, which generates the resulting web page: PHP commands can be embedded directly into an HTML source document rather than calling an external file to process data. It has also evolved to include a command-line interface capability and can be used in standalone graphical applications<br>', '', '', 3, '9', 'A', 'php', NULL, 'org2'),
(11, 'mysql page', 'MySQL officially, but also called My Seque is (as of July 2013) the world\\\'s second most widely used open-source relational database management system (RDBMS). It is named after co-founder Michael Widenius\\\'s daughterThe SQL phrase stands for Structured Query Language<br><br>The default port of Mysql is 3306. The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation<br><br>MySQL is a popular choice of database for use in web applications, and is a central component of the widely used LAMP open source web application software stack (and other \\\'AMP\\\' stacks). LAMP is an acronym for \\\"Linux, Apache, MySQL, Perl/PHP/Python.\\\" Free-software-open source projects that require a full-featured database management system often use MySQL.<br><br>', '', '', 2, '9', 'A', '-php-echo-session-org-id-', NULL, 'org1'),
(12, 'Ajax', 'Ajax (an acronym for Asynchronous JavaScript and XML) is a group of interrelated web development techniques used on the client-side to create asynchronous web applications. With Ajax, web applications can send data to, and retrieve data from, a server asynchronously (in the background) without interfering with the display and behavior of the existing page. Data can be retrieved using the XMLHttpRequest object. Despite the name, the use of XML is not required (JSON is often used instead. See AJAJ), and the requests do not need to be asynchronous.<br><br>Ajax is not a single technology, but a group of technologies. HTML and CSS can be used in combination to mark up and style information. The DOM is accessed with JavaScript to dynamically display, and allow the user to interact with, the information presented. JavaScript and the XMLHttpRequest object provide a method for exchanging data asynchronously between browser and server to avoid full page reloads.<br><br>', '', '', 1, '9', 'A', 'ajax', NULL, 'org1'),
(19, 'New Blog', 'Test', '', '', 0, '9', 'A', 'new-blog3', NULL, 'org2'),
(22, 'Welcome to my site org1', 'Holla! org 2', 'tags', 'descsds', 0, '-1', 'A', 'index_org2', NULL, 'org2'),
(23, 'Blog 2', 'new blog', '', '', 0, '9', 'A', 'blog-2', NULL, 'org1'),
(24, 'blog2', 'new blog', '', '', 0, '9', 'A', 'blog2', NULL, 'org1'),
(25, 'blog 3', 'test blog 3', '', '', 0, '9', 'A', 'blog-3', NULL, ''),
(26, 'blog 4', 'test blog 4', '', '', 0, '9', 'A', 'blog-4', NULL, 'org1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) CHARACTER SET utf8 NOT NULL,
  `password` varchar(100) CHARACTER SET utf8 NOT NULL,
  `AdminApproved` int(11) NOT NULL DEFAULT 0,
  `org_id` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `AdminApproved`, `org_id`) VALUES
(3, 'testing', '$2y$10$l.Oor4yC.GyhsquR1gxkEe5hLlusoCvUehH.ko3.MpkPvwwKtxDLK', 1, 'org1'),
(4, 'Test2', '$2y$10$YtWZkjbGtXeW5lhMzyx3XeEYHI4y36sGik4VCCdEavOBJBqogjwCK', 1, 'org2'),
(6, 'admin', '$2y$10$1ue5FB2zhcp4XQYGPDzAQePvcvWdtl1rGQvGVneIqXAuCE2dgS/4W', 1, 'org2'),
(8, 'eosc', '$2y$10$Tyy2xlhPs2yVmChtjHkiYeZF6ruAmssJ8ac5XGsX.Y6CmD2Waq5w2', 1, 'eosc');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mp_blogs`
--
ALTER TABLE `mp_blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `mp_events`
--
ALTER TABLE `mp_events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `mp_main`
--
ALTER TABLE `mp_main`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mp_members`
--
ALTER TABLE `mp_members`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `mp_pages`
--
ALTER TABLE `mp_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_name` (`page_alias`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mp_blogs`
--
ALTER TABLE `mp_blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mp_events`
--
ALTER TABLE `mp_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mp_main`
--
ALTER TABLE `mp_main`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mp_members`
--
ALTER TABLE `mp_members`
  MODIFY `mem_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `mp_pages`
--
ALTER TABLE `mp_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
