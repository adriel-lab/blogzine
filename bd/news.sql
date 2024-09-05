-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03/09/2024 às 03:05
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `news`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `icon`, `created_at`) VALUES
(5, ' Technology', 'Posts related to technology', '🤖', '2024-09-02 16:31:33'),
(6, 'Travel', 'Departure defective arranging rapturous did believe him all had supported.', '⛰️', '2024-09-02 16:32:10'),
(7, 'Lifestyle', 'Yet ﻿no jokes worse her why. Bed one supposing breakfast day fulfilled.', '🩸', '2024-09-02 16:34:14'),
(8, 'Business', 'Warrant private blushes removed an in equally totally if delivered dejection.', '🤝', '2024-09-02 16:34:32'),
(9, 'Marketing', 'Saw met applauded favorite deficient engrossed concealed and her.', '🔥', '2024-09-02 16:34:47'),
(10, 'Photography', 'Existence certainly explained how improving the household pretended.', '📷', '2024-09-02 16:35:09'),
(11, 'Health', 'Tips and advice on maintaining a healthy lifestyle.', '💪', '2024-09-02 20:00:00'),
(12, 'Education', 'Resources and information related to learning and teaching.', '📚', '2024-09-02 20:05:00'),
(13, 'Entertainment', 'Latest news and updates on movies, music, and more.', '🎬', '2024-09-02 20:10:00'),
(14, 'Food & Drink', 'Delicious recipes and reviews of the best restaurants.', '🍴', '2024-09-02 20:15:00'),
(15, 'Travel', 'Guides and tips for your next adventure.', '✈️', '2024-09-02 20:20:00'),
(16, 'Technology', 'The newest trends and innovations in the tech world.', '💻', '2024-09-02 20:25:00'),
(17, 'Fashion', 'Latest fashion trends and style tips.', '👗', '2024-09-02 20:30:00'),
(18, 'Science', 'Discoveries and research from the world of science.', '🔬', '2024-09-02 20:35:00'),
(19, 'Finance', 'Insights and advice on managing your finances.', '💵', '2024-09-02 20:40:00'),
(20, 'Sports', 'Updates and news on your favorite sports and athletes.', '🏅', '2024-09-02 20:45:00'),
(21, 'Automotive', 'Everything about cars, trucks, and automotive news.', '🚗', '2024-09-02 21:00:00'),
(22, 'Gardening', 'Tips and advice for growing and maintaining plants.', '🌱', '2024-09-02 21:05:00'),
(23, 'Parenting', 'Advice and stories on raising children.', '👶', '2024-09-02 21:10:00'),
(24, 'Gaming', 'News and reviews on the latest video games.', '🎮', '2024-09-02 21:15:00'),
(25, 'Music', 'Updates and insights on music and musicians.', '🎵', '2024-09-02 21:20:00'),
(26, 'History', 'Explore significant historical events and figures.', '📜', '2024-09-02 21:25:00'),
(27, 'Pets', 'Everything about caring for and understanding pets.', '🐾', '2024-09-02 21:30:00'),
(28, 'Environment', 'News and information on environmental issues and sustainability.', '🌍', '2024-09-02 21:35:00'),
(29, 'Real Estate', 'Insights and advice on buying and selling property.', '🏠', '2024-09-02 21:40:00'),
(30, 'Crafts', 'Creative projects and DIY ideas.', '🛠️', '2024-09-02 21:45:00'),
(31, 'Spirituality', 'Exploration of spiritual practices and beliefs.', '🕉️', '2024-09-02 21:50:00'),
(32, 'Legal', 'Information and advice on legal issues and services.', '⚖️', '2024-09-02 21:55:00'),
(33, 'Events', 'Upcoming events and activities in your area.', '📅', '2024-09-02 22:00:00'),
(34, 'Fitness', 'Workouts and health tips to stay fit.', '🏋️', '2024-09-02 22:05:00'),
(35, 'Entrepreneurship', 'Advice and stories from successful entrepreneurs.', '🚀', '2024-09-02 22:10:00'),
(37, 'Cooking', 'Recipes and cooking techniques from around the world.', '🍳', '2024-09-02 22:20:00'),
(38, 'Travel', 'Discover new destinations and travel tips.', '🌐', '2024-09-02 22:25:00'),
(39, 'Lifestyle', 'Ideas and tips for living your best life.', '🌟', '2024-09-02 22:30:00'),
(40, 'Social Media', 'Trends and updates from social media platforms.', '📱', '2024-09-02 22:35:00'),
(41, 'Science', 'Discoveries and research in various scientific fields.', '🔬', '2024-09-02 23:00:00'),
(42, 'Education', 'Information on educational resources and learning.', '🎓', '2024-09-02 23:05:00'),
(43, 'Finance', 'Insights and advice on managing money and investments.', '💰', '2024-09-02 23:10:00'),
(44, 'Food', 'Reviews and recipes for delicious food and beverages.', '🍔', '2024-09-02 23:15:00'),
(45, 'Health', 'Tips and information for maintaining good health.', '🏥', '2024-09-02 23:20:00'),
(46, 'Technology', 'Updates on the latest technological advancements.', '💻', '2024-09-02 23:25:00'),
(47, 'Politics', 'News and analysis of political events and issues.', '🏛️', '2024-09-02 23:30:00'),
(48, 'Sports', 'Coverage of various sports and sporting events.', '🏅', '2024-09-02 23:35:00'),
(49, 'Movies', 'Reviews and news about films and cinema.', '🎬', '2024-09-02 23:40:00'),
(50, 'Books', 'Reviews and recommendations for books and literature.', '📚', '2024-09-02 23:45:00'),
(51, 'Comedy', 'Funny stories and comedic entertainment.', '😂', '2024-09-02 23:50:00'),
(52, 'Art', 'Exploration of various art forms and artists.', '🎨', '2024-09-02 23:55:00'),
(53, 'Culture', 'Insights into different cultures and traditions.', '🌐', '2024-09-03 00:00:00'),
(54, 'DIY', 'Do-it-yourself projects and crafts.', '🔨', '2024-09-03 00:05:00'),
(55, 'Adventure', 'Exciting and adventurous activities and stories.', '🧗', '2024-09-03 00:10:00'),
(56, 'Finance', 'Advice and tips on personal finance and investing.', '💸', '2024-09-03 00:15:00'),
(57, 'Real Estate', 'Information on buying, selling, and investing in property.', '🏢', '2024-09-03 00:20:00'),
(58, 'Personal Development', 'Tips for improving personal skills and growth.', '🧠', '2024-09-03 00:25:00'),
(59, 'Gadgets', 'News and reviews on the latest gadgets and tech.', '📱', '2024-09-03 00:30:00'),
(60, 'Startup', 'Insights and advice for startups and entrepreneurs.', '🚀', '2024-09-03 00:35:00'),
(61, 'Travel', 'Information and tips for travel and tourism.', '🌍', '2024-09-03 00:40:00'),
(62, 'Music', 'Updates and news on music and musicians.', '🎶', '2024-09-03 00:45:00'),
(63, 'Crafts', 'Creative ideas and projects for crafting.', '🎨', '2024-09-03 00:50:00'),
(64, 'Pets', 'Tips and advice on pet care and animals.', '🐶', '2024-09-03 00:55:00'),
(65, 'Social Issues', 'Discussions on important social issues and topics.', '✊', '2024-09-03 01:00:00'),
(66, 'Science Fiction', 'Stories and discussions related to science fiction.', '🚀', '2024-09-03 01:05:00'),
(67, 'Automobiles', 'News and reviews about cars and automotive industry.', '🚘', '2024-09-03 01:10:00'),
(68, 'Fitness', 'Tips and advice for physical fitness and health.', '🏃', '2024-09-03 01:15:00'),
(69, 'Technology Trends', 'Updates on emerging technology trends.', '📊', '2024-09-03 01:20:00'),
(70, 'Food & Drink', 'Exploration of various food and drink options.', '🍷', '2024-09-03 01:25:00'),
(71, 'Lifestyle', 'Tips and insights into various lifestyle topics.', '🌟', '2024-09-03 01:30:00'),
(72, 'Business & Finance', 'Information on business strategies and finance.', '📈', '2024-09-03 01:35:00'),
(73, 'Legal Advice', 'Guidance on legal issues and advice.', '📜', '2024-09-03 01:40:00'),
(74, 'Movies & TV', 'News and reviews about movies and TV shows.', '📺', '2024-09-03 01:45:00'),
(75, 'Education & Training', 'Resources and information for learning and development.', '📖', '2024-09-03 01:50:00'),
(76, 'Home & Garden', 'Ideas and advice for home improvement and gardening.', '🏡', '2024-09-03 01:55:00'),
(77, 'Finance & Investing', 'Advice on finance management and investment.', '💼', '2024-09-03 02:00:00'),
(78, 'Health & Wellness', 'Information on health and wellness topics.', '🧘', '2024-09-03 02:05:00'),
(79, 'Travel & Adventure', 'Travel guides and adventure stories.', '🌄', '2024-09-03 02:10:00'),
(80, 'Culture & Lifestyle', 'Exploration of cultural and lifestyle topics.', '🌆', '2024-09-03 02:15:00'),
(81, 'Covid-19', 'Covid-19', '😷', '2024-09-02 18:32:43');

-- --------------------------------------------------------

--
-- Estrutura para tabela `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_type` enum('cover_image','middle_image','body_image1','body_image2','body_image3') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `images`
--

INSERT INTO `images` (`id`, `post_id`, `image_path`, `image_type`) VALUES
(7, 3, '66d5cd17dde729.33617443.png', 'cover_image'),
(8, 3, '66d5cd17df5955.35151679.png', 'middle_image'),
(9, 3, '66d5cd17e09279.45238942.png', 'body_image1'),
(10, 3, '66d5cd17e151a6.95957577.jpg', 'body_image2'),
(11, 3, '66d5cd17e1bf66.75813177.jpg', 'body_image3'),
(12, 2, '66d6122c677980.64487247.jpg', 'cover_image'),
(13, 2, '66d6122c68cd17.18803674.jpg', 'middle_image'),
(14, 2, '66d6122c69ab93.64697102.jpg', 'body_image1'),
(15, 2, '66d6122c6a9300.64650421.jpg', 'body_image2'),
(16, 2, '66d6122c6b9201.05184918.jpg', 'body_image3'),
(17, 2, '66d61253206781.83079540.jpg', 'cover_image'),
(18, 2, '66d612667c22b5.78106790.png', 'cover_image');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `post_type` enum('Post','Question','Poll','Images','Video','Other') NOT NULL,
  `short_description` text DEFAULT NULL,
  `post_body` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `category_id` varchar(255) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id`, `name`, `post_type`, `short_description`, `post_body`, `tags`, `category_id`, `featured`, `created_at`) VALUES
(2, 'Minecraft', 'Post', 'For who thoroughly her boy estimating conviction. Removed demands expense account in outward tedious do.', 'A light newspaper up its enjoyment agreeable depending. Timed voice share led him to widen noisy young. At weddings believed laughing although the material does the exercise of. Up attempt offered ye civilly so sitting to. She new course gets living within Elinor joy. She rapturous suffering concealed.\n\nDemesne far hearted suppose venture excited see had has. Dependent on so extremely delivered by. Yet no jokes worse her why. Bed one supposing breakfast day fulfilled off depending questions. Whatever boy her exertion his extended. Ecstatic followed handsome drawings entirely Mrs one yet outweigh. Of acceptance insipidity remarkably is an invitation.\n\nWarrant private blushes removed an in equally totally if. Delivered dejection necessary objection do Mr prevailed. Mr feeling does chiefly cordial in do. Water timed folly right aware if oh truth. Imprudence attachment him his for sympathize. Large above be to means. Dashwood does provide stronger is. ...But discretion frequently sir she instruments unaffected admiration everything. Meant balls it if up doubt small purse. Required his you put the outlived answered position. A pleasure exertion if believed provided to. All led out world this music while asked. Paid mind even sons does he door no. Attended overcame repeated it is perceived Marianne in. I think on style child of. Servants moreover in sensible it ye possible. Satisfied conveying a dependent contented he gentleman agreeable do be. Water timed folly right aware if oh truth. Imprudence attachment him his for sympathize. Large above be to means. Dashwood does provide stronger is. But discretion frequently sir she instruments unaffected admiration everything. Meant balls it if up doubt small purse. Required his you put the outlived answered position. A pleasure exertion if believed provided to. I think on style child of. Servants moreover in sensible it ye possible.\n\nSatisfied conveying a dependent contented he gentleman agreeable do be. Warrant private blushes removed an in equally totally if. Delivered dejection necessary objection do Mr prevailed. Mr feeling does chiefly cordial in do. Water timed folly right aware if oh truth. Imprudence attachment him his for sympathize. Large above be to means. Dashwood does provide stronger is. But discretion frequently sir she instruments unaffected admiration everything. Meant balls it if up doubt small purse. Required his you put the outlived answered position. A pleasure exertion if believed provided to. All led out world this music while asked. Paid mind even sons does he door no. Attended overcame repeated it is perceived Marianne in. I think on style child of. Servants moreover in sensible it ye possible.', 'business, sports, traveling', '24', 1, '2024-09-02 14:28:30'),
(3, 'Minecraft2', 'Post', 'For who thoroughly her boy estimating conviction. Removed demands expense account in outward tedious do.', 'gfadbhfasbidbjsiadbsanjdsajbdnjasdouhashudhuodsahudashidhisadhiasáshidihashdiashdashdhiashdhaisdihasdasiduwhirdhihiqwih0dqwihdiiiiijqwdjiwqijdjiwqdqwijdqwidijqwdjqwjdqwjdqiwdqiwdjqwjd´pq', 'business, sports, traveling', '24', 1, '2024-09-02 14:35:03'),
(4, 'Top 10 CSS Tricks', 'Post', 'Cool CSS tricks to enhance your web design.', 'Learn some advanced CSS techniques.', 'CSS, Design', '16', 0, '2024-08-04 16:00:00'),
(5, 'JavaScript ES6 Features', 'Post', 'Explore the new features in ES6.', 'JavaScript ES6 introduced many new features.', 'JavaScript, ES6', '16', 1, '2024-08-05 17:00:00'),
(6, 'Introduction to Bootstrap 5', 'Post', 'Get started with Bootstrap 5 for responsive design.', 'Bootstrap 5 offers new components and utilities.', 'Bootstrap, CSS', '16', 0, '2024-08-06 18:00:00'),
(7, 'Guide to Git and GitHub', 'Post', 'Learn how to use Git and GitHub effectively.', 'Git and GitHub are essential tools for version control.', 'Git, GitHub', '16', 1, '2024-08-07 19:00:00'),
(8, 'Understanding RESTful APIs', 'Post', 'What you need to know about RESTful APIs.', 'RESTful APIs are a standard way to build web services.', 'APIs, REST', '16', 0, '2024-08-08 20:00:00'),
(9, 'Creating Responsive Layouts', 'Post', 'Techniques for building responsive web layouts.', 'Responsive design is crucial for modern web development.', 'Responsive, Layout', '16', 1, '2024-08-09 21:00:00'),
(10, 'The Basics of Python Programming', 'Post', 'A beginner\'s guide to Python programming.', 'Python is a versatile programming language.', 'Python, Programming', '16', 0, '2024-08-10 22:00:00'),
(11, 'Exploring Vue.js', 'Post', 'An introduction to the Vue.js framework.', 'Vue.js is a progressive JavaScript framework.', 'Vue.js, JavaScript', '16', 1, '2024-08-11 23:00:00'),
(12, 'Getting Started with Laravel', 'Post', 'Learn the basics of the Laravel framework.', 'Laravel is a powerful PHP framework.', 'Laravel, PHP', '16', 0, '2024-08-13 00:00:00'),
(13, 'JavaScript Array Methods', 'Post', 'Useful array methods in JavaScript.', 'JavaScript arrays come with many useful methods.', 'JavaScript, Arrays', '16', 1, '2024-08-14 01:00:00'),
(14, 'Introduction to SQL Databases', 'Post', 'Understanding SQL databases and queries.', 'SQL is a standard language for managing databases.', 'SQL, Databases', '16', 0, '2024-08-15 02:00:00'),
(15, 'CSS Grid vs Flexbox', 'Post', 'Comparing CSS Grid and Flexbox.', 'Both Grid and Flexbox are layout systems in CSS.', 'CSS, Grid, Flexbox', '16', 1, '2024-08-15 13:00:00'),
(16, 'Building RESTful Services with Node.js', 'Post', 'How to create RESTful services using Node.js.', 'Node.js is perfect for building RESTful APIs.', 'Node.js, REST', '16', 1, '2024-08-16 14:00:00'),
(17, 'Understanding JSON Web Tokens (JWT)', 'Post', 'An overview of JWT and its uses.', 'JWT is commonly used for authentication.', 'JWT, Authentication', '16', 1, '2024-08-17 15:00:00'),
(18, 'The Benefits of Using TypeScript', 'Post', 'Why you should consider using TypeScript.', 'TypeScript offers static typing for JavaScript.', 'TypeScript, JavaScript', '16', 0, '2024-08-18 16:00:00'),
(19, 'Creating RESTful APIs with Django', 'Post', 'How to build RESTful APIs with Django.', 'Django provides tools for building APIs.', 'Django, REST', '16', 1, '2024-08-19 17:00:00'),
(20, 'Essential Git Commands', 'Post', 'Important Git commands you should know.', 'Git commands are crucial for version control.', 'Git, Commands', '16', 0, '2024-08-20 18:00:00'),
(21, 'The Ultimate Guide to PHP', 'Post', 'Learn everything you need to know about PHP.', 'This is the body of the post.', 'PHP, Programming', '16', 1, '2024-08-01 13:00:00'),
(22, 'Understanding MySQL Joins', 'Post', 'A comprehensive guide to MySQL joins.', 'This post explains the different types of joins in MySQL.', 'MySQL, SQL', '16', 0, '2024-08-02 14:00:00'),
(23, 'How to Use DataTables', 'Post', 'An introduction to DataTables for handling data.', 'DataTables is a powerful jQuery plugin.', 'DataTables, jQuery', '16', 1, '2024-08-03 15:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` enum('admin','user','guest') NOT NULL DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `access_level`, `created_at`, `updated_at`, `status`, `last_login`) VALUES
(1, 'Adriel Dias', 'adriel.dias@example.com', '123456789', 'admin', '2024-09-02 00:10:16', '2024-09-03 01:00:51', 'active', '2024-09-03 01:00:51');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
