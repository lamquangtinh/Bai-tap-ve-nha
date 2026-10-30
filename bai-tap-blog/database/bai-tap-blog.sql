/*
SQLyog Community v13.3.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - bai_tap_blog
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bai_tap_blog` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;

USE `bai_tap_blog`;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'0001_01_01_000000_create_users_table',1),
(2,'0001_01_01_000001_create_cache_table',1),
(3,'0001_01_01_000002_create_jobs_table',1),
(4,'2026_10_27_085727_create_posts_table',1);

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
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_foreign` (`user_id`),
  CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `posts` */

insert  into `posts`(`id`,`user_id`,`title`,`content`,`image`,`created_at`,`updated_at`) values 
(1,1,'Laravel là gì? Tìm hiểu kiến trúc MVC và cách Laravel hoạt động.','1. Laravel là gì?\r\n\r\nLaravel là một PHP Framework mã nguồn mở được sử dụng để phát triển các ứng dụng và website. Laravel cung cấp sẵn nhiều công cụ và thư viện giúp lập trình viên xây dựng dự án nhanh chóng, dễ quản lý và có cấu trúc rõ ràng.\r\n\r\nThay vì phải tự viết toàn bộ chức năng từ đầu, Laravel hỗ trợ nhiều thành phần phổ biến như:\r\n\r\nHệ thống định tuyến (Routing).\r\n\r\nKết nối và thao tác cơ sở dữ liệu.\r\n\r\nXác thực người dùng (Authentication).\r\n\r\nQuản lý giao diện với Blade Template.\r\n\r\nXử lý biểu mẫu và dữ liệu đầu vào.\r\n\r\nBảo mật ứng dụng.\r\n\r\nQuản lý tác vụ và gửi email.\r\n\r\nNhờ những tính năng này, Laravel là một lựa chọn phù hợp để phát triển website tin tức, blog cá nhân, hệ thống quản lý và các ứng dụng web.\r\n\r\n2. Những ưu điểm nổi bật của Laravel\r\n\r\n2.1. Cấu trúc mã nguồn rõ ràng\r\n\r\nLaravel tổ chức mã nguồn theo những thư mục và quy ước nhất định. Điều này giúp lập trình viên dễ dàng tìm kiếm, chỉnh sửa và bảo trì chương trình.\r\n\r\n2.2. Hỗ trợ nhiều loại cơ sở dữ liệu\r\n\r\nLaravel hỗ trợ làm việc với nhiều hệ quản trị cơ sở dữ liệu như MySQL, PostgreSQL, SQLite và SQL Server.\r\n\r\nThông qua Eloquent ORM, lập trình viên có thể thao tác với dữ liệu bằng các đối tượng PHP mà không cần viết quá nhiều câu lệnh SQL thủ công.\r\n\r\n2.3. Hệ thống định tuyến linh hoạt\r\n\r\nLaravel cho phép xác định các đường dẫn URL và quy định chức năng cần thực hiện khi người dùng truy cập vào từng đường dẫn.\r\n\r\nVí dụ:\r\n\r\nuse Illuminate\\Support\\Facades\\Route;\r\n\r\nRoute::get(\'/\', function () {\r\n    return view(\'welcome\');\r\n});\r\n\r\nRoute::get(\'/about\', function () {\r\n    return \'Đây là trang giới thiệu\';\r\n});\r\n\r\nKhi truy cập /about, trình duyệt sẽ nhận được nội dung giới thiệu.\r\n\r\n2.4. Hỗ trợ bảo mật\r\n\r\nLaravel cung cấp nhiều cơ chế bảo vệ ứng dụng như CSRF protection, mã hóa mật khẩu, xác thực dữ liệu đầu vào và cơ chế phân quyền.\r\n\r\nTuy nhiên, lập trình viên vẫn cần cấu hình và sử dụng đúng cách để đảm bảo an toàn cho hệ thống.\r\n\r\n3. Kiến trúc MVC trong Laravel là gì?\r\n\r\nMVC là viết tắt của Model – View – Controller. Đây là mô hình kiến trúc phần mềm giúp phân chia ứng dụng thành ba thành phần chính.\r\n\r\n3.1. Model – Quản lý dữ liệu\r\n\r\nModel chịu trách nhiệm làm việc với dữ liệu và cơ sở dữ liệu.\r\n\r\nTrong Laravel, Model thường được sử dụng kết hợp với Eloquent ORM để thực hiện các thao tác thêm, sửa, xóa và truy vấn dữ liệu.\r\n\r\nVí dụ, tạo một Model có tên Post:\r\n\r\nphp artisan make:model Post\r\n\r\nLaravel sẽ tạo file:\r\n\r\napp/Models/Post.php\r\n\r\nVí dụ sử dụng Model:\r\n\r\nuse App\\Models\\Post;\r\n\r\n// Lấy tất cả bài viết\r\n$posts = Post::all();\r\n\r\n// Tìm bài viết theo ID\r\n$post = Post::find(1);\r\n\r\n3.2. View – Hiển thị giao diện\r\n\r\nView chịu trách nhiệm hiển thị nội dung cho người dùng.\r\n\r\nLaravel sử dụng Blade Template Engine để xây dựng giao diện website.\r\n\r\nVí dụ:\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>TechInsights</title>\r\n</head>\r\n<body>\r\n    <h1>Chào mừng đến với TechInsights</h1>\r\n    <p>Chia sẻ kiến thức lập trình và công nghệ.</p>\r\n</body>\r\n</html>\r\n\r\nCác file giao diện Blade thường có phần mở rộng .blade.php và được lưu trong thư mục resources/views.\r\n\r\n3.3. Controller – Xử lý nghiệp vụ\r\n\r\nController đóng vai trò tiếp nhận yêu cầu, xử lý logic nghiệp vụ và điều phối dữ liệu giữa Model với View.\r\n\r\nĐể tạo một Controller, sử dụng lệnh:\r\n\r\nphp artisan make:controller PostController\r\n\r\nVí dụ:\r\n\r\nnamespace App\\Http\\Controllers;\r\n\r\nuse App\\Models\\Post;\r\n\r\nclass PostController extends Controller\r\n{\r\n    public function index()\r\n    {\r\n        $posts = Post::all();\r\n\r\n        return view(\'posts.index\', compact(\'posts\'));\r\n    }\r\n}\r\n\r\nController lấy dữ liệu bài viết từ Model và gửi dữ liệu đến View để hiển thị.\r\n\r\n4. Quy trình hoạt động của MVC trong Laravel\r\n\r\nKhi người dùng truy cập một trang web Laravel, quá trình xử lý cơ bản diễn ra như sau:\r\n\r\nBước 1: Người dùng gửi yêu cầu bằng cách truy cập một URL.\r\n\r\nBước 2: Laravel tiếp nhận yêu cầu và kiểm tra file định tuyến trong thư mục routes.\r\n\r\nBước 3: Route chuyển yêu cầu đến Controller tương ứng.\r\n\r\nBước 4: Controller xử lý nghiệp vụ và gọi Model khi cần truy xuất hoặc cập nhật dữ liệu.\r\n\r\nBước 5: Model làm việc với cơ sở dữ liệu và trả kết quả về Controller.\r\n\r\nBước 6: Controller chuyển dữ liệu đến View.\r\n\r\nBước 7: View tạo giao diện HTML và trả kết quả về trình duyệt.\r\n\r\nCó thể hình dung luồng xử lý cơ bản:\r\n\r\n        Người dùng\r\n             |\r\n             v\r\n           Route\r\n             |\r\n             v\r\n         Controller\r\n             |\r\n             v\r\n           Model\r\n             |\r\n             v\r\n         Database\r\n             |\r\n             v\r\n         Controller\r\n             |\r\n             v\r\n           View\r\n             |\r\n             v\r\n       Hiển thị website\r\n\r\n5. Cấu trúc thư mục cơ bản của Laravel\r\n\r\nKhi tạo một dự án Laravel, bạn sẽ thấy nhiều thư mục và file khác nhau. Một số thành phần quan trọng gồm:\r\n\r\nThư mục / File\r\n\r\nChức năng\r\n\r\napp/Models\r\n\r\nChứa các Model\r\n\r\napp/Http/Controllers\r\n\r\nChứa các Controller\r\n\r\nroutes/web.php\r\n\r\nKhai báo các Route cho website\r\n\r\nresources/views\r\n\r\nChứa các giao diện Blade\r\n\r\ndatabase/migrations\r\n\r\nQuản lý cấu trúc bảng dữ liệu\r\n\r\npublic\r\n\r\nChứa tài nguyên công khai\r\n\r\nconfig\r\n\r\nChứa các file cấu hình\r\n\r\n.env\r\n\r\nChứa cấu hình môi trường\r\n\r\nstorage\r\n\r\nLưu trữ log và dữ liệu do ứng dụng tạo ra\r\n\r\nHiểu được cấu trúc thư mục sẽ giúp bạn làm việc hiệu quả hơn khi phát triển dự án Laravel.\r\n\r\n6. Tạo dự án Laravel đầu tiên\r\n\r\nĐể bắt đầu một dự án Laravel mới, bạn cần cài đặt PHP và Composer trước.\r\n\r\nMở Terminal và thực hiện lệnh:\r\n\r\ncomposer create-project laravel/laravel techinsights\r\n\r\nSau khi cài đặt hoàn tất, truy cập vào thư mục dự án:\r\n\r\ncd techinsights\r\n\r\nKhởi chạy máy chủ phát triển:\r\n\r\nphp artisan serve\r\n\r\nMặc định, Laravel sẽ cung cấp địa chỉ truy cập:\r\n\r\nhttp://127.0.0.1:8000\r\n\r\nMở địa chỉ trên bằng trình duyệt để kiểm tra website.\r\n\r\n7. Laravel phù hợp với những dự án nào?\r\n\r\nLaravel có thể được sử dụng để phát triển nhiều loại ứng dụng web khác nhau, chẳng hạn:\r\n\r\nBlog cá nhân và website chia sẻ kiến thức.\r\n\r\nWebsite bán hàng trực tuyến.\r\n\r\nHệ thống quản lý sinh viên.\r\n\r\nWebsite quản lý sản phẩm và kho hàng.\r\n\r\nHệ thống quản lý người dùng.\r\n\r\nWebsite tin tức và nội dung.\r\n\r\nĐối với sinh viên ngành Công nghệ thông tin, việc thực hành Laravel thông qua một dự án thực tế là cách tốt để củng cố kiến thức PHP, cơ sở dữ liệu và lập trình web.\r\n\r\n8. Kết luận\r\n\r\nLaravel là một PHP Framework mạnh mẽ, cung cấp nhiều công cụ hữu ích giúp phát triển ứng dụng web nhanh chóng và có tổ chức.\r\n\r\nViệc hiểu rõ mô hình MVC cùng cấu trúc thư mục sẽ là nền tảng quan trọng trước khi bạn bắt đầu xây dựng những chức năng phức tạp hơn như đăng nhập, quản lý bài viết, phân quyền và kết nối cơ sở dữ liệu.\r\n\r\nHy vọng bài viết đã giúp bạn có cái nhìn tổng quan hơn về Laravel và cách Framework này hoạt động.\r\n\r\nTechInsights – Chia sẻ kiến thức, kết nối đam mê công nghệ.','posts/UQ97y8Mr9Wg7OFPZiw4WgYaG62jYmIm76UdAYHF0.webp','2026-10-30 16:14:34','2026-10-30 16:14:34'),
(2,1,'Hướng dẫn xây dựng chức năng CRUD trong Laravel từ A–Z','1. CRUD trong Laravel là gì?\r\n\r\nCRUD là viết tắt của bốn thao tác cơ bản trong quản lý dữ liệu:\r\n\r\nCreate: Thêm dữ liệu mới.\r\n\r\nRead: Hiển thị và đọc dữ liệu.\r\n\r\nUpdate: Chỉnh sửa dữ liệu đã tồn tại.\r\n\r\nDelete: Xóa dữ liệu.\r\n\r\nTrong quá trình phát triển website, CRUD là một chức năng gần như không thể thiếu. Ví dụ, đối với một website blog, người quản trị cần có khả năng đăng bài viết mới, xem danh sách bài viết, chỉnh sửa nội dung và xóa những bài viết không còn cần thiết.\r\n\r\nLaravel hỗ trợ xây dựng các chức năng CRUD thông qua Model, View, Controller (MVC), kết hợp với Eloquent ORM và hệ thống Routing.\r\n\r\nTrong bài viết này, chúng ta sẽ thực hành xây dựng chức năng quản lý bài viết bằng Laravel và MySQL.\r\n\r\n2. Chuẩn bị dự án\r\n\r\nTrước khi bắt đầu, bạn cần có:\r\n\r\nPHP và Composer.\r\n\r\nMột dự án Laravel đã được cài đặt.\r\n\r\nMySQL hoặc XAMPP.\r\n\r\nVisual Studio Code hoặc một trình soạn thảo mã nguồn khác.\r\n\r\nĐầu tiên, mở Terminal tại thư mục dự án:\r\n\r\nphp artisan serve\r\n\r\nĐảm bảo dự án Laravel có thể khởi chạy bình thường.\r\n\r\nTiếp theo, kiểm tra cấu hình kết nối MySQL trong file .env. Ví dụ:\r\n\r\nDB_CONNECTION=mysql\r\nDB_HOST=127.0.0.1\r\nDB_PORT=3306\r\nDB_DATABASE=techinsights\r\nDB_USERNAME=root\r\nDB_PASSWORD=\r\n\r\nHãy thay đổi thông tin cho phù hợp với cấu hình MySQL trên máy tính của bạn.\r\n\r\n3. Tạo Model và Migration\r\n\r\nLaravel sử dụng Model để làm việc với dữ liệu và Migration để quản lý cấu trúc bảng trong cơ sở dữ liệu.\r\n\r\nChạy lệnh sau:\r\n\r\nphp artisan make:model Post -m\r\n\r\nLệnh này tạo ra:\r\n\r\nFile Model: app/Models/Post.php\r\n\r\nFile Migration trong: database/migrations\r\n\r\nMở file Migration vừa được tạo và chỉnh sửa nội dung phương thức up():\r\n\r\npublic function up(): void\r\n{\r\n    Schema::create(\'posts\', function (Blueprint $table) {\r\n        $table->id();\r\n        $table->string(\'title\');\r\n        $table->text(\'content\');\r\n        $table->timestamps();\r\n    });\r\n}\r\n\r\nGiải thích:\r\n\r\nid() tạo khóa chính tự tăng.\r\n\r\nstring(\'title\') lưu tiêu đề bài viết.\r\n\r\ntext(\'content\') lưu nội dung bài viết.\r\n\r\ntimestamps() tạo hai trường created_at và updated_at.\r\n\r\nSau khi hoàn thành, chạy lệnh:\r\n\r\nphp artisan migrate\r\n\r\nLaravel sẽ tạo bảng posts trong cơ sở dữ liệu.\r\n\r\n4. Cấu hình Model Post\r\n\r\nMở file:\r\n\r\napp/Models/Post.php\r\n\r\nThêm thuộc tính $fillable:\r\n\r\n<?php\r\n\r\nnamespace App\\Models;\r\n\r\nuse Illuminate\\Database\\Eloquent\\Model;\r\n\r\nclass Post extends Model\r\n{\r\n    protected $fillable = [\r\n        \'title\',\r\n        \'content\',\r\n    ];\r\n}\r\n\r\nThuộc tính $fillable xác định những trường dữ liệu được phép gán hàng loạt thông qua các phương thức như create() và update().\r\n\r\nĐây là bước quan trọng để tránh lỗi Mass Assignment khi thêm hoặc chỉnh sửa bài viết.\r\n\r\n5. Tạo Controller quản lý bài viết\r\n\r\nController chịu trách nhiệm xử lý các yêu cầu từ người dùng và tương tác với Model.\r\n\r\nChạy lệnh:\r\n\r\nphp artisan make:controller PostController\r\n\r\nMở file:\r\n\r\napp/Http/Controllers/PostController.php\r\n\r\nThay nội dung bằng đoạn mã sau:\r\n\r\n<?php\r\n\r\nnamespace App\\Http\\Controllers;\r\n\r\nuse App\\Models\\Post;\r\nuse Illuminate\\Http\\Request;\r\n\r\nclass PostController extends Controller\r\n{\r\n    // Hiển thị danh sách bài viết\r\n    public function index()\r\n    {\r\n        $posts = Post::latest()->get();\r\n\r\n        return view(\'posts.index\', compact(\'posts\'));\r\n    }\r\n\r\n    // Hiển thị form thêm bài viết\r\n    public function create()\r\n    {\r\n        return view(\'posts.create\', [\r\n            \'post\' => new Post()\r\n        ]);\r\n    }\r\n\r\n    // Lưu bài viết mới\r\n    public function store(Request $request)\r\n    {\r\n        $validated = $request->validate([\r\n            \'title\' => \'required|string|max:255\',\r\n            \'content\' => \'required|string\',\r\n        ]);\r\n\r\n        Post::create($validated);\r\n\r\n        return redirect()\r\n            ->route(\'posts.index\')\r\n            ->with(\'success\', \'Thêm bài viết thành công!\');\r\n    }\r\n\r\n    // Hiển thị chi tiết bài viết\r\n    public function show(Post $post)\r\n    {\r\n        return view(\'posts.show\', compact(\'post\'));\r\n    }\r\n\r\n    // Hiển thị form chỉnh sửa\r\n    public function edit(Post $post)\r\n    {\r\n        return view(\'posts.edit\', compact(\'post\'));\r\n    }\r\n\r\n    // Cập nhật bài viết\r\n    public function update(Request $request, Post $post)\r\n    {\r\n        $validated = $request->validate([\r\n            \'title\' => \'required|string|max:255\',\r\n            \'content\' => \'required|string\',\r\n        ]);\r\n\r\n        $post->update($validated);\r\n\r\n        return redirect()\r\n            ->route(\'posts.index\')\r\n            ->with(\'success\', \'Cập nhật bài viết thành công!\');\r\n    }\r\n\r\n    // Xóa bài viết\r\n    public function destroy(Post $post)\r\n    {\r\n        $post->delete();\r\n\r\n        return redirect()\r\n            ->route(\'posts.index\')\r\n            ->with(\'success\', \'Xóa bài viết thành công!\');\r\n    }\r\n}\r\n\r\nTrong Controller trên, chúng ta sử dụng bảy phương thức để xử lý các thao tác của hệ thống:\r\n\r\nPhương thức\r\n\r\nChức năng\r\n\r\nindex()\r\n\r\nHiển thị danh sách\r\n\r\ncreate()\r\n\r\nMở form thêm mới\r\n\r\nstore()\r\n\r\nLưu dữ liệu\r\n\r\nshow()\r\n\r\nXem chi tiết\r\n\r\nedit()\r\n\r\nMở form chỉnh sửa\r\n\r\nupdate()\r\n\r\nCập nhật dữ liệu\r\n\r\ndestroy()\r\n\r\nXóa dữ liệu\r\n\r\nNgoài ra, Laravel còn cung cấp Route Model Binding để tự động tìm kiếm bản ghi dựa trên ID truyền qua URL.\r\n\r\n6. Khai báo Route\r\n\r\nMở file:\r\n\r\nroutes/web.php\r\n\r\nThêm đoạn mã:\r\n\r\nuse App\\Http\\Controllers\\PostController;\r\nuse Illuminate\\Support\\Facades\\Route;\r\n\r\nRoute::resource(\'posts\', PostController::class);\r\n\r\nVới một dòng khai báo Route::resource(), Laravel sẽ tự động tạo các đường dẫn phục vụ đầy đủ chức năng CRUD.\r\n\r\nCác đường dẫn cơ bản gồm:\r\n\r\nPhương thức HTTP\r\n\r\nURL\r\n\r\nChức năng\r\n\r\nGET\r\n\r\n/posts\r\n\r\nDanh sách bài viết\r\n\r\nGET\r\n\r\n/posts/create\r\n\r\nForm thêm bài viết\r\n\r\nPOST\r\n\r\n/posts\r\n\r\nLưu bài viết\r\n\r\nGET\r\n\r\n/posts/{post}\r\n\r\nChi tiết bài viết\r\n\r\nGET\r\n\r\n/posts/{post}/edit\r\n\r\nForm chỉnh sửa\r\n\r\nPUT/PATCH\r\n\r\n/posts/{post}\r\n\r\nCập nhật\r\n\r\nDELETE\r\n\r\n/posts/{post}\r\n\r\nXóa bài viết\r\n\r\nBạn có thể kiểm tra danh sách Route bằng lệnh:\r\n\r\nphp artisan route:list\r\n\r\n7. Xây dựng giao diện hiển thị bài viết\r\n\r\nLaravel sử dụng Blade để xây dựng giao diện.\r\n\r\nĐầu tiên, tạo thư mục:\r\n\r\nresources/views/posts\r\n\r\nTrong thư mục này, tạo các file:\r\n\r\nresources/\r\n└── views/\r\n    └── posts/\r\n        ├── index.blade.php\r\n        ├── create.blade.php\r\n        ├── edit.blade.php\r\n        ├── show.blade.php\r\n        └── _form.blade.php\r\n\r\n7.1. Trang danh sách bài viết\r\n\r\nFile: index.blade.php\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>Quản lý bài viết</title>\r\n</head>\r\n<body>\r\n\r\n    <h1>Danh sách bài viết</h1>\r\n\r\n    @if(session(\'success\'))\r\n        <p style=\"color: green;\">\r\n            {{ session(\'success\') }}\r\n        </p>\r\n    @endif\r\n\r\n    <a href=\"{{ route(\'posts.create\') }}\">\r\n        Thêm bài viết mới\r\n    </a>\r\n\r\n    @forelse($posts as $post)\r\n        <hr>\r\n\r\n        <h2>{{ $post->title }}</h2>\r\n\r\n        <p>{{ Str::limit($post->content, 150) }}</p>\r\n\r\n        <a href=\"{{ route(\'posts.show\', $post) }}\">\r\n            Chi tiết\r\n        </a>\r\n\r\n        <a href=\"{{ route(\'posts.edit\', $post) }}\">\r\n            Chỉnh sửa\r\n        </a>\r\n\r\n        <form action=\"{{ route(\'posts.destroy\', $post) }}\"\r\n              method=\"POST\"\r\n              onsubmit=\"return confirm(\'Bạn có chắc muốn xóa?\')\">\r\n\r\n            @csrf\r\n            @method(\'DELETE\')\r\n\r\n            <button type=\"submit\">Xóa</button>\r\n        </form>\r\n    @empty\r\n        <p>Chưa có bài viết nào.</p>\r\n    @endforelse\r\n\r\n</body>\r\n</html>\r\n\r\n7.2. Tạo form thêm và chỉnh sửa bài viết\r\n\r\nĐể tránh viết lại phần biểu mẫu nhiều lần, chúng ta tạo một file dùng chung.\r\n\r\nFile: _form.blade.php\r\n\r\n<form action=\"{{ $post->exists\r\n    ? route(\'posts.update\', $post)\r\n    : route(\'posts.store\') }}\"\r\n    method=\"POST\">\r\n\r\n    @csrf\r\n\r\n    @if($post->exists)\r\n        @method(\'PUT\')\r\n    @endif\r\n\r\n    <div>\r\n        <label>Tiêu đề bài viết</label>\r\n\r\n        <input type=\"text\"\r\n               name=\"title\"\r\n               value=\"{{ old(\'title\', $post->title) }}\">\r\n\r\n        @error(\'title\')\r\n            <p style=\"color: red;\">{{ $message }}</p>\r\n        @enderror\r\n    </div>\r\n\r\n    <div>\r\n        <label>Nội dung bài viết</label>\r\n\r\n        <textarea name=\"content\"\r\n                  rows=\"8\">{{ old(\'content\', $post->content) }}</textarea>\r\n\r\n        @error(\'content\')\r\n            <p style=\"color: red;\">{{ $message }}</p>\r\n        @enderror\r\n    </div>\r\n\r\n    <button type=\"submit\">\r\n        {{ $post->exists ? \'Cập nhật\' : \'Đăng bài\' }}\r\n    </button>\r\n</form>\r\n\r\n7.3. Trang thêm bài viết\r\n\r\nFile: create.blade.php\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>Thêm bài viết</title>\r\n</head>\r\n<body>\r\n\r\n    <h1>Thêm bài viết mới</h1>\r\n\r\n    @include(\'posts._form\')\r\n\r\n    <a href=\"{{ route(\'posts.index\') }}\">\r\n        Quay lại\r\n    </a>\r\n\r\n</body>\r\n</html>\r\n\r\n7.4. Trang chỉnh sửa bài viết\r\n\r\nFile: edit.blade.php\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>Chỉnh sửa bài viết</title>\r\n</head>\r\n<body>\r\n\r\n    <h1>Chỉnh sửa bài viết</h1>\r\n\r\n    @include(\'posts._form\')\r\n\r\n    <a href=\"{{ route(\'posts.index\') }}\">\r\n        Quay lại\r\n    </a>\r\n\r\n</body>\r\n</html>\r\n\r\n7.5. Trang xem chi tiết bài viết\r\n\r\nFile: show.blade.php\r\n\r\n<!DOCTYPE html>\r\n<html>\r\n<head>\r\n    <title>{{ $post->title }}</title>\r\n</head>\r\n<body>\r\n\r\n    <h1>{{ $post->title }}</h1>\r\n\r\n    <p>{{ $post->content }}</p>\r\n\r\n    <small>\r\n        Ngày đăng: {{ $post->created_at->format(\'d/m/Y H:i\') }}\r\n    </small>\r\n\r\n    <br>\r\n\r\n    <a href=\"{{ route(\'posts.edit\', $post) }}\">\r\n        Chỉnh sửa\r\n    </a>\r\n\r\n    <a href=\"{{ route(\'posts.index\') }}\">\r\n        Quay lại danh sách\r\n    </a>\r\n\r\n</body>\r\n</html>\r\n\r\n8. Chạy thử chức năng CRUD\r\n\r\nSau khi hoàn thành các bước trên, khởi động Laravel:\r\n\r\nphp artisan serve\r\n\r\nTruy cập địa chỉ:\r\n\r\nhttp://127.0.0.1:8000/posts\r\n\r\nBạn có thể lần lượt kiểm tra các chức năng:\r\n\r\nThêm bài viết: Nhấn nút thêm bài viết, nhập tiêu đề và nội dung, sau đó đăng bài.\r\n\r\nXem bài viết: Nhấn vào đường dẫn chi tiết để xem nội dung đầy đủ.\r\n\r\nChỉnh sửa: Chọn chỉnh sửa, thay đổi thông tin và lưu lại.\r\n\r\nXóa bài viết: Nhấn nút xóa và xác nhận thao tác.\r\n\r\nNếu các thao tác hoạt động bình thường, bạn đã xây dựng thành công chức năng CRUD cơ bản trong Laravel.\r\n\r\n9. Một số lỗi thường gặp khi xây dựng CRUD\r\n\r\nLỗi Mass Assignment Exception\r\n\r\nNguyên nhân: Model chưa khai báo các trường dữ liệu trong $fillable.\r\n\r\nCách khắc phục: Kiểm tra lại Model và bổ sung các trường được phép lưu.\r\n\r\nLỗi 419 Page Expired\r\n\r\nNguyên nhân thường gặp: Form chưa có CSRF token.\r\n\r\nCách khắc phục: Thêm @csrf vào các biểu mẫu gửi dữ liệu bằng POST, PUT, PATCH hoặc DELETE.\r\n\r\nLỗi Table doesn\'t exist\r\n\r\nNguyên nhân: Bảng dữ liệu chưa được tạo trong MySQL.\r\n\r\nCách khắc phục:\r\n\r\nphp artisan migrate\r\n\r\nLỗi Route not defined\r\n\r\nNguyên nhân: Tên Route hoặc cách khai báo Route chưa chính xác.\r\n\r\nCách khắc phục: Kiểm tra routes/web.php và sử dụng:\r\n\r\nphp artisan route:list\r\n\r\n10. Kết luận\r\n\r\nCRUD là nền tảng quan trọng trong phát triển ứng dụng web. Thông qua bài thực hành này, bạn đã tìm hiểu cách kết hợp Model, Migration, Controller, Route và Blade để xây dựng một hệ thống quản lý bài viết cơ bản.\r\n\r\nSau khi nắm vững CRUD, bạn có thể tiếp tục phát triển thêm các chức năng như tìm kiếm bài viết, phân trang, tải ảnh lên, phân quyền người dùng và quản lý danh mục.\r\n\r\nĐây cũng là nền tảng cần thiết để xây dựng các hệ thống thực tế như website blog, website bán hàng và hệ thống quản trị nội dung.\r\n\r\nTechInsights – Chia sẻ kiến thức, kết nối đam mê công nghệ.','posts/nO85cIS29h51Sp6aydk0s0dJsjL99SflXOHdrcIF.webp','2026-10-30 16:17:38','2026-10-30 16:17:38'),
(3,2,'Laravel Validation – Kiểm tra dữ liệu đầu vào trong Laravel','1. Laravel Validation là gì?\r\n\r\nValidation là quá trình kiểm tra tính hợp lệ của dữ liệu trước khi lưu vào cơ sở dữ liệu.\r\n\r\nTrong Laravel, Validation giúp hạn chế dữ liệu sai định dạng, thiếu thông tin hoặc không đáp ứng yêu cầu của hệ thống.\r\n\r\nVí dụ: Khi người dùng đăng ký tài khoản, hệ thống cần kiểm tra email có hợp lệ hay không và mật khẩu có đủ độ dài hay không.\r\n\r\n2. Cách sử dụng Validation trong Laravel\r\n\r\nLaravel cung cấp phương thức validate() để kiểm tra dữ liệu nhận được từ biểu mẫu.\r\n\r\nVí dụ trong Controller:\r\n\r\npublic function store(Request $request)\r\n{\r\n    $validated = $request->validate([\r\n        \'name\' => \'required|string|max:255\',\r\n        \'email\' => \'required|email\',\r\n        \'password\' => \'required|min:8\',\r\n    ]);\r\n\r\n    // Xử lý dữ liệu hợp lệ\r\n}\r\n\r\nTrong đó:\r\n\r\nrequired: Trường dữ liệu bắt buộc.\r\n\r\nstring: Dữ liệu phải là chuỗi.\r\n\r\nmax:255: Độ dài tối đa 255 ký tự.\r\n\r\nemail: Kiểm tra định dạng email.\r\n\r\nmin:8: Độ dài tối thiểu 8 ký tự.\r\n\r\nNếu dữ liệu không hợp lệ, Laravel tự động chuyển hướng trở lại trang trước và cung cấp thông tin lỗi.\r\n\r\n3. Hiển thị thông báo lỗi trên giao diện\r\n\r\nTrong file Blade, bạn có thể sử dụng @error để hiển thị thông báo:\r\n\r\n<input type=\"email\" name=\"email\">\r\n\r\n@error(\'email\')\r\n    <span style=\"color:red\">\r\n        {{ $message }}\r\n    </span>\r\n@enderror\r\n\r\nNgoài ra, có thể sử dụng old() để giữ lại dữ liệu người dùng đã nhập khi biểu mẫu gặp lỗi.\r\n\r\n4. Kết luận\r\n\r\nLaravel Validation là công cụ quan trọng giúp đảm bảo chất lượng dữ liệu và nâng cao độ an toàn cho ứng dụng web.\r\n\r\nViệc sử dụng Validation đúng cách sẽ giúp lập trình viên hạn chế lỗi trong quá trình xử lý dữ liệu, đồng thời mang lại trải nghiệm tốt hơn cho người dùng.\r\n\r\nTechInsights – Chia sẻ kiến thức, kết nối đam mê công nghệ.','posts/pBtWwRB5ygwtRVLAeuxKo4UHkFfD6ChF2GMcYBPP.jpg','2026-10-30 16:20:59','2026-10-30 16:20:59'),
(4,2,'Laravel Middleware là gì? Cách sử dụng Middleware trong Laravel','1. Middleware là gì?\r\n\r\nMiddleware trong Laravel là cơ chế trung gian giúp kiểm tra và xử lý các yêu cầu HTTP trước khi chúng được chuyển đến Controller.\r\n\r\nMiddleware thường được sử dụng để kiểm tra người dùng đã đăng nhập hay chưa, phân quyền truy cập, kiểm tra token hoặc lọc các yêu cầu không hợp lệ.\r\n\r\nVí dụ: Một website có trang quản trị chỉ dành cho Admin. Middleware sẽ kiểm tra quyền của người dùng trước khi cho phép truy cập.\r\n\r\n2. Tạo Middleware trong Laravel\r\n\r\nĐể tạo Middleware mới, mở Terminal tại thư mục dự án và chạy lệnh:\r\n\r\nphp artisan make:middleware CheckAdmin\r\n\r\nLaravel sẽ tạo file:\r\n\r\napp/Http/Middleware/CheckAdmin.php\r\n\r\nChỉnh sửa nội dung:\r\n\r\npublic function handle($request, Closure $next)\r\n{\r\n    if (!auth()->check() || auth()->user()->role !== \'admin\') {\r\n        abort(403, \'Bạn không có quyền truy cập!\');\r\n    }\r\n\r\n    return $next($request);\r\n}\r\n\r\nĐoạn mã trên kiểm tra người dùng đã đăng nhập và có quyền Admin hay chưa. Nếu không đáp ứng điều kiện, hệ thống trả về lỗi 403.\r\n\r\n3. Áp dụng Middleware cho Route\r\n\r\nTrong Laravel 11 và 12, bạn có thể đăng ký Middleware bằng cách thêm alias trong file bootstrap/app.php.\r\n\r\nVí dụ:\r\n\r\n->withMiddleware(function ($middleware) {\r\n    $middleware->alias([\r\n        \'admin\' => \\App\\Http\\Middleware\\CheckAdmin::class,\r\n    ]);\r\n})\r\n\r\nSau đó, áp dụng cho Route:\r\n\r\nRoute::middleware(\'admin\')->group(function () {\r\n    Route::get(\'/admin\', function () {\r\n        return \'Trang quản trị\';\r\n    });\r\n});\r\n\r\nNhư vậy, chỉ những người dùng đáp ứng điều kiện trong Middleware mới được truy cập trang quản trị.\r\n\r\n4. Kết luận\r\n\r\nMiddleware là thành phần quan trọng trong Laravel, giúp kiểm soát luồng truy cập và tăng cường bảo mật cho ứng dụng web.\r\n\r\nHiểu và sử dụng Middleware đúng cách sẽ giúp lập trình viên xây dựng hệ thống đăng nhập, phân quyền và quản lý người dùng hiệu quả hơn.\r\n\r\nTechInsights – Chia sẻ kiến thức, kết nối đam mê công nghệ.','posts/tC80tuyuDurJxPGepWx1Be16rcfBCFxplbVnA4sb.jpg','2026-10-30 16:22:05','2026-10-30 16:22:05');

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
('9GvoCMk2oHIESl4cYOgqyIzmfDVmAUEkeKCARd05',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiam9NbkM1bVFvUU83UllHOTZiaDZQMVBZbEpZSFBtZ0I5aUhnVEUwSyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO319',1793377380),
('Im3lLESpMvO9drLX0cFtMXhfADTGI3Y7VPDo1TQA',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.143.1 Chrome/150.0.7871.250 Electron/43.7.7 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiQUxIUWxPTlRqd3NJTGNaNHZzQk9nSGttYTE5R2xnRFZWWjYyVEJuUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wb3N0cyI7czo1OiJyb3V0ZSI7czoxMToicG9zdHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19',1793375923);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'Lâm Quang Tình','tinh@gmail.com',NULL,'$2y$12$OgxwT7bBdtmH7u917bG9ie5vHoEjL4cahbe7Ih.wP/nCOLCR4p2ne',NULL,'2026-10-30 16:08:04','2026-10-30 16:08:04'),
(2,'Tạ Phương Thảo','thao@gmail.com',NULL,'$2y$12$hS6nXeiyKtTgcAQypkHX.eGMXxOuZ.eoIjzwlq4DaoNabbted3Vu.',NULL,'2026-10-30 16:19:11','2026-10-30 16:19:11'),
(3,'Tình Kendy','tinh1@gmail.com',NULL,'$2y$12$e6GPz/JDuIMv1K/scmfqtusQinrYP1ikliG1vYFRi8djE8324CjQy',NULL,'2026-10-30 16:22:38','2026-10-30 16:22:55');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
