<?php

namespace App\services;

use App\Enums\InteractionType;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use App\Models\TicketInteraction;
use App\Models\User;

class TicketService
{
    public function create(string $title, string $description, User $user): Ticket
    {
        return Ticket::create([
            'title' => $title,
            'description' => $description,
            'status' => TicketStatus::OPEN,
            'user_id' => $user->id,
        ]);
    }

    public function addInteraction(Ticket $ticket, User $user, string $description, InteractionType $type): void
    {
        $interaction = TicketInteraction::create([
            'ticket_id' => $ticket->id,
            'user_id' => $user->id,
            'timelinePosition' => $ticket->interactions()->count() + 1,
            'type' => $type->value,
            'description' => $description,
        ]);

        $ticket->interactions->prepend($interaction->load('user'));

        $ticket->status = match($interaction->type) {
            InteractionType::TASK => TicketStatus::PENDING,
            InteractionType::SOLUTION => TicketStatus::CLOSED,
            InteractionType::FOLLOWUP => TicketStatus::OPEN
        };

        $ticket->save();
    }

    public function assignTicket(Ticket $ticket, ?User $user = null): void
    {
        $ticket->tech_id = ($user === null) ? null : $user->id;

        $ticket->save();
    }
}
