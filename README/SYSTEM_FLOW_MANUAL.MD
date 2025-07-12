# Voltrans Rental Application Manual

---

## Table of Contents
1. Registering an Account (Customer)
2. Managing Addresses
3. Placing an Order (Customer)
4. Order Verification & Payment (Customer & Admin)
5. Tracking Order Items (Customer)
6. Leaving Reviews (Customer)
7. Admin Features & Order Management
8. Appendix: Statuses & Reference

---

## 1. Registering an Account (Customer)
1. Open the application and click **Register**.
2. Fill in your personal details (name, email, password, etc.).
3. Submit the form.
4. (Optional) Verify your email if prompted.
5. Log in to your account.

*Add screenshot: Registration form*

---

## 2. Managing Addresses
1. Go to your profile and select **Addresses**.
2. Click **Tambah** (Add) to add a new address.
3. Fill in the address form.
   - The **first address** requires KTP upload for verification.
   - Only one address can be verified at a time.
   - You can add up to 3 addresses in total.
4. Upload KTP if required and submit.
5. Wait for admin verification (status will show as pending).
6. If you reach 3 addresses, delete one to add another.

*Add screenshot: Address form, KTP upload, address list*

---

## 3. Placing an Order (Customer)
1. Browse available vehicles/products.
2. Add desired items to your cart.
3. Go to **Cart** and review your selections.
4. Click **Checkout**.
5. Fill in delivery and rental details.
6. Submit the order.
7. Your order will be created with status **"menunggu_verifikasi"** (waiting for admin verification).

*Add screenshot: Product list, cart, checkout form*

---

## 4. Order Verification & Payment

### For Customers
1. After placing an order, you are redirected to the **Orders** page.
2. Orders awaiting verification are highlighted.
3. The page auto-refreshes every 15 seconds for updates.
4. Once the admin verifies your order, you receive a notification and a **Pay** button appears.
5. Click **Pay** to proceed with payment via the Midtrans gateway.
6. After successful payment, you are redirected to a confirmation page.

*Add screenshot: Orders page, payment button, payment gateway*

### For Admins
1. Log in to the Filament admin dashboard.
2. Review new orders with status **"menunggu_verifikasi"**.
3. Verify order details and vehicle availability.
4. Approve (status changes to **"dalam_proses"**) or reject (status changes to **"dibatalkan"** with a reason).
5. Verified orders allow customers to proceed with payment.

*Add screenshot: Admin dashboard, order verification*

---

## 5. Tracking Order Items (Customer)
1. Go to **Order Items** in your profile.
2. View all items with status indicators:
   - **Dalam Proses** (In Process): Yellow, item is being prepared or rented.
   - **Selesai** (Completed): Green, rental period ended and vehicle returned.
   - **Dibatalkan** (Cancelled): Red, rental cancelled.
3. Click on an item for detailed status, rental info, and timeline.
4. Use filters and search to find specific items.

*Add screenshot: Order items list, item detail*

---

## 6. Leaving Reviews (Customer)
1. After an order item is marked as **"selesai"**, a **Leave a Review** button appears.
2. Click to open the review modal.
3. Select a star rating (1-5) and write a comment.
4. Submit your review.
5. Once submitted, the button is replaced with a **Reviewed** label.
6. Reviews are visible on the product detail page for all users.

*Add screenshot: Review modal, product reviews*

---

## 7. Admin Features & Order Management
1. Access the admin dashboard for:
   - Order verification and management.
   - Address verification (review KTP uploads, approve/reject addresses).
   - Viewing and managing all order items.
   - Bulk actions for order and address management.
   - Status history and reporting.
2. For address verification:
   - Go to **Addresses** in the admin panel.
   - Review KTP uploads and approve/reject as needed.

*Add screenshot: Admin address verification, order management*

---

## 8. Appendix: Statuses & Reference

### Address Statuses
- **Verified**: KTP uploaded and approved by admin.
- **Unverified**: No KTP or pending admin approval.
- **Rejected**: KTP or address rejected (with reason).

### Order Statuses
- **menunggu_verifikasi**: Waiting for admin verification.
- **dalam_proses**: Verified, awaiting payment or in rental period.
- **selesai**: Completed and paid.
- **dibatalkan**: Cancelled by admin.

### Order Item Statuses
- **Dalam Proses**: Being prepared or rented.
- **Selesai**: Rental completed.
- **Dibatalkan**: Cancelled.

---

## Notes
- For each step, insert relevant screenshots to visually guide users.
- This manual is designed to fit within 15 pages when exported to PDF with screenshots.
- For technical details, refer to the additional guides in the `README/` directory.

---

*End of Manual*