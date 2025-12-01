<?php

namespace App\Enums;

enum TicketStatus:String
{
    case OPEN = "Open";
    case PENDING = "Pending";
    case CLOSED = "Closed";
}
