<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Repositories\Contracts\IncomeRepositoryInterface;
use App\Repositories\Contracts\SavingRepositoryInterface;
use Illuminate\Http\Request;

class FinanceReportController extends Controller
{
    public function __construct(
        private readonly IncomeRepositoryInterface $incomeRepo,
        private readonly ExpenseRepositoryInterface $expenseRepo,
        private readonly SavingRepositoryInterface $savingRepo
    ) {}

    public function monthlySummary(): JsonResponse
    {
        return response()->json([
            'total_income' => $this->incomeRepo->getTotalIncome(),
            'total_expenses' => $this->expenseRepo->getTotalExpenses(),
            'net_balance' => $this->incomeRepo->getTotalIncome() - $this->expenseRepo->getTotalExpenses(),
            'total_savings' => $this->savingRepo->getTotalSavings()
        ]);
    }
}
