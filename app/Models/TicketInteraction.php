<?php

namespace App\Models;

use App\Enums\InteractionType;
use Illuminate\Database\Eloquent\Model;

class TicketInteraction extends Model
{
    protected $fillable = [
        'ticket_id',
        'timelinePosition',
        'user_id',
        'type',
        'description',
    ];

    protected function casts():array
    {
        return [
            'type' => InteractionType::class,
        ];
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
