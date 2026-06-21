-- ============================================
-- DataCenterPro - Database Schema for InfinityFree
-- Jalankan di phpMyAdmin setelah upload
-- ============================================

-- Users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `email_verified_at` TIMESTAMP NULL,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100) NULL,
    `role` VARCHAR(20) NOT NULL DEFAULT 'user',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Articles table
CREATE TABLE IF NOT EXISTS `articles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NULL,
    `category` VARCHAR(100) NOT NULL,
    `excerpt` TEXT NOT NULL,
    `content` LONGTEXT NOT NULL,
    `image` VARCHAR(500) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Products table
CREATE TABLE IF NOT EXISTS `products` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `slug` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `price` DECIMAL(10,2) NULL,
    `category` VARCHAR(100) NULL,
    `image` VARCHAR(500) NULL,
    `status` ENUM('active','inactive') NOT NULL DEFAULT 'active',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Galleries table
CREATE TABLE IF NOT EXISTS `galleries` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `image` VARCHAR(500) NOT NULL,
    `caption` TEXT NULL,
    `category` VARCHAR(100) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Company profiles table
CREATE TABLE IF NOT EXISTS `company_profiles` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `company_name` VARCHAR(255) NOT NULL,
    `vision` TEXT NULL,
    `mission` TEXT NULL,
    `address` TEXT NULL,
    `phone` VARCHAR(50) NULL,
    `email` VARCHAR(255) NULL,
    `website` VARCHAR(255) NULL,
    `description` TEXT NULL,
    `logo` VARCHAR(500) NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- DC Highlights table
CREATE TABLE IF NOT EXISTS `dc_highlights` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `icon` VARCHAR(100) NOT NULL,
    `metric_name` VARCHAR(255) NOT NULL,
    `metric_value` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Energy metrics table
CREATE TABLE IF NOT EXISTS `energy_metrics` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `period` VARCHAR(100) NOT NULL,
    `pue_value` DECIMAL(5,2) NOT NULL,
    `total_consumption` DECIMAL(10,2) NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Facility systems table
CREATE TABLE IF NOT EXISTS `facility_systems` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `system_category` VARCHAR(100) NOT NULL,
    `equipment_name` VARCHAR(255) NOT NULL,
    `description` TEXT NULL,
    `status` ENUM('Active','Inactive','Maintenance') NOT NULL DEFAULT 'Active',
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sessions table
CREATE TABLE IF NOT EXISTS `sessions` (
    `id` VARCHAR(255) NOT NULL,
    `user_id` BIGINT UNSIGNED NULL,
    `ip_address` VARCHAR(45) NULL,
    `user_agent` TEXT NULL,
    `payload` LONGTEXT NOT NULL,
    `last_activity` INT NOT NULL,
    PRIMARY KEY (`id`),
    KEY `sessions_user_id_index` (`user_id`),
    KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cache table
CREATE TABLE IF NOT EXISTS `cache` (
    `key` VARCHAR(255) NOT NULL,
    `value` MEDIUMTEXT NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Cache locks table
CREATE TABLE IF NOT EXISTS `cache_locks` (
    `key` VARCHAR(255) NOT NULL,
    `owner` VARCHAR(255) NOT NULL,
    `expiration` INT NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Jobs table
CREATE TABLE IF NOT EXISTS `jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `queue` VARCHAR(255) NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `attempts` TINYINT UNSIGNED NOT NULL,
    `reserved_at` INT UNSIGNED NULL,
    `available_at` INT UNSIGNED NOT NULL,
    `created_at` INT UNSIGNED NOT NULL,
    PRIMARY KEY (`id`),
    KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Job batches table
CREATE TABLE IF NOT EXISTS `job_batches` (
    `id` VARCHAR(255) NOT NULL,
    `name` VARCHAR(255) NOT NULL,
    `total_jobs` INT NOT NULL,
    `pending_jobs` INT NOT NULL,
    `failed_jobs` INT NOT NULL,
    `failed_job_ids` LONGTEXT NOT NULL,
    `options` MEDIUMTEXT NULL,
    `cancelled_at` INT NULL,
    `created_at` INT NOT NULL,
    `finished_at` INT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Failed jobs table
CREATE TABLE IF NOT EXISTS `failed_jobs` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `uuid` VARCHAR(255) NOT NULL,
    `connection` TEXT NOT NULL,
    `queue` TEXT NOT NULL,
    `payload` LONGTEXT NOT NULL,
    `exception` LONGTEXT NOT NULL,
    `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Password reset tokens table
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
    `email` VARCHAR(255) NOT NULL,
    `token` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NULL,
    PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================
-- SEED DATA
-- ============================================

-- Admin user (password: password)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Admin', 'admin@datacenterpro.com', '$2y$12$JBQawkFz.ZPz4V4B0p5bJ.gPz5bJ.gPz5bJ.gPz5bJ.gPz5bJ.g', 'admin', NOW(), NOW());

-- Articles
INSERT INTO `articles` (`title`, `slug`, `category`, `excerpt`, `content`, `created_at`, `updated_at`) VALUES
('Tips Optimasi Energi Data Center', 'tips-optimasi-energi-data-center', 'Infrastruktur', 'Panduan praktis mengoptimasi konsumsi energi di data center.', 'Data center merupakan salah satu konsumen energi terbesar di dunia teknologi. Dengan mengoptimasi penggunaan energi, tidak hanya mengurangi biaya operasional tetapi juga mendukung keberlanjutan lingkungan.', NOW(), NOW()),
('Panduan Colocation untuk Pemula', 'panduan-colocation-untuk-pemula', 'Layanan', 'Memahami apa itu colocation dan manfaatnya bagi bisnis.', 'Colocation adalah layanan yang memungkinkan Anda menempatkan server di fasilitas data center profesional. Dengan colocation, Anda mendapatkan infrastruktur yang handal tanpa perlu membangun sendiri.', NOW(), NOW());

-- Products (Services)
INSERT INTO `products` (`name`, `slug`, `description`, `category`, `status`, `created_at`, `updated_at`) VALUES
('Colocation Service', 'colocation-service', 'Layanan penempatan server di data center kami dengan konektivitas tinggi dan keamanan 24/7.', 'Colocation', 'active', NOW(), NOW()),
('Managed Hosting', 'managed-hosting', 'Layanan hosting terkelola dengan dukungan teknis profesional dan monitoring 24/7.', 'Managed Services', 'active', NOW(), NOW()),
('Network Connectivity', 'network-connectivity', 'Koneksi internet dedicated dengan bandwidth tinggi dan redundansi penuh.', 'Network', 'active', NOW(), NOW()),
('Disaster Recovery', 'disaster-recovery', 'Solusi pemulihan bencana untuk melindungi data kritis bisnis Anda.', 'Disaster Recovery', 'active', NOW(), NOW());

-- DC Highlights
INSERT INTO `dc_highlights` (`icon`, `metric_name`, `metric_value`, `created_at`, `updated_at`) VALUES
('bi-shield-check', 'Uptime SLA', '99.999%', NOW(), NOW()),
('bi-lightning-charge', 'Power Efficiency', 'PUE 1.3', NOW(), NOW()),
('bi-people', 'Expert Team', '24/7 Support', NOW(), NOW()),
('bi-globe', 'Network', '10 Gbps', NOW(), NOW());

-- Energy Metrics
INSERT INTO `energy_metrics` (`period`, `pue_value`, `total_consumption`, `created_at`, `updated_at`) VALUES
('Q1 2025', 1.35, 150000.00, NOW(), NOW()),
('Q2 2025', 1.32, 145000.00, NOW(), NOW());

-- Facility Systems
INSERT INTO `facility_systems` (`system_category`, `equipment_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
('Electrical', 'UPS System 500kVA', 'Sistem UPS redundan untuk daya cadangan.', 'Active', NOW(), NOW()),
('Cooling', 'CRAC Unit 100kW', 'Sistem pendingin ruangan untuk menjaga suhu optimal.', 'Active', NOW(), NOW()),
('Security', 'CCTV 360-degree', 'Sistem keamanan dengan kamera 360 derajat.', 'Active', NOW(), NOW());
