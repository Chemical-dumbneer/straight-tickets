<?php

namespace App\Models;

use App\Enums\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tech_id',
        'title',
        'description',
        'status',
    ];

    protected function casts():array
    {
        return [
            'status' => TicketStatus::class,
        ];
    }

    public function tech()
    {
        return $this->belongsTo(User::class, 'tech_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function interactions()
    {
        return $this->hasMany(TicketInteraction::class)
            ->orderByDesc('timelinePosition');
    }

    public function scopeFromUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    public function scopeAssignedToTech($query, User $tech)
    {
        return $query->where('tech_id', $tech->id);
    }

    public function scopeStatus($query, TicketStatus $status)
    {
        return $query->where('status', $status->value);
    }

    public function scopeWithoutTech($query)
    {
        return $query->whereNull('tech_id');
    }
}
