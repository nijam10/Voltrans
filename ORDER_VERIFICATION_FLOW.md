# Order Verification Flow

## Overview
The order verification system has been updated to require admin verification before customers can proceed to payment. This ensures better control over order processing and reduces potential issues.

## Flow Diagram

```
Customer Fills Checkout Form
           ↓
    Order Created (status: menunggu_verifikasi)
           ↓
   Customer Redirected to Orders Page
           ↓
    Admin Reviews Order in Dashboard
           ↓
    Admin Verifies Order (status: dalam_proses)
           ↓
   Customer Receives Notification + Page Auto-refresh
           ↓
    Customer Can Click "Pay" Button
           ↓
    Payment Processing
           ↓
    Customer Redirected to Confirmation Page
           ↓
    Order Completed (status: selesai)
```

## Detailed Process

### 1. Order Creation
- Customer fills out checkout form with delivery information
- Order is immediately created with status `menunggu_verifikasi`
- Customer is redirected to their orders page with success message
- Cart is cleared automatically

### 2. Admin Verification
- Admin receives notification about new pending order
- Admin can view order details in Filament dashboard
- Admin can either:
  - **Verify**: Change status to `dalam_proses`
  - **Reject**: Change status to `dibatalkan` with reason

### 3. Customer Experience
- Customer sees all their orders on the orders page
- Pending orders are highlighted with orange background
- Page automatically refreshes every 15 seconds for pending orders
- Customer receives notification when order is verified
- "Pay" button appears for verified orders

### 4. Payment Processing
- Customer clicks "Pay" button for verified orders
- Midtrans payment gateway is initialized
- After successful payment, customer is redirected to confirmation page

## Status Definitions

- `menunggu_verifikasi`: Order created, waiting for admin verification
- `dalam_proses`: Order verified, customer can proceed to payment
- `selesai`: Order completed and paid
- `dibatalkan`: Order rejected by admin

## User Experience Features

### For Customers
- **Orders Page**: Centralized view of all orders with status indicators
- **Success Messages**: Clear feedback when orders are created
- **Auto-refresh**: Page automatically updates when orders are verified
- **Manual Refresh**: Refresh button for immediate status check
- **Status-specific UI**: Different visual indicators for each status
- **Notification system**: Real-time updates for status changes

### For Admins
- Dashboard widget showing pending verifications
- Bulk verification actions
- Detailed order information
- Rejection with reason tracking

## Technical Implementation

### Key Files Modified
- `app/Http/Controllers/CheckoutController.php`: Updated redirect flow
- `app/Observers/OrderObserver.php`: Notification system
- `resources/views/profile/orders/index.blade.php`: Enhanced orders page
- `resources/views/pages/checkout/confirmation.blade.php`: Updated for completed orders
- `routes/web.php`: Updated routes

### API Endpoints
- `GET /api/checkout/order-status/{orderCode}`: Check order status
- `POST /checkout/payment`: Create new order
- `GET /checkout/payment?order_code={code}`: Payment for verified order

## Benefits

1. **Better User Experience**: Users see all their orders in one place
2. **Smoother Flow**: No confusing redirects between pages
3. **Real-time Updates**: Auto-refresh keeps users informed
4. **Clear Status Communication**: Visual indicators for each status
5. **Centralized Management**: All order information in one location

## Testing

To test the flow:

1. Create a new order through checkout
2. Verify redirect to orders page with success message
3. Check order appears with pending verification status
4. Admin verifies the order
5. Check page auto-refreshes and shows verified status
6. Verify payment button appears
7. Complete payment process
8. Verify redirect to confirmation page 