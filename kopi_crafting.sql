-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2024 at 09:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kopi_crafting`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(5) NOT NULL,
  `blog_image` varchar(50) NOT NULL DEFAULT '0',
  `blog_title` varchar(100) NOT NULL,
  `blog_description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `blog_image`, `blog_title`, `blog_description`) VALUES
(1, 'blog2.jpg', 'Grand Opening Our Kopi Crafting', 'Welcome to the grand opening of our kopi crafting blog, where we invite you on an aromatic journey through the rich and diverse world of traditional Southeast Asian coffee. Embark with us as we explore the intricate art of brewing kopi, from the bustling streets of Singapore to the serene plantations of Indonesia, uncovering age-old techniques, unique blends, and the cultural significance behind each cup. Get ready to awaken your senses, ignite your passion for coffee, and delve into a realm where every sip tells a story. Join us as we celebrate the harmonious fusion of tradition and innovation in the captivating realm of kopi crafting.'),
(2, 'blog3.jpg', 'Event At KL', '\r\nIndulge in a sensory journey through the art of kopi crafting at our exclusive event in the heart of Kuala Lumpur. Join us for an immersive experience where you\'ll learn the intricate techniques of brewing the perfect cup of Malaysian coffee, from selecting the finest beans to mastering the delicate balance of flavors. Engage with expert baristas as they share their insights and expertise, guiding you through each step of the process.'),
(3, 'blog4.jpg', 'Meet Our Founder', 'I am thrilled to share the story behind our passion for elevating the art of coffee brewing. Our journey began with a deep appreciation for Malaysia\'s rich coffee culture and a desire to showcase the complexity and diversity of flavors inherent in each cup. Through meticulous sourcing of premium beans and dedication to mastering traditional brewing techniques, we have crafted a unique experience that honors the heritage of Malaysian coffee while pushing the boundaries of innovation. ');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `cus_id` int(5) NOT NULL,
  `product_quantity` int(3) NOT NULL,
  `product_subtotal` float NOT NULL,
  `cart_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`cart_id`, `product_id`, `cus_id`, `product_quantity`, `product_subtotal`, `cart_total`) VALUES
(4, 1, 6, 1, 20, 20),
(7, 3, 6, 2, 45.5, 91),
(8, 7, 6, 1, 35.9, 35.9),
(11, 1, 1, 1, 20, 20),
(13, 3, 1, 1, 45.5, 45.5),
(15, 5, 1, 1, 40, 40),
(16, 1, 10, 3, 20, 60),
(19, 6, 10, 1, 30, 30);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(5) NOT NULL,
  `cus_name` varchar(35) NOT NULL,
  `cus_email` varchar(23) NOT NULL,
  `cus_password` varchar(8) NOT NULL,
  `cus_phone_number` varchar(12) NOT NULL,
  `cus_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `cus_email`, `cus_password`, `cus_phone_number`, `cus_address`) VALUES
(1, 'Lisa', 'lisa@gmail.com', 'abcd1234', '012-2345673', '12, jalan kuala lumpur, taman bahagia, 091234, kua'),
(2, 'Nur', 'nur@gmail.com', '1234abcd', '019-3459682', '34, Jalan Imbi, 78100, Kuala Lumpur'),
(6, 'Pei Ling', 'ling200401@gmail.com', 'abcd', '016-2377499', '44, Jalan Alor, 0280, Kuala Lumpur'),
(8, 'Seow Tian', 'seowtianl@gmail.com', '0987', '012-3450781', '45, Jalan Tunku, 09128, Penang'),
(9, 'Jun Xuan', 'jx1209@gmail.com', 'abcds', '017-3456789', '78, jalan Awan Bessar, 45102,Kedah'),
(10, 'Xiao Ching', 'xcloh1101@gmail.com', 'abcd1234', '016-5982312', 'No. 46, Lebuh Mandarin, Gerbang Pasir Harum, 31650');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(5) NOT NULL,
  `cus_id` int(5) NOT NULL,
  `product_id` int(5) NOT NULL,
  `product_quantity` int(3) NOT NULL,
  `product_subtotal` float NOT NULL,
  `order_total` float NOT NULL,
  `delivery_types` varchar(50) NOT NULL,
  `payment_method` varchar(20) NOT NULL,
  `payment_status` varchar(7) NOT NULL,
  `order_status` varchar(10) NOT NULL,
  `order_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `cus_id`, `product_id`, `product_quantity`, `product_subtotal`, `order_total`, `delivery_types`, `payment_method`, `payment_status`, `order_status`, `order_date`) VALUES
(15, 1, 1, 1, 20, 20, 'Self Pickup', 'Touch \'n Go ', 'Paid', 'Reviewed', '2024-04-13'),
(16, 1, 2, 4, 35.9, 143.6, 'Self Pickup', 'Touch \'n Go ', 'Paid', 'Reviewed', '2024-04-13'),
(17, 1, 3, 1, 45.5, 45.5, 'Self Pickup', 'Touch \'n Go ', 'Paid', 'Reviewed', '2024-04-13'),
(18, 10, 1, 3, 20, 60, 'Delivery', 'Online banking', 'Paid', 'Reviewed', '2024-04-13'),
(19, 10, 1, 3, 20, 60, 'Delivery', 'Online banking', 'Paid', 'Delivered', '2024-04-13'),
(20, 10, 6, 1, 30, 30, 'Self Pickup', 'Online banking', 'Paid', 'Shipping', '2024-04-13'),
(21, 10, 1, 3, 20, 60, 'Self Pickup', 'Online banking', 'Paid', 'Packing', '2024-04-13');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `token_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL,
  `expiration_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`token_id`, `email`, `token`, `expiration_time`) VALUES
(21, 'ling200401@gmail.com', 'e36610337e0c91747a91882769df1780', '2024-04-03 20:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(35) NOT NULL,
  `product_type` varchar(50) NOT NULL,
  `product_image` varchar(50) NOT NULL DEFAULT '',
  `product_description` varchar(100) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_price` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_type`, `product_image`, `product_description`, `product_quantity`, `product_price`) VALUES
(1, 'Indonesia Coffee Bean 50g', 'Indonesia', 'coffee1.jpeg', 'Indulge in the rich, earthy tones and bold, spicy notes of Indonesia\'s finest coffee beans, deliveri', 25, 20),
(2, 'India Coffee Bean 100g', 'India', 'coffee4.jpeg', 'Experience the rich, earthy notes and subtle hints of spice in our India coffee bean, a harmonious b', 25, 35.9),
(3, 'Columbia Coffee Bean 150g', 'Columbia', 'coffee2.jpeg', 'Indulge in the vibrant flavors of Colombia with our carefully sourced coffee beans, boasting a harmo', 120, 45.5),
(4, 'India Coffee Bean 50g', 'India', 'coffee6.jpeg', 'Experience the rich, earthy notes and subtle hints of spice in our India coffee bean, a harmonious b', 30, 25.8),
(5, 'India Coffee Bean 150g', 'India', 'coffee7.jpeg', 'Experience the rich, earthy notes and subtle hints of spice in our India coffee bean, a harmonious b', 12, 40),
(6, 'Indonesia Coffee Bean 100g', 'Indonesia', 'coffee3.jpeg', 'blabla', 34, 30),
(7, 'Columbia Coffee Bean 100g', 'Columbia', 'coffee5.jpeg', 'Indulge in the vibrant flavors of Colombia with our carefully sourced coffee beans, boasting a harmo', 34, 35.9);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `order_id` int(5) NOT NULL,
  `review_rating` int(1) DEFAULT NULL,
  `review_description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`order_id`, `review_rating`, `review_description`) VALUES
(15, 5, 'Good Coffee, this is the best coffee that I had!'),
(16, 4, 'Good, but need to improve the taste!'),
(17, 3, 'Mehh, it\'s just not my taste....'),
(18, 5, 'Good taste, good taste!!!');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(5) NOT NULL,
  `staff_name` varchar(35) NOT NULL,
  `staff_email` varchar(35) NOT NULL,
  `staff_password` varchar(8) NOT NULL,
  `staff_phone_number` varchar(12) NOT NULL DEFAULT '',
  `staff_address` varchar(35) NOT NULL,
  `staff_status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_name`, `staff_email`, `staff_password`, `staff_phone_number`, `staff_address`, `staff_status`) VALUES
(1, 'Jojo', 'staffjojo@gmail.com', 'abcd1234', '019-5643097', '23, jalan tas, taman tas, 78190, se', 'Admin'),
(2, 'Stella', 'staffstella@gmail.com', '1234abcd', '013-2341346', '89, jalan terus, taman terus, 90122', 'Staff'),
(3, 'Wilona', 'staffling@gmail.com', '1234', '013-2345678', '22, Jalan Bengkok, 01957, Johor', 'Staff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`),
  ADD UNIQUE KEY `blog_id` (`blog_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD UNIQUE KEY `cart_id` (`cart_id`),
  ADD KEY `FK_cart_products` (`product_id`),
  ADD KEY `FK_carts_customers` (`cus_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`),
  ADD UNIQUE KEY `cus_id` (`cus_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `order_id` (`order_id`),
  ADD KEY `FK_orders_customer` (`cus_id`),
  ADD KEY `FK_orders_products` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD UNIQUE KEY `token_id` (`token_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_id` (`staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_cart_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_carts_customers` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_customer` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_orders_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
