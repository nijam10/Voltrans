# Admin Order Items System Guide

## Overview

The Admin Order Items System provides comprehensive management capabilities for tracking and managing individual items within orders in the Voltrans car rental platform. This system allows administrators to monitor, update, and manage the status of each vehicle/item separately, providing granular control over the rental process.

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
- cancellation_reason (Text, nullable)
- created_at, updated_at (Timestamps)
```

### Key Components

1. **OrderItemResource** (`app/Filament/Resources/OrderItemResource.php`)
2. **ItemsRelationManager** (`app/Filament/Resources/OrderResource/RelationManagers/ItemsRelationManager.php`)
3. **OrderItem Model** (`app/Models/OrderItem.php`)
4. **Admin Pages** (`app/Filament/Resources/OrderItemResource/Pages/`)

## Admin Interface Features

### 1. OrderItemResource (Standalone Management)

#### Navigation
- **Location**: Admin Panel → Operasional → Item Pesanan
- **Navigation Badge**: Shows count of items with "dalam_proses" status
- **Navigation Group**: Operasional (same as Orders)

#### Table Features
- **Columns**:
  - Order Code (clickable link to order)
  - Customer Name
  - Product Image & Name
  - Rental Period (start - end dates)
  - Duration (in days)
  - Status (color-coded badges)
  - Subtotal (formatted as currency)
  - Created Date

- **Filters**:
  - Status Filter (Dalam Proses, Selesai, Dibatalkan)
  - Active Rentals (currently being used)
  - Upcoming Rentals (scheduled for future)
  - Overdue Rentals (past end date but still active)
  - Order Filter (by order code)

- **Actions**:
  - View Details
  - Edit Item
  - Mark as Completed
  - Mark as Cancelled (with reason)
  - Bulk Actions (Complete/Cancel multiple items)

#### Form Features
- **Information Section**:
  - Order Selection (disabled on edit)
  - Product Selection (disabled on edit)
  - Price per Day (disabled on edit)
  - Subtotal (disabled on edit)

- **Rental Schedule**:
  - Start Date (disabled on edit)
  - End Date (disabled on edit)

- **Status Management**:
  - Status Selection (Dalam Proses, Selesai, Dibatalkan)
  - Cancellation Reason (required when status is "dibatalkan")

### 2. ItemsRelationManager (Within Order View)

#### Integration
- **Location**: Order Detail Page → Items Tab
- **Purpose**: Manage items within the context of their parent order

#### Features
- **Same functionality** as standalone OrderItemResource
- **Context-aware**: Automatically associates items with the current order
- **Real-time updates**: Changes reflect immediately in the order view

## Workflow Process

### 1. Order Creation & Item Management
```
Admin creates order → Items are automatically created
↓
Admin can view/edit items in Order Detail page
↓
Admin can manage individual item statuses
```

### 2. Item Status Management
```
Item Status: Dalam Proses
↓
Admin Actions:
- Mark as Completed (when vehicle returned)
- Mark as Cancelled (with reason)
↓
Status Updates:
- Completed: Item marked as "selesai"
- Cancelled: Item marked as "dibatalkan" with reason
```

### 3. Bulk Operations
```
Admin selects multiple items
↓
Bulk Actions:
- Mark all as completed
- Mark all as cancelled (with shared reason)
- Delete items
↓
Batch processing with notifications
```

## Status Management Logic

### Status Transitions
1. **Dalam Proses** → **Selesai**
   - Trigger: Vehicle returned and inspected
   - Action: Admin marks as completed

2. **Dalam Proses** → **Dibatalkan**
   - Trigger: Cancellation required
   - Action: Admin marks as cancelled with reason

### Status Validation
- Only "dalam_proses" items can be marked as completed or cancelled
- Cancellation requires a reason
- Completed items cannot be changed back

## Admin Actions & Permissions

### Individual Item Actions
- **View**: View detailed item information
- **Edit**: Modify item details (limited fields)
- **Mark Complete**: Change status to "selesai"
- **Mark Cancelled**: Change status to "dibatalkan" with reason
- **Delete**: Remove item from order

### Bulk Actions
- **Bulk Complete**: Mark multiple items as completed
- **Bulk Cancel**: Mark multiple items as cancelled with shared reason
- **Bulk Delete**: Remove multiple items

### Form Validation
- **Required Fields**: All basic information fields
- **Conditional Fields**: Cancellation reason required when status is "dibatalkan"
- **Disabled Fields**: Order, product, pricing, and dates cannot be changed after creation

## Integration with Order System

### Order-Item Relationship
- Items are always associated with an order
- Order status affects item visibility and management
- Item status changes can trigger order status updates

### Navigation Integration
- Order list shows item count
- Order detail page includes items tab
- Item list links back to parent order

## Notifications & Feedback

### Success Notifications
- Item status updated successfully
- Bulk operations completed
- Item created/edited/deleted

### Confirmation Modals
- Status change confirmations
- Bulk action confirmations
- Deletion confirmations

### Error Handling
- Validation errors for required fields
- Permission errors for restricted actions
- Database constraint violations

## Advanced Features

### Filtering & Search
- **Status-based filtering**: Quick access to items by status
- **Date-based filtering**: Find active, upcoming, or overdue rentals
- **Order-based filtering**: View items for specific orders
- **Search functionality**: Find items by product name or order code

### Sorting & Organization
- **Default sort**: By creation date (newest first)
- **Sortable columns**: All major columns support sorting
- **Grouping**: Items grouped by order in relation manager

### Data Export & Reporting
- **Table data**: All item information visible in admin interface
- **Status tracking**: Real-time status updates
- **Historical data**: Complete audit trail of status changes

## Security & Access Control

### Admin Permissions
- Full CRUD operations on order items
- Status management capabilities
- Bulk operation permissions
- Access to all order and customer data

### Data Protection
- Form validation prevents invalid data
- Confirmation modals prevent accidental actions
- Audit trail of all changes
- Soft deletes for data recovery

## Performance Optimization

### Database Queries
- Eager loading of relationships (order, customer, product)
- Indexed foreign keys for fast lookups
- Optimized filters for large datasets

### UI Performance
- Pagination for large item lists
- Lazy loading of images
- Efficient table rendering

## Monitoring & Analytics

### Dashboard Metrics
- Total items count
- Items by status
- Active rentals count
- Overdue rentals count

### Status Tracking
- Real-time status updates
- Status change history
- Performance metrics

## Future Enhancements

### 1. Advanced Status Tracking
- **Pickup Status**: Vehicle picked up by customer
- **In Use**: Vehicle currently being used
- **Return Pending**: Vehicle due for return
- **Returned**: Vehicle returned and inspected

### 2. Automated Notifications
- Email notifications for status changes
- SMS alerts for overdue rentals
- Admin dashboard alerts

### 3. Advanced Reporting
- Rental utilization reports
- Revenue per item reports
- Customer behavior analysis
- Performance metrics

### 4. Integration Features
- GPS tracking integration
- Digital key management
- Maintenance scheduling
- Inventory management

## Troubleshooting

### Common Issues
1. **Items not showing**: Check order relationship and permissions
2. **Status not updating**: Verify item is in "dalam_proses" status
3. **Bulk actions failing**: Check if all selected items are eligible

### Debug Information
- Check database relationships
- Verify model fillable fields
- Review form validation rules
- Check admin permissions

## Best Practices

### Data Management
- Always provide cancellation reasons when cancelling items
- Use bulk actions for efficiency
- Regularly review overdue rentals
- Maintain accurate status information

### User Experience
- Use clear, descriptive labels
- Provide helpful confirmation messages
- Implement intuitive navigation
- Ensure responsive design

### Performance
- Use appropriate database indexes
- Implement efficient queries
- Optimize image loading
- Cache frequently accessed data

## Conclusion

The Admin Order Items System provides a comprehensive solution for managing individual rental items within the Voltrans platform. It offers granular control over the rental process, efficient status management, and seamless integration with the existing order system.

The system is designed to be user-friendly, performant, and scalable, supporting the growing needs of the rental business while maintaining data integrity and providing excellent user experience for administrators.

For technical support or feature requests, please refer to the development team or create an issue in the project repository. 