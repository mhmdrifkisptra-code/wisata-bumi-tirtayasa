<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visit_date',
        'code',
        'total',
        'status',
        'snap_token',
        'payment_type',
        'payment_status',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function statusHistories()
    {
        return $this->hasMany(\App\Models\BookingStatusHistory::class)
            ->orderBy('changed_at', 'desc');
    }
}
