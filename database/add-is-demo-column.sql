-- ============================================
-- Add is_demo column to all tables
-- Jalankan di phpMyAdmin untuk update schema
-- ============================================

ALTER TABLE `articles` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `products` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `galleries` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `company_profiles` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `dc_highlights` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `energy_metrics` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;
ALTER TABLE `facility_systems` ADD COLUMN `is_demo` TINYINT(1) NOT NULL DEFAULT 0 AFTER `id`;

-- Mark existing seed data as demo
UPDATE `articles` SET `is_demo` = 1;
UPDATE `products` SET `is_demo` = 1;
UPDATE `dc_highlights` SET `is_demo` = 1;
UPDATE `energy_metrics` SET `is_demo` = 1;
UPDATE `facility_systems` SET `is_demo` = 1;

-- Add owner account (password: password_2026)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Owner', 'owner@datacenterpro.com', '$2y$10$GPkLzuQ95t1rJitv4WVycepNfwGXcj.I4aCju4lC2/LpZ7sGw3r3i', 'owner', NOW(), NOW()) ON DUPLICATE KEY UPDATE `password` = '$2y$10$GPkLzuQ95t1rJitv4WVycepNfwGXcj.I4aCju4lC2/LpZ7sGw3r3i';

-- Fix demo admin password (password: password)
UPDATE `users` SET `password` = '$2y$10$O5FAfSO1cnPMZ99O0M1m6OHUeOUgssfmnfeu2.lUQ1aqOjsoDy2aS' WHERE `email` = 'admin@datacenterpro.com';
