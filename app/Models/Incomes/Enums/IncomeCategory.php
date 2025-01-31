<?php

namespace App\Models\Incomes\Enums;

enum IncomeCategory: string
{
    case SALARY = 'salary';
    case FREELANCE = 'freelance';
    case INVESTMENT = 'investment';
    case BUSINESS = 'business';
    case OTHER = 'other';
}
