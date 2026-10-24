/*
SQLyog Community v13.3.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - tinh_kendy
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tinh_kendy` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `tinh_kendy`;

/*Table structure for table `cache` */

DROP TABLE IF EXISTS `cache`;

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache` */

insert  into `cache`(`key`,`value`,`expiration`) values 
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab','i:1;',1792828034),
('laravel-cache-356a192b7913b04c54574d18c28d46e6395428ab:timer','i:1792828034;',1792828034),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba','i:4;',1792826361),
('laravel-cache-5c785c036466adea360111aa28563bfd556b5fba:timer','i:1792826361;',1792826361);

/*Table structure for table `cache_locks` */

DROP TABLE IF EXISTS `cache_locks`;

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `cache_locks` */

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_post_id_foreign` (`post_id`),
  CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `comments` */

insert  into `comments`(`id`,`post_id`,`name`,`email`,`content`,`status`,`created_at`,`updated_at`) values 
(1,4,'Lâm Quang Tình','0961072317bg@gmail.com','ok do','pending','2026-10-24 07:40:54','2026-10-24 07:40:54'),
(2,1,'Lâm Quang Tình','0961072317bg@gmail.com','Cảm ơn bạn đã chia sẻ','approved','2026-10-24 07:46:14','2026-10-24 07:46:14');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `job_batches` */

DROP TABLE IF EXISTS `job_batches`;

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `job_batches` */

/*Table structure for table `jobs` */

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_10_24_052658_create_posts_table',2),
(5,'2026_10_24_052704_create_comments_table',2),
(6,'2026_10_24_053210_add_username_to_users_table',2),
(7,'2026_10_24_054025_add_is_admin_to_users_table',3);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `excerpt` varchar(500) DEFAULT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'published',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `posts_slug_unique` (`slug`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`user_id`,`title`,`slug`,`excerpt`,`content`,`image`,`status`,`created_at`,`updated_at`) values 
(1,1,'Chào mừng bạn đến với Tình Kendy Blog','chao-mung-ban-den-voi-tinh-kendy-blog','Chào mừng bạn đến với Tình Kendy Blog — không gian chia sẻ kiến thức, trải nghiệm và những góc nhìn của mình về cuộc sống.\r\n\r\nMình tạo blog này với mong muốn lưu giữ những điều đã học được, chia sẻ kinh nghiệm hữu ích và kết nối với những người có cùng sở thích.','Mình sẽ chia sẻ những gì?\r\n\r\nCông nghệ: Những kiến thức về lập trình, website và các công cụ công nghệ hữu ích.\r\n\r\nHọc tập: Kinh nghiệm học tập, phát triển kỹ năng và quản lý thời gian.\r\n\r\nTrải nghiệm cá nhân: Những câu chuyện, suy nghĩ và bài học trong cuộc sống.\r\n\r\nSáng tạo: Những ý tưởng và dự án mà mình đang thực hiện.\r\n\r\nCùng nhau phát triển.\r\n\r\nMình tin rằng mỗi trải nghiệm đều mang lại một bài học đáng nhớ. Hy vọng những bài viết tại đây sẽ đem đến cho bạn thông tin hữu ích, cảm hứng và những góc nhìn mới.\r\n\r\nCảm ơn bạn đã ghé thăm Tình Kendy Blog. Hãy cùng theo dõi những bài viết tiếp theo nhé!','posts/FhIIporksdIX0JU4iZFrX7PzMxIhbwbWT3I3xjbC.jpg','published','2026-10-24 07:22:14','2026-10-24 07:47:09'),
(2,1,'Lộ trình học PHP Full Stack từ con số 0 đến khi đi làm.','lo-trinh-hoc-php-full-stack-tu-con-so-0-den-khi-di-lam','Tổng quan các bước và kiến thức cốt lõi cần nắm vững để trở thành một lập trình viên PHP Full Stack chuyên nghiệp trong thời gian ngắn.','PHP vẫn luôn là một trong những ngôn ngữ lập trình phổ biến nhất thế giới trong việc phát triển web. Để trở thành một lập trình viên PHP Full Stack, bạn cần trang bị cả kiến thức Front-end và Back-end.\r\n\r\n1. Giai đoạn Front-end cơ bản:\r\n\r\nNắm vững HTML5, CSS3, JavaScript (ES6+).\r\n\r\nSử dụng thành thạo các CSS Framework như Bootstrap hoặc Tailwind CSS để thiết kế giao diện responsive.\r\n\r\n2. Giai đoạn Back-end PHP:\r\n\r\nHọc cú pháp PHP cơ bản và nâng cao (OOP - Lập trình hướng đối tượng).\r\n\r\nLàm việc với cơ sở dữ liệu MySQL, quản trị qua phpMyAdmin hoặc SQLyog, viết câu lệnh SQL tối ưu.\r\n\r\n3. Làm chủ Laravel Framework:\r\n\r\nHiểu rõ mô hình MVC (Model - View - Controller).\r\n\r\nThành thạo Blade Template, Eloquent ORM, Migration, Seeder và Routing.\r\n\r\nXây dựng các dự án thực tế như website tin tức, thương mại điện tử hoặc hệ thống quản trị nội dung (CMS).','posts/0Rjr3P6FDf8gtVwDDbrLi1Rm2pG4aY2so2O8KXh3.jpg','published','2026-10-24 07:32:02','2026-10-24 07:32:02'),
(3,1,'Xây dựng hệ thống Authentication bảo mật trong Laravel','xay-dung-he-thong-authentication-bao-mat-trong-laravel','Hướng dẫn cấu hình và triển khai tính năng Đăng ký, Đăng nhập và phân quyền người dùng nhanh chóng sử dụng các gói công cụ chính thức của Laravel.','Xác thực người dùng (Authentication) là một phần không thể thiếu trong bất kỳ ứng dụng web Full Stack nào. Laravel cung cấp sẵn các giải pháp cực kỳ mạnh mẽ và tiện lợi như Laravel Breeze, Jetstream hoặc Fortify.\r\n\r\nCác bước triển khai cơ bản:\r\n\r\nCấu hình Database: Kết nối ứng dụng với cơ sở dữ liệu MySQL thông qua file .env.\r\n\r\nCài đặt gói Authentication: Sử dụng Composer để cài đặt Laravel Breeze với Blade stack cho các dự án vừa và nhỏ.\r\n\r\nBash\r\ncomposer require laravel/breeze --dev\r\nphp artisan breeze:install\r\nChạy Migration: Thực thi lệnh php artisan migrate để tạo các bảng users, password_resets,...\r\n\r\nTùy chỉnh giao diện & Middleware: Bảo vệ các tuyến đường (routes) quản trị viên bằng middleware để ngăn chặn quyền truy cập trái phép từ người dùng thông thường.','posts/NwzV1hNglCIOTyJocbjjhdhGiQ1lbq9BfQ9Gvuer.webp','published','2026-10-24 07:35:54','2026-10-24 07:35:54'),
(4,1,'Tối ưu hóa hiệu năng ứng dụng Web PHP với Eloquent ORM','toi-uu-hoa-hieu-nang-ung-dung-web-php-voi-eloquent-orm','Mẹo khắc phục lỗi N+1 Query và cách sử dụng Eager Loading trong Laravel để tăng tốc độ tải trang cho website lớn.','Khi phát triển các ứng dụng web Full Stack với lượng dữ liệu lớn, việc tối ưu hóa các truy vấn cơ sở dữ liệu đóng vai trò quyết định đến tốc độ phản hồi của trang web. Một trong những lỗi phổ biến nhất mà lập trình viên hay gặp phải là lỗi N+1 Query Problem.\r\n\r\nGiải pháp khắc phục:\r\n\r\nSử dụng Eager Loading (with): Thay vì gọi truy vấn lấy quan hệ trong vòng lặp gây nặng hệ thống, hãy tải sẵn các bảng liên quan ngay từ câu truy vấn ban đầu.\r\n\r\nPHP\r\n$posts = Post::with(\'user\', \'comments\')->get();\r\nSử dụng Database Index: Đặt chỉ mục (index) cho các cột thường xuyên được dùng để tìm kiếm hoặc làm khóa ngoại như user_id, post_id để tăng tốc độ truy vấn từ MySQL.','posts/Yc9VCRDqOuYzC4agKI4FR2sRh4kUq6KbZcdkTQcF.jpg','published','2026-10-24 07:37:23','2026-10-24 07:37:23');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('uJczjEvwqC74NBPsbq06PuGDxq2Vp2LKhdqMc9Jr',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaDkwaGd0a0VnaTV6Smt2aWxyWFU4SkpHT1A5YnlwREZNcG5sNGppaCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2NDoiZjYzYmJlYWM0ZWNiZWU3NjliMGQyNGEwNjMzNjg1ZmU1Mzc3MzBhMDZkNjFiNTIxM2FmYmFiMmNmOTkwNDQxMSI7fQ==',1792828088),
('zEpeMuVkm0SjUmVpb2CBxWJWy3pRCn888qJpcgEx',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.143.1 Chrome/150.0.7871.250 Electron/43.7.7 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiek41ZEtTWXFCT1RJb0F3Z3NPSFFBeHJVSFVWSmFBZVpKSUFmSFljaSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792824548);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`,`username`,`is_admin`) values 
(1,'Tinh Kendy','admin@example.com',NULL,'$2y$12$HVvc7hlsoah8War2EJ8QQ.m9O3wTb/lOxnrgts93S/2XW3Pc1EqZi','nPySGFiiFUbbVytOn0oVuZPbyvyRoVg37dRlSSlGsh1XS0U7ANpbDRQvbvBW','2026-10-24 05:55:39','2026-10-24 07:17:37','Tinhkendy',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
