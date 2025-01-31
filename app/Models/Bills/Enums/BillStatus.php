<?php

namespace App\Models\Bills\Enums;

enum BillStatus: string
{
    case PAID = 'paid';
    case UNPAID = 'unpaid';
    case OVERDUE = 'overdue';
    case PARTIAL = 'partial';
}
