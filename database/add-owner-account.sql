-- ============================================
-- Add Owner Admin Account
-- Jalankan di phpMyAdmin
-- ============================================

-- Owner account (password: password)
-- Login: owner@datacenterpro.com / password
-- Role: owner (data permanen, tidak terhapus)
INSERT INTO `users` (`name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Owner', 'owner@datacenterpro.com', '$2y$10$O5FAfSO1cnPMZ99O0M1m6OHUeOUgssfmnfeu2.lUQ1aqOjsoDy2aS', 'owner', NOW(), NOW());

-- Fix demo admin password (password: password)
UPDATE `users` SET `password` = '$2y$10$O5FAfSO1cnPMZ99O0M1m6OHUeOUgssfmnfeu2.lUQ1aqOjsoDy2aS' WHERE `email` = 'admin@datacenterpro.com';
