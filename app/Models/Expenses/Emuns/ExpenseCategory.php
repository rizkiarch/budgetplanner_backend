<?php

namespace App\Models\Expenses\Enums;

enum ExpenseCategory: string
{
    case FOOD = 'food';
    case TRANSPORT = 'transport';
    case HOUSING = 'housing';
    case ENTERTAINMENT = 'entertainment';
    case HEALTH = 'health';
    case EDUCATION = 'education';
    case UTILITIES = 'utilities';
    case OTHER = 'other';
}
