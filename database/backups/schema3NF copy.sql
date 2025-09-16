

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
        CONSTRAINT fk_item_serial_item FOREIGN KEY (item_id) REFERENCES items (id) ON DELETE CASCADE
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
