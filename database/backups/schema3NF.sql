-- AUTHOR : SAVIO BABU @ GREENCREON.COM
-- SPECIFICALLY DESIGNED DB FOR INVENTORY & SALES MANAGEMENT
-- STRICTLY ENFORCED 3NF RULE
-- Table structure for table `core_settings`
CREATE TABLE
    `core_settings` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `site_url` VARCHAR(255) DEFAULT NULL,
        `version` VARCHAR(50) DEFAULT NULL,
        `app_version` VARCHAR(50) DEFAULT NULL,
        `app_package_name` VARCHAR(150) DEFAULT NULL,
        `ios_app_version` VARCHAR(50) DEFAULT NULL,
        `ios_package_id` VARCHAR(150) DEFAULT NULL,
        `site_title` VARCHAR(255) DEFAULT NULL,
        `site_description` TEXT DEFAULT NULL,
        `meta_keywords` VARCHAR(255) DEFAULT NULL,
        `meta_details` TEXT DEFAULT NULL,
        `logo` VARCHAR(255) DEFAULT NULL,
        `logo_min` VARCHAR(255) DEFAULT NULL,
        `favicon` VARCHAR(255) DEFAULT NULL,
        `logo_web` VARCHAR(255) DEFAULT NULL,
        `logo_app` VARCHAR(255) DEFAULT NULL,
        `address` VARCHAR(255) DEFAULT NULL,
        `site_email` VARCHAR(150) DEFAULT NULL,
        `whatsapp_number` VARCHAR(20) DEFAULT NULL,
        `sendgrid_api` VARCHAR(255) DEFAULT NULL,
        `enable_googlemap` TINYINT (1) DEFAULT 0,
        `enable_firebase` TINYINT (1) DEFAULT 0,
        `firebase_config` TEXT DEFAULT NULL,
        `firebase_api_key` VARCHAR(255) DEFAULT NULL,
        `enable_cod` TINYINT (1) DEFAULT 0,
        `enable_bank_transfer` TINYINT (1) DEFAULT 0,
        `bank_account` VARCHAR(255) DEFAULT NULL,
        `upi_id` VARCHAR(100) DEFAULT NULL,
        `enable_razorpay` TINYINT (1) DEFAULT 0,
        `razorpay_key_id` VARCHAR(255) DEFAULT NULL,
        `razorpay_key_secret` VARCHAR(255) DEFAULT NULL,
        `enable_ccavenue` TINYINT (1) DEFAULT 0,
        `ccavenue_test_mode` TINYINT (1) DEFAULT 0,
        `ccavenue_merchant_id` VARCHAR(255) DEFAULT NULL,
        `ccavenue_access_code` VARCHAR(255) DEFAULT NULL,
        `ccavenue_working_key` VARCHAR(255) DEFAULT NULL,
        `enable_phonepe` TINYINT (1) DEFAULT 0,
        `phonepe_merchant_id` VARCHAR(255) DEFAULT NULL,
        `phonepe_salt_key` VARCHAR(255) DEFAULT NULL,
        `phonepe_mode` ENUM ('test', 'live') DEFAULT 'test',
        `enable_onesignal` TINYINT (1) DEFAULT 0,
        `onesignal_app_id` VARCHAR(255) DEFAULT NULL,
        `onesignal_api_key` VARCHAR(255) DEFAULT NULL,
        `smtp_host` VARCHAR(255) DEFAULT NULL,
        `smtp_port` SMALLINT DEFAULT NULL,
        `smtp_username` VARCHAR(255) DEFAULT NULL,
        `smtp_password` VARCHAR(255) DEFAULT NULL,
        `enable_test_otp` TINYINT (1) DEFAULT 0,
        `enable_msg91` TINYINT (1) DEFAULT 0,
        `msg91_api_key` VARCHAR(255) DEFAULT NULL,
        `enable_textlocal` TINYINT (1) DEFAULT 0,
        `textlocal_api_key` VARCHAR(255) DEFAULT NULL,
        `enable_greensms` TINYINT (1) DEFAULT 0,
        `greensms_access_token` VARCHAR(255) DEFAULT NULL,
        `greensms_access_token_key` VARCHAR(255) DEFAULT NULL,
        `sms_sender_id` VARCHAR(50) DEFAULT NULL,
        `sms_entity_id` VARCHAR(100) DEFAULT NULL,
        `sms_dlt_id` VARCHAR(100) DEFAULT NULL,
        `sms_message_template` TEXT DEFAULT NULL,
        `maintenance_mode_web` TINYINT (1) DEFAULT 0,
        `maintenance_mode_app` TINYINT (1) DEFAULT 0,
        `check_device_id_on_registration` TINYINT (1) DEFAULT 0,
        `created_at` TIMESTAMP NULL DEFAULT NULL,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Table structure for table `country_settings`
CREATE TABLE
    `country_settings` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(150) NOT NULL,
        `mobile_code` VARCHAR(10) NOT NULL,
        `currency_code` VARCHAR(10) NOT NULL,
        `currency_symbol` VARCHAR(10) NOT NULL,
        `status` TINYINT (1) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NULL DEFAULT NULL,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Table structure for table `timezones`
CREATE TABLE
    `timezones` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(100) NOT NULL,
        `status` TINYINT (1) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NULL DEFAULT NULL,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Table structure for table `business_categories`
CREATE TABLE
    `business_categories` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(150) NOT NULL,
        `status` TINYINT (1) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NULL DEFAULT NULL,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Table structure for table `business_types`
CREATE TABLE
    `business_types` (
        `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        `name` VARCHAR(150) NOT NULL,
        `status` TINYINT (1) NOT NULL DEFAULT 1,
        `created_at` TIMESTAMP NULL DEFAULT NULL,
        `updated_at` TIMESTAMP NULL DEFAULT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Table structure for table ` languages `
CREATE TABLE
    ` languages ` (
        ` id ` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        ` name ` VARCHAR(100) NOT NULL, -- e.g., English, Hindi
        ` code ` VARCHAR(10) NOT NULL, -- e.g., en, hi
        ` status ` ENUM ('active', 'inactive') DEFAULT 'active',
        ` created_at ` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        ` updated_at ` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (` id `),
        UNIQUE KEY ` uq_language_code ` (` code `)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Table structure for table ` currencies `
CREATE TABLE
    ` currencies ` (
        ` id ` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        ` code ` VARCHAR(10) NOT NULL, -- e.g., USD, INR
        ` name ` VARCHAR(100) NOT NULL, -- e.g., US Dollar, Indian Rupee
        ` symbol ` VARCHAR(10) NOT NULL, -- e.g., $, ₹
        ` status ` ENUM ('active', 'inactive') DEFAULT 'active',
        ` created_at ` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        ` updated_at ` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (` id `),
        UNIQUE KEY ` uq_currency_code ` (` code `)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--  User Roles
CREATE TABLE
    user_roles (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        role_name VARCHAR(255) NOT NULL, -- e.g., Admin, Manager, Cashier
        role_code VARCHAR(100) NOT NULL, -- system key, e.g., ADMIN, CASHIER
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_role_code (role_code)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--  System Modules (Features)
CREATE TABLE
    system_modules (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        module_name VARCHAR(255) NOT NULL, -- e.g., Sales Invoice, Purchase Return
        module_group VARCHAR(255) NOT NULL, -- e.g., Sales, Purchase
        module_code VARCHAR(100) NOT NULL, -- system key, e.g., SALES_INVOICE
        is_pro_feature TINYINT (1) NOT NULL DEFAULT 0, -- 1=pro only, 0=free
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_module_code (module_code)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--  Role Permissions (Junction Table)
CREATE TABLE
    role_permissions (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        role_id BIGINT UNSIGNED NOT NULL, -- FK → user_roles(id)
        module_id BIGINT UNSIGNED NOT NULL, -- FK → system_modules(id)
        can_view TINYINT (1) NOT NULL DEFAULT 1,
        can_create TINYINT (1) NOT NULL DEFAULT 0,
        can_update TINYINT (1) NOT NULL DEFAULT 0,
        can_delete TINYINT (1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_role_module (role_id, module_id),
        INDEX idx_role_permissions_role_id (role_id),
        INDEX idx_role_permissions_module_id (module_id),
        CONSTRAINT fk_role_permissions_role FOREIGN KEY (role_id) REFERENCES user_roles (id) ON DELETE CASCADE,
        CONSTRAINT fk_role_permissions_module FOREIGN KEY (module_id) REFERENCES system_modules (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--   Users Table
CREATE TABLE
    users (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        role_id BIGINT UNSIGNED NOT NULL, -- FK → user_roles(id)
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        country_code VARCHAR(10) DEFAULT NULL,
        mobile VARCHAR(20) NOT NULL,
        password VARCHAR(255) NOT NULL, -- hashed
        whatsapp_no VARCHAR(20) DEFAULT NULL,
        profile_image VARCHAR(255) DEFAULT NULL,
        dob DATE DEFAULT NULL,
        employee_code VARCHAR(100) DEFAULT NULL,
        current_latitude DECIMAL(10, 8) DEFAULT NULL,
        current_longitude DECIMAL(11, 8) DEFAULT NULL,
        zone VARCHAR(100) DEFAULT NULL,
        otp VARCHAR(10) DEFAULT NULL,
        otp_expires_at TIMESTAMP DEFAULT NULL,
        mobile_verified TINYINT (1) NOT NULL DEFAULT 0,
        email_verified TINYINT (1) NOT NULL DEFAULT 0,
        status ENUM ('active', 'inactive', 'banned') NOT NULL DEFAULT 'active',
        created_by BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        referral_code VARCHAR(100) DEFAULT NULL,
        license_key VARCHAR(255) DEFAULT NULL,
        remember_token VARCHAR(100) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_users_email (email),
        UNIQUE KEY uq_users_mobile (mobile),
        INDEX idx_users_role_id (role_id),
        INDEX idx_users_created_by (created_by),
        CONSTRAINT fk_users_role FOREIGN KEY (role_id) REFERENCES user_roles (id) ON DELETE RESTRICT,
        CONSTRAINT fk_users_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    addresses (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        address_type ENUM ('billing', 'shipping', 'other') DEFAULT 'shipping',
        country_id BIGINT UNSIGNED NOT NULL,
        state VARCHAR(100) DEFAULT NULL,
        city VARCHAR(100) DEFAULT NULL,
        postcode VARCHAR(20) DEFAULT NULL,
        address_line TEXT DEFAULT NULL,
        location_link VARCHAR(255) DEFAULT NULL,
        is_default TINYINT (1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_addresses_country_id (country_id),
        CONSTRAINT fk_addresses_country FOREIGN KEY (country_id) REFERENCES country_settings (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Polymorphic link table (strict 3NF) -- (15, 'customer', 2001) address 15 belongs to customer 2001.
CREATE TABLE
    address_links (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        address_id BIGINT UNSIGNED NOT NULL,
        entity_type ENUM ('store', 'customer', 'supplier', 'user') NOT NULL,
        entity_id BIGINT UNSIGNED NOT NULL,
        CONSTRAINT fk_address_links_address FOREIGN KEY (address_id) REFERENCES addresses (id) ON DELETE CASCADE,
        UNIQUE KEY uq_address_entity (address_id, entity_type, entity_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    customers (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        country_id BIGINT UNSIGNED NOT NULL,
        group_id BIGINT UNSIGNED DEFAULT NULL,
        customer_code VARCHAR(100) NOT NULL,
        customer_name VARCHAR(255) NOT NULL,
        mobile VARCHAR(20) DEFAULT NULL,
        phone VARCHAR(20) DEFAULT NULL,
        email VARCHAR(255) DEFAULT NULL,
        gst_enabled TINYINT (1) NOT NULL DEFAULT 0,
        gstin VARCHAR(50) DEFAULT NULL,
        vat_enabled TINYINT (1) NOT NULL DEFAULT 0,
        vatin VARCHAR(50) DEFAULT NULL,
        tax_number VARCHAR(50) DEFAULT NULL,
        credit_limit DECIMAL(12, 2) DEFAULT 0.00,
        credit_date_limit DATE DEFAULT NULL,
        price_level_type ENUM ('retail', 'wholesale', 'custom') DEFAULT 'retail',
        price_level_value DECIMAL(12, 2) DEFAULT 0.00,
        delete_bit TINYINT (1) NOT NULL DEFAULT 0,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_customer_code (store_id, customer_code),
        INDEX idx_customers_store_id (store_id),
        INDEX idx_customers_created_by (created_by),
        INDEX idx_customers_country_id (country_id),
        CONSTRAINT fk_customers_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_customers_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL,
        CONSTRAINT fk_customers_country FOREIGN KEY (country_id) REFERENCES country_settings (id) ON DELETE RESTRICT,
        CONSTRAINT fk_customers_group FOREIGN KEY (group_id) REFERENCES customer_groups (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    customer_attachments (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        customer_id BIGINT UNSIGNED NOT NULL,
        file_path VARCHAR(255) NOT NULL,
        file_storage_provider VARCHAR(50) DEFAULT 'local',
        file_type ENUM ('id_proof', 'contract', 'other') DEFAULT 'other',
        uploaded_by BIGINT UNSIGNED DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_customer_attachments_customer_id (customer_id),
        CONSTRAINT fk_customer_attachments_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE CASCADE,
        CONSTRAINT fk_customer_attachments_user FOREIGN KEY (uploaded_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    customer_transactions (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        customer_id BIGINT UNSIGNED NOT NULL,
        transaction_code VARCHAR(100) NOT NULL,
        transaction_type ENUM ('advance', 'payment', 'refund', 'adjustment') NOT NULL,
        payment_type_id BIGINT UNSIGNED DEFAULT NULL,
        related_reference_type VARCHAR(50) DEFAULT NULL,
        related_reference_id BIGINT UNSIGNED DEFAULT NULL,
        account_id BIGINT UNSIGNED DEFAULT NULL,
        amount DECIMAL(15, 2) NOT NULL,
        note TEXT DEFAULT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        status ENUM ('pending', 'completed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_customer_transactions_code (store_id, transaction_code),
        INDEX idx_customer_transactions_store_id (store_id),
        INDEX idx_customer_transactions_customer_id (customer_id),
        INDEX idx_customer_transactions_payment_type_id (payment_type_id),
        INDEX idx_customer_transactions_ref (related_reference_type, related_reference_id),
        CONSTRAINT fk_customer_transactions_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_customer_transactions_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE CASCADE,
        CONSTRAINT fk_customer_transactions_payment_type FOREIGN KEY (payment_type_id) REFERENCES payment_types (id) ON DELETE SET NULL,
        CONSTRAINT fk_customer_transactions_account FOREIGN KEY (account_id) REFERENCES ac_accounts (id) ON DELETE SET NULL,
        CONSTRAINT fk_customer_transactions_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--  User Subscriptions (Multiple per user)
CREATE TABLE
    user_subscriptions (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        user_id BIGINT UNSIGNED NOT NULL, -- FK → users(id)
        subscription_id BIGINT UNSIGNED NOT NULL, -- FK → subscription_purchase(id)
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        status ENUM ('active', 'inactive', 'expired') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_user_subscriptions_user_id (user_id),
        INDEX idx_user_subscriptions_subscription_id (subscription_id),
        CONSTRAINT fk_user_subscriptions_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
        CONSTRAINT fk_user_subscriptions_subscription FOREIGN KEY (subscription_id) REFERENCES subscription_purchase (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Payment Types (Reference)
-- =========================
CREATE TABLE
    payment_types (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL UNIQUE, -- Cash, UPI, Card, etc.
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Accounts (Unified)
-- =========================
CREATE TABLE
    accounts (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        account_name VARCHAR(255) NOT NULL,
        account_type ENUM (
            'asset',
            'liability',
            'equity',
            'revenue',
            'expense',
            'customer',
            'supplier',
            'other'
        ) NOT NULL,
        customer_id BIGINT UNSIGNED DEFAULT NULL, -- optional FK → customers(id)
        supplier_id BIGINT UNSIGNED DEFAULT NULL, -- optional FK → suppliers(id)
        expense_id BIGINT UNSIGNED DEFAULT NULL, -- optional FK → expenses(id)
        balance DECIMAL(15, 2) DEFAULT 0.00,
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_account_name (account_name, store_id),
        INDEX idx_accounts_store_id (store_id),
        CONSTRAINT fk_accounts_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_accounts_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE SET NULL,
        CONSTRAINT fk_accounts_supplier FOREIGN KEY (supplier_id) REFERENCES suppliers (id) ON DELETE SET NULL,
        CONSTRAINT fk_accounts_expense FOREIGN KEY (expense_id) REFERENCES expenses (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Journal Entries (Header)
-- =========================
CREATE TABLE
    journal_entries (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        created_by BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        journal_code VARCHAR(100) NOT NULL,
        entry_date DATE NOT NULL,
        reference_type ENUM (
            'sale',
            'purchase',
            'return',
            'payment',
            'expense',
            'adjustment',
            'transfer'
        ) DEFAULT NULL,
        reference_id BIGINT UNSIGNED DEFAULT NULL, -- links to respective table
        description TEXT DEFAULT NULL,
        status ENUM ('pending', 'posted', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_journal_code (journal_code, store_id),
        INDEX idx_journal_entries_store_id (store_id),
        INDEX idx_journal_entries_created_by (created_by),
        CONSTRAINT fk_journal_entries_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_journal_entries_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Journal Entry Items (Lines)
-- =========================
CREATE TABLE
    journal_entry_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        journal_entry_id BIGINT UNSIGNED NOT NULL, -- FK → journal_entries(id)
        account_id BIGINT UNSIGNED NOT NULL, -- FK → accounts(id)
        debit DECIMAL(15, 2) DEFAULT 0.00,
        credit DECIMAL(15, 2) DEFAULT 0.00,
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_journal_entry_items_entry_id (journal_entry_id),
        INDEX idx_journal_entry_items_account_id (account_id),
        CONSTRAINT fk_journal_entry_items_entry FOREIGN KEY (journal_entry_id) REFERENCES journal_entries (id) ON DELETE CASCADE,
        CONSTRAINT fk_journal_entry_items_account FOREIGN KEY (account_id) REFERENCES accounts (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Unified Payments
-- =========================
CREATE TABLE
    payments (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        created_by BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        payment_code VARCHAR(100) NOT NULL,
        payment_date DATE NOT NULL,
        payment_type_id BIGINT UNSIGNED NOT NULL, -- FK → payment_types(id)
        reference_type ENUM ('sale', 'purchase', 'expense', 'order') NOT NULL,
        reference_id BIGINT UNSIGNED NOT NULL,
        amount DECIMAL(12, 2) NOT NULL,
        transaction_id VARCHAR(255) DEFAULT NULL, -- for online payments
        note TEXT DEFAULT NULL,
        status ENUM ('pending', 'completed', 'failed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_payment_code (payment_code, store_id),
        INDEX idx_payments_store_id (store_id),
        INDEX idx_payments_created_by (created_by),
        INDEX idx_payments_reference (reference_type, reference_id),
        INDEX idx_payments_payment_type (payment_type_id),
        CONSTRAINT fk_payments_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_payments_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL,
        CONSTRAINT fk_payments_payment_type FOREIGN KEY (payment_type_id) REFERENCES payment_types (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Money Transfers (Unifies transfer + deposit)
-- =========================
CREATE TABLE
    money_transfers (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        created_by BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        transfer_code VARCHAR(100) NOT NULL,
        transfer_date DATE NOT NULL,
        from_account_id BIGINT UNSIGNED DEFAULT NULL, -- FK → accounts(id)
        to_account_id BIGINT UNSIGNED NOT NULL, -- FK → accounts(id)
        payment_type_id BIGINT UNSIGNED NOT NULL, -- FK → payment_types(id)
        amount DECIMAL(12, 2) NOT NULL,
        note TEXT DEFAULT NULL,
        status ENUM ('pending', 'completed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_transfer_code (transfer_code, store_id),
        INDEX idx_money_transfers_store_id (store_id),
        INDEX idx_money_transfers_from_account (from_account_id),
        INDEX idx_money_transfers_to_account (to_account_id),
        INDEX idx_money_transfers_created_by (created_by),
        INDEX idx_money_transfers_payment_type (payment_type_id),
        CONSTRAINT fk_money_transfers_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_money_transfers_from_account FOREIGN KEY (from_account_id) REFERENCES accounts (id) ON DELETE SET NULL,
        CONSTRAINT fk_money_transfers_to_account FOREIGN KEY (to_account_id) REFERENCES accounts (id) ON DELETE RESTRICT,
        CONSTRAINT fk_money_transfers_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL,
        CONSTRAINT fk_money_transfers_payment_type FOREIGN KEY (payment_type_id) REFERENCES payment_types (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Expenses (Master)
-- =========================
CREATE TABLE
    expenses (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        created_by BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        expense_code VARCHAR(100) NOT NULL,
        expense_date DATE NOT NULL,
        expense_category_id BIGINT UNSIGNED DEFAULT NULL, -- FK → expense_categories(id)
        amount DECIMAL(12, 2) NOT NULL,
        note TEXT DEFAULT NULL,
        status ENUM ('pending', 'approved', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_expense_code (expense_code, store_id),
        INDEX idx_expenses_store_id (store_id),
        INDEX idx_expenses_created_by (created_by),
        INDEX idx_expenses_category (expense_category_id),
        CONSTRAINT fk_expenses_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_expenses_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL,
        CONSTRAINT fk_expenses_category FOREIGN KEY (expense_category_id) REFERENCES expense_categories (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- =========================
-- Expense Categories
-- =========================
CREATE TABLE
    expense_categories (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        name VARCHAR(150) NOT NULL,
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_expense_category_name (name, store_id),
        INDEX idx_expense_categories_store_id (store_id),
        CONSTRAINT fk_expense_categories_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ========================================================
-- Inventory Management — 3NF Refactored Schema
-- ========================================================
-- Notes:
-- - Assumes these parent tables already exist: stores(id), users(id), taxes(id), country_settings(id)
-- - Uses BIGINT UNSIGNED for all PK/FK IDs to match your main schema
-- ========================================================
/* UNITS (base units of measure) */
CREATE TABLE
    units (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL, -- e.g. "piece", "box"
        symbol VARCHAR(20) DEFAULT NULL, -- optional short code e.g. "pc", "bx"
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') NOT NULL DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_units_name (name)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- UNIT CONVERSIONS (keeps conversions normalized instead of in items)
CREATE TABLE
    unit_conversions (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        base_unit_id BIGINT UNSIGNED NOT NULL, -- e.g. "box"
        sub_unit_id BIGINT UNSIGNED NOT NULL, -- e.g. "piece"
        factor DECIMAL(18, 6) NOT NULL, -- multiplier: 1 box = factor * piece
        note VARCHAR(255) DEFAULT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_unitconv (base_unit_id, sub_unit_id),
        INDEX idx_unitconv_base (base_unit_id),
        INDEX idx_unitconv_sub (sub_unit_id),
        CONSTRAINT fk_unitconv_base FOREIGN KEY (base_unit_id) REFERENCES units (id) ON DELETE CASCADE,
        CONSTRAINT fk_unitconv_sub FOREIGN KEY (sub_unit_id) REFERENCES units (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- TAXES (keeps existing design; parent-child supported)
CREATE TABLE
    taxes (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        tax_type ENUM ('GST', 'VAT', 'OTHER') NOT NULL,
        parent_id BIGINT UNSIGNED DEFAULT NULL,
        name VARCHAR(255) NOT NULL,
        rate DECIMAL(7, 4) NOT NULL, -- percent (e.g. 18.00)
        group_type ENUM ('IGST', 'CGST', 'SGST', 'NONE') DEFAULT 'NONE',
        status ENUM ('active', 'inactive') NOT NULL DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_taxes_parent (parent_id),
        CONSTRAINT fk_taxes_parent FOREIGN KEY (parent_id) REFERENCES taxes (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- BRANDS
CREATE TABLE
    brands (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        slug VARCHAR(255) DEFAULT NULL,
        code VARCHAR(100) NOT NULL,
        name VARCHAR(255) NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') NOT NULL DEFAULT 'active',
        inapp_view ENUM ('visible', 'hidden') NOT NULL DEFAULT 'visible',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_brand_code (store_id, code),
        INDEX idx_brands_store (store_id),
        CONSTRAINT fk_brands_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- CATEGORIES (hierarchical)
CREATE TABLE
    categories (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        parent_id BIGINT UNSIGNED DEFAULT NULL,
        slug VARCHAR(255) DEFAULT NULL,
        code VARCHAR(100) NOT NULL,
        name VARCHAR(255) NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') NOT NULL DEFAULT 'active',
        inapp_view ENUM ('visible', 'hidden') NOT NULL DEFAULT 'visible',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_category_code (store_id, code),
        INDEX idx_categories_store (store_id),
        INDEX idx_categories_parent (parent_id),
        CONSTRAINT fk_categories_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_categories_parent FOREIGN KEY (parent_id) REFERENCES categories (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ITEMS (core product master)
CREATE TABLE
    items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        code VARCHAR(100) NOT NULL,
        name VARCHAR(255) NOT NULL,
        image VARCHAR(255) DEFAULT NULL,
        category_id BIGINT UNSIGNED DEFAULT NULL,
        brand_id BIGINT UNSIGNED DEFAULT NULL,
        sku VARCHAR(100) DEFAULT NULL,
        hsn_code VARCHAR(100) DEFAULT NULL,
        barcode VARCHAR(100) DEFAULT NULL,
        base_unit_id BIGINT UNSIGNED DEFAULT NULL, -- FK → units (base)
        default_subunit_id BIGINT UNSIGNED DEFAULT NULL, -- FK → units (nullable)
        description TEXT DEFAULT NULL,
        purchase_price DECIMAL(18, 4) DEFAULT NULL, -- last purchase or standard cost
        mrp DECIMAL(18, 4) DEFAULT NULL,
        default_tax_id BIGINT UNSIGNED DEFAULT NULL, -- FK → taxes(id)
        if_expiry TINYINT (1) NOT NULL DEFAULT 0,
        if_batch TINYINT (1) NOT NULL DEFAULT 0,
        status ENUM ('active', 'inactive') NOT NULL DEFAULT 'active',
        created_by BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_item_code (store_id, code),
        INDEX idx_items_store (store_id),
        INDEX idx_items_category (category_id),
        INDEX idx_items_brand (brand_id),
        INDEX idx_items_base_unit (base_unit_id),
        INDEX idx_items_tax (default_tax_id),
        CONSTRAINT fk_items_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_items_category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL,
        CONSTRAINT fk_items_brand FOREIGN KEY (brand_id) REFERENCES brands (id) ON DELETE SET NULL,
        CONSTRAINT fk_items_base_unit FOREIGN KEY (base_unit_id) REFERENCES units (id) ON DELETE SET NULL,
        CONSTRAINT fk_items_subunit FOREIGN KEY (default_subunit_id) REFERENCES units (id) ON DELETE SET NULL,
        CONSTRAINT fk_items_default_tax FOREIGN KEY (default_tax_id) REFERENCES taxes (id) ON DELETE SET NULL,
        CONSTRAINT fk_items_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ITEM PRICES (separate pricing table to support store/warehouse/customer-group prices & history)
CREATE TABLE
    item_prices (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        item_id BIGINT UNSIGNED NOT NULL, -- FK → items(id)
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        warehouse_id BIGINT UNSIGNED DEFAULT NULL, -- optional FK → warehouse(id)
        customer_group_id BIGINT UNSIGNED DEFAULT NULL, -- optional FK → customer_groups(id)
        price_type ENUM ('retail', 'wholesale', 'special', 'mrp', 'cost') NOT NULL DEFAULT 'retail',
        price DECIMAL(18, 4) NOT NULL,
        valid_from DATE DEFAULT NULL,
        valid_to DATE DEFAULT NULL,
        currency_id BIGINT UNSIGNED DEFAULT NULL, -- optional if multi-currency supported
        active TINYINT (1) NOT NULL DEFAULT 1,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_item_price (
            item_id,
            store_id,
            warehouse_id,
            customer_group_id,
            price_type,
            valid_from
        ),
        INDEX idx_item_prices_item (item_id),
        INDEX idx_item_prices_store (store_id),
        CONSTRAINT fk_item_prices_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE,
        CONSTRAINT fk_item_prices_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE
        -- NOTE: optional FKs (warehouse, customer_group, currency) removed to avoid circular requirement,
        -- add if those tables exist and you want FK enforcement
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- ITEM SERIALS
CREATE TABLE
    item_serials (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        item_id BIGINT UNSIGNED NOT NULL,
        serial_no VARCHAR(255) NOT NULL,
        purchase_id BIGINT UNSIGNED DEFAULT NULL,
        purchase_return_id BIGINT UNSIGNED DEFAULT NULL,
        sales_id BIGINT UNSIGNED DEFAULT NULL,
        sales_return_id BIGINT UNSIGNED DEFAULT NULL,
        status ENUM (
            'in_stock',
            'purchased',
            'sold',
            'sale_return',
            'purchase_return'
        ) NOT NULL DEFAULT 'in_stock',
        warranty_until DATE DEFAULT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_item_serial (item_id, serial_no),
        INDEX idx_item_serial_item (item_id),
        INDEX idx_item_serial_purchase (purchase_id),
        INDEX idx_item_serial_purchase_return (purchase_return_id),
        INDEX idx_item_serial_sales (sales_id),
        INDEX idx_item_serial_sales_return (sales_return_id),
        CONSTRAINT fk_item_serial_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE,
        CONSTRAINT fk_item_serial_purchase FOREIGN KEY (purchase_id) REFERENCES purchases (id) ON DELETE SET NULL,
        CONSTRAINT fk_item_serial_purchase_return FOREIGN KEY (purchase_return_id) REFERENCES purchase_returns (id) ON DELETE SET NULL,
        CONSTRAINT fk_item_serial_sales FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE SET NULL,
        CONSTRAINT fk_item_serial_sales_return FOREIGN KEY (sales_return_id) REFERENCES sales_returns (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- WAREHOUSES
CREATE TABLE
    warehouses (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        type ENUM ('default', 'custom') NOT NULL DEFAULT 'custom',
        name VARCHAR(255) NOT NULL,
        address TEXT DEFAULT NULL,
        mobile VARCHAR(20) DEFAULT NULL,
        email VARCHAR(100) DEFAULT NULL,
        status ENUM ('active', 'inactive') NOT NULL DEFAULT 'active',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_warehouses_store (store_id),
        CONSTRAINT fk_warehouses_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- WAREHOUSE STOCK (keeps batch-level inventory per warehouse)
CREATE TABLE
    warehouse_stock (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        warehouse_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        batch_no VARCHAR(100) DEFAULT NULL,
        expiry_date DATE DEFAULT NULL,
        available_qty DECIMAL(18, 4) NOT NULL DEFAULT 0.0000,
        reserved_qty DECIMAL(18, 4) NOT NULL DEFAULT 0.0000, -- for orders/holds
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_warehouse_item_batch (warehouse_id, item_id, batch_no),
        INDEX idx_warehouse_stock_wh (warehouse_id),
        INDEX idx_warehouse_stock_item (item_id),
        CONSTRAINT fk_warehouse_stock_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouses (id) ON DELETE CASCADE,
        CONSTRAINT fk_warehouse_stock_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- STOCK ADJUSTMENTS (master)
CREATE TABLE
    stock_adjustments (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED NOT NULL,
        reference_no VARCHAR(100) NOT NULL,
        adjustment_date DATE NOT NULL,
        reason TEXT DEFAULT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        status ENUM ('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_stock_adjust_ref (store_id, reference_no),
        INDEX idx_stock_adjust_store (store_id),
        INDEX idx_stock_adjust_wh (warehouse_id),
        CONSTRAINT fk_stock_adjust_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_stock_adjust_wh FOREIGN KEY (warehouse_id) REFERENCES warehouses (id) ON DELETE CASCADE,
        CONSTRAINT fk_stock_adjust_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- STOCK ADJUSTMENT ITEMS (detail; store before/after for audit)
CREATE TABLE
    stock_adjustment_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        adjustment_id BIGINT UNSIGNED NOT NULL, -- FK → stock_adjustments(id)
        warehouse_stock_id BIGINT UNSIGNED DEFAULT NULL, -- FK → warehouse_stock(id) optional
        item_id BIGINT UNSIGNED NOT NULL,
        batch_no VARCHAR(100) DEFAULT NULL,
        qty_change DECIMAL(18, 4) NOT NULL, -- positive/negative
        qty_before DECIMAL(18, 4) DEFAULT NULL,
        qty_after DECIMAL(18, 4) DEFAULT NULL,
        note TEXT DEFAULT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_sa_items_adjustment (adjustment_id),
        INDEX idx_sa_items_item (item_id),
        CONSTRAINT fk_sa_items_adjustment FOREIGN KEY (adjustment_id) REFERENCES stock_adjustments (id) ON DELETE CASCADE,
        CONSTRAINT fk_sa_items_warehouse_stock FOREIGN KEY (warehouse_stock_id) REFERENCES warehouse_stock (id) ON DELETE SET NULL,
        CONSTRAINT fk_sa_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- STOCK TRANSFERS (master)
CREATE TABLE
    stock_transfers (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        transfer_code VARCHAR(100) NOT NULL,
        type ENUM (
            'store_to_store',
            'warehouse_to_warehouse',
            'warehouse_to_store',
            'store_to_warehouse'
        ) NOT NULL,
        from_store_id BIGINT UNSIGNED DEFAULT NULL,
        to_store_id BIGINT UNSIGNED DEFAULT NULL,
        warehouse_from_id BIGINT UNSIGNED DEFAULT NULL,
        warehouse_to_id BIGINT UNSIGNED DEFAULT NULL,
        transfer_date DATE NOT NULL,
        reference_no VARCHAR(100) DEFAULT NULL,
        note TEXT DEFAULT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        status ENUM ('pending', 'in_transit', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_stock_transfer_code (store_id, transfer_code),
        INDEX idx_stock_transfers_store (store_id),
        INDEX idx_stock_transfers_from_store (from_store_id),
        INDEX idx_stock_transfers_to_store (to_store_id),
        INDEX idx_stock_transfers_wh_from (warehouse_from_id),
        INDEX idx_stock_transfers_wh_to (warehouse_to_id),
        CONSTRAINT fk_stock_transfers_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_stock_transfers_from_store FOREIGN KEY (from_store_id) REFERENCES stores (id) ON DELETE SET NULL,
        CONSTRAINT fk_stock_transfers_to_store FOREIGN KEY (to_store_id) REFERENCES stores (id) ON DELETE SET NULL,
        CONSTRAINT fk_stock_transfers_wh_from FOREIGN KEY (warehouse_from_id) REFERENCES warehouses (id) ON DELETE SET NULL,
        CONSTRAINT fk_stock_transfers_wh_to FOREIGN KEY (warehouse_to_id) REFERENCES warehouses (id) ON DELETE SET NULL,
        CONSTRAINT fk_stock_transfers_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- STOCK TRANSFER ITEMS (detail)
CREATE TABLE
    stock_transfer_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        stock_transfer_id BIGINT UNSIGNED NOT NULL, -- FK → stock_transfers(id)
        item_id BIGINT UNSIGNED NOT NULL, -- FK → items(id)
        batch_no VARCHAR(100) DEFAULT NULL,
        qty DECIMAL(18, 4) NOT NULL,
        unit_price DECIMAL(18, 4) DEFAULT NULL,
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_st_items_transfer (stock_transfer_id),
        INDEX idx_st_items_item (item_id),
        CONSTRAINT fk_st_items_transfer FOREIGN KEY (stock_transfer_id) REFERENCES stock_transfers (id) ON DELETE CASCADE,
        CONSTRAINT fk_st_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- OPTIONAL: Quick stock view materialized-ish (de-normalized read table; update via triggers/jobs)
-- Not strictly required; included as suggestion only
CREATE TABLE
    item_stock_summary (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        total_available DECIMAL(18, 4) NOT NULL DEFAULT 0.0000,
        total_reserved DECIMAL(18, 4) NOT NULL DEFAULT 0.0000,
        last_updated TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_item_stock_summary (store_id, item_id),
        INDEX idx_item_stock_summary_store (store_id),
        INDEX idx_item_stock_summary_item (item_id),
        CONSTRAINT fk_item_stock_summary_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_item_stock_summary_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Order status (store-scoped)
CREATE TABLE
    order_status (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL,
        status_name VARCHAR(100) NOT NULL,
        status_color VARCHAR(20) DEFAULT NULL,
        is_default TINYINT (1) NOT NULL DEFAULT 0,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_order_status_store_name (store_id, status_name),
        INDEX idx_order_status_store_id (store_id),
        CONSTRAINT fk_order_status_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Orders (master)
CREATE TABLE
    orders (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        unique_order_id VARCHAR(100) NOT NULL UNIQUE,
        order_status_id BIGINT UNSIGNED NOT NULL, -- FK -> order_status(id)
        store_id BIGINT UNSIGNED NOT NULL, -- FK -> stores(id)
        customer_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> customers(id)
        user_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> users(id) if placed by a user
        sales_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> sales(id) optional
        shipping_address_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> addresses(id) (snapshot link)
        order_address TEXT DEFAULT NULL, -- optional snapshot of address at time of order
        reward_point DECIMAL(10, 2) DEFAULT 0.00,
        sub_total DECIMAL(15, 2) DEFAULT 0.00,
        tax_rate DECIMAL(5, 2) DEFAULT 0.00,
        tax_amt DECIMAL(15, 2) DEFAULT 0.00,
        delivery_charge DECIMAL(15, 2) DEFAULT 0.00,
        discount DECIMAL(15, 2) DEFAULT 0.00,
        coupon_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> coupons(id)
        coupon_amount DECIMAL(15, 2) DEFAULT 0.00,
        handling_charge DECIMAL(15, 2) DEFAULT 0.00,
        order_totalamt DECIMAL(15, 2) DEFAULT 0.00,
        payment_mode ENUM ('cash', 'card', 'online', 'wallet') DEFAULT 'cash',
        map_distance DECIMAL(10, 2) DEFAULT 0.00,
        delivery_pin VARCHAR(10) DEFAULT NULL,
        deliveryboy_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> users(id)
        delivery_timeslot_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> delivery_timeslots(id)
        notifications_admin TINYINT (1) DEFAULT 0,
        notifications_store TINYINT (1) DEFAULT 0,
        notifications_deliveryboy TINYINT (1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_orders_store_id (store_id),
        INDEX idx_orders_customer_id (customer_id),
        INDEX idx_orders_user_id (user_id),
        INDEX idx_orders_sales_id (sales_id),
        INDEX idx_orders_coupon_id (coupon_id),
        INDEX idx_orders_order_status_id (order_status_id),
        INDEX idx_orders_deliveryboy_id (deliveryboy_id),
        INDEX idx_orders_shipping_address_id (shipping_address_id),
        INDEX idx_orders_delivery_timeslot_id (delivery_timeslot_id),
        CONSTRAINT fk_orders_order_status FOREIGN KEY (order_status_id) REFERENCES order_status (id) ON DELETE RESTRICT,
        CONSTRAINT fk_orders_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_orders_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE SET NULL,
        CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL,
        CONSTRAINT fk_orders_sales FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE SET NULL,
        CONSTRAINT fk_orders_coupon FOREIGN KEY (coupon_id) REFERENCES coupons (id) ON DELETE SET NULL,
        CONSTRAINT fk_orders_deliveryboy FOREIGN KEY (deliveryboy_id) REFERENCES users (id) ON DELETE SET NULL,
        CONSTRAINT fk_orders_shipping_address FOREIGN KEY (shipping_address_id) REFERENCES addresses (id) ON DELETE SET NULL,
        CONSTRAINT fk_orders_delivery_timeslot FOREIGN KEY (delivery_timeslot_id) REFERENCES delivery_timeslots (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- Orders line items (no redundant store/user columns)
CREATE TABLE
    orders_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        order_id BIGINT UNSIGNED NOT NULL, -- FK -> orders(id)
        item_id BIGINT UNSIGNED NOT NULL, -- FK -> items(id)
        warehouse_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> warehouse(id)
        selling_price DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        qty DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_rate DECIMAL(5, 2) DEFAULT 0.00,
        tax_type ENUM ('percent', 'fixed') DEFAULT 'percent',
        tax_amt DECIMAL(15, 2) DEFAULT 0.00,
        discount_type ENUM ('none', 'fixed', 'percentage') DEFAULT 'none',
        discount_value DECIMAL(15, 2) DEFAULT 0.00,
        total_price DECIMAL(15, 2) DEFAULT 0.00,
        if_offer TINYINT (1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_orders_items_order_id (order_id),
        INDEX idx_orders_items_item_id (item_id),
        INDEX idx_orders_items_warehouse_id (warehouse_id),
        CONSTRAINT fk_orders_items_order FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
        CONSTRAINT fk_orders_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_orders_items_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouse (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4_COLLATE = utf8mb4_unicode_ci;

-- Order logs / events
CREATE TABLE
    order_log (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        order_id BIGINT UNSIGNED NOT NULL,
        event_type VARCHAR(100) NOT NULL, -- e.g., status_change, payment, shipment
        subject VARCHAR(255) NOT NULL,
        description TEXT DEFAULT NULL,
        order_status_id BIGINT UNSIGNED DEFAULT NULL, -- FK -> order_status(id) (optional)
        log_by BIGINT UNSIGNED DEFAULT NULL, -- FK -> users(id)
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_order_log_order_id (order_id),
        INDEX idx_order_log_status_id (order_status_id),
        INDEX idx_order_log_log_by (log_by),
        CONSTRAINT fk_order_log_order FOREIGN KEY (order_id) REFERENCES orders (id) ON DELETE CASCADE,
        CONSTRAINT fk_order_log_status FOREIGN KEY (order_status_id) REFERENCES order_status (id) ON DELETE SET NULL,
        CONSTRAINT fk_order_log_user FOREIGN KEY (log_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    purchases (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL,
        supplier_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED DEFAULT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        purchase_code VARCHAR(100) NOT NULL,
        bill_number VARCHAR(100) DEFAULT NULL,
        reference_no VARCHAR(100) DEFAULT NULL,
        purchase_date DATE NOT NULL,
        purchase_note TEXT DEFAULT NULL,
        status ENUM ('draft', 'confirmed', 'received', 'cancelled') DEFAULT 'draft',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_purchase_code (purchase_code, store_id),
        CONSTRAINT fk_purchase_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_supplier FOREIGN KEY (supplier_id) REFERENCES suppliers (id) ON DELETE RESTRICT,
        CONSTRAINT fk_purchase_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouses (id) ON DELETE SET NULL,
        CONSTRAINT fk_purchase_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    purchase_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        purchase_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        purchase_qty DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        price_per_unit DECIMAL(15, 2) NOT NULL,
        tax_type ENUM ('percent', 'fixed') DEFAULT 'percent',
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('percent', 'fixed', 'none') DEFAULT 'none',
        discount_value DECIMAL(15, 2) DEFAULT 0.00,
        batch_no VARCHAR(100) DEFAULT NULL,
        expire_date DATE DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_purchase_items_purchase_id (purchase_id),
        INDEX idx_purchase_items_item_id (item_id),
        CONSTRAINT fk_purchase_item_purchase FOREIGN KEY (purchase_id) REFERENCES purchases (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_item_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_purchase_item_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    purchase_payments (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL,
        purchase_id BIGINT UNSIGNED NOT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        payment_code VARCHAR(100) NOT NULL,
        payment_date DATE NOT NULL,
        payment_type_id BIGINT UNSIGNED NOT NULL,
        reference_no VARCHAR(100) DEFAULT NULL,
        amount DECIMAL(12, 2) NOT NULL,
        note TEXT DEFAULT NULL,
        status ENUM ('pending', 'completed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_purchase_payment_code (payment_code, store_id),
        INDEX idx_purchase_payments_purchase_id (purchase_id),
        INDEX idx_purchase_payments_store_id (store_id),
        INDEX idx_purchase_payments_payment_type_id (payment_type_id),
        CONSTRAINT fk_purchase_payments_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_payments_purchase FOREIGN KEY (purchase_id) REFERENCES purchases (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_payments_payment_type FOREIGN KEY (payment_type_id) REFERENCES payment_types (id) ON DELETE RESTRICT,
        CONSTRAINT fk_purchase_payments_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    purchase_returns (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        purchase_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED DEFAULT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        return_code VARCHAR(100) NOT NULL,
        reference_no VARCHAR(100) DEFAULT NULL,
        return_date DATE NOT NULL,
        return_status ENUM ('pending', 'partial', 'completed', 'cancelled') DEFAULT 'pending',
        return_note TEXT DEFAULT NULL,
        status ENUM ('draft', 'confirmed', 'processed', 'cancelled') DEFAULT 'draft',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_purchase_return_code (return_code, purchase_id),
        INDEX idx_purchase_returns_purchase_id (purchase_id),
        CONSTRAINT fk_purchase_returns_purchase FOREIGN KEY (purchase_id) REFERENCES purchases (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_returns_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouses (id) ON DELETE SET NULL,
        CONSTRAINT fk_purchase_returns_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    purchase_return_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        purchase_return_id BIGINT UNSIGNED NOT NULL,
        purchase_item_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        return_qty DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        price_per_unit DECIMAL(15, 2) DEFAULT 0.00,
        tax_type ENUM ('percent', 'fixed') DEFAULT 'percent',
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('percent', 'fixed', 'none') DEFAULT 'none',
        discount_value DECIMAL(15, 2) DEFAULT 0.00,
        batch_no VARCHAR(100) DEFAULT NULL,
        expire_date DATE DEFAULT NULL,
        description TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_purchase_return_items_return_id (purchase_return_id),
        INDEX idx_purchase_return_items_purchase_item_id (purchase_item_id),
        INDEX idx_purchase_return_items_item_id (item_id),
        CONSTRAINT fk_purchase_return_items_return FOREIGN KEY (purchase_return_id) REFERENCES purchase_returns (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_return_items_purchase_item FOREIGN KEY (purchase_item_id) REFERENCES purchase_items (id) ON DELETE CASCADE,
        CONSTRAINT fk_purchase_return_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_purchase_return_items_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE VIEW
    purchase_item_totals AS
SELECT
    pi.id AS purchase_item_id,
    pi.purchase_id,
    pi.item_id,
    pi.purchase_qty,
    pi.price_per_unit,
    COALESCE(pi.purchase_qty * pi.price_per_unit, 0) AS item_cost,
    COALESCE(
        CASE pi.tax_type
            WHEN 'percent' THEN (pi.purchase_qty * pi.price_per_unit) * (pi.tax_value / 100)
            WHEN 'fixed' THEN pi.tax_value
        END,
        0
    ) AS tax_amt,
    COALESCE(
        CASE pi.discount_type
            WHEN 'percent' THEN (pi.purchase_qty * pi.price_per_unit) * (pi.discount_value / 100)
            WHEN 'fixed' THEN pi.discount_value
            ELSE 0
        END,
        0
    ) AS discount_amt,
    (
        COALESCE(pi.purchase_qty * pi.price_per_unit, 0) + COALESCE(
            CASE pi.tax_type
                WHEN 'percent' THEN (pi.purchase_qty * pi.price_per_unit) * (pi.tax_value / 100)
                WHEN 'fixed' THEN pi.tax_value
            END,
            0
        ) - COALESCE(
            CASE pi.discount_type
                WHEN 'percent' THEN (pi.purchase_qty * pi.price_per_unit) * (pi.discount_value / 100)
                WHEN 'fixed' THEN pi.discount_value
                ELSE 0
            END,
            0
        )
    ) AS total_cost
FROM
    purchase_items pi;

CREATE VIEW
    purchase_totals AS
SELECT
    p.id AS purchase_id,
    p.purchase_code,
    SUM(pit.item_cost) AS subtotal,
    SUM(pit.tax_amt) AS total_tax,
    SUM(pit.discount_amt) AS total_discount,
    SUM(pit.total_cost) AS grand_total
FROM
    purchases p
    LEFT JOIN purchase_item_totals pit ON pit.purchase_id = p.id
GROUP BY
    p.id,
    p.purchase_code;

CREATE VIEW
    purchase_return_totals AS
SELECT
    pr.id AS purchase_return_id,
    pr.return_code,
    SUM(
        COALESCE(pri.return_qty * pri.price_per_unit, 0) + COALESCE(
            CASE pri.tax_type
                WHEN 'percent' THEN (pri.return_qty * pri.price_per_unit) * (pri.tax_amt / 100)
                WHEN 'fixed' THEN pri.tax_amt
            END,
            0
        ) - COALESCE(
            CASE pri.discount_type
                WHEN 'percent' THEN (pri.return_qty * pri.price_per_unit) * (pri.discount_value / 100)
                WHEN 'fixed' THEN pri.discount_value
                ELSE 0
            END,
            0
        )
    ) AS total_return_cost
FROM
    purchase_returns pr
    LEFT JOIN purchase_return_items pri ON pri.purchase_return_id = pr.id
GROUP BY
    pr.id,
    pr.return_code;

CREATE TABLE
    quotations (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL,
        customer_id BIGINT UNSIGNED NOT NULL,
        quote_number VARCHAR(100) NOT NULL UNIQUE,
        quote_date DATE NOT NULL,
        status ENUM (
            'draft',
            'sent',
            'accepted',
            'rejected',
            'expired'
        ) DEFAULT 'draft',
        created_by BIGINT UNSIGNED NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT fk_quotation_store FOREIGN KEY (store_id) REFERENCES stores (id),
        CONSTRAINT fk_quotation_customer FOREIGN KEY (customer_id) REFERENCES customers (id),
        CONSTRAINT fk_quotation_created_by FOREIGN KEY (created_by) REFERENCES users (id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE TABLE
    quotation_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        quotation_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        price_per_unit DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('none', 'percent', 'fixed') DEFAULT 'none',
        discount_value DECIMAL(15, 2) DEFAULT 0.00,
        unit VARCHAR(50) DEFAULT NULL,
        quantity INT NOT NULL DEFAULT 1,
        batch_no VARCHAR(100) DEFAULT NULL,
        serial_numbers TEXT DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_quotation_items_quotation_id (quotation_id),
        INDEX idx_quotation_items_item_id (item_id),
        INDEX idx_quotation_items_tax_id (tax_id),
        CONSTRAINT fk_quotation_item_quotation FOREIGN KEY (quotation_id) REFERENCES quotations (id) ON DELETE CASCADE,
        CONSTRAINT fk_quotation_item_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_quotation_item_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

CREATE VIEW
    quotation_item_totals AS
SELECT
    qi.id AS quotation_item_id,
    qi.quotation_id,
    qi.item_id,
    qi.quantity,
    qi.price_per_unit,
    COALESCE(qi.price_per_unit * qi.quantity, 0) AS item_cost,
    COALESCE(
        CASE qi.discount_type
            WHEN 'percent' THEN (qi.price_per_unit * qi.quantity) * (qi.discount_value / 100)
            WHEN 'fixed' THEN qi.discount_value
            ELSE 0
        END,
        0
    ) AS discount_amt,
    COALESCE(qi.tax_rate, 0) AS tax_rate,
    COALESCE(
        (
            qi.price_per_unit * qi.quantity - CASE qi.discount_type
                WHEN 'percent' THEN (qi.price_per_unit * qi.quantity) * (qi.discount_value / 100)
                WHEN 'fixed' THEN qi.discount_value
                ELSE 0
            END
        ) * (qi.tax_rate / 100),
        0
    ) AS tax_amt,
    (
        COALESCE(qi.price_per_unit * qi.quantity, 0) - COALESCE(
            CASE qi.discount_type
                WHEN 'percent' THEN (qi.price_per_unit * qi.quantity) * (qi.discount_value / 100)
                WHEN 'fixed' THEN qi.discount_value
                ELSE 0
            END,
            0
        ) + COALESCE(
            (
                qi.price_per_unit * qi.quantity - CASE qi.discount_type
                    WHEN 'percent' THEN (qi.price_per_unit * qi.quantity) * (qi.discount_value / 100)
                    WHEN 'fixed' THEN qi.discount_value
                    ELSE 0
                END
            ) * (qi.tax_rate / 100),
            0
        )
    ) AS total_cost
FROM
    quotation_items qi;

CREATE VIEW
    quotation_totals AS
SELECT
    q.id AS quotation_id,
    q.quote_number,
    SUM(qit.item_cost) AS subtotal,
    SUM(qit.discount_amt) AS total_discount,
    SUM(qit.tax_amt) AS total_tax,
    SUM(qit.total_cost) AS grand_total
FROM
    quotations q
    LEFT JOIN quotation_item_totals qit ON qit.quotation_id = q.id
GROUP BY
    q.id,
    q.quote_number;

CREATE TABLE
    sales (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        sales_code VARCHAR(100) NOT NULL UNIQUE,
        reference_no VARCHAR(100) DEFAULT NULL,
        sales_date DATE NOT NULL,
        due_date DATE DEFAULT NULL,
        sales_status ENUM ('draft', 'confirmed', 'delivered', 'cancelled') DEFAULT 'draft',
        customer_id BIGINT UNSIGNED NOT NULL, -- FK → customers(id)
        payment_status ENUM ('pending', 'partial', 'paid') DEFAULT 'pending',
        quotation_id BIGINT UNSIGNED DEFAULT NULL, -- FK → quotations(id)
        coupon_id BIGINT UNSIGNED DEFAULT NULL, -- FK → coupons(id)
        invoice_terms TEXT DEFAULT NULL,
        status ENUM ('active', 'cancelled') DEFAULT 'active',
        created_by BIGINT UNSIGNED NOT NULL, -- FK → users(id)
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_sales_store_id (store_id),
        INDEX idx_sales_customer_id (customer_id),
        CONSTRAINT fk_sales_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE RESTRICT,
        CONSTRAINT fk_sales_creator FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE RESTRICT,
        CONSTRAINT fk_sales_quotation FOREIGN KEY (quotation_id) REFERENCES quotations (id) ON DELETE SET NULL,
        CONSTRAINT fk_sales_coupon FOREIGN KEY (coupon_id) REFERENCES coupons (id) ON DELETE SET NULL
    );

CREATE TABLE
    sales_item_charges (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        sales_id BIGINT UNSIGNED NOT NULL,
        charge_type ENUM ('other_charges', 'discount_to_all') NOT NULL,
        input_value DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        calculated_amount DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        discount_type ENUM ('percent', 'fixed') DEFAULT 'fixed',
        PRIMARY KEY (id),
        INDEX idx_sales_item_charges_sales_id (sales_id),
        CONSTRAINT fk_sales_item_charges_sales FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_item_charges_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    );

CREATE TABLE
    sales_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        sales_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED DEFAULT NULL,
        description TEXT DEFAULT NULL,
        sales_qty DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        price_per_unit DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_type ENUM ('percent', 'fixed') DEFAULT 'percent',
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('percent', 'fixed') DEFAULT 'fixed',
        discount_input DECIMAL(15, 2) DEFAULT 0.00,
        PRIMARY KEY (id),
        INDEX idx_sales_items_sales_id (sales_id),
        INDEX idx_sales_items_item_id (item_id),
        INDEX idx_sales_items_warehouse_id (warehouse_id),
        INDEX idx_sales_items_tax_id (tax_id),
        CONSTRAINT fk_sales_items_sales FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_sales_items_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouse (id) ON DELETE SET NULL,
        CONSTRAINT fk_sales_items_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    );

CREATE TABLE
    sales_payments (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        sales_id BIGINT UNSIGNED NOT NULL,
        customer_id BIGINT UNSIGNED NOT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        payment_code VARCHAR(100) NOT NULL,
        payment_date DATE NOT NULL,
        payment_type_id BIGINT UNSIGNED NOT NULL,
        reference_no VARCHAR(100) DEFAULT NULL,
        amount DECIMAL(12, 2) NOT NULL,
        note TEXT DEFAULT NULL,
        status ENUM ('pending', 'completed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        UNIQUE KEY uq_sales_payment_code (payment_code, store_id),
        INDEX idx_sales_payments_sales_id (sales_id),
        CONSTRAINT fk_sales_payments_sale FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE CASCADE
    );

CREATE TABLE
    sales_item_returns (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        sales_id BIGINT UNSIGNED NOT NULL,
        sales_item_id BIGINT UNSIGNED NOT NULL,
        customer_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED NOT NULL,
        created_by BIGINT UNSIGNED NOT NULL,
        return_code VARCHAR(100) NOT NULL,
        return_date DATE NOT NULL,
        note TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        PRIMARY KEY (id),
        UNIQUE KEY uq_sales_item_return_code (return_code, store_id),
        INDEX idx_sales_item_returns_sales_id (sales_id),
        INDEX idx_sales_item_returns_sales_item_id (sales_item_id),
        INDEX idx_sales_item_returns_customer_id (customer_id),
        CONSTRAINT fk_sales_item_returns_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_item_returns_sales FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE RESTRICT,
        CONSTRAINT fk_sales_item_returns_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_sales_item_returns_sales_item FOREIGN KEY (sales_item_id) REFERENCES sales_items (id) ON DELETE RESTRICT
    );

CREATE TABLE
    sales_item_return_charges (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        sales_item_return_id BIGINT UNSIGNED NOT NULL,
        charge_type ENUM ('tax', 'discount') NOT NULL,
        input_value DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('percent', 'fixed') DEFAULT 'fixed',
        PRIMARY KEY (id),
        INDEX idx_sales_item_return_charges_return_id (sales_item_return_id),
        CONSTRAINT fk_sales_item_return_charges_return FOREIGN KEY (sales_item_return_id) REFERENCES sales_item_returns (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_item_return_charges_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    );

CREATE TABLE
    sales_return (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        sales_id BIGINT UNSIGNED NOT NULL,
        customer_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED NOT NULL,
        created_by BIGINT UNSIGNED NOT NULL,
        return_code VARCHAR(100) NOT NULL,
        return_date DATE NOT NULL,
        note TEXT DEFAULT NULL,
        status ENUM ('pending', 'completed', 'cancelled') DEFAULT 'pending',
        payment_status ENUM ('pending', 'partial', 'paid') DEFAULT 'pending',
        PRIMARY KEY (id),
        UNIQUE KEY uq_sales_return_code (return_code, store_id),
        INDEX idx_sales_return_sales_id (sales_id),
        INDEX idx_sales_return_customer_id (customer_id),
        CONSTRAINT fk_sales_return_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_return_sales FOREIGN KEY (sales_id) REFERENCES sales (id) ON DELETE RESTRICT
    );

CREATE TABLE
    sales_return_charges (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        sales_return_id BIGINT UNSIGNED NOT NULL,
        charge_type ENUM ('tax', 'discount') NOT NULL,
        input_value DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('none', 'fixed', 'percentage') DEFAULT 'none',
        PRIMARY KEY (id),
        INDEX idx_sales_return_charges_return_id (sales_return_id),
        CONSTRAINT fk_sales_return_charges_return FOREIGN KEY (sales_return_id) REFERENCES sales_return (id) ON DELETE CASCADE,
        CONSTRAINT fk_sales_return_charges_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    );

CREATE TABLE
    pos_hold (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED DEFAULT NULL,
        init_code VARCHAR(100) DEFAULT NULL,
        sales_code VARCHAR(100) DEFAULT NULL,
        reference_no VARCHAR(100) DEFAULT NULL,
        sales_date DATE DEFAULT NULL,
        due_date DATE DEFAULT NULL,
        sales_status ENUM ('draft', 'confirmed', 'delivered', 'cancelled') DEFAULT 'draft',
        customer_id BIGINT UNSIGNED DEFAULT NULL,
        quotation_id BIGINT UNSIGNED DEFAULT NULL,
        invoice_terms TEXT DEFAULT NULL,
        status ENUM ('active', 'cancelled') DEFAULT 'active',
        created_by BIGINT UNSIGNED NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY uq_pos_hold_code (sales_code, store_id),
        INDEX idx_pos_hold_store_id (store_id),
        INDEX idx_pos_hold_warehouse_id (warehouse_id),
        CONSTRAINT fk_pos_hold_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_pos_hold_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouse (id) ON DELETE SET NULL,
        CONSTRAINT fk_pos_hold_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE SET NULL,
        CONSTRAINT fk_pos_hold_creator FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE RESTRICT,
        CONSTRAINT fk_pos_hold_quotation FOREIGN KEY (quotation_id) REFERENCES quotations (id) ON DELETE SET NULL
    );

CREATE TABLE
    pos_hold_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        hold_id BIGINT UNSIGNED NOT NULL,
        item_id BIGINT UNSIGNED NOT NULL,
        store_id BIGINT UNSIGNED NOT NULL,
        warehouse_id BIGINT UNSIGNED DEFAULT NULL,
        sales_qty DECIMAL(15, 2) DEFAULT 0.00,
        price_per_unit DECIMAL(15, 2) DEFAULT 0.00,
        tax_type ENUM ('percent', 'fixed') DEFAULT 'percent',
        tax_id BIGINT UNSIGNED DEFAULT NULL,
        discount_type ENUM ('percent', 'fixed') DEFAULT 'fixed',
        discount_input DECIMAL(15, 2) DEFAULT 0.00,
        if_expiry TINYINT (1) DEFAULT 0,
        item_purchase_table_id BIGINT UNSIGNED DEFAULT NULL,
        batch_no VARCHAR(100) DEFAULT NULL,
        serial_no VARCHAR(255) DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        PRIMARY KEY (id),
        INDEX idx_pos_hold_items_hold_id (hold_id),
        CONSTRAINT fk_pos_hold_items_hold FOREIGN KEY (hold_id) REFERENCES pos_hold (id) ON DELETE CASCADE,
        CONSTRAINT fk_pos_hold_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_pos_hold_items_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_pos_hold_items_warehouse FOREIGN KEY (warehouse_id) REFERENCES warehouse (id) ON DELETE SET NULL,
        CONSTRAINT fk_pos_hold_items_purchase FOREIGN KEY (item_purchase_table_id) REFERENCES purchase_items (id) ON DELETE SET NULL,
        CONSTRAINT fk_pos_hold_items_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    );

-- QUOTATIONS
CREATE TABLE
    quotations (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        customer_id BIGINT UNSIGNED NOT NULL, -- FK → customers(id)
        quote_number VARCHAR(100) NOT NULL UNIQUE,
        quote_date DATE NOT NULL,
        due_date DATE DEFAULT NULL,
        quotation_status ENUM (
            'draft',
            'sent',
            'accepted',
            'rejected',
            'expired'
        ) DEFAULT 'draft',
        payment_status ENUM ('pending', 'partial', 'paid') DEFAULT 'pending',
        created_by BIGINT UNSIGNED NOT NULL, -- FK → users(id)
        invoice_terms TEXT DEFAULT NULL,
        status ENUM ('active', 'cancelled') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_quotations_store_id (store_id),
        INDEX idx_quotations_customer_id (customer_id),
        CONSTRAINT fk_quotations_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_quotations_customer FOREIGN KEY (customer_id) REFERENCES customers (id) ON DELETE RESTRICT,
        CONSTRAINT fk_quotations_created_by FOREIGN KEY (created_by) REFERENCES users (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- QUOTATION ITEMS
CREATE TABLE
    quotation_items (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        quotation_id BIGINT UNSIGNED NOT NULL, -- FK → quotations(id)
        item_id BIGINT UNSIGNED NOT NULL, -- FK → items(id)
        quantity DECIMAL(15, 2) NOT NULL DEFAULT 1.00,
        price_per_unit DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_id BIGINT UNSIGNED DEFAULT NULL, -- FK → taxes(id)
        discount_type ENUM ('none', 'percent', 'fixed') DEFAULT 'none',
        discount_value DECIMAL(15, 2) DEFAULT 0.00,
        unit VARCHAR(50) DEFAULT NULL,
        batch_no VARCHAR(100) DEFAULT NULL,
        serial_numbers TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        INDEX idx_quotation_items_quotation_id (quotation_id),
        INDEX idx_quotation_items_item_id (item_id),
        INDEX idx_quotation_items_tax_id (tax_id),
        CONSTRAINT fk_quotation_items_quotation FOREIGN KEY (quotation_id) REFERENCES quotations (id) ON DELETE CASCADE,
        CONSTRAINT fk_quotation_items_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE RESTRICT,
        CONSTRAINT fk_quotation_items_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-- QUOTATION ITEM CHARGES (optional, like sales_item_charges)
CREATE TABLE
    quotation_item_charges (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        quotation_item_id BIGINT UNSIGNED NOT NULL, -- FK → quotation_items(id)
        charge_type ENUM ('other_charges', 'discount_to_all') NOT NULL,
        input_value DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        tax_id BIGINT UNSIGNED DEFAULT NULL, -- FK → taxes(id)
        calculated_amount DECIMAL(15, 2) NOT NULL DEFAULT 0.00,
        discount_type ENUM ('percent', 'fixed') DEFAULT 'fixed',
        INDEX idx_quotation_item_charges_item_id (quotation_item_id),
        CONSTRAINT fk_quotation_item_charges_item FOREIGN KEY (quotation_item_id) REFERENCES quotation_items (id) ON DELETE CASCADE,
        CONSTRAINT fk_quotation_item_charges_tax FOREIGN KEY (tax_id) REFERENCES taxes (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    stores (
        store_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        created_by BIGINT UNSIGNED NOT NULL, -- FK → users(user_id)
        store_code VARCHAR(100) NOT NULL UNIQUE,
        slug VARCHAR(150) UNIQUE,
        name VARCHAR(255) NOT NULL,
        website VARCHAR(255),
        email VARCHAR(255),
        mobile VARCHAR(20),
        phone VARCHAR(20),
        logo VARCHAR(255),
        country_id BIGINT UNSIGNED NOT NULL, -- FK → country_settings(country_id)
        state VARCHAR(50),
        city VARCHAR(50),
        address VARCHAR(255),
        postcode VARCHAR(20),
        gst_enabled TINYINT (1) DEFAULT 0,
        gst_no VARCHAR(50),
        vat_enabled TINYINT (1) DEFAULT 0,
        vat_no VARCHAR(50),
        pan_no VARCHAR(50),
        default_sales_discount DECIMAL(10, 2) DEFAULT 0.00,
        language_id BIGINT UNSIGNED,
        currency_id BIGINT UNSIGNED,
        currency_placement ENUM ('left', 'right', 'left_space', 'right_space') DEFAULT 'left',
        timezone_id INT UNSIGNED,
        date_format VARCHAR(20) DEFAULT 'Y-m-d',
        time_format VARCHAR(20) DEFAULT 'H:i',
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT fk_store_user FOREIGN KEY (created_by) REFERENCES users (user_id),
        CONSTRAINT fk_store_country FOREIGN KEY (country_id) REFERENCES country_settings (country_id),
        CONSTRAINT fk_store_language FOREIGN KEY (language_id) REFERENCES languages (language_id),
        CONSTRAINT fk_store_currency FOREIGN KEY (currency_id) REFERENCES currencies (currency_id),
        CONSTRAINT fk_store_timezone FOREIGN KEY (timezone_id) REFERENCES timezones (id),
        INDEX idx_store_status (status),
        INDEX idx_store_created_by (created_by)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--Multi-Store Users (Optional for users across multiple stores)
CREATE TABLE
    user_stores (
        user_id BIGINT UNSIGNED NOT NULL, -- FK → users(id)
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(store_id)
        PRIMARY KEY (user_id, store_id),
        CONSTRAINT fk_user_stores_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE,
        CONSTRAINT fk_user_stores_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    coupons (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL,
        coupon_code VARCHAR(100) NOT NULL,
        description TEXT DEFAULT NULL,
        discount_type ENUM ('fixed', 'percentage') NOT NULL,
        discount_value DECIMAL(12, 2) NOT NULL,
        min_order_amount DECIMAL(12, 2) DEFAULT 0.00,
        max_discount_amount DECIMAL(12, 2) DEFAULT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        usage_limit INT DEFAULT NULL,
        used_count INT DEFAULT 0,
        status ENUM ('active', 'inactive', 'expired') DEFAULT 'active',
        PRIMARY KEY (id),
        UNIQUE KEY uq_coupon_code (coupon_code, store_id),
        INDEX idx_coupons_store_id (store_id),
        CONSTRAINT fk_coupons_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE
    );

CREATE TABLE
    store_counters (
        counter_id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL,
        name VARCHAR(100) NOT NULL, -- Counter name e.g., "Counter 1"
        counter_code VARCHAR(50) UNIQUE, -- Optional short code
        assigned_user_id BIGINT UNSIGNED, -- FK → users(user_id)
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT fk_counter_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE,
        CONSTRAINT fk_counter_user FOREIGN KEY (assigned_user_id) REFERENCES users (user_id)
    );

CREATE TABLE
    counter_document_settings (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        counter_id BIGINT UNSIGNED NOT NULL, -- FK → store_counters(counter_id)
        doc_type ENUM ('invoice', 'pos', 'quotation') NOT NULL,
        printer_type ENUM ('thermal', 'dot_matrix', 'inkjet', 'a4') NOT NULL,
        page_size ENUM ('a4', 'a5', '3inch', '2inch') NOT NULL,
        show_mrp TINYINT (1) DEFAULT 0,
        show_paid_amount TINYINT (1) DEFAULT 0,
        show_return TINYINT (1) DEFAULT 0,
        number_to_word TINYINT (1) DEFAULT 0,
        show_previous_balance TINYINT (1) DEFAULT 0,
        invoice_notes TEXT,
        copy_customer_enabled TINYINT (1) DEFAULT 0,
        business_logo VARCHAR(255),
        template VARCHAR(100),
        signature_image VARCHAR(255),
        footer_terms_conditions TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        CONSTRAINT fk_doc_settings_counter FOREIGN KEY (counter_id) REFERENCES store_counters (counter_id) ON DELETE CASCADE,
        UNIQUE KEY uniq_counter_doc (counter_id, doc_type)
    );

CREATE TABLE
    counter_feature_flags (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        counter_id BIGINT UNSIGNED NOT NULL,
        feature_name VARCHAR(50) NOT NULL,
        enabled TINYINT (1) DEFAULT 0,
        CONSTRAINT fk_counter_flags FOREIGN KEY (counter_id) REFERENCES store_counters (counter_id) ON DELETE CASCADE,
        UNIQUE KEY uniq_counter_feature (counter_id, feature_name)
    );

-- Store Account Settings
CREATE TABLE
    store_account_settings (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(id)
        account_name VARCHAR(255) NOT NULL,
        bank_name VARCHAR(255) NOT NULL,
        account_number VARCHAR(50) NOT NULL,
        ifsc_code VARCHAR(20) NOT NULL,
        upi_id VARCHAR(100) DEFAULT NULL,
        balance DECIMAL(15, 2) DEFAULT 0.00,
        user_id BIGINT UNSIGNED DEFAULT NULL, -- FK → users(id)
        created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        INDEX idx_store_account_settings_store_id (store_id),
        INDEX idx_store_account_settings_user_id (user_id),
        CONSTRAINT fk_store_account_settings_store FOREIGN KEY (store_id) REFERENCES stores (id) ON DELETE CASCADE,
        CONSTRAINT fk_store_account_settings_user FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    billing_cycles (
        billing_cycle_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(50) NOT NULL, -- monthly, quarterly, yearly
        description VARCHAR(255) DEFAULT NULL,
        UNIQUE (name)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    packages (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(store_id)
        package_code VARCHAR(100) NOT NULL,
        package_name VARCHAR(255) NOT NULL,
        description TEXT DEFAULT NULL,
        price DECIMAL(12, 2) NOT NULL,
        if_multistore TINYINT (1) NOT NULL DEFAULT 0,
        store_limit INT DEFAULT NULL, -- NULL = unlimited
        user_limit INT DEFAULT NULL, -- NULL = unlimited
        is_recurring TINYINT (1) NOT NULL DEFAULT 1,
        billing_cycle_id INT UNSIGNED DEFAULT 1, -- FK → billing_cycles
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_package_code (store_id, package_code),
        INDEX idx_packages_store_id (store_id),
        CONSTRAINT fk_packages_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE,
        CONSTRAINT fk_packages_billing_cycle FOREIGN KEY (billing_cycle_id) REFERENCES billing_cycles (billing_cycle_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    subscription_purchase (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- for query convenience
        package_id BIGINT UNSIGNED NOT NULL, -- FK → packages(id)
        counter_id BIGINT UNSIGNED DEFAULT NULL, -- FK → store_counters(counter_id)
        created_by BIGINT UNSIGNED NOT NULL, -- FK → users(user_id)
        subscription_code VARCHAR(100) NOT NULL,
        start_date DATE NOT NULL,
        end_date DATE NOT NULL,
        amount DECIMAL(12, 2) NOT NULL,
        payment_type_id BIGINT UNSIGNED NOT NULL, -- FK → payment_types(id)
        status ENUM ('active', 'inactive', 'expired') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_subscription_code (store_id, subscription_code),
        INDEX idx_subscription_purchase_store_id (store_id),
        INDEX idx_subscription_purchase_package_id (package_id),
        INDEX idx_subscription_purchase_counter_id (counter_id),
        INDEX idx_subscription_purchase_created_by (created_by),
        INDEX idx_subscription_purchase_payment_type_id (payment_type_id),
        CONSTRAINT fk_subscription_purchase_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE,
        CONSTRAINT fk_subscription_purchase_package FOREIGN KEY (package_id) REFERENCES packages (id) ON DELETE RESTRICT,
        CONSTRAINT fk_subscription_purchase_counter FOREIGN KEY (counter_id) REFERENCES store_counters (counter_id) ON DELETE SET NULL,
        CONSTRAINT fk_subscription_purchase_created_by FOREIGN KEY (created_by) REFERENCES users (user_id) ON DELETE SET NULL,
        CONSTRAINT fk_subscription_purchase_payment_type FOREIGN KEY (payment_type_id) REFERENCES payment_types (id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    package_features (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        package_id BIGINT UNSIGNED NOT NULL,
        feature_code VARCHAR(50) NOT NULL, -- e.g., android_app, windows_app
        enabled TINYINT (1) NOT NULL DEFAULT 1,
        UNIQUE KEY uq_package_feature (package_id, feature_code),
        INDEX idx_package_features_package_id (package_id),
        CONSTRAINT fk_package_features_package FOREIGN KEY (package_id) REFERENCES packages (id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    package_addons (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL, -- FK → stores(store_id)
        addon_code VARCHAR(100) NOT NULL,
        name VARCHAR(255) NOT NULL,
        description TEXT DEFAULT NULL,
        price DECIMAL(12, 2) NOT NULL,
        is_recurring TINYINT (1) NOT NULL DEFAULT 0,
        billing_cycle_id INT UNSIGNED DEFAULT NULL, -- FK → billing_cycles
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_addon_code (store_id, addon_code),
        INDEX idx_package_addons_store_id (store_id),
        CONSTRAINT fk_package_addons_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE,
        CONSTRAINT fk_package_addons_billing_cycle FOREIGN KEY (billing_cycle_id) REFERENCES billing_cycles (billing_cycle_id)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

CREATE TABLE
    supplier (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        store_id BIGINT UNSIGNED NOT NULL,
        created_by BIGINT UNSIGNED DEFAULT NULL,
        country_id BIGINT UNSIGNED NOT NULL,
        state VARCHAR(50),
        city VARCHAR(50),
        supplier_code VARCHAR(50) NOT NULL,
        supplier_name VARCHAR(255) NOT NULL,
        mobile VARCHAR(20) DEFAULT NULL,
        phone VARCHAR(20) DEFAULT NULL,
        email VARCHAR(255) DEFAULT NULL,
        gstin VARCHAR(50) DEFAULT NULL,
        vatin VARCHAR(50) DEFAULT NULL,
        postcode VARCHAR(20) DEFAULT NULL,
        address TEXT DEFAULT NULL,
        status ENUM ('active', 'inactive') DEFAULT 'active',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_supplier_code (supplier_code, store_id),
        CONSTRAINT fk_supplier_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE,
        CONSTRAINT fk_supplier_created_by FOREIGN KEY (created_by) REFERENCES users (user_id) ON DELETE SET NULL,
        CONSTRAINT fk_supplier_country FOREIGN KEY (country_id) REFERENCES country_settings (country_id) ON DELETE RESTRICT
    );

CREATE TABLE
    supplier_balance (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        supplier_id BIGINT UNSIGNED NOT NULL,
        store_id BIGINT UNSIGNED NOT NULL,
        purchase_due DECIMAL(15, 2) DEFAULT 0.00,
        purchase_return_due DECIMAL(15, 2) DEFAULT 0.00,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE KEY uq_supplier_balance (supplier_id, store_id),
        CONSTRAINT fk_supplier_balance_supplier FOREIGN KEY (supplier_id) REFERENCES supplier (id) ON DELETE CASCADE,
        CONSTRAINT fk_supplier_balance_store FOREIGN KEY (store_id) REFERENCES stores (store_id) ON DELETE CASCADE
    );