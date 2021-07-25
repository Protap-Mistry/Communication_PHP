-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2021 at 09:08 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `communication`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'JAVA'),
(3, 'Python'),
(4, 'Laravel'),
(5, 'Django'),
(6, 'VueJS'),
(7, 'ReactJS'),
(8, 'HTML 5'),
(9, 'Tailwind CSS'),
(10, 'Bootstrap'),
(11, 'JQuery'),
(12, 'MySQL'),
(13, 'Bangladesh'),
(14, 'Author');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `firstname`, `lastname`, `email`, `body`, `status`, `date`) VALUES
(2, 'Sarwar', 'Hossain', 'sarwar.cse@gmail.com', ' Already Done.', 0, '2021-06-27 08:25:14');

-- --------------------------------------------------------

--
-- Table structure for table `footer`
--

CREATE TABLE `footer` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `footer`
--

INSERT INTO `footer` (`id`, `text`) VALUES
(1, '#Tech_PRO. All rights reserved.');

-- --------------------------------------------------------

--
-- Table structure for table `front_user`
--

CREATE TABLE `front_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `front_user`
--

INSERT INTO `front_user` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Protap Mistry', 'PROTAP', 'pro.cse4.bu@gmail.com', 'cc7d744dd71d2f11276b6cf44a19efe0');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `body`) VALUES
(13, 'Services', '<h4>What is a Blog?</h4>\r\n<p>A blog is a type of website where the content is presented in reverse chronological order (newer content appear first). Blog content is often referred to as entries or &ldquo;blog posts&rdquo;.</p>\r\n<p>Blogs are typically run by an individual or a small group of people to present information in a conversational style. However, now there are tons of corporate blogs that produce a lot of informational and thought-leadership style content.Typical blog posts also have a&nbsp;<a title=\"What is a Comment? How to Manage Comments in WordPress?\" href=\"https://www.wpbeginner.com/glossary/comment/\">comments</a>&nbsp;section where users can respond to the article.</p>\r\n<h4>What is The Difference Between Blog Posts and Pages?</h4>\r\n<p>WordPress is the most popular blogging platform and a powerful content management system. By default, it comes with two content types: posts and pages. Often beginners get confused between the two.</p>\r\n<p>Blog posts are displayed in a reverse chronological order (newest to oldest) on your&nbsp;<a title=\"How to Create a Separate Page for Blog Posts in WordPress\" href=\"https://www.wpbeginner.com/wp-tutorials/how-to-create-a-separate-page-for-blog-posts-in-wordpress/\">blog page</a>&nbsp;because they are timely content which means your users will have to dig deeper to view older posts.</p>\r\n<p>Static pages are &ldquo;one-off&rdquo; type content such as your about page, contact page, products or services landing page, home page, and more.</p>\r\n<p>To learn more, see our beginner&rsquo;s guide on&nbsp;<a title=\"What is the Difference Between Posts vs. Pages in WordPress\" href=\"https://www.wpbeginner.com/beginners-guide/what-is-the-difference-between-posts-vs-pages-in-wordpress/\">the difference between posts and pages</a>.</p>\r\n<p>Pages are usually used to create a website structure and layout. Even blogs can have pages alongside them (See our list of important&nbsp;<a title=\"11 Important Pages that Every WordPress Blog Should Have (2018)\" href=\"https://www.wpbeginner.com/beginners-guide/important-pages-that-every-wordpress-blog-should-have-2018/\">pages that every blog should have</a>).</p>\r\n<h4>Why Do People Blog? What are The Benefits of Blogging?</h4>\r\n<p>Each individual blogger has their own motivation for blogging. Many of them use it as an alternative to keeping a diary or journal.&nbsp;<a title=\"How to Choose the Best Blogging Platform in 2021 (Compared)\" href=\"https://www.wpbeginner.com/beginners-guide/how-to-choose-the-best-blogging-platform/\">Blogging sites</a>&nbsp;provides them with a venue to share their creativity and ideas to a wider audience.</p>\r\n<p>Top brands and businesses&nbsp;<a title=\"Ultimate Guide: How to Start a WordPress Blog (Step by Step)\" href=\"https://www.wpbeginner.com/start-a-wordpress-blog/\">create blogs</a>&nbsp;to educate their customers, share news, and reach a wider audience. Blogging is an essential part of online marketing strategy for many businesses.</p>'),
(14, 'Privacy Policy', '<p>When you use our services, you&rsquo;re trusting us with your information. We understand this is a big responsibility and work hard to protect your information and put you in control.</p>\r\n<p>This Privacy Policy is meant to help you understand what information we collect, why we collect it, and how you can update, manage, export, and delete your information.</p>'),
(15, 'Terms of Use', '<p><span>These Terms of Service reflect&nbsp;</span><a class=\"N6CPUe\" href=\"https://about.google/intl/en_BD/how-our-business-works\" target=\"_blank\">the way Google&rsquo;s business works</a><span>, the laws that apply to our company, and&nbsp;</span><a class=\"N6CPUe\" href=\"https://www.google.com/about/philosophy.html?hl=en\" target=\"_blank\">certain things we&rsquo;ve always believed to be true</a><span>. As a result, these Terms of Service help define Google&rsquo;s relationship with you as you interact with our services.</span></p>');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `category_id`, `title`, `body`, `image`, `author`, `tags`, `date`, `userid`) VALUES
(10, 1, 'My post title here - PHP', '<p><span>The&nbsp;</span><a href=\"https://phpconference.com/?loc=all\">International PHP Conference</a><span>&nbsp;is the world\'s first PHP conference and stands since more than a decade for top-notch pragmatic expertise in PHP and web technologies. At the IPC, internationally renowned experts from the PHP industry meet up with PHP users and developers from large and small companies. Here is the place where concepts emerge and ideas are born - the IPC signifies knowledge transfer at highest level.</span></p>\r\n<p><span>All delegates of the International PHP Conference have, in addition to PHP program, free access to the entire range of the&nbsp;</span><a href=\"https://javascript-conference.com/munich/\">International JavaScript Conference</a><span>&nbsp;taking place at the same time.</span></p>', 'upload/700909dff6.png', 'Editor', 'PHP, Laravel', '2021-06-24 12:03:00', 3),
(12, 3, 'My post title- Python', '<p><span>Python can be easy to pick up whether you\'re a first time programmer or you\'re experienced with other languages. The following pages are a useful first step to get on your way writing programs with Python!</span></p>\r\n<p><span>The&nbsp;</span><a href=\"https://pypi.python.org/\">Python Package Index (PyPI)</a><span>&nbsp;hosts thousands of third-party modules for Python. Both Python\'s standard library and the community-contributed modules allow for endless possibilities.</span></p>\r\n<p><span>The community hosts conferences and meetups, collaborates on code, and much more. Python\'s documentation will help you along the way, and the mailing lists will keep you in touch.</span></p>\r\n<p><span>Python is developed under an OSI-approved open source license, making it freely usable and distributable, even for commercial use. Python\'s license is administered by the&nbsp;</span><a href=\"https://www.python.org/psf\">Python Software Foundation</a><span>.</span></p>', 'upload/9baa1663f4.jpg', 'Python', 'Python, Django', '2021-06-24 12:08:31', 0),
(13, 4, 'My post title - Laravel', '<p>Laravel is a web application framework with expressive, elegant syntax. A web framework provides a structure and starting point for creating your application, allowing you to focus on creating something amazing while we sweat the details.</p>\r\n<p>Laravel strives to provide an amazing developer experience while providing powerful features such as thorough dependency injection, an expressive database abstraction layer, queues and scheduled jobs, unit and integration testing, and more.</p>\r\n<p>Whether you are new to PHP or web frameworks or have years of experience, Laravel is a framework that can grow with you. We\'ll help you take your first steps as a web developer or give you a boost as you take your expertise to the next level. We can\'t wait to see what you build.</p>\r\n<p>There are a variety of tools and frameworks available to you when building a web application. However, we believe Laravel is the best choice for building modern, full-stack web applications.</p>', 'upload/f134ca69c5.png', 'Laravel', 'Laravel, HTML 5, CSS 3, Vue.JS', '2021-06-24 12:11:41', 0),
(14, 5, 'My post title - Django', '<p>With Django, you can take Web applications from concept to launch in a matter of hours. Django takes care of much of the hassle of Web development, so you can focus on writing your app without needing to reinvent the wheel. It&rsquo;s free and open source.</p>\r\n<p>Django was designed to help developers take applications from concept to completion as quickly as possible.</p>\r\n<p>Django includes dozens of extras you can use to handle common Web development tasks. Django takes care of user authentication, content administration, site maps, RSS feeds, and many more tasks &mdash; right out of the box.</p>', 'upload/c673bc7b7f.png', 'Django', 'Django, HTML 5, Tailwind CSS, React.Js', '2021-06-24 12:14:48', 0),
(15, 13, 'My post title - Bangladesh', '                                                                <p>Bangladesh, pronounced(About this soundlisten)), officially the People\'s Republic of Bangladesh, is a country in South Asia. It is the eighth-most populous country in the world, with a population exceeding 163 million people, in an area of 147,570 square kilometres (56,980 sq mi), making it one of the most densely populated countries in the world. Bangladesh shares land borders with India to the west, north, and east, Myanmar to the southeast, and the Bay of Bengal to the south. It is narrowly separated from Nepal and Bhutan by the Siliguri Corridor, and from China by the Indian state of Sikkim in the north, respectively. Dhaka, the capital and largest city, is the nation\'s economic, political, and cultural hub. Chittagong, the largest seaport is the second-largest city.</p>\r\n<p>Bangladesh forms the larger and eastern part of the Bengal region.[16] According to the ancient Indian texts, R?m?yana and Mah?bh?rata, the Vanga Kingdom, one of the namesakes of the Bengal region, was a strong naval power. In the ancient and classical periods of the Indian subcontinent, the territory was home to many principalities, including the Pundra, Gangaridai, Gauda, Samatata, and Harikela. It was also a Mauryan province under the reign of Ashoka. The principalities were notable for their overseas trade, contacts with the Roman world, the export of fine muslin and silk to the Middle East, and spreading of philosophy and art to Southeast Asia. The Gupta Empire, Pala Empire, the Chandra dynasty, and the Sena dynasty were the last pre-Islamic Bengali middle kingdoms. Islam was introduced during the Pala Empire, through trade with the Abb?sid Caliphate,[17] but following the Ghurid conquests led by Bakhtiy?r Khalj?, the establishment of the Delhi Sultanate and preaching of Shah Jal?l in the north-east, it spread across the entire region. In 1576, the wealthy Bengal Sultanate was absorbed into the Mughal Empire, but its rule was briefly interrupted by the S?r Empire. Mughal Bengal, worth 12% of world GDP (late 17th century), waved the Proto-industrialization, showed signs of a possible industrial revolution,[18][19] established relations with the Dutch and English East India Company, and became also the basis of the Anglo-Mughal War. Following the death of Emperor Aurangz?b ?lamgir and Governor Sh?ista Kh?n in the early 1700s, the region became a semi-independent state under the Nawabs of Bengal. Sir?j ud-Daulah, the last Nawab of Bengal, was defeated by the British East India Company at the Battle of Plassey in 1757 and the whole region fell under Company rule by 1793.</p>                                                        ', 'upload/5e5b470ded.png', 'Bangladesh', 'Dhaka, Bangladesh', '2021-06-24 12:18:02', 0),
(16, 6, 'My post title - Veu.Js', '<p>Vue (pronounced /vju?/, like view) is a progressive framework for building user interfaces. Unlike other monolithic frameworks, Vue is designed from the ground up to be incrementally adoptable. The core library is focused on the view layer only, and is easy to pick up and integrate with other libraries or existing projects. On the other hand, Vue is also perfectly capable of powering sophisticated Single-Page Applications when used in combination with modern tooling and supporting libraries.</p>\r\n<p>If you&rsquo;d like to learn more about Vue before diving in, we created a video walking through the core principles and a sample project.</p>\r\n<p>If you are an experienced frontend developer and want to know how Vue compares to other libraries/frameworks, check out the Comparison with Other Frameworks.</p>', 'upload/5ede5038ad.jpg', 'VueJS', 'VueJS, Laravel', '2021-06-24 12:30:30', 0),
(17, 4, 'My post title - Laravel 2', '<p>Server Requirements<br />The Laravel framework has a few system requirements. All of these requirements are satisfied by the Laravel Homestead virtual machine, so it\'s highly recommended that you use Homestead as your local Laravel development environment.</p>\r\n<p>However, if you are not using Homestead, you will need to make sure your server meets the following requirements:</p>\r\n<p>PHP &gt;= 7.2.5<br />BCMath PHP Extension<br />Ctype PHP Extension<br />Fileinfo PHP extension<br />JSON PHP Extension<br />Mbstring PHP Extension<br />OpenSSL PHP Extension<br />PDO PHP Extension<br />Tokenizer PHP Extension<br />XML PHP Extension&lt;/p&gt;<br />&lt;p&gt;Configuration<br />Public Directory<br />After installing Laravel, you should configure your web server\'s document / web root to be the public directory. The index.php in this directory serves as the front controller for all HTTP requests entering your application.</p>\r\n<p>Configuration Files<br />All of the configuration files for the Laravel framework are stored in the config directory. Each option is documented, so feel free to look through the files and get familiar with the options available to you.</p>\r\n<p>Directory Permissions<br />After installing Laravel, you may need to configure some permissions. Directories within the storage and the bootstrap/cache directories should be writable by your web server or Laravel will not run. If you are using the Homestead virtual machine, these permissions should already be set.</p>\r\n<p>Application Key<br />The next thing you should do after installing Laravel is set your application key to a random string. If you installed Laravel via Composer or the Laravel installer, this key has already been set for you by the php artisan key:generate command.</p>\r\n<p>Typically, this string should be 32 characters long. The key can be set in the .env environment file. If you have not copied the .env.example file to a new file named .env, you should do that now. If the application key is not set, your user sessions and other encrypted data will not be secure!</p>\r\n<p>Additional Configuration<br />Laravel needs almost no other configuration out of the box. You are free to get started developing! However, you may wish to review the config/app.php file and its documentation. It contains several options such as timezone and locale that you may wish to change according to your application.</p>\r\n<p>You may also want to configure a few additional components of Laravel, such as:</p>\r\n<p>Cache<br />Database</p>', 'upload/280585f4c0.png', 'Laravel', 'Laravel, VueJs, Bootstrap, JQuery', '2021-06-24 13:16:10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`) VALUES
(1, 'PHP', 'upload/slider/da0cedd45a.jpg'),
(2, 'Laravel', 'upload/slider/3c0ae380d3.jpg'),
(3, 'Java', 'upload/slider/d136cea897.jpg'),
(4, 'Python', 'upload/slider/b2729852e3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(11) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `wapp` varchar(255) NOT NULL,
  `twtr` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `fb`, `wapp`, `twtr`, `email`) VALUES
(1, 'https://www.facebook.com/profile.php?id=100068297407403', 'https://web.whatsapp.com/', 'https://twitter.com/ProtapMistry2', 'http://pro.cse4.bu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `title_slogan`
--

CREATE TABLE `title_slogan` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title_slogan`
--

INSERT INTO `title_slogan` (`id`, `title`, `slogan`, `logo`) VALUES
(1, 'Communication', 'Share Your Memory', 'upload/logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `username`, `password`, `email`, `details`, `role`) VALUES
(1, 'Protap Mistry', 'adminpro', '827ccb0eea8a706c4c34a16891f84e7b', 'pro.cse4.bu@gmail.com', '<p>Hey, I am admin.</p>', 0),
(2, 'Sarwar', 'Author', '827ccb0eea8a706c4c34a16891f84e7b', 'sarwar.cse@gmail.com', '<p>Hey, I am author.</p>', 1),
(3, 'Dipayan', 'Editor', '827ccb0eea8a706c4c34a16891f84e7b', 'dip@gmail.com', '<p>Hey, I am editor.</p>', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `front_user`
--
ALTER TABLE `front_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social`
--
ALTER TABLE `social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title_slogan`
--
ALTER TABLE `title_slogan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `footer`
--
ALTER TABLE `footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `front_user`
--
ALTER TABLE `front_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `social`
--
ALTER TABLE `social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `title_slogan`
--
ALTER TABLE `title_slogan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
