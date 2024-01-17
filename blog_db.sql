-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 15, 2024 at 07:00 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--
CREATE DATABASE IF NOT EXISTS `blog_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog_db`;

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `post_timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `content`, `author`, `category`, `post_timestamp`, `image_url`) VALUES
(1, 'Docker – Hello World', 'Have you ever experience that in just one second your entire operating system is ready to use?\r\n\r\nYes, you heard it right Docker gives you the facilities to use a new operating system in one second. Docker is a program that uses your base OS resources and only consumes 20MB – 50MB RAM to launch a new OS. In this article, we’ll show you how to install the docker inside Redhat Linux, how to start docker services, how to pull images from the docker hub, and finally how to launch a new container.\r\n\r\nIn this article, we will discuss the “Hello World” for Docker.\r\n\r\nThese are the steps to achieve the goal.\r\n\"Basic terminologies like docker container, docker image, dockerfile.\r\nHow to start docker services.\r\nHow to pull Hello-world image from docker hub.\r\nHello-world.\"\r\nLet’s start with the key terminologies that you must know.\r\n\r\nBasic terminologies\r\n1. Docker container:\r\nDocker container is a separate virtualized environment that is used to test, run and deploy the applications. basically, the docker container is used in application development. If any problem or bug comes then it does not affect our Base OS and it also gives extra security. we can easily create new containers with help of docker images. we can also destroy these containers easily.\r\n\r\n2. Docker image:\r\nDocker images are like snapshots in VMs. Docker images are executable files that are used to create separate containers in Docker. We create lots of containers using single docker images. Docker hub is a centralized location that is maintaining docker images. You can find Docker images of Hello-world, Ubuntu, Centos, etc. We also create our own customize image using the docker commit command and using Dockerfile and publish or push them on the docker hub.\r\n\r\n3. Dockerfile:\r\nDockerfile is a scripted text file that is used to customize our container and install desire software inside the docker container. we just write the commands in Dockerfile and using this file we build our own image. Later we use this image in our container as well as we push the image on Dockerhub.', 'admin', 'technology', '2023-01-17 16:00:49', 'https://media.licdn.com/dms/image/D5612AQGeEHapUptoxw/article-cover_image-shrink_600_2000/0/1684079864237?e=2147483647&v=beta&t=UUUAS5PPyisf3YVxC_VFidjxwFeTZwfpb1y4dH0G5xs'),
(2, 'The 8 best cafes and coffee shops in Istanbul', 'Exploring the historic marvels of Istanbul is a common aspiration for visitors, often involving a hurried tour through the Sultanahmet neighborhoods and the bustling markets of the Grand Bazaar. While these experiences are captivating, I recommend that those seeking to transport themselves back in time step away from the city\'s myriad museums, palaces, and markets and instead savor a simple cup of coffee.\r\n\r\nIstanbul\'s coffee culture traces its roots back to the 16th century, seamlessly weaving into the city\'s social fabric. Sultan Suleiman the Magnificent famously hailed coffee as the \'black pearl,\' leading to the rapid emergence of coffee houses, known as kıraathanes, throughout Istanbul. These establishments became social hubs for intellectuals, diplomats, and traders. Despite Sultan Murad IV\'s attempt to ban coffee in 1633, citing its perceived demoralizing effects, the beverage continued to thrive. In fact, it inspired foreign visitors to introduce coffeehouses to Europe and beyond.\r\n\r\nToday, the cultural and social traditions of coffee drinking persist in Istanbul. In historic and modern cafes, individuals gather around small tables, engaging in timeless conversations while enjoying a cup of Turkish coffee. Here are some notable cafes and coffee shops in Istanbul where you can relish a robust cup:\r\n\r\nPierre Loti Cafe, Eyüp Merkez:\r\nNamed after the French novelist Pierre Loti, this cafe atop the Eyüp gondola offers panoramic views of the Golden Horn and Bahariye Islands. Renowned for its tranquil ambiance, visitors can savor both the cafe\'s coffee and a traditional Turkish breakfast.\r\nŞark Kahvesi, Grand Bazaar, Fatih:\r\nNestled within the Grand Bazaar, Şark Kahvesi is adorned with ancient stone archways and ornate façades. Visitors can enjoy a cup of coffee amidst the unique surroundings of this historical market.\r\nFahriye Cafe, Moda Kadıköy:\r\nLocated in the creative hub of Kadıköy, Fahriye Cafe attracts young artists with its rustic setting. Amidst debates, visitors can peruse books, records, and antiques, and don\'t forget to greet Inci the cat.\r\nBenazio, Kadıköy:\r\nBenazio in Kadıköy spills onto the streets, allowing visitors to enjoy the sun while savoring coffee. Frequented by digital nomads and students, the cafe provides a dynamic environment for conversations and work breaks.\r\nGülhane Sur Cafe, Fatih:\r\nSituated near the Hagia Sophia Mosque, this cafe offers outdoor seating in alcoves with traditional low-level seating. Locals often gather for coffee and shisha, and the cafe is known for its Turkish salep, a rich beverage from the Ottoman era.\r\nCorlulu Ali Pasa Medresesi, Fatih:\r\nIn this historic square, locals escape the city\'s hustle, enjoying afternoon coffee and watching tourists pass through. The courtyard offers a tranquil atmosphere, inviting visitors to linger and soak in the surroundings.\r\nHafız Mustafa 1864:\r\nFounded in 1864, Hafız Mustafa is renowned for its Turkish sweets. Despite being a chain cafe, it is a must-visit for coffee enthusiasts, as the rich pastries complement the bitter coffee.\r\nKarabatak, Karaköy:\r\nLocated in lively Karaköy, Karabatak Cafe occupies a converted historical building and is popular among young professionals. Visitors can experience Turkish hospitality as they engage with friendly locals over coffee.', 'admin', 'travel', '2024-01-02 18:50:07', 'https://i.pinimg.com/originals/fe/49/bd/fe49bd06f21a2d9c1c4e51e3b062220c.jpg'),
(3, 'Digital marketing platform for fashion brands raises £4m', 'A customer engagement platform used by beauty brands including Armani, Lancôme and YSL has raised $5m (£3.9m) in a seed funding round.\r\n\r\nLondon-based Odore is a platform used by fashion and cosmetic brands to develop marketing strategies based on detailed customer data and analytics.\r\n\r\nBrands can create online marketing campaigns, including custom visual assets, using Odore. The platform also tracks data related to the campaign to monitor success, including customer acquisition and retention.\r\n\r\nOther notable clients of the company include Dior, Shiseido and Louis Vuitton parent company LVMH.\r\n\r\n“The challenges that today’s industry faces are complex, and we founded Odore to provide solutions that are not only comprehensive but also transform the way brands strategise, operate, and connect,” said Armaan Mehta, co-founder of Odore.\r\n\r\n“This is just the beginning. With this latest funding round, we’re delighted to have Fuel Ventures on board for our next chapter as we expand our team and business globally and launch new tools to better serve our customers.”\r\n\r\nAlong with lead investor Fuel Ventures, the round included participation from Blackfinch Ventures and SFC Capital.\r\n\r\n“From the platform experience, the robust suite of tools, and the blending of digital and physical, everything is designed specifically for the brands, resulting in a far superior experience and very high levels of continued business from world-leading brands,” said Shiv Patel, investment director at Fuel Ventures.\r\n\r\n“The rapid expansion of both Odore’s geographic footprint, as well as its financial traction, makes us really excited to see what the team does next.”\r\n\r\nThe company previously raised £595,000 in a round back in April 2021.', 'yigit', 'fashion', '2023-01-30 05:36:47', 'https://play-media.org/wp-content/uploads/2022/09/10-most-effective-digital-marketing-strategies-for-fashion-brand.jpg'),
(4, 'Foreigners Prefer To Live In Bursa', 'Bursa, recognized as an alternative to Istanbul by international residents, stands as a pivotal city in Turkey throughout its history. Numerous foreigners choose to settle in Bursa for a variety of reasons, which we will explore in this blog post.\r\n\r\nIntroduction:\r\nSituated in the northwest of Turkey within the Marmara region, Bursa holds the position of the fourth-most populous city in Turkey, boasting around 3.5 million inhabitants as per the latest statistics. Bursa shares borders with the Sea of Marmara and Yalova to the north, Kocaeli and Sakarya to the northeast, Bilecik to the east, and Kütahya and Balıkesir to the south. Encompassing an area of 11,043 square kilometers, Bursa is renowned for its livability, attributed to factors such as security, a pristine environment, urban prosperity, employment opportunities, successful investments, and affordable living costs.\r\n\r\nReasons Foreigners Choose to Reside in Bursa:\r\nClimate in Bursa:\r\nBursa stands out as one of Turkey\'s most captivating regions, drawing tourists from various countries year-round. The city generally experiences a temperate climate, although variations exist across different climatic zones. Winters, particularly in Uludag Mountain, are cold, marked by a consistent snow cover that appeals to winter sports enthusiasts. Spring witnesses a gradual warm-up, while summers are warm, dry, and clear, allowing residents and visitors to engage in a myriad of summer activities. Autumns in Bursa are relatively warm, contributing to the city\'s favorable climate, making it an attractive choice for residence.\r\n\r\nInfrastructure in Bursa:\r\nBursa stands as one of Turkey\'s most developed and sophisticated cities across economic, investment, and social dimensions. Its well-established infrastructure includes:\r\n- Railway (Metro): Bursa\'s metro system ranks as the second-most popular mode of transportation, following buses.\r\n- Transportation and Roads: The transportation network in Bursa has evolved to meet the city\'s growth and needs, connecting various regions.\r\n- Airports in Bursa: Bursa Airport, situated in the Yenişehir region, primarily handles domestic flights, with some international flights during the summer.\r\n- Educational Institutions and Schools: Bursa excels in education, hosting institutions equipped with cutting-edge technology.\r\n- Health Sector: Bursa is recognized for its developed healthcare facilities, attracting significant interest in health services.\r\n\r\nTourist Attractions in Bursa:\r\nBursa boasts a plethora of attractions, including Uludag Mountain, the world\'s longest cable car (Teleferik Bursa), picturesque waterfalls, scenic lakes, invigorating hot springs, lush parks and forests, traditional markets, and historic villages.\r\n\r\nCost of Living in Bursa:\r\nExpatriates in Bursa benefit from lower prices and living costs compared to other Turkish cities. The affordability of rents, diverse real estate prices, reasonable education expenses, accessible healthcare options, and economical daily living costs make Bursa an attractive destination for individuals with moderate to limited incomes.', 'admin', 'travel', '2024-01-08 00:48:12', 'https://idsb.tmgrup.com.tr/ly/uploads/images/2022/11/14/241313.jpg'),
(5, 'Test', 'Test content', 'admin', 'travel', '2024-01-15 11:21:16', 'https://upload.wikimedia.org/wikipedia/commons/d/d9/Bogazici_University.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$kWUVPyNDwxW9yLCDYBXr9uRrBUwKchVf4pmyYUMFZakPafOTyV4yC', 'user', '2024-01-07 18:01:26'),
(2, 'yigit', '$2y$10$7JjJ0fMIhxx1PcYcSa5/wOI1iJSsHoncqrgRooIC6Bk9YajXiM3lS', 'user', '2024-01-15 18:00:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
