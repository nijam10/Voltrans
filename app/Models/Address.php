<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'province',
        'city',
        'state',
        'postal_code',
        'is_default',
        'ktp_path',
        'rejection_reason',
        'is_verified',
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_verified' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if address is verified
     */
    public function isVerified(): bool
    {
        return $this->is_verified === true;
    }

    /**
     * Check if address is rejected
     */
    public function isRejected(): bool
    {
        return !$this->is_verified && !empty($this->rejection_reason);
    }

    /**
     * Check if address is pending verification
     */
    public function isPendingVerification(): bool
    {
        return !$this->is_verified && !empty($this->ktp_path) && empty($this->rejection_reason);
    }

    /**
     * Check if address is unverified (no KTP uploaded)
     */
    public function isUnverified(): bool
    {
        return !$this->is_verified && empty($this->ktp_path);
    }

    /**
     * Get verification status badge
     */
    public function getVerificationStatusBadge(): array
    {
        if ($this->isVerified()) {
            return [
                'label' => 'Terverifikasi',
                'color' => 'blue',
                'bg_color' => 'bg-blue-100',
                'text_color' => 'text-blue-800'
            ];
        }

        if ($this->isRejected()) {
            return [
                'label' => 'Ditolak',
                'color' => 'red',
                'bg_color' => 'bg-red-100',
                'text_color' => 'text-red-800'
            ];
        }

        if ($this->isPendingVerification()) {
            return [
                'label' => 'Menunggu Verifikasi',
                'color' => 'yellow',
                'bg_color' => 'bg-yellow-100',
                'text_color' => 'text-yellow-800'
            ];
        }

        return [
            'label' => 'Tidak Terverifikasi',
            'color' => 'gray',
            'bg_color' => 'bg-gray-100',
            'text_color' => 'text-gray-800'
        ];
    }
} 