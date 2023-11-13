

CREATE TABLE `books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` bigint(20) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `locations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location_b` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `readings` (
  `reading_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `location_id` bigint(20) unsigned NOT NULL,
  `reading_text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `english_location_full` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hebrew_location_full` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_book_id` bigint(20) unsigned DEFAULT NULL,
  `org_book_page` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`reading_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `book_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `org_books` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `org_book_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO locations (`id`, `location_a`, `location_b`, `location_c`, `location_d`, `created_at`, `updated_at`) VALUES 
('1','Meforshim','Rashi','Shemos','1-2','','');

INSERT INTO locations (`id`, `location_a`, `location_b`, `location_c`, `location_d`, `created_at`, `updated_at`) VALUES 
('2','הומש','Bereishis','1','1-2','','');

INSERT INTO locations (`id`, `location_a`, `location_b`, `location_c`, `location_d`, `created_at`, `updated_at`) VALUES 
('3','הומש','Bereishis','1','','','');

INSERT INTO locations (`id`, `location_a`, `location_b`, `location_c`, `location_d`, `created_at`, `updated_at`) VALUES 
('4','הומש','Bereishis','','','','');

INSERT INTO readings (`reading_id`, `location_id`, `reading_text`, `translation`, `english_location_full`, `hebrew_location_full`, `org_book_id`, `org_book_page`, `created_at`, `updated_at`) VALUES 
('1','1','Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
            molestiae quas vel sint commodi repudiandae conse','ut! Impedit sit sunt quaerat, odit,
            tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit,','eng loc full a','הומש, בּראשׂית, פּרק ב, א-ב','1','34','2022-11-16 10:02:50','2022-11-16 10:02:50');

INSERT INTO readings (`reading_id`, `location_id`, `reading_text`, `translation`, `english_location_full`, `hebrew_location_full`, `org_book_id`, `org_book_page`, `created_at`, `updated_at`) VALUES 
('2','2','reading text b','translation b','eng loc full b','הומש, בּראשׂית, פּרק ב, ','1','2','2022-11-16 10:02:50','2022-11-16 10:02:50');

INSERT INTO readings (`reading_id`, `location_id`, `reading_text`, `translation`, `english_location_full`, `hebrew_location_full`, `org_book_id`, `org_book_page`, `created_at`, `updated_at`) VALUES 
('3','3','reading text c','translation c','eng loc full c','הומש, בּראשׂית, פּרק ב, ב','1','3','2022-11-16 10:02:50','2022-11-16 10:02:50');

INSERT INTO readings (`reading_id`, `location_id`, `reading_text`, `translation`, `english_location_full`, `hebrew_location_full`, `org_book_id`, `org_book_page`, `created_at`, `updated_at`) VALUES 
('4','4','reading text d','translation d','eng loc full d','הומש, בּראשׂית, פּרק ב, א-','1','4','2022-11-16 10:02:50','2022-11-16 10:02:50');

INSERT INTO readings (`reading_id`, `location_id`, `reading_text`, `translation`, `english_location_full`, `hebrew_location_full`, `org_book_id`, `org_book_page`, `created_at`, `updated_at`) VALUES 
('5','2','reading text b','translation b changed','eng loc full b','הומש, בּראשׂית, פּרק ב, ','2','123','2022-11-17 14:43:13','2022-11-17 14:43:13');

INSERT INTO org_books (`id`, `org_book_name`, `created_at`, `updated_at`) VALUES 
('1','beyond right','','');

INSERT INTO org_books (`id`, `org_book_name`, `created_at`, `updated_at`) VALUES 
('2','second book','','');
