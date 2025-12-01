<?php

namespace App\Enums;

enum InteractionType:String
{
    case FOLLOWUP = "FollowUp";
    case TASK = "Task";
    case SOLUTION = "Solution";
}
