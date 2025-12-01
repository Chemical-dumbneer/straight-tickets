<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('type', 'User')->get();
        $techs = User::where('type', 'Tech')->get();

        Ticket::factory(30)->make()->each(function ($ticket) use ($users, $techs) {
            $ticket->user_id = $users->random()->id;
            $ticket->tech_id = $techs->random()->id;
            $ticket->save();
        });
    }
}
