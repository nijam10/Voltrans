# Voltrans Review & Rating System

## Overview
This system allows users to leave a star rating (1-5) and comment for each completed product order item. Reviews are linked to both the product and the specific order item, ensuring each user can only review an item they have completed.

## System Flow
1. **Order Completion**: When an order item is marked as 'selesai' (completed), a 'Leave a Review' button appears on the order items page.
2. **Leave a Review**: Clicking the button opens a modal where the user can select a star rating and write a comment.
3. **Submit Review**: The review is submitted and saved, linked to the order item, product, and user.
4. **Review Display**:
   - On the order items page, the button is replaced with a 'Reviewed' label after submission.
   - On the product detail page, all reviews for the product are displayed, showing the average rating and all user comments.

## Database Changes
- `reviews` table now includes `order_item_id` (nullable, foreign key).
- Each review is linked to a product, order item, and customer.

## Developer Notes
- **Models**: `OrderItem` hasOne `Review`, `Review` belongsTo `OrderItem`.
- **Controllers**: `ReviewController@store` handles review submission and validation.
- **Views**:
  - `profile/order-items/index.blade.php`: Shows the review button and modal.
  - `pages/product_detail.blade.php`: Displays reviews dynamically from the database.
- **Routes**: POST `/review/store` for submitting reviews.

## Usage
- Users can only review completed order items that have not yet been reviewed.
- Reviews are visible to all users on the product detail page.

## Customization
- You can adjust the modal, validation, and review display as needed for your UI/UX.

---
For further details, see the code comments and controller logic.
