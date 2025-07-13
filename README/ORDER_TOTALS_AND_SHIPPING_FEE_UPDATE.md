# Order Totals and Shipping Fee Update

## Problem
- Order total was displayed as 0 while waiting for admin verification because it relied on the payment relation, which does not exist before payment.
- Shipping fee logic for "ship to address" was not implemented.

## Solution
This update implements:
- Calculation and storage of subtotal, tax, shipping fee, and total for every order.
- Shipping fee logic: 50,000 per electric car, 25,000 per motorcycle/scooter, only for delivery orders.
- Display of all payment breakdowns in admin/user/checkout views, regardless of payment status.

## Step-by-Step Changes

### 1. Database Migration
- Added new fields to `orders` table: `shipping_fee`, `subtotal`, `tax_amount`, `total_amount`.
- Created a migration to add these fields to existing tables.

### 2. Order Model
- Added logic to calculate shipping fee based on vehicle type and delivery method.
- Added methods to calculate and update subtotal, tax, shipping, and total.
- Updated accessors to always provide correct values.

### 3. Checkout Flow
- When creating an order, after items are created, totals are calculated and stored.
- When processing payment, totals are recalculated and used for payment and display.
- Shipping fee is included in the payment breakdown and sent to Midtrans.

### 4. Admin Panel (Filament)
- Order list and detail pages now show the correct total, subtotal, tax, and shipping fee.
- Pending verification widget shows the correct total.

### 5. User Views
- User order detail and checkout/confirmation pages show a full breakdown: subtotal, tax, shipping, total.

### 6. Invoice PDF
- Invoice now displays subtotal, tax, shipping, and total.

### 7. Command for Existing Orders
- Added `orders:update-totals` artisan command to update all existing orders with the new fields.

## How to Apply
1. Run migrations:
   ```
   php artisan migrate
   ```
2. Update all existing orders:
   ```
   php artisan orders:update-totals
   ```

## Shipping Fee Logic
- Applies only if `is_delivered` is true.
- 50,000 per electric car (category name contains both 'mobil' and 'listrik').
- 25,000 per motorcycle or scooter (category name contains 'motor' or 'skuter').
- 25,000 per vehicle for all other types.

---
This update ensures all order details are visible and correct at every stage, and that shipping fees are handled as required. 