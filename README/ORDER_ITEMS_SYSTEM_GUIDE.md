# Order Items System Guide

## Overview

The Order Items System is a comprehensive solution for tracking individual items within orders in the Voltrans car rental platform. This system allows users to monitor the status of each vehicle/item separately, providing granular control and visibility over the rental process.

## System Architecture

### Database Structure

#### Order Items Table
```sql
order_items:
- id (Primary Key)
- order_id (Foreign Key to orders table)
- product_id (Foreign Key to products table)
- price (Daily rental price)
- subtotal (Total price for the rental period)
- started_at (Rental start date)
- ended_at (Rental end date)
- status (Enum: dalam_proses, selesai, dibatalkan)
- created_at, updated_at (Timestamps)
```

### Key Components

1. **OrderItem Model** (`app/Models/OrderItem.php`)
2. **OrderItemController** (`app/Http/Controllers/OrderItemController.php`)
3. **Order Items Views** (`resources/views/profile/order-items/`)
4. **Routes** (`routes/web.php`)

## Order Item Statuses

### 1. Dalam Proses (In Process)
- **Description**: Item is being prepared or currently in use
- **Color**: Yellow
- **Icon**: Clock
- **Conditions**:
  - Item is within rental period (started_at <= now <= ended_at)
  - Order payment has been completed
  - Vehicle is being prepared or actively rented

### 2. Selesai (Completed)
- **Description**: Rental period has ended and vehicle has been returned
- **Color**: Green
- **Icon**: Check Circle
- **Conditions**:
  - Rental period has ended (ended_at < now)
  - Vehicle has been returned and inspected
  - All obligations have been fulfilled

### 3. Dibatalkan (Cancelled)
- **Description**: Rental has been cancelled
- **Color**: Red
- **Icon**: X Circle
- **Conditions**:
  - Order or item has been cancelled
  - Cancellation reason is recorded

## User Interface Features

### Order Items Index Page (`/user/order-items`)

#### Features:
- **List View**: Display all order items with status indicators
- **Filtering**: Filter by status and date range
- **Search**: Search by product name or order code
- **Pagination**: Handle large numbers of items
- **Status Indicators**: Visual status badges with icons
- **Quick Actions**: View details, view order, re-rent

#### Status-Specific Information:
- **Dalam Proses**: Shows remaining days or preparation status
- **Selesai**: Shows completion date and return information
- **Dibatalkan**: Shows cancellation reason and date

### Order Item Detail Page (`/user/order-items/{id}`)

#### Features:
- **Timeline View**: Complete history of the item's status changes
- **Product Details**: Full product information with images
- **Rental Information**: Dates, duration, pricing
- **Status Updates**: Real-time status tracking
- **Action Buttons**: Navigation and re-rental options

## Workflow Process

### 1. Order Creation
```
User selects products → Cart → Checkout → Order created
↓
Order items are created with initial status
```

### 2. Order Verification
```
Admin reviews order → Verifies availability → Updates order status
↓
Order items remain in preparation state
```

### 3. Payment Processing
```
User completes payment → Order status changes to "dalam_proses"
↓
Order items status updated to "dalam_proses"
```

### 4. Rental Period
```
Rental start date arrives → Item becomes "active"
↓
User can track remaining days and usage status
```

### 5. Return Process
```
Rental end date arrives → Item marked as "selesai"
↓
Vehicle returned and inspected
```

### 6. Cancellation (if applicable)
```
Order/item cancelled → Status changes to "dibatalkan"
↓
Cancellation reason recorded
```

## API Endpoints

### User Endpoints
- `GET /user/order-items` - List all order items
- `GET /user/order-items/{id}` - View specific order item
- `GET /user/orders/{order}/items` - Get items for specific order
- `GET /user/order-items/{id}/status` - Get status updates

### Admin Endpoints (Future)
- `PUT /admin/order-items/{id}/status` - Update item status
- `POST /admin/order-items/{id}/notes` - Add admin notes
- `GET /admin/order-items` - Admin view of all items

## Status Tracking Logic

### Automatic Status Updates

#### 1. Rental Period Detection
```php
public function isCurrentlyActive(): bool
{
    $now = now();
    return $this->started_at <= $now && 
           $this->ended_at >= $now && 
           $this->status === 'dalam_proses';
}
```

#### 2. Remaining Days Calculation
```php
public function getRemainingDaysAttribute(): ?int
{
    if (!$this->isCurrentlyActive()) {
        return null;
    }
    return now()->diffInDays($this->ended_at, false);
}
```

#### 3. Rental Duration
```php
public function getRentalDurationAttribute(): int
{
    return $this->started_at->diffInDays($this->ended_at) + 1;
}
```

## Integration with Existing System

### Order Management
- Order items are automatically created when orders are placed
- Order status changes trigger item status updates
- Order cancellation affects all associated items

### User Experience
- Users can view individual item statuses
- Real-time updates for active rentals
- Detailed timeline for each item
- Easy navigation between items and orders

### Admin Management
- Admins can update individual item statuses
- Bulk operations for multiple items
- Status history tracking
- Reporting and analytics

## Future Enhancements

### 1. Advanced Status Tracking
- **Pickup Status**: Vehicle picked up by customer
- **In Use**: Vehicle currently being used
- **Return Pending**: Vehicle due for return
- **Returned**: Vehicle returned and inspected

### 2. Notifications
- Email/SMS notifications for status changes
- Reminder notifications for upcoming returns
- Admin alerts for overdue rentals

### 3. Analytics Dashboard
- Rental utilization rates
- Popular rental periods
- Revenue per item
- Customer behavior analysis

## Security Considerations

### Access Control
- Users can only view their own order items
- Admin authentication required for status updates
- API rate limiting for status checks

### Data Integrity
- Status changes are logged with timestamps
- Rollback capabilities for erroneous updates
- Audit trail for all modifications

## Performance Optimization

### Database Indexing
```sql
-- Recommended indexes
CREATE INDEX idx_order_items_user_id ON order_items (order_id);
CREATE INDEX idx_order_items_status ON order_items (status);
CREATE INDEX idx_order_items_dates ON order_items (started_at, ended_at);
```

### Caching Strategy
- Cache frequently accessed order items
- Cache status calculations
- Implement Redis for real-time updates

## Testing Strategy

### Unit Tests
- OrderItem model methods
- Status calculation logic
- Date handling functions

### Integration Tests
- API endpoint functionality
- Database operations
- User permission checks

### Feature Tests
- Complete user workflows
- Status update scenarios
- Error handling

## Deployment Considerations

### Database Migrations
- Ensure order_items table exists
- Add necessary indexes
- Migrate existing order data if needed

### Configuration
- Update route files
- Configure permissions
- Set up monitoring

### Monitoring
- Track API response times
- Monitor database performance
- Alert on status update failures

## Support and Maintenance

### Common Issues
1. **Status not updating**: Check order payment status
2. **Date calculations**: Verify timezone settings
3. **Permission errors**: Check user authentication

### Maintenance Tasks
- Regular database cleanup
- Performance monitoring
- Security updates
- Feature enhancements

## Conclusion

The Order Items System provides a robust foundation for granular rental tracking, enabling both users and administrators to monitor individual vehicle statuses throughout the rental lifecycle. This system enhances transparency, improves customer experience, and provides better operational control for the rental business.

For technical support or feature requests, please refer to the development team or create an issue in the project repository. 