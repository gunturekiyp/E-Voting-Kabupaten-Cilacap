-- Adminer 4.8.1 MySQL 10.3.35-MariaDB-cll-lve dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jumlah_pemilihs`;
CREATE TABLE `jumlah_pemilihs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_pasangan` bigint(20) NOT NULL,
  `id_pemilih` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `jumlah_pemilihs` (`id`, `id_pasangan`, `id_pemilih`, `created_at`, `updated_at`) VALUES
(7,	4,	3,	'2022-08-07 05:23:47',	'2022-08-07 05:23:47');

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1,	'2014_10_12_000000_create_users_table',	1),
(2,	'2014_10_12_100000_create_password_resets_table',	1),
(3,	'2019_08_19_000000_create_failed_jobs_table',	1),
(4,	'2019_12_14_000001_create_personal_access_tokens_table',	1),
(5,	'2022_08_01_152212_create_jumlah_pemilihs_table',	1),
(6,	'2022_08_04_171345_create_pasangan_calons_table',	2);

DROP TABLE IF EXISTS `pasangan_calons`;
CREATE TABLE `pasangan_calons` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `no_urut` bigint(20) DEFAULT NULL,
  `id_calon_bupati` bigint(20) unsigned NOT NULL,
  `id_calon_wakil_bupati` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pasangan_calons` (`id`, `no_urut`, `id_calon_bupati`, `id_calon_wakil_bupati`, `created_at`, `updated_at`) VALUES
(1,	1,	6,	8,	'2022-08-04 18:14:43',	'2022-08-04 18:14:43'),
(2,	2,	19,	24,	'2022-08-05 23:15:35',	'2022-08-05 23:15:35'),
(3,	3,	20,	25,	'2022-08-05 23:15:45',	'2022-08-05 23:15:45'),
(4,	4,	21,	26,	'2022-08-05 23:15:56',	'2022-08-05 23:15:56'),
(5,	5,	22,	28,	'2022-08-05 23:16:06',	'2022-08-05 23:16:06'),
(6,	6,	23,	27,	'2022-08-05 23:16:16',	'2022-08-05 23:16:16');

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('admin','user','bupati','wakil_bupati') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `nohp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Khusus untuk role bupati dan wakil',
  `misi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Khusus untuk role bupati dan wakil',
  `foto_calon_bupati_wakil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi_tambahan_calon` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `muncul_dalam_pemilihan` tinyint(1) NOT NULL DEFAULT 1,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_nohp_unique` (`nohp`),
  UNIQUE KEY `users_nik_unique` (`nik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `nohp`, `nik`, `visi`, `misi`, `foto_calon_bupati_wakil`, `deskripsi_tambahan_calon`, `muncul_dalam_pemilihan`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1,	'Admin',	'admin',	'admin@admin.com',	'admin',	'012345678',	'123123',	NULL,	NULL,	NULL,	NULL,	1,	'$2a$12$bHNj8R.fV.OcP9Rir6fuauAwu9.CoKVTFM9QELLmL6Wo9QmsAKKp2',	NULL,	'GwttlvQBhoP0dvroXAGsJG2c0VUb3RlVCuajbOUaAbMLZmNFHSG1pYiQKbLH',	NULL,	NULL),
(2,	'Admin',	'admin2',	'admin2@admin.com',	'admin',	'0812345612',	'1212343400',	NULL,	NULL,	NULL,	NULL,	1,	'$2y$10$/swxqpU0WmspXZ.p44Qg1egWKtg.g3pIhXObpl7DEI0VrCMBfOnse',	NULL,	NULL,	'2022-08-01 21:30:55',	'2022-08-01 21:54:21'),
(3,	'User',	'user',	'user@user.com',	'user',	'011111',	'997799',	NULL,	NULL,	NULL,	NULL,	1,	'$2y$10$5m2MFYEosyVcmyIVntN9SehRVEKIxW4iTj/8Vsrxjjhy4pefFXsEu',	NULL,	'HjrkFgnYVZuhWsbASCmmStV06EJQSjmtl4tIBuyvJEARXP32bS3lAjQdqopI',	'2022-08-01 22:06:29',	'2022-08-01 22:06:29'),
(6,	'I Gusti Ramadhan',	'gustiramadhan',	'gustiramadhan@evoting.com',	'bupati',	'0878768675757',	'100100',	'Sugeng ayem tentrem',	'Memberantas korupsi',	'100100.jpeg',	'Hobi jalan jalan. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.',	1,	'$2y$10$ffmJspBRnaYOG.wVB6NtduTjdzgidlxZCpjVxKadjwmF/zpiQ89bW',	NULL,	'cldIQOSyOwCRLzbBRyIW3KXlkJNiDi05ZopXYIxEG6hVkC1klANuHXrQOC8k',	'2022-08-02 00:56:14',	'2022-08-06 15:21:36'),
(8,	'Christian Ramadhan',	'christianramadhan',	'christianramadhan@evoting.com',	'wakil_bupati',	'99926352678',	'812686523768',	'Kerja kerja kerja',	'Memberantas kemiskinan',	'812686523768.jpg',	'Hobi memasak',	1,	'$2y$10$o44pizlUimaGr9ajU9XieOzO9LLwilu1wsIQ/S0s4R0R0Tnjdyena',	NULL,	'ESr9EMNUi2MA7V4wrlSa4eLUscfhDAXgzdNfIlUDPnIpK4qglliBKtzvmGRm',	'2022-08-02 01:37:02',	'2022-08-02 01:37:02'),
(19,	'Gandewa Gantar Sirait',	'edabukke',	'smaryati@wahyudin.my.id',	'bupati',	'(+62) 754 2614 993',	'195311985',	'Est est tenetur rerum qui illo. Voluptate reiciendis quia vel vel reiciendis et. Ut eum dolor modi quia. Veritatis quasi quasi rem iure.',	'Sint molestias consectetur ut saepe aperiam. Fuga ea quis et quia. Aut laboriosam adipisci dolores alias totam ut et et. Numquam nesciunt maxime minima non occaecati.',	'195311985.jpg',	'Et eaque hic quasi deleniti eveniet. Quod laudantium ducimus perspiciatis expedita. Molestiae tempore dicta labore reprehenderit deserunt. Deserunt quas distinctio consequatur eum.',	1,	'$2y$10$m9gxVzsyCDg5AZlUuQgDTuxwrp07Zn.0VM222xdAbzBlfdWt9VhtS',	NULL,	'jiGzM8HR5XrVnFj6hOUk0qASzBXlQ42Bt1dVSpOhcGPvLAkcLKyp6C1F3MHE',	'2022-08-05 23:09:06',	'2022-08-06 12:51:11'),
(20,	'Yessi Aryani',	'empluk.wastuti',	'febi.pudjiastuti@yahoo.com',	'bupati',	'0728 3328 434',	'808050361',	'Animi fugiat ea accusamus aliquam atque error id. Est qui eos sunt sit iste reiciendis. Aut quisquam dolor quia.',	'Tempore sed ipsum porro aperiam qui. Et sapiente ut molestias deleniti est omnis ab. Enim maiores omnis eos quod quidem assumenda.',	'808050361.jpg',	'Aut dignissimos aliquid mollitia ut. Illo eligendi placeat ullam voluptatem fugit quidem sequi sequi.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:08',	'2022-08-05 23:09:08'),
(21,	'Harto Bagiya Sitompul',	'yuliarti.sadina',	'gadang18@zulkarnain.ac.id',	'bupati',	'(+62) 893 2819 962',	'829349410',	'Aut voluptatem culpa in atque officia in. Nisi temporibus similique magnam in assumenda fugiat voluptatem. Pariatur sint culpa commodi dignissimos harum.',	'Omnis aspernatur deleniti cum commodi voluptatum aut fugiat. Qui harum sed ut porro suscipit. Ipsa nihil corrupti dicta quos reiciendis assumenda earum. Debitis aut atque et et eum hic.',	'829349410.jpg',	'Eaque dolore nulla ut doloremque. Qui id porro corrupti id distinctio. Repudiandae et id rerum aliquam.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:09',	'2022-08-05 23:09:09'),
(22,	'Rahayu Mardhiyah M.Pd',	'harsaya82',	'kamila25@astuti.org',	'bupati',	'(+62) 834 686 675',	'449436377',	'Autem fugit inventore ipsum aliquam non. Aliquam qui iure sint assumenda alias inventore. Saepe aut doloremque voluptatibus quaerat quo reiciendis doloribus.',	'Earum odit officia libero fuga id. Deserunt excepturi atque rem dolorum incidunt ullam veniam.',	'449436377.jpg',	'Et itaque veritatis tenetur fugit corrupti. Earum qui hic laudantium officia magnam vero repudiandae eum. Libero eos vitae dolorem non accusantium.',	1,	'$2y$10$LvkgJlgu9kot4TX04Kiz/unkkCfkI5MqNUpKg.7o.B.lHlUNvSB0K',	NULL,	'FzSIP8gOmYQdYHwX0BEgu5FgCVMAeeiRqWBPHCk6627VZkYmuv483dF3Owmx',	'2022-08-05 23:09:10',	'2022-08-06 15:02:09'),
(23,	'Virman Kuswoyo S.Pd',	'ahasanah',	'umi.damanik@yahoo.co.id',	'bupati',	'020 1817 339',	'354736704',	'Quis nisi nam ab quas earum et. Nesciunt optio qui blanditiis omnis eos sed ea aut. Autem adipisci quas id. Voluptas et explicabo magni quis quas rerum.',	'Aut qui est ut architecto dolores qui. Aut quis omnis voluptates nisi ab. Praesentium eos non consectetur natus. Fugiat velit praesentium est molestiae enim. Quod et doloremque sed.',	'354736704.jpg',	'Nisi eos accusantium debitis laborum accusamus. Corrupti illo aut facilis voluptatem officia et. Ipsam eos inventore laboriosam possimus odit esse.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:11',	'2022-08-05 23:09:11'),
(24,	'Purwadi Hasta Thamrin',	'samsul.wastuti',	'taswir84@halimah.biz',	'wakil_bupati',	'029 6900 205',	'621042574',	'Accusantium aut molestiae et unde explicabo et provident. Minima repellat fugit maiores neque. Aut qui id et.',	'Similique molestiae similique sed natus omnis eos. Corporis ut quasi occaecati ex debitis dignissimos. Rerum voluptas corrupti temporibus possimus. Dicta eos porro molestias accusamus aut.',	'621042574.jpg',	'Itaque eos praesentium quia dolore itaque doloribus quidem. Est quod reprehenderit cum maiores fuga sequi rerum. Repellendus expedita aliquam eaque est.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:11',	'2022-08-05 23:09:11'),
(25,	'Edward Luhung Marpaung',	'suartini.laksana',	'muwais@mardhiyah.com',	'wakil_bupati',	'(+62) 930 3473 447',	'603425367',	'Ea minima aperiam aliquid. Deleniti maxime nulla labore nostrum eos. Voluptas pariatur quo adipisci minus totam aperiam doloremque sit.',	'Sapiente explicabo optio distinctio porro ut molestiae iusto. Non consequatur et recusandae nam est. Dicta quaerat non delectus molestias sequi numquam ut.',	'603425367.jpg',	'Vitae ea deleniti ea molestias amet dolor delectus. Aliquid non voluptas id cumque. In adipisci occaecati officiis soluta tempora. Hic dicta dolor eum rerum illum id nobis.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:13',	'2022-08-05 23:09:13'),
(26,	'Siska Halimah',	'lsetiawan',	'cindy.zulaika@widodo.biz',	'wakil_bupati',	'(+62) 752 4186 3635',	'445703340',	'Aliquid totam voluptatum dolores nisi. Praesentium et voluptate nostrum aut nihil ea. Qui qui delectus odit id. Voluptates soluta similique quisquam et dignissimos.',	'Illo dolor dolorum aut non velit commodi. Veniam corrupti porro quae amet numquam libero nulla. Natus deleniti consequatur tenetur exercitationem distinctio nesciunt consequatur vel.',	'445703340.jpg',	'Vel dolore asperiores deserunt rerum nemo nisi autem sunt. Et ea sit quidem et aut dolorem deleniti esse. Odit et sunt voluptatum quas laborum non.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:14',	'2022-08-05 23:09:14'),
(27,	'Tirtayasa Januar S.Ked',	'cawisono.mandasari',	'cici.waskita@sitorus.id',	'wakil_bupati',	'0896 6292 912',	'650701880',	'Excepturi omnis quia praesentium sit. Nesciunt voluptates quae ea est id. Officia dolores et recusandae et.',	'Saepe ad aut et voluptas omnis asperiores saepe minus. Qui nemo veritatis iure molestiae sit. Nihil iusto vel velit aliquam optio.',	'650701880.jpg',	'Placeat ut nihil amet possimus accusamus quos. Magnam amet maxime repudiandae. Quibusdam cupiditate qui deleniti.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:15',	'2022-08-05 23:09:15'),
(28,	'Ella Safitri',	'halim.winda',	'pkuswoyo@palastri.my.id',	'wakil_bupati',	'(+62) 354 8737 7243',	'442232065',	'Molestiae iusto quo saepe doloribus quia quia ut. Veritatis optio possimus fugiat veniam. Libero consequatur asperiores quam.',	'Excepturi voluptas nemo vitae tempora ut unde. Iusto unde excepturi corporis sunt. Unde quod libero laboriosam sequi explicabo quisquam ea.',	'442232065.jpg',	'Ab aliquam alias numquam amet optio repellat cum est. Numquam explicabo iste ullam et quisquam quae consectetur molestias. Quam officiis id eaque quia nostrum repellat.',	1,	'$2a$12$yUts8PgBJ32Lsk0TbS8BMutMsV2cWIZ9Zt17uOHS5D/5wPsap06D2',	NULL,	NULL,	'2022-08-05 23:09:15',	'2022-08-05 23:09:15'),
(29,	'Bagya Arta Uwais S.I.Kom',	'johan.hidayanto',	'jati.mandasari@safitri.name',	'bupati',	'0745 7189 9389',	'209984454',	'Cumque voluptas ipsam ut et. Molestiae aperiam aliquam quia blanditiis. Cupiditate eum non sit.',	'Ipsum deleniti incidunt consectetur. Quidem numquam nemo dolorum repellat molestias quod alias quas. Consequatur ut corrupti et illo aut cumque.',	'209984454.jpg',	'Ad est consequatur qui alias ut. Vero esse consectetur deserunt rerum aut earum dicta. Mollitia eligendi odio doloremque sit suscipit reprehenderit sapiente. Voluptas vitae ab nobis et fuga.',	1,	'$2y$10$scfb22FfB43mP.bimUrI..8RUi6YhnW/FMHyEvr.OjwEuZbi5FxpC',	NULL,	NULL,	'2022-08-06 14:25:55',	'2022-08-06 14:25:55'),
(30,	'Lanang Darmaji Hidayanto',	'znasyiah',	'ffujiati@wahyuni.desa.id',	'bupati',	'0328 4763 587',	'985584453',	'Delectus excepturi ipsa et similique occaecati. Molestias in qui voluptate rerum non a aut. Est ipsam qui eius ducimus quo velit.',	'Dolorem eos enim adipisci incidunt aspernatur. Dolor mollitia excepturi laborum sunt est suscipit voluptatibus.',	'985584453.jpg',	'Sit doloremque est qui recusandae. Accusamus maiores omnis ducimus doloremque rem veniam in harum. Sed ut nesciunt eligendi est architecto ducimus quia eos. Ea culpa qui ea ut in ut mollitia.',	1,	'$2y$10$Sy8R684f8wpYWshwdgoKLuZK1wPI0/fqmQbPihDjtB302N7CqHSkq',	NULL,	NULL,	'2022-08-06 14:25:57',	'2022-08-06 14:25:57'),
(31,	'Oman Latupono',	'pudjiastuti.salman',	'mulya.maheswara@novitasari.desa.id',	'bupati',	'(+62) 857 6007 6536',	'228889577',	'Eos consequatur deserunt rerum velit ut minima maxime quaerat. Asperiores ratione sed voluptatum ab necessitatibus vel. Quis provident consequatur sint quis quo assumenda aut ab.',	'Voluptatibus beatae eius vel ab. Aspernatur quia numquam in delectus consectetur odio similique. Molestiae et aut veniam hic explicabo esse. Sed ea nisi nesciunt dicta aliquam.',	'228889577.jpg',	'Laborum sed provident corrupti qui magni. Quo distinctio facilis officiis facilis. Ad molestiae animi dolores voluptatem sit. Ipsum temporibus ut et qui.',	0,	'$2y$10$DwSWyVoJ3f3qQiCv/iWSxepsfVhaucCQlQ.xKzoBl9/.jK5mD3u4O',	NULL,	NULL,	'2022-08-06 14:25:58',	'2022-08-06 14:34:37'),
(33,	'Paramita Melani',	'wulan.damanik',	'kayun.pangestu@yahoo.co.id',	'bupati',	'(+62) 884 1046 676',	'405631287',	'Ducimus rerum in neque officiis sapiente ut consequuntur cumque. Ducimus ab sint autem aut.',	'Ut et ut doloribus ab qui facilis amet aperiam. Porro vitae corrupti ipsa. Soluta ad ut magni voluptatibus incidunt explicabo ratione.',	'405631287.jpg',	'Non doloremque exercitationem est ipsum itaque et laudantium. Dolorum ullam laborum sit sit ut. Illum est libero doloremque quo sed et. Consequatur a unde sit aut in fugit.',	0,	'$2y$10$JMrS4dNOJVU6tMZMrhMF4OgiKu.bIXIb58FQ9KanjYG6r2gUdXDVG',	NULL,	NULL,	'2022-08-06 14:26:01',	'2022-08-06 14:31:29'),
(34,	'Gamani Utama',	'ilsa.mardhiyah',	'hassanah.daru@winarsih.info',	'wakil_bupati',	'0848 6421 261',	'297488035',	'Ipsum omnis dolores nihil deleniti doloremque et voluptas. Pariatur a ea eaque id quia debitis.',	'Doloribus eum quo ut nihil. Saepe sit ut laborum distinctio reprehenderit adipisci facilis. Optio aut tempore deleniti vel sunt inventore.',	'297488035.jpg',	'Laudantium ducimus asperiores cupiditate blanditiis autem consequatur. Quia voluptas autem ullam dolor. Beatae quia voluptatum dolor corrupti numquam est.',	1,	'$2y$10$DWjQdHq3X7uZ3j9enZ5k9eXVb8tN4.63WYCNLSc148hTRVCUOA4dy',	NULL,	NULL,	'2022-08-06 14:26:02',	'2022-08-06 14:26:02'),
(35,	'Julia Widiastuti',	'nlatupono',	'farida.dina@melani.id',	'wakil_bupati',	'0915 1927 416',	'691607492',	'Hic velit et quae et omnis. Ab minus sit nulla consequatur doloremque eaque. Aut excepturi nisi voluptas aut voluptatem voluptas adipisci aliquid.',	'Quaerat quam quasi harum quod est labore rerum consequatur. Totam fuga illum facilis. Tempore voluptates pariatur nemo nobis.',	'691607492.jpg',	'Qui suscipit dicta aut saepe quod accusantium nemo. Et ut adipisci molestiae sed provident laudantium. Ut rerum dolorem est eum aut et dicta. Exercitationem et illum qui vel eos nihil et.',	1,	'$2y$10$WlMeOFksl6tQOk1Vgrkw3ODtcItamp37WzaJk2RBo79nfz89ZwyVm',	NULL,	NULL,	'2022-08-06 14:26:03',	'2022-08-06 14:26:03'),
(36,	'Timbul Mahendra',	'ihassanah',	'yolanda.jagapati@padmasari.co',	'wakil_bupati',	'(+62) 833 363 331',	'436561011',	'Et fuga distinctio et maiores aperiam. Dolor veniam odit reiciendis explicabo. In omnis dolor perspiciatis occaecati eum minus. Ratione sit et et cumque et iure.',	'Ipsa velit in quae aliquam cum quis pariatur. Hic provident ut qui dolores error. Architecto velit facilis voluptate corrupti voluptates. Et quo aliquam qui natus in minus nemo dolore.',	'436561011.jpg',	'Ut harum est qui dolores ipsa neque omnis. Consectetur velit et sit et. Libero nesciunt itaque et sequi eveniet harum consequatur. Consequuntur sint sunt placeat eum qui.',	1,	'$2y$10$riUgYgKtbDOT84gzIXnWnOKcxsjHk9t3b.gOM8xW9Lag1ARdObIKC',	NULL,	NULL,	'2022-08-06 14:26:04',	'2022-08-06 14:26:04'),
(37,	'Hafshah Fathonah Nasyiah',	'bahuraksa17',	'dhidayat@pratiwi.go.id',	'wakil_bupati',	'(+62) 379 2877 6552',	'249841485',	'Tempore ullam quos in vel sint. Et et quisquam eos ea quaerat. Pariatur sint quia optio quis. Nihil sunt aut unde nobis aut et molestiae.',	'Ab sed voluptatem animi sit ab. A harum sit sint doloribus hic voluptatem. Ut est maiores laboriosam quae. At eos fugit cupiditate. Eaque consequatur qui cumque cupiditate praesentium qui.',	'249841485.jpg',	'Ea dolores voluptate iure ut culpa et. Et non laudantium similique ut. At et id et.',	1,	'$2y$10$LPT8NIxIbxyMZ4C3eKCVHePSdOT.0DPLoAVbj5KdD1tNnyYjBPohS',	NULL,	NULL,	'2022-08-06 14:26:06',	'2022-08-06 14:26:06'),
(38,	'Alika Genta Usamah',	'dinda.suwarno',	'pertiwi.sabri@simbolon.mil.id',	'wakil_bupati',	'0723 1664 108',	'816184346',	'Qui vel dolores et atque molestias pariatur hic qui. Omnis accusantium dolorem vitae voluptas sit autem. Quod sed autem atque.',	'Nisi voluptas magni repellendus debitis commodi ad. Aliquid error ad ducimus. Harum ut consequatur sit.',	'816184346.jpg',	'Laborum sunt sunt itaque alias placeat dolore ut. Delectus explicabo accusamus totam debitis qui ipsa. Perferendis dolorum blanditiis ea et voluptas mollitia.',	1,	'$2y$10$du0.2V6n1n4hZnGsU/SAxOTVnLyV9NPmMZZlpzlDN077wxvjeyJ.C',	NULL,	NULL,	'2022-08-06 14:26:07',	'2022-08-06 14:26:07');

-- 2022-08-07 06:26:10
