<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\TicketInteraction;
use App\Models\User;

class TicketInteractionSeeder extends Seeder
{
    public function run(): void
    {
        $tickets = Ticket::all();

        foreach ($tickets as $ticket) {

            // Quantidade variável de interações
            $count = rand(1, 6);

            for ($i = 1; $i <= $count; $i++) {

                TicketInteraction::create([
                    'ticket_id' => $ticket->id,
                    'timelinePosition' => $i,
                    'user_id' => rand(0, 1)
                        ? $ticket->user_id
                        : $ticket->tech_id,
                    'type' => fake()->randomElement(['FollowUp', 'Task', 'Solution']),
                    'description' => fake()->sentence(10),
                ]);
            }
        }
    }
}
