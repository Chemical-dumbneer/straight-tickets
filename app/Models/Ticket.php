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
        return $this->belongsTo(User::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interactions()
    {
        return $this->hasMany(TicketInteraction::class);
    }
}
