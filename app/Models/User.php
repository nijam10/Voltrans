<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;


class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'profile_photo_path',
        'name',
        'email',
        'password',
        'role',
        'email_verified_at',
        'provider_id',
        'provider_name',
        'provider_token',
        'provider_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'provider_token',
        'provider_refresh_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get the cart items for the user.
     */
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    /**
     * Check if user has verified addresses
     */
    public function hasVerifiedAddress(): bool
    {
        return $this->addresses()->where('is_verified', true)->exists();
    }

    /**
     * Get the first verified address
     */
    public function getVerifiedAddress()
    {
        return $this->addresses()->where('is_verified', true)->first();
    }

    /**
     * Check if user can add more addresses
     */
    public function canAddAddress(): bool
    {
        return $this->addresses()->count() < 3;
    }

    /**
     * Get remaining address slots
     */
    public function getRemainingAddressSlots(): int
    {
        return max(0, 3 - $this->addresses()->count());
    }

    /**
     * Check if user has unverified addresses with KTP
     */
    public function hasUnverifiedKtpAddresses(): bool
    {
        return $this->addresses()->where('is_verified', false)->whereNotNull('ktp_path')->exists();
    }

    /**
     * Get all unverified addresses with KTP
     */
    public function getUnverifiedKtpAddresses()
    {
        return $this->addresses()->where('is_verified', false)->whereNotNull('ktp_path')->get();
    }

}
