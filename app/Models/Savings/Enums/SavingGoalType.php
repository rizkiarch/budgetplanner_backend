<?php

namespace App\Models\Savings\Enums;

enum SavingGoalType: string
{
    case EMERGENCY = 'emergency';
    case VACATION = 'vacation';
    case INVESTMENT = 'investment';
    case EDUCATION = 'education';
    case RETIREMENT = 'retirement';
    case OTHER = 'other';
}
