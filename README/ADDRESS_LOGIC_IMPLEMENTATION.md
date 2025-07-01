# Address Logic Implementation

## Overview
This implementation allows users to have up to 3 addresses total, with specific rules for verification and KTP upload requirements.

## Business Rules

### 1. Address Limits
- **Maximum Addresses**: 3 addresses per user
- **Verified Addresses**: Only 1 address can be verified (requires KTP upload)
- **Additional Addresses**: Up to 2 additional addresses without KTP upload

### 2. Verification Logic
- **First Address**: Requires KTP upload for verification
- **Subsequent Addresses**: No KTP required, added as unverified addresses
- **Verification Status**: Only one address can be verified per user

### 3. KTP Upload Requirements
- **Required**: Only for the first address or when no verified address exists
- **Optional**: For additional addresses (up to 3 total)
- **File Validation**: JPG/PNG, max 2MB

## Implementation Details

### 1. AddressModal Component (`app/Livewire/AddressModal.php`)

#### Key Properties Added:
```php
public $requiresKtp = false;
public $maxAddressesReached = false;
```

#### Key Methods Added:
- `checkAddressLimits()`: Validates address count and determines KTP requirements
- Updated validation rules to conditionally require KTP
- Enhanced save logic to handle different address types

#### Logic Flow:
1. **Check Limits**: Verify user hasn't reached 3 address limit
2. **Determine KTP Requirement**: 
   - If no verified address exists AND this is the first address → KTP required
   - Otherwise → KTP optional
3. **Save Address**: Create address with appropriate verification status

### 2. User Model (`app/Models/User.php`)

#### Helper Methods Added:
```php
public function canAddAddress(): bool
public function getRemainingAddressSlots(): int
public function hasUnverifiedKtpAddresses(): bool
public function getUnverifiedKtpAddresses()
```

### 3. Blade Template Updates

#### Address Modal (`resources/views/livewire/address-modal.blade.php`):
- Conditional KTP upload section
- Informational messages for different address types
- Disabled button when limit reached

#### Address Index (`resources/views/profile/addresses/index.blade.php`):
- Address count display (X/3)
- Remaining slots indicator
- Verification status information
- Enhanced badges for different address states

## User Experience Flow

### Scenario 1: First Address
1. User clicks "Tambah"
2. KTP upload is required and shown
3. User fills form + uploads KTP
4. Address created with `is_verified = false`, `ktp_path` stored
5. Success message: "Menunggu verifikasi KTP"

### Scenario 2: Additional Addresses (No Verified Address)
1. User clicks "Tambah"
2. KTP upload is required (still no verified address)
3. User fills form + uploads KTP
4. Address created with `is_verified = false`, `ktp_path` stored
5. Success message: "Menunggu verifikasi KTP"

### Scenario 3: Additional Addresses (Has Verified Address)
1. User clicks "Tambah"
2. KTP upload is NOT required
3. User fills form (no KTP needed)
4. Address created with `is_verified = false`, `ktp_path = null`
5. Success message: "Alamat berhasil ditambah"

### Scenario 4: Maximum Addresses Reached
1. User clicks "Tambah"
2. Button is disabled
3. Error message: "Anda telah mencapai batas maksimal 3 alamat"

## Database Schema

The existing `addresses` table structure supports this implementation:

```sql
- id (primary key)
- user_id (foreign key)
- name
- address
- province
- city
- state
- postal_code
- is_default (boolean)
- ktp_path (nullable)
- is_verified (boolean)
- rejection_reason (nullable)
- created_at
- updated_at
- deleted_at (soft deletes)
```

## Admin Verification Process

Admins can verify addresses through the Filament admin panel:
1. Navigate to Addresses in admin panel
2. Find addresses with `ktp_path` but `is_verified = false`
3. Review KTP image
4. Update `is_verified` status
5. Optionally add `rejection_reason` if rejected

## Testing Scenarios

### Test Cases:
1. **First Address**: Should require KTP upload
2. **Second Address (No Verified)**: Should require KTP upload
3. **Second Address (Has Verified)**: Should NOT require KTP upload
4. **Third Address**: Should NOT require KTP upload
5. **Fourth Address**: Should be blocked (limit reached)
6. **Edit Address**: Should NOT require KTP upload
7. **Delete Address**: Should allow adding new address after deletion

### Validation Tests:
- KTP file size limit (2MB)
- KTP file format (JPG/PNG)
- Required fields validation
- Address count limits
- Verification status logic

## Security Considerations

1. **File Upload Security**: KTP images stored in `storage/app/public/ktp/`
2. **Authorization**: Users can only manage their own addresses
3. **Validation**: Server-side validation for all inputs
4. **Rate Limiting**: Consider implementing rate limits for address creation

## Future Enhancements

1. **Address Verification Workflow**: Email notifications for verification status
2. **Address Priority**: Allow users to set priority for multiple addresses
3. **Bulk Operations**: Allow admins to verify multiple addresses at once
4. **Address History**: Track changes to addresses over time
5. **Geolocation**: Add address validation using external APIs 