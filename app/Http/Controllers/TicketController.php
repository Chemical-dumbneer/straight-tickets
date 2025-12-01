<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    //
    public function index()
    {
        return view('tickets.index');
    }

    public function show(Ticket $ticket)
    {
        return view('tickets.show', $ticket);
    }

    public function create()
    {
        return view('tickets.create');
    }
}
