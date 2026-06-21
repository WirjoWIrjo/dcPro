-- ============================================
-- Restore Seed Data (is_demo = 0)
-- Jalankan di phpMyAdmin
-- ============================================

-- Articles (only if empty)
INSERT IGNORE INTO `articles` (`title`, `slug`, `category`, `excerpt`, `content`, `is_demo`, `created_at`, `updated_at`) VALUES
('Tips Optimasi Energi Data Center', 'tips-optimasi-energi-data-center', 'Infrastruktur', 'Panduan praktis mengoptimasi konsumsi energi di data center.', 'Data center merupakan salah satu konsumen energi terbesar di dunia teknologi. Dengan mengoptimasi penggunaan energi, tidak hanya mengurangi biaya operasional tetapi juga mendukung keberlanjutan lingkungan.', 0, NOW(), NOW()),
('Panduan Colocation untuk Pemula', 'panduan-colocation-untuk-pemula', 'Layanan', 'Memahami apa itu colocation dan manfaatnya bagi bisnis.', 'Colocation adalah layanan yang memungkinkan Anda menempatkan server di fasilitas data center profesional. Dengan colocation, Anda mendapatkan infrastruktur yang handal tanpa perlu membangun sendiri.', 0, NOW(), NOW()),
('Optimasi PUE di Data Center Skala Besar', 'optimasi-pue-di-data-center-skala-besar', 'Engineering', 'Bagaimana tim engineering kami berhasil menurunkan angka Power Usage Effectiveness melalui sistem cooling modern.', 'Isi konten lengkap mengenai strategi optimasi energi...', 0, NOW(), NOW()),
('Standarisasi Tier IV untuk Keamanan Data', 'standarisasi-tier-iv-untuk-keamanan-data', 'Infrastructure', 'Mengenal protokol redundansi yang menjamin ketersediaan layanan 99.999% bagi infrastruktur digital.', 'Penjelasan mendalam mengenai infrastruktur Tier IV...', 0, NOW(), NOW());

-- Products (only if empty)
INSERT IGNORE INTO `products` (`name`, `slug`, `description`, `category`, `status`, `is_demo`, `created_at`, `updated_at`) VALUES
('Colocation Service', 'colocation-service', 'Layanan penempatan server di data center kami dengan konektivitas tinggi dan keamanan 24/7.', 'Colocation', 'active', 0, NOW(), NOW()),
('Managed Hosting', 'managed-hosting', 'Layanan hosting terkelola dengan dukungan teknis profesional dan monitoring 24/7.', 'Managed Services', 'active', 0, NOW(), NOW()),
('Network Connectivity', 'network-connectivity', 'Koneksi internet dedicated dengan bandwidth tinggi dan redundansi penuh.', 'Network', 'active', 0, NOW(), NOW()),
('Disaster Recovery', 'disaster-recovery', 'Solusi pemulihan bencana untuk melindungi data kritis bisnis Anda.', 'Disaster Recovery', 'active', 0, NOW(), NOW()),
('UPS 3-Phase 500kVA', 'ups-3-phase-500kva', 'Uninterruptible Power Supply 3-phase dengan kapasitas 500kVA.', 'Electrical', 'active', 0, NOW(), NOW()),
('InRow Chiller 35kW', 'inrow-chiller-35kw', 'Sistem pendingin InRow dengan kapasitas 35kW untuk high-density rack.', 'Cooling', 'active', 0, NOW(), NOW()),
('Rack Cabinet 42U 800mm', 'rack-cabinet-42u-800mm', 'Server rack standar 42U dengan kedalaman 1000mm dan lebar 800mm.', 'Infrastructure', 'active', 0, NOW(), NOW()),
('Biometric Access Control System', 'biometric-access-control', 'Sistem kontrol akses multi-faktor dengan fingerprint dan facial recognition.', 'Security', 'active', 0, NOW(), NOW());

-- DC Highlights (only if empty)
INSERT IGNORE INTO `dc_highlights` (`icon`, `metric_name`, `metric_value`, `is_demo`, `created_at`, `updated_at`) VALUES
('bi-shield-check', 'Uptime SLA', '99.999%', 0, NOW(), NOW()),
('bi-lightning-charge', 'Power Efficiency', 'PUE 1.3', 0, NOW(), NOW()),
('bi-people', 'Expert Team', '24/7 Support', 0, NOW(), NOW()),
('bi-globe', 'Network', '10 Gbps', 0, NOW(), NOW());

-- Energy Metrics (only if empty)
INSERT IGNORE INTO `energy_metrics` (`period`, `pue_value`, `total_consumption`, `is_demo`, `created_at`, `updated_at`) VALUES
('Q1 2025', 1.35, 150000.00, 0, NOW(), NOW()),
('Q2 2025', 1.32, 145000.00, 0, NOW(), NOW());

-- Facility Systems (only if empty)
INSERT IGNORE INTO `facility_systems` (`system_category`, `equipment_name`, `description`, `status`, `is_demo`, `created_at`, `updated_at`) VALUES
('Electrical', 'UPS System 500kVA', 'Sistem UPS redundan untuk daya cadangan.', 'Active', 0, NOW(), NOW()),
('Cooling', 'CRAC Unit 100kW', 'Sistem pendingin ruangan untuk menjaga suhu optimal.', 'Active', 0, NOW(), NOW()),
('Security', 'CCTV 360-degree', 'Sistem keamanan dengan kamera 360 derajat.', 'Active', 0, NOW(), NOW());
