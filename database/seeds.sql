-- Data Management System - SQL Seed Data

-- Clear existing data (Optional, handle with care)
-- SET FOREIGN_KEY_CHECKS = 0;
-- TRUNCATE TABLE certificates;
-- TRUNCATE TABLE citizens;
-- TRUNCATE TABLE households;
-- TRUNCATE TABLE divisions;
-- TRUNCATE TABLE users;
-- SET FOREIGN_KEY_CHECKS = 1;

-- Seed: users
INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
('Admin User', 'admin@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW()),
('Test User', 'test@example.com', NOW(), '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', NOW(), NOW());
-- Note: password is 'password' hashed using default Laravel format

-- Seed: divisions
INSERT INTO `divisions` (`division_code`, `division_name`, `divisional_secretariat`, `created_at`, `updated_at`) VALUES
('DIV001', 'Colombo North', 'Colombo Divisional Secretariat', NOW(), NOW()),
('DIV002', 'Colombo South', 'Colombo Divisional Secretariat', NOW(), NOW()),
('DIV003', 'Galle Fort', 'Galle Divisional Secretariat', NOW(), NOW());

-- Seed: households
INSERT INTO `households` (`division_id`, `house_number`, `address`, `head_of_household`, `created_at`, `updated_at`) VALUES
(1, 'H01-10', '123 Main St, Colombo North', 'Jayasekera Bandara', NOW(), NOW()),
(1, 'H01-11', '45 Park Ave, Colombo North', 'Sunimal Perera', NOW(), NOW()),
(2, 'H02-50', '88 Sea View, Colombo South', 'Kamal Deshapriya', NOW(), NOW()),
(3, 'H03-05', '12 Lighthouse St, Galle', 'Mohamed Rizwan', NOW(), NOW());

-- Seed: citizens
INSERT INTO `citizens` (`household_id`, `division_id`, `full_name`, `nic`, `date_of_birth`, `gender`, `religion`, `marital_status`, `occupation`, `education_level`, `income_level`, `samurdhi_status`, `special_notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Jayasekera Bandara', '197512345678', '1975-05-12', 'Male', 'Buddhism', 'Married', 'Engineer', 'Postgraduate', 85000.00, 0, 'Head of household', NOW(), NOW()),
(1, 1, 'Anula Bandara', '197887654321', '1978-10-20', 'Female', 'Buddhism', 'Married', 'Teacher', 'Graduate', 65000.00, 0, NULL, NOW(), NOW()),
(2, 1, 'Sunimal Perera', '198511223344', '1985-01-15', 'Male', 'Christianity', 'Married', 'Business Owner', 'Diploma', 120000.00, 0, 'Head of household', NOW(), NOW()),
(3, 2, 'Kamal Deshapriya', '199044332211', '1990-08-30', 'Male', 'Buddhism', 'Single', 'Student', 'Undergraduate', 0.00, 1, 'Receives samurdhi', NOW(), NOW()),
(4, 3, 'Mohamed Rizwan', '198255667788', '1982-03-22', 'Male', 'Islam', 'Married', 'Shopkeeper', 'Secondary', 45000.00, 0, 'Head of household', NOW(), NOW());

-- Seed: certificates
INSERT INTO `certificates` (`citizen_id`, `certificate_type`, `reference_number`, `issued_date`, `purpose`, `created_at`, `updated_at`) VALUES
(1, 'Residence', 'REF-2026-0001', '2026-01-10', 'Bank loan application', NOW(), NOW()),
(3, 'Character', 'REF-2026-0002', '2026-01-15', 'Job application', NOW(), NOW()),
(4, 'Income', 'REF-2026-0003', '2026-01-20', 'University scholarship', NOW(), NOW());
