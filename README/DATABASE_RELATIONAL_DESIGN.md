# Database Relational Design - Voltrans Application

## Overview
This document outlines the relational database design for the Voltrans application, focusing on the core business process tables and their relationships.

## Core Tables

### 1. Users Table
**Table Name:** `users`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique user identifier |
| name | varchar(255) | NOT NULL | User's full name |
| email | varchar(255) | UNIQUE, NOT NULL | User's email address |
| password | varchar(255) | NULLABLE | Hashed password (nullable for social login) |
| email_verified_at | timestamp | NULLABLE | Email verification timestamp |
| profile_photo_path | varchar(2048) | NULLABLE | Profile photo file path |
| role | enum | DEFAULT 'customer' | User role: 'admin' or 'customer' |
| remember_token | varchar(100) | NULLABLE | Remember me token |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Relationships:**
- One-to-Many with `orders` (as customer)
- One-to-Many with `reviews` (as customer)

### 2. Categories Table
**Table Name:** `categories`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique category identifier |
| name | varchar(255) | UNIQUE, NOT NULL | Category name |
| slug | varchar(255) | UNIQUE, NOT NULL | URL-friendly category name |
| image | varchar(255) | NOT NULL | Category image file path |
| deleted_at | timestamp | NULLABLE | Soft delete timestamp |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Relationships:**
- One-to-Many with `products`

### 3. Products Table
**Table Name:** `products`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique product identifier |
| name | varchar(255) | UNIQUE, NOT NULL | Product name |
| slug | varchar(255) | UNIQUE, NOT NULL | URL-friendly product name |
| category_id | bigint | FOREIGN KEY, NOT NULL | Reference to categories table |
| thumbnail | varchar(255) | NOT NULL | Product thumbnail image |
| description | longtext | NOT NULL | Product description |
| price | bigint | UNSIGNED, NOT NULL | Product price in smallest currency unit |
| status | enum | DEFAULT 'ready' | Product status: 'ready', 'rent', 'maintenance' |
| specs | json | NULLABLE | Product specifications as JSON |
| deleted_at | timestamp | NULLABLE | Soft delete timestamp |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Foreign Keys:**
- `category_id` → `categories.id` (CASCADE DELETE)

**Relationships:**
- Many-to-One with `categories`
- One-to-Many with `product_images`
- One-to-Many with `order_items`
- One-to-Many with `reviews`

### 4. Product Images Table
**Table Name:** `product_images`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique image identifier |
| image | varchar(255) | NOT NULL | Image file path |
| product_id | bigint | FOREIGN KEY, NOT NULL | Reference to products table |
| deleted_at | timestamp | NULLABLE | Soft delete timestamp |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Foreign Keys:**
- `product_id` → `products.id` (CASCADE DELETE)

**Relationships:**
- Many-to-One with `products`

### 5. Orders Table
**Table Name:** `orders`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique order identifier |
| order_code | varchar(255) | UNIQUE, NOT NULL | Human-readable order code |
| customer_id | bigint | FOREIGN KEY, NOT NULL | Reference to users table |
| phone_number | varchar(255) | NOT NULL | Customer phone number |
| delivery_fee | int | UNSIGNED, NULLABLE | Delivery fee amount |
| is_delivered | boolean | DEFAULT true | Whether delivery is required |
| pickup_location | varchar(255) | NULLABLE | Pickup location address |
| delivery_location | varchar(255) | NULLABLE | Delivery location address |
| cancellation_reason | text | NULLABLE | Reason for order cancellation |
| cancelled_at | timestamp | NULLABLE | Order cancellation timestamp |
| status | enum | NOT NULL | Order status: 'menunggu_verifikasi', 'diverifikasi', 'dalam_proses', 'selesai', 'dibatalkan' |
| deleted_at | timestamp | NULLABLE | Soft delete timestamp |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Foreign Keys:**
- `customer_id` → `users.id` (CASCADE DELETE)

**Relationships:**
- Many-to-One with `users` (as customer)
- One-to-Many with `order_items`

### 6. Order Items Table
**Table Name:** `order_items`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique order item identifier |
| order_id | bigint | FOREIGN KEY, NOT NULL | Reference to orders table |
| product_id | bigint | FOREIGN KEY, NOT NULL | Reference to products table |
| price | bigint | UNSIGNED, NOT NULL | Product price at time of order |
| subtotal | bigint | UNSIGNED, NOT NULL | Total amount for this item |
| started_at | date | NOT NULL | Rental start date |
| ended_at | date | NOT NULL | Rental end date |
| status | enum | NOT NULL | Item status: 'dalam_proses', 'selesai', 'dibatalkan' |
| cancellation_reason | text | NULLABLE | Reason for item cancellation |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Foreign Keys:**
- `order_id` → `orders.id` (CASCADE DELETE)
- `product_id` → `products.id` (CASCADE DELETE)

**Relationships:**
- Many-to-One with `orders`
- Many-to-One with `products`
- One-to-Many with `reviews`

### 7. Reviews Table
**Table Name:** `reviews`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique review identifier |
| customer_id | bigint | FOREIGN KEY, NOT NULL | Reference to users table |
| product_id | bigint | FOREIGN KEY, NOT NULL | Reference to products table |
| order_item_id | bigint | FOREIGN KEY, NULLABLE | Reference to order_items table |
| rating | int | UNSIGNED, DEFAULT 5 | Rating value (1-5) |
| comment | text | NULLABLE | Review comment text |
| deleted_at | timestamp | NULLABLE | Soft delete timestamp |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Foreign Keys:**
- `customer_id` → `users.id` (CASCADE DELETE)
- `product_id` → `products.id` (CASCADE DELETE)
- `order_item_id` → `order_items.id` (CASCADE DELETE)

**Relationships:**
- Many-to-One with `users` (as customer)
- Many-to-One with `products`
- Many-to-One with `order_items`

### 8. Payments Table
**Table Name:** `payments`
**Primary Key:** `id` (BigInteger, Auto Increment)

| Column | Type | Constraints | Description |
|--------|------|-------------|-------------|
| id | bigint | PRIMARY KEY, AUTO_INCREMENT | Unique payment identifier |
| order_code | varchar(255) | NOT NULL | Reference to order_code in orders table |
| snap_token | varchar(255) | NULLABLE | Midtrans snap token |
| payment_type | varchar(255) | NULLABLE | Payment method type |
| va_number | varchar(255) | NULLABLE | Virtual account number |
| bank | varchar(255) | NULLABLE | Bank name |
| gross_amount | decimal(10,2) | NULLABLE | Total payment amount |
| payment_status | enum | DEFAULT 'pending' | Payment status: 'pending', 'paid', 'failed', 'expired' |
| paid_at | timestamp | NULLABLE | Payment completion timestamp |
| deleted_at | timestamp | NULLABLE | Soft delete timestamp |
| created_at | timestamp | NULLABLE | Record creation timestamp |
| updated_at | timestamp | NULLABLE | Record update timestamp |

**Relationships:**
- Many-to-One with `orders` (via order_code)

## Entity Relationship Diagram (ERD)

```
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   users     │     │ categories  │     │  products   │
├─────────────┤     ├─────────────┤     ├─────────────┤
│ id (PK)     │     │ id (PK)     │     │ id (PK)     │
│ name        │     │ name        │     │ name        │
│ email       │     │ slug        │     │ slug        │
│ password    │     │ image       │     │ category_id │
│ role        │     │ deleted_at  │     │ thumbnail   │
│ created_at  │     │ created_at  │     │ description │
│ updated_at  │     │ updated_at  │     │ price       │
└─────────────┘     └─────────────┘     │ status      │
         │                   │          │ specs       │
         │                   │          │ deleted_at  │
         │                   │          │ created_at  │
         │                   │          │ updated_at  │
         │                   │          └─────────────┘
         │                   │                   │
         │                   │                   │
         │                   │          ┌─────────────┐
         │                   │          │product_images│
         │                   │          ├─────────────┤
         │                   │          │ id (PK)     │
         │                   │          │ image       │
         │                   │          │ product_id  │
         │                   │          │ deleted_at  │
         │                   │          │ created_at  │
         │                   │          │ updated_at  │
         │                   │          └─────────────┘
         │                   │
         │                   │
┌─────────────┐     ┌─────────────┐     ┌─────────────┐
│   orders    │     │order_items  │     │   reviews   │
├─────────────┤     ├─────────────┤     ├─────────────┤
│ id (PK)     │     │ id (PK)     │     │ id (PK)     │
│ order_code  │     │ order_id    │     │ customer_id │
│ customer_id │     │ product_id  │     │ product_id  │
│ phone_number│     │ price       │     │ order_item_id│
│ delivery_fee│     │ subtotal    │     │ rating      │
│ is_delivered│     │ started_at  │     │ comment     │
│ pickup_loc  │     │ ended_at    │     │ deleted_at  │
│ delivery_loc│     │ status      │     │ created_at  │
│ cancel_reason│    │ cancel_reason│    │ updated_at  │
│ cancelled_at│     │ created_at  │     └─────────────┘
│ status      │     │ updated_at  │
│ deleted_at  │     └─────────────┘
│ created_at  │
│ updated_at  │
└─────────────┘
         │
         │
┌─────────────┐
│  payments   │
├─────────────┤
│ id (PK)     │
│ order_code  │
│ snap_token  │
│ payment_type│
│ va_number   │
│ bank        │
│ gross_amount│
│ payment_status│
│ paid_at     │
│ deleted_at  │
│ created_at  │
│ updated_at  │
└─────────────┘
```

## Key Relationships Summary

1. **Users → Orders**: One-to-Many (A user can have multiple orders)
2. **Categories → Products**: One-to-Many (A category can have multiple products)
3. **Products → Product Images**: One-to-Many (A product can have multiple images)
4. **Products → Order Items**: One-to-Many (A product can be in multiple order items)
5. **Products → Reviews**: One-to-Many (A product can have multiple reviews)
6. **Orders → Order Items**: One-to-Many (An order can have multiple items)
7. **Order Items → Reviews**: One-to-Many (An order item can have multiple reviews)
8. **Users → Reviews**: One-to-Many (A user can write multiple reviews)
9. **Orders ↔ Payments**: One-to-One (via order_code)

## Business Logic Notes

- **Soft Deletes**: Categories, Products, Product Images, Orders, Reviews, and Payments use soft deletes
- **Cascade Deletes**: When a parent record is deleted, related child records are automatically deleted
- **Status Enums**: Products, Orders, Order Items, and Payments have status enums for workflow management
- **Price Storage**: All prices are stored as integers (smallest currency unit) for precision
- **Order Code**: Used as a human-readable identifier and links orders to payments
- **Rental Period**: Order items track rental start and end dates
- **Review System**: Reviews can be linked to both products and specific order items

## Indexes and Performance

- Primary keys are auto-incrementing bigint
- Foreign keys are indexed for performance
- Unique constraints on email, order_code, product names, and category names
- Soft delete columns are indexed for efficient filtering 